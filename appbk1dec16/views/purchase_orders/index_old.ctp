<h1 class="sub-header"><?php __('Cost Calculator');?></h1>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('PurchaseOrder',array('action'=>'index','id'=>'saveForm')); ?>
          <div class="col-md-8 mobile-bottomspace">
              <?php echo $this->Html->link(__('Import data', true), array('controller' => 'purchase_orders', 'action' => 'importdata'),array('class' => 'btn btn-info btn-sm')); ?>
         </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php  echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php  echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>
       <?php echo $this->Form->end();?>
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
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg">GBP</th>          
          <th colspan="6" class="text-center text-uppercase color-white eur-bg">EUR</th>          
        </tr>
        <tr>               
          <th>Linnworks Code</th>
          <th>Product Name</th>          
          <th>Invoice value</th>
          <th>Supplier</th>
          <th>Currency</th>          
          <th>Landed Price</th>
          <th>S.P.1</th>
          <th>S.P.2</th>
          <th>S.P.3</th>
          <th>Selling Price</th>        
          <th class="pink-price">RRP</th>
          <th>Landed Price</th>
          <th>S.P.1</th>
          <th>S.P.2</th>
          <th>S.P.3</th>
          <th>Selling Price</th>        
          <th class="pink-price">RRP</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($purchase_orders as $purchase_order): ?>
          <tr>
          <td><?php echo $purchase_order['PurchaseOrder']['linnworks_code']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['product_name']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['invoice_value']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['supplier']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['invoice_currency']; ?></td>
          <td><?php // Currency Master Information in GBP---
                    $amount = "1"; $from = "GBP"; $to = $purchase_order['PurchaseOrder']['invoice_currency'];
                    $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                     $data = file_get_contents($url);
                      preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
                     $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
                     $ExRate = round($converted, 2);
                     $invoice = $purchase_order['PurchaseOrder']['invoice_value'];
                     $SMull = $purchase_order['PurchaseOrder']['multiplier'];
                     if((($purchase_order['PurchaseOrder']['invoice_currency'])==='GBP')){ $landPR = $SMull*$invoice*1;}else{$landPR = $SMull*$invoice*$ExRate; }           
                        echo $landPR; ?></td>
          <td><?php echo $landPR*$purchase_order['PurchaseOrder']['sp1_multiplier']; ?></td>
          <td><?php echo $landPR*$purchase_order['PurchaseOrder']['sp2_multiplier']; ?></td>
          <td><?php echo $landPR*$purchase_order['PurchaseOrder']['sp3_multiplier']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['sale_price_gbp']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['price_gbp']; ?></td>
          <td><?php  // Currency Master Information in EURO---
                    $amount = "1"; $from = "EUR";$to =  $purchase_order['PurchaseOrder']['invoice_currency'];
                    $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                    $data = file_get_contents($url);
                     preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
                     $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
                     $ExRate = round($converted, 2);
                     $invoice = $purchase_order['PurchaseOrder']['invoice_value'];
                     $SMull = $purchase_order['PurchaseOrder']['multiplier'];
                     if((($purchase_order['PurchaseOrder']['invoice_currency'])==='EUR')){ $landP = $SMull*$invoice*1;}else{$landP = $SMull*$invoice*$ExRate; } 
                     echo $landP; ?></td>
          <td><?php echo $landP*$purchase_order['PurchaseOrder']['sp1_multiplier']; ?></td>
          <td><?php echo $landP*$purchase_order['PurchaseOrder']['sp2_multiplier']; ?></td>
          <td><?php echo $landP*$purchase_order['PurchaseOrder']['sp3_multiplier']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['sale_price_euro']; ?></td>
          <td><?php echo $purchase_order['PurchaseOrder']['price_euro']; ?></td>         
          </tr>
         <?php endforeach; ?>            
      </tbody>
    </table>
  </div>



