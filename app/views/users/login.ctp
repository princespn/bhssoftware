<div class="login form">
 <?php echo $this->Form->create('User', array('action' => 'login')); ?> 
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end(__('Submit', true,array('class'=>'action')));?>
<?php echo $this->Form->end(); ?>
</div>

		
