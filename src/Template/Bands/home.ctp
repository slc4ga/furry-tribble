<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Find Your Band</h1>
				<p>Enter the number found on your band into the box below -

					Once your code is processed, you will be allowed to enter a comment for your specific band.
				</p>
				<div class="row">
					<div class="col-md-4">
						<?= $this->Form->create(null); ?>

						<?php
				            echo $this->Form->input('band_id', [
				                    'class' => 'form-control',
				                    'type' => 'number',
				                    'label' => 'Band ID'
				                ]
				            );
				        ?>

				        <?= $this->Form->button(__('Find Band'), ['class' => 'btn btn-success']); ?>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 col-sm-12">

			</div>
		</div>
	</div>
</div>