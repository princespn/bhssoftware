<hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
<h1 class="sub-header"><?php __('Minimum Stock level Report');?></h1>
<div class="table-responsive">
   <table id="table-1"  class="table table-bordered table-striped table-hover">
    <thead> 
	 <tr id="head-table"> 
	 <th colspan="5"></th>
     <th colspan="2" class="text-center text-uppercase color-black  yellow-bg"><?php __('Maximum Sale');?></th>
        
      <th  colspan="2" class="text-center text-uppercase color-black green-bg"><?php __('Minimum Sale');?></th>
      <th></th>
      <th colspan="3" class="text-center text-uppercase color-black last-bg"><?php __('Average Sales (with in stock assumption)');?></th>
      <th colspan="7"></th>
      </tr>
    <tr>
	<th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Description'); ?></th>
	<th><?php __('Category'); ?></th>
	<th><?php __('Supplier'); ?></th>
	<th><?php __('Sales Qty'); ?><br><?php __('last 12'); ?><br><?php __('months'); ?></th>
	<th><?php __('Month'); ?></th><th><?php __('Quantity'); ?></th>
	<th><?php __('Month'); ?></th><th><?php __('Quantity'); ?></th>
	<th><?php __('No of days'); ?><br><?php __('out of stock'); ?><br><?php __('in last 12'); ?><br><?php __('months'); ?></th>
	<th><?php __('12 Month'); ?><br><?php __('Average'); ?><br><?php __(' Sales'); ?><br><?php __('/Month'); ?></th>
	<th><?php __('6 Month'); ?><br><?php __('Average'); ?><br><?php __(' Sales'); ?><br><?php __('/Month'); ?></th>
	<th><?php __('3 Month'); ?><br><?php __('Average'); ?><br><?php __(' Sales'); ?><br><?php __('/Month'); ?></th>
	<th><?php __('Last Month'); ?><br><?php __('Sales'); ?><br><?php __('Quanity'); ?></th>
	<th><?php __('Average'); ?><br><?php __('of Average'); ?><br><?php __('Sales/Month'); ?></th>
	<th><?php __('Current'); ?><br><?php __('Stock'); ?></th>
	<th><?php __('Quantity'); ?><br><?php __('on'); ?><br><?php __('Order'); ?></th>	
	<th><?php __('No of'); ?><br><?php __('Months'); ?><br><?php __('Stock'); ?><br><?php __('availability'); ?></th>	
	<th><?php __('Minimum'); ?><br><?php __('Stock'); ?><br><?php __('Level'); ?><br><?php __('Recommended'); ?></th>	
	<th><?php __('Minimum'); ?><br><?php __('Stock'); ?><br><?php __('Level'); ?></th>	
	
	
	</tr>
    </thead>  
<?php foreach ($stock_names as $stock_name): ?>  
		<tr>
			<td><?php echo $stock_name['StockItem']['item_number']; ?></td>
			<td><?php echo $stock_name['StockItem']['item_title']; ?></td>
			<td><?php echo $stock_name['StockItem']['category_name']; ?></td>
			<td><?php echo $stock_name['StockItem']['supp_name']; ?></td>
			<?php foreach ($salesReports as $salesReport): ?>
			<?php if($stock_name['StockItem']['item_number'] === $salesReport['ProcessedListing']['product_sku']){?>
			<?php $totalqty = $salesReport[0]['sales_qty']; ?>
			<?php } ?>
			<?php endforeach; ?>  
			<td><?php echo $totalqty; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php //$avgsales_12month =($totalqty/$datediff)*30; echo $avgsales_12month;?></td>
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
<hr>
<p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
?></p>
<nav>
 <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
     </ul>
</nav>