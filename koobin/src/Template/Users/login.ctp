<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="container">
        <div class="card card-container">
            <?php echo $this->Html->image('avatar_2x.png', array('class' => 'profile-img-card')); ?>            
            <?= $this->Form->create() ?>
               <?= $this->Form->control('username',array('label'=>'','class'=>'form-control','placeholder'=>'User name is required.')); ?>
               <?= $this->Form->control('password',array('label'=>'','class'=>'form-control','placeholder'=>'Password is required.')); ?>
             <?= $this->Form->button('Sign in', array('type' => 'submit','class' =>'btn btn-lg btn-primary btn-block btn-signin'));  ?>  
            <?= $this->Form->end() ?>
        </div><!-- /card-container -->
</div>
