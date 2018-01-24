<?php
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php echo $this->Form->create('CostCalculator');?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('Edit Cost Calculator Price');?></h1>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?php __('Cost Calculator Price');?></div>
                          <div class="panel-body form-horizontal">
                                <div class="form-group">          
                                  <div class="col-sm-9">
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['CostCalculator']['id'])); ?>
                                  </div>
                                </div>        
                                <!--<div class="form-group">
                                  <label for="<?php __('CostCalculatorSku');?>" class="col-sm-3 control-label"><?php __('SKU');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sku',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['CostCalculator']['sku'])); ?>
                                  </div>
                                </div>-->
                                <div class="form-group">
                                  <label for="<?php __('CostCalculatorLinnworksCode');?>" class="col-sm-3 control-label"><?php __('Linnworks code');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('linnworks_code',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['CostCalculator']['linnworks_code'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('CostCalculatorProductName');?>" class="col-sm-3 control-label"><?php __('Product name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('product_name',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['CostCalculator']['product_name'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('CostCalculatorCategory');?>" class="col-sm-3 control-label"><?php __('Category name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('category',array('label'=>'','class'=>'form-control','readonly'=>'readonly','value'=>$this->data['CostCalculator']['category'])); ?>
                                  </div>
                                </div>
                                <!--<div class="form-group">
                                  <label for="<?php __('CostCalculatorSupplier');?>" class="col-sm-3 control-label"><?php __('Supplier name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('supplier',array('label'=>'','class'=>'form-control','readonly'=>'readonly','value'=>$this->data['CostCalculator']['supplier'])); ?>
                                  </div>
                                </div>
                                 <div class="form-group">
                                  <label for="<?php __('CostCalculatorLatestInvoice');?>" class="col-sm-3 control-label"><?php __('Latest Invoice');?></label>
                                  <div class="col-sm-9">
                                       <?php //echo $this->Form->input('latest_invoice',array('label'=>'','class'=>'form-control','value'=>$this->data['CostCalculator']['latest_invoice'])); ?>
                                  </div>
                                </div>-->
                                <div class="form-group">
                                  <label for="<?php __('CostCalculatorPriceGbp');?>" class="col-sm-3 control-label"><?php __('GBP RRP Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_gbp',array('label'=>'','class'=>'form-control','value'=>$this->data['CostCalculator']['price_gbp'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('CostCalculatorSalePriceGbp');?>" class="col-sm-3 control-label"><?php __('GBP Sale Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_gbp',array('label'=>'','class'=>'form-control','value'=>$this->data['CostCalculator']['sale_price_gbp'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('CostCalculatorPriceEuro');?>" class="col-sm-3 control-label"><?php __('Euro RRP Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_euro',array('label'=>'','class'=>'form-control','value'=>$this->data['CostCalculator']['price_euro'])); ?>
                                  </div>
                                </div>
                               <div class="form-group">
                                  <label for="<?php __('CostCalculatorSalePriceEuro');?>" class="col-sm-3 control-label"><?php __('Euro Sale Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_euro',array('label'=>'','class'=>'form-control','value'=>$this->data['CostCalculator']['sale_price_euro'])); ?>
                                  </div>
                                </div>
                               <?php $update = 'This Price update for sku'.$this->data['CostCalculator']['sku'];
                                echo $this->Form->hidden('error',array('value'=>$update));	
                         
                                ?>

                              <div class="panel panel-default">
                                    <div class="panel-body">
                                      <?php echo $this->Form->button('Update', array('type' => 'submit','class' =>'btn btn-info'));  ?>  
                                    </div>
                               </div>   
                         </div>
                 </div>
         </div>
</div>
<?php echo $this->Form->end();
