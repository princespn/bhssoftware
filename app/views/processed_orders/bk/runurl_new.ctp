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


$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last monday midnight",$present_year_week);
$end_year_week = strtotime("next sunday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);

?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr id="head-table"> 
         
         <th class="text-center text-uppercase color-black green-bg"><?php __('Current Week');?><?php echo "( ".$this_week_sd." - To - ".$this_week_ed." )"; ?></th>
        
         <th  class="text-center text-uppercase color-black yellow-bg"><?php __('Previous Week');?><?php echo "( ".$start_week." - To - ".$end_week." )"; ?></th>
      
         <th class="text-center text-uppercase color-black last-bg"><?php __('Same Week Last Year');?><?php echo "( ".$main_last_week." - To - ".$main_end_week." )"; ?></th>
       
       </tr>
       <tr>
        <td>
        <table class="table table-bordered table-striped table-hover">
         <thead>        
        <tr>
         <th><?php __('Sales Channel Name');?></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th>        
        </tr>
      </thead>
      <tbody>
         <?php  foreach ($currents as $value): ?>   
           <tr>               
              <td><?php echo $value['ProcessedOrder']['subsource']; ?></td>
               <td><?php echo $value[0]['orderid']; ?></td>
               <td><?php echo $value['ProcessedOrder']['currency']; //echo $current[$key]['ProcessedOrder']['currency']; ?></td>          
               <td><?php echo round($value[0]['ordervalues'],2); ?></td> 
               <?php $Gersum+= $value[0]['ordervalues']; ?>
             </tr>
             <?php endforeach; ?> 
             <tr><td colspan="3"><?php __('Total Orders Value ');?></td><td colspan="1"><?php echo round($Gersum,2); ?></td></tr>
             </tbody>
    </table>
            </td>
            <td>
                <table class="table table-bordered table-striped table-hover">
      <thead>
        
       <tr>
       <th><?php __('Sales Channel Name');?></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th> 
          
     
        </tr>
      </thead>
      <tbody>
         <?php  foreach ($previousweeks as $previousweek): ?>   
           <tr>               
               <td><?php echo $previousweek['ProcessedOrder']['subsource']; ?></td>
               <td><?php echo $previousweek[0]['orderid']; ?></td>
               <td><?php echo $previousweek['ProcessedOrder']['currency']; //echo $current[$key]['ProcessedOrder']['currency']; ?></td>          
               <td><?php echo round($previousweek[0]['ordervalues'],2); ?></td> 
               <?php $FRsum+= $previousweek[0]['ordervalues']; ?>
             </tr>
             <?php endforeach; ?> 
              <tr><td colspan="3"><?php __('Total Orders Value ');?></td><td colspan="1"><?php echo round($FRsum,2); ?></td></tr>
          </tbody>
    </table>
            </td>
            <td>
                <table class="table table-bordered table-striped table-hover">
      <thead>
        
       <tr>
         <th><?php __('Sales Channel Name');?></th>
         <th><?php __('No of Orders');?></th>
          <th><?php __('Currency');?></th>
          <th><?php __('Order Value');?></th>  
        </tr>
      </thead>
      <tbody>
         <?php  foreach ($datalastweeks as $datalastweek): ?>   
           <tr>               
              <td><?php echo $datalastweek['ProcessedOrder']['subsource']; ?></td>
               <td><?php echo $datalastweek[0]['orderid']; ?></td>
               <td><?php echo $datalastweek['ProcessedOrder']['currency']; //echo $current[$key]['ProcessedOrder']['currency']; ?></td>          
               <td><?php echo round($datalastweek[0]['ordervalues'],2); ?></td> 
                   <?php $PRsum+= $datalastweek[0]['ordervalues']; ?>
             </tr>
             <?php endforeach; ?> 
                <tr><td colspan="3"><?php __('Total Orders Value ');?></td><td colspan="1"><?php echo round($PRsum,2); ?></td></tr>
           </tbody>
    </table>
            </td>
            
            
        </tr>
    </table>
 </div>
<div style="display: inline-block; margin: 35px">
    <canvas id="cvs" width="900" height="450">[No canvas support]</canvas>
</div>
<script>
    new RGraph.Bar({
        id: 'cvs',
        data: [ [16388.23,34769.09,18336.1], [5379.44,12557.31,4788.64], [395.72,1305.46,1120.84], [2975.02,6228.8,0], [1525.16,2683.23,1282.69], [339.37,1076.56,229.84], [3875.89,6687.26,3785.99], [1108.88,1541.74,927.41], [6404.85,15354.54,6862.62], [687.81,1149.48,1805.07] ],
        options: {
            textAccessible: true,
            variant: '3d',
            variantThreedAngle: 0.1,
            strokestyle: 'rgba(0,0,0,0)',
            colors: ['Gradient(#00b300:green)', 'Gradient(#ffff1a:yellow)','Gradient(#e6ac00:#e6ac00)'],
            gutterTop: 5,
            gutterLeft: 45,
            gutterRight: 15,
            gutterBottom: 10,
            labels: ['Amazon Uk',' Magento uk','EBay',' Tesco',' CDiscount',' Magento Fr',' Amazon Fr',' Amazon Sp',' Amazon Gr',' Magento Gr'],
            shadowColor:'#ccc',
            shadowOffsetx: 3,
            backgroundGridColor: '#eee',
            scaleZerostart: true,
            axisColor: '#ddd',
            unitsPost: '',
            title: 'Progress Report weekly',
            key: ['Current Week','Previous Week','Same Week Last Year'],
            keyShadow: true,
            keyShadowColor: '#ccc',
            keyShadowOffsety: 0,
            keyShadowOffsetx: 3,
            keyShadowBlur: 15
        }
    }).draw();
</script>
<?php } ?>