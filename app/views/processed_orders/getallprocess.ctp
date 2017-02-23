<?php
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}

if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
    
/*$mapping = array('Linnworks Code','Category','Product name','Amazon SKU','Web SKU','Web UK RRP','DM RRP','Amazon UK RRP','Web Sale Price UK','Web Sale Price Tesco','Web Sale Price dm','Amazon UK Sale Price','Web DE RRP','Amazon DE RRP','Web FR RRP','Amazon FR RRP','Web DE Sale Price','Amazon DE Sale Price','Web FR Sale Price','Amazon FR Sale Price','Errors');
echo $csv->addRow($mapping);

foreach ($code_listings as $code_listing):
$line_code = array($code_listing['MasterListing']['linnworks_code']);
$line_cate = array($code_listing['MasterListing']['category']);
$line_name = array($code_listing['MasterListing']['product_name']);
$line_ams = array($code_listing['MasterListing']['amazon_sku']);
$line_sku = array($code_listing['AdminListing']['web_sku']);
$web_uk_rp = array($code_listing['AdminListing']['web_price_uk']);
$tasko_rp = array($code_listing['AdminListing']['web_price_dm']);
$uk_rp = array($code_listing['MasterListing']['price_uk']);
$web_uk = array($code_listing['AdminListing']['web_sale_price_uk']);
$web_tasko = array($code_listing['AdminListing']['web_sale_price_tesco']);
$web_dm = array($code_listing['AdminListing']['web_sale_price_dm']);
$sale_price_uk = array($code_listing['MasterListing']['sale_price_uk']);
$web_rrp_de = array($code_listing['AdminListing']['web_price_de']);
$rrp_de = array($code_listing['MasterListing']['price_de']);
$web_rrp_fr = array($code_listing['AdminListing']['web_price_fr']);
$rrp_fr = array($code_listing['MasterListing']['price_fr']);
$web_de = array($code_listing['AdminListing']['web_sale_price_de']);
$sale_price_de = array($code_listing['MasterListing']['sale_price_de']);
$web_fr = array($code_listing['AdminListing']['web_sale_price_fr']);
$sale_price_fr = array($code_listing['MasterListing']['sale_price_fr']);
$sale_error = array($code_listing['MasterListing']['error']);
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$web_fr,$sale_price_fr,$sale_error);
echo $csv->addRow($line);
endforeach;

$filename='code_listings';
echo $csv->render($filename);*/
}else{	
echo $this->Session->flash(); ?>
 <hr>
 <h1 class="sub-header"><?php __('Processed Orders get for pkOrderID');?></h1>
 <?php //print_r($porders->Data); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
        <tr> 
      <th><?php __('OrderId');?></th>
      <th><?php __('Product SKU');?></th>
      <th><?php __('Currency');?></th> 
     <th><?php __('Plateform');?></th>
     <th><?php __('SubSource');?></th>
     <th><?php __('Category');?></th>
      <th><?php __('Product name');?></th>
       <th><?php __('Quantity');?></th>
        <th><?php __('Stocks');?></th>
         <th><?php __('Order Date');?></th>
         <th><?php __('Order value');?></th> 
         
        </tr>
      </thead>
      <tbody>
<?php foreach ($orders->Data as $order): ?>  
      <tr>     
       <?php //foreach ($order->Items as $item): ?> 
        <td><?php echo $order->NumOrderId; ?></td> 
       <td><?php echo $order->Items[0]->SKU; ?></td>
        <td><?php echo $order->TotalsInfo->Currency;?></td>  
        <td><?php echo $order->GeneralInfo->Source;?></td> 
         <td><?php echo $order->GeneralInfo->SubSource;?></td> 
         <td><?php echo $order->Items[0]->CategoryName; ?></td> 
         <td><?php echo $order->Items[0]->Title; ?></td> 
         <td><?php echo $order->Items[0]->Quantity; ?></td> 
         <td><?php echo $order->Items[0]->AvailableStock; ?></td> 
         <?php //endforeach; ?> 
         <td><?php echo $order->GeneralInfo->ReceivedDate; ?></td>        
          <td><?php echo $order->TotalsInfo->TotalCharge;?></td>
                   
        
        </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
<?php } 