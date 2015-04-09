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
				<div class="alert alert-info" role="alert">
					<strong> Welcome to the bands site!</strong> 
					Our github repo is a Star Trek reference, according to Dean Groves.
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Top Comments</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
			<?php if (sizeof($commentVotes) > 0) : ?>
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
						<?php foreach ($commentVotes as $comment): ?>
							<tr>
								<td><?= $comment['comment']['text']?></td>
								<?php if($admin): ?>
									<td><?= $comment['comment']['username'] ?></td>
								<?php endif; ?>
								<td><?= date('n/j/Y g:i A',strtotime($comment['comment']['timestamp'])); ?></td>
								<td>
									<?= $comment['count'] ?>
								</td>
								<td>
									<?php if(!isset($comment['liked'])): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'upvote', $comment['comment']['band_id']], 
																['escape' => False]);
										?>
									<?php endif; ?>
									<?php if($comment['flagged'] == 0): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'flag', $comment['id'], $comment['comment']['band_id']], 
																['escape' => False]);
										?>
										&nbsp;
									<?php endif; ?>
									<?php if($admin): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'delete', $comment['id'], $comment['comment']['band_id']], 
																['escape' => False, 'confirm' => 'Are you sure you wish to delete this comment?']);
										?>
										&nbsp;
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<h4>No comments yet!</h4>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
