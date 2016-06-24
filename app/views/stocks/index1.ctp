<div class="projects index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Linnwork Inventory Database');?></h2>
<table cellpadding="0" cellspacing="0">
<?php echo $this->Form->create('Stock', array('action' => 'export')); ?> 
<tr style="color:#ffffff;">
<th colspan="4"></th>
<th colspan="3"><?php echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product SKU,Barcodes and Category','class'=>'export_box')); ?></th>
<th colspan="5"></th>
</tr>
<?php print_r($stocks);die();?>
<tr style="background:#666666;color:#ffffff;">				
		<th><input type="checkbox" id="selecctall"/></th>
		<th><?php __('Product SKU');?></th>
			<th><?php __('Barcodes');?></th>
			<th><?php __('Title');?></th> 
           	<th><?php __('Price');?></th>
            <th><?php __('Quantity');?></th>
			<th><?php __('In Orders/Minimum Level');?></th>
			<th><?php __('Description');?></th>
			<th colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
						
	</tr>

	<?php
	$i = 0;
	foreach ($stocks->Data as  $stock):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Form->input($stock->StockItemId,array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$stock->StockItemId,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>	
		<td><?php echo $stock->ItemNumber; ?></td>
		<td><?php echo $stock->BarcodeNumber; ?></td>
		<td><?php echo $this->Html->link('Title', 'product_title/'.$stock->StockItemId,array('class'=>'btn btn-success'));?></td>
		<td><?php echo $stock->RetailPrice; ?></td>
		<td><?php echo $stock->Quantity; ?></td>
			<td><?php echo $this->Html->link('Minimum Level', 'getstocklevel/'.$stock->StockItemId,array('class'=>'btn btn-success'));?></td>
			<td><?php echo $this->Html->link('description', 'getdescription/'.$stock->StockItemId,array('class'=>'btn btn-success'));?></td>
			<td colspan='3'></td>
	</tr>
<?php endforeach; ?>
<?php echo $this->Form->end(); ?>
</table>
</div>
</div>