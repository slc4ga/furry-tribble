<?php

namespace App\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Email\Email;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {
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
        // $this->loadComponent('Paginator');
    }

    // public function login() {
    //     // prevent logged in users from accessing login page
    //     if (!is_null($this->Auth->user('id'))) {
    //         $this->redirect('/');
    //     }
    //     $this->layout = 'landing';
    //     if ($this->request->is('post')) {
    //         $user_array = $this->Auth->identify();
    //         if ($user_array) {
    //             $user = $this->Users->get($user_array['id']);
    //             if (!$user->is_email_confirmed) {
    //                 if (!$user->is_client_id_confirmed) {
    //                     $this->Flash->error(__("Your account is being processed. In the meantime, please confirm your email."));
    //                 }
    //                 else {
    //                     $this->Flash->error(__("We've processed your account but you still need to confirm your email."));
    //                 }
    //             }
    //             else if (!$user->is_client_id_confirmed) {
    //                 $this->Flash->error(__("Your account is still being processed."));
    //             }
    //             else {
    //                 // store redirect so that it doesn't get lost when we destroy the session
    //                 $redirect = $this->Auth->redirectUrl();
    //                 // destroying the session prevents users from being able to access the welcome page
    //                 $this->request->session()->destroy();

    //                 $this->Auth->setUser($user_array);
    //                 return $this->redirect($redirect);
    //             }
    //         }
    //         else {
    //             $this->Flash->error(__('Invalid username or password, try again'));
    //         }
    //     }
    // }

    // public function logout() {
    //     $this->request->session()->destroy();
    //     return $this->redirect($this->Auth->logout());
    // }

    
    public function profile(){

    }
     

}
?>
