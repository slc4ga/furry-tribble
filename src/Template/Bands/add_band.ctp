<!-- File: src/Template/Bands/view.ctp -->
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
				<h1>Add New Band</h1>
				<p>Insert some instructions here.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3">
				<?= $this->Form->create() ?>
		        <?php
		            echo $this->Form->input('qr_code', [
		                    'class' => 'form-control',
		                    'type' => 'number',
		                    'label' => 'Band ID'
		                ]
		            );
		        ?>
				<?= $this->Form->button(__('Add Band'), ['class' => 'btn btn-success']); ?>
				<?= $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
