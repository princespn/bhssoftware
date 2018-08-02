<?php  //echo"<div class='bgimg'><div class='middle'><h1>COMING SOON</h1></div><div class='bottomleft'><p>Site under maintenance</p></div></div>"; die(); ?><hr>
<h1 class="sub-header"><?php __('Sales Reports Ordered by Channels');?></h1>
<div class="table-responsive">
   <table id="table-1"  class="table table-bordered table-striped table-hover">
    <thead> 
	<tr>
	 <th colspan="2"><?php __(' SKU'); ?>: <?php echo $Reports[0]['ProcessedListing']['product_sku']; ?></th>
	 <th colspan="2"><?php __(' Title'); ?> : <?php echo $Reports[0]['ProcessedListing']['product_name']; ?></th>
	 <th colspan="4"><?php __(' Category'); ?> : <?php echo $Reports[0]['ProcessedListing']['cat_name']; ?></th>
	</tr>
	<tr>
	 <th colspan="3"></th>
	<th  colspan="5" class="text-center text-uppercase color-black  green-bg"><?php __('Quantity Ordered (Sales)'); ?></th>
	
	</tr>
	<tr>
	<th><?php __('Sales Platform'); ?></th> 
	<th><?php __('Sales Channel'); ?></th>  	
	<th><?php __('Yesterday'); ?></th>
	<th><?php __('Last 7 days'); ?></th>	
	<th><?php __('Last 30 days'); ?></th>	
	<th><?php __('Last 90 days'); ?></th>	
	<th><?php __('Last 365 days'); ?></th>	
	<th><?php __('LifeTime'); ?></th>			
	</tr>
    </thead>  
<?php  foreach ($Reports as $Report): ?>  
		<tr>		
		
	
		<td><?php echo $Report['ProcessedListing']['plateform']; ?></td>
	<td><?php echo $Report['ProcessedListing']['subsource']; ?></td>		
		<?php $yes_Rep = 0; foreach($yes_Reports as $yes_Report): ?>
			<?php if(($Report['ProcessedListing']['product_sku'] === $yes_Report['ProcessedListing']['product_sku']) && ($Report['ProcessedListing']['plateform'] === $yes_Report['ProcessedListing']['plateform']) && ($Report['ProcessedListing']['subsource'] === $yes_Report['ProcessedListing']['subsource'])){?>
			<?php $yes_Rep = $yes_Report[0]['sales_qty']; $yes_total += $yes_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $yes_Rep; ?></td>	
			
			<?php $yeslast_Rep = 0; foreach($lastseven_Reports as $yeslast_Report): ?>
			<?php if(($Report['ProcessedListing']['product_sku'] === $yeslast_Report['ProcessedListing']['product_sku']) && ($Report['ProcessedListing']['plateform'] === $yeslast_Report['ProcessedListing']['plateform']) && ($Report['ProcessedListing']['subsource'] === $yeslast_Report['ProcessedListing']['subsource'])){?>
			<?php $yeslast_Rep = $yeslast_Report[0]['sales_qty']; $yeslast_total += $yeslast_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $yeslast_Rep; ?></td>	
		
		
		<?php $lasttherty_Rep = 0; foreach($lasttherty_Reports as $lasttherty_Report): ?>
			<?php if(($Report['ProcessedListing']['product_sku'] === $lasttherty_Report['ProcessedListing']['product_sku']) && ($Report['ProcessedListing']['plateform'] === $lasttherty_Report['ProcessedListing']['plateform'])  && ($Report['ProcessedListing']['subsource'] === $lasttherty_Report['ProcessedListing']['subsource'])){?>
			<?php $lasttherty_Rep = $lasttherty_Report[0]['sales_qty']; $lasttherty_total += $lasttherty_Report[0]['sales_qty'];  ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			
			<td><?php echo $lasttherty_Rep; $thertypercentage =  (($lasttherty_Rep/30)*7); ?><?php  if($thertypercentage < $yeslast_Rep) {echo "<div class='rTableCell green-col'>".round($thertypercentage,2)."</div>";}else { echo "<div class='rTableCell color-red-col'>".round($thertypercentage,2)."</div>";} ?></td>

		
		
		
		<?php $lastninty_Rep = 0; foreach($lastninty_Reports as $lastninty_Report): ?>
			<?php if(($Report['ProcessedListing']['product_sku'] === $lastninty_Report['ProcessedListing']['product_sku']) && ($Report['ProcessedListing']['plateform'] === $lastninty_Report['ProcessedListing']['plateform'])  && ($Report['ProcessedListing']['subsource'] === $lastninty_Report['ProcessedListing']['subsource'])){?>
			<?php $lastninty_Rep = $lastninty_Report[0]['sales_qty']; $lastninty_totl += $lastninty_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			
		<td><?php echo $lastninty_Rep; $nintypercentage =  (($lastninty_Rep/90)*7); ?><?php  if($nintypercentage < $yeslast_Rep) {echo "<div class='rTableCell green-col'>".round($nintypercentage,2)."</div>";}else { echo "<div class='rTableCell color-red-col'>".round($nintypercentage,2)."</div>";} ?></td>

	
		
		<?php $last360_Rep = 0; foreach($last365_Reports as $lastninty_Report): ?>
			<?php if(($Report['ProcessedListing']['product_sku'] === $lastninty_Report['ProcessedListing']['product_sku']) && ($Report['ProcessedListing']['plateform'] === $lastninty_Report['ProcessedListing']['plateform'])  && ($Report['ProcessedListing']['subsource'] === $lastninty_Report['ProcessedListing']['subsource'])){?>
			<?php $last360_Rep = $lastninty_Report[0]['sales_qty']; $last360_total += $lastninty_Report[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>
		<td><?php echo $last360_Rep; $nin360percentage =  (($last360_Rep/360)*7); ?><?php  if($nin360percentage < $yeslast_Rep) {echo "<div class='rTableCell green-col'>".round($nin360percentage,2)."</div>";}else { echo "<div class='rTableCell color-red-col'>".round($nin360percentage,2)."</div>";} ?></td>
			
		
		<td><?php echo $Report[0]['sales_qty']; $life_total += $Report[0]['sales_qty'];?></td>		
		</tr>		 
<?php endforeach; ?> 
<tr><td colspan="2"><strong><?php __(' All Total'); ?></strong></td><td><?php echo $yes_total;?></td><td><?php echo $yeslast_total;?></td><td><?php echo $lasttherty_total;?></td><td><?php echo $lastninty_totl;?></td><td><?php echo $last360_total;?></td><td><?php echo $life_total;?></td></tr>  
</table>
</div>
