<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $france_product_listings[0]['FranceProductListing'];	
$csv->addRow(array_keys($line));
foreach ($france_product_listings as $france_product_listing){		
$line = $france_product_listing['FranceProductListing'];
echo $csv->addRow($line);
}
$filename='france_product_listings';
echo $csv->render($filename);
}else{	
?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="product_listing index">
<div class="grid_16">
    <h2 id="page-heading"><?php __('FR Product Code Database');?><div style="float:right"><?php echo $this->Html->link(__('Import Product code', true), array('controller' => 'france_product_listings', 'action' => 'importcode')); ?></div></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('FranceProductListing',array('action'=>'index','id'=>'saveForm')); ?>
<tr style="color:#ffffff;">
<th colspan="2"></th>
<th colspan="4"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Amazon Sku, Amazon Asin...','class'=>'export_box')); ?></th>
<th colspan="2"></th>
</tr>
<tr style="background:#666666;color:#ffffff;">				
<th><input type="checkbox" id="selecctall"/></th>
<th><?php __('Linnworks Code');?></th>
<th><?php __('Amazon SKU');?></th> 
<th><?php __('Website Sku');?></th>             
<th><?php __('Amazon Asin');?></th>
<th><?php __('Category');?></th>
<th><?php __('fulfillment channel');?></th>
<th colspan='2'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
</tr>
<?php 
$i = 0;
foreach ($france_product_listings as $france_product_listing):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
?>
<tr<?php echo $class;?>>
<td><?php	
$productid = $france_product_listing['FranceProductListing']['id'];
echo $this->Form->input('FranceProductListing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
<td><?php echo $france_product_listing['FranceProductListing']['product_code']; ?></td>
<td><?php echo $france_product_listing['FranceProductListing']['product_sku']; ?></td>	
<td><?php echo $france_product_listing['FranceProductListing']['web_sku']; ?></td>	
<td><?php echo $france_product_listing['FranceProductListing']['product_asin']; ?></td>
<td><?php echo $france_product_listing['FranceProductListing']['category']; ?></td>		
<td><?php echo $france_product_listing['FranceProductListing']['fulfillmentchannel']; ?></td>	
<td colspan='2'>
<?php
/*echo $this->Html->link($this->Html->image('edit.jpg'), array('action' => 'edit', $france_product_listing['FranceProductListing']['product_sku']), array('escape' => false));
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo $this->Html->link($this->Html->image('delete.jpg'), array('action' => 'delete', $france_product_listing['FranceProductListing']['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $france_product_listing['FranceProductListing']['product_sku'])); 
*/?>
<?php 
//$size = array(''=>'Select','/france_product_listings/edit/'.$france_product_listing['FranceProductListing']['id']=>'Edit','/france_product_listings/delete/'.$france_product_listing['FranceProductListing']['id']=>'Delete');
//echo $this->Form->input('', array('id'=>'france_product_listingsid','type'=>'select','label' => '','options' =>$size));
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
<?php } ?>