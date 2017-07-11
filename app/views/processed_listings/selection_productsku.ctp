<hr>
<?php // print_r($Catsaveall); die(); ?>
  <h1 class="sub-header"><?php __('Sales Products SKU Dates or Periods Selection Orders Reports');?></h1>
  <div class="panel panel-default" >
    <?php  echo $form->create('ProcessedListing',array('action'=>'selection_productsku')); ?>
    <div class="panel-body" ng-app="">
      <div class="row">
	    <div class="col-md-12 mobile-bottomspace">
		<div class="col-md-1"></div> 
         <div class="col-md-6">             
              <ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category name: <span class="caret"></span></a>
               <?php // $Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                   <?php foreach ($categories as $Catna): ?>    
                     <li><a href="<?php echo  $actual_link ; ?>/processed_listings/selection_productsku/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>         
        </div>
		 <div class="col-md-4">
         <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php echo $this->Form->input('productname',array('label'=>'','placeholder'=>'Search Product SKU...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>		
		</div> 
	</div>
	<hr>
	<div class="row">
        <div class="col-md-12 mobile-bottomspace">
            <div class="col-md-2"><b>Date Selection</b></div><div class="col-md-1">From</div><div class="col-md-2"><?php echo $this->Form->input('date_from',array('label'=>false,'div'=>false,'id'=>'date_from','class'=>'form-control'))?></div><div class="col-md-1">TO</div><div class="col-md-2"><?php echo $this->Form->input('date_to',array('label'=>false,'div'=>false,'id'=>'date_to','class'=>'form-control'))?></div><div class="col-md-5 input-group-btn"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
         </div>          
      </div>   
       <hr>
       <div class="row">
        <div class="col-md-12 mobile-bottomspace"><?php $option = array($month_interval =>'Months'); ?>
        <div class="col-md-3"><b>Period Selection</b></div><div class="col-md-3"><?php  echo $this->Form->input('selected_period', array('label'=>false,'options' => $option ,'checked' =>'checked' ,'legend' => false,'div'=>false, 'type' => 'radio'));?></div>
		<div class="col-md-3"><b>Number of Periods.</b></div><div class="col-md-3"><?php echo  $this->Form->input('number_period',array('label'=>false,'div'=>false,'value' =>$month_interval,'id'=>'number_period','class'=>'form-control')); ?></div>
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
			<td width="100px"><strong><?php __('Total No of Order'); ?></strong></td>
			<td width="100px"><strong><?php __('Total Order vlues'); ?></strong></td></tr>
			<?php    $a = '0'; foreach ($countselectdates as $value): ?>  
			<?php $b = $value['ProcessedListing']['product_sku']; ?>
			
			<?php $Totalnumbsumeur = array(); $Totalnumbsumegbp = array();  $Totalordersumeur = array();  $Totalordersumegbp = array(); ?>
		    <?php foreach ($Catsaveall as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur[] = $currentsweeks[0]['orderid']; $Totalordersumeur[] = $currentsweeks[0]['ordervalues']*0.84;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp[] = $currentsweeks[0]['orderid'];  $Totalordersumegbp[] = $currentsweeks[0]['ordervalues'];} ?>
           <?php } ?>
		   <?php endforeach; ?> 		   
		   <?php $TotalNumb = $Totalnumbsumeur[0]+$Totalnumbsumegbp[0]; $TotalOrder = $Totalordersumeur[0]+$Totalordersumegbp[0]; ?>
           
		   <?php $Totalnumbsumeur1 = array(); $Totalnumbsumegbp1 = array();  $Totalordersumeur1 = array();  $Totalordersumegbp1 = array(); ?>
		    <?php foreach ($Catsaveall1 as $currentweek1): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweek1['ProcessedListing']['cat_name'])) {?>
			<?php if($currentweek1['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur1[] = $currentweek1[0]['orderid']; $Totalordersumeur1[] = $currentweek1[0]['ordervalues']*0.84;}else if($currentweek1['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp1[] = $currentweek1[0]['orderid'];  $Totalordersumegbp1[] = $currentweek1[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb1 = $Totalnumbsumeur1[0]+$Totalnumbsumegbp1[0]; $TotalOrder1 = $Totalordersumeur1[0]+$Totalordersumegbp1[0];  ?>
			
			
		   <?php $Totalnumbsumeur2 = array(); $Totalnumbsumegbp2 = array();  $Totalordersumeur2 = array();  $Totalordersumegbp2 = array(); ?>
		    <?php foreach ($Catsaveall2 as $currentsweeks2): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks2['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks2['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur2[] = $currentsweeks2[0]['orderid']; $Totalordersumeur2[] = $currentsweeks2[0]['ordervalues']*0.84;}else if($currentsweeks2['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp2[] = $currentsweeks2[0]['orderid'];  $Totalordersumegbp2[] = $currentsweeks2[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb2 = $Totalnumbsumeur2[0]+$Totalnumbsumegbp2[0]; $TotalOrder2 = $Totalordersumeur2[0]+$Totalordersumegbp2[0];  ?>
			
			<?php $Totalnumbsumeur3 = array(); $Totalnumbsumegbp3 = array();  $Totalordersumeur3 = array();  $Totalordersumegbp3 = array(); ?>
			<?php foreach ($Catsaveall3 as $currentsweek3): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek3['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek3['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur3[] = $currentsweek3[0]['orderid']; $Totalordersumeur3[] = $currentsweek3[0]['ordervalues']*0.84;}else if($currentsweek3['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp3[] = $currentsweek3[0]['orderid'];  $Totalordersumegbp3[] = $currentsweek3[0]['ordervalues'];} ?>
            <?php } ?>
            <?php endforeach; ?>			
			<?php  $TotalNumb3 = $Totalnumbsumeur3[0]+$Totalnumbsumegbp3[0]; $TotalOrder3 = $Totalordersumeur3[0]+$Totalordersumegbp3[0];  ?>
			
			<?php $Totalnumbsumeur4 = array(); $Totalnumbsumegbp4 = array();  $Totalordersumeur4 = array();  $Totalordersumeur4 = array(); ?>
			<?php foreach ($Catsaveall4 as $currentsweeks4): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks4['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks4['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur4[] = $currentsweeks4[0]['orderid']; $Totalordersumeur4[] = $currentsweeks4[0]['ordervalues']*0.84;}else if($currentsweeks4['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp4[] = $currentsweeks4[0]['orderid'];  $Totalordersumegbp4[] = $currentsweeks4[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb4 = $Totalnumbsumeur4[0]+$Totalnumbsumegbp4[0]; $TotalOrder4 = $Totalordersumeur4[0]+$Totalordersumegbp4[0];  ?>
			
			<?php $Totalnumbsumeur5 = array(); $Totalnumbsumegbp5 = array();  $Totalordersumeur5 = array();  $Totalordersumegbp5 = array(); ?>
			<?php foreach ($Catsaveall5 as $currentsweeks5): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks5['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks5['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur5[] = $currentsweeks5[0]['orderid']; $Totalordersumeur5[] = $currentsweeks5[0]['ordervalues']*0.84;}else if($currentsweeks5['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp5[] = $currentsweeks5[0]['orderid'];  $Totalordersumegbp5[] = $currentsweeks5[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>			
			<?php $TotalNumb5 = $Totalnumbsumeur5[0]+$Totalnumbsumegbp5[0]; $TotalOrder5 = $Totalordersumeur5[0]+$Totalordersumegbp5[0]; ?>
			
			<?php $Totalnumbsumeur6 = array(); $Totalnumbsumegbp6 = array();  $Totalordersumeur6 = array();  $Totalordersumegbp6 = array(); ?>
			<?php foreach ($Catsaveall6 as $currentsweek6): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek6['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek6['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur6[] = $currentsweek6[0]['orderid']; $Totalordersumeur6[] = $currentsweek6[0]['ordervalues']*0.84;}else if($currentsweek6['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp6[] = $currentsweek6[0]['orderid'];  $Totalordersumegbp6[] = $currentsweek6[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb6 = $Totalnumbsumeur6[0]+$Totalnumbsumegbp6[0]; $TotalOrder6 = $Totalordersumeur6[0]+$Totalordersumegbp6[0]; ?>
			
			<?php $Totalnumbsumeur7 = array(); $Totalnumbsumegbp7 = array();  $Totalordersumeur7 = array();  $Totalordersumegbp7 = array(); ?>
			<?php foreach ($Catsaveall7 as $currentsweek7): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek7['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek7['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur7[] = $currentsweek7[0]['orderid']; $Totalordersumeur7[] = $currentsweek7[0]['ordervalues']*0.84;}else if($currentsweek7['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp7[] = $currentsweek7[0]['orderid'];  $Totalordersumegbp7[] = $currentsweek7[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>			
			<?php $TotalNumb7 = $Totalnumbsumeur7[0]+$Totalnumbsumegbp7[0]; $TotalOrder7 = $Totalordersumeur7[0]+$Totalordersumegbp7[0];  ?>
			
			<?php $Totalnumbsumeur8 = array(); $Totalnumbsumegbp8 = array();  $Totalordersumeur8 = array();  $Totalordersumegbp8 = array(); ?>
			<?php foreach ($Catsaveall8 as $currentsweek8): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek8['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek8['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur8[] = $currentsweek8[0]['orderid']; $Totalordersumeur8[] = $currentsweek8[0]['ordervalues']*0.84;}else if($currentsweek8['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp8[] = $currentsweek8[0]['orderid'];  $Totalordersumegbp8[] = $currentsweek8[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb8 = $Totalnumbsumeur8[0]+$Totalnumbsumegbp8[0]; $TotalOrder8 = $Totalordersumeur8[0]+$Totalordersumegbp8[0];?>
         
			<?php $Totalnumbsumeur9 = array(); $Totalnumbsumegbp9 = array();  $Totalordersumeur9 = array();  $Totalordersumegbp9 = array(); ?>
			<?php foreach ($Catsaveall9 as $currentsweek9): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek9['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek9['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur9[] = $currentsweek9[0]['orderid']; $Totalordersumeur9[] = $currentsweek9[0]['ordervalues']*0.84;}else if($currentsweek9['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp9[] = $currentsweek9[0]['orderid'];  $Totalordersumegbp9[] = $currentsweek9[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb9 = $Totalnumbsumeur9[0]+$Totalnumbsumegbp9[0]; $TotalOrder9 = $Totalordersumeur9[0]+$Totalordersumegbp9[0];?>
         
		 	<?php $Totalnumbsumeur10 = array(); $Totalnumbsumegbp10 = array();  $Totalordersumeur10 = array();  $Totalordersumegbp10 = array(); ?>
			<?php foreach ($Catsaveall10 as $currentsweek10): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek10['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek10['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur10[] = $currentsweek10[0]['orderid']; $Totalordersumeur10[] = $currentsweek10[0]['ordervalues']*0.84;}else if($currentsweek10['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp10 = $currentsweek10[0]['orderid'];  $Totalordersumegbp10[] = $currentsweek10[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb10 = $Totalnumbsumeur10[0]+$Totalnumbsumegbp10[0]; $TotalOrder10 = $Totalordersumeur10[0]+$Totalordersumegbp10[0];?>

			<?php $Totalnumbsumeur11 = array(); $Totalnumbsumegbp11 = array();  $Totalordersumeur10 = array();  $Totalordersumegbp10 = array(); ?>
			<?php foreach ($Catsaveall11 as $currentsweek11): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek11['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek11['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur11[] = $currentsweek11[0]['orderid']; $Totalordersumeur11[] = $currentsweek11[0]['ordervalues']*0.84;}else if($currentsweek11['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp11 = $currentsweek11[0]['orderid'];  $Totalordersumegbp11[] = $currentsweek11[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb11 = $Totalnumbsumeur11[0]+$Totalnumbsumegbp11[0]; $TotalOrder11 = $Totalordersumeur11[0]+$Totalordersumegbp11[0];?>
         					
				
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
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb7 ."</td><td width='100px'>" .  round($TotalOrder7,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb8 ."</td><td width='100px'>" .  round($TotalOrder8,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb9 ."</td><td width='100px'>" .  round($TotalOrder9,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb10 ."</td><td width='100px'>" .  round($TotalOrder10,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='12'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb11 ."</td><td width='100px'>" .  round($TotalOrder11,2) . "</td>"; ?>
			<?php } ?>
					
					
		<?php echo "</tr></table><td width='100px'><table class='table-responsive table-bordered'><tr><td class='width10'>"; ?>
		
		<?php if((!empty($month_interval)) && ($month_interval=='2')){ ?>
		<?php $sums1 = $TotalNumb+$TotalNumb1; echo $sums1; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='3')){ ?>
		<?php  $sums2 = $TotalNumb+$TotalNumb1+$TotalNumb2; echo $sums2; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='4')){ ?>
		<?php  $sums3 = $TotalNumb+$TotalNumb1+$TotalNumb2+$TotalNumb3; echo $sums3; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='5')){ ?>
		<?php  $sums4 = $TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums4; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='6')){ ?>
		<?php  $sums5 = $TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums5; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='7')){ ?>
		<?php  $sums6 = $TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums6; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='8')){ ?>
		<?php  $sums7 = $TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums7; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='9')){ ?>
		<?php  $sums8 = $TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums8; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='10')){ ?>
		<?php  $sums9 = $TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums9; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='11')){ ?>
		<?php  $sums10 = $TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums10; ?>
		<?php } else { echo  $TotalNumb; } ?> 
		
		
		<?php echo "</td><td class='width10'>"; ?>
		
		<?php if((!empty($month_interval)) && ($month_interval=='2')){ ?>
		<?php $toorder1 = $TotalOrder+$TotalOrder1; echo round($toorder1,2);?>		
		<?php } else if((!empty($month_interval)) && ($month_interval=='3')){ ?>
		<?php $toorder2 = $TotalOrder+$TotalOrder1+$TotalOrder2; echo round($toorder2,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='4')){ ?>
		<?php $toorder3 = $TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder3,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='5')){ ?>
		<?php $toorder4 = $TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder4,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='6')){ ?>
		<?php $toorder5 = $TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder5,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='7')){ ?>
		<?php $toorder6 = $TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder6,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='8')){ ?>
		<?php $toorder7 = $TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder7,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='9')){ ?>
		<?php $toorder8 = $TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder8,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='10')){ ?>
		<?php $toorder9 = $TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder9,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='11')){ ?>
		<?php $toorder10 = $TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder10,2);?>
		<?php } else { echo round($TotalOrder,2);} ?>	
				
		
		<?php echo "</td></tr></table></tr></table></div>";} ?>
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
            <?php $currentnumgbp = array(); $currentvaluegbp = array(); $currentcurrgbp = array(); ?>
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
			
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php $currentnumeur10 = array(); $currentvalueeur10 = array(); $currentcurreur10 = array(); ?>
            <?php  $currentnumgbp10 = array(); $currentvaluegbp10 = array(); $currentcurrgbp10 = array(); ?>
            <?php foreach ($countselectdates10 as $currentweeks10): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks10['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks10['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks10['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks10['ProcessedListing']['currency']==='EUR'){$currentnumeur10[] = $currentweeks10[0]['orderid']; $currentvalueeur10[] = $currentweeks10[0]['ordervalues']; $currentcurreur10[] = $currentweeks10['ProcessedListing']['currency'];} else if($currentweeks10['ProcessedListing']['currency']==='GBP'){ $currentnumgbp10[] = $currentweeks10[0]['orderid']; $currentvaluegbp10[] = $currentweeks10[0]['ordervalues']; $currentcurrgbp10[] = $currentweeks10['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeur10[0])) && ($currentcurreur10[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur10[0] ."</div>";} else if((!empty($currentnumgbp10[0])) && ($currentcurrgbp10[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp10[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur10[0])) && ($currentcurreur10[0]==='EUR')){ $currvaluemain10 = $currentvalueeur10[0]*0.84;  echo "<div class='rTableCell'>". round($currvaluemain10,2) ."</div>"; } else if((!empty($currentvaluegbp10[0])) && ($currentcurrgbp10[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp10[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>			
				
			<?php if((!empty($month_interval)) && ($month_interval=='2')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php } else if((!empty($month_interval)) && ($month_interval=='3')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		 <?php } else if((!empty($month_interval)) && ($month_interval=='4')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='5')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
			<?php } else if((!empty($month_interval)) && ($month_interval=='6')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='7')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='8')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='9')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='10')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='11')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else { ?>
			<?php if($currentcurreur[0]==='EUR'){ echo "<div class='rTableCell'>".round($currentnumeur[0],2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){echo "<div class='rTableCell'>".round($currentnumgbp[0],2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ echo "<div class='rTableCell'>".round($currentvalueeur[0]*0.84,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){echo "<div class='rTableCell'>".round($pordervaluegbp[0],2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
           <?php } ?>
		 </div>       
         <?php if($a!==$b) { echo "</div><td></tr>";} ?>
         <?php endforeach; ?>   
    </table>
</div>
  <hr>
 <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
 <nav>
     <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
     </ul>
 </nav>
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