<?php App::import('Controller', 'Stocks');
	$EmpCont = new StocksController();
?>
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
<tr style="background:#666666;color:#ffffff;">				
		<th><input type="checkbox" id="selecctall"/></th>
		<th><?php __('Product SKU');?></th>
			<th><?php __('Barcodes');?></th>
			<th style="width:300px;"><?php __('Title');?></th> 
           	<th><?php __('Price');?></th>
            <th><?php __('Quantity');?></th>
			<th><?php __('In Orders');?></th>
			<th><?php __('Minimum Level');?></th>
			<th colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
						
	</tr>

	<?php
	$i = 0;
	foreach ($stocks->Data as  $stock):
		$class = null;
		$str = $stock->StockItemId;
		$Sttitles = $EmpCont->product_title($str);
		$options = $EmpCont->getstocklevel($str);
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Form->input($stock->StockItemId,array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$stock->StockItemId,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>	
		<td><?php echo $stock->ItemNumber; ?></td>
		<td><?php echo $stock->BarcodeNumber; ?></td>
		<td style="width:300px;">
		<?php foreach ($Sttitles as  $Sttitle){ if($Sttitle->Source =='MAGENTO'){ ?>		
		<?php echo $Sttitle->Title; ?>
		<?php } 
		}?></td>
		<td><?php echo $stock->RetailPrice; ?></td>
		<td><?php echo $stock->Quantity; ?></td>
		<?php foreach ($options as  $option){ if($option->Location->LocationName =='United Kingdom FBA'){ ?>
			<td><?php echo $option->InOrders; ?></td>
			<td><?php echo $option->MinimumLevel; ?></td>
			<?php }			
			} 
			?>
			<td colspan='3'></td>
	</tr>
<?php endforeach; ?>
<?php echo $this->Form->end(); ?>
</table>
</div>
</div>