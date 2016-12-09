<?php

if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
//$this->Session->setFlash(__('You are not authorized to access this area.', true));
}
?>
<?php echo $this->Form->create('MasterListing');?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('Edit Master Amazon price listings');?></h1>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?php __('Edit Master Listing');?></div>
                          <div class="panel-body form-horizontal">
                                <div class="form-group">          
                                  <div class="col-sm-9">
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['MasterListing']['id'])); ?>
                                  </div>
                                </div>        
                                <div class="form-group">
                                  <label for="<?php __('MasterListingAmazonSku');?>" class="col-sm-3 control-label"><?php __('Amazon SKU');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('amazon_sku',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['MasterListing']['amazon_sku'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingLinnworksCode');?>" class="col-sm-3 control-label"><?php __('Linnworks code');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('linnworks_code',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['linnworks_code'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingProductName');?>" class="col-sm-3 control-label"><?php __('Product name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('product_name',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['product_name'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingCategory');?>" class="col-sm-3 control-label"><?php __('Category name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('category',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['category'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingPriceUk');?>" class="col-sm-3 control-label"><?php __('Price UK');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_uk',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['price_uk'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceUk');?>" class="col-sm-3 control-label"><?php __('Sale Price UK');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_uk',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['sale_price_uk'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceUk');?>" class="col-sm-3 control-label"><?php __('Prime Price UK');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('prime_price_uk',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['prime_price_uk'])); ?>
                                  </div>
                                </div>
                               <div class="form-group">
                                  <label for="<?php __('MasterListingPriceFr');?>" class="col-sm-3 control-label"><?php __('Price FR');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_fr',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['price_fr'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceFr');?>" class="col-sm-3 control-label"><?php __('Sale Price FR');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_fr',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['sale_price_fr'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceFr');?>" class="col-sm-3 control-label"><?php __('Prime Price FR');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('prime_price_fr',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['prime_price_fr'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('MasterListingPriceDe');?>" class="col-sm-3 control-label"><?php __('Price DE');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('price_de',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['price_de'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceDe');?>" class="col-sm-3 control-label"><?php __('Sale Price DE');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('sale_price_de',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['sale_price_de'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('MasterListingSalePriceDe');?>" class="col-sm-3 control-label"><?php __('Prime Price DE');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('prime_price_de',array('label'=>'','class'=>'form-control','value'=>$this->data['MasterListing']['prime_price_de'])); ?>
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
  <?php echo $this->Form->end();
