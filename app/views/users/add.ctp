<?php 
if($session->read('Auth.User.group_id')!='4')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
echo $javascript->link('test.js');    
?>

<?php echo $this->Session->flash(); ?>
<hr>
<h1 class="sub-header"><?php __('Add new user information'); ?></h1>
  <hr>
 <?php echo $this->Session->flash(); ?>
  <div class="row">
<?php echo $this->Form->create('User');?>
  <div class="col-lg-5 col-lg-offset-3">
  <div class="panel panel-info">
    <div class="panel-heading custom-panel-heading"></div>
    <div class="panel-body form-horizontal">
          <div class="form-group">
            <label for="UserUsername" class="col-sm-3 control-label"><?php __('Username'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('username',array('label'=>'','class'=>'form-control')); ?>
        
           </div>
          </div>        
          <div class="form-group">
            <label for="UserEmail" class="col-sm-3 control-label"><?php __('Email Address'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('email',array('label'=>'','class'=>'form-control')); ?>
         </div>
          </div>
          <div class="form-group">
            <label for="UserNewPassword" class="col-sm-3 control-label"><?php __('New Password'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
            	<?php echo $this->Form->input('new_password',array('label'=>'','type' => 'password','class'=>'form-control')); ?>
           </div>
          </div>
          <div class="form-group">
            <label for="UserConfirmPassword" class="col-sm-3 control-label"><?php __('Confirm Password'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
              <?php echo $this->Form->input('confirm_password',array('label'=>'','type' => 'password','class'=>'form-control')); ?>
          </div>
          </div>
          <div class="form-group">
            <label for="UserGroupId" class="col-sm-3 control-label"><?php __('Group'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
            	 <?php $created_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('created_by',array('value'=>$created_by));	
		echo $this->Form->input('group_id',array('label'=>'','class'=>'form-control'));
		?>
            </div>
          </div>
        
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo $this->Form->button('Add new user', array('type' => 'submit','class' =>'btn btn-lg btn-primary btn-block btn-signin'));  ?>  
            
      </div>
    </div>    
  </div>  
<?php echo $this->Form->end();?>
</div>

