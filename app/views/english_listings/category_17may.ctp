<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $english_listings[0]['EnglishListing'];	
$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($english_listings as $english_listing){		
$line = $english_listing['EnglishListing'];
echo $csv->addRow($line);
}
$filename='english_listings';
echo $csv->render($filename);
}else{	
?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="english_listings index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Amazon UK Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('EnglishListing',array('action'=>'index','id'=>'saveForm')); ?>
<tr style="color:#ffffff;">
<th colspan="3"></th>
<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
<th colspan="6"></th>
</tr>
<tr style="background:#666666;color:#ffffff;">				
<th><input type="checkbox" id="selecctall"/></th>
<th><?php __('Image');?></th>
<th><?php __('Product Code');?></th>
<th><?php __('SKU');?></th>
<th style="width:30px;"><?php __('Category');?>
<select id="InventoryMasterCategory" name="data[InventoryMaster][category]">
<option value=''>&nbsp;&nbsp;</option>
<?php $option = $this->requestAction('/english_listings/categoriesPro'); //echo $this->Form->select('category',array($option)); 
foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';}
echo '<option'.' '.$select.' '.'value='.$option.'>'.$option.'</option>';
}?></select></th>                    
<th><?php __('Browse nodes');?></th>
<th><?php __('Product name');?></th>
<th><?php __('Available');?></th>
<th><?php __('Price');?></th>
<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>

</tr>

<?php
$i = 0;
foreach ($english_listings as $english_listing):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
?>
<tr<?php echo $class;?>>


<td><?php	
$productid = $english_listing['EnglishListing']['id'];
echo $this->Form->input('EnglishListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
<td class="checkbox"><?php  if(!empty($english_listing['EnglishListing']['main_image_url'])){	echo "<img width='70px' src=".$english_listing['EnglishListing']['main_image_url'].">";
}else { echo '<img width=70px src=/img/images.png>';	}?></td>
<td><?php echo $english_listing['EnglishListing']['product_code']; ?></td>
<td><?php echo $english_listing['EnglishListing']['item_sku']; ?></td>
<td><?php echo $english_listing['InventoryMaster']['category']; ?></td>
<td><?php if(($english_listing['EnglishListing']['recommended_browse_nodes1'])!=($english_listing['EnglishListing']['recommended_browse_nodes1']))
{echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";
}else{echo $english_listing['EnglishListing']['recommended_browse_nodes1'];} ?></td>
<td><?php 
if(!empty($english_listing['EnglishListing']['item_name']))
{
$row1 = $english_listing['EnglishListing']['item_name'];
//$keyword = $english_listing['EnglishListing']['generic_keywords1'].$english_listing['EnglishListing']['generic_keywords2'].$english_listing['EnglishListing']['generic_keywords3'].$english_listing['EnglishListing']['generic_keywords4'].$english_listing['EnglishListing']['generic_keywords5'].$english_listing['InventoryMaster']['keyword'].','.$english_listing['InventoryMaster']['category'];
$keyword = $english_listing['EnglishListing']['generic_keywords1'].$english_listing['EnglishListing']['generic_keywords2'].$english_listing['EnglishListing']['generic_keywords3'].$english_listing['EnglishListing']['generic_keywords4'].$english_listing['EnglishListing']['generic_keywords5'];
$item = strlen($row1); 
if($item >= '500'){
echo "<div style='color:red;'>The Title must be no long 500 characters.</div>";

}else {
$percentage = 0;
$keyword = similar_text($row1,$keyword,$percentage);
$itemname = utf8_encode(substr($row1,0,50)); 
    echo ($itemname);
    echo "</BR>";
    printf("<div style='color:red;'>The Title has %d percent Keyword.</div>", $percentage);

}

}else{
echo "<div style='color:red;'>The Title is required</div>";
}?></td>
<td class="checkbox"><?php echo $english_listing['EnglishListing']['quantity']; ?></td>	
<td class="checkbox"><?php 
$stanprice = $english_listing['EnglishListing']['standard_price'];
$saleprice = $english_listing['EnglishListing']['standard_price'];
if(empty($stanprice))
{
	echo "<span style='color:red;' title='Standard Price is Required.'>Standard Price is Required</span>";
}
else if((!empty($stanprice))&&(!empty($saleprice))&&(abs($stanprice))!=(abs($saleprice)))
{
	echo "<span style='color:red;' title='Standard Price is did not match master database.'>Standard Price is did not match master database.</span>";
}
else
{
	$pric = $english_listing['EnglishListing']['error'];
	$pieces = explode(":", $pric);
	if((!empty($pieces[1])) && ($pieces[1] == 'Standard Price did not match.'))
	{

	if(!empty($pieces[1]))
		{
	echo "<span style='color:red;' title='Standard Price did not match.'>$stanprice</span>";
		}
	}
	else
	{
	echo $stanprice;
	}
}
?></td>	
<td class="actions">
<?php  
// echo $this->Form->input('', array('onchange'=>'myFunction()','label' => '','options' => array($english_listing['EnglishListing']['id'] => 'Edit')));
// echo $this->Html->link(__('Edit', true), array('action' => 'edit', $english_listing['EnglishListing']['id'])); ?>
<?php // echo $this->Html->link(__('Delete', true), array('action' => 'delete', $english_listing['EnglishListing']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $english_listing['EnglishListing']['item_sku'])); ?>
<?php 
$size = array(''=>'Select','/english_listings/edit/'.$english_listing['EnglishListing']['item_sku']=>'Edit','/english_listings/delete/'.$english_listing['EnglishListing']['id']=>'Delete');

echo $this->Form->input('', array('id'=>'english_listingsid','type'=>'select','label' => '','options' =>$size));
?>
</td>
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
$(document).ready( function() {
// bind change event to select
$('#english_listingsid').live('click', function () {
var url = $(this).val(); // get selected value
if (url) { // require a URL
window.location = url; // redirect
}
return false;
});
});
</script>
<script type="text/javascript">
document.getElementById("InventoryMasterCategory").onchange = function() {
var selectedOption = $(this).find('option:selected').text();
window.location.href = "<?php echo  $actual_link ; ?>/english_listings/category/" + selectedOption;
}
</script>
<?php } ?>
