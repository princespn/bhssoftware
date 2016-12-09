<?php
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}

if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
$mapping = array('sku','linnworks_code','product_name','category','invoice_value','supplier','invoice_currency','price_gbp','sale_price_gbp','price_euro','sale_price_euro','error');
echo $csv->addRow($mapping);

foreach ($purchase_orders as $purchase_order):    
$line_sku = array($purchase_order['PurchaseOrder']['sku']);
$line_code = array($purchase_order['PurchaseOrder']['linnworks_code']);
$line_name = array($purchase_order['PurchaseOrder']['product_name']);
$line_cate = array($purchase_order['PurchaseOrder']['category']);
$line_value = array($purchase_order['PurchaseOrder']['invoice_value']);
$sup_name = array($purchase_order['PurchaseOrder']['supplier']);
$invoice_curr = array($purchase_order['PurchaseOrder']['invoice_currency']);
$uk_gbp = array($purchase_order['PurchaseOrder']['price_gbp']);
$sale_price_gbp = array($purchase_order['PurchaseOrder']['sale_price_gbp']);
$rrp_euro = array($purchase_order['PurchaseOrder']['price_euro']);
$sale_price_euro = array($purchase_order['PurchaseOrder']['sale_price_euro']);
//$sale_error = array($purchase_order['PurchaseOrder']['error']);
$line = array_merge($line_sku,$line_code,$line_name,$line_cate,$line_value,$sup_name,$invoice_curr,$uk_gbp,$sale_price_gbp,$rrp_euro,$sale_price_euro);
echo $csv->addRow($line);
endforeach;
$filename='code_purchase_orders';
echo $csv->render($filename);
}else{	
echo $this->Session->flash(); ?>
 <hr>
 <?php  echo $form->create('PurchaseOrder',array('action'=>'index','id'=>'saveForm')); ?>
<h1 class="sub-header"><?php __('Cost Calculator');?></h1>
<div class="row">
                <div class="col-sm-6 col-md-6">
                            <label>Select Category </label>
                    <select id="category" name="data[PurchaseOrder][category]">
                    <option value='category'><?php __('Please select category.');?></option>
                    <?php foreach ($categories as $category): ?>
                    <?php if((!empty($options)) && ($options===$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($category->CategoryName) .'>'. $category->CategoryName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select>
                </div>
		<div class="col-sm-4 col-md-6">
			<table class="table-responsive table-striped text-center table table-bordered">
				<tr>				
                                <th><?php __('Sale/Base Currency');?></th>
                                <th><?php __('Invoice Currency');?></th>
                                <th><?php __('Exchange Rate');?></th>          
                                <th><?php __('Exchange Rate Use API');?></th>
				</tr>
				 <?php foreach ($exchange_rates as $exchange_rate): ?>
                                    <tr>
                                    <td><?php echo $exchange_rate['PurchaseOrder']['sale_base_currency']; ?></td>
                                    <td><?php echo $exchange_rate['PurchaseOrder']['invoice_currency']; ?></td>
                                    <td><?php echo $exchange_rate['PurchaseOrder']['exchange_rate']; ?></td>
                                    <td><?php       $amount = "1"; $from = $exchange_rate['PurchaseOrder']['invoice_currency']; $to =  $exchange_rate['PurchaseOrder']['sale_base_currency'];
                                                         $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                                                         $data = file_get_contents($url);
                                                          preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
                                                          $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
                                                          $ExRate = round($converted, 2); if($ExRate =='0'){echo "1";}else {echo $ExRate;}?></td>
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
        <?php echo $this->Html->link(__('Import data', true), array('controller' => 'purchase_orders', 'action' => 'importdata'),array('class' => 'btn btn-info btn-sm')); ?>
        <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php  echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code,SKU...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php  echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>      
      </div>
    </div>
</div> 
<div class="table-responsive">
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
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg"><?php __('GBP');?></th>          
          <th colspan="6" class="text-center text-uppercase color-white eur-bg"><?php __('EUR');?></th>          
        </tr>
        <tr> 
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
          <th><?php __('Linnworks Code');?></th>
          <th><?php __('Product Name');?></th>          
          <th><?php __('Invoice value');?></th>
          <th><?php __('Latest Invoice');?></th>  
          <th><?php __('Supplier');?></th>
          <th><?php __('Currency');?></th>          
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>
         <!-- <th><?php __('Web Price');?></th>---> 
          <th><?php __('Selling Price');?></th>        
          <th class="pink-price"><?php __('RRP');?></th>
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>
          <th><?php __('Selling Price');?></th>        
          <th class="pink-price"><?php __('RRP');?></th>
          <th class="wid-20"><?php __('Action');?></th>      
        </tr>
      </thead>
      <tbody>
      <?php foreach ($purchase_orders as $purchase_order): ?>
          <tr>
         <td><?php $pid = $purchase_order['PurchaseOrder']['id']; if(!empty($purchase_order['PurchaseOrder']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
         echo $this->Form->input('PurchaseOrder.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$pid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($purchase_order['PurchaseOrder']['error'])){echo "&#8595;";} ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['linnworks_code']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['product_name']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['invoice_value']; ?></td>
         <td><?php echo $purchase_order['PurchaseOrder']['latest_invoice']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['supplier']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['invoice_currency']; ?></td>
          <td><?php // Currency Master Information in GBP---
                     $invoice = $purchase_order['PurchaseOrder']['invoice_value'];
                     $SMull = $purchase_order['PurchaseOrder']['multiplier'];
                     $ExchangeRate = $purchase_order['PurchaseOrder']['exchange_rate'];
                     if((($purchase_order['PurchaseOrder']['invoice_currency'])==='GBP')) {
                         $LandPrice = $SMull*$invoice*1;
                         }else{
                          $LandPrice = $SMull*$invoice*$ExchangeRate;
                         }           
                         
                        $amount = "1"; 
                        $from = $purchase_order['PurchaseOrder']['invoice_currency']; 
                        $to = $purchase_order['PurchaseOrder']['sale_base_currency'];
                        $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                        $data = file_get_contents($url);
                         preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
                         $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
                        $ExRate = round($converted, 2);                   
                     if((($purchase_order['PurchaseOrder']['invoice_currency'])==='GBP')){
                            $landPR = $SMull*$invoice*1;
                             }else{
                             $landPR = $SMull*$invoice*$ExRate; 
                              }           
                     echo "<div><span class=blue>". $LandPrice ."</span><span class=green>".$landPR."</span></div>";                      
                     ?></td>
             <td><?php $sp1 = $purchase_order['PurchaseOrder']['sp1_multiplier'];   echo "<div><span class=blue>". $LandPrice*$sp1 ."</span><span class=green>".$landPR*$sp1."</span></div>";    //echo $LandPrice*$sp1; echo "/";  echo $landPR*$sp1;  ?></td>
             <td><?php $sp2 = $purchase_order['PurchaseOrder']['sp2_multiplier'];  echo "<div><span class=blue>". $LandPrice*$sp2 ."</span><span class=green>".$landPR*$sp2."</span></div>";  //echo $LandPrice*$sp2; echo "/";  echo $landPR*$sp2;  ?></td>
             <td><?php $sp3 = $purchase_order['PurchaseOrder']['sp3_multiplier'];  echo "<div><span class=blue>". $LandPrice*$sp3 ."</span><span class=green>".$landPR*$sp3."</span></div>";  //echo $LandPrice*$sp3; echo "/";  echo $landPR*$sp3;  ?></td>
             <!---<td><?php //echo $purchase_order['PurchaseOrder']['web_price']; ?></td>-->
             <td><?php echo $purchase_order['PurchaseOrder']['sale_price_gbp']; ?></td>
             <td><?php echo $purchase_order['PurchaseOrder']['price_gbp']; ?></td>
             <td><?php  // Currency Master Information in EURO---
                    
                                $inv_value = $purchase_order['PurchaseOrder']['invoice_value'];
                                $SaleMull = $purchase_order['PurchaseOrder']['multiplier'];
                                $Exch_Rate = $purchase_order['PurchaseOrder']['exchange_rate'];
                                $invoice = $purchase_order['PurchaseOrder']['invoice_value'];
                         
                                if((($purchase_order['PurchaseOrder']['invoice_currency'])==='EUR')){
                                  $landedPrice = $SaleMull*$inv_value*1;                            
                                  }else{
                                    $landedPrice = $SaleMull*$inv_value*$Exch_Rate; 
                                    } 
                                    
                                  $amount = "1"; 
                                 $from = $purchase_order['PurchaseOrder']['invoice_currency'];
                                 $to = $purchase_order['PurchaseOrder']['sale_base_currency'];
                                  $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                                 $data = file_get_contents($url);
                                 preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
                                 $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
                                  $ExRate = round($converted, 2);
                                 $invoice = $purchase_order['PurchaseOrder']['invoice_value'];
                                 $SMull = $purchase_order['PurchaseOrder']['multiplier'];
                                 
                                    if((($purchase_order['PurchaseOrder']['invoice_currency'])==='EUR')){
                                     $landP = $SMull*$invoice*1;
                                     }else{
                                    $landP = $SMull*$invoice*$ExRate;
                                    } 
                                    
                            echo "<div><span class=blue>". $landedPrice ."</span><span class=green>".$landP."</span></div>";   //echo $landedPrice; echo "/";  echo $landP;
                            ?></td>
                 <td><?php $sp1 = $purchase_order['PurchaseOrder']['sp1_multiplier'];  echo "<div><span class=blue>". $landedPrice*$sp1 ."</span><span class=green>".$landP*$sp1."</span></div>"; //echo $landedPrice*$sp1; echo "/";  echo $landP*$sp1;  ?></td>
                 <td><?php $sp2 = $purchase_order['PurchaseOrder']['sp2_multiplier'];  echo "<div><span class=blue>". $landedPrice*$sp2 ."</span><span class=green>".$landP*$sp2."</span></div>"; //echo $landedPrice*$sp2; echo "/";  echo $landP*$sp2;  ?></td>
                 <td><?php $sp3 = $purchase_order['PurchaseOrder']['sp3_multiplier'];  echo "<div><span class=blue>". $landedPrice*$sp3 ."</span><span class=green>".$landP*$sp3."</span></div>"; //echo $landedPrice*$sp3; echo "/";  echo $landP*$sp3;  ?></td>
                 <td><?php echo $purchase_order['PurchaseOrder']['sale_price_euro']; ?></td>
                 <td><?php echo $purchase_order['PurchaseOrder']['price_euro']; ?></td>
                 <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'purchase_orders','action'=>'edit', $pid),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'purchase_orders','action' => 'delete',$productid), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $purchase_order['PurchaseOrder']['sku']));  ?></td>
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
    $('#PurchaseOrderError').click(function(event) {  //on click
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
		$('#PurchaseOrderError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#PurchaseOrderError').removeAttr('disabled','disabled');
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