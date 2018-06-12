<?php //print_r($Skucurrentsweeks); 
	
	$previous_week = strtotime("-1 week +1 day");

	$start_week = strtotime("last monday midnight",$previous_week);
	$end_week = strtotime("next sunday",$start_week);

	$this_week_sd = date("Y-m-d",$start_week);
	$this_week_ed = date("Y-m-d",$end_week);
 
		$present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start2_week = date("Y-m-d",$second_week);
        $end2_week = date("Y-m-d",$send_week);
		
			$present_year_week = strtotime("-53 week +1 day");

			$last_year_week = strtotime("last sunday midnight",$present_year_week);
			$end_year_week = strtotime("next saturday",$last_year_week);

			$main_last_week = date("Y-m-d",$last_year_week);
			$main_end_week = date("Y-m-d",$end_year_week);
			
			
			$this_month_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
			$this_month_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));

				$start_month = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
				$end_month =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));

					
				$main_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
				$main_end_month = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));




?>
<h1 class="sub-header"><?php __('Daily Sales Report per category');?></h1>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
	    <div class="col-md-12">
	    <div class="col-md-5">
		</div>
      <?php  echo $form->create('',array('action'=>'','id'=>'saveForm')); ?>
        <div class="col-md-5">
         <div class="form-group margin-bottom-0">
			<div class="input-group">
				<span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
				<?php echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product SKU...', 'class'=>'form-control pa-left')); ?>
				<div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
			</div>
          </div>
        </div>
      </div>
	 </div>
    </div>
  </div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <thead>
	<tr>
	<th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Title'); ?></th>
	<th><?php __('Category'); ?></th>
	<th><?php __('Current Week'); ?></br><?php echo "( ".$this_week_sd." - ".$this_week_ed." )"?></th>	
	<th><?php __('Last Week'); ?></br><?php echo "( ".$start2_week." - ".$end2_week." )"?></th>
	<th><?php __('Same Week last Year'); ?></br><?php echo "( ".$main_last_week." - ".$main_end_week." )"?></th>
	<th><?php __('Current Month'); ?></br><?php echo "( ".$this_month_sd." - ".$this_month_ed." )"?></th>
	<th><?php __('Previous Month'); ?></br><?php echo "( ".$start_month." - ".$end_month." )"?></th>
	<th><?php __('Same Month last Year'); ?></br><?php echo "( ".$main_last_month." - ".$main_end_month." )"?></th>
	</tr>
    </thead>
		
		<?php  foreach ($CatSaveallweeks as $value): ?>  
		<tr>
		<td><?php echo $value['ProcessedListing']['product_sku']; ?><?php echo "( ".$value[0]['orderid']." )" ?></td>
        <td><?php echo $value['ProcessedListing']['product_name']; ?></td>
        <td><?php echo $value['ProcessedListing']['cat_name']; ?></td>
		<?php $currday_Rep = 0; foreach($Skucurrentsweeks as $currday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $currday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $currday_Report['ProcessedListing']['cat_name'])){?>
		<?php $currday_Rep = $currday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $currday_Rep; ?></td>
		<?php $prevday_Rep = 0; foreach($Skupreviousweeks as $prevday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $prevday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $prevday_Report['ProcessedListing']['cat_name'])){?>
		<?php $prevday_Rep = $prevday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $prevday_Rep; ?></td>
		<?php $lastday_Rep = 0; foreach($Skulastweeks as $lastday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $lastday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $lastday_Report['ProcessedListing']['cat_name'])){?>
		<?php $lastday_Rep = $lastday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $lastday_Rep; ?></td>
		<?php $currmonth_Rep = 0; foreach($Skucurskumonths as $Skucurskumonth): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skucurskumonth['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skucurskumonth['ProcessedListing']['cat_name'])){?>
		<?php $currmonth_Rep = $Skucurskumonth[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $currmonth_Rep; ?></td>		
		<?php $prevmonth_Rep = 0; foreach($Skuprevskumonths as $Skuprevskumonth): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skuprevskumonth['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skuprevskumonth['ProcessedListing']['cat_name'])){?>
		<?php $prevmonth_Rep = $Skuprevskumonth[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $prevmonth_Rep; ?></td>
		<?php $lastmonth_Rep = 0; foreach($Skulastmonths as $Skulastmonth): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skulastmonth['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skulastmonth['ProcessedListing']['cat_name'])){?>
		<?php $lastmonth_Rep = $Skulastmonth[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $lastmonth_Rep; ?></td>
		<tr>
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
 