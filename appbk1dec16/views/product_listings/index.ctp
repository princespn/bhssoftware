<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $product_listings[0]['ProductListing'];	
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($product_listings as $product_listing){		
$line = $product_listing['ProductListing'];
echo $csv->addRow($line);
}
$filename='product_listings';
echo $csv->render($filename);
}else{	
?>
<?php  echo $form->create('ProductListing',array('action'=>'index','id'=>'saveForm')); ?>
 <h1 class="sub-header"><?php __('UK Product Code Database.');?></h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'product_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
         <?php echo $this->Form->button('Export Data', array('id'=>'exportfile','disabled'=>'disabled','value'=>'exports','name'=>'exports','type'=>'submit','class'=>'btn btn-primary btn-sm')); ?>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
                     <?php  echo $this->Form->input('all_item',array('label'=>false,'class'=>'form-control pa-left','placeholder'=>'Search Linnworks Code, Amazon Sku, Amazon Asin...'));  ?>
          
              <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th><input type="checkbox" id="selecctall"/></th>
          <th class="wid-200"><?php __('Linnworks Code');?></th>
          <th class="wid-400"><?php __('Amazon SKU');?></th>
          <th class="wid-200"><?php __('Web SKU');?></th>
          <th class="wid-200"><?php __('Amazon Asin');?></th>
          <th><?php __('Category');?></th>  
           <th><?php __('fulfillment channel');?></th>  
          <!--<th class="wid-20"><?php __('Action');?></th>-->
        </tr>
      </thead>
      <tbody>
     <?php foreach ($product_listings as $product_listing): ?>
        <tr>         
          <td><?php $productid = $product_listing['ProductListing']['id']; echo $this->Form->input('ProductListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
          <td><?php echo $product_listing['ProductListing']['product_code']; ?></td>
          <td><?php echo $product_listing['ProductListing']['product_sku']; ?></td>
          <td><?php echo $product_listing['ProductListing']['web_sku']; ?></td>
          <td><?php echo $product_listing['ProductListing']['product_asin']; ?></td>
          <td><?php echo $product_listing['ProductListing']['category']; ?></td>
           <td><?php echo $product_listing['ProductListing']['fulfillmentchannel']; ?></td>
          
           <!--<?php if(!empty($data->BarcodeNumber)){$sid=$data->BarcodeNumber;}else{$sid=$data->ItemNumber;} ?>				   
         <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'stocks','action'=>'update',$data->StockItemId,$sid),array('class'=> 'edit-btn','escape'=>false)); ?></td>-->
       
        </tr>  
        <?php endforeach; ?>   
          
      </tbody>
    </table>
  </div>
  <?php echo $this->Form->end(); ?>
 <hr>
 <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
 <nav>
     <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
     </ul>
 </nav> 
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
                $('#exportfile').removeAttr('disabled');
		
            });
		
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"   
                 $('#exportfile').attr("disabled", "disabled");
				
            });			
        }
    });
   
});
</script>
<?php } 
