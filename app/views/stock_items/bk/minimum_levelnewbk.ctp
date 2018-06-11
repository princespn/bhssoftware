<?php

if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

//$headmapp = array('','','','','','MAXIMUM..','...SALE','MINIMUM...','...SALE','','AVERAGE...','...SALES','....(WITH IN STOCK ASSUMPTION)','','','','','','','','','','','');
$headmapp = array('','','','','','MAXIMUM..','...SALE','MINIMUM...','...SALE','','','','','','','','','');
echo $csv->addRow($headmapp);
$mapping = array('Item SKU','Item Description','Category','Supplier','Sales Qty last 12 months','Month','Quantity','Month','Quantity','No of days The Item was in stock in last 12 months', '12 Month Average Sales/Month', 'Sales Qty last 6 months', 'No of days The Item was in stock in last 6 months','6 Month Average Sales/Month', 'Sales Qty last 3 months', 'No of days The Item was in stock in last 3 months', '3 Month Average Sales/Month', 'Last Month Sales Quanity','Current Stock','Quantity on Order','Minimum Stock Level');
echo $csv->addRow($mapping);
foreach ($stockall_reports as $stockall_report):


$sku = array($stockall_report['StockItem']['item_number']);
$desc = array($stockall_report['StockItem']['item_title']);
$catname = array($stockall_report['StockItem']['category_name']);
$suppname = array($stockall_report['StockItem']['supp_name']);

			$totalqty = array('0.00'); foreach ($salesReports as $salesReport):
				if($stockall_report['StockItem']['item_number'] === $salesReport['ProcessedListing']['product_sku']){
				if(!empty($salesReport[0]['sales_qty'])){$totalqty[0] = $salesReport[0]['sales_qty']; }else{ $totalqty = array('0.00');}
				break;
					} 
				endforeach;
				
			$Acurr = '';  $Amax = 0; $Acurrname = ''; $Amaxvalue = array('0.00'); $Amaxname = array('0.00'); $Acurmin = ''; $Aminvalue = array('0.00'); $Aminname = array('0.00'); $Amin = 10000; $AcurrMinname = '';   foreach($MaxReports as $MaxReport):
			 if($stockall_report['StockItem']['item_number'] === $MaxReport['ProcessedListing']['product_sku']){
			 $Acurr = $MaxReport[0]['total_qty']; $Acurrname = $MaxReport[0]['month_name']; $Acurmin = $MaxReport[0]['total_qty']; $AcurrMinname = $MaxReport[0]['month_name']; 		
			
				if($Acurr >= $Amax) {
					$Amaxvalue[0] = $Acurr; 
					$Amaxname[0] = $Acurrname;
					$Amax = $Amaxvalue[0];
					$Acurrname = $Amaxname[0];
						} 
								
					if($Acurmin < $Amin){
					$Aminvalue[0] = $Acurmin; 
					$Aminname[0] = $AcurrMinname;
					$Amin = $Aminvalue[0];
					$AcurrMinname = $Aminname[0];
						} 
						
					} 
				endforeach; 
			
		
			$nomberdays = array('0.00');$Average_12month = array('0.00'); foreach ($Last_12_month_stocks as $Last_12_month_stock):
			if($stockall_report['StockItem']['item_number'] === $Last_12_month_stock['StockLevel']['item_number']){
			$nomberdays[0] = $Last_12_month_stock[0]['No_of_days'];
			$Average_12month[0] = (($totalqty[0]/$nomberdays[0])*30); 

			break;
					} 
			endforeach;

		
			 $totalsell = array('0.00');foreach ($sixmonth_Reports as $sixmonth_Report):
			 if($stockall_report['StockItem']['item_number'] === $sixmonth_Report['ProcessedListing']['product_sku']){
			 $totalsell[0] = $sixmonth_Report[0]['sales_qty']; 
			 break;
				} 
			endforeach; 
			
			 $days_six = array('0.00'); foreach ($Last_6_month_stocks as $Last_6_month_stock):
			if($stockall_report['StockItem']['item_number'] === $Last_6_month_stock['StockLevel']['item_number']){
			$days_six[0] = $Last_6_month_stock[0]['No_of_days']; 
			 break;
				} 
			endforeach;
			
			$Average_six_month[0] =($totalsell[0]/$days_six[0])*30; 
			
			$totalsell_3month = array('0.00');  foreach ($three_month_Reports as $three_month_Report):
			if($stockall_report['StockItem']['item_number'] === $three_month_Report['ProcessedListing']['product_sku']){
			$totalsell_3month[0] = $three_month_Report[0]['sales_qty'];
			break;
			} 
			endforeach;
			
			 $days_3month = array('0.00'); foreach ($Last_3_month_stocks as $Last_3_month_stock):
			 if($stockall_report['StockItem']['item_number'] === $Last_3_month_stock['StockLevel']['item_number']){
			 $days_3month[0] = $Last_3_month_stock[0]['No_of_days'];
			 break;
				}
			 endforeach;
			 $Average_3month[0] =($totalsell_3month[0]/$days_3month[0])*30;
			
			$lastmonthtotalqty = array('0.00'); 
			foreach ($salesLastMonthReports as $salesLastMonthReport):
			if($stockall_report['StockItem']['item_number'] === $salesLastMonthReport['ProcessedListing']['product_sku']){
			$lastmonthtotalqty[0] = $salesLastMonthReport[0]['sales_qty'];
			break;
			}
			endforeach;
			
			
			//$aveg_of_aveg[0] = ($Average_month[0]+$Average_six_month[0]+$Average_3month[0])/3; 
			
		  $duestock = array('0.00'); $currentstock = array('0.00');
		  foreach($Cuurentstocks as $Cuurentstock):
			if($stockall_report['StockItem']['item_number'] === $Cuurentstock['StockLevel']['item_number']){
			$currentstock[0] = $Cuurentstock[0]['stock_lev'];
			$duestock[0] = $Cuurentstock[0]['due_level'];
			break;}
			endforeach;
			
			
			
			
			$minimumlevel = array('0.00'); foreach($Minimum_stocks as $Minimum_stock):
			if($stockall_report['StockItem']['item_number'] === $Minimum_stock['StockLevel']['item_number']){
			$minimumlevel[0] = $Minimum_stock[0]['minimum_level'];
			break;}
			endforeach;
		
$line = array_merge($sku, $desc,$catname,$suppname,$totalqty,$Amaxname,$Amaxvalue,$Aminname,$Aminvalue,$nomberdays,$Average_12month,$totalsell,$days_six,$Average_six_month,$totalsell_3month,$days_3month,$Average_3month,$lastmonthtotalqty,$currentstock,$duestock,$minimumlevel);
echo $csv->addRow($line);
endforeach;
$filename = 'minimum_level';
echo $csv->render($filename);
}
else
{ ?>
<hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
<h1 class="sub-header"><?php __('Minimum Stock level Report');?></h1>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']; ?>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('StockItem',array('action'=>'minimum_level','id'=>'saveForm')); ?>
        <div class="col-md-8 mobile-bottomspace">
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
        <div class="col-md-4">
        
        </div>
      </div>
    </div>
  </div> 
<div class="table-responsive">
 <table id="header-fixed" class="table table-bordered table-striped table-hover"></table>
   
 <table id="table-1" class="table table-bordered table-striped table-hover">
    <thead> 
	 <tr id="head-table"> 
	 <th colspan="6"></th>
     <th colspan="2" class="text-center text-uppercase color-black  yellow-bg"><?php __('Maximum Sale');?></th>
        
      <th  colspan="2" class="text-center text-uppercase color-black green-bg"><?php __('Minimum Sale');?></th>
      <th></th>
      <th colspan="3" class="text-center text-uppercase color-black last-bg"><?php __('Average Sales (with in stock assumption)');?></th>
      <th colspan="7"></th>
      </tr>
    <tr>
	<th class="wid-20"><input type="checkbox" id="selecctall"/></th>
    <th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Description'); ?></th>
		 <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($Catname as $Catna): ?>
                     <li><a href="<?php echo  $actual_link ; ?>/stock_items/minimum_level/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>
	<th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Supplier <span class="caret"></span></a>
               <?php ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($Suppname as $Catna): ?>
                     <li><a href="<?php echo  $actual_link ; ?>/stock_items/minimum_level/<?php echo rawurlencode($Catna->SupplierName); ?>" target="_self"><?php  echo $Catna->SupplierName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>
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
		 <td><?php $productid = $stock_name['StockItem']['id']; echo $this->Form->input('StockItem.id',array('type'=>'checkbox','class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]')); ?></td>
         
		 	<td><?php echo $stock_name['StockItem']['item_number']; ?></td>
			<td><?php echo $stock_name['StockItem']['item_title']; ?></td>
			<td><?php echo $stock_name['StockItem']['category_name']; ?></td>
			<td><?php echo $stock_name['StockItem']['supp_name']; ?></td>
			<?php $totalqty = 0; foreach ($salesReports as $salesReport): ?>
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
			$nomberdays = 0; foreach ($Last_12_month_stocks as $Last_12_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_12_month_stock['StockLevel']['item_number']){?>
			<?php $nomberdays = $Last_12_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>	
			<td><?php echo $nomberdays;?></td>
			<td><?php $Average_month =($totalqty/$nomberdays)*30; echo "((".$totalqty."/".$nomberdays.")*30) =".round($Average_month,2);?></td>
			
			<?php /* Total sales last 6 months */
			 $totalsell = 0; foreach ($sixmonth_Reports as $sixmonth_Report): ?>
			<?php if($stock_name['StockItem']['item_number'] === $sixmonth_Report['ProcessedListing']['product_sku']){?>
			<?php $totalsell = $sixmonth_Report[0]['sales_qty']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<?php $days_six = 0; foreach ($Last_6_month_stocks as $Last_6_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_6_month_stock['StockLevel']['item_number']){?>
			<?php $days_six = $Last_6_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<td><?php $Average_six_month =($totalsell/$days_six)*30; echo "((".$totalsell."/".$days_six.")*30) =".round($Average_six_month,2);?></td>
			
			<?php /* Total sales last 3 months */
			 $totalsell_3month = 0; foreach ($three_month_Reports as $three_month_Report): ?>
			<?php if($stock_name['StockItem']['item_number'] === $three_month_Report['ProcessedListing']['product_sku']){?>
			<?php $totalsell_3month = $three_month_Report[0]['sales_qty']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<?php $days_3month = 0; foreach ($Last_3_month_stocks as $Last_3_month_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Last_3_month_stock['StockLevel']['item_number']){?>
			<?php $days_3month = $Last_3_month_stock[0]['No_of_days']; ?>
			<?php break;
					} ?>
			<?php endforeach; ?>
			<td><?php $Average_3month =($totalsell_3month/$days_3month)*30; echo "((".$totalsell_3month."/".$days_3month.")*30) =".round($Average_3month,2);?></td>
			
			<?php $lastmonthtotalqty = 0; foreach ($salesLastMonthReports as $salesLastMonthReport): ?>
			<?php if($stock_name['StockItem']['item_number'] === $salesLastMonthReport['ProcessedListing']['product_sku']){?>
			<?php $lastmonthtotalqty = $salesLastMonthReport[0]['sales_qty']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $lastmonthtotalqty; ?></td>
			<td><?php $aveg_of_aveg = ($Average_month+$Average_six_month+$Average_3month)/3; echo "(".round($Average_month,2)."+".round($Average_six_month,2)."+".round($Average_3month,2).")/3 =".round($aveg_of_aveg,2); ?></td>
			<?php $currentstock = 0; $duestock = 0; foreach($Cuurentstocks as $Cuurentstock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Cuurentstock['StockLevel']['item_number']){?>
			<?php $currentstock = $Cuurentstock[0]['stock_lev']; ?>
			<?php $duestock = $Cuurentstock[0]['due_level']; ?>
			<?php break;} ?>
			<?php endforeach; ?>  
			<td><?php echo $currentstock; ?></td>
			<td><?php echo 	$duestock; ?></td>
			<td><?php $stock_availability = (($currentstock)/($aveg_of_aveg)); echo round($stock_availability,2); ?></td>
			<td></td>
			<?php $minimumlevel = 0; foreach($Minimum_stocks as $Minimum_stock): ?>
			<?php if($stock_name['StockItem']['item_number'] === $Minimum_stock['StockLevel']['item_number']){?>
			<?php $minimumlevel = $Minimum_stock[0]['minimum_level']; ?>
			<?php break;} ?>
			<?php endforeach; ?>
			<td><?php echo 	$minimumlevel; ?></td>
						
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
<script type="text/javascript">
$.noConflict();  //Not to conflict with other scripts
jQuery(document).ready(function($) {
var tableOffset = $("#table-1").offset().top;
var $header = $("#table-1 > thead").clone();
var $fixedHeader = $("#header-fixed").append($header);

$(window).bind("scroll", function() {
    var offset = $(this).scrollTop();
    
    if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
        $fixedHeader.show();
    }
    else if (offset < tableOffset) {
        $fixedHeader.hide();
    }
});

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"                 
                 $('#exportfile').removeAttr('disabled');
			
            });
			
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
				
            }); 
			
        }
    });
   
});
</script>
<?php } ?>
