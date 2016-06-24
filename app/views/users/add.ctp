<?php 
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}
?>

<?php
echo $javascript->link('test.js');    
?>

<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
		<div style="float:right;"><?php echo $this->Form->button('Add New User', array('value'=>'Add New User','type'=>'submit')); ?></div>
		<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('new_password', array('type' => 'password','class'=>'text_main')); 
		echo $this->Form->input('confirm_password', array('type' => 'password','class'=>'text_main')); 
		$created_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('created_by',array('value'=>$created_by));	
		echo $this->Form->input('group_id');
		?>
		
	
	</fieldset>
<div class='submit'>
<?php 
echo $this->Form->button('Add New User', array('type'=>'submit'));
?>
</div>
<?php
echo $this->Form->end();?>
</div>

