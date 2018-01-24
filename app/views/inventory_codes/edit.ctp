<?php
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php echo $this->Form->create('InventoryCode');?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('Edit Edit Linnworks Code Information Data');?></h1>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
                        <div class="panel panel-info">
                          <div class="panel-heading custom-panel-heading"><?php __('Edit Linnworks code');?></div>
                          <div class="panel-body form-horizontal">
                                <div class="form-group">          
                                  <div class="col-sm-9">
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['InventoryCode']['id'])); ?>
                                  </div>
                                </div>        
                                 <div class="form-group">
                                  <label for="<?php __('InventoryCodeLinnworksCode');?>" class="col-sm-3 control-label"><?php __('Linnworks code');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('linnworks_code',array('label'=>'','readonly'=>'readonly','class'=>'form-control','value'=>$this->data['InventoryCode']['linnworks_code'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('InventoryCodeProductName');?>" class="col-sm-3 control-label"><?php __('Product name');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('product_name',array('label'=>'','class'=>'form-control','value'=>$this->data['InventoryCode']['product_name'])); ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="<?php __('InventoryCodeCategory');?>" class="col-sm-3 control-label"><?php __('Category');?></label>
                                  <div class="col-sm-9">
                                       <?php echo $this->Form->input('category',array('label'=>'','class'=>'form-control','value'=>$this->data['InventoryCode']['category'])); ?>
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
