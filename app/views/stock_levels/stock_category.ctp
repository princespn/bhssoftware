<?php $lastday = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
$lastmonthday = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 0));
$lastlastmonthday = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 0));
//print_r($waterstocks);die();
 ?>
<hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
<h1 class="sub-header"><?php __('Stock Value Per Category Report');?></h1>
<div class="table-responsive">
   <table id="header-fixed" class="table table-bordered table-striped table-hover"></table>
    <table id="table-1"  class="table table-bordered table-striped table-hover">
    <thead>      
    <tr> 
    <th><?php __('Category'); ?></th>
	<th><?php __('UK Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('Waterfall Lane Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('FBA UK Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('FBA FR Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('FBA DE Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('FBA ES Value'); ?></br><?php __('(GBP,LP)'); ?></th>
	<th><?php __('Total Stock'); ?></br><?php __('Value (GBP,LP)'); ?></th>
	<th><?php __('Total Stock'); ?></br><?php __('Value (GBP,PP)'); ?></th>
	<th><?php __('Value on '); ?><?php echo $lastday; ?></br><?php __('(Previous Month  Last Day)'); ?></th>
	<th><?php __('Value on '); ?><?php echo $lastmonthday; ?></th>
	<th><?php __('Value on '); ?><?php echo $lastlastmonthday;  ?></th>
	</tr>
    </thead>  
<?php foreach ($catnames as $catname): ?>  
     <tr>
			<td><?php echo $catname['StockItem']['category_name']; ?></td>
			<?php $ukppprice = '0'; $ukprice = '0'; $waterppprice = '0'; $waterprice = '0'; $ukppfbprice = '0'; $ukfbprice = '0'; ?>
			<?php $frppfbprice = '0';$ukpricemain = '0'; $frfbprice = '0';  $deppfbprice = ''; $defbprice = '0'; $esppfbprice = '0'; $esfbprice = '0'; ?>
			<?php foreach ($ukstocks as $stock): ?>  
			<?php if($catname['StockItem']['category_name']=== $stock['StockLevel']['category_name']){ ?>
			<?php if(($stock['StockLevel']['location_name']==='Default')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $ukppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$ukppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$ukppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$ukppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $ukprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $ukpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php } else if(($stock['StockLevel']['location_name']==='WATERFALL LANE')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $waterppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$waterppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$waterppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$waterppprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $waterprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $waterpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php } else if(($stock['StockLevel']['location_name']==='United Kingdom FBA')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $ukppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$ukppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$ukppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$ukppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $ukfbprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $ukfbpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php } else if(($stock['StockLevel']['location_name']==='France FBA')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $frppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$frppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$frppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$frppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $frfbprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $frfbpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php } else if(($stock['StockLevel']['location_name']==='Germany FBA')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $deppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$deppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$deppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$deppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $defbprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $defbpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php } else if(($stock['StockLevel']['location_name']==='Spain FBA')){ ?>
			<?php if($stock['PurchasePrice']['item_sku'] === $stock['StockLevel']['item_number']){ ?>			
			<?php if($stock['CostCalculator']['invoice_currency']==='EUR'){ $esppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.89);}else if($stock['CostCalculator']['invoice_currency']==='USD'){$esppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.76);} else if($stock['CostCalculator']['invoice_currency']==='INR'){$esppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev'])*0.01);} else {$esppfbprice += (($stock['PurchasePrice']['purchase_price'])*($stock['StockLevel']['stock_lev']));}  ?>
			<?php }?>
			<?php $esfbprice += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev']));  ?>
			<?php $esfbpricemain += (($stock['CostCalculator']['landed_price_gbp'])*($stock['StockLevel']['stock_lev'])); ?>
			<?php }?>
			<?php }?>
			<?php endforeach; ?>			
			<td><?php echo $ukprice; ?></td>
			<td><?php echo $waterprice; ?></td>
			<td><?php echo $ukfbprice; ?></td>
			<td><?php echo $frfbprice; ?></td>
			<td><?php echo $defbprice; ?></td>
			<td><?php echo $esfbprice; ?></td>					
			<td><?php $total = $ukprice+$waterprice+$ukfbprice+$frfbprice+$defbprice+$esfbprice; echo $total;?></td>
			<td><?php $totalpp = $ukppprice+$waterppprice+$ukppfbprice+$frppfbprice+$deppfbprice+$esppfbprice; echo round($totalpp,2);?></td>
			<?php $totalLP += $ukprice+$waterprice+$ukfbprice+$frfbprice+$defbprice+$esfbprice;?>
			<?php $totalPP += $ukppprice+$waterppprice+$ukppfbprice+$frppfbprice+$deppfbprice+$esppfbprice; ?>
			<?php $prevprice = '0';foreach ($previousmonth as $previous): ?>  
			<?php if($catname['StockItem']['category_name']=== $previous['StockLevel']['category_name']){ ?>
			<?php if(($previous['StockLevel']['location_name']==='Default') || ($previous['StockLevel']['location_name']==='WATERFALL LANE') || ($previous['StockLevel']['location_name']==='United Kingdom FBA') || ($previous['StockLevel']['location_name']==='France FBA') || ($previous['StockLevel']['location_name']==='Germany FBA') || ($previous['StockLevel']['location_name']==='Spain FBA')){ ?>
			<?php $prevprice += (($previous['CostCalculator']['landed_price_gbp'])*($previous['StockLevel']['stock_lev'])); } ?>
			<?php } ?>
			<?php endforeach; ?> 			
			<td><?php $totalprev += $prevprice; echo $prevprice; ?></td>
			<?php $prevlastprice = '0';foreach ($lastmonths as $lastmonth): ?>  
			<?php if($catname['StockItem']['category_name']=== $lastmonth['StockLevel']['category_name']){ ?>
			<?php if(($lastmonth['StockLevel']['location_name']==='Default') || ($lastmonth['StockLevel']['location_name']==='WATERFALL LANE') || ($lastmonth['StockLevel']['location_name']==='United Kingdom FBA') || ($lastmonth['StockLevel']['location_name']==='France FBA') || ($lastmonth['StockLevel']['location_name']==='Germany FBA') || ($lastmonth['StockLevel']['location_name']==='Spain FBA')){ ?>
			<?php $prevlastprice += (($lastmonth['CostCalculator']['landed_price_gbp'])*($lastmonth['StockLevel']['stock_lev'])); } ?>
			<?php } ?>
			<?php endforeach; ?> 			
			<td><?php $totallastprev += $prevlastprice; echo $prevlastprice; ?></td>
			<?php $prevlastlastprice = '0';foreach ($lastlastmonths as $lastlastmonth): ?>  
			<?php if($catname['StockItem']['category_name']=== $lastlastmonth['StockLevel']['category_name']){ ?>
			<?php if(($lastlastmonth['StockLevel']['location_name']==='Default') || ($lastlastmonth['StockLevel']['location_name']==='WATERFALL LANE') || ($lastlastmonth['StockLevel']['location_name']==='United Kingdom FBA') || ($lastlastmonth['StockLevel']['location_name']==='France FBA') || ($lastlastmonth['StockLevel']['location_name']==='Germany FBA') || ($lastlastmonth['StockLevel']['location_name']==='Spain FBA')){ ?>
			<?php $prevlastlastprice += (($lastlastmonth['CostCalculator']['landed_price_gbp'])*($lastlastmonth['StockLevel']['stock_lev'])); } ?>
			<?php } ?>
			<?php endforeach; ?> 			
			<td><?php $totallastlastprev += $prevlastlastprice; echo $prevlastlastprice; ?></td>
			
		</tr>		 
<?php endforeach; ?> 
<tr><td><?php __('Total Value'); ?></td><td><?php echo $ukpricemain; ?></td><td><?php echo $waterpricemain; ?></td><td><?php echo $ukfbpricemain; ?></td><td><?php echo $frfbpricemain; ?></td><td><?php echo $defbpricemain; ?></td><td><?php echo $esfbpricemain; ?></td><td><?php echo $totalLP;  ?></td><td><?php echo $totalPP; ?></td><td><?php echo $totalprev; ?></td><td><?php echo $totallastprev; ?></td><td><?php echo $totallastlastprev; ?></td></tr>  
      
    </table>
</div>
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