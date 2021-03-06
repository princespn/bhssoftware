<?php
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $price_listings[0]['Listing'];	
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($price_listings as $price_listing){		
$line = $price_listing['Listing'];
echo $csv->addRow($line);
}
$filename='prices_listings';
echo $csv->render($filename);
}else{	
?>
<?php echo $this->Session->flash(); ?>
 <hr>
<h1 class="sub-header"><?php __('Website Price Listing');?> </h1>
<?php  echo $form->create('Listing',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
              <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Web SKU...', 'class'=>'form-control pa-left')); ?>
                <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th class="wid-20"><input type="checkbox" id="selecctall"/></th>
          <th class="wid-200"><?php __('Linnworks code');?></th>
           <th><?php __('Amazon sku');?></th>
          <th class="wid-200"><?php __('Category');?></th>
          <th><?php __('Web sku');?></th>
          <th><?php __('RRP(GBP)');?></th>
          <th><?php __('Web UK');?></th>
          <th><?php __('RRP(EUR)');?></th>
          <th><?php __('Web DE');?></th>
           <th><?php __('RRP(EUR)');?></th>
          <th><?php __('Web FR');?></th>          
          <th><?php __('Tesco');?></th>
          <th><?php __('RRP(GBP)');?></th>
          <th><?php __('Daily Mail');?></th>
         <?php if($session->read('Auth.User.group_id')!='3') { ?><th class="wid-70"><?php __('Action');?></th><?php } ?>
        </tr>
      </thead>
      <tbody>
     <?php foreach ($price_listings as $price_listing): ?>
        <tr>
          <td><?php $productid = $price_listing['Listing']['id']; echo $this->Form->input('Listing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
          <td><?php echo $price_listing['Listing']['linnworks_code']; ?></td>
          <td><?php echo $price_listing['MainListing']['amazon_sku']; ?></td>
          <td><?php echo $price_listing['InventoryCode']['category']; ?></td>
          <td><?php echo $price_listing['Listing']['web_sku']; ?></td>
          <td><?php echo $price_listing['Listing']['web_price_uk']; ?></td>
          <td><?php echo $price_listing['Listing']['web_sale_price_uk']; ?></td>
          <td><?php echo $price_listing['Listing']['web_price_de']; ?></td>
          <td><?php echo $price_listing['Listing']['web_sale_price_de']; ?></td>
          <td><?php echo $price_listing['Listing']['web_price_fr']; ?></td>
          <td><?php echo $price_listing['Listing']['web_sale_price_fr']; ?></td>          
           <td><?php echo $price_listing['Listing']['web_sale_price_tesco']; ?></td>
           <td><?php echo $price_listing['Listing']['web_price_dm']; ?></td>
           <td><?php echo $price_listing['Listing']['web_sale_price_dm']; ?></td>
    <?php if($session->read('Auth.User.group_id')!='3') { ?>
          <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'listings','action'=>'edit', $productid),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'listings','action' => 'delete',$productid), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $price_listing['Listing']['web_sku']));  ?></td><?php } ?>
         </tr>        
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php echo $this->Form->end();?>
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
    document.getElementById("ListingCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/listings/category/" + selectedOption;
    }
</script>
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