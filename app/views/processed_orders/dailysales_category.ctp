<hr>
<h1 class="sub-header"><?php __('Daily Sales Report per category:
');?></h1>
<div class="table-responsive">
   <table id="table-1"  class="table table-bordered table-striped table-hover">
    <thead> 
	<tr>
	<th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Title'); ?></th>
	<th><?php __('Category'); ?></th>	
	<th><?php __('Stock Level'); ?></th>
	<th><?php __('On Order (Due)'); ?></th>
	<th><?php __('Cuurent week'); ?></th>
	<th><?php __('Sales Last week'); ?></th>
	<th><?php __('Same week Last month'); ?></th>
	<th><?php __('Same week Last year'); ?></th>	
	</tr>	
    </thead>  
<?php  foreach ($Reports as $Report): ?>  
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>		 
<?php endforeach; ?> 
</table>
</div>
