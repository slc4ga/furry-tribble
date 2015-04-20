<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Band <?= $band_id ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
			<?php if (sizeof($comments) > 0) : ?>
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
						<?php foreach ($comments as $comment): ?>
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
									<?php if(!isset($comment['liked'])): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'upvote', $comment['id'], $band_id], 
																['escape' => False]);
										?>
										&nbsp;
									<?php endif; ?>
									<?php if($comment['flagged'] == 0): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'flag', $comment['id'], $band_id], 
																['escape' => False]);
										?>
										&nbsp;
									<?php endif; ?>
									<?php if($admin): ?>
										<?= $this->Html->link('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 
																['controller' => 'bands', 'action' => 'delete', $comment['id'], $band_id], 
																['escape' => False, 'confirm' => 'Are you sure you wish to delete this comment?']);
										?>
										&nbsp;
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
