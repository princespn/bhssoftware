<?php
if(($session->read('Auth.User.group_id')!='4') && ($session->read('Auth.User.group_id')!='5'))
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


 
$present_week = strtotime("-2 week +1 day");

$second_week = strtotime("last monday midnight",$present_week);
$send_week = strtotime("next sunday",$second_week);

$start_week = date("Y-m-d",$second_week);
$end_week = date("Y-m-d",$send_week);


$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);
?>
  <h1 class="sub-header"><?php __('Sales Per-Channel Weekly Orders Reports');?></h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-8 mobile-bottomspace">
        <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Orders CSV', true), array('controller' => 'processed_orders', 'action' => 'importprocessed'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">         
          </div>
        </div>
      </div>
    </div>
  </div> 
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
         <tr id="head-table"> 
          <?php if(($session->read('Auth.User.group_id')==='5')){ $rowcol = '4'; } ?> 
           <?php if(($session->read('Auth.User.group_id')==='4')){ $rowcol = '5'; } ?>
            <th colspan="<?php echo $rowcol; ?>" class="text-center text-uppercase color-black green-bg"><?php __('Current Week');?><?php echo "( ".$this_week_sd." - To - ".$this_week_ed." )"; ?></th>
        
            <th  colspan="<?php echo $rowcol; ?>" class="text-center text-uppercase color-black yellow-bg"><?php __('Previous Week');?><?php echo "( ".$start_week." - To - ".$end_week." )"; ?></th>
      
            <th colspan="<?php echo $rowcol; ?>" class="text-center text-uppercase color-black last-bg"><?php __('Same Week Last Year');?><?php echo "( ".$main_last_week." - To - ".$main_end_week." )"; ?></th>
       
       </tr>
       <tr><td><?php __('Sales Platform');?></td><td><?php __('Sales Channel');?></td><td><?php __('No of Orders');?></td><td><?php __('Currency');?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php __('Order Value');?><? } ?></td><td><?php __('No of Orders');?></td><td><?php __('Order Progress');?></td><td><?php __('Currency');?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php __('Order value');?></td><?php } ?><td><?php __('Value Progress');?></td><td><?php __('No of Orders');?></td><td><?php __('Order Progress');?></td><td><?php __('Currency');?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php __('Order value');?></td><?php } ?><td><?php __('Value Progress');?></td></tr>
        <?php $currdata = array(); $prevdata = array(); $lastdata = array(); ?>
         <?php foreach ($savealldataweeks as $value): ?>
            <tr> 
             <td><?php if(!empty($value['ProcessedOrder']['plateform'])){ echo $value['ProcessedOrder']['plateform']; }else {echo "-";}; ?></td>
             <td><?php if(!empty($value['ProcessedOrder']['subsource'])){ echo $value['ProcessedOrder']['subsource']; }else {echo "-";}; ?></td>
                           
               <!--  start Current database's years-->
               
                    <?php  $currennumeur = array(); $currenvalueeur = array(); $currencurreur = array(); ?>
                    <?php  $currennumgbp = array(); $currenvaluegbp = array(); $currencurregbp = array(); ?>
                    <?php  foreach ($currents as $currentweek): ?> 
                    <?php if(($value['ProcessedOrder']['subsource'] === $currentweek['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $currentweek['ProcessedOrder']['plateform'])) {?>
                    <?php if($currentweek['ProcessedOrder']['currency']==='EUR'){$currennumeur[] = $currentweek[0]['orderid']; $currenvalueeur[] = $currentweek[0]['ordervalues']; $currencurreur[] = $currentweek['ProcessedOrder']['currency'];} else if($currentweek['ProcessedOrder']['currency']==='GBP'){ $currennumgbp[] = $currentweek[0]['orderid']; $currenvaluegbp[] = $currentweek[0]['ordervalues']; $currencurregbp[] = $currentweek['ProcessedOrder']['currency']; }  ?>                              
                    <?php if($currentweek['ProcessedOrder']['currency'] ==='EUR'){ $Gerordersumeur += $currentweek[0]['orderid']; $Gersumeur+= $currentweek[0]['ordervalues']*0.84;}else if($currentweek['ProcessedOrder']['currency'] ==='GBP'){$Gerordersumgbp += $currentweek[0]['orderid']; $Gersumgbp+= $currentweek[0]['ordervalues'];} ?>
                    <?php /* Combine data in Reports */
						if(($currentweek['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_currweek += $currentweek[0]['orderid']; $totalorder_amazon_currweek += $currentweek[0]['ordervalues'];}
						if(($currentweek['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_currweek_germany += $currentweek[0]['orderid']; $totalorder_amazon_currweek_germany += $currentweek[0]['ordervalues']*0.84;}
						if(($currentweek['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_currweek_france += $currentweek[0]['orderid']; $totalorder_amazon_currweek_france += $currentweek[0]['ordervalues']*0.84;}
						if(($currentweek['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_currweek_spain += $currentweek[0]['orderid']; $totalorder_amazon_currweek_spain += $currentweek[0]['ordervalues']*0.84;}
					
					/* End Combine data in Reports */ ?>
					<?php } ?>
                    <?php endforeach; ?>           
               
                    <td><?php if($currencurreur[0]==='EUR'){ echo $currennumeur[0]; } else if ($currencurregbp[0]==='GBP'){echo $currennumgbp[0]; } else {echo "-";}?></td>
                    <td><?php if($currencurreur[0]==='EUR'){echo $currencurreur[0];}else if($currencurregbp[0]==='GBP') {echo $currencurregbp[0]; } else{echo "-";}  ?></td>          
                    <?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php if($currencurreur[0]==='EUR'){  $curorder[0] = $currenvalueeur[0]*0.84; echo  round($curorder[0],2);   } else if ($currencurregbp[0]==='GBP'){echo round($currenvaluegbp[0],2); } else {echo "-";}?></td><?php } ?>

                    <!-- End Current and start previous database's  years-->
                    
                        <?php  $pordernumeur = array(); $pordervalueeur = array(); $pordercurreur = array(); ?>
                        <?php  $pordernumgbp = array(); $pordervaluegbp = array(); $pordercurregbp = array(); ?>
                        <?php  foreach ($previousweeks as $previousweek): ?> 
                        <?php if(($value['ProcessedOrder']['subsource'] === $previousweek['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweek['ProcessedOrder']['plateform'])) {?>
                        <?php if($previousweek['ProcessedOrder']['currency']==='EUR'){$pordernumeur[] = $previousweek[0]['orderid']; $pordervalueeur[] = $previousweek[0]['ordervalues']; $pordercurreur[] = $previousweek['ProcessedOrder']['currency'];} else if($previousweek['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp[] = $previousweek[0]['orderid']; $pordervaluegbp[] = $previousweek[0]['ordervalues']; $pordercurregbp[] = $previousweek['ProcessedOrder']['currency']; }  ?>                              
                        <?php if($previousweek['ProcessedOrder']['currency'] ==='EUR'){ $FRordersumeur+= $previousweek[0]['orderid']; $FRsumeur+= $previousweek[0]['ordervalues']*0.84;}else if($previousweek['ProcessedOrder']['currency'] ==='GBP'){$FRordersumgbp+= $previousweek[0]['orderid']; $FRsumgbp+= $previousweek[0]['ordervalues'];} ?>
                        
						<?php /* Combine data in Reports */
						if(($previousweek['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek += $previousweek[0]['orderid']; $totalorder_amazon_preevweek += $previousweek[0]['ordervalues'];}
						if(($previousweek['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany += $previousweek[0]['orderid']; $totalorder_amazon_preevweek_germany += $previousweek[0]['ordervalues']*0.84;}
						if(($previousweek['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france += $previousweek[0]['orderid']; $totalorder_amazon_preevweek_france += $previousweek[0]['ordervalues']*0.84;}
						if(($previousweek['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain += $previousweek[0]['orderid']; $totalorder_amazon_preevweek_spain += $previousweek[0]['ordervalues']*0.84;}
						
						/* End Combine data in Reports */ ?>
					
						<?php } ?>
                        <?php endforeach; ?>
               

                        <td><?php if($pordercurreur[0]==='EUR'){ echo $pordernumeur[0]; } else if ($pordercurregbp[0]==='GBP'){echo $pordernumgbp[0]; } else {echo "-";}?></td>
                        <td><?php if((!empty($currennumeur[0])) && ($pordercurreur[0]==='EUR')){ $curproder = ((($currennumeur[0]/$pordernumeur[0])-1)*100);   if($curproder < 0) {echo "<div class='rTableCell color-red'>".round($curproder,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curproder,2)."%"."</div>";} }else if((!empty($currennumgbp[0])) && ($pordercurregbp[0]==='GBP')){ $curprodergbp = ((($currennumgbp[0]/$pordernumgbp[0])-1)*100);   if($curprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($curprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?></td>
                        <td><?php if($pordercurreur[0]==='EUR'){echo $pordercurreur[0];}else if($pordercurregbp[0]==='GBP') {echo $pordercurregbp[0]; } else{echo "-";}  ?></td>          
                        <?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php if($pordercurreur[0]==='EUR'){  $porder[0] = $pordervalueeur[0]*0.84; echo  round($porder[0],2);   } else if ($pordercurregbp[0]==='GBP'){echo round($pordervaluegbp[0],2); } else {echo "-";}?></td><?php } ?>
                        <td><?php if((!empty($currenvalueeur[0])) && ($pordercurreur[0]==='EUR')){ $curprodervalue = ((($currenvalueeur[0]/$pordervalueeur[0])-1)*100);   if($curprodervalue < 0) {echo "<div class='rTableCell color-red'>".round($curprodervalue,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodervalue,2)."%"."</div>";} }else if((!empty($currenvaluegbp[0])) && ($pordercurregbp[0]==='GBP')){ $curprodergbp = ((($currenvaluegbp[0]/$pordervaluegbp[0])-1)*100);   if($curprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($curprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?></td>

         <!-- End previous and start Last database's  years-->
 
                        <?php $lastordernumeur = array(); $lastordervalueeur = array(); $lastordercurreur = array(); ?>
                        <?php $lastordernumgbp = array(); $lastordervaluegbp = array(); $lastordercurrgbp = array(); ?>
                        <?php foreach ($datalastweeks as $datalastweek): ?> 
                        <?php if(($value['ProcessedOrder']['subsource'] === $datalastweek['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $datalastweek['ProcessedOrder']['plateform'])) {?>
                        <?php if($datalastweek['ProcessedOrder']['currency']==='EUR'){$lastordernumeur[] = $datalastweek[0]['orderid']; $lastordervalueeur[] = $datalastweek[0]['ordervalues']; $lastordercurreur[] = $datalastweek['ProcessedOrder']['currency'];} else if($datalastweek['ProcessedOrder']['currency']==='GBP'){ $lastordernumgbp[] = $datalastweek[0]['orderid']; $lastordervaluegbp[] = $datalastweek[0]['ordervalues']; $lastordercurrgbp[] = $datalastweek['ProcessedOrder']['currency']; }  ?>                              
                        <?php if($datalastweek['ProcessedOrder']['currency'] ==='EUR'){ $PRordersumeur+= $datalastweek[0]['orderid']; $PRsumeur+= $datalastweek[0]['ordervalues']*0.84;}else if($datalastweek['ProcessedOrder']['currency'] ==='GBP'){$PRordersumgbp+= $datalastweek[0]['orderid']; $PRsumgbp+= $datalastweek[0]['ordervalues'];} ?>
                        
						<?php /* Combine data in Reports */
						if(($datalastweek['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_lastweek += $datalastweek[0]['orderid']; $totalorder_amazon_lastweek += $datalastweek[0]['ordervalues'];}
						if(($datalastweek['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_lastweek_germany += $datalastweek[0]['orderid']; $totalorder_amazon_lastweek_germany += $datalastweek[0]['ordervalues']*0.84;}
						if(($datalastweek['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_lastweek_france += $datalastweek[0]['orderid']; $totalorder_amazon_lastweek_france += $datalastweek[0]['ordervalues']*0.84;}
						if(($datalastweek['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_lastweek_spain += $datalastweek[0]['orderid']; $totalorder_amazon_lastweek_spain += $datalastweek[0]['ordervalues']*0.84;}
						/* End Combine data in Reports */ ?>
						
						<?php } ?>
                        <?php endforeach; ?> 


                        <td><?php if($lastordercurreur[0]==='EUR'){ echo $lastordernumeur[0]; } else if ($lastordercurrgbp[0]==='GBP'){echo $lastordernumgbp[0]; } else {echo "-";}?></td>
                        <td><?php if((!empty($currennumeur[0])) && ($lastordercurreur[0]==='EUR')){ $lastproder = ((($currennumeur[0]/$lastordernumeur[0])-1)*100);   if($lastproder < 0) {echo "<div class='rTableCell color-red'>".round($lastproder,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastproder,2)."%"."</div>";} }else if((!empty($currennumgbp[0])) && ($lastordercurrgbp[0]==='GBP')){ $$lastprodergbp = ((($currennumgbp[0]/$lastordernumgbp[0])-1)*100);   if($$lastprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($$lastprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($$lastprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?></td>
                        <td><?php if($lastordercurreur[0]==='EUR'){echo $lastordercurreur[0];}else if($lastordercurrgbp[0]==='GBP') {echo $lastordercurrgbp[0]; } else{echo "-";}  ?></td>          
                        <?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php if($lastordercurreur[0]==='EUR'){  $lastorder[0] = $lastordervalueeur[0]*0.84; echo  round($lastorder[0],2);   } else if ($lastordercurrgbp[0]==='GBP'){echo round($lastordervaluegbp[0],2); } else {echo "-";}?></td><?php } ?>
                        <td><?php if((!empty($currenvalueeur[0])) && ($lastordercurreur[0]==='EUR')){ $lastprodervalue = ((($currenvalueeur[0]/$lastordervalueeur[0])-1)*100);   if($lastprodervalue < 0) {echo "<div class='rTableCell color-red'>".round($lastprodervalue,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastprodervalue,2)."%"."</div>";} }else if((!empty($currenvaluegbp[0])) && ($lastordercurrgbp[0]==='GBP')){ $lastprodervaluegbp = ((($currenvaluegbp[0]/$lastordervaluegbp[0])-1)*100);   if($lastprodervaluegbp < 0) {echo "<div class='rTableCell color-red'>".round($lastprodervaluegbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastprodervaluegbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?></td>
                        </tr>                   
						<?php endforeach; ?>
						
						<tr><td colspan="2"><strong><?php echo " Total in Amazon UK :-"; ?></strong></td><td><?php $amazon_num = $totalnum_amazon_currweek; echo $amazon_num; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order = $totalorder_amazon_currweek;  echo round($amazon_order,2); ?></td><?php } ?><td><?php  $amazon_num_preev = $totalnum_amazon_preevweek; echo $amazon_num_preev;  ?></td><td><?php $totalcurvalue = ((($amazon_num/$amazon_num_preev)-1)*100); if($totalcurvalue < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalue,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalue,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_preevweek = $totalorder_amazon_preevweek; echo round($amazon_preevweek,2);  ?></td><?php } ?><td><?php $totalpreevorder = ((($amazon_order/$amazon_preevweek)-1)*100); if($totalpreevorder < 0) {echo "<div class='rTableCell color-red'>". round($totalpreevorder,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalpreevorder,2)."%"."</div>";} ?></td><td><?php $amazon_num_last = $totalnum_amazon_lastweek; echo $amazon_num_last;  ?><td><?php $totallastvalue = ((($amazon_num/$amazon_num_last)-1)*100); if($totallastvalue < 0) {echo "<div class='rTableCell color-red'>". round($totallastvalue,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastvalue,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_lastvweek = $totalorder_amazon_lastweek; echo round($amazon_lastvweek,2);  ?></td><?php } ?><td><?php $totallastorder = ((($amazon_order/$amazon_lastvweek)-1)*100); if($totallastorder < 0) {echo "<div class='rTableCell color-red'>". round($totallastorder,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastorder,2)."%"."</div>";} ?></td></tr>
						<tr><td colspan="2"><strong><?php echo " Total in Amazon Germany :-"; ?></strong></td><td><?php $amazon_num_germany = $totalnum_amazon_currweek_germany; echo $amazon_num_germany; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order_germany = $totalorder_amazon_currweek_germany;  echo round($amazon_order_germany,2); ?></td><?php } ?><td><?php  $amazon_num_preev_germany = $totalnum_amazon_preevweek_germany; echo $amazon_num_preev_germany;  ?></td><td><?php $totalcurvalue_germany = ((($amazon_num_germany/$amazon_num_preev_germany)-1)*100); if($totalcurvalue_germany < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalue_germany,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalue_germany,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_preevweek_germany = $totalorder_amazon_preevweek_germany; echo round($amazon_preevweek_germany,2);  ?></td><?php } ?><td><?php $totalpreevorder_germany = ((($amazon_order_germany/$amazon_preevweek_germany)-1)*100); if($totalpreevorder_germany < 0) {echo "<div class='rTableCell color-red'>". round($totalpreevorder_germany,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalpreevorder_germany,2)."%"."</div>";} ?></td><td><?php $amazon_num_last_germany = $totalnum_amazon_lastweek_germany; echo $amazon_num_last_germany;  ?><td><?php $totallastvalue_germany = ((($amazon_num_germany/$amazon_num_last_germany)-1)*100); if($totallastvalue_germany < 0) {echo "<div class='rTableCell color-red'>". round($totallastvalue_germany,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastvalue_germany,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_lastvweek_germany = $totalorder_amazon_lastweek_germany; echo round($amazon_lastvweek_germany,2);  ?></td><?php } ?><td><?php $totallastorder_germany = ((($amazon_order_germany/$amazon_lastvweek_germany)-1)*100); if($totallastorder_germany < 0) {echo "<div class='rTableCell color-red'>". round($totallastorder_germany,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastorder_germany,2)."%"."</div>";} ?></td></tr>
						<tr><td colspan="2"><strong><?php echo " Total in Amazon France :-"; ?></strong></td><td><?php $amazon_num_france = $totalnum_amazon_currweek_france; echo $amazon_num_france; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order_france = $totalorder_amazon_currweek_france;  echo round($amazon_order_france,2); ?></td><?php } ?><td><?php  $amazon_num_preev_france = $totalnum_amazon_preevweek_france; echo $amazon_num_preev_france;  ?></td><td><?php $totalcurvalue_france = ((($amazon_num_france/$amazon_num_preev_france)-1)*100); if($totalcurvalue_france < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalue_france,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalue_france,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_preevweek_france = $totalorder_amazon_preevweek_france; echo round($amazon_preevweek_france,2);  ?></td><?php } ?><td><?php $totalpreevorder_france = ((($amazon_order_france/$amazon_preevweek_france)-1)*100); if($totalpreevorder_france < 0) {echo "<div class='rTableCell color-red'>". round($totalpreevorder_france,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalpreevorder_france,2)."%"."</div>";} ?></td><td><?php $amazon_num_last_france = $totalnum_amazon_lastweek_france; echo $amazon_num_last_france;  ?><td><?php $totallastvalue_france = ((($amazon_num_france/$amazon_num_last_france)-1)*100); if($totallastvalue_france < 0) {echo "<div class='rTableCell color-red'>". round($totallastvalue_france,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastvalue_france,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_lastvweek_france = $totalorder_amazon_lastweek_france; echo round($amazon_lastvweek_france,2);  ?></td><?php } ?><td><?php $totallastorder_france = ((($amazon_order_france/$amazon_lastvweek_france)-1)*100); if($totallastorder_france < 0) {echo "<div class='rTableCell color-red'>". round($totallastorder_france,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastorder_france,2)."%"."</div>";} ?></td></tr>
						<tr><td colspan="2"><strong><?php echo " Total in Amazon Spain :-"; ?></strong></td><td><?php $amazon_num_spain = $totalnum_amazon_currweek_spain; echo $amazon_num_spain; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order_spain = $totalorder_amazon_currweek_spain;  echo round($amazon_order_spain,2); ?></td><?php } ?><td><?php  $amazon_num_preev_spain = $totalnum_amazon_preevweek_spain; echo $amazon_num_preev_spain;  ?></td><td><?php $totalcurvalue_spain = ((($amazon_num_spain/$amazon_num_preev_spain)-1)*100); if($totalcurvalue_spain < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalue_spain,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalue_spain,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_preevweek_spain = $totalorder_amazon_preevweek_spain; echo round($amazon_preevweek_spain,2);  ?></td><?php } ?><td><?php $totalpreevorder_spain = ((($amazon_order_spain/$amazon_preevweek_spain)-1)*100); if($totalpreevorder_spain < 0) {echo "<div class='rTableCell color-red'>". round($totalpreevorder_spain,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalpreevorder_spain,2)."%"."</div>";} ?></td><td><?php $amazon_num_last_spain = $totalnum_amazon_lastweek_spain; echo $amazon_num_last_spain;  ?><td><?php $totallastvalue_spain = ((($amazon_num_spain/$amazon_num_last_spain)-1)*100); if($totallastvalue_spain < 0) {echo "<div class='rTableCell color-red'>". round($totallastvalue_spain,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastvalue_spain,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_lastvweek_spain = $totalorder_amazon_lastweek_spain; echo round($amazon_lastvweek_spain,2);  ?></td><?php } ?><td><?php $totallastorder_spain = ((($amazon_order_spain/$amazon_lastvweek_spain)-1)*100); if($totallastorder_spain < 0) {echo "<div class='rTableCell color-red'>". round($totallastorder_spain,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastorder_spain,2)."%"."</div>";} ?></td></tr>
                     
						<tr><td colspan="2"><?php echo " Total in GBP :-"; ?></td><td><?php echo $Gerordersumgbp ; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($Gersumgbp,2); ?></td><?php } ?><td><?php echo $FRordersumgbp ; ?></td><td><?php $totalcurvaluegbp = ((($Gerordersumgbp/$FRordersumgbp)-1)*100); if($totalcurvaluegbp < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvaluegbp,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvaluegbp,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($FRsumgbp,2);  ?></td><?php } ?><td><?php $totalcurnumgbp = ((($Gersumgbp/$FRsumgbp)-1)*100); if($totalcurnumgbp < 0) {echo "<div class='rTableCell color-red'>". round($totalcurnumgbp,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurnumgbp,2)."%"."</div>";} ?></td><td><?php echo $PRordersumgbp; ?><td><?php $totalprevvaluegbp = ((($Gerordersumgbp/$PRordersumgbp)-1)*100); if($totalprevvaluegbp < 0) {echo "<div class='rTableCell color-red'>". round($totalprevvaluegbp,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalprevvaluegbp,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($PRsumgbp,2);  ?></td><?php } ?><td><?php $totallastnumgbp = ((($Gersumgbp/$PRsumgbp)-1)*100); if($totallastnumgbp < 0) {echo "<div class='rTableCell color-red'>". round($totalcurnumgbp,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastnumgbp,2)."%"."</div>";} ?></td></tr>
                        <tr><td colspan="2"><?php echo " Total in EUR :- "; ?></td><td><?php echo $Gerordersumeur ; ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($Gersumeur,2); ?></td><?php } ?><td><?php echo $FRordersumeur ; ?></td><td><?php $totalcurvalueeur = ((($Gerordersumeur/$FRordersumeur)-1)*100); if($totalcurvalueeur < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalueeur,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalueeur,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($FRsumeur,2);  ?></td><?php } ?><td><?php $totalcurnumvalueeur = ((($Gersumeur/$FRsumeur)-1)*100); if($totalcurnumvalueeur < 0) {echo "<div class='rTableCell color-red'>". round($totalcurnumvalueeur,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurnumvalueeur,2)."%"."</div>";} ?></td><td><?php echo $PRordersumeur; ?></td><td><?php $totalprevvalueeur = ((($Gerordersumeur/$PRordersumeur)-1)*100); if($totalprevvalueeur < 0) {echo "<div class='rTableCell color-red'>". round($totalprevvalueeur,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalprevvalueeur,2)."%"."</div>";} ?></td><td></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php echo round($PRsumeur,2);  ?></td><?php } ?><td><?php $totallastnumgeur = ((($Gersumeur/$PRsumeur)-1)*100); if($totallastnumgeur < 0) {echo "<div class='rTableCell color-red'>". round($totallastnumgeur,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totallastnumgeur,2)."%"."</div>";} ?></td></tr>
           
            <!-- <tr><td></td><td><?php // __('Total Orders Num:');?></td><td><?php echo $Gerordersum; ?></td><td><?php // __('Values:');?></td><td><?php $maincur = $Gersumeur+$Gersumgbp; echo round($maincur,2); ?></td>
                 <td><?php echo $FRordersum; ?></td><td><?php $totalprodernocurr = ((($Gerordersum/$FRordersum)-1)*100); if($totalprodernocurr < 0) {echo "<div class='rTableCell color-red'>". round($totalprodernocurr,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalprodernocurr,2)."%"."</div>";} ?></td><td><?php // echo 'Values:';?></td><td><?php $mainFRcur =$FRsumeur+$FRsumgbp; echo round($mainFRcur,2); ?></td><td><?php $totalcurvalue = ((($maincur/$mainFRcur)-1)*100); if($totalcurvalue < 0) {echo "<div class='rTableCell color-red'>". round($totalcurvalue,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalcurvalue,2)."%"."</div>";} ?></td>
                        <td><?php echo $PRordersum; ?></td><td><?php $totalprodernolast = ((($Gerordersum/$PRordersum)-1)*100); if($totalprodernolast < 0) {echo "<div class='rTableCell color-red'>". round($totalprodernolast,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalprodernolast,2)."%"."</div>";} ?></td><td><?php //__('Values:');?></td><td><?php $mainPRcur = $PRsumeur+$PRsumgbp;echo round($mainPRcur,2); ?></td><td><?php $totalpervalue = ((($maincur/$PRsumgbp)-1)*100); if($totalpervalue < 0) {echo "<div class='rTableCell color-red'>". round($totalpervalue,2) ."%"."</div>";}else { echo "<div class='rTableCell green'>".round($totalpervalue,2)."%"."</div>";} ?></td></tr>-->
           
         
    </table>
 </div>
 <?php //print_r($lastdata);?>
<?php  foreach ($currents as $value){ 
    if($value['ProcessedOrder']['subsource']==='EBAY0'){$currebay+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='http://www.homescapesonline.com'){$curreukmag+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='http://www.smartparcelbox.com'){$curreparcel+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='Tesco UK'){$curreuktesk+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='United Kingdom'){$curreukamaz+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='C Discount'){$curreukcdis+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='France'){$curreamazfr+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='Germany'){$curreamazgr+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='http://www.homescapes.fr'){$curremagfr+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='http://www.homescapesonline.de'){$curremagge+= $value[0]['ordervalues'];}
    if($value['ProcessedOrder']['subsource']==='Spain'){$curreamazspn+= $value[0]['ordervalues'];} 
    } ?>
 <?php  foreach ($previousweeks as $previousweek){ 
    if($previousweek['ProcessedOrder']['subsource']==='EBAY0'){$prevebay+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='http://www.homescapesonline.com'){$preveukmag+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='http://www.smartparcelbox.com'){$preveparcel+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='Tesco UK'){$preveuktesk+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='United Kingdom'){$preveukamaz+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='C Discount'){$preveukcdis+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='France'){$preveamazfr+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='Germany'){$preveamazgr+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='http://www.homescapes.fr'){$prevemagfr+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='http://www.homescapesonline.de'){$prevemagge+= $previousweek[0]['ordervalues'];}
    if($previousweek['ProcessedOrder']['subsource']==='Spain'){$preveamazspn+= $previousweek[0]['ordervalues'];} 
    } ?>
  <?php  foreach ($datalastweeks as $datalastweek){ 
    if($datalastweek['ProcessedOrder']['subsource']==='EBAY0'){$lastbay+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='http://www.homescapesonline.com'){$lastukmag+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='http://www.smartparcelbox.com'){$lastparcel+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='Spain'){$lastamazspn+= $datalastweek[0]['ordervalues'];} 
    if($datalastweek['ProcessedOrder']['subsource']==='Tesco UK'){$lastuktesk+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='United Kingdom'){$lastukamaz+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='C Discount'){$lastukcdis+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='France'){$lastamazfr+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='Germany'){$lastamazgr+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='http://www.homescapes.fr'){$lastmagfr+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='http://www.homescapesonline.de'){$lastmagge+= $datalastweek[0]['ordervalues'];}
    if($datalastweek['ProcessedOrder']['subsource']==='Spain'){$lastamazspn+= $datalastweek[0]['ordervalues'];} 
    } ?>
 <div style="display: inline-block; margin:65px">
    <canvas id="cvs" width="1000" height="450">[No canvas support]</canvas>
</div>
<script>
   var bar = new RGraph.Bar({
            id: 'cvs',
           data:[ [<?php   echo $currebay.','.$prevebay.','.$lastbay; ?>],[<?php echo $curreukmag.','.$preveukmag.','.$lastukmag; ?>], [<?php echo $curreparcel.','.$preveparcel.','.$lastparcel; ?>],[<?php echo $curreuktesk.','.$preveuktesk.','.'90'; ?>],[<?php echo $curreukamaz.','.$preveukamaz.','.$lastukamaz; ?>],[<?php echo $curreukcdis.','.$preveukcdis.','.$lastukcdis; ?>],[<?php echo $curreamazfr.','.$preveamazfr.','.$lastamazfr; ?>],[<?php echo $curreamazgr.','.$preveamazgr.','.$lastamazgr; ?>],[<?php echo $curremagfr.','.$prevemagfr.','.$lastmagfr; ?>], [<?php echo $curremagge.','.$prevemagge.','.$lastmagge; ?>],[<?php echo $curreamazspn.','.$preveamazspn.','.$lastamazspn; ?>] ],
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
            labels: ['EBay','Magento Uk','P.Box','Tesco','Amazon Uk',' CDiscount',' Amazon Fr',' Amazon Gr',' Magento Fr',' Magento Gr',' Amazon Sp'],
            //tooltips: ['EBay','Magento Uk','P.Box','Tesco','Amazon Uk',' CDiscount',' Amazon Fr',' Amazon Gr',' Magento Fr',' Magento Gr',' Amazon Sp'],
            shadowColor:'#ccc',
            shadowOffsetx: 3,
            backgroundGridColor: '#eee',
            scaleZerostart: true,
            axisColor: '#ddd',
            unitsPost: '',
            title: 'Progress Report weekly Based on Per Channel',
            key: ['Current Week','Previous Week','Same Week Last Year'],
            keyShadow: true,
            keyShadowColor: '#ccc',
            keyShadowOffsety: 0,
            keyShadowOffsetx: 3,
            keyShadowBlur: 15
        }
    });
        
        var line = new RGraph.Line({
            id: 'cvs',
            //data: [8,4,5,6,3,3],
           data:[<?php   echo $currebay+$prevebay+$lastbay; ?>,<?php echo $curreukmag+$preveukmag+$lastukmag; ?>, <?php echo $curreparcel+$preveparce+$lastparcel; ?>,<?php echo $curreuktesk+$preveuktesk; ?>,<?php echo $curreukamaz+$preveukamaz+$lastukamaz; ?>, <?php echo $curreukcdis+$preveukcdis+$lastukcdis; ?>,<?php echo $curreamazfr+$preveamazfr+$lastamazfr; ?>, <?php echo $curreamazgr+$preveamazgr+$lastamazgr; ?>,<?php echo $curremagfr+$prevemagfr+$lastmagfr; ?>, <?php echo $curremagge+$prevemagge+$lastmagge; ?>,<?php echo $curreamazspn+$preveamazspn+$lastamazspn; ?>],
             options: {
                tickmarks: 'endcircle',
                noaxes: true,
                tooltips: ['EBay','Magento Uk','P.Box','Tesco','Amazon Uk',' CDiscount',' Amazon Fr',' Amazon Gr',' Magento Fr',' Magento Gr',' Amazon Sp'],
           //     tooltips: ['EBay','Magento Uk','P.Box','Amazon Uk','CDiscount','Amazon Fr'],
                textAccessible: true,
                textSize: 14
            }
        });

//line.draw();

//bar.draw();
var combo = new RGraph.CombinedChart(bar, line);
combo.draw();
</script>
<?php } ?>