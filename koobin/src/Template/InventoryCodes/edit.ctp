<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Form->create($inventoryCode) ?>
<h1 class="sub-header"><?=__('Edit Linnworks Code Information Data');?></h1>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?= __('Edit Linnworks code');?></div>
                          <div class="panel-body form-horizontal">
                                  
                                 <div class="form-group">
                                
                                  <div class="col-sm-9">
                                       <?php echo  $this->Form->control('linnworks_code',array('readonly'=>'readonly','class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo  $this->Form->control('product_name',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-9">
                                       <?php echo  $this->Form->control('category',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                
                              <div class="panel panel-default">
                                    <div class="panel-body">								
                                       <?= $this->Form->button('Update', array('type' => 'submit','class' =>'btn btn-info'));  ?>  
                                    </div>
                               </div>   
                         </div>
                 </div>
         </div>
</div>
<?= $this->Form->end();
