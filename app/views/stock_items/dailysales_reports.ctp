<hr>
<h1 class="sub-header"><?php __('Daily Sales Reports - Top 100 SKU Order by Quantity');?><?php $str1 = explode("-",$_SERVER['REQUEST_URI']); if(!empty($str1[1])){echo " In ".urldecode($str1[1]);}else{echo " In 6 months";}?></h1>
<div class="table-responsive">
   <table id="table-1"  class="table table-bordered table-striped table-hover">
    <thead> 
	<tr>
	<th colspan="2"></th>
	 <th colspan="3">
	 <ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Select Month Top 100 SKU Filter by month <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 <li><a href="<?php echo  $actual_link ; ?>/stock_items/dailysales_reports/-3 months" target="_self"><?php echo "3 months"; ?></a></li>
                 <li><a href="<?php echo  $actual_link ; ?>/stock_items/dailysales_reports/-6 months" target="_self"><?php echo "6 months"; ?></a></li>
				  <li><a href="<?php echo  $actual_link ; ?>/stock_items/dailysales_reports/-9 months" target="_self"><?php echo "9 months"; ?></a></li>
				   <li><a href="<?php echo  $actual_link ; ?>/stock_items/dailysales_reports/-12 months" target="_self"><?php echo "12 months"; ?></a></li>
                </ul>
           </li>
     </ul>
    </th>
	
	
	<th  colspan="4" class="text-center text-uppercase color-black  green-col-bg"><?php __('Quantity Ordered (Sales)'); ?></th>
	
	</tr>
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
<?php  foreach ($sixmonth_Reports as $stock_name): ?>  
		<tr>
		<td><a href="<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']."/stock_items/dailyplateform_reports/";  echo $actual_link ; ?><?php echo $stock_name['ProcessedListing']['product_sku']; ?> "><?php echo $stock_name['ProcessedListing']['product_sku']; ?> <?php echo " (".$stock_name[0]['sales_qty']." )"; ?></a></td>
		<td><?php echo $stock_name['ProcessedListing']['product_name']; ?></td>
		<td><?php echo $stock_name['ProcessedListing']['cat_name']; ?></td>
		<?php  $due_level = 0; $currentstock = 0; foreach($Cuurent_stocks as $Cuurent_stock): ?>
			<?php if($stock_name['ProcessedListing']['product_sku'] === $Cuurent_stock['StockLevel']['item_number']){?>
			<?php $due_level = $Cuurent_stock[0]['due_level']; $currentstock = $Cuurent_stock[0]['stock_lev']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $currentstock; ?></td>	
		<td><?php echo $due_level; ?></td>		
			<?php $lastday_Rep = 0; foreach($currweek_Reports as $lastday_Report): ?>
			<?php  if($stock_name['ProcessedListing']['product_sku'] === $lastday_Report['ProcessedListing']['product_sku']){?>
			<?php $lastday_Rep = $lastday_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
		<td><?php echo $lastday_Rep; ?></td>
			<?php $lastweek_Rep = 0; foreach($lastweek_Reports as $lastweek_Report): ?>
			<?php if($stock_name['ProcessedListing']['product_sku'] === $lastweek_Report['ProcessedListing']['product_sku']){?>
			<?php $lastweek_Rep = $lastweek_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
		<td><?php echo $lastweek_Rep; $lastpercentage =  ((($lastday_Rep-$lastweek_Rep)/$lastweek_Rep)*100); ?><?php  if($lastpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastpercentage,2)."%"."</div>";} ?></td>
			<?php $lastmonth_Rep = 0; foreach($lastmonth_Reports as $lastmonth_Report): ?>
			<?php if($stock_name['ProcessedListing']['product_sku'] === $lastmonth_Report['ProcessedListing']['product_sku']){?>
			<?php $lastmonth_Rep = $lastmonth_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
		<td><?php echo $lastmonth_Rep; $lastmonthpercentage =  ((($lastday_Rep-$lastmonth_Rep)/$lastmonth_Rep)*100); ?><?php  if($lastmonthpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastmonthpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastmonthpercentage,2)."%"."</div>";} ?></td>
		<?php $lastyear_Rep = 0; foreach($lastyear_Reports as $lastyear_Report): ?>
			<?php if($stock_name['ProcessedListing']['product_sku'] === $lastyear_Report['ProcessedListing']['product_sku']){?>
			<?php $lastyear_Rep = $lastyear_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?> 
<td><?php echo $lastyear_Rep; $lastyearpercentage =  ((($lastday_Rep-$lastyear_Rep)/$lastyear_Rep)*100); ?><?php  if($lastyearpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastyearpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastyearpercentage,2)."%"."</div>";} ?></td>
		
		</tr>		 
<?php endforeach; ?>   
</table>
</div>