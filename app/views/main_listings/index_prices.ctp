<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line = $code_listings[0]['MainListing'];
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($code_listings as $code_listing):		
$line = $code_listing['MainListing'];
echo $csv->addRow($line);
endforeach;
$filename='amazon_price_listings';
echo $csv->render($filename);
}else{	
?>
<?php echo $this->Session->flash(); ?>
 <hr>
<h1 class="sub-header"><?php __('Amazon Prices Listing');?> </h1>
<?php  echo $form->create('MainListing',array('action'=>'index_prices','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'main_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
              <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Amazon SKU...', 'class'=>'form-control pa-left')); ?>
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
          <th class="wid-200"><?php __('Category');?></th>
          <th class="wid-200"><?php __('Amazon sku');?></th>
          <th class="wid-200"><?php __('RRP(GBP)');?></th>
          <th><?php __('Amazon UK');?></th>
          <th><?php __('RRP(EUR)');?></th>
          <th><?php __('Amazon DE');?></th>
           <th><?php __('RRP(EUR)');?></th>
          <th><?php __('Amazon FR');?></th> 
          <th class="wid-70"><?php __('Action');?></th>      
        </tr>
      </thead>
      <tbody>
          <?php foreach ($code_listings as $code_listing): ?>
        <tr>
          <td><?php $productid = $code_listing['MainListing']['id']; echo $this->Form->input('MainListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
          <td><?php echo $code_listing['MainListing']['linnworks_code']; ?></td>
          <td><?php echo $code_listing['MainListing']['category']; ?></td>
          <td><?php echo $code_listing['MainListing']['amazon_sku']; ?></td>
          <td><?php echo $code_listing['MainListing']['price_uk']; ?></td>
          <td><?php echo $code_listing['MainListing']['sale_price_uk']; ?></td>
          <td><?php echo $code_listing['MainListing']['price_de']; ?></td>
          <td><?php echo $code_listing['MainListing']['sale_price_de']; ?></td>
          <td><?php echo $code_listing['MainListing']['price_fr']; ?></td>
          <td><?php echo $code_listing['MainListing']['sale_price_fr']; ?></td>
         <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'main_listings','action'=>'edit', $productid),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'main_listings','action' => 'delete',$productid), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $code_listing['MainListing']['amazon_sku']));  ?></td>
  
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