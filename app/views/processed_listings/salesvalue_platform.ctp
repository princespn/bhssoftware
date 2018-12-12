<?php //print_r($Platformnames);?>
<h1 class="sub-header"><?php __('Sale Platform- Detailed Analysis as per product category - Values of Orders');?></h1>
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
				<?php if($Platcurweek['ProcessedListing']['currency']==='EUR'){$curweek1 += $Platcurweek[0]['ordervalue']; $numcureur[] = $Platcurweek[0]['ordervalue'];  $currcureur[] = $Platcurweek['ProcessedListing']['currency'];} else if($Platcurweek['ProcessedListing']['currency']==='GBP'){ $curweek2 += $Platcurweek[0]['ordervalue']; $numcurgbp[] = $Platcurweek[0]['ordervalue'];  $currcurgbp[] = $Platcurweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcureur[0])) && ($currcureur[0]==='EUR')){ echo "<td>". round($numcureur[0],2) ."</td>";} else if((!empty($numcurgbp[0])) && ($currcurgbp[0]==='GBP')){ echo "<td>". round($numcurgbp[0],2) ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numpreveur = array(); $currpreveur = array(); $numprevgbp = array(); $currprevgbp = array(); foreach ($Platprevweeks as $Platprevweek): ?> 
				<?php if(($platformname === $Platprevweek['ProcessedListing']['plateform']) && ($sourcename === $Platprevweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevweek['ProcessedListing']['currency']==='EUR'){$prevweek1 += $Platprevweek[0]['ordervalue']; $numpreveur[] = $Platprevweek[0]['ordervalue'];  $currpreveur[] = $Platprevweek['ProcessedListing']['currency'];} else if($Platprevweek['ProcessedListing']['currency']==='GBP'){ $prevweek2 += $Platprevweek[0]['ordervalue']; $numprevgbp[] = $Platprevweek[0]['ordervalue'];  $currprevgbp[] = $Platprevweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numpreveur[0])) && ($currpreveur[0]==='EUR')){ $percureuro = ((($numcureur[0]-$numpreveur[0])/$numpreveur[0])*100); if($percureuro < 0) { echo "<td>". round($numpreveur[0],2) ." <div class='rTableCell color-red-col'>".round($percureuro,2)."%"."</div></td>";}else { echo "<td>". round($numpreveur[0],2) ." <div class='rTableCell green-col'>".round($percureuro,2)."%"."</div></td>";} } else if((!empty($numprevgbp[0])) && ($currprevgbp[0]==='GBP')){ $percurgbp = ((($numcurgbp[0]-$numprevgbp[0])/$numprevgbp[0])*100); if($percurgbp < 0) {echo "<td>". round($numprevgbp[0],2)." <div class='rTableCell color-red-col'>".round($percurgbp,2)."%"."</div></td>";}else { echo "<td>". round($numprevgbp[0],2)." <div class='rTableCell green-col'>".round($percurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numlasteur = array(); $currlasteur = array(); $numlastgbp = array(); $currlastgbp = array(); foreach ($Platlastweeks as $Platlastweek): ?> 
				<?php if(($platformname === $Platlastweek['ProcessedListing']['plateform']) && ($sourcename === $Platlastweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastweek['ProcessedListing']['currency']==='EUR'){ $lastweek1 += $Platlastweek[0]['ordervalue']; $numlasteur[] = $Platlastweek[0]['ordervalue'];  $currlasteur[] = $Platlastweek['ProcessedListing']['currency'];} else if($Platlastweek['ProcessedListing']['currency']==='GBP'){ $lastweek2 += $Platlastweek[0]['ordervalue']; $numlastgbp[] = $Platlastweek[0]['ordervalue'];  $currlastgbp[] = $Platlastweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>
				<?php if((!empty($numlasteur[0])) && ($currlasteur[0]==='EUR')){ $lastcureuro = ((($numcureur[0]-$numlasteur[0])/$numlasteur[0])*100); if($lastcureuro < 0) { echo "<td>". round($numlasteur[0],2)." <div class='rTableCell color-red-col'>".round($lastcureuro,2)."%"."</div></td>";}else { echo "<td>". round($numlasteur[0],2)." <div class='rTableCell green-col'>".round($lastcureuro,2)."%"."</div></td>";} } else if((!empty($numlastgbp[0])) && ($currlastgbp[0]==='GBP')){ $lastcurgbp = ((($numcurgbp[0]-$numlastgbp[0])/$numlastgbp[0])*100); if($lastcurgbp < 0) {echo "<td>". round($numlastgbp[0],2)." <div class='rTableCell color-red-col'>".round($lastcurgbp,2)."%"."</div></td>";}else { echo "<td>". round($numlastgbp[0],2)." <div class='rTableCell green-col'>".round($lastcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				
				<?php  $numcurmeur = array(); $currcurmeur = array(); $numcurmgbp = array(); $currcurmgbp = array(); foreach ($Platcurrmonths as $Platcurrmonth): ?> 
				<?php if(($platformname === $Platcurrmonth['ProcessedListing']['plateform']) && ($sourcename === $Platcurrmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrmonth['ProcessedListing']['currency']==='EUR'){ $currmonth1 += $Platcurrmonth[0]['ordervalue']; $numcurmeur[] = $Platcurrmonth[0]['ordervalue'];  $currcurmeur[] = $Platcurrmonth['ProcessedListing']['currency'];} else if($Platcurrmonth['ProcessedListing']['currency']==='GBP'){ $currmonth2 += $Platcurrmonth[0]['ordervalue'];  $numcurmgbp[] = $Platcurrmonth[0]['ordervalue'];  $currcurmgbp[] = $Platcurrmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurmeur[0])) && ($currcurmeur[0]==='EUR')){ echo "<td>". round($numcurmeur[0],2) ."</td>";} else if((!empty($numcurmgbp[0])) && ($currcurmgbp[0]==='GBP')){ echo "<td>". round($numcurmgbp[0],2) ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numprevmeur = array(); $currprevmeur = array(); $numprevmgbp = array(); $currprevmgbp = array(); foreach ($Platprevmonths as $Platprevmonth): ?> 
				<?php if(($platformname === $Platprevmonth['ProcessedListing']['plateform']) && ($sourcename === $Platprevmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevmonth['ProcessedListing']['currency']==='EUR'){ $pastmonth1 += $Platprevmonth[0]['ordervalue']; $numprevmeur[] = $Platprevmonth[0]['ordervalue'];  $currprevmeur[] = $Platprevmonth['ProcessedListing']['currency'];} else if($Platprevmonth['ProcessedListing']['currency']==='GBP'){  $pastmonth2 += $Platprevmonth[0]['ordervalue']; $numprevmgbp[] = $Platprevmonth[0]['ordervalue'];  $currprevmgbp[] = $Platprevmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){ echo "<td>". $numprevmeur[0] ."</td>";} else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ echo "<td>". $numprevmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){ $monthcureuro = ((($numcurmeur[0]-$numprevmeur[0])/$numprevmeur[0])*100); if($monthcureuro < 0) { echo "<td>". round($numprevmeur[0],2) ." <div class='rTableCell color-red-col'>".round($monthcureuro,2)."%"."</div></td>";}else { echo "<td>". round($numprevmeur[0],2) ." <div class='rTableCell green-col'>".round($monthcureuro,2)."%"."</div></td>";} } else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ $monthcurgbp = ((($numcurmgbp[0]-$numprevmgbp[0])/$numprevmgbp[0])*100); if($monthcurgbp < 0) {echo "<td>". round($numprevmgbp[0],2) ." <div class='rTableCell color-red-col'>".round($monthcurgbp,2)."%"."</div></td>";}else { echo "<td>". round($numprevmgbp[0],2) ." <div class='rTableCell green-col'>".round($monthcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php $numlastmeur = array(); $currlastmeur = array(); $numlastmgbp = array(); $currlastmgbp = array(); foreach ($Platlastmonths as $Platlastmonth): ?> 
				<?php if(($platformname === $Platlastmonth['ProcessedListing']['plateform']) && ($sourcename === $Platlastmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastmonth['ProcessedListing']['currency']==='EUR'){ $lastmonth1 += $Platlastmonth[0]['ordervalue']; $numlastmeur[] = $Platlastmonth[0]['ordervalue'];  $currlastmeur[] = $Platlastmonth['ProcessedListing']['currency'];} else if($Platlastmonth['ProcessedListing']['currency']==='GBP'){ $lastmonth2 += $Platlastmonth[0]['ordervalue'];  $numlastmgbp[] = $Platlastmonth[0]['ordervalue'];  $currlastmgbp[] = $Platlastmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numlastmeur[0])) && ($currlastmeur[0]==='EUR')){ echo "<td>". $numlastmeur[0] ."</td>";} else if((!empty($numlastmgbp[0])) && ($currlastmgbp[0]==='GBP')){ echo "<td>". $numlastmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numlastmeur[0])) && ($currlastmeur[0]==='EUR')){ $lastmcureuro = ((($numcurmeur[0]-$numlastmeur[0])/$numlastmeur[0])*100); if($lastmcureuro < 0) { echo "<td>". round($numlastmeur[0],2) ." <div class='rTableCell color-red-col'>".round($lastmcureuro,2)."%"."</div></td>";}else { echo "<td>". round($numlastmeur[0],2) ." <div class='rTableCell green-col'>".round($lastmcureuro,2)."%"."</div></td>";} } else if((!empty($numlastmgbp[0])) && ($currlastmgbp[0]==='GBP')){ $lastmcurgbp = ((($numcurmgbp[0]-$numlastmgbp[0])/$numlastmgbp[0])*100); if($lastmcurgbp < 0) {echo "<td>". round($numlastmgbp[0],2) ." <div class='rTableCell color-red-col'>".round($lastmcurgbp,2)."%"."</div></td>";}else { echo "<td>". round($numlastmgbp[0],2) ." <div class='rTableCell green-col'>".round($lastmcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numcurytdeur = array(); $currcurytdeur = array(); $numcurytdgbp = array(); $currcurytdgbp = array(); foreach ($Platcurrytds as $Platcurrytd): ?> 
				<?php if(($platformname === $Platcurrytd['ProcessedListing']['plateform']) && ($sourcename === $Platcurrytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrytd['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrytd['ProcessedListing']['currency']==='EUR'){ $currytd1 += $Platcurrytd[0]['ordervalue']; $numcurytdeur[] = $Platcurrytd[0]['ordervalue'];  $currcurytdeur[] = $Platcurrytd['ProcessedListing']['currency'];} else if($Platcurrytd['ProcessedListing']['currency']==='GBP'){ $currytd2 += $Platcurrytd[0]['ordervalue'];$numcurytdgbp[] = $Platcurrytd[0]['ordervalue'];  $currcurytdgbp[] = $Platcurrytd['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurytdeur[0])) && ($currcurytdeur[0]==='EUR')){ echo "<td>". round($numcurytdeur[0],2) ."</td>";} else if((!empty($numcurytdgbp[0])) && ($currcurytdgbp[0]==='GBP')){ echo "<td>". round($numcurytdgbp[0],2) ."</td>"; } else { echo "<td>-</td>"; } ?>   
		
				<?php  $numlastytdeur = array(); $currlastytdeur = array(); $numlastytdgbp = array(); $currlastytdgbp = array(); foreach ($Platlastytds as $Platlastytd): ?> 
				<?php if(($platformname === $Platlastytd['ProcessedListing']['plateform']) && ($sourcename === $Platlastytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastytd['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastytd['ProcessedListing']['currency']==='EUR'){ $lastytd1 += $Platlastytd[0]['ordervalue']; $numlastytdeur[] = $Platlastytd[0]['ordervalue'];  $currlastytdeur[] = $Platlastytd['ProcessedListing']['currency'];} else if($Platlastytd['ProcessedListing']['currency']==='GBP'){ $lastytd2 += $Platlastytd[0]['ordervalue']; $numlastytdgbp[] = $Platlastytd[0]['ordervalue'];  $currlastytdgbp[] = $Platlastytd['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php //if((!empty($numlastytdeur[0])) && ($currlastytdeur[0]==='EUR')){ echo "<td>". $numlastytdeur[0] ."</td>";} else if((!empty($numlastytdgbp[0])) && ($currlastytdgbp[0]==='GBP')){ echo "<td>". $numlastytdgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				<?php if((!empty($numlastytdeur[0])) && ($currlastytdeur[0]==='EUR')){ $lastytdcureuro = ((($numcurytdeur[0]-$numlastytdeur[0])/$numlastytdeur[0])*100); if($lastytdcureuro < 0) { echo "<td>". round($numlastytdeur[0],2) ." <div class='rTableCell color-red-col'>".round($lastytdcureuro,2)."%"."</div></td>";}else { echo "<td>". round($numlastytdeur[0],2) ." <div class='rTableCell green-col'>".round($lastytdcureuro,2)."%"."</div></td>";} } else if((!empty($numlastytdgbp[0])) && ($currlastytdgbp[0]==='GBP')){ $lastytdcurgbp = ((($numcurytdgbp[0]-$numlastytdgbp[0])/$numlastytdgbp[0])*100); if($lastytdcurgbp < 0) {echo "<td>". round($numlastytdgbp[0],2) ." <div class='rTableCell color-red-col'>".round($lastytdcurgbp,2)."%"."</div></td>";}else { echo "<td>". round($numlastytdgbp[0],2) ." <div class='rTableCell green-col'>".round($lastytdcurgbp,2)."%"."</div></td>";} } else { echo "<td>-</td>"; } ?>
				
				<?php  $numlastyeareur = array(); $currlastyeareur = array(); $numlastyeargbp = array(); $currlastyeargbp = array(); foreach ($Platlastyears as $Platlastyear): ?> 
				<?php if(($platformname === $Platlastyear['ProcessedListing']['plateform']) && ($sourcename === $Platlastyear['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastyear['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastyear['ProcessedListing']['currency']==='EUR'){ $lastyear1 += $Platlastyear[0]['ordervalue']; $numlastyeareur[] = $Platlastyear[0]['ordervalue'];  $currlastyeareur[] = $Platlastyear['ProcessedListing']['currency'];} else if($Platlastyear['ProcessedListing']['currency']==='GBP'){ $lastyear2 += $Platlastyear[0]['ordervalue']; $numlastyeargbp[] = $Platlastyear[0]['ordervalue'];  $currlastyeargbp[] = $Platlastyear['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numlastyeareur[0])) && ($currlastyeareur[0]==='EUR')){ echo "<td>". round($numlastyeareur[0],2) ."</td>";} else if((!empty($numlastyeargbp[0])) && ($currlastyeargbp[0]==='GBP')){ echo "<td>". round($numlastyeargbp[0],2) ."</td>"; } else { echo "<td>-</td>"; } ?>   
			</tr>			
	   <?php endforeach; ?>
	   <tr><td colspan="2"><strong>Total Orders</strong></td><td><?php $currweek = ($curweek1+$curweek2); echo $currweek; ?></td><td><?php $prevweek = ($prevweek1+$prevweek2); echo $prevweek; $precurweek = ((($currweek-$prevweek)/$prevweek)*100); if($precurweek < 0){ echo "<div class='rTableCell color-red-col'>".round($precurweek,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($precurweek,2)."%"."</div>"; } ?></td><td><?php $lastweek = $lastweek1+$lastweek2; echo $lastweek;  $lastcurweek = ((($currweek-$lastweek)/$lastweek)*100); if($lastcurweek < 0){ echo "<div class='rTableCell color-red-col'>".round($lastcurweek,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastcurweek,2)."%"."</div>"; } ?></td><td><?php $currmonth = $currmonth1+$currmonth2; echo $currmonth; ?></td><td><?php $pastmonth = $pastmonth1+$pastmonth2; echo $pastmonth; $curmonthpercetage = ((($currmonth-$pastmonth)/$pastmonth)*100); if($curmonthpercetage < 0){ echo "<div class='rTableCell color-red-col'>".round($curmonthpercetage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($curmonthpercetage,2)."%"."</div>"; }  ?></td><td><?php $lastmonth = $lastmonth1+$lastmonth2; echo $lastmonth; $lastthpercetage = ((($currmonth-$lastmonth)/$lastmonth)*100); if($lastthpercetage < 0){ echo "<div class='rTableCell color-red-col'>".round($lastthpercetage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastthpercetage,2)."%"."</div>"; } ?></td><td><?php $currytd = $currytd1+$currytd2; echo $currytd ; ?></td><td><?php $lastytd = $lastytd1+$lastytd2; echo $lastytd; $lastytdpercantage = ((($currytd-$lastytd)/$lastytd)*100); if($lastytdpercantage < 0){ echo "<div class='rTableCell color-red-col'>".round($lastytdpercantage,2)."%"."</div>"; }else{ echo "<div class='rTableCell green-col'>".round($lastytdpercantage,2)."%"."</div>"; }  ?></td><td><?php echo ($lastyear1+$lastyear2); ?></td></tr>
		<tr><td colspan="11"></td></tr>
		<tr>
		<td colspan="3"><?php echo "<B>Current Month</B>";?></BR><div id="piechart"  style="width: 450px; height: 250px;"></div></td><td colspan="4"><?php echo "<B>Last Month</B>";?></BR><div id="piechartlast" style="width: 450px; height: 250px;"></div></td><td colspan="4"><?php echo "<B>Same Month Last Year</B>";?></BR><div id="piechartlastmonth" style="width: 450px; height: 250px;"></div></td>
		</tr>
		<tr><td colspan="11"></td></tr>
		<tr>
		<td colspan="4"><?php echo "<B>Current YTD</B>";?></BR><div id="piechartcurrytd" style="width: 450px; height: 250px;"></div></td><td colspan="4"><?php echo "<B>Last YTD</B>";?></BR><div id="piechartlastytd" style="width: 450px; height: 250px;"></div></td>
		</tr>
		</table>
		</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart); 
google.charts.setOnLoadCallback(drawChartlast); 
google.charts.setOnLoadCallback(drawChartmonth); 
google.charts.setOnLoadCallback(drawChartcurrytd); 
google.charts.setOnLoadCallback(drawChartlastytd); 
var options = {      
		legend: 'none',
		is3D: true,
		//tooltip: {isHtml: true},
		//colors: ['red','yellow', 'blue'],
		chartArea: {width: 550, height: 400}
    };
function drawChart() { 
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Orders'],
      <?php
		 foreach($Results as $value){ $search = $value['ProcessedListing']['cat_name']; $searchString = '/';
		    if( strpos($search, $searchString) === false ) {
				$num = array('0.00'); $numcurmeur = array(); $currcurmeur = array(); $numcurmgbp = array(); $currcurmgbp = array(); foreach ($Platcurrmonths as $Platcurrmonth){
					if(($platformname === $Platcurrmonth['ProcessedListing']['plateform']) && ($sourcename === $Platcurrmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrmonth['ProcessedListing']['cat_name'])) {
					if($Platcurrmonth['ProcessedListing']['currency']==='EUR'){ $currmonth1 += $Platcurrmonth[0]['ordervalue']; $numcurmeur[] = $Platcurrmonth[0]['ordervalue'];  $currcurmeur[] = $Platcurrmonth['ProcessedListing']['currency'];} else if($Platcurrmonth['ProcessedListing']['currency']==='GBP'){ $currmonth2 += $Platcurrmonth[0]['ordervalue'];  $numcurmgbp[] = $Platcurrmonth[0]['ordervalue'];  $currcurmgbp[] = $Platcurrmonth['ProcessedListing']['currency']; }                             
					}  
				  }
		 
			   if((!empty($numcurmeur[0])) && ($currcurmeur[0]==='EUR')){  echo "['".$value['ProcessedListing']['cat_name']."', ".$numcurmeur[0]."],";} else if((!empty($numcurmgbp[0])) && ($currcurmgbp[0]==='GBP')){ echo "['".$value['ProcessedListing']['cat_name']."', ".$numcurmgbp[0]."],"; }else{ echo "['".$value['ProcessedListing']['cat_name']."', ".$num[0]."],"; }    
			}      
		}
      ?>
    ]);  
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data,options);
}

function drawChartlast() { 
    var datalast = google.visualization.arrayToDataTable([
      ['Category', 'Orders'],
      <?php
		 foreach($Results as $value){ $search = $value['ProcessedListing']['cat_name']; $searchString = '/';
		   if( strpos($search, $searchString) === false ) {
			
			$nump = array('0.00'); $numprevmeur = array(); $currprevmeur = array(); $numprevmgbp = array(); $currprevmgbp = array(); foreach ($Platprevmonths as $Platprevmonth){
				if(($platformname === $Platprevmonth['ProcessedListing']['plateform']) && ($sourcename === $Platprevmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevmonth['ProcessedListing']['cat_name'])) {
				if($Platprevmonth['ProcessedListing']['currency']==='EUR'){ $numprevmeur[] = $Platprevmonth[0]['ordervalue'];  $currprevmeur[] = $Platprevmonth['ProcessedListing']['currency'];} else if($Platprevmonth['ProcessedListing']['currency']==='GBP'){  $numprevmgbp[] = $Platprevmonth[0]['ordervalue'];  $currprevmgbp[] = $Platprevmonth['ProcessedListing']['currency']; }                             
				}  
			  }
			if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){  echo "['".$value['ProcessedListing']['cat_name']."', ".$numprevmeur[0]."],";} else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ echo "['".$value['ProcessedListing']['cat_name']."', ".$numprevmgbp[0]."],"; }else{ echo "['".$value['ProcessedListing']['cat_name']."', ".$nump[0]."],";}    
				
		   } 
		}
      ?>
    ]); 
    var chart = new google.visualization.PieChart(document.getElementById('piechartlast'));
    chart.draw(datalast,options);
}

function drawChartmonth() { 
    var datalastmonth = google.visualization.arrayToDataTable([
      ['Category', 'Orders'],
      <?php
		foreach($Results as $value){ $search = $value['ProcessedListing']['cat_name']; $searchString = '/';
		   if( strpos($search, $searchString) === false ) {
		   $numl = array('0.00'); $numlastmeur = array(); $currlastmeur = array(); $numlastmgbp = array(); $currlastmgbp = array(); foreach ($Platlastmonths as $Platlastmonth){
				if(($platformname === $Platlastmonth['ProcessedListing']['plateform']) && ($sourcename === $Platlastmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastmonth['ProcessedListing']['cat_name'])) {
				if($Platlastmonth['ProcessedListing']['currency']==='EUR'){ $numlastmeur[] = $Platlastmonth[0]['ordervalue'];  $currlastmeur[] = $Platlastmonth['ProcessedListing']['currency'];} else if($Platlastmonth['ProcessedListing']['currency']==='GBP'){  $numlastmgbp[] = $Platlastmonth[0]['ordervalue'];  $currlastmgbp[] = $Platlastmonth['ProcessedListing']['currency']; }                             
				}  
			  }
			if((!empty($numlastmeur[0])) && ($currlastmeur[0]==='EUR')){  echo "['".$value['ProcessedListing']['cat_name']."', ".$numlastmeur[0]."],";} else if((!empty($numlastmgbp[0])) && ($currlastmgbp[0]==='GBP')){ echo "['".$value['ProcessedListing']['cat_name']."', ".$numlastmgbp[0]."],"; }else{echo "['".$value['ProcessedListing']['cat_name']."', ".$numl[0]."],"; } 
				
		   } 
		}
      ?>
    ]); 
    var chart = new google.visualization.PieChart(document.getElementById('piechartlastmonth'));
    chart.draw(datalastmonth,options);
}

function drawChartcurrytd() { 
    var datalastytd = google.visualization.arrayToDataTable([
      ['Category', 'Orders'],
      <?php
		foreach($Results as $value){ $search = $value['ProcessedListing']['cat_name']; $searchString = '/';
		   if( strpos($search, $searchString) === false ) {
				$numc = array('0.00'); $numcurytdeur = array(); $currcurytdeur = array(); $numcurytdgbp = array(); $currcurytdgbp = array(); foreach ($Platcurrytds as $Platcurrytd){
				if(($platformname === $Platcurrytd['ProcessedListing']['plateform']) && ($sourcename === $Platcurrytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrytd['ProcessedListing']['cat_name'])) {
				if($Platcurrytd['ProcessedListing']['currency']==='EUR'){ $numcurytdeur[] = $Platcurrytd[0]['ordervalue'];  $currcurytdeur[] = $Platcurrytd['ProcessedListing']['currency'];} else if($Platcurrytd['ProcessedListing']['currency']==='GBP'){  $numcurytdgbp[] = $Platcurrytd[0]['ordervalue'];  $currcurytdgbp[] = $Platcurrytd['ProcessedListing']['currency']; }                             
				}  
			  }
			if((!empty($numcurytdeur[0])) && ($currcurytdeur[0]==='EUR')){  echo "['".$value['ProcessedListing']['cat_name']."', ".$numcurytdeur[0]."],";} else if((!empty($numcurytdgbp[0])) && ($currcurytdgbp[0]==='GBP')){ echo "['".$value['ProcessedListing']['cat_name']."', ".$numcurytdgbp[0]."],"; }else{echo "['".$value['ProcessedListing']['cat_name']."', ".$numc[0]."],"; }
				
		   } 
		}
      ?>
    ]); 
    var chart = new google.visualization.PieChart(document.getElementById('piechartcurrytd'));
    chart.draw(datalastytd,options);
}

function drawChartlastytd() { 
    var datacuuytd = google.visualization.arrayToDataTable([
      ['Category', 'Orders'],
      <?php
		foreach($Results as $value){ $search = $value['ProcessedListing']['cat_name']; $searchString = '/';
		   if( strpos($search, $searchString) === false ) {
				$numlyd = array('0.00'); $numlastytdeur = array(); $currlastytdeur = array(); $numlastytdgbp = array(); $currlastytdgbp = array(); foreach ($Platlastytds as $Platlastytd){
				if(($platformname === $Platlastytd['ProcessedListing']['plateform']) && ($sourcename === $Platlastytd['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastytd['ProcessedListing']['cat_name'])) {
				if($Platlastytd['ProcessedListing']['currency']==='EUR'){ $numlastytdeur[] = $Platlastytd[0]['ordervalue'];  $currlastytdeur[] = $Platlastytd['ProcessedListing']['currency'];} else if($Platlastytd['ProcessedListing']['currency']==='GBP'){  $numlastytdgbp[] = $Platlastytd[0]['ordervalue'];  $currlastytdgbp[] = $Platlastytd['ProcessedListing']['currency']; }                             
				}  
			  }
			if((!empty($numlastytdeur[0])) && ($currlastytdeur[0]==='EUR')){  echo "['".$value['ProcessedListing']['cat_name']."', ".$numlastytdeur[0]."],";} else if((!empty($numlastytdgbp[0])) && ($currlastytdgbp[0]==='GBP')){ echo "['".$value['ProcessedListing']['cat_name']."', ".$numlastytdgbp[0]."],"; }else{ echo "['".$value['ProcessedListing']['cat_name']."', ".$numlyd[0]."],";}
				
		   } 
		}
      ?>
    ]); 
    var chart = new google.visualization.PieChart(document.getElementById('piechartlastytd'));
    chart.draw(datacuuytd,options);
}
</script>