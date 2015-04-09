<?php

namespace App\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Email\Email;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class UsersController extends AppController {
    public $components = ['Flash'];

    public function intialize() {
        parent::initialize();
    }
    
    public function profile(){
        $this->set('username', $_SERVER['uid']);

        // get all user comments
        $commentsTable = TableRegistry::get('Comments');
        $usersTable = TableRegistry::get('Users');
        $votesTable = TableRegistry::get('UserLikes');

        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        $comments = $commentsTable->find('all')->where(['user_id' => $user[0]['id']])
                                                ->toArray();

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
        }
        $this->set('comments', $comments);
    }
     
    public function admin() {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        
        if($user[0]['admin'] == 0) {
            $this->redirect(['controller' => 'Users', 'action' => 'profile']);
        } 

        $allUsers = $usersTable->find('all')->where(['admin != ' => 1]);
        $usersDropdown = [];
        foreach ($allUsers as $user) {
            $usersDropdown[$user['id']] = $user['username'];
        }

        $this->set('users', $usersDropdown);

        $allAdmins = $usersTable->find('all')->where(['admin' => 1]);
        $adminsDropdown = [];
        foreach ($allAdmins as $user) {
            $adminsDropdown[$user['id']] = $user['username'];
        }

        $this->set('admins', $adminsDropdown);

        $settingsTable = TableRegistry::get('Settings');
        $settings = $settingsTable->find('all')->toArray();
        $comments = $settings[0]['value'];
        $days = $settings[1]['value'];
        $this->set('days', $days);
        $this->set('comments', $comments);

        $bandsTable = TableRegistry::get('Bands');
        $commentsTable = TableRegistry::get('Comments');

        $votesTable = TableRegistry::get('UserLikes');
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
            if(count($comment) > 0) {
                $band['last_comment'] = $comment[0];
            }

            // check to see if band is still active
            if(count($comment) >= 5) {

            } else {
                $bandQuery = $bandsTable->find('all')->where(['id' => $band['id']])->toArray();
                $bandQuery = $bandsTable->patchEntity($bandQuery[0], ['active' => 0]);
                $band['active'] = 0;
            }

            $band['comments_in_days'] = count($comment);

            $query = $commentsTable->find('all')->where(['band_id' => $band['id']]);
            $query->select(['count' => $query->func()->count('*')]);
            $query = $query->all()->toArray();
            $band['comments'] = $query[0]['count'];
        }
        $this->set('bands', $bands);

        $flagged = $commentsTable->find('all')
                            ->where(['flagged' => 1])
                            ->order(['timestamp' => 'asc'])
                            ->toArray();
        foreach($flagged as $com) {
            $query = $votesTable->find('all')->where(['comment_id' => $com['id']]);
            $query->select(['count' => $query->func()->count('*')]);
            $query = $query->all()->toArray();
            $com['votes'] = $query[0]['count'];
            $poster = $usersTable->find('all')->where(['id' => $com['user_id']])->toArray();
            $com['username'] = $poster[0]['username'];
        }
        $this->set('flagged', $flagged);
    }

    public function addAdmin() {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        
        if($user[0]['admin'] == 0) {
            $this->redirect(['controller' => 'Users', 'action' => 'profile']);
        } 

        $user = $usersTable->find('all')->where(['id' => $this->request->data['user_id']])->toArray();
        $user = $usersTable->patchEntity($user[0], ['admin' => 1]);

        if($usersTable->save($user)) {
            $this->Flash->success(__($user['username'] . ' has been added as an administrator.'));
            $this->redirect(['action' => 'admin']);        
        } 
    }

    public function deleteAdmin() {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        
        if($user[0]['admin'] == 0) {
            $this->redirect(['controller' => 'Users', 'action' => 'profile']);
        } 

        $user = $usersTable->find('all')->where(['id' => $this->request->data['user_id']])->toArray();
        $user = $usersTable->patchEntity($user[0], ['admin' => 0]);

        if($usersTable->save($user)) {
            $this->Flash->success(__($user['username'] . ' has been removed as an administrator.'));
            $this->redirect(['action' => 'admin']);        
        } 
    }

    public function updateSettings() {
        $settingsTable = TableRegistry::get('Settings');
        $settings = $settingsTable->find('all');
        $data = $this->request->data;
        foreach ($settings as $setting) {
            if (array_key_exists($setting->setting, $data)) {
                $setting->value = $data[$setting->setting];
                if (!$settingsTable->save($setting)) {
                    $setting_info[$setting->setting]['error'] = 'error';
                    $errors = true;
                }
            }
        }
        $this->Flash->success("The settings were updated successfully.");
        $this->redirect(['action' => 'admin']); 
    }

}
?>
