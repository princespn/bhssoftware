<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php // echo $this->Session->flash(); ?>

<h1 class="sub-header"><?php echo  'Update user information'; ?></h1>
  <hr>
 <?php // echo $this->Session->flash(); ?>
  <div class="row">
 <?= $this->Form->create($user) ?>
  <div class="col-lg-5 col-lg-offset-3">
  <div class="panel panel-info">
    <div class="panel-heading custom-panel-heading"></div>
    <div class="panel-body form-horizontal">
          <div class="form-group">
            <label for="UserUsername" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
            <?php echo $this->Form->control('username',array('class'=>'form-control')); ?>
        
           </div>
          </div>        
          <div class="form-group">
            <label for="UserEmail" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
               <?php echo $this->Form->control('email',array('class'=>'form-control')); ?>
         </div>
          </div>
          <div class="form-group">
            <label for="UserPassword" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
            	<?php echo $this->Form->control('new_password',array('type' => 'password','class'=>'form-control')); ?>
           </div>
          </div>
          <div class="form-group">
            <label for="UserConfirmPassword" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
              <?php echo $this->Form->control('confirm_password',array('type' => 'password','class'=>'form-control')); ?>
          </div>
          </div>
          <div class="form-group">
            <label for="UserGroupId" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
            	  <?= $this->Form->control('role', ['class'=>'form-control',
            'options' => ['supperadmin' => 'Supperadmin' ,'admin' => 'Admin', 'author' => 'Author']
        ]) ?>
            </div>
          </div>
        
      </div>
    </div>  
    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo $this->Form->button('Update user', array('type' => 'submit','class' =>'btn btn-lg btn-primary btn-block btn-signin'));  ?>  
            
      </div>
    </div>    
  </div>  
<?php echo $this->Form->end();?>
</div>
