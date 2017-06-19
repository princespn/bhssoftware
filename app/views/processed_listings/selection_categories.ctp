<hr>
<?php //print_r($countselectdates1); die(); ?>
  <h1 class="sub-header"><?php __('Sales Dates or Periods Selection Orders Reports');?></h1>
  <div class="panel panel-default" >
    <?php  echo $form->create('ProcessedListing',array('action'=>'selection_categories')); ?>
    <div class="panel-body" ng-app="">
      <div class="row">
        <div class="col-md-12 mobile-bottomspace">
            <div class="col-md-2"><b>Date Selection</b></div><div class="col-md-1">From</div><div class="col-md-2"><?php echo $this->Form->input('date_from',array('label'=>false,'div'=>false,'id'=>'date_from','class'=>'form-control'))?></div><div class="col-md-1">TO</div><div class="col-md-2"><?php echo $this->Form->input('date_to',array('label'=>false,'div'=>false,'id'=>'date_to','class'=>'form-control'))?></div><div class="col-md-5 input-group-btn"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
         </div>          
      </div>
       <hr>
    <script type="text/javascript">
            $(document).ready(function() { 
             $value1 = $('input:text[name=date_from]').val();   
              $value2 = $('input:text[name=date_to]').val();                     
            });
	</script>
       <div class="row"><?php /* $from_date = date('2017-01-09');
                                $to_date =  date('2017-05-09');
                                $day_interval = round((strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24),0); 
                                $week_interval = round($day_interval/7,0);
                                $month_interval =  (int)abs((strtotime($from_date) - strtotime($to_date))/(60*60*24*29)); */ ?>
        <div class="col-md-12 mobile-bottomspace"><?php $option = array($month_interval =>'Months'); ?>
        <div class="col-md-3"><b>Period Selection</b></div><div class="col-md-6"><?php  echo $this->Form->input('selected_period', array('label'=>false,'options' => $option ,'checked' =>'checked' ,'legend' => false,'div'=>false, 'type' => 'radio'));?></div>
       </div>          
      </div>
       <hr>
       <div class="row">
        <div class="col-md-12 mobile-bottomspace">
        <div class="col-md-3"><b>Number of Periods in Selected date.</b></div><div class="col-md-4"><?php echo  $this->Form->input('number_period',array('label'=>false,'div'=>false,'value' =>$month_interval,'id'=>'number_period','class'=>'form-control')); ?></div>
        </div>          
      </div>
    </div>
	<?php echo $this->Form->end();?>
  </div> 
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr><td width="100px"><strong><?php __('Category name');?></strong></td>		
		<?php   for($i=1; $i<=$month_interval; $i++){ ?><td><table class="table table-bordered table-striped table-hover"><tr><td width="100px" colspan="2"><strong><?php __('Period');?><?php echo $i; ?></strong></td></tr>
			<tr><td width="100px">No of Orders</td><td width="100px">Order values</td></tr></table></td><?php } ?>
			<td width="100px"><strong><?php __('Total No of Order');?></strong></td>
			<td width="100px"><strong><?php __('Total Order vlues');?></strong></td></tr>
		 <?php    $a = '0'; foreach ($countselectdates as $value): ?>  
        <?php $b = $value['ProcessedListing']['cat_name']; ?>
		    <?php foreach ($Catsaveall as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur = $currentsweeks[0]['orderid']; $Totalordersumeur = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp = $currentsweeks[0]['orderid'];  $Totalordersumegbp = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb = $Totalnumbsumeur+$Totalnumbsumegbp; $TotalOrder = $Totalordersumeur+$Totalordersumegbp;  } ?>
            <?php endforeach; ?> 
			 <?php foreach ($Catsaveall1 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur1 = $currentsweeks[0]['orderid']; $Totalordersumeur1 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp1 = $currentsweeks[0]['orderid'];  $Totalordersumegbp1 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb1 = $Totalnumbsumeur1+$Totalnumbsumegbp1; $TotalOrder1 = $Totalordersumeur1+$Totalordersumegbp1;  } ?>
            <?php endforeach; ?> 
			 <?php foreach ($Catsaveall2 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur2 = $currentsweeks[0]['orderid']; $Totalordersumeur2 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp2 = $currentsweeks[0]['orderid'];  $Totalordersumegbp2 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb2 = $Totalnumbsumeur2+$Totalnumbsumegbp2; $TotalOrder2 = $Totalordersumeur2+$Totalordersumegbp2;  } ?>
            <?php endforeach; ?>
			<?php foreach ($Catsaveall3 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur3 = $currentsweeks[0]['orderid']; $Totalordersumeur3 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp3 = $currentsweeks[0]['orderid'];  $Totalordersumegbp3 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb3 = $Totalnumbsumeur3+$Totalnumbsumegbp3; $TotalOrder3 = $Totalordersumeur3+$Totalordersumegbp3;  } ?>
            <?php endforeach; ?>
			<?php foreach ($Catsaveall4 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur4 = $currentsweeks[0]['orderid']; $Totalordersumeur4 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp4 = $currentsweeks[0]['orderid'];  $Totalordersumegbp4 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb4 = $Totalnumbsumeur4+$Totalnumbsumegbp4; $TotalOrder4 = $Totalordersumeur4+$Totalordersumegbp4;  } ?>
            <?php endforeach; ?>
			<?php foreach ($Catsaveall5 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur5 = $currentsweeks[0]['orderid']; $Totalordersumeur5 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp4 = $currentsweeks[0]['orderid'];  $Totalordersumegbp5 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb5 = $Totalnumbsumeur5+$Totalnumbsumegbp5; $TotalOrder5 = $Totalordersumeur5+$Totalordersumegbp5;  } ?>
            <?php endforeach; ?>
			<?php foreach ($Catsaveall6 as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur6 = $currentsweeks[0]['orderid']; $Totalordersumeur6 = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp6 = $currentsweeks[0]['orderid'];  $Totalordersumegbp6 = $currentsweeks[0]['ordervalues'];} ?>
            <?php $TotalNumb6 = $Totalnumbsumeur6+$Totalnumbsumegbp6; $TotalOrder6 = $Totalordersumeur6+$Totalordersumegbp6;  } ?>
            <?php endforeach; ?>
         
			<?php if($a!==$b){ echo "<tr><td colspan='20'><div class='accordion sale-by-category'><table class='table-responsive category'><tr><td class='width10'><table class='table-responsive table-bordered'><tr><td class='width10'>".$b."</td></tr></table></td><td class='width60'><table class='table-responsive table-bordered'><tr>"; ?>
			<?php echo "<td width='100px'>". $TotalNumb ."</td><td width='100px'>" .  round($TotalOrder,2) . "</td>"; ?>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb1 ."</td><td width='100px'>" .  round($TotalOrder1,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb2 ."</td><td width='100px'>" .  round($TotalOrder2,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb3 ."</td><td width='100px'>" .  round($TotalOrder3,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb4 ."</td><td width='100px'>" .  round($TotalOrder4,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb5 ."</td><td width='100px'>" .  round($TotalOrder5,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb6 ."</td><td width='100px'>" .  round($TotalOrder6,2) . "</td>"; ?>
			<?php } ?>
					
		<?php echo "</tr></table><td width='100px'><table class='table-responsive table-bordered'><tr><td class='width10'>Total No of Order</td><td class='width10'>Total No of values</td></tr></table></tr></table></div>";} ?>
        <?php if($a!==$b) {  ?><div class='catpanel'>
		
        <div class="rTableHeading"><div class="rTableHead"><?php __('Sales Platform');?></div>
                            <div class="rTableHead"><?php __('Sales Channel');?></div>
							<?php   for($i=1; $i<=$month_interval; $i++){ ?>								 
                            <div class="rTableHead"><?php __('No. of Orders');?></div>
                            <div class="rTableHead"><?php __('Order value'); ?></div>                                   
                            <?php } ?> 
							<div class="rTableHead"><?php __('Total No of Order');?></div>
                            <div class="rTableHead"><?php __('Total Order value'); ?></div>  
        </div><?php } ?> 
         <?php $a = $b; ?>
           <div class="rTableRow"><div class="rTableCell"><?php echo $value['ProcessedListing']['plateform']; ?></div>
           <div class="rTableCell"><?php echo $value['ProcessedListing']['subsource']; ?></div>                             
			
			<?php $currentnumeur = array(); $currentvalueeur = array(); $currentcurreur = array(); ?>
            <?php  $currentnumgbp = array(); $currentvaluegbp = array(); $currentcurrgbp = array(); ?>
            <?php foreach ($countselectdated as $currentweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks['ProcessedListing']['currency']==='EUR'){$currentnumeur[] = $currentweeks[0]['orderid']; $currentvalueeur[] = $currentweeks[0]['ordervalues']; $currentcurreur[] = $currentweeks['ProcessedListing']['currency'];} else if($currentweeks['ProcessedListing']['currency']==='GBP'){ $currentnumgbp[] = $currentweeks[0]['orderid']; $currentvaluegbp[] = $currentweeks[0]['ordervalues']; $currentcurrgbp[] = $currentweeks['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
           <?php endforeach; ?>							 
			
               
            <?php if((!empty($currentnumeur[0])) && ($currentcurreur[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur[0] ."</div>";} else if((!empty($currentnumgbp[0])) && ($currentcurrgbp[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur[0])) && ($currentcurreur[0]==='EUR')){ $currvaluemain = $currentvalueeur[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain,2) ."</div>"; } else if((!empty($currentvaluegbp[0])) && ($currentcurrgbp[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
             
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur1 = array(); $currentvalueeur1 = array(); $currentcurreur1 = array(); ?>
            <?php  $currentnumgbp1 = array(); $currentvaluegbp1 = array(); $currentcurrgbp1 = array(); ?>
            <?php foreach ($countselectdates1 as $currentweeksone): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeksone['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeksone['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeksone['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeksone['ProcessedListing']['currency']==='EUR'){$currentnumeur1[] = $currentweeksone[0]['orderid']; $currentvalueeur1[] = $currentweeksone[0]['ordervalues']; $currentcurreur1[] = $currentweeksone['ProcessedListing']['currency'];} else if($currentweeksone['ProcessedListing']['currency']==='GBP'){ $currentnumgbp1[] = $currentweeksone[0]['orderid']; $currentvaluegbp1[] = $currentweeksone[0]['ordervalues']; $currentcurrgbp1[] = $currentweeksone['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur1[0])) && ($currentcurreur1[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur1[0] ."</div>";} else if((!empty($currentnumgbp1[0])) && ($currentcurrgbp1[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp1[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur1[0])) && ($currentcurreur1[0]==='EUR')){ $currvaluemain1 = $currentvalueeur1[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain1,2) ."</div>"; } else if((!empty($currentvaluegbp1[0])) && ($currentcurrgbp1[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp1[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeurtwo = array(); $currentvalueeurtwo = array(); $currentcurreurtwo = array(); ?>
            <?php  $currentnumgbptwo = array(); $currentvaluegbptwo = array(); $currentcurrgbptwo = array(); ?>
            <?php foreach ($countselectdates2 as $currentweekstwo): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweekstwo['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweekstwo['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweekstwo['ProcessedListing']['plateform'])) {?>
            <?php if($currentweekstwo['ProcessedListing']['currency']==='EUR'){$currentnumeurtwo[] = $currentweekstwo[0]['orderid']; $currentvalueeurtwo[] = $currentweekstwo[0]['ordervalues']; $currentcurreurtwo[] = $currentweekstwo['ProcessedListing']['currency'];} else if($currentweekstwo['ProcessedListing']['currency']==='GBP'){ $currentnumgbptwo[] = $currentweekstwo[0]['orderid']; $currentvaluegbptwo[] = $currentweekstwo[0]['ordervalues']; $currentcurrgbptwo[] = $currentweekstwo['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurtwo[0] ."</div>";} else if((!empty($currentnumgbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbptwo[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ $currvaluemaintwo = $currentvalueeurtwo[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemaintwo,2) ."</div>"; } else if((!empty($currentvaluegbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbptwo[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeurthree = array(); $currentvalueeurthree = array(); $currentcurreurthree = array(); ?>
            <?php  $currentnumgbpthree = array(); $currentvaluegbpthree = array(); $currentcurrgbpthree = array(); ?>
            <?php foreach ($countselectdates3 as $currentweeksthree): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeksthree['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeksthree['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeksthree['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeksthree['ProcessedListing']['currency']==='EUR'){$currentnumeurthree[] = $currentweeksthree[0]['orderid']; $currentvalueeurthree[] = $currentweeksthree[0]['ordervalues']; $currentcurreurthree[] = $currentweeksthree['ProcessedListing']['currency'];} else if($currentweeksthree['ProcessedListing']['currency']==='GBP'){ $currentnumgbpthree[] = $currentweeksthree[0]['orderid']; $currentvaluegbpthree[] = $currentweeksthree[0]['ordervalues']; $currentcurrgbpthree[] = $currentweeksthree['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeurthree[0])) && ($currentcurreurthree[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurthree[0] ."</div>";} else if((!empty($currentnumgbpthree[0])) && ($currentcurrgbpthree[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpthree[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurthree[0])) && ($currentcurreurthree[0]==='EUR')){ $currvaluemainthree = $currentvalueeurthree[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemainthree,2) ."</div>"; } else if((!empty($currentvaluegbpthree[0])) && ($currentcurrgbpthree[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpthree[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>	
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur4 = array(); $currentvalueeur4 = array(); $currentcurreur4 = array(); ?>
            <?php  $currentnumgbp4 = array(); $currentvaluegbp4 = array(); $currentcurrgbp4 = array(); ?>
            <?php foreach ($countselectdates4 as $currentweeks4): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks4['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks4['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks4['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks4['ProcessedListing']['currency']==='EUR'){$currentnumeur4[] = $currentweeks4[0]['orderid']; $currentvalueeur4[] = $currentweeks4[0]['ordervalues']; $currentcurreur4[] = $currentweeks4['ProcessedListing']['currency'];} else if($currentweeks4['ProcessedListing']['currency']==='GBP'){ $currentnumgbp4[] = $currentweeks4[0]['orderid']; $currentvaluegbp4[] = $currentweeks4[0]['ordervalues']; $currentcurrgbp4[] = $currentweeks4['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur4[0])) && ($currentcurreur4[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur4[0] ."</div>";} else if((!empty($currentnumgbp4[0])) && ($currentcurrgbp4[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp4[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur4[0])) && ($currentcurreur4[0]==='EUR')){ $currvaluemain4 = $currentvalueeur4[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain4,2) ."</div>"; } else if((!empty($currentvaluegbp4[0])) && ($currentcurrgbp4[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp4[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
				
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur5 = array(); $currentvalueeur5 = array(); $currentcurreur5 = array(); ?>
            <?php  $currentnumgbp5 = array(); $currentvaluegbp5 = array(); $currentcurrgbp5 = array(); ?>
            <?php foreach ($countselectdates5 as $currentweeks5): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks5['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks5['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks5['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks5['ProcessedListing']['currency']==='EUR'){$currentnumeur5[] = $currentweeks5[0]['orderid']; $currentvalueeur5[] = $currentweeks5[0]['ordervalues']; $currentcurreur5[] = $currentweeks5['ProcessedListing']['currency'];} else if($currentweeks5['ProcessedListing']['currency']==='GBP'){ $currentnumgbp5[] = $currentweeks5[0]['orderid']; $currentvaluegbp5[] = $currentweeks5[0]['ordervalues']; $currentcurrgbp5[] = $currentweeks5['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur5[0])) && ($currentcurreur5[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur5[0] ."</div>";} else if((!empty($currentnumgbp5[0])) && ($currentcurrgbp5[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp5[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur5[0])) && ($currentcurreur5[0]==='EUR')){ $currvaluemain5 = $currentvalueeur5[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain5,2) ."</div>"; } else if((!empty($currentvaluegbp5[0])) && ($currentcurrgbp5[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp5[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur6 = array(); $currentvalueeur6 = array(); $currentcurreur6 = array(); ?>
            <?php  $currentnumgbp6 = array(); $currentvaluegbp6 = array(); $currentcurrgbp6 = array(); ?>
            <?php foreach ($countselectdates6 as $currentweeks6): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks6['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks6['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks6['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks6['ProcessedListing']['currency']==='EUR'){$currentnumeur6[] = $currentweeks6[0]['orderid']; $currentvalueeur6[] = $currentweeks6[0]['ordervalues']; $currentcurreur6[] = $currentweeks6['ProcessedListing']['currency'];} else if($currentweeks6['ProcessedListing']['currency']==='GBP'){ $currentnumgbp6[] = $currentweeks6[0]['orderid']; $currentvaluegbp6[] = $currentweeks6[0]['ordervalues']; $currentcurrgbp6[] = $currentweeks6['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur6[0])) && ($currentcurreur6[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur6[0] ."</div>";} else if((!empty($currentnumgbp6[0])) && ($currentcurrgbp6[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp6[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur6[0])) && ($currentcurreur6[0]==='EUR')){ $currvaluemain6 = $currentvalueeur6[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain6,2) ."</div>"; } else if((!empty($currentvaluegbp6[0])) && ($currentcurrgbp6[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp6[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur7 = array(); $currentvalueeur7 = array(); $currentcurreur7 = array(); ?>
            <?php  $currentnumgbp7 = array(); $currentvaluegbp7 = array(); $currentcurrgbp7 = array(); ?>
            <?php foreach ($countselectdates7 as $currentweeks7): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks7['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks7['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks7['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks7['ProcessedListing']['currency']==='EUR'){$currentnumeur7[] = $currentweeks7[0]['orderid']; $currentvalueeur7[] = $currentweeks7[0]['ordervalues']; $currentcurreur7[] = $currentweeks7['ProcessedListing']['currency'];} else if($currentweeks7['ProcessedListing']['currency']==='GBP'){ $currentnumgbp7[] = $currentweeks7[0]['orderid']; $currentvaluegbp7[] = $currentweeks7[0]['ordervalues']; $currentcurrgbp7[] = $currentweeks7['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur7[0])) && ($currentcurreur7[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur7[0] ."</div>";} else if((!empty($currentnumgbp7[0])) && ($currentcurrgbp7[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp7[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur7[0])) && ($currentcurreur7[0]==='EUR')){ $currvaluemain7 = $currentvalueeur7[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain7,2) ."</div>"; } else if((!empty($currentvaluegbp7[0])) && ($currentcurrgbp7[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp7[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur8 = array(); $currentvalueeur8 = array(); $currentcurreur8 = array(); ?>
            <?php  $currentnumgbp8 = array(); $currentvaluegbp8 = array(); $currentcurrgbp8 = array(); ?>
            <?php foreach ($countselectdates8 as $currentweeks8): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks8['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks8['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks8['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks8['ProcessedListing']['currency']==='EUR'){$currentnumeur8[] = $currentweeks8[0]['orderid']; $currentvalueeur7[] = $currentweeks8[0]['ordervalues']; $currentcurreur8[] = $currentweeks8['ProcessedListing']['currency'];} else if($currentweeks8['ProcessedListing']['currency']==='GBP'){ $currentnumgbp8[] = $currentweeks8[0]['orderid']; $currentvaluegbp8[] = $currentweeks8[0]['ordervalues']; $currentcurrgbp8[] = $currentweeks8['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur8[0])) && ($currentcurreur8[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur8[0] ."</div>";} else if((!empty($currentnumgbp8[0])) && ($currentcurrgbp8[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp8[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur8[0])) && ($currentcurreur8[0]==='EUR')){ $currvaluemain8 = $currentvalueeur8[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain8,2) ."</div>"; } else if((!empty($currentvaluegbp8[0])) && ($currentcurrgbp8[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp8[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur9 = array(); $currentvalueeur9 = array(); $currentcurreur9 = array(); ?>
            <?php  $currentnumgbp9 = array(); $currentvaluegbp9 = array(); $currentcurrgbp9 = array(); ?>
            <?php foreach ($countselectdates9 as $currentweeks9): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks9['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks9['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks9['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks9['ProcessedListing']['currency']==='EUR'){$currentnumeur9[] = $currentweeks9[0]['orderid']; $currentvalueeur9[] = $currentweeks9[0]['ordervalues']; $currentcurreur9[] = $currentweeks9['ProcessedListing']['currency'];} else if($currentweeks9['ProcessedListing']['currency']==='GBP'){ $currentnumgbp9[] = $currentweeks9[0]['orderid']; $currentvaluegbp9[] = $currentweeks9[0]['ordervalues']; $currentcurrgbp9[] = $currentweeks9['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeur9[0])) && ($currentcurreur9[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur9[0] ."</div>";} else if((!empty($currentnumgbp9[0])) && ($currentcurrgbp9[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp9[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur9[0])) && ($currentcurreur9[0]==='EUR')){ $currvaluemain9 = $currentvalueeur9[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain9,2) ."</div>"; } else if((!empty($currentvaluegbp9[0])) && ($currentcurrgbp9[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp9[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>			
			
        </div>       
         <?php if($a!==$b) { echo "</div><td></tr>";} ?>
         <?php endforeach; ?>   
    </table>
 </div>
<script type="text/javascript">
$.noConflict();  //Not to conflict with other scripts
jQuery(document).ready(function($) {
$("#date_from").datepicker({
    minDate: '-1Y-0M',
	numberOfMonths: 2,
    maxDate: '0',
    onSelect: function (dateStr) {
        var min = $(this).datepicker('getDate'); // Get selected date
        $("#date_to").datepicker('option', 'minDate', min || '+1Y+6M'); // Set other min, default to today
    }
});

$("#date_to").datepicker({
numberOfMonths: 2,
    minDate: '-1Y-0M',
    maxDate: '0',
    onSelect: function (dateStr) {
        var max = $(this).datepicker('getDate'); // Get selected date
        $('#datepicker').datepicker('option', 'maxDate', max || '0'); // Set other max, default to +1 months
        var start = $("#date_from").datepicker("getDate");
        var end = $("#date_to").datepicker("getDate");
        var days = ((end - start) / (1000 * 60 * 60 * 24)/29);
		    var months = days.toFixed(0)
        $("#number_period").val(months);
    }
	});       
});
</script>
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