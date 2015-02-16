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
        // $this->loadComponent('Paginator');
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

        // $band = $this->Bands->get($id);
        $commentsTable = TableRegistry::get('Comments');
        $comments = $commentsTable->find('all')->where(['band_id' => $id])->toArray();
        $this->set('comments', $comments);
        $this->set("band_id", $id);
    }
}
?>
