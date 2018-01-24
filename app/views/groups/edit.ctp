<?php 
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php echo $this->Session->flash(); ?>
<hr>
<h1 class="sub-header"><?php __('Edit group information'); ?></h1>
<?php 
if($session->read('Auth.User.group_id')!='4')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<hr>
 <?php echo $this->Session->flash(); ?>
  <div class="row">
<?php echo $this->Form->create('Group');?>
  <div class="col-lg-5 col-lg-offset-3">
  <div class="panel panel-info">
    <div class="panel-heading custom-panel-heading"></div>
    <div class="panel-body form-horizontal">
          <div class="form-group">
           <div class="col-sm-9">
            <?php echo $this->Form->input('id',array('type'=>'hidden','label'=>'','class'=>'form-control')); ?>
         </div>
          </div> 
          <div class="form-group">            
            <label for="GroupName" class="col-sm-3 control-label"><?php __('Groupname'); ?><span class="color-red">*</span></label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('name',array('label'=>'','class'=>'form-control')); ?>        
           </div>
          </div>       
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo $this->Form->button('Edt group', array('type' => 'submit','class' =>'btn btn-lg btn-primary btn-block btn-signin'));  ?>  
            
      </div>
    </div>    
  </div>  
<?php echo $this->Form->end();?>
</div>


