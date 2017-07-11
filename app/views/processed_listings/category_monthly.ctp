<?php
if(($session->read('Auth.User.group_id')!='4') && ($session->read('Auth.User.group_id')!='5'))
{
$this->requestAction('/users/logout/', array('return'));
}
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
    
}else{	
echo $this->Session->flash(); ?>
 <hr>
  <?php

$this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
$this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));

     
$start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
$end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));



$main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
$main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));

?>
<?php

/*$start_week = strtotime("first day of last month");
//$end_week = strtotime("next month",$start_week);
$end_week = strtotime("last day of last month");




$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);


     
$present_week = strtotime("-1 month",$start_week);
$send_week = strtotime("next month",$present_week);
$day_week = strtotime("-1 day",$send_week);

$start_week = date("Y-m-d",$present_week);
$end_week = date("Y-m-d",$day_week);


$present_year_week = strtotime("first day of last Year last month");
//$end_year_week = strtotime("next month",$present_year_week);
$end_year_week = strtotime("last day of last Year last month");

$main_last_week = date("Y-m-d",$present_year_week);
$main_end_week = date("Y-m-d",$end_year_week);*/
?>
 <h1 class="sub-header"><?php __('Sales Per-Category Monthly Orders Reports');?></h1>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-8 mobile-bottomspace">
        <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Orders CSV', true), array('controller' => 'processed_listings', 'action' => 'importcategory'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
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
           
        <th class='width55' colspan="3"></th>
            <?php if(($session->read('Auth.User.group_id')==='5')){ $rowcol = '4'; } ?> 
            <?php if(($session->read('Auth.User.group_id')==='4')){ $rowcol = '5'; } ?>
         
         <th colspan="<?php echo $rowcol; ?>"  class="text-center text-uppercase color-black green-bg"><?php __('Current Month');?><?php echo "( ".$this_week_sd." - To - ".$this_week_ed." )"; ?></th>
        
         <th  colspan="<?php echo $rowcol; ?>" class="text-center text-uppercase color-black yellow-bg"><?php __('Previous Month');?><?php echo "( ".$start_week." - To - ".$end_week." )"; ?></th>
      
         <th  colspan="<?php echo $rowcol; ?>" class="text-center text-uppercase color-black last-bg"><?php __('SAME MONTH LAST YEAR');?><?php echo "( ".$main_last_week." - To - ".$main_end_week." )"; ?></th>
       
       </tr>
       <?php if(($session->read('Auth.User.group_id')!=='5')){ $rowcolvalue = "<td> Order Value </td>"; } else { } ?> 
       <tr><td class='width55' colspan="<?php echo $rowcol; ?>"><?php __('Category');?></td><td><?php __('No of Orders');?></td><td><?php __('Currency');?></td><?php echo $rowcolvalue; ?><td><?php __('No of Orders');?></td><td><?php __('Order Progress');?></td><td><?php __('Currency');?></td><?php echo $rowcolvalue; ?><td><?php __('Value Progress');?></td><td><?php __('No of Orders');?></td><td><?php __('Order Progress');?></td><td><?php __('Currency');?></td><?php echo $rowcolvalue; ?><td><?php __('Value Progress');?></td></tr>
        <?php    $a = '0'; foreach ($Catsaveallmonth as $value): ?>  
        <?php $b = $value['ProcessedListing']['cat_name']; ?> 
        <?php  $numcurgbp = array();$ordercurgbp = array(); $numcureur = array(); $ordercureur = array(); foreach ($Countmonthcurrent as $CatGbpweek): ?> 
        <?php if($value['ProcessedListing']['cat_name'] === $CatGbpweek['ProcessedListing']['cat_name']) { ?>
        <?php if($CatGbpweek['ProcessedListing']['currency']==='GBP'){ $numcurgbp[0] = $CatGbpweek[0]['orderid']; $ordercurgbp[0] = $CatGbpweek[0]['ordervalues'];}else if($CatGbpweek['ProcessedListing']['currency']==='EUR'){ $numcureur[0] = $CatGbpweek[0]['orderid']; $ordercureur[0] = $CatGbpweek[0]['ordervalues'];  } ?>                
        <?php } ?>
        <?php endforeach; ?> 
       
        <?php  $numprevgbp = array();$orderprevgbp = array(); $numpreveur = array(); $orderpreveur = array();  foreach ($Countmonthprevous as $Countprevweek): ?>       
        <?php if($value['ProcessedListing']['cat_name'] === $Countprevweek['ProcessedListing']['cat_name']) { ?>
        <?php if((!empty($Countprevweek[0]['orderid'])) && ($Countprevweek['ProcessedListing']['currency']==='GBP')){ $numprevgbp[0] = $Countprevweek[0]['orderid']; $orderprevgbp[0] = $Countprevweek[0]['ordervalues']; } 
         if((!empty($Countprevweek[0]['orderid'])) && ($Countprevweek['ProcessedListing']['currency']==='EUR')){ $numpreveur[0] = $Countprevweek[0]['orderid'];  $orderpreveur[0] = $Countprevweek[0]['ordervalues'];}  ?>                
        <?php } ?>       
        <?php endforeach; ?>       
    
        <?php  $numlastgbp = array();$orderlastgbp = array(); $numlasteur = array(); $orderlasteur = array();  foreach ($Countmonthlast as $Countlastweek): ?>       
        <?php if($value['ProcessedListing']['cat_name'] === $Countlastweek['ProcessedListing']['cat_name']) { ?>
        <?php if($Countlastweek['ProcessedListing']['currency']==='GBP'){ $numlastgbp[0] = $Countlastweek[0]['orderid']; $orderlastgbp[0] = $Countlastweek[0]['ordervalues'];} else if($Countlastweek['ProcessedListing']['currency']==='EUR'){ $numlasteur[0] = $Countlastweek[0]['orderid']; $orderlasteur[0] = $Countlastweek[0]['ordervalues'];}  ?>                
        <?php } ?>       
        <?php endforeach; ?> 
       
        <?php if(($session->read('Auth.User.group_id')!=='5')){ $order1 = "<td class='width15'>". round($ordercurgbp[0],2) ."</td>"; $order2 = "<td>". round($ordercureur[0],2)  ."</td>";  $order3 = "<td class='width20'>". round($orderprevgbp[0],2) ."</td>"; $order4 = "<td class='width20'>". round($orderpreveur[0],2) ."</td>"; $order5 = "<td class='width20'>". round($orderlastgbp[0],2) ."</td>"; $order6 = "<td class='width20'>". round($orderlasteur[0],2) ."</td>"; } else { } ?>
        
        <?php  if((!empty($numcurgbp[0])) && (!empty($numprevgbp[0]))){ $curprogress = ((($numcurgbp[0]/$numprevgbp[0])-1)*100);  if($curprogress < 0){$currnumprogress = "<td class='width20 red'>".round($curprogress,2)."%"."</td>"; }else { $currnumprogress = "<td class='width20 green'>".round($curprogress,2)."%"."</td>"; } } else { $currnumprogress = "<td class='width20 green'>-</td>"; }?>
        <?php  if((!empty($numcureur[0])) && (!empty($numpreveur[0]))){ $cureurprogress = ((($numcureur[0]/$numpreveur[0])-1)*100);  if($cureurprogress < 0){$cureurnumprogress = "<td class='width20 red'>".round($cureurprogress,2)."%"."</td>"; }else { $cureurnumprogress = "<td class='width20 green'>".round($cureurprogress,2)."%"."</td>"; } } else { $cureurnumprogress = "<td class='width20 green'>-</td>"; } ?>
        <?php if((!empty($ordercurgbp[0])) && (!empty($orderprevgbp[0]))){ $curvaluegbpprogress = ((($ordercurgbp[0]/$orderprevgbp[0])-1)*100);   if($curvaluegbpprogress < 0){$curvaluegbpprog = "<td class='width20 red'>".round($curvaluegbpprogress,2)."%"."</td>"; }else { $curvaluegbpprog = "<td class='width20 green'>".round($curvaluegbpprogress,2)."%"."</td>"; } } else { $curvaluegbpprog = "<td class='width20 green'>-</td>"; } ?>
        <?php  if((!empty($ordercureur[0])) && (!empty($orderpreveur[0]))){ $curvalueeurprogress = ((($ordercureur[0]/$orderpreveur[0])-1)*100);  if($curvalueeurprogress < 0){$curvalueeurprog = "<td class='width20 red'>".round($curvalueeurprogress,2)."%"."</td>"; }else { $curvalueeurprog = "<td class='width20 green'>".round($curvalueeurprogress,2)."%"."</td>"; } } else { $curvalueeurprog = "<td class='width20 green'>-</td>"; } ?>
        <?php  if((!empty($numcurgbp[0])) && (!empty($numlastgbp[0]))){ $lastgbpprogress = ((($numcurgbp[0]/$numlastgbp[0])-1)*100);  if($lastgbpprogress < 0){ $lastgbpprog = "<td class='width20 red'>".round($lastgbpprogress,2)."%"."</td>"; }else { $lastgbpprog = "<td class='width20 green'>".round($lastgbpprogress,2)."%"."</td>"; } } else { $lastgbpprog = "<td class='width20 green'>-</td>"; }?>
        <?php  if((!empty($numcureur[0])) && (!empty($numlasteur[0]))){ $lasteurprogress = ((($numcureur[0]/$numlasteur[0])-1)*100);   if($lasteurprogress < 0){ $lasteurprog = "<td class='width20 red'>".round($lasteurprogress,2)."%"."</td>"; }else { $lasteurprog = "<td class='width20 green'>".round($lasteurprogress,2)."%"."</td>"; } } else { $lasteurprog = "<td class='width20 green'>-</td>"; }?>
        <?php  if((!empty($ordercurgbp[0])) && (!empty($orderlastgbp[0]))){ $lastvaluegbpprogress = ((($ordercurgbp[0]/$orderlastgbp[0])-1)*100);  if($lastvaluegbpprogress < 0){$lastvaluegbpprog = "<td class='width20 red'>".round($lastvaluegbpprogress,2)."%"."</td>"; }else { $lastvaluegbpprog = "<td class='width20 green'>".round($lastvaluegbpprogress,2)."%"."</td>"; } } else { $lastvaluegbpprog = "<td class='width20 green'>-</td>"; }?>
        <?php  if((!empty($ordercureur[0])) && (!empty($orderlasteur[0]))){ $lastvalueeurprogress = ((($ordercureur[0]/$orderlasteur[0])-1)*100);  if($lastvalueeurprogress < 0){$lastvalueeurprog = "<td class='width20 red'>".round($lastvalueeurprogress,2)."%"."</td>"; }else { $lastvalueeurprog = "<td class='width20 green'>".round($lastvalueeurprogress,2)."%"."</td>"; } } else { $lastvalueeurprog = "<td class='width20 green'>-</td>"; }?>
        <?php if($a!==$b){ echo "<tr><td colspan='20'><div class='accordion sale-by-category'><table class='table-responsive category'><tr><td class='width33'><table class='table-responsive table-bordered'><tr><td colspan='3' rowspan='2' class='width33'>".$b."</td><td class='width15'>". $numcurgbp[0] ."</td><td class='width15'>GBP</td>". $order1 ."</tr><tr><td>". $numcureur[0] ."</td><td>EUR</td>". $order2 ."</tr></table></td><td class='width33'><table class='table-responsive table-bordered'><tr><td class='width20'>". $numprevgbp[0] ."</td>". $currnumprogress ."<td class='width20'>GBP</td>".$order3.$curvaluegbpprog ."</tr><tr><td class='width20'>". $numpreveur[0] ."</td>". $cureurnumprogress ."<td class='width20'>EUR</td>".$order4. $curvalueeurprog ."</tr></table><td class='width33'><table class='table-responsive table-bordered'><tr><td class='width20'>". $numlastgbp[0] ."</td>". $lastgbpprog ."<td class='width20'>GBP</td>".$order5. $lastvaluegbpprog ."</tr><tr><td class='width20'>". $numlasteur[0] ."</td>". $lasteurprog ."<td class='width20'>EUR</td>".$order6. $lastvalueeurprog ."</tr></table></tr></table></div>";} ?>
        <?php if($a!==$b) {  ?><div class='catpanel'>
        <div class="rTableHeading"><div class="rTableHead"><?php __('Sales Platform');?></div>
                                 <div class="rTableHead"><?php __('Sales Channel');?></div>
                                 <div class="rTableHead"><?php __('No. of Orders');?></div>
                                 <div class="rTableHead"><?php __('Currency');?></div>
                                 <?php if(($session->read('Auth.User.group_id')!=='5')){ $amit = "<div class='rTableHead'> Order Value </div>";} else { $amit = ""; } ?>
                                <?php echo $amit; ?>
                                <div class="rTableHead"><?php __('No. of Orders');?></div>
                                <div class="rTableHead"><?php __('Order Progress');?></div>
                                <div class="rTableHead"><?php __('Currency');?></div>
                                <?php echo $amit; ?>
                                <div class="rTableHead"><?php __('Value Progress');?></div>
                                <div class="rTableHead"><?php __('No. of Orders');?></div>
                                <div class="rTableHead"><?php __('Order Progress');?></div>
                                <div class="rTableHead"><?php __('Currency');?></div>
                                 <?php echo $amit; ?>
                                <div class="rTableHead"><?php __('Value Progress');?></div>                           
        </div><?php } ?> 
            <?php $a = $b; ?>
           <div class="rTableRow"><div class="rTableCell"><?php echo $value['ProcessedListing']['plateform']; ?></div>
               <div class="rTableCell"><?php echo $value['ProcessedListing']['subsource']; ?></div>                                 
                                <!--  start Current database's years-->
                                 <?php $currentnumeur = array(); $currentvalueeur = array(); $currentcurreur = array(); ?>
                                 <?php  $currentnumgbp = array(); $currentvaluegbp = array(); $currentcurrgbp = array(); ?>
                                <?php foreach ($Catmonthcurrents as $currentweeks): ?>  
                                <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks['ProcessedListing']['plateform'])) {?>
                                <?php if($currentweeks['ProcessedListing']['currency']==='EUR'){$currentnumeur[] = $currentweeks[0]['orderid']; $currentvalueeur[] = $currentweeks[0]['ordervalues']; $currentcurreur[] = $currentweeks['ProcessedListing']['currency'];} else if($currentweeks['ProcessedListing']['currency']==='GBP'){ $currentnumgbp[] = $currentweeks[0]['orderid']; $currentvaluegbp[] = $currentweeks[0]['ordervalues']; $currentcurrgbp[] = $currentweeks['ProcessedListing']['currency']; }  ?>                              
                                 <?php } ?>
                                 <?php endforeach; ?> 
               
               
               
                                <?php if((!empty($currentnumeur[0])) && ($currentcurreur[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur[0] ."</div>";} else if((!empty($currentnumgbp[0])) && ($currentcurrgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
                                <?php if((!empty($currentcurreur[0])) && ($currentcurreur[0]==='EUR')){ echo "<div class='rTableCell'>". $currentcurreur[0]."</div>";} else if((!empty($currentnumgbp[0])) && ($currentcurrgbp[0]==='GBP')){  echo "<div class='rTableCell'>". $currentcurrgbp[0]."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
                                <?php if(($session->read('Auth.User.group_id')!='5')){ ?><?php if((!empty($currentvalueeur[0])) && ($currentcurreur[0]==='EUR')){ $currvaluemain = $currentvalueeur[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain,2) ."</div>"; } else if((!empty($currentvaluegbp[0])) && ($currentcurrgbp[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?><?php } ?>
                               
                                <?php $pordernumeur = array(); $pordervalueeur = array(); $pordercurreur = array(); ?>
                                <?php $pordernumgbp = array(); $pordervaluegbp = array(); $pordercurregbp = array(); ?>
                                <?php foreach ($Catmonthprevous as $previousweeks): ?>  
                                <?php if(($value['ProcessedListing']['cat_name'] === $previousweeks['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $previousweeks['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $previousweeks['ProcessedListing']['plateform'])) {?>
                                <?php if($previousweeks['ProcessedListing']['currency']==='EUR'){$pordernumeur[] = $previousweeks[0]['orderid']; $pordervalueeur[] = $previousweeks[0]['ordervalues']; $pordercurreur[] = $previousweeks['ProcessedListing']['currency'];} else if($previousweeks['ProcessedListing']['currency']==='GBP'){ $pordernumgbp[] = $previousweeks[0]['orderid']; $pordervaluegbp[] = $previousweeks[0]['ordervalues']; $pordercurregbp[] = $previousweeks['ProcessedListing']['currency']; }  ?>                              
                                 <?php } ?>
                                 <?php endforeach; ?> 
               
                                <div class='rTableCell'><?php if($pordercurreur[0]==='EUR'){echo $pordernumeur[0];} else if($pordercurregbp[0]==='GBP') { echo $pordernumgbp[0];} else{echo "-";}?></div>
                                <?php if((!empty($currentnumeur[0])) && ($pordercurreur[0]==='EUR')){ $curproder = ((($currentnumeur[0]/$pordernumeur[0])-1)*100);   if($curproder < 0) {echo "<div class='rTableCell color-red'>".round($curproder,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curproder,2)."%"."</div>";} }else if((!empty($currentnumgbp[0])) && ($pordercurregbp[0]==='GBP')){ $curprodergbp = ((($currentnumgbp[0]/$pordernumgbp[0])-1)*100);   if($curprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($curprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?>             
                                <div class='rTableCell'><?php if($pordercurreur[0]==='EUR'){echo $pordercurreur[0];}else if($pordercurregbp[0]==='GBP') {echo $pordercurregbp[0]; } else{echo "-";}  ?></div>         
                                <?php if(($session->read('Auth.User.group_id')!='5')){ ?><div class='rTableCell'><?php if((!empty($pordervalueeur[0])) && ($pordercurreur[0]==='EUR')){  $porder[0] = $pordervalueeur[0]*0.84; echo  round($porder[0],2);   } else if ((!empty($pordervaluegbp[0])) && ($pordercurregbp[0]==='GBP')){echo round($pordervaluegbp[0],2); } else {echo "-";}?></div><?php } ?>
                                <?php if((!empty($currentvalueeur[0])) && ($pordercurreur[0]==='EUR')){  $curprodervalue = ((($currentvalueeur[0]/$pordervalueeur[0])-1)*100);   if($curprodervalue < 0) {echo "<div class='rTableCell color-red'>".round($curprodervalue,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodervalue,2)."%"."</div>";} }else if((!empty($currentvaluegbp[0])) && ($pordercurregbp[0]==='GBP')){ $curprodergbp = ((($currentvaluegbp[0]/$pordervaluegbp[0])-1)*100);   if($curprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($curprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($curprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?>
              
                                <?php $lastordernumeur = array(); $lastordervalueeur = array(); $lastordercurreur = array(); ?>
                                <?php $lastordernumgbp = array(); $lastordervaluegbp = array(); $lastordercurrgbp = array(); ?>
                                <?php foreach ($Catlastmonths  as $datalastweek): ?>  
                                <?php if(($value['ProcessedListing']['cat_name'] === $datalastweek['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $datalastweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $datalastweek['ProcessedListing']['plateform'])) {?>
                                <?php if($datalastweek['ProcessedListing']['currency']==='EUR'){$lastordernumeur[] = $datalastweek[0]['orderid']; $lastordervalueeur[] = $datalastweek[0]['ordervalues']; $lastordercurreur[] = $datalastweek['ProcessedListing']['currency'];} else if($datalastweek['ProcessedListing']['currency']==='GBP'){ $lastordernumgbp[] = $datalastweek[0]['orderid']; $lastordervaluegbp[] = $datalastweek[0]['ordervalues']; $lastordercurrgbp[] = $datalastweek['ProcessedListing']['currency']; }  ?>                              
                                <?php } ?>
                                <?php endforeach; ?>                                 
                                
                               <div class='rTableCell'><?php if($lastordercurreur[0]==='EUR'){echo $lastordernumeur[0];} else if($lastordercurrgbp[0]==='GBP') { echo $lastordernumgbp[0];} else{echo "-";}?></div>
                               <?php if((!empty($currentnumeur[0])) && ($lastordercurreur[0]==='EUR')){ $lastcurproder = ((($currentnumeur[0]/$lastordernumeur[0])-1)*100);   if($lastcurproder < 0) {echo "<div class='rTableCell color-red'>".round($lastcurproder,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastcurproder,2)."%"."</div>";} }else if((!empty($currentnumgbp[0])) && ($lastordercurrgbp[0]==='GBP')){ $lastprodergbp = ((($currentnumgbp[0]/$lastordernumgbp[0])-1)*100);   if($lastprodergbp < 0) {echo "<div class='rTableCell color-red'>".round($lastprodergbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastprodergbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?>             
                               <div class='rTableCell'><?php if($lastordercurreur[0]==='EUR'){echo $lastordercurreur[0];}else if($lastordercurrgbp[0]==='GBP') {echo $lastordercurrgbp[0]; } else{echo "-";}  ?></div>         
                               <?php if(($session->read('Auth.User.group_id')!='5')){ ?><div class='rTableCell'><?php if((!empty($lastordervalueeur[0])) && ($lastordercurreur[0]==='EUR')){  $lastorder[0] = $lastordervalueeur[0]*0.84; echo  round($lastorder[0],2);   } else if ((!empty($lastordervaluegbp[0])) && ($lastordercurrgbp[0]==='GBP')){echo round($lastordervaluegbp[0],2); } else {echo "-";}?></div><?php } ?>
                               <?php if((!empty($currentvalueeur[0])) && ($lastordercurreur[0]==='EUR')){  $lastprodervalue = ((($currentvalueeur[0]/$lastordervalueeur[0])-1)*100);   if($lastprodervalue < 0) {echo "<div class='rTableCell color-red'>".round($lastprodervalue,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastprodervalue,2)."%"."</div>";} }else if((!empty($currentvaluegbp[0])) && ($lastordercurrgbp[0]==='GBP')){ $lastprodervaluegbp = ((($currentvaluegbp[0]/$lastordervaluegbp[0])-1)*100);   if($lastprodervaluegbp < 0) {echo "<div class='rTableCell color-red'>".round($lastprodervaluegbp,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($lastprodervaluegbp,2)."%"."</div>";} } else { echo "<div class='green'>-</div>"; } ?>
              
        </div>
       
       
         <?php if($a!==$b) { echo "</div><td></tr>";} ?>
         <?php endforeach; ?> 
    
    </table>
 </div>
 <?php //print_r($currdata);?>
<!--<div style="display: inline-block; margin:65px">
    <canvas id="cvs" width="1000" height="450">[No canvas support]</canvas>
</div>-->
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
</script>
<?php } ?>