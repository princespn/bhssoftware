<div class="projects index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Linnwork Inventory Database');?></h2>
<?php // print_r($descriptions); ?>
<table cellpadding="0" cellspacing="0">
	<tr style="background:#666666;color:#ffffff;">	
		<th><?php __('Product Source');?></th>	
		<th><?php __('Product SubSource');?></th>
		<th><?php __('Product Description');?></th>			
	</tr>

	<?php
	$i = 0;
	foreach ($descriptions as  $stock):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $stock->Source; ?></td>	
		<td><?php echo $stock->SubSource; ?></td>
		<td><?php echo $stock->Description; ?></td>		
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>