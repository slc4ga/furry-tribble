<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components this controller uses.
 *
 * Component names should not include the `Component` suffix. Components
 * declared in subclasses will be merged with components declared here.
 *
 * @var array
 */
	public $components = array(
        'Session',
        'Flash'
    );

    public function beforeFilter(Event $event) {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find('all')->where(['username' => $_SERVER['uid']])->toArray();
        if(is_null($user) || empty($user)) {
        	$new_user = $usersTable->newEntity(['username' => $_SERVER['uid']]);
        	debug($new_user);
        	if($usersTable->save($new_user)) {
                $this->Flash->success(__('You have been successfully added to the userbase.'));        
            } 
        }
        
        $this->set('admin', $user[0]['admin'] == 1);
        $this->set('username', $_SERVER['uid']);
        // $this->set('username', 'slc4ga');
        // $this->set('admin', 1);
    }
}
