<?php
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
 <h1 class="sub-header"><?php __('Stock inventory information');?></h1>
 <?php //print_r($orders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      <th><?php __('Stock Date');?></th>
      <th><?php __('Stock Level');?></th> 
     <th><?php __('Stock Value');?></th>
     <th><?php __('Stock ItemId');?></th>   
      </tr>
      </thead>
      <tbody>

<?php foreach ($orders as $order): ?>  
      <tr>     
     
        <td><?php //echo $order->Date; ?></td>       
        <td><?php //echo $order->Level;?></td>  
        <td><?php //echo $order->StockValue;?></td> 
         <td><?php //echo $order->StockItemId;?></td>
		 
      </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
 <p><nav><?php //print_r($pagination); ?></nav></p>
<a href="#" onclick="pageloader();">Click here</a>
<script>
function pageloader()
{
<?php for ($i=1; $i<=100; $i++) { ?>
 window.open("http://ukwalahome.com/stock_levels/getstockitems?page=<?php echo $i; ?>", '_blank');
<?php } ?>
}
</script>
<?php } echo "Amit kumar tiwari";
