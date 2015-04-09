<style>
table th, td {
    text-align: center;
}
</style>
<div class="row">
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="alert alert-info" role="alert">
                    <strong> Welcome to the bands site!</strong> 
                    Our github repo is a Star Trek reference, according to Dean Groves.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1>
                    Administration Panel
                </h1>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <h3><?= $this->Html->link('Add New Band', ['controller' => 'Bands', 'action' => 'addBand'], ['class' => 'btn btn-lg btn-info']); ?> </h3>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3>Add New Administrator</h3>
                <?= $this->Form->create(null, ['action' => 'addAdmin']) ?>
                <?php
                    echo $this->Form->input('user_id', [
                            'options' => $users,
                            'label' => ['class' => 'hidden'],
                            'type' => 'select',
                            'class' => 'form-control',
                            'empty' => '(Choose a Computing ID)'
                        ]
                    );
                ?>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']); ?>
                <?= $this->Form->end(); ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <h3>Remove Administrator</h3>
                <?= $this->Form->create(null, ['action' => 'deleteAdmin']) ?>
                <?php
                    echo $this->Form->input('user_id', [
                            'options' => $admins,
                            'label' => ['class' => 'hidden'],
                            'type' => 'select',
                            'class' => 'form-control',
                            'empty' => '(Choose a Computing ID to remove)'
                        ]
                    );
                ?>
                <?= $this->Form->button(__('Remove'), ['class' => 'btn btn-danger']); ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->create(null, ['action' => 'updateSettings']) ?>
                    <h3>Change Active Band Settings</h3>
                    <p class="lead">An <em>active band</em> is one that is marked active by an administrator, or has a set number of comments submitted within in a certain number of days.</p>
                    <div class="row">
                        <div class="col-md-3 col-sm-3"> 
                            
                            <?php
                                echo $this->Form->input('comments', [
                                        'type' => 'number',
                                        'min' => 0,
                                        'max' => 100,
                                        'class' => 'form-control',
                                        'value' => $comments
                                    ]
                                );
                            ?>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <?php
                                echo $this->Form->input('days', [
                                        'type' => 'number',
                                        'min' => 0,
                                        'max' => 100,
                                        'class' => 'form-control',
                                        'value' => $days
                                    ]
                                );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <?= $this->Form->button(__('Save Settings'), ['class' => 'btn btn-success']); ?>
                        </div>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Bands List</h3>
                <?php if (sizeof($bands) > 0) : ?>
                    <table class="table table-striped"> 
                        <thead>
                            <th>QR Code</th>
                            <th># of Comments</th>
                            <th>Comments in last <?= $days ?> Days</th>
                            <th>Last Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($bands as $band): ?>
                                <tr id="<?= $band['id']?>">
                                    <td><?= $band['qr_code']?></td>
                                    <td><?= $band['comments'] ?></td>
                                    <td><?= $band['comments_in_days'] ?></td>
                                    <td><?php if(isset($band['last_comment'])) {
                                                echo date('n/j/Y g:i A',strtotime($band['last_comment']['timestamp'])); 
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($band['active'] == 0): ?>
                                            <span class="red-text" role="alert">Inactive</span>
                                        <?php else: ?>
                                            <span class="green-text" role="alert">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($band['active'] == 0): ?>
                                            <?= $this->Html->link('Activate', 
                                                                    ['controller' => 'bands', 'action' => 'activateBand', $band['id']], 
                                                                    ['class' => 'btn btn-success btn-small-width', 
                                                                    'confirm' => 'Are you sure you wish to activate this band?']);
                                            ?>
                                        <?php else: ?>
                                            <?= $this->Html->link('Deactivate', 
                                                                    ['controller' => 'bands', 'action' => 'deactivateBand', $band['id']], 
                                                                    ['class' => 'btn btn-warning btn-small-width', 
                                                                    'confirm' => 'Are you sure you wish to deactivate this band?']);
                                            ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4>No bands have been entered yet!</h4>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->element('pagination'); ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Flagged Comments</h3>
                <?php if (sizeof($flagged) > 0) : ?>
                    <table class="table table-striped"> 
                        <thead>
                            <th>Comment</th>
                            <?php if($admin): ?>
                                <th>Commenter</th>
                            <?php endif; ?>
                            <th>Date</th>
                            <th>Votes</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($flagged as $comment): ?>
                                <tr id="<?= $comment['id']?>">
                                    <td><?= $comment['text']?></td>
                                    <?php if($admin): ?>
                                        <td><?= $comment['username'] ?></td>
                                    <?php endif; ?>
                                    <td><?= date('n/j/Y g:i A',strtotime($comment['timestamp'])); ?></td>
                                    <td>
                                        <?= $comment['votes'] ?>
                                    </td>
                                    <td>
                                        <?php if($admin): ?>
                                            <?= $this->Html->link('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 
                                                                    ['controller' => 'bands', 'action' => 'delete', $comment['id'], $comment['band_id']], 
                                                                    ['escape' => False, 'confirm' => 'Are you sure you wish to delete this comment?']);
                                            ?>
                                            &nbsp;
                                            <?= $this->Html->link('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>', 
                                                                    ['controller' => 'bands', 'action' => 'unflag', $comment['id'], $comment['band_id']], 
                                                                    ['escape' => False, 'confirm' => 'Are you sure you wish to un-flag this comment?']);
                                            ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4>No comments are currently flagged!</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
