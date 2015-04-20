<!-- File: src/Template/Users/profile.ctp -->


<!-- File: src/Template/Bands/view.ctp -->
<?php 
// debug(); exit();
// $user_id = $_SERVER['uid']; //get netbadge
// echo "User: " . $user_id;
?>
<div class="row">
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1>
                    Welcome, <strong><?= $username ?></strong>!
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
            <?php if (sizeof($comments) > 0) : ?>
                <table class="table table-striped"> 
                    <thead>
                        <th>Comment</th>
                        <th>Band</th>
                        <th>Date</th>
                        <th>Votes</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment): ?>
                            <tr id="<?= $comment['id']?>">
                                <td><?= $this->Html->link($comment['text'], ['controller' => 'bands', 'action' => 'view', $comment['band_id'], '#' => $comment['id']]) ?></td>
                                <td>
                                <?= $this->Html->link("Band " . $comment['band_id'], ['controller' => 'bands', 'action' => 'view', $comment['band_id']]) ?>
                                </td>
                                <td><?= date('n/j/Y g:i A',strtotime($comment['timestamp'])); ?></td>
                                <td>
                                    <?= $comment['votes'] ?>
                                </td>
                                <td>
                                    <?php if(!isset($comment['liked'])): ?>
                                        <?= $this->Html->link('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>', 
                                                                ['controller' => 'bands', 'action' => 'upvote', $comment['id'], $comment['band_id']], 
                                                                ['escape' => False]);
                                        ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                    <?= $this->Element('pagination'); ?>
                    </div>
                </div>
            <?php else: ?>
                <h4>No comments for this band yet!</h4>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
