<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $german_product_listings[0]['GermanProductListing'];	
$csv->addRow(array_keys($line));
foreach ($german_product_listings as $german_product_listing){		
$line = $german_product_listing['GermanProductListing'];
echo $csv->addRow($line);
}
$filename='german_product_listings';
echo $csv->render($filename);
}else{	
?>
<?php  echo $form->create('GermanProductListing',array('action'=>'index','id'=>'saveForm')); ?>
 <h1 class="sub-header"><?php __('DE Product Code Database.');?></h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'german_product_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
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
     <?php foreach ($german_product_listings as $german_product_listing): ?>
        <tr>         
          <td><?php $productid = $german_product_listing['GermanProductListing']['id']; echo $this->Form->input('GermanProductListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
          <td><?php echo $german_product_listing['GermanProductListing']['product_code']; ?></td>
          <td><?php echo $german_product_listing['GermanProductListing']['product_sku']; ?></td>
          <td><?php echo $german_product_listing['GermanProductListing']['web_sku']; ?></td>
          <td><?php echo $german_product_listing['GermanProductListing']['product_asin']; ?></td>
          <td><?php echo $german_product_listing['GermanProductListing']['category']; ?></td>
           <td><?php echo $german_product_listing['GermanProductListing']['fulfillmentchannel']; ?></td>
          
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


<?php } ?>