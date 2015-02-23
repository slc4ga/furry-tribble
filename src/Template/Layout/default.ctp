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
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Controller\Component\AuthComponent;

$cakeDescription = 'UVA Bands';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('sidebar') ?>
    <?=
        $this->Html->css(
            'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css',
            array(
                'inline' => false
            )
        );
    ?>
    <?= $this->Html->script('jquery-1.11.1.min') ?>
    <?= $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js',
            array(
                'inline' => false
            )
        ) 
    ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="container">
        <div id="content">
            <div class="container">
                <!-- Top navbar -->
                <header>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-md-offset-1 col-sm-offset-1">
                            <h1>
                                <?= 
                                    $this->Html->link(
                                        'Profile',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
                            </h1>    
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <h1>
                                <?= 
                                    $this->Html->link(
                                        'Login',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
                            </h1> 
                        </div>
                    </div>
                </header>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- Flash -->
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <?= $this->Flash->render() ?>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    $myTemplates = [
                                        'message' => '<div class="alert alert-warning">{{content}}</div>'
                                    ];
                                    $this->Form->templates($myTemplates);
                                ?>
                                <?= $this->fetch('content') ?>
                            </div>
                        </div>
                        <div class="row">
	                        <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1">
	                        	<?= 
                                    $this->Html->link(
                                        'Profile',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
	                        </div>
	                        <div class="col-md-2 col-sm-2">
	                        	<?= 
                                    $this->Html->link(
                                        'All Bands',
                                        ['controller' => 'bands', 'action' => 'index'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
	                        </div>
	                        <div class="col-md-2 col-sm-2">
	                        	<?= 
                                    $this->Html->link(
                                        'Camera',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
	                        </div>
	                        <div class="col-md-2 col-sm-2">
	                        	<?= 
                                    $this->Html->link(
                                        'Top Comments',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
	                        </div>
	                        <div class="col-md-2 col-sm-2">
	                        	<?= 
                                    $this->Html->link(
                                        'Active Bands',
                                        ['controller' => 'Users', 'action' => '#'],
                                        array (
                                            'class' => 'btn btn-primary'
                                        )
                                    ) 
                                ?>
	                        </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-bottom">
                    <div class="footer">
                        <hr>
                        &copy; 2015
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
