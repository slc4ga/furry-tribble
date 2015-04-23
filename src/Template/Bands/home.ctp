<div class="row">
	<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
		<div class="row">
			<div class="col-md-12 col-sm-12">
			<h1>Welcome to the <strong>Internet of Altruism</strong> website!

			<h3>Our Purpose:</h3>

			<p>
				To recognize and encourage good deeds throughout the University of Virginia. We all witness acts of kindness every day, and it is time that we recognize these small acts. Whether it’s walking a friend home late at night or holding the door open for a stranger, all of these good deeds deserve to be recognized and remembers. Let’s show the world the best of the University of Virginia!
			</p>

			<h3>How Does it Work?</h3>
			<p>
				The Internet of Altruism has a series of uniquely numbered wristbands circulating throughout the school. If you have a wristband and witness an act of kindness committed by another student you simply give them the wristband and tell them what it was that you saw them do to deserve it. It’s that simple! If you receive a wristband you simply go to this website and enter in the band ID number that is unique to the wristband your received. This will take you to a page to enter what you did to receive the band. 
			</p>
			<p>
				Once you anonymously submit your story you will be able to see every good deed that band has been given out for in the past and where it travels in the future. You can like comments submitted by other students, see the most popular good deeds from students at the University, and much more! Keep an eye out for the Internet of Altruism wristbands around the school. Together we can build a more positive community.
			</p>
			<hr>
				<h2>Find Your Band</h2>
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