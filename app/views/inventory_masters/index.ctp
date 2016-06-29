<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) && (!empty($_POST['exports']))){
	$line= $inventory_masters[0]['InventoryMaster'];	
	$mapping = array('','','SKU','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($inventory_masters as $inventory_master){		
	$line = $inventory_master['InventoryMaster'];
	echo $csv->addRow($line);
	}
$filename='inventory_masters';
echo $csv->render($filename);
}else{	
?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="inventory_masters index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Inventory Masters Database');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('InventoryMaster',array('action'=>'index','id'=>'saveForm')); ?>
<tr style="color:#ffffff;">
<th colspan="3"><?php echo $form->checkbox('error',array('label'=>'','value'=>'error')); ?><?php echo $this->Paginator->sort('error', 'error', array('direction' => 'desc')); ?></th>
<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
<th colspan="6"></th>
</tr>
<tr style="background:#666666;color:#ffffff;">				
<th><input type="checkbox" id="selecctall" name="selecctall" value="All"/></th>
<th><?php __('Image');?></th>
<th><?php __('Product Code');?></th>
<th><?php __('Sku');?></th>
<th style="width:30px;"><?php __('Category');?>
<select id="InventoryMasterCategory" name="data[InventoryMaster][category]">
<option value='--Select Category--'>--Select Category--</option>
<?php $option = $this->requestAction('/inventory_masters/categoriesPro'); //echo $this->Form->select('category',array($option)); 
foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';}
echo '<option'.' '.$select.' '.'value='.$option.'>'.$option.'</option>';
}?></select></th>                    
<th><?php __('Browse nodes');?></th>
<th><?php __('Product name');?></th>
<th><?php __('Standard price');?></th>
<th><?php __('Sale price');?></th>
<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
</tr>
<?php $output = $this->requestAction('/inventory_masters/saleprice');  
$keywords = preg_split("/[\n]+/", $output);
$i = 0;
foreach ($inventory_masters as $inventory_master):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
$wordlist = split ("\_", $inventory_master['InventoryMaster']['item_sku']); 	
?>
<tr<?php echo $class;?>>
<td><?php $productid = $inventory_master['InventoryMaster']['id'];if(!empty($inventory_master['InventoryMaster']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
echo $this->Form->input('InventoryMaster.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($inventory_master['InventoryMaster']['error'])){echo "&#8595;";} ?></td>
<td class="checkbox"><?php  if(!empty($inventory_master['InventoryMaster']['main_image_url'])){	echo "<img width='70px' src=".$inventory_master['InventoryMaster']['main_image_url'].">";
}else { echo '<img width=70px src=/img/images.png>';	}?></td>
<td><?php echo $inventory_master['ProductListing']['product_code']; ?></td>
<td><?php echo $inventory_master['InventoryMaster']['item_sku']; ?></td>
<td><?php if (!empty($inventory_master['ProductListing']['category'])){ echo $inventory_master['ProductListing']['category'];} ?></td>
<td><?php if(($inventory_master['InventoryMaster']['recommended_browse_nodes1'])!=($inventory_master['InventoryMaster']['recommended_browse_nodes1']))
{echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";
}else{echo $inventory_master['InventoryMaster']['recommended_browse_nodes1'];} ?></td>
<td><?php
	if((($wordlist[1])!=='FBA') && (empty($inventory_master['InventoryMaster']['item_name'])))
	{
	echo "<div style='color:red;'>The Title is required</div>";
	}
	else
	{
				$row1 = $inventory_master['InventoryMaster']['item_name'];
				$item = strlen($row1); 
					if($item >= '500')
					{
					echo "<div style='color:red;'>The Title must be no long 500 characters.</div>";
					}
					else
					{	$itemname = utf8_encode(substr($row1,0,50)); 
						echo ($itemname);						
					}
	}

?></td>
<td class="checkbox"><?php 
$saleprice = $inventory_master['InventoryMaster']['standard_price'];
if(!(empty($saleprice)))
{
	echo $saleprice;
	echo "</BR>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if($pieces[1]===($inventory_master['InventoryMaster']['item_sku'])){
	if((is_int($pieces[3])) !== (is_int($saleprice)) || (is_float($pieces[3])) !== (is_float($saleprice))){echo "<span style='color:red;'>Standard Price is did not match.</span>";}	
	}
	}
}
else if(($inventory_master['InventoryMaster']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Standard Price is Required</span>";
}
?></td>	
<td class="checkbox"><?php 
$stanprice = $inventory_master['InventoryMaster']['sale_price'];
if(!(empty($stanprice)))
{
	echo $stanprice;
	echo "</BR>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if(($pieces[1])===($inventory_master['InventoryMaster']['item_sku'])){
	if((is_int($pieces[3])) !== (is_int($stanprice)) || (is_float($pieces[3])) !== (is_float($stanprice))){echo "<span style='color:red;'>Sale Price is did not match.</span>";}	
	}
	}
}
else if(($inventory_master['InventoryMaster']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Sale Price is Required</span>";
}
?></td>
<td>
<?php
echo $this->Html->link($this->Html->image('edit.jpg'), array('action' => 'edit', $inventory_master['InventoryMaster']['item_sku']), array('escape' => false));
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo $this->Html->link($this->Html->image('delete.jpg'), array('action' => 'delete', $inventory_master['InventoryMaster']['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $inventory_master['InventoryMaster']['item_sku'])); 
?>
<?php 
//$size = array(''=>'Select','/inventory_masters/edit/'.$inventory_master['InventoryMaster']['item_sku']=>'Edit','/inventory_masters/delete/'.$inventory_master['InventoryMaster']['id']=>'Delete');
//echo $this->Form->input('', array('id'=>'inventory_mastersid','type'=>'select','label' => '','options' =>$size));
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
$('#inventory_mastersid').live('click', function () {
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
window.location.href = "<?php echo  $actual_link ; ?>/inventory_masters/category/" + selectedOption;
}
</script>
<?php } ?>