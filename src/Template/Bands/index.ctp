<!-- File: src/Template/Bands/index.ctp -->
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
				<h1>View All Bands</h1>
				<p>Insert some instructions here.</p>
			</div>
		</div>
		<div class="row" style="margin-bottom: 15px; padding-left: 5px;">
			<?php foreach($bands as $band): ?>
				<div class="col-md-3 col-sm-3 outlined">
					<?= $this->Html->link("Band " . $band['id'], ['controller' => 'bands', 'action' => 'view', $band['id']],['class' => 'band']) ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->element('pagination'); ?>
			</div>
		</div>
	</div>
</div>
