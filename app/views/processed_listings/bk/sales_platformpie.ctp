<?php //print_r($Platformnames);?>
<h1 class="sub-header"><?php __('Sale Platform- Detailed Analysis as per product category - Number of Orders');?></h1>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-12 space-bar mobile-bottomspace">
	   <?php foreach ($Platnames as $Platformname): ?>
	   <?php $mystring = $Platformname['ProcessedListing']['plateform']; $findme ='FBA';
		$pos = strpos($mystring, $findme); if($pos !== false){ $pname = $Platformname['ProcessedListing']['subsource'].' '.$findme;}else {$pname = $Platformname['ProcessedListing']['subsource'];} ?>
		<div class='col-md-2'><form name="<?php echo $pname ?>" id="<?php echo $pname ?>" method="post" action="">
	   <input type="hidden" name="sourceid" value="<?php echo $Platformname['ProcessedListing']['subsource'] ?>" />
	   <input type="hidden" name="plateformid" value="<?php echo $Platformname['ProcessedListing']['plateform']; ?>" />
		
		<a href="#" class="plate" onclick="document.getElementById('<?php echo $pname ?>').submit();"><?php echo $pname ?></a></form></div>
	    <?php endforeach; ?>	   
	   </div>
      </div>
    </div>
</div> 
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
		<thead><tr> 
		<th><?php __('Plateform');?>-<?php __('Subsource');?></div>          
        <th><?php __('Category');?></th>          
        <th><?php __('Current Week');?></th>                          
		<th><?php __('Last Week');?></th>  
		<th><?php __('Same Week Last Year');?></th>
        <th><?php __('Current Month');?></th>                          
		<th><?php __('Last Month');?></th> 
		<th><?php __('Same Month Last Year');?></th> 
		<th><?php __('Current YTD');?></th>
		<th><?php __('Last YTD');?></th>
		<th><?php __('Last Year');?></th>
       </tr></thead>
	   <?php foreach ($Results as $value): ?>      
		<tr>
		<td><?php echo $platformname; ?>-<?php echo $sourcename; ?></td>
		<td><?php echo $value['ProcessedListing']['cat_name']; ?></td>
				<?php  $numcureur = array(); $currcureur = array(); $numcurgbp = array(); $currcurgbp = array(); foreach ($Platcurweeks as $Platcurweek): ?> 
				<?php if(($platformname === $Platcurweek['ProcessedListing']['plateform']) && ($sourcename === $Platcurweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurweek['ProcessedListing']['currency']==='EUR'){$curweek1 += $Platcurweek[0]['orderid']; $numcureur[] = $Platcurweek[0]['orderid'];  $currcureur[] = $Platcurweek['ProcessedListing']['currency'];} else if($Platcurweek['ProcessedListing']['currency']==='GBP'){ $curweek2 += $Platcurweek[0]['orderid']; $numcurgbp[] = $Platcurweek[0]['orderid'];  $currcurgbp[] = $Platcurweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcureur[0])) && ($currcureur[0]==='EUR')){ echo "<td>". $numcureur[0] ."</td>";} else if((!empty($numcurgbp[0])) && ($currcurgbp[0]==='GBP')){ echo "<td>". $numcurgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numpreveur = array(); $currpreveur = array(); $numprevgbp = array(); $currprevgbp = array(); foreach ($Platprevweeks as $Platprevweek): ?> 
				<?php if(($platformname === $Platprevweek['ProcessedListing']['plateform']) && ($sourcename === $Platprevweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevweek['ProcessedListing']['currency']==='EUR'){$prevweek1 += $Platprevweek[0]['orderid']; $numpreveur[] = $Platprevweek[0]['orderid'];  $currpreveur[] = $Platprevweek['ProcessedListing']['currency'];} else if($Platprevweek['ProcessedListing']['currency']==='GBP'){ $prevweek2 += $Platprevweek[0]['orderid']; $numprevgbp[] = $Platprevweek[0]['orderid'];  $currprevgbp[] = $Platprevweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numpreveur[0])) && ($currpreveur[0]==='EUR')){ $percureuro = ((($numcureur[0]-$numpreveur[0])/$numpreveur[0])*100); if($percureuro < 0) { echo "<td>". $numpreveur[0] ." <div class='rTableCell color-red-col'>".round($percureuro,2)."%"."</div></td>";}else { echo "<td>". $numpreveur[0] ." <div class='rTableCell green-col'>".round($percureuro,2)."%"."</div></td>";} } else if((!empty($numprevgbp[0])) && ($currprevgbp[0]==='GBP')){ $percurgbp = ((($numcurgbp[0]-$numprevgbp[0])/$numprevgbp[0])*100); if($percurgbp < 0) {echo "<td>". $numprevgbp[0] ." <div class='rTableCell color-red-col'>".round($percurgbp,2)."%"."</div></td>";}else { echo "<td>". $numprevgbp[0] ." <div class='rTableCell green-col'>".round($percurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numlasteur = array(); $currlasteur = array(); $numlastgbp = array(); $currlastgbp = array(); foreach ($Platlastweeks as $Platlastweek): ?> 
				<?php if(($platformname === $Platlastweek['ProcessedListing']['plateform']) && ($sourcename === $Platlastweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastweek['ProcessedListing']['currency']==='EUR'){ $lastweek1 += $Platlastweek[0]['orderid']; $numlasteur[] = $Platlastweek[0]['orderid'];  $currlasteur[] = $Platlastweek['ProcessedListing']['currency'];} else if($Platlastweek['ProcessedListing']['currency']==='GBP'){ $lastweek2 += $Platlastweek[0]['orderid']; $numlastgbp[] = $Platlastweek[0]['orderid'];  $currlastgbp[] = $Platlastweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>
				<?php if((!empty($numlasteur[0])) && ($currlasteur[0]==='EUR')){ $lastcureuro = ((($numcureur[0]-$numlasteur[0])/$numlasteur[0])*100); if($lastcureuro < 0) { echo "<td>". $numlasteur[0] ." <div class='rTableCell color-red-col'>".round($lastcureuro,2)."%"."</div></td>";}else { echo "<td>". $numlasteur[0] ." <div class='rTableCell green-col'>".round($lastcureuro,2)."%"."</div></td>";} } else if((!empty($numlastgbp[0])) && ($currlastgbp[0]==='GBP')){ $lastcurgbp = ((($numcurgbp[0]-$numlastgbp[0])/$numlastgbp[0])*100); if($lastcurgbp < 0) {echo "<td>". $numlastgbp[0] ." <div class='rTableCell color-red-col'>".round($lastcurgbp,2)."%"."</div></td>";}else { echo "<td>". $numlastgbp[0] ." <div class='rTableCell green-col'>".round($lastcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php // if((!empty($numlasteur[0])) && ($currlasteur[0]==='EUR')){ echo "<td>". $numlasteur[0] ."</td>";} else if((!empty($numlastgbp[0])) && ($currlastgbp[0]==='GBP')){ echo "<td>". $numlastgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>
				
				<?php  $numcurmeur = array(); $currcurmeur = array(); $numcurmgbp = array(); $currcurmgbp = array(); foreach ($Platcurrmonths as $Platcurrmonth): ?> 
				<?php if(($platformname === $Platcurrmonth['ProcessedListing']['plateform']) && ($sourcename === $Platcurrmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrmonth['ProcessedListing']['currency']==='EUR'){ $currmonth1 += $Platcurrmonth[0]['orderid']; $numcurmeur[] = $Platcurrmonth[0]['orderid'];  $currcurmeur[] = $Platcurrmonth['ProcessedListing']['currency'];} else if($Platcurrmonth['ProcessedListing']['currency']==='GBP'){ $currmonth2 += $Platcurrmonth[0]['orderid'];  $numcurmgbp[] = $Platcurrmonth[0]['orderid'];  $currcurmgbp[] = $Platcurrmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurmeur[0])) && ($currcurmeur[0]==='EUR')){ echo "<td>". $numcurmeur[0] ."</td>";} else if((!empty($numcurmgbp[0])) && ($currcurmgbp[0]==='GBP')){ echo "<td>". $numcurmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numprevmeur = array(); $currprevmeur = array(); $numprevmgbp = array(); $currprevmgbp = array(); foreach ($Platprevmonths as $Platprevmonth): ?> 
				<?php if(($platformname === $Platprevmonth['ProcessedListing']['plateform']) && ($sourcename === $Platprevmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevmonth['ProcessedListing']['currency']==='EUR'){ $pastmonth1 += $Platprevmonth[0]['orderid']; $numprevmeur[] = $Platprevmonth[0]['orderid'];  $currprevmeur[] = $Platprevmonth['ProcessedListing']['currency'];} else if($Platprevmonth['ProcessedListing']['currency']==='GBP'){  $pastmonth2 += $Platprevmonth[0]['orderid']; $numprevmgbp[] = $Platprevmonth[0]['orderid'];  $currprevmgbp[] = $Platprevmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){ echo "<td>". $numprevmeur[0] ."</td>";} else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ echo "<td>". $numprevmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){ $monthcureuro = ((($numcurmeur[0]-$numprevmeur[0])/$numprevmeur[0])*100); if($monthcureuro < 0) { echo "<td>". $numprevmeur[0] ." <div class='rTableCell color-red-col'>".round($monthcureuro,2)."%"."</div></td>";}else { echo "<td>". $numprevmeur[0] ." <div class='rTableCell green-col'>".round($monthcureuro,2)."%"."</div></td>";} } else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ $monthcurgbp = ((($numcurmgbp[0]-$numprevmgbp[0])/$numprevmgbp[0])*100); if($monthcurgbp < 0) {echo "<td>". $numprevmgbp[0] ." <div class='rTableCell color-red-col'>".round($monthcurgbp,2)."%"."</div></td>";}else { echo "<td>". $numprevmgbp[0] ." <div class='rTableCell green-col'>".round($monthcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php $numlastmeur = array(); $currlastmeur = array(); $numlastmgbp = array(); $currlastmgbp = array(); foreach ($Platlastmonths as $Platlastmonth): ?> 
				<?php if(($platformname === $Platlastmonth['ProcessedListing']['plateform']) && ($sourcename === $Platlastmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastmonth['ProcessedListing']['currency']==='EUR'){ $lastmonth1 += $Platlastmonth[0]['orderid']; $numlastmeur[] = $Platlastmonth[0]['orderid'];  $currlastmeur[] = $Platlastmonth['ProcessedListing']['currency'];} else if($Platlastmonth['ProcessedListing']['currency']==='GBP'){ $lastmonth2 += $Platlastmonth[0]['orderid'];  $numlastmgbp[] = $Platlastmonth[0]['orderid'];  $currlastmgbp[] = $Platlastmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numlastmeur[0])) && ($currlastmeur[0]==='EUR')){ echo "<td>". $numlastmeur[0] ."</td>";} else if((!empty($numlastmgbp[0])) && ($currlastmgbp[0]==='GBP')){ echo "<td>". $numlastmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numlastmeur[0])) && ($currlastmeur[0]==='EUR')){ $lastmcureuro = ((($numcurmeur[0]-$numlastmeur[0])/$numlastmeur[0])*100); if($lastmcureuro < 0) { echo "<td>". $numlastmeur[0] ." <div class='rTableCell color-red-col'>".round($lastmcureuro,2)."%"."</div></td>";}else { echo "<td>". $numlastmeur[0] ." <div class='rTableCell green-col'>".round($lastmcureuro,2)."%"."</div></td>";} } else if((!empty($numlastmgbp[0])) && ($currlastmgbp[0]==='GBP')){ $lastmcurgbp = ((($numcurmgbp[0]-$numlastmgbp[0])/$numlastmgbp[0])*100); if($lastmcurgbp < 0) {echo "<td>". $numlastmgbp[0] ." <div class='rTableCell color-red-col'>".round($lastmcurgbp,2)."%"."</div></td>";}else { echo "<td>". $numlastmgbp[0] ." <div class='rTableCell green-col'>".round($lastmcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numcurytdeur = array(); $currcurytdeur = array(); $numcurytdgbp = array(); $currcurytdgbp = array(); foreach ($Platcurrytds as $Platcurrytd): ?> 
				<?php if(($platformname === $Platcurrytd['ProcessedListing']['plateform']) && ($sourcename === $Platcurrytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrytd['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrytd['ProcessedListing']['currency']==='EUR'){ $currytd1 += $Platcurrytd[0]['orderid']; $numcurytdeur[] = $Platcurrytd[0]['orderid'];  $currcurytdeur[] = $Platcurrytd['ProcessedListing']['currency'];} else if($Platcurrytd['ProcessedListing']['currency']==='GBP'){ $currytd2 += $Platcurrytd[0]['orderid'];$numcurytdgbp[] = $Platcurrytd[0]['orderid'];  $currcurytdgbp[] = $Platcurrytd['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurytdeur[0])) && ($currcurytdeur[0]==='EUR')){ echo "<td>". $numcurytdeur[0] ."</td>";} else if((!empty($numcurytdgbp[0])) && ($currcurytdgbp[0]==='GBP')){ echo "<td>". $numcurytdgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
		
				<?php  $numlastytdeur = array(); $currlastytdeur = array(); $numlastytdgbp = array(); $currlastytdgbp = array(); foreach ($Platlastytds as $Platlastytd): ?> 
				<?php if(($platformname === $Platlastytd['ProcessedListing']['plateform']) && ($sourcename === $Platlastytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastytd['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastytd['ProcessedListing']['currency']==='EUR'){ $lastytd1 += $Platlastytd[0]['orderid']; $numlastytdeur[] = $Platlastytd[0]['orderid'];  $currlastytdeur[] = $Platlastytd['ProcessedListing']['currency'];} else if($Platlastytd['ProcessedListing']['currency']==='GBP'){ $lastytd2 += $Platlastytd[0]['orderid']; $numlastytdgbp[] = $Platlastytd[0]['orderid'];  $currlastytdgbp[] = $Platlastytd['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numlastytdeur[0])) && ($currlastytdeur[0]==='EUR')){ echo "<td>". $numlastytdeur[0] ."</td>";} else if((!empty($numlastytdgbp[0])) && ($currlastytdgbp[0]==='GBP')){ echo "<td>". $numlastytdgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numlastytdeur[0])) && ($currlastytdeur[0]==='EUR')){ $lastytdcureuro = ((($numcurytdeur[0]-$numlastytdeur[0])/$numlastytdeur[0])*100); if($lastytdcureuro < 0) { echo "<td>". $numlastytdeur[0] ." <div class='rTableCell color-red-col'>".round($lastytdcureuro,2)."%"."</div></td>";}else { echo "<td>". $numlastytdeur[0] ." <div class='rTableCell green-col'>".round($lastytdcureuro,2)."%"."</div></td>";} } else if((!empty($numlastytdgbp[0])) && ($currlastytdgbp[0]==='GBP')){ $lastytdcurgbp = ((($numcurytdgbp[0]-$numlastytdgbp[0])/$numlastytdgbp[0])*100); if($lastytdcurgbp < 0) {echo "<td>". $numlastytdgbp[0] ." <div class='rTableCell color-red-col'>".round($lastytdcurgbp,2)."%"."</div></td>";}else { echo "<td>". $numlastytdgbp[0] ." <div class='rTableCell green-col'>".round($lastytdcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numlastyeareur = array(); $currlastyeareur = array(); $numlastyeargbp = array(); $currlastyeargbp = array(); foreach ($Platlastyears as $Platlastyear): ?> 
				<?php if(($platformname === $Platlastyear['ProcessedListing']['plateform']) && ($sourcename === $Platlastyear['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastyear['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastyear['ProcessedListing']['currency']==='EUR'){ $lastyear1 += $Platlastyear[0]['orderid']; $numlastyeareur[] = $Platlastyear[0]['orderid'];  $currlastyeareur[] = $Platlastyear['ProcessedListing']['currency'];} else if($Platlastyear['ProcessedListing']['currency']==='GBP'){ $lastyear2 += $Platlastyear[0]['orderid']; $numlastyeargbp[] = $Platlastyear[0]['orderid'];  $currlastyeargbp[] = $Platlastyear['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numlastyeareur[0])) && ($currlastyeareur[0]==='EUR')){ echo "<td>". $numlastyeareur[0] ."</td>";} else if((!empty($numlastyeargbp[0])) && ($currlastyeargbp[0]==='GBP')){ echo "<td>". $numlastyeargbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
			</tr>			
	   <?php endforeach; ?>
	   <tr><td colspan="2"><strong>Total Orders</strong></td><td><?php $currweek = ($curweek1+$curweek2); echo $currweek; ?></td><td><?php $prevweek = ($prevweek1+$prevweek2); echo $prevweek; $precurweek = ((($currweek-$prevweek)/$prevweek)*100); if($precurweek < 0){ echo "<div class='rTableCell color-red-col'>".round($precurweek,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($precurweek,2)."%"."</div>"; } ?></td><td><?php $lastweek = $lastweek1+$lastweek2; echo $lastweek;  $lastcurweek = ((($currweek-$lastweek)/$lastweek)*100); if($lastcurweek < 0){ echo "<div class='rTableCell color-red-col'>".round($lastcurweek,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastcurweek,2)."%"."</div>"; } ?></td><td><?php $currmonth = $currmonth1+$currmonth2; echo $currmonth; ?></td><td><?php $pastmonth = $pastmonth1+$pastmonth2; echo $pastmonth; $curmonthpercetage = ((($currmonth-$pastmonth)/$pastmonth)*100); if($curmonthpercetage < 0){ echo "<div class='rTableCell color-red-col'>".round($curmonthpercetage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($curmonthpercetage,2)."%"."</div>"; }  ?></td><td><?php $lastmonth = $lastmonth1+$lastmonth2; echo $lastmonth; $lastthpercetage = ((($currmonth-$lastmonth)/$lastmonth)*100); if($lastthpercetage < 0){ echo "<div class='rTableCell color-red-col'>".round($lastthpercetage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastthpercetage,2)."%"."</div>"; } ?></td><td><?php $currytd = $currytd1+$currytd2; echo $currytd ; ?></td><td><?php $lastytd = $lastytd1+$lastytd2; echo $lastytd; $lastytdpercantage = ((($currytd-$lastytd)/$lastytd)*100); if($lastytdpercantage < 0){ echo "<div class='rTableCell color-red-col'>".round($lastytdpercantage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastytdpercantage,2)."%"."</div>"; }  ?></td><td><?php echo ($lastyear1+$lastyear2); ?></td></tr>
		</table>
		</div>