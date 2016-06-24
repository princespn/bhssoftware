<?php 
if($session->read('Auth.User.group_id')!='7' && $session->read('Auth.User.group_id')!='6' && $session->read('Auth.User.group_id')!='5' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='3')

{

$this->requestAction('/users/logout/', array('return'));


}
?>
<div class="menus form">
<?php echo $this->Form->create('Menu');?>
    <fieldset>
        <legend><?php __('Add Menu Item'); ?></legend>
<?php
    echo $this->Form->input('name');
    echo $this->Form->input('controller');
    echo $this->Form->input('action');
?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true));?>
</div> 
<?php echo $this->element('admin_sidebar'); ?> 
