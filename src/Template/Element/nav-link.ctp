<li <?php if($this->request->controller == $controller && $this->request->action == $action) { echo 'class=\'active\''; }?> >
    <?=
	    $this->Html->link(
	        $linkText,
	        ['controller' => $controller, 'action' => $action]
	    )
    ?>
</li>