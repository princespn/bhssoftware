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
$filename='prices_listings';
echo $csv->render($filename);
}else{	
?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="product_listing index">
    <div class="grid_16">
        <h2 id="page-heading"><?php __('Compare Prices Database');?><div style="float:right"><?php echo $this->Html->link(__('Import compare Prices', true), array('controller' => 'product_listings', 'action' => 'import_prices')); ?></div></h2>
        <table cellpadding="0" cellspacing="0">
<?php  echo $form->create('ProductListing',array('action'=>'compare_prices','id'=>'saveForm')); ?>
            <tr style="color:#ffffff;">
                <th colspan="3"></th>
                <th colspan="5"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Amazon Sku...','class'=>'export_box')); ?></th>
                <th colspan="3"></th>
            </tr>
            <tr style="background:#666666;color:#ffffff;">				
                <th><input type="checkbox" id="selecctall"/></th>
                <th><?php __('Linnworks Code');?></th>               
                <th><?php __('Category');?></th>
                <th><?php __('RRP(GBP)');?></th> 
                <th><?php __('Web UK');?></th> 
                 <th><?php __('Tesco');?></th> 
                <th><?php __('Amazon UK');?></th>               
                <th><?php __('Amazon DE');?></th>              
                <th><?php __('Amazon FR');?></th>                  
                <th><div style="float:right"><div style="margin: 3px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
            </tr>
<?php 
$i = 0;
foreach ($product_listings as $product_listing):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
?>
            <tr<?php echo $class;?>>
                <td><?php	
$productid = $product_listing['ProductListing']['id'];
echo $this->Form->input('ProductListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
                <td><?php echo $product_listing['ProductListing']['product_code']; ?></td>               	
                <td><?php echo $product_listing['ProductListing']['category']; ?></td>	
                <td><?php /* price */ echo $product_listing['ProductListing']['price']; ?></td>
                <td><?php /* sale_price */  echo $product_listing['ProductListing']['sale_price']; ?></td>              
                <td><?php echo $product_listing['ProductListing']['Tesco']; ?></td> 
                  <td><?php echo $product_listing['ProductListing']['Amazon_UK']; ?></td>
                <td><?php echo $product_listing['ProductListing']['Amazon_FR']; ?></td>
                <td><?php echo $product_listing['ProductListing']['Amazon_DE']; ?></td>               
                <td></td>
            
          </tr>
<?php endforeach; ?>
<?php echo $this->Form->end();?>
        </table>
        <div class="paging">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></div><div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
            | 	<?php echo $this->Paginator->numbers();?>
            |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
// bind change event to select
        $('#product_listingsid').live('click', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
<script type="text/javascript">
    document.getElementById("ProductListingCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/product_listings/category/" + selectedOption;
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
				 $('div.btnClick').show();
				 $('#InventoryMasterError').attr('disabled','disabled');
            });
			 $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
				 $('div.btnClick').show();
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				$('div.btnClick').hide();
				$('#InventoryMasterError').removeAttr('disabled','disabled');
            }); 
			$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				$('div.btnClick').hide();
            }); 
        }
    });
   
});
</script>
<?php } ?>
