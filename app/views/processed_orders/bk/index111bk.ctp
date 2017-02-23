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
 <h1 class="sub-header"><?php __('Processed Orders');?></h1>
 <?php //print_r($orders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
        <tr> 
      <th><?php __('OrderId');?></th>
      <th><?php __('Currency');?></th> 
     <th><?php __('Plateform');?></th>
     <th><?php __('SubSource');?></th>

       <th><?php __('Quantity');?></th>
       
         <th><?php __('Order Date');?></th>
         <th><?php __('Order value');?></th> 
         
        </tr>
      </thead>
      <tbody>

<?php foreach ($orders as $order): ?>  
      <tr>     
     
        <td><?php echo $order->GeneralInfo->ExternalReferenceNum; ?></td> 
      
        <td><?php echo $order->TotalsInfo->Currency;?></td>  
        <td><?php echo $order->GeneralInfo->Source;?></td> 
         <td><?php echo $order->GeneralInfo->SubSource;?></td>
         <td> <?php for ($i = 0;$i<=count($order->Items); $i++){ ?> 
 
         <?php echo $order->Items[$i]->Quantity; ?>
       
         <?php } ?> </td> 
         <td><?php echo $order->GeneralInfo->ReceivedDate; ?></td>        
          <td><?php echo $order->TotalsInfo->TotalCharge;?></td>
        
          <?Php if($order->GeneralInfo->SubSource ==='Germany'){$Gersum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php if($order->GeneralInfo->SubSource ==='United Kingdom'){$Uksum+= $order->TotalsInfo->TotalCharge; } ?>
            <?Php if($order->GeneralInfo->SubSource ==='EBAY0'){$Ebsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php if($order->GeneralInfo->SubSource ==='France'){$Frsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php if($order->GeneralInfo->SubSource ==='Tesco UK'){$Tessum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php if($order->GeneralInfo->SubSource ==='http://www.homescapesonline.com'){$Magsum+= $order->TotalsInfo->TotalCharge; } ?>
        
        </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
 <p><nav><?php //print_r($pagination); ?></nav></p>
 <!--<canvas id="cvs" width="900" height="250"></canvas>
 <script>
    new RGraph.Bar({
        id: 'cvs',
        data: [<?php echo $Gersum; ?>,<?php echo $Uksum; ?>,<?php echo $Ebsum; ?>,<?php echo $Frsum; ?>,<?php echo $Tessum; ?>,<?php echo $Magsum; ?>],
        options: {
            title: 'Price comparison on different platform',
            titleSubtitle: 'Last 2-3 Month',
            textSize: 16,
            textAccessible: true,
            labels: ['Germany','United Kingdom','EBAY0','France','Tesco UK','MAGENTO'],
            shadowBlur: 0,
            shadowOffsetx: 50,
            shadowOffsety: 50,
            strokestyle: 'rgba(0,0,0,0)',
            backgroundGridVlines: false,
            backgroundGridBorder: false,
            noxaxis: true,
            colors: ['blue','#eee']
        }
    }).grow();
</script>-->
<?php } 