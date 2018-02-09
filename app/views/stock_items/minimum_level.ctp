<hr>
<?php //print_r($sixmonth_Reports);die(); $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
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
	<th><?php __('No of days'); ?><br><?php __('The Item was in stock'); ?><br><?php __('in last 12'); ?><br><?php __('months'); ?></th>
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
			<?php break;
					} ?>
			<?php endforeach; ?>  
			<td><?php echo $totalqty; ?></td>
			<?php $Acurr = '';  $Amax = 0; $Acurrname = ''; $Amaxname = ''; $Acurmin = '';  $Amin = 10000; $AcurrMinname = ''; $Aminname = ''; foreach($MaxReports as $MaxReport): ?>
			<?php if($stock_name['StockItem']['item_number'] === $MaxReport['ProcessedListing']['product_sku']){?>
			<?php $Acurr = $MaxReport[0]['total_qty']; $Acurrname = $MaxReport[0]['month_name']; $Acurmin = $MaxReport[0]['total_qty']; $AcurrMinname = $MaxReport[0]['month_name']; 		
				// count Mix Sales	
				if($Acurr >= $Amax) {
					$Amax = $Acurr; 
					$Amaxname = $Acurrname;
						} 
				// count Min Sales	
				
					if($Acurmin < $Amin){
					$Amin = $Acurmin; 
					$Aminname = $AcurrMinname;
						}?> 
						
				<?php } ?>
			<?php endforeach; ?>
			<td><?php echo $Amaxname; ?></td>
			<td><?php echo $Amax; ?></td>
			<td><?php echo $Aminname; ?></td>
			<td><?php if($Amin!==10000){ echo $Amin;} ?></td>
			
			<?php /* Total sales last 12 months */
			foreach ($Last_12_month_stocks as $Last_12_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_12_month_stock['StockLevel']['item_number']){?>
			<?php $nomberdays = $Last_12_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>	
			<td><?php echo $nomberdays;?></td>
			<td><?php $Average_month =($totalqty/$nomberdays)*30; echo round($Average_month,2);?></td>
			
			<?php /* Total sales last 6 months */
			 foreach ($sixmonth_Reports as $sixmonth_Report): ?>
			<?php if($stock_name['StockItem']['item_number'] === $sixmonth_Report['ProcessedListing']['product_sku']){?>
			<?php $totalsell = $sixmonth_Report[0]['sales_qty']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<?php foreach ($Last_6_month_stocks as $Last_6_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_6_month_stock['StockLevel']['item_number']){?>
			<?php $days_six = $Last_6_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>	
			<td><?php $Average_six_month =($totalsell/$days_six)*30; echo round($Average_six_month,2);?></td>
			
			<?php /* Total sales last 3 months */
			 foreach ($three_month_Reports as $three_month_Report): ?>
			<?php if($stock_name['StockItem']['item_number'] === $three_month_Report['ProcessedListing']['product_sku']){?>
			<?php $totalsell_3month = $three_month_Report[0]['sales_qty']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<?php foreach ($Last_3_month_stocks as $Last_3_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_3_month_stock['StockLevel']['item_number']){?>
			<?php $days_3month = $Last_3_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<td><?php $Average_3month =($totalsell_3month/$days_3month)*30; echo round($Average_3month,2);?></td>
			<?php foreach ($salesLastMonthReports as $salesLastMonthReport): ?>
			<?php if($stock_name['StockItem']['item_number'] === $salesLastMonthReport['ProcessedListing']['product_sku']){?>
			<?php $lastmonthtotalqty = $salesLastMonthReport[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $lastmonthtotalqty; ?></td>
			<td><?php $aveg_of_aveg = ($Average_month+$Average_six_month+$Average_3month)/3; echo round($aveg_of_aveg,2); ?></td>
			<?php foreach($Cuurentstocks as $Cuurentstock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Cuurentstock['StockLevel']['item_number']){?>
			<?php $currentstock = $Cuurentstock['StockLevel']['stock_lev']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $currentstock; ?></td>
			<td></td>
			<td><?php $stock_availability = (($currentstock)/($aveg_of_aveg)); echo round($stock_availability,2); ?></td>
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