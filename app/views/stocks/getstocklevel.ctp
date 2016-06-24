<div class="projects index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Linnwork Inventory Database');?></h2>
<?php print_r($levels); ?>
<table cellpadding="0" cellspacing="0">
	<tr style="background:#666666;color:#ffffff;">				
		<th></th>
		<th><?php __('In Orders');?></th>		
		<th><?php __('Minimum Level');?></th>
		<th></th>		
	</tr>

	<?php
	$i = 0;
	foreach ($levels as  $stock):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td></td>
		<td><?php echo $stock->InOrders; ?></td>	
		<td><?php echo $stock->MinimumLevel; ?></td>			
		<td></td>	
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>