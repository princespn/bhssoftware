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
<?php //print_r($previousweeks[14]['ProcessedOrder']);


$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);


 
//echo "Current week range from $this_week_sd to $this_week_ed ";

       // echo $start_week.' '.$end_week ;

/*
 * 
 * $monday = strtotime("last monday");
$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
$sunday = strtotime(date("Y-m-d",$monday)." -6 days");
 
$this_week_sd = date("Y-m-d",$monday);
$this_week_ed = date("Y-m-d",$sunday);
 * 
 * $previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last sunday midnight",$previous_week);
$end_week = strtotime("next saturday",$start_week);

$start_week = date("Y-m-d",$start_week);
$end_week = date("Y-m-d",$end_week);
 
//echo "Current week range from $this_week_sd to $this_week_ed";

$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last sunday midnight",$previous_week);
$end_week = strtotime("next saturday",$start_week);

$start_week = date("Y-m-d",$start_week);
$end_week = date("Y-m-d",$end_week);

       // echo $start_week.' '.$end_week ;*/

$present_week = strtotime("-2 week +1 day");

$second_week = strtotime("last monday midnight",$present_week);
$send_week = strtotime("next sunday",$second_week);

$start_week = date("Y-m-d",$second_week);
$end_week = date("Y-m-d",$send_week);

?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table"> 
            <th colspan="2"></th>
         <th colspan="3" class="text-center text-uppercase color-black green-bg"><?php __('Current Week');?><?php echo "( ".$this_week_sd." - To - ".$this_week_ed." )"; ?></th>
         <th></th>
         <th colspan="3" class="text-center text-uppercase color-black yellow-bg"><?php __('Previous Week');?><?php echo "( ".$start_week." - To - ".$end_week." )"; ?></th>
        <th></th>
         <th colspan="3" class="text-center text-uppercase color-black last-bg"><?php __('Same Week Last Year');?><?php echo "( ".$a." - To - ".$b." )"; ?></th>
        <th></th>
       </tr>
       <tr>
         <th colspan="2"><?php __('Sales Channel Name');?></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th>         
         <th></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th> 
           <th></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th>  
        </tr>
      </thead>
      <tbody>
         <?php  foreach ($currents as $value): ?>   
           <tr>               
              <td colspan="2"><?php echo $value['ProcessedOrder']['subsource']; ?></td>
               <td><?php echo $value[0]['orderid']; ?></td>
               <td><?php echo $value['ProcessedOrder']['currency']; //echo $current[$key]['ProcessedOrder']['currency']; ?></td>          
               <td><?php echo round($value[0]['ordervalues'],2); ?></td> 
             </tr>
             <?php endforeach; ?>                 
           </tbody>
    </table>

  </div>
<?php } ?>