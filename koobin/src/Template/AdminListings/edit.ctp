<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Form->create($adminListing) ?>
<h1 class="sub-header"><?=__('Edit Master Website price listings');?></h1>
<hr>
<div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?php __('Edit Listings');?></div>
                          <div class="panel-body form-horizontal">
                                <div class="form-group">          
                                  <div class="col-sm-9">
                                  <?= $this->Form->hidden('id');?>
                                  </div>
                                </div>        
                                <div class="form-group">
                                 <div class="col-sm-9">
                                       <?= $this->Form->control('web_sku',array('readonly'=>'readonly','class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                 <div class="col-sm-9">
                                       <?php echo $this->Form->control('linnworks_code',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_price_uk',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_sale_price_uk',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_price_fr',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_sale_price_fr',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                               <div class="form-group">
                                 <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_price_de',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                               <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_sale_price_de',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_price_dm',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                 <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_sale_price_dm',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                 <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_price_tesco',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-9">
                                       <?php echo $this->Form->control('web_sale_price_tesco',array('class'=>'form-control')); ?>
                                  </div>
                                </div>
                              <div class="panel panel-default">
                                    <div class="panel-body">
                                      <?php echo $this->Form->button('Update', array('type' => 'submit','class' =>'btn btn-info'));  ?>  
                                    </div>
                               </div>   
                         </div>
                 </div>
         </div>
</div>
 <?= $this->Form->end() ?>
