<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $france_listings[0]['FranceListing'];	
$mapping = array('','','SKU','','','','AM-FR Title','','','','','AM-FR Description','','','AM-FR Standard Price','','','','','','AM-FR Sale Price','AM-FR Sale from date','AM-FR Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR bullet_point 1','AM-FR bullet_point 2','AM-FR bullet_point 3','AM-FR bullet_point 4','AM-FR bullet_point 5','AM-FR Search Terms 1','AM-FR Search Terms 2','AM-FR Search Terms 3','AM-FR Search Terms 4','AM-FR Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR Colour Map1','AM-FR Colour Map2','AM-FR Size Map','','','','AM-FR Material','AM-FR Material1');
echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($france_listings as $france_listing){		
$line = $france_listing['FranceListing'];
echo $csv->addRow($line);
}
$filename='france_listings';
echo $csv->render($filename);
}else{

?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="france_listings index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Amazon France Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('FranceListing',array('action'=>'index','id'=>'saveForm')); ?>
<tr style="color:#ffffff;">
<th colspan="3"></th>
<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
<th colspan="6"></th>
</tr>
<tr style="background:#666666;color:#ffffff;">
<th><input type="checkbox" id="selecctall"/></th>
<th><?php __('Image');?></th>
<th><?php __('Product Code');?></th>
<th><?php __('Product Sku');?></th>
<th style="width:30px;"><?php __('Category');?>
                       <select id="InventoryMasterCategory" name="data[InventoryMaster][category]">
                       <?php $option = $this->requestAction('/inventory_masters/categorieslist'); //echo $this->Form->select('category',array($option)); 
                      foreach ($option as $key => $option){$cat = explode(" ", $option);if($foo==$cat[0]){$select='selected=selected';}else {$select='';}
                         echo '<option'.' '.$select.' '.'value='.$cat[0].'>'.$option.'</option>';
                         }         
		?></select></th> 
<th><?php __('Browse nodes');?></th>
<th><?php __('Product name');?></th>
<th><?php __('Available');?></th>
<th><?php __('Price');?></th>
<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>

</tr>

<?php
$i = 0;
foreach ($france_listings as $france_listing):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
?>
<tr<?php echo $class;?>>
<td class="checkbox"><?php	
$productid = $france_listing['FranceListing']['id'];
echo $this->Form->input('FranceListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
<td class="checkbox"><?php  if(!empty($france_listing['FranceListing']['main_image_url'])){	echo "<img width='70px' src=".$france_listing['FranceListing']['main_image_url'].">";
}else { echo '<img width=70px src=/img/images.png>';	}?></td>
<td><?php echo $france_listing['FranceListing']['product_code']; ?></td>
<td><?php echo $france_listing['FranceListing']['item_sku']; ?></td>
<td><?php echo $france_listing['InventoryMaster']['category']; ?></td>
<td><?php if(($france_listing['FranceListing']['recommended_browse_nodes1'])!=($france_listing['InventoryMaster']['recommended_browse_nodes1']))
{echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";
}else{echo $france_listing['FranceListing']['recommended_browse_nodes1'];} ?></td>

<td><?php 
if(!empty($france_listing['FranceListing']['item_name']))
{
$row1 = $france_listing['FranceListing']['item_name'];			
$keyword = $france_listing['FranceListing']['generic_keywords1'].$france_listing['FranceListing']['generic_keywords2'].$france_listing['FranceListing']['generic_keywords3'].$france_listing['FranceListing']['generic_keywords4'].$france_listing['FranceListing']['generic_keywords5'].$france_listing['InventoryMaster']['keyword'];
//$keyword = $france_listing['FranceListing']['keywords'];
$item = strlen($row1); 
if($item >= '500'){
echo "<div style='color:red;'>The Title must be no long 500 characters.</div>";

}else {
$percentage = 0;
$keyword = similar_text($row1,$keyword,$percentage);
$itemname = substr($row1,0,50); 				 
echo ($itemname);
echo "</BR>";
printf("<div style='color:red;'>The Title has %d percent Keyword.</div>", $percentage);
								 
}

}else{
echo "<div style='color:red;'>The Title is required</div>";
}?></td>
<td><?php echo $france_listing['FranceListing']['quantity']; ?></td>	
<td><?php 
$stanprice = $france_listing['FranceListing']['standard_price'];
$saleprice = $france_listing['InventoryMaster']['sale_price'];
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
	$pric = $france_listing['FranceListing']['error'];
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
// echo $this->Form->input('', array('onchange'=>'myFunction()','label' => '','options' => array($listing['FranceListing']['id'] => 'Edit')));
// echo $this->Html->link(__('Edit', true), array('action' => 'edit', $listing['FranceListing']['id'])); ?>
<?php // echo $this->Html->link(__('Delete', true), array('action' => 'delete', $listing['FranceListing']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listing['FranceListing']['item_sku'])); ?>
<?php 
$size = array(''=>'Select','/france_listings/edit/'.$france_listing['FranceListing']['id']=>'Edit','/france_listings/delete/'.$france_listing['FranceListing']['id']=>'Delete');
echo $this->Form->input('', array('id'=>'listingsid','type'=>'select','label' => '','options' =>$size));
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
$('#listingsid').live('click', function () {
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
var selectedOption = $(this).val();
window.location.href = "<?php echo  $actual_link ; ?>/france_listings/category/" + selectedOption;
}
</script>
<?php } 