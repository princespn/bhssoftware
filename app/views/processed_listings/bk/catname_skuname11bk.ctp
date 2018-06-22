<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$mapping = array('Item SKU','Item Title','Category','Stock Level','On Order','Current Week');
echo $csv->addRow($mapping);
foreach ($current_stock as $CatSaveallweek):


$sku = array($CatSaveallweek['ProcessedListing']['product_sku']);
$desc = array($CatSaveallweek['ProcessedListing']['product_name']);
$catname = array($CatSaveallweek['ProcessedListing']['cat_name']);

$duestock = array('0.00'); 
$currentstock = array('0.00');
foreach($Currentstocks as $Cuurentstock):
if($CatSaveallweek['ProcessedListing']['product_sku'] === $Cuurentstock['StockLevel']['item_number']){
$currentstock[0] = $Cuurentstock['StockLevel']['stock_lev'];
$duestock[0] = $Cuurentstock['StockLevel']['due_level'];
break;}
endforeach;	

$currday_Rep = array('0.00'); foreach($Skucurrentsweeks as $currday_Report): 
if(($CatSaveallweek['ProcessedListing']['product_sku'] === $currday_Report['ProcessedListing']['product_sku']) && ($CatSaveallweek['ProcessedListing']['cat_name'] === $currday_Report['ProcessedListing']['cat_name'])){
$currday_Rep[0] = $currday_Report[0]['orderid'];
break;} 
endforeach;  

			
$line = array_merge($sku, $desc,$catname,$currentstock,$duestock,$currday_Rep);
echo $csv->addRow($line);
endforeach;
$filename = 'current_stock';
echo $csv->render($filename);
}
else
{

$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);
	
$datew1 = date_create($this_week_sd);
$curr_week = date_format($datew1,"d F");
	
$datew2 = date_create($this_week_ed);
$curr_week2 = date_format($datew2,"d F Y");

 
$present_week = strtotime("-2 week +1 day");

$second_week = strtotime("last monday midnight",$present_week);
$send_week = strtotime("next sunday",$second_week);

$start2_week = date("Y-m-d",$second_week);
$end2_week = date("Y-m-d",$send_week);

$datel1 = date_create($start2_week);
$last_week1 = date_format($datel1,"d F");
		
$datel2 = date_create($end2_week);
$last_week2 = date_format($datel2,"d F Y");
		
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);
			
$datepw = date_create($main_last_week);
$lastp_week1 = date_format($datepw,"d F");
		
$datepw1 = date_create($main_end_week);
$lastp_week2 = date_format($datepw1,"d F Y");
		
			
$this_month_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
//$this_month_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
			
$date = date_create($this_month_sd);
$this_month_ed = date_format($date,"F Y");

$start_month = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
//$end_month =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));
				
$datep = date_create($start_month);
$end_month = date_format($datep,"F Y");

					
$main_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
//$main_end_month = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));
$datelast = date_create($main_last_month);
$main_end_month = date_format($datelast,"F Y");

$this_year = date_format($datep,"Y");			
$end_year = date_format($datelast,"Y");

?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<h1 class="sub-header"><?php __('Daily Sales Report per category or per sku.');?></h1>
 <div class="panel panel-default">
    <div class="panel-body">
	 <?php  echo $form->create('ProcessedListing',array('action'=>'catname_skuname','id'=>'saveForm')); ?>
		<div class="row">
	    <div class="col-md-12">
	    <div class="col-md-5">		
		<button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>		
        <div class="col-md-5">
         <div class="form-group margin-bottom-0">
			<div class="input-group">
				<span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
				<?php echo $this->Form->input('cat_sku_name',array('label'=>'','placeholder'=>'Search Item SKU, Category..', 'class'=>'form-control pa-left')); ?>
				<div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
			</div>
          </div>
        </div>
      </div>
	 </div>
	<?php echo $this->Form->end();?>
    </div>
  </div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <thead>
	<tr>
	<th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Title'); ?></th>
	<th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <?php foreach ($categories as $category): ?>
                     
                    <li><a href="<?php echo  $actual_link ; ?>/processed_listings/catname_skuname?catgory=<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th> 
	<th><?php __('Stock Level'); ?></th>
	<th><?php __('On Order (Due)'); ?></th>	
	<th><?php __('Current Week'); ?></th>	
	<th><?php __('Last Week'); ?></th>
	<th><?php __('Same Week'); ?></br><?php __('Last Year'); ?><?php //echo $lastp_week1." To ".$lastp_week2; ?></th>
	<th><?php __('Current Month'); ?></th>
	<th><?php __('Previous Month'); ?></th>
	<th><?php __('Same Month'); ?></br><?php __('Last Year'); ?></br><?php echo $main_end_month; ?></th>
	<th><?php __('Current YTD'); ?></th>
	<th><?php __('Last YTD'); ?></th>
	<th><?php __('Last Year'); ?></th>
	</tr>
    </thead>		
		<?php  foreach ($CatSaveallweeks as $value): ?>  
		<tr>
		<td><a href="<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']."/processed_listings/plateform_skuname/".$value['ProcessedListing']['product_sku'];  echo $actual_link ; ?>"><?php echo $value['ProcessedListing']['product_sku']; ?><?php echo "( ".$value[0]['orderid']." )" ?></a></td>
        <td><?php echo $value['ProcessedListing']['product_name']; ?></td>
        <td><?php echo $value['ProcessedListing']['cat_name']; ?></td>
		<?php $due_level = 0; $currentstock = 0; foreach($Currentstocks as $Cuurent_stock): ?>
		<?php if($value['ProcessedListing']['product_sku'] === $Cuurent_stock['StockLevel']['item_number']){?>
		<?php $due_level = $Cuurent_stock['StockLevel']['due_level']; $currentstock = $Cuurent_stock['StockLevel']['stock_lev']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $currentstock; ?></td>	
		<td><?php echo $due_level; ?></td>	
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
		<td><?php echo $prevday_Rep; $lastpercentage =  ((($currday_Rep-$prevday_Rep)/$prevday_Rep)*100); ?><?php  if($lastpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastpercentage,2)."%"."</div>";} ?></td>
		<?php $lastday_Rep = 0; foreach($Skulastweeks as $lastday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $lastday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $lastday_Report['ProcessedListing']['cat_name'])){?>
		<?php $lastday_Rep = $lastday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?> 
		<td><?php echo $lastday_Rep; $lastweekpercentage =  ((($currday_Rep-$lastday_Rep)/$lastday_Rep)*100); ?><?php  if($lastweekpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastweekpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastweekpercentage,2)."%"."</div>";} ?></td>
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
		<td><?php echo $prevmonth_Rep; $currmonthpercentage =  ((($currmonth_Rep-$prevmonth_Rep)/$prevmonth_Rep)*100); ?><?php  if($currmonthpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($currmonthpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($currmonthpercentage,2)."%"."</div>";} ?></td>
		<?php $lastmonth_Rep = 0; foreach($Skulastmonths as $Skulastmonth): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skulastmonth['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skulastmonth['ProcessedListing']['cat_name'])){?>
		<?php $lastmonth_Rep = $Skulastmonth[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?> 
		<td><?php echo $lastmonth_Rep; $lastmonthpercentage =  ((($currmonth_Rep-$lastmonth_Rep)/$lastmonth_Rep)*100); ?><?php  if($lastmonthpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastmonthpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastmonthpercentage,2)."%"."</div>";} ?></td>
		<?php $curryear_Rep = 0; foreach($Skucurryears as $Skucurryear): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skucurryear['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skucurryear['ProcessedListing']['cat_name'])){?>
		<?php $curryear_Rep = $Skucurryear[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?> 
		<td><?php echo $curryear_Rep; ?></td>
		
		<?php $lastytd_Rep = 0; foreach($Skulastydts as $Skulastydt): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skulastydt['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skulastydt['ProcessedListing']['cat_name'])){?>
		<?php $lastytd_Rep = $Skulastydt[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?> 
		<td><?php echo $lastytd_Rep; $lastyearpercentage =  ((($curryear_Rep-$lastytd_Rep)/$lastytd_Rep)*100); ?><?php  if($lastyearpercentage < 0) {echo "<div class='rTableCell color-red-col'>".round($lastyearpercentage,2)."%"."</div>";}else { echo "<div class='rTableCell green-col'>".round($lastyearpercentage,2)."%"."</div>";} ?></td>
		
		<?php $lastyear_Rep = 0; foreach($Skulastyears as $Skulastyear): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $Skulastyear['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $Skulastyear['ProcessedListing']['cat_name'])){?>
		<?php $lastyear_Rep = $Skulastyear[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?> 
		<td><?php echo $lastyear_Rep; ?></td>
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
<script type="text/javascript">
$(document).ready(function() {
	$('#picker').change(function(){
	$('#exportfile').removeAttr('disabled');
	
	});    
});
</script>
<?php } ?>