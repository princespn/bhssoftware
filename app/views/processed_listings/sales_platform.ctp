<?php //print_r($Platformnames);?>
<h1 class="sub-header"><?php __('Sale Platform- Detailed Analysis as per product category - Number of Orders');?></h1>
<hr>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-12 mobile-bottomspace">
	   <?php foreach ($Platnames as $Platformname): ?>
	   <?php $mystring = $Platformname['ProcessedListing']['plateform']; $findme ='FBA';
		$pos = strpos($mystring, $findme); if($pos !== false){ $pname = $Platformname['ProcessedListing']['subsource'].' '.$findme;}else {$pname = $Platformname['ProcessedListing']['subsource'];} ?>
		<div class='col-md-2'><form name="<?php echo $pname ?>" id="<?php echo $pname ?>" method="post" action="">
	   <input type="hidden" name="sourceid" value="<?php echo $Platformname['ProcessedListing']['subsource'] ?>" />
	   <input type="hidden" name="plateformid" value="<?php echo $Platformname['ProcessedListing']['plateform']; ?>" />
		
		<a href="#" onclick="document.getElementById('<?php echo $pname ?>').submit();"><?php echo $pname ?></a></form></div>
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
				<?php if($Platcurweek['ProcessedListing']['currency']==='EUR'){$numcureur[] = $Platcurweek[0]['orderid'];  $currcureur[] = $Platcurweek['ProcessedListing']['currency'];} else if($Platcurweek['ProcessedListing']['currency']==='GBP'){ $numcurgbp[] = $Platcurweek[0]['orderid'];  $currcurgbp[] = $Platcurweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcureur[0])) && ($currcureur[0]==='EUR')){ echo "<td>". $numcureur[0] ."</td>";} else if((!empty($numcurgbp[0])) && ($currcurgbp[0]==='GBP')){ echo "<td>". $numcurgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numpreveur = array(); $currpreveur = array(); $numprevgbp = array(); $currprevgbp = array(); foreach ($Platprevweeks as $Platprevweek): ?> 
				<?php if(($platformname === $Platprevweek['ProcessedListing']['plateform']) && ($sourcename === $Platprevweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevweek['ProcessedListing']['currency']==='EUR'){$numpreveur[] = $Platprevweek[0]['orderid'];  $currpreveur[] = $Platprevweek['ProcessedListing']['currency'];} else if($Platprevweek['ProcessedListing']['currency']==='GBP'){ $numprevgbp[] = $Platprevweek[0]['orderid'];  $currprevgbp[] = $Platprevweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numpreveur[0])) && ($currpreveur[0]==='EUR')){ echo "<td>". $numpreveur[0] ."</td>";} else if((!empty($numprevgbp[0])) && ($currprevgbp[0]==='GBP')){ echo "<td>". $numprevgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>
				
				<?php  $numlasteur = array(); $currlasteur = array(); $numlastgbp = array(); $currlastgbp = array(); foreach ($Platlastweeks as $Platlastweek): ?> 
				<?php if(($platformname === $Platlastweek['ProcessedListing']['plateform']) && ($sourcename === $Platlastweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastweek['ProcessedListing']['currency']==='EUR'){$numlasteur[] = $Platlastweek[0]['orderid'];  $currlasteur[] = $Platlastweek['ProcessedListing']['currency'];} else if($Platlastweek['ProcessedListing']['currency']==='GBP'){ $numlastgbp[] = $Platlastweek[0]['orderid'];  $currlastgbp[] = $Platlastweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numlasteur[0])) && ($currlasteur[0]==='EUR')){ echo "<td>". $numlasteur[0] ."</td>";} else if((!empty($numlastgbp[0])) && ($currlastgbp[0]==='GBP')){ echo "<td>". $numlastgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>
				
				<?php  $numcurmeur = array(); $currcurmeur = array(); $numcurmgbp = array(); $currcurmgbp = array(); foreach ($Platcurrmonths as $Platcurrmonth): ?> 
				<?php if(($platformname === $Platcurrmonth['ProcessedListing']['plateform']) && ($sourcename === $Platcurrmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrmonth['ProcessedListing']['currency']==='EUR'){$numcurmeur[] = $Platcurrmonth[0]['orderid'];  $currcurmeur[] = $Platcurrmonth['ProcessedListing']['currency'];} else if($Platcurrmonth['ProcessedListing']['currency']==='GBP'){ $numcurmgbp[] = $Platcurrmonth[0]['orderid'];  $currcurmgbp[] = $Platcurrmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurmeur[0])) && ($currcurmeur[0]==='EUR')){ echo "<td>". $numcurmeur[0] ."</td>";} else if((!empty($numcurmgbp[0])) && ($currcurmgbp[0]==='GBP')){ echo "<td>". $numcurmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
				<?php  $numprevmeur = array(); $currprevmeur = array(); $numprevmgbp = array(); $currprevmgbp = array(); foreach ($Platprevmonths as $Platprevmonth): ?> 
				<?php if(($platformname === $Platprevmonth['ProcessedListing']['plateform']) && ($sourcename === $Platprevmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevmonth['ProcessedListing']['currency']==='EUR'){$numprevmeur[] = $Platprevmonth[0]['orderid'];  $currprevmeur[] = $Platprevmonth['ProcessedListing']['currency'];} else if($Platprevmonth['ProcessedListing']['currency']==='GBP'){ $numprevmgbp[] = $Platprevmonth[0]['orderid'];  $currprevmgbp[] = $Platprevmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numprevmeur[0])) && ($currprevmeur[0]==='EUR')){ echo "<td>". $numprevmeur[0] ."</td>";} else if((!empty($numprevmgbp[0])) && ($currprevmgbp[0]==='GBP')){ echo "<td>". $numprevmgbp[0] ."</td>"; } else { echo "<td>-</td>"; } ?>   
				
		<td><?php //echo $value['ProcessedListing']['cat_name']; ?></td>
		<td><?php //echo $value['ProcessedListing']['cat_name']; ?></td>
		<td><?php //echo $value['ProcessedListing']['cat_name']; ?></td>
		<td><?php //echo $value['ProcessedListing']['cat_name']; ?></td>
		
		</tr>
	   <?php endforeach; ?>
		</table>
	</div>
