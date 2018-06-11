<?php
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
$mapping = array('linnworks_code','product_name','purchase_price','category','supplier','invoice_currency','Landed price in GBP','SP1 price in GBP','SP2 price in GBP','SP3 price in GBP','web_price_gbp','sale_price_gbp','Landed price in EUR','SP1 price in EUR','SP2 price in EUR','SP3 price in EUR','web_price_euro','sale_price_euro','error');
echo $csv->addRow($mapping);

foreach ($purchase_orders as $purchase_order):
$line_code = array($purchase_order['CostCalculator']['linnworks_code']);
$line_name = array($purchase_order['CostCalculator']['product_name']);
$line_value = array($purchase_order['PurchasePrice']['purchase_price']);
//$line_inv = array($purchase_order['CostCalculator']['latest_invoice']);
$line_cate = array($purchase_order['CostCalculator']['category']);
$line_supp = array($purchase_order['CostCalculator']['supplier']);
$invoice_curr = array($purchase_order['CostCalculator']['invoice_currency']);
$land_bgp = array($purchase_order['CostCalculator']['landed_price_gbp']);
$sp1_bgp = array($purchase_order['CostCalculator']['sp1_value_gbp']);
$sp2_bgp = array($purchase_order['CostCalculator']['sp2_value_gbp']);
$sp3_bgp = array($purchase_order['CostCalculator']['sp3_value_gbp']);

$web_gbp = array($purchase_order['AdminListing']['web_sale_price_uk']);
//$sale_price_gbp = array($purchase_order['CostCalculator']['sale_price_gbp']);
$land_eur = array($purchase_order['CostCalculator']['landed_price_eur']);
$sp1_eur = array($purchase_order['CostCalculator']['sp1_value_eur']);
$sp2_eur = array($purchase_order['CostCalculator']['sp2_value_eur']);
$sp3_eur = array($purchase_order['CostCalculator']['sp3_value_eur']);
$web_euro = array($purchase_order['AdminListing']['web_sale_price_de']);
//$sale_price_euro = array($purchase_order['CostCalculator']['sale_price_euro']);
//$sale_error = array($purchase_order['CostCalculator']['error']);
$line = array_merge($line_code,$line_name,$line_value,$line_cate,$line_supp,$invoice_curr,$land_bgp,$sp1_bgp,$sp2_bgp,$sp3_bgp,$web_gbp,$sale_price_gbp,$land_eur,$sp1_eur,$sp2_eur,$sp3_eur,$web_euro,$sale_price_euro);
echo $csv->addRow($line);
endforeach;
$filename='cost_calculators';
echo $csv->render($filename);
}else{	
echo $this->Session->flash(); ?>
 <hr>
 <?php  echo $form->create('CostCalculator',array('action'=>'index','id'=>'saveForm')); ?>
<h1 class="sub-header"><?php __('Cost Calculator');?></h1>
<div class="row">
               <div class="col-sm-6 col-md-6">
                     
                </div>
		<div class="col-sm-4 col-md-6">
			<table class="table-responsive table-striped text-center table table-bordered">
				<tr>				
                                <th><?php __('Sale/Base Currency');?></th>
                                <th><?php __('Invoice Currency');?></th>
                                <th><?php __('Exchange Rate');?></th>          
                                <th><?php __('Exchange Rate Use API');?></th>
				</tr>
				 <?php foreach ($getCost as $exchange_rate): ?>
                                    <tr>
                                    <td><?php echo $exchange_rate['CostSetting']['sale_base_currency']; ?></td>
                                    <td><?php echo $exchange_rate['CostSetting']['invoice_currency']; ?></td>
                                     <?php $normalRate = $exchange_rate['CostSetting']['exchange_rate'];
                                     $amount = "1"; $from = $exchange_rate['CostSetting']['invoice_currency']; $to =  $exchange_rate['CostSetting']['sale_base_currency'];
                                   $url  = "https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to";
                                   
								   $data = file_get_contents($url);
								   $get = explode("<span class=bld>",$data);
									$get = explode("</span>",$get[1]);  
									$converted = preg_replace("/[^0-9\.]/", null, $get[0]);
										
                                   $ApiRate = round($converted, 2); ?>
                                                                       
                                          <?php $normalrate = $ApiRate*($exchange_rate['CostSetting']['variation'])/100;
                                             if(($ApiRate !='0') && ($normalRate >= ($ApiRate+$normalrate))){ ?>
                                            <td class="red-info" title="<?php echo "Nornal Exchange Rate ".$exchange_rate['CostSetting']['variation']."% (". $normalrate . ") More compare to API Rate"?>"><?php echo $normalRate; ?></td>
                                            <?php } else if(($ApiRate !='0') && ($ApiRate >= ($normalRate+$normalrate))){ ?>
                                            <td class="red-info" title="<?php echo "Nornal Exchange Rate ". $exchange_rate['CostSetting']['variation'] ."% (". $normalrate . ")  Less compare to API Rate"?>"><?php echo $normalRate; ?></td>
                                            <?php } else { ?>
                                            <td><?php echo $normalRate; ?></td>
                                            <?php } ?>                                                                        
                                          <td><?php   if($ApiRate =='0'){echo "1";}else {echo $ApiRate;} ?></td>
                                      </tr>
                                 <?php endforeach; ?> 
			</table>
		</div>
	</div>
<div class="panel panel-default">
    <div class="panel-body">       
      <div class="row">     
        <div class="col-md-8 mobile-bottomspace">
        <?php echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php echo $this->Paginator->sort('Sort by update', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import data', true), array('controller' => 'cost_calculators', 'action' => 'importdata'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
        <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php  echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code,Category...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php  echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>      
      </div>
    </div>
</div> 
<div class="table-responsive catname">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>  
          <th></th>         
          <th colspan="5" class="text-center text-uppercase color-white gbp-bg"><?php __('GBP');?></th> 
          <th colspan="5" class="text-center text-uppercase color-white eur-bg"><?php __('EUR');?></th> 
          <th></th> 
        </tr>
        <tr> 
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
          <th class="wid-200"><?php __('Linnworks Code');?></th>
          <th><?php __('Product Name');?></th>      
          <th><?php __('Purchase Price');?></th>
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <?php foreach ($categories as $category): ?>
                     
                    <li><a href="<?php echo  $actual_link ; ?>/cost_calculators/category/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>      
          <th><?php __('Supplier');?></th>          
          <th><?php __('Currency');?></th>          
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>       
           <th><?php __('Web Price');?></th>          
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>
          <th><?php __('Web Price');?></th>          
         <?php if($session->read('Auth.User.group_id')!='3') { ?> <th class="wid-20"><?php __('Action');?></th><?php } ?>
        </tr>
      </thead>
      <tbody>
       <?php foreach ($purchase_orders as $purchase_order): ?>
        <tr> 
         <td><?php $pid = $purchase_order['CostCalculator']['id']; if(!empty($purchase_order['CostCalculator']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
         echo $this->Form->input('CostCalculator.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$pid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($purchase_order['CostCalculator']['error'])){echo "&#8595;";} ?></td>
           <td class="wid-200"><?php echo $purchase_order['CostCalculator']['linnworks_code']; ?></td>
           <?php if(!empty($purchase_order['PurchasePrice']['item_title'])){ ?>
		  <td><?php echo $purchase_order['PurchasePrice']['item_title']; ?></td>
          	<?php }else {?>
		  <td><?php echo $purchase_order['CostCalculator']['product_name']; ?></td>
			<?php } ?>       
          <td><?php echo $purchase_order['PurchasePrice']['purchase_price']; ?></td>   
          <td><?php echo $purchase_order['CostCalculator']['category']; ?></td>
          <td><?php echo $purchase_order['CostCalculator']['supplier']; ?></td>
			<?php if(!empty($purchase_order['PurchasePrice']['invoice_currency'])){ ?>
		  <td><?php echo $purchase_order['PurchasePrice']['invoice_currency']; ?></td>
          	<?php } else if(!empty($purchase_order['CostCalculator']['invoice_currency'])){ ?>
		  <td><?php echo $purchase_order['CostCalculator']['invoice_currency']; ?></td>
			<?php } ?>
		  <td><?php // Currency Master Information in GBP---   
				if(!empty($purchase_order['PurchasePrice']['invoice_currency'])){$purr = $purchase_order['PurchasePrice']['invoice_currency'];}else {$purr = $purchase_order['CostCalculator']['invoice_currency'];}
                foreach ($getCost as $exchange_rate):
                      if(($exchange_rate['CostSetting']['invoice_currency'])===($purr) && (($exchange_rate['CostSetting']['sale_base_currency'])==='GBP')):
                      $GbpLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                    echo "<div><span class=blue>". round($GbpLP, 2) ."</span></div>";  ?></td> 
            <?php   break;endif; endforeach; ?>
           <?php foreach ($getsupp as $getsupps):
           if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='GBP')): ?>
              
             <td><?php $sp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];   echo "<div><span class=blue>".round($GbpLP*$sp1, 2)."</span></div>";    ?></td>
             <td><?php $sp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];  echo "<div><span class=blue>".round($GbpLP*$sp2, 2)."</span></div>";   ?></td>
             <td><?php $sp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];  echo "<div><span class=blue>".round($GbpLP*$sp3, 2) ."</span></div>";    ?></td>
             <?php $salegbp = $purchase_order['AdminListing']['web_sale_price_uk'];
             if(($salegbp > $GbpLP*$sp1) && ($salegbp < $GbpLP*$sp3)){ ?>
             <td><?php echo $purchase_order['AdminListing']['web_sale_price_uk']; ?></td>
             <?php } else { ?>
             <td class="red-info" title="<?php echo "Selling Price not in Between Sp1->".$GbpLP*$sp1. " Sp2->".$GbpLP*$sp2. " Sp3->".$GbpLP*$sp3;?>"><?php echo $purchase_order['AdminListing']['web_sale_price_uk']; ?></td>
            <?php } ?>       
			<?php   break;endif; endforeach; ?>                  
                       
             <td><?php // Currency Master Information in EUR---                   
                foreach ($getCost as $exchange_rate):
                      if(($exchange_rate['CostSetting']['invoice_currency'])===($purr) && (($exchange_rate['CostSetting']['sale_base_currency'])==='EUR')):
                      $ExEurRate = $exchange_rate['CostSetting']['exchange_rate'];
                      $Eurinvoice = $purchase_order['PurchasePrice']['purchase_price'];
                      $EurMull = $purchase_order['Multiplier']['multiplier']; 
                      $EurLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                       echo "<div><span class=blue>". round($EurLP, 2) ."</span></div>";                      
                    ?></td> 
            <?php  break; endif; endforeach; ?>
            <?php foreach ($getsupp as $getsupps):
           if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='EUR')): ?>
                <td><?php $sp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];   echo "<div><span class=blue>".round($EurLP*$sp1, 2) ."</span></div>";    ?></td>
             <td><?php $sp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];  echo "<div><span class=blue>". round($EurLP*$sp2, 2) ."</span></div>";   ?></td>
             <td><?php $sp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];  echo "<div><span class=blue>". round($EurLP*$sp3, 2) ."</span></div>";    ?></td>
            <?php $saleeur = $purchase_order['AdminListing']['web_sale_price_de'];
             if(($saleeur > $EurLP*$sp1) && ($saleeur < $EurLP*$sp3)){ ?>
             <td><?php echo $purchase_order['AdminListing']['web_sale_price_de']; ?></td>
             <?php } else { ?>
             <td class="red-info" title="<?php echo "Selling Price not in Between Sp1->".$EurLP*$sp1. " Sp2->".$EurLP*$sp2. " Sp3->".$EurLP*$sp3;?>"><?php echo $purchase_order['AdminListing']['web_sale_price_de']; ?></td>
              <?php } ?>
			  <?php   break;endif; endforeach; ?>                                  
            <?php if($session->read('Auth.User.group_id')!='3') { ?><td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'cost_calculators','action'=>'edit',$purchase_order['CostCalculator']['id']),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'cost_calculators','action' => 'delete',$purchase_order['CostCalculator']['id']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $purchase_order['CostCalculator']['id']));  ?></td><?php } ?>
            </tr>         
         <?php endforeach; ?>            
      </tbody>
    </table>
  </div>
 <?php echo $this->Form->end();?>
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
    $('#CostCalculatorError').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
                $('#exportfile').removeAttr('disabled');
		$('#selecctall').attr('disabled','disabled');
            });
        }else{
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#selecctall').removeAttr('disabled','disabled');
            });        
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
		$('#CostCalculatorError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#CostCalculatorError').removeAttr('disabled','disabled');
            }); 
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
            }); 
        }
    });
   
});
</script>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<script type="text/javascript">
document.getElementById("category").onchange = function() {
var selectedOption = $(this).find('option:selected').text();
window.location.href = "<?php echo  $actual_link ; ?>/purchase_orders/category/" + selectedOption;
}
</script>
<?php } 