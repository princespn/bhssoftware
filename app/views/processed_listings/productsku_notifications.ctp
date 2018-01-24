<?php
if (!empty($_POST['exports'])) {
	
$mapping = array('Category','Product SKU','Platform','Channel','Currency','Current(C)','Old (L)','Min (C-L/L)','Max (C-L/L)');
echo $csv->addRow($mapping);
foreach ($saveproductskutodays as $code_listing):
$catname = array(); $oldorder = array(); $currorder = array(); $oldform = array(); $oldsource = array(); $oldcurency = array();
foreach ($saveproductskusamedays as $oldRecords):
 if(($value['ProcessedListing']['product_sku'] === $oldRecords['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['subsource'] === $oldRecords['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $oldRecords['ProcessedListing']['plateform']))
					{
					$catname[] = $oldRecords['ProcessedListing']['subsource'];
					$oldorder[] = $oldRecords[0]['orderid']; 
					$currorder[] = $value[0]['orderid']; 
					$oldform[] = $oldRecords['ProcessedListing']['plateform'];
					$oldsource[] = $oldRecords['ProcessedListing']['subsource'];
					$oldcurency[] = $oldRecords['ProcessedListing']['currency'];
					} 

 if($percentorder <=-20){ $min = round($percentorder,2);
 }else if($percentorder >=20){$max = round($percentorder,2);}	

 $line = array_merge($catname[0], $oldform[0],$oldsource[0],$oldcurency[0],$currorder[0],$oldorder[0],$min,$max);
echo $csv->addRow($line);
endforeach;
endforeach;

$filename='saveproductskusamedays';
echo $csv->render($filename);
}
//print_r($saveproductskutodays);
?>
<h1 class="sub-header"><?php __('List-High variation in Sales');?></h1>
<hr>
<div class="panel panel-default">
    <div class="panel-body">
	<?php  echo $form->create('ProcessedListing',array('action'=>'productsku_notifications')); ?>
   
      <div class="row">
        <div class="col-md-12 mobile-bottomspace">
            <div class="col-md-4">             
              <ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category name: <span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <?php foreach ($categories as $Catna): ?>    
                     <li><a href="<?php echo  $actual_link ; ?>/processed_listings/productsku_notifications/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>         
        </div> 
		<div class="col-md-8">
         <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php echo $this->Form->input('productskuname',array('label'=>'','placeholder'=>'Search Product SKU...', 'class'=>'form-control pa-left')); ?>
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
     <thead><tr>
				<th><strong><?php __('Product sku');?></strong></th>
			   <th><strong><?php __('Sales Platform');?></strong></th>
			   <th><strong><?php __('Sales Channel');?></strong></th>
			   <th><strong><?php __('Currency');?></strong></th>
			   <th><strong><?php __('Current(C)');?><?php echo "( ". $today ." )"; ?></strong></th>
			   <th><strong><?php __('Old(L)');?><?php echo "( ". $sameday ." )"; ?></strong></th>
			   <th><strong><?php __('(C-L/L)');?></strong></th>
			   </tr></thead> 
		<?php $i = '0'; $a = '0'; foreach ($saveproductskusamedays as $value): ?>  
        <?php $b = $value['ProcessedListing']['product_sku']; ?>
		<?php   $currorder = array(); $oldorder = array(); $platf = array(); $source = array(); $cuurreny = array(); ?>
					<?php foreach ($saveproductskutodays as $Records): ?>				
					<?php if(($value['ProcessedListing']['product_sku'] === $Records['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['subsource'] === $Records['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $Records['ProcessedListing']['plateform'])) {?>
					<?php 
					$currorder[] = $Records[0]['orderid']; 
					$oldorder[] = $value[0]['orderid']; 					
					$platf[] = $value['ProcessedListing']['plateform'];
					$source[] = $value['ProcessedListing']['subsource'];
					$cuurreny[] = $value['ProcessedListing']['currency'];
						
					 ?>					 
				<?php } ?>					
				<?php endforeach; ?> 		
					
     	
				<?php if(!empty($value['ProcessedListing']['product_name'])){$catname = $value['ProcessedListing']['product_name'];}
				
				 
					if((!empty($value[0]['orderid'])) && (($value[0]['orderid'])> 2)){
				//if(($percentorder <=-20) || ($percentorder >=20)) { ?>
								
		<?php if($a!==$b){ $i++; echo "<tr><td colspan='7'><table class='table-responsive'><tr><td colspan='7'>".$b."</td><td colspan='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$catname."</td></tr></table>";} ?>
        <?php // if($a!==$b) {  ?>
                    
                                                          
            <?php // } ?> 
            <?php $a = $b; ?>
					
						<tr>
						<td></td>
						<td><?php if(!empty($platf[0])){echo $platf[0]; } else {echo $value['ProcessedListing']['plateform'];} ?></td>
						<td><?php if(!empty($source)){ echo $source[0];} else {echo $value['ProcessedListing']['subsource'];} ?></td>                                 
						<td><?php if(!empty($cuurreny[0])){ echo $cuurreny[0]; } else { echo $value['ProcessedListing']['currency'];} ?></td>
						<td><?php  if(!empty($currorder[0])){ echo $currorder[0]; }else { echo "0";} ?></td>
						<td><?php  if(!empty($oldorder[0])){ echo $oldorder[0]; } else{ echo $value[0]['orderid']; }?></td>
						<td><?php if(!empty($currorder[0])){  $percentorder = ((($currorder[0] - $oldorder[0])/$oldorder[0])*100);   if($percentorder <=-10){ echo "<div class='rTableCell color-red'>".round($percentorder,2)."%"."</div>";}else if($percentorder >=10){ echo "<div class='rTableCell green'>".round($percentorder,2)."%"."</div>";}else if($percentorder =='0'){ echo "<div class='rTableCell green'>0%</div>";} }else if(empty($currorder[0])){ $percentorder = (((0 - $oldorder[0])/$oldorder[0])*100); echo "<div class='rTableCell redcolor'>-100%</div>"; } ?></td>
						</tr>
						  
      
       <?php $a = $b; ?>
         <?php if($a!==$b) { echo "</td></tr>";} ?>
				<?php //} ?>
				<?php   } ?>
         <?php endforeach; ?> 
    
    </table>
 </div>
 <p><?php
	echo 'Page 1 of 1 showing '. $i .' records out of  '.$i . ' total starting on record 1 ending on '.$i ;

	?></p>
<script type="text/javascript">
$.noConflict();  //Not to conflict with other scripts
jQuery(document).ready(function($) {
$("#date_from").datepicker({
    minDate: '-1Y-0M',
	numberOfMonths: 2,
    maxDate: '0',
    onSelect: function (dateStr) {
        var min = $(this).datepicker('getDate'); // Get selected date
        $("#date_to").datepicker('option', 'minDate', min || '+1Y+6M'); // Set other min, default to today
    }
});

$("#date_to").datepicker({
numberOfMonths: 2,
    minDate: '-1Y-0M',
    maxDate: '0',
    onSelect: function (dateStr) {
        var max = $(this).datepicker('getDate'); // Get selected date
        $('#datepicker').datepicker('option', 'maxDate', max || '0'); // Set other max, default to +1 months
        var start = $("#date_from").datepicker("getDate");
        var end = $("#date_to").datepicker("getDate");
        var days = ((end - start) / (1000 * 60 * 60 * 24)/29);
		    var months = days.toFixed(0)
        $("#number_period").val(months);
    }
	});       
});
</script>