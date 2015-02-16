
<?php

	$myTemplates = [
			    'message' => '<div class="alert alert-warning">{{content}}</div>'
			];
			$this->Form->templates($myTemplates);
	echo $this->Form->create('login');

	echo $this->Form->input('email', array(
				'type' => 'email',
				'label' => ['class' => 'hidden'],
				'div' => 'form-group',
				'placeholder' => 'Email',
				'class' => 'form-control'
			));
	echo $this->Form->input('password', array(
				'div' => 'form-group',
				'label' => ['class' => 'hidden'],
				'placeholder' => 'Password',
				'class' => 'form-control'
			));
	echo $this->Form->button(__('Login'), array(
				'div' => 'form-group',
				'class' => 'btn btn-primary'
			));
	echo $this->Form->end();
	// echo "<hr>";
?>
<!-- <p style="text-align:center">
    <?=
    $this->Html->link('Forgot your password?',
        ['controller' => 'Users', 'action' => 'reset_password']
    )
    ?>
</p> -->
<!-- <p style="text-align:center">
    Don't have an account?
    <?=
        $this->Html->link('Sign Up Here!',
            ['controller' => 'Users', 'action' => 'signup']
        )
    ?>
</p> -->
