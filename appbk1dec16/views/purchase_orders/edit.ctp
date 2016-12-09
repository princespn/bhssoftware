<?php

if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
//$this->Session->setFlash(__('You are not authorized to access this area.', true));
}
?>
<?php echo $this->Form->create('PurchaseOrder');?>
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
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['PurchaseOrder']['id'])); ?>
                                  </div>
                                </div>        
                                <!--<div class="form-group">
                                  <label for="<?php __('PurchaseOrderSku');?>" class="col-sm-3 control-label"><?php __('SKU');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sku',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['PurchaseOrder']['sku'])); ?>
                                  </div>
                                </div>-->
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderLinnworksCode');?>" class="col-sm-3 control-label"><?php __('Linnworks code');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('linnworks_code',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['PurchaseOrder']['linnworks_code'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderProductName');?>" class="col-sm-3 control-label"><?php __('Product name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('product_name',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['PurchaseOrder']['product_name'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderCategory');?>" class="col-sm-3 control-label"><?php __('Category name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('category',array('label'=>'','class'=>'form-control','readonly'=>'readonly','value'=>$this->data['PurchaseOrder']['category'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderSupplier');?>" class="col-sm-3 control-label"><?php __('Supplier name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('supplier',array('label'=>'','class'=>'form-control','readonly'=>'readonly','value'=>$this->data['PurchaseOrder']['supplier'])); ?>
                                  </div>
                                </div>
                                 <!--<div class="form-group">
                                  <label for="<?php __('PurchaseOrderLatestInvoice');?>" class="col-sm-3 control-label"><?php __('Latest Invoice');?></label>
                                  <div class="col-sm-9">
                                       <?php //echo $this->Form->input('latest_invoice',array('label'=>'','class'=>'form-control','value'=>$this->data['PurchaseOrder']['latest_invoice'])); ?>
                                  </div>
                                </div>-->
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderPriceGbp');?>" class="col-sm-3 control-label"><?php __('GBP RRP Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_gbp',array('label'=>'','class'=>'form-control','value'=>$this->data['PurchaseOrder']['price_gbp'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('PurchaseOrderSalePriceGbp');?>" class="col-sm-3 control-label"><?php __('GBP Sale Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_gbp',array('label'=>'','class'=>'form-control','value'=>$this->data['PurchaseOrder']['sale_price_gbp'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('PurchaseOrderPriceEuro');?>" class="col-sm-3 control-label"><?php __('Euro RRP Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_euro',array('label'=>'','class'=>'form-control','value'=>$this->data['PurchaseOrder']['price_euro'])); ?>
                                  </div>
                                </div>
                               <div class="form-group">
                                  <label for="<?php __('PurchaseOrderSalePriceEuro');?>" class="col-sm-3 control-label"><?php __('Euro Sale Price');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_euro',array('label'=>'','class'=>'form-control','value'=>$this->data['PurchaseOrder']['sale_price_euro'])); ?>
                                  </div>
                                </div>
                               <?php $update = 'This Price update for sku'.$this->data['PurchaseOrder']['sku'];
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
