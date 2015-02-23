<?php

namespace App\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Email\Email;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class BandsController extends AppController {
    public $components = ['Flash'];

    // public function beforeFilter(Event $event) {
    //     parent::beforeFilter($event);
    //     $this->Auth->allow([
    //         'signup',
    //         'logout',
    //     ]);
    // }

    // public function isAuthorized($user) {
    //     if (in_array($this->request->action, ['profile', 'edit_profile'])) {
    //         return true;
    //     }
    //     return parent::isAuthorized($user);
    // }

    public function intialize() {
        parent::initialize();
        // $this->Bands 
        // $this->loadComponent('Paginator');
    }

    public function index() {
        $bands = $this->Bands->find('all')->toArray();
        $this->set('bands', $bands);
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
            $comment = $commentsTable->newEntity();
            $comment = $commentsTable->patchEntity($comment, $data);
            $commentsTable->save($comment);            
        }
        $this->redirect(['action' => 'view', $data['band_id']]);
    }

    public function view($id = null) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $commentsTable = TableRegistry::get('Comments');
        $votesTable = TableRegistry::get('UserLikes');
        $usersTable = TableRegistry::get('Users');

        $comments = $commentsTable->find('all')->where(['band_id' => $id])->toArray();
        foreach($comments as $com) {
            $query = $votesTable->find('all')->where(['comment_id' => $com['id']]);
            $query->select(['count' => $query->func()->count('*')]);
            $query = $query->all()->toArray();
            $com['votes'] = $query[0]['count'];

            
            $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
            // debug($user[0]['id']);
            $query = $votesTable->find('all')->where(['user_id' => $user[0]['id']])->toArray();
            if(!empty($query)) {
                $com['liked'] = True;
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

    public function upvote($id) {
        if(is_null($id)) {
            $this->redirect(['controller' => 'Bands', 'action' => 'index']);
        }

        $votesTable = TableRegistry::get('UserLikes');
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        $vote = $votesTable->newEntity(['user_id' => $user[0]['id'], 'comment_id' => $id]);
        if($votesTable->save($vote)) {
            $this->Flash->success(__('Your vote has been saved.'));
            $this->redirect(['action' => 'view', $id]);    
        }      
    }
}
?>
