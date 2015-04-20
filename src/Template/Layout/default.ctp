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
    <?= $this->Html->script('jquery-1.11.1.min') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="content">
        <div class="container">
        	<br>
            <nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- <a class="navbar-brand" href="#">Brand</a> -->
						<?= $this->Html->link('Brand', ['controller' => 'Bands', 'action' => 'home'], ['class' => 'navbar-brand']); ?>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<?= $this->Element('nav-link', ['linkText' => 'Home', 'controller' => 'Bands', 'action' => 'home']); ?>
							<?= $this->Element('nav-link', ['linkText' => 'Profile', 'controller' => 'Users', 'action' => 'profile']); ?>
							<?= $this->Element('nav-link', ['linkText' => 'All Bands', 'controller' => 'Bands', 'action' => 'index']); ?>
							<?= $this->Element('nav-link', ['linkText' => 'Top Comments', 'controller' => 'Bands', 'action' => 'topComments']); ?>
							<?= $this->Element('nav-link', ['linkText' => 'Active Bands', 'controller' => 'Bands', 'action' => 'activeBands']); ?>
						</ul>
						<?php if(isset($admin) && $admin): ?>
							<ul class="nav navbar-nav navbar-right">
								<?= $this->Element('nav-link', ['linkText' => 'Admin Panel', 'controller' => 'Users', 'action' => 'admin']); ?>
							</ul>
						<?php endif; ?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
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
</body>
</html>
