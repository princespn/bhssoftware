<?php
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));

}
?>
<?php echo $this->Form->create('Listing');?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('Edit Website price listings');?></h1>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?php __('Edit Listings');?></div>
                          <div class="panel-body form-horizontal">
                                <div class="form-group">          
                                  <div class="col-sm-9">
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['Listing']['id'])); ?>
                                  </div>
                                </div>        
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSku');?>" class="col-sm-3 control-label"><?php __('Website SKU');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sku',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['Listing']['web_sku'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingLinnworksCode');?>" class="col-sm-3 control-label"><?php __('Linnworks code');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('linnworks_code',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['linnworks_code'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebPriceUk');?>" class="col-sm-3 control-label"><?php __('Price Uk');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_price_uk',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_price_uk'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSalePriceUk');?>" class="col-sm-3 control-label"><?php __('Sale Price UK');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sale_price_uk',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_sale_price_uk'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebPriceFr');?>" class="col-sm-3 control-label"><?php __('Price FR');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_price_fr',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_price_fr'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSalePriceFr');?>" class="col-sm-3 control-label"><?php __('Sale Price FR');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sale_price_fr',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_sale_price_fr'])); ?>
                                  </div>
                                </div>
                               <div class="form-group">
                                  <label for="<?php __('ListingWebPriceDe');?>" class="col-sm-3 control-label"><?php __('Price DE');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_price_de',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_price_de'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSalePriceDe');?>" class="col-sm-3 control-label"><?php __('Sale Price DE');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sale_price_de',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_sale_price_de'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('ListingWebPriceDm');?>" class="col-sm-3 control-label"><?php __('Price DM');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_price_dm',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_price_dm'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSalePriceDm');?>" class="col-sm-3 control-label"><?php __('Sale Price DM');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sale_price_dm',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_sale_price_dm'])); ?>
                                  </div>
                                </div>
                              <div class="form-group">
                                  <label for="<?php __('ListingWebPriceTesco');?>" class="col-sm-3 control-label"><?php __('Price Tesco');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_price_tesco',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_price_tesco'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('ListingWebSalePriceTesco');?>" class="col-sm-3 control-label"><?php __('Sale Price Tesco');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('web_sale_price_tesco',array('label'=>'','class'=>'form-control','value'=>$this->data['Listing']['web_sale_price_tesco'])); ?>
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
