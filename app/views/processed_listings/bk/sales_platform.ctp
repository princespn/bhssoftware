<h1 class="sub-header"><?php __('Plateform and Category wise Sales Reports ');?></h1>
<hr>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-12 mobile-bottomspace"></div>
      </div>
    </div>
  </div> 
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
       <?php $a = '0'; foreach ($Results as $value): ?>  
        <?php $b = $value['ProcessedListing']['plateform'];
		$c = $value['ProcessedListing']['subsource']; ?> 
        <?php if($a!==$c){ echo "<tr><td><div class='accordion sale-by-category'><table class='table-responsive category'><tr><td class='width33'><table class='table-responsive table-bordered'><tr><td class='width33'>".$b."</td><td class='width33'>".$c."</td></tr></table></tr></table></div>";} ?>
        <?php if($a!==$c) {  ?><div class='catpanel'>
        <div class="rTableHeading">
		<div class="rTableHead"><?php __('Plateform');?>-<?php __('Subsource');?></div>          
        <div class="rTableHead"><?php __('Category');?></div>          
        <div class="rTableHead"><?php __('Current Week');?></div>                           
		<div class="rTableHead"><?php __('Last Week');?></div>  
		<div class="rTableHead"><?php __('Same Week Last Year');?></div> 
        <div class="rTableHead"><?php __('Current Month');?></div>                           
		<div class="rTableHead"><?php __('Last Month');?></div>  
		<div class="rTableHead"><?php __('Same Month Last Year');?></div> 
		<div class="rTableHead"><?php __('Current YTD');?></div>
		<div class="rTableHead"><?php __('Last YTD');?></div>
		<div class="rTableHead"><?php __('Last Year');?></div>
        </div><?php } ?> 
        <?php $a = $c; ?>
           <div class="rTableRow">
				<div class="rTableCell"><?php echo $value['ProcessedListing']['plateform']; ?>-<?php echo $value['ProcessedListing']['subsource']; ?></div>
				<div class="rTableCell"><?php echo $value['ProcessedListing']['cat_name']; ?></div>
				<?php  $numcureur = array(); $currcureur = array(); $numcurgbp = array(); $currcurgbp = array(); foreach ($Platcurweeks as $Platcurweek): ?> 
				<?php if(($value['ProcessedListing']['plateform'] === $Platcurweek['ProcessedListing']['plateform']) && ($value['ProcessedListing']['subsource'] === $Platcurweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurweek['ProcessedListing']['currency']==='EUR'){$numcureur[] = $Platcurweek[0]['orderid'];  $currcureur[] = $Platcurweek['ProcessedListing']['currency'];} else if($Platcurweek['ProcessedListing']['currency']==='GBP'){ $numcurgbp[] = $Platcurweek[0]['orderid'];  $currcurgbp[] = $Platcurweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcureur[0])) && ($currcureur[0]==='EUR')){ echo "<div class='rTableCell'>". $numcureur[0] ."</div>";} else if((!empty($numcurgbp[0])) && ($currcurgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $numcurgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>   
				
				<?php  $numpreveur = array(); $currpreveur = array(); $numprevgbp = array(); $currprevgbp = array(); foreach ($Platprevweeks as $Platprevweek): ?> 
				<?php if(($value['ProcessedListing']['plateform'] === $Platprevweek['ProcessedListing']['plateform']) && ($value['ProcessedListing']['subsource'] === $Platprevweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platprevweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platprevweek['ProcessedListing']['currency']==='EUR'){$numpreveur[] = $Platprevweek[0]['orderid'];  $currpreveur[] = $Platprevweek['ProcessedListing']['currency'];} else if($Platprevweek['ProcessedListing']['currency']==='GBP'){ $numprevgbp[] = $Platprevweek[0]['orderid'];  $currprevgbp[] = $Platprevweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numpreveur[0])) && ($currpreveur[0]==='EUR')){ echo "<div class='rTableCell'>". $numpreveur[0] ."</div>";} else if((!empty($numprevgbp[0])) && ($currprevgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $numprevgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
				
				<?php  $numlasteur = array(); $currlasteur = array(); $numlastgbp = array(); $currlastgbp = array(); foreach ($Platlastweeks as $Platlastweek): ?> 
				<?php if(($value['ProcessedListing']['plateform'] === $Platlastweek['ProcessedListing']['plateform']) && ($value['ProcessedListing']['subsource'] === $Platlastweek['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platlastweek['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platlastweek['ProcessedListing']['currency']==='EUR'){$numlasteur[] = $Platlastweek[0]['orderid'];  $currlasteur[] = $Platlastweek['ProcessedListing']['currency'];} else if($Platlastweek['ProcessedListing']['currency']==='GBP'){ $numlastgbp[] = $Platlastweek[0]['orderid'];  $currlastgbp[] = $Platlastweek['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?>				
				<?php if((!empty($numlasteur[0])) && ($currlasteur[0]==='EUR')){ echo "<div class='rTableCell'>". $numlasteur[0] ."</div>";} else if((!empty($numlastgbp[0])) && ($currlastgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $numlastgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
				
				<?php  $numcurmeur = array(); $currcurmeur = array(); $numcurmgbp = array(); $currcurmgbp = array(); foreach ($Platcurrmonths as $Platcurrmonth): ?> 
				<?php if(($value['ProcessedListing']['plateform'] === $Platcurrmonth['ProcessedListing']['plateform']) && ($value['ProcessedListing']['subsource'] === $Platcurrmonth['ProcessedListing']['subsource']) && ($value['ProcessedListing']['cat_name'] === $Platcurrmonth['ProcessedListing']['cat_name'])) { ?>
				<?php if($Platcurrmonth['ProcessedListing']['currency']==='EUR'){$numcurmeur[] = $Platcurrmonth[0]['orderid'];  $currcurmeur[] = $Platcurrmonth['ProcessedListing']['currency'];} else if($Platcurrmonth['ProcessedListing']['currency']==='GBP'){ $numcurmgbp[] = $Platcurrmonth[0]['orderid'];  $currcurmgbp[] = $Platcurrmonth['ProcessedListing']['currency']; }  ?>                              
                <?php } ?>
				<?php endforeach; ?> 
				<?php if((!empty($numcurmeur[0])) && ($currcurmeur[0]==='EUR')){ echo "<div class='rTableCell'>". $numcurmeur[0] ."</div>";} else if((!empty($numcurmgbp[0])) && ($currcurmgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $numcurmgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>   
				
				<div class="rTableCell"><?php //echo $value['ProcessedListing']['subsource']; ?></div>
				<div class="rTableCell"><?php //echo $value['ProcessedListing']['subsource']; ?></div>
	            <div class="rTableCell"><?php //echo $value['ProcessedListing']['subsource']; ?></div>
				<div class="rTableCell"><?php //echo $value['ProcessedListing']['subsource']; ?></div>
				<div class="rTableCell"><?php //echo $value['ProcessedListing']['subsource']; ?></div>
	                          
           </div>  
       
         <?php if($a!==$c) { echo "</div><td></tr>";} ?>
         <?php endforeach; ?> 
    
    </table>
 </div>
<script type="text/javascript">
$.noConflict(); //Not to conflict with other scripts
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