 <?php echo $this->Session->flash(); ?>
<div class="container">
        <div class="card card-container">
            <?php echo $this->Html->image('avatar_2x.png', array('class' => 'profile-img-card')); ?>
              <?php echo $this->Form->create('User', array('action' => 'login',array('class'=>'form-signin'))); ?> 
              <?php echo $this->Form->input('username',array('label'=>'','class'=>'form-control','placeholder'=>'User name is required.')); ?>
               <?php echo $this->Form->input('password',array('label'=>'','class'=>'form-control','placeholder'=>'Password is required.')); ?>
             <?php echo $this->Form->button('Sign in', array('type' => 'submit','class' =>'btn btn-lg btn-primary btn-block btn-signin'));  ?>  
            <?php echo $this->Form->end(); ?>
        </div><!-- /card-container -->
</div><!-- /container -->
