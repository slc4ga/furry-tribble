<!-- File: src/Template/Bands/view.ctp -->
<div cl
<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Band <?= $band_id ?></h1>
				<p>Insert some instructions here.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?= $this->Form->create(null, ['action' => 'saveComment']) ?>
		        <?php
		            echo $this->Form->textarea('text', [
		                    'class' => 'form-control',
		                    'rows' => 6
		                ]
		            );

		            echo $this->Form->hidden('band_id', ['value' => $band_id]);
		        ?>
				<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg']); ?>
				<?= $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
