<?php

namespace App\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Email\Email;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Network\Http\Client;


class BandsController extends AppController {
    public $components = ['Flash'];
    public $paginate = [
        'limit' => 100,
        'order' => [
            'Comments.timestamp' => 'asc'
        ]
    ];

    public function intialize() {
        parent::initialize();
    }

    public function index() {
        $bands = $this->Bands->find('all');
        $this->set('bands', $this->paginate($bands));
    }
    
    public function addComment($id = null){
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $band = $this->Bands->get($id);
        $this->set("band_id", $id);
    }
    
    public function saveComment() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $commentsTable = TableRegistry::get('Comments');
            $bandsTable = TableRegistry::get('Bands');
            $usersTable = TableRegistry::get('Users');

            // $username = 'slc4ga';
            $username = $_SERVER['uid'];

            $user = $usersTable->find('all')->where(['username' => $username])->toArray();
            // check if comment already there
            $comment = $commentsTable->find('all')->where(['text' => $data['text']])->where(['user_id' => $user[0]['id']])->toArray();
            if(empty($comment)) {
                $comment = $commentsTable->newEntity(['user_id' => $user[0]['id']]);
                $comment = $commentsTable->patchEntity($comment, $data);
                $commentsTable->save($comment);
                // debug($data); exit();
                
                $band = $this->Bands->find('all')->where(['id' => $data['band_id']])->toArray();
                if($band[0]['active'] == 0) {
                    $band = $usersTable->patchEntity($band[0], ['active' => 1]);

                    if($this->Bands->save($band)) {
                        $this->Flash->success(__('This band has been successfully re-activated, and your comment was added.'));  
                    } 
                }
            } else {
                $this->Flash->error(__('That exact comment has already been added, so you can\'t add it again.'));  
            }

        }
        $this->redirect(['action' => 'view', $data['band_id']]);
    }

    public function home() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $band = $this->Bands->find('all')->where(['qr_code' => $data['band_id']])->toArray();
            if(!empty($band)) {
                $this->redirect(['controller' => 'Bands', 'action' => 'addComment', $band[0]['id']]);    
            } else {
                $this->Flash->error(__('Uhoh! That band doesn\'t exist...please try entering the ID number again.'));  
            }
        }
    }

    public function view($id = null) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        // $username = 'slc4ga';
        $username = $_SERVER['uid'];

        $commentsTable = TableRegistry::get('Comments');
        $votesTable = TableRegistry::get('UserLikes');
        $usersTable = TableRegistry::get('Users');

        $adminTable = TableRegistry::get('Admins');
        $user = $usersTable->find('all')->where(['username' => $username])->toArray();
        $admin = $adminTable->find('all')->where(['user_id' => $user[0]['id']])->toArray();
        $this->set('admin', !empty($admin));

        $comments = $this->paginate($commentsTable->find('all')->where(['band_id' => $id]));
        foreach($comments as $com) {
            $query = $votesTable->find('all')->where(['comment_id' => $com['id']]);
            $query->select(['count' => $query->func()->count('*')]);
            $query = $query->all()->toArray();
            $com['votes'] = $query[0]['count'];

            
            $query = $votesTable->find('all')->where(['user_id' => $user[0]['id']])
                                            ->where(['comment_id' => $com['id']])
                                            ->toArray();
            if(!empty($query)) {
                $com['liked'] = True;
            }
            if(!empty($admin)) {
                $poster = $usersTable->find('all')->where(['id' => $com['user_id']])->toArray();
                $com['username'] = $poster[0]['username'];
            }
        }
        $this->set('comments', $comments);
        $this->set("band_id", $id);
    }

    public function addBand() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $band = $this->Bands->newEntity();
            $band = $this->Bands->patchEntity($band, $data);
            if($this->Bands->save($band)) {
                $this->Flash->success(__('Your band has been saved.'));
                $this->redirect(['action' => 'view', $band['id']]);        
            }         
        }
    }

    public function upvote($id, $band_id) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $votesTable = TableRegistry::get('UserLikes');
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        $vote = $votesTable->newEntity(['user_id' => $user[0]['id'], 'comment_id' => $id]);
        if($votesTable->save($vote)) {
            $this->Flash->success(__('Your vote has been saved.'));
            $this->redirect(['action' => 'view', $band_id]);    
        }      
    }

    public function flag($id, $band_id) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $comments = TableRegistry::get('Comments');
        $comment = $comments->get($id);
        $comments->patchEntity($comment, ['flagged' => 1]);
       
        if($comments->save($comment)) {
            $this->Flash->success(__('Your flag has been saved.'));
            $this->redirect(['action' => 'view', $band_id]);    
        }      
    }

    public function unflag($id, $band_id) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $comments = TableRegistry::get('Comments');
        $comment = $comments->get($id);
        $comments->patchEntity($comment, ['flagged' => 0]);
       
        if($comments->save($comment)) {
            $this->Flash->success(__('You have successfully removed the flag on this comment.'));
            $this->redirect(['action' => 'view', $band_id]);    
        }      
    }

    public function delete($id, $band_id) {
        $adminTable = TableRegistry::get('Admins');
        $usersTable = TableRegistry::get('Users');
        $commentsTable = TableRegistry::get('Comments');
        $likesTable = TableRegistry::get('UserLikes');

        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        $admin = $adminTable->find('all')->where(['user_id' => $user[0]['id']])->toArray();
        
        if(empty($admin)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $comment = $commentsTable->query()->delete()->where(['id' => $id])->execute();
        $like = $likesTable->query()->delete()->where(['comment_id' => $id])->execute();
        $this->Flash->success(__('This comment has been deleted.'));
        $this->redirect(['action' => 'view', $band_id]);    
    }

    public function topComments() {
        // select comment_id, count(*) from user_likes group by comment_id order by count(*) desc;
        $votesTable = TableRegistry::get('UserLikes');
        $usersTable = TableRegistry::get('Users');
        $commentsTable = TableRegistry::get('Comments');
        $query = $votesTable->find('all');
        $query->group('comment_id')
                ->order(['count(*)' => 'DESC'])
                ->limit(100)
                ->select(['comment_id','count' => $query->func()->count('*')]);
        $commentVotes = $query->toArray();

        // $username = 'slc4ga';
        $username = $_SERVER['uid'];
        
        $adminTable = TableRegistry::get('Admins');
        $user = $usersTable->find('all')->where(['username' => $username])->toArray();
        $admin = $adminTable->find('all')->where(['user_id' => $user[0]['id']])->toArray();
        $this->set('admin', !empty($admin));

        foreach ($commentVotes as $commentGroup) {
            $comment = $commentsTable->find('all')->where(['id' => $commentGroup['comment_id']])->toArray();
            

            $user = $usersTable->find('all')->where(['username' => $username])->toArray();
            $query = $votesTable->find('all')->where(['user_id' => $user[0]['id']])->toArray();
            if(!empty($query)) {
                $commentGroup['liked'] = True;
            }
            if(!empty($admin)) {
                $poster = $usersTable->find('all')->where(['id' => $comment[0]['user_id']])->toArray();
                $comment[0]['username'] = $poster[0]['username'];
            }
            $commentGroup['comment'] = $comment[0];
        }
        $this->set('commentVotes', $commentVotes);
             
    }

    public function deactivateBand($band_id = null) {
        if(is_null($band_id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        // $username = 'slc4ga';
        $username = $_SERVER['uid'];

        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $username])->toArray();
        
        if($user[0]['admin'] == 0) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        } 

        $band = $this->Bands->find('all')->where(['id' => $band_id])->toArray();
        $band = $usersTable->patchEntity($band[0], ['active' => 0]);

        if($this->Bands->save($band)) {
            $this->Flash->success(__('The band has been successfully deactivated.'));
            $this->redirect(['controller' => 'Users', 'action' => 'admin']);        
        } 
    }

    public function activateBand($band_id = null) {
        if(is_null($band_id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        // $username = 'slc4ga';
        $username = $_SERVER['uid'];

        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $username])->toArray();
        
        if($user[0]['admin'] == 0) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        } 

        $band = $this->Bands->find('all')->where(['id' => $band_id])->toArray();
        $band = $usersTable->patchEntity($band[0], ['active' => 1]);

        if($this->Bands->save($band)) {
            $this->Flash->success(__('The band has been successfully activated.'));
            $this->redirect(['controller' => 'Users', 'action' => 'admin']);        
        } 
    }

    public function camera() {

    }

    public function activeBands() {
        $settingsTable = TableRegistry::get('Settings');
        $settings = $settingsTable->find('all')->toArray();
        $comments = $settings[0]['value'];
        $days = $settings[1]['value'];
        $this->set('days', $days);
        $this->set('comments', $comments);

        $bandsTable = TableRegistry::get('Bands');
        $commentsTable = TableRegistry::get('Comments');

        $bands = $bandsTable->find('all')
                            ->order(['active' => 'DESC'])
                            ->toArray();


        $old_date = date("Y-m-d", strtotime("-$days days") );  

        foreach ($bands as $band) {
            $comment = $commentsTable->find('all')->where(['band_id' => $band['id']])
                                                ->where(['timestamp >' => $old_date])
                                                ->order(['timestamp' => 'DESC'])
                                                ->limit(100)
                                                ->toArray();

            $band['comments_in_days'] = count($comment);
            if(count($comment) > 0) {
                $band['last_comment'] = $comment[0];
            }

            $query = $commentsTable->find('all')->where(['band_id' => $band['id']]);
            $query->select(['count' => $query->func()->count('*')]);
            $query = $query->all()->toArray();
            $band['comments'] = $query[0]['count'];
        }
        usort($bands, function($a, $b) {
            return $b['comments_in_days'] - $a['comments_in_days'];
        });
        $this->set('bands', $bands);
    }
}
?>
