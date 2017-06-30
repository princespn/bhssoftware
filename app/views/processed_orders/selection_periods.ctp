<hr>
<?php //print_r($query_date); ?>
  <h1 class="sub-header"><?php __('Sales Dates or Periods Selection Orders Reports');?></h1>
  <div class="panel panel-default" >
    <?php  echo $form->create('ProcessedOrder',array('action'=>'selection_periods')); ?>
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
   <table id="header-fixed" class="table table-bordered table-striped table-hover"></table>
    <table id="table-1" class="table table-bordered table-striped table-hover">	    
         <thead><tr><th><strong><?php __('Sales Platform');?></strong></th><th><strong><?php __('Sales Channel');?></strong></th><th><strong><?php __('Currency');?></strong></th><?php $i = 0; $len = count($query_date); foreach($query_date as $firstandlast){  $yrdata = strtotime($firstandlast);   if ($i == $len - 1){ }else {?><th colspan="2"><strong><?php echo date('M-Y', $yrdata); $i++; ?></strong></th><?php } ?><?php } ?><th><strong><?php __('Total');?></strong></th><th><strong><?php __('Total');?></strong></th></tr>
        <tr><th colspan="3"></th><?php  for($i=1; $i<=$month_interval; $i++){ ?><th><strong><?php __('No of Orders');?></strong></th><th><strong><?php __('Orders value');?></strong></td><?php } ?><td><strong><?php __('No of Orders ');?></strong></th><th><strong><?php __('Order values ');?></th></tr></thead>
          <?php foreach ($saveplatformdatas as $value): ?>
            <tr> 
             <td><?php if(!empty($value['ProcessedOrder']['plateform'])){ echo $value['ProcessedOrder']['plateform']; }else {echo "-";}; ?></td>
             <td><?php if(!empty($value['ProcessedOrder']['subsource'])){ echo $value['ProcessedOrder']['subsource']; }else {echo "-";}; ?></td>
             <td><?php if(!empty($value['ProcessedOrder']['currency'])){ echo $value['ProcessedOrder']['currency']; }else {echo "-";}; ?></td>
                           
                      
            <?php $pordernumeur = array(); $pordervalueeur = array(); $pordercurreur = array(); ?>
            <?php $pordernumgbp = array(); $pordervaluegbp = array(); $pordercurregbp = array(); ?>
            <?php foreach ($countselectdates as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur[] = $previousweeks[0]['orderid']; $pordervalueeur[] = $previousweeks[0]['ordervalues']; $pordercurreur[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp[] = $previousweeks[0]['orderid']; $pordervaluegbp[] = $previousweeks[0]['ordervalues']; $pordercurregbp[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur += $previousweeks[0]['orderid']; $Totalordersumeur+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp += $previousweeks[0]['orderid'];  $Totalordersumegbp+= $previousweeks[0]['ordervalues'];} ?>
                    
			<?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur[0]==='EUR'){ echo round($pordernumeur[0],2); } else if ($pordercurregbp[0]==='GBP'){echo round($pordernumgbp[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ echo round($pordervalueeur[0],2); } else if ($pordercurregbp[0]==='GBP'){echo round($pordervaluegbp[0],2); } else {echo "-";}?></td>
                
			
				
            <?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			  
			<?php $pordernumeur1 = array(); $pordervalueeur1 = array(); $pordercurreur1 = array(); ?>
            <?php $pordernumgbp1 = array(); $pordervaluegbp1 = array(); $pordercurregbp1 = array(); ?>
            <?php foreach ($countselectdates1 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur1[] = $previousweeks[0]['orderid']; $pordervalueeur1[] = $previousweeks[0]['ordervalues']; $pordercurreur1[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp1[] = $previousweeks[0]['orderid']; $pordervaluegbp1[] = $previousweeks[0]['ordervalues']; $pordercurregbp1[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
              <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur1 += $previousweeks[0]['orderid']; $Totalordersumeur1+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp1 += $previousweeks[0]['orderid'];  $Totalordersumegbp1+= $previousweeks[0]['ordervalues'];} ?>
           
			 <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur1[0]==='EUR'){ echo round($pordernumeur1[0],2); } else if ($pordercurregbp1[0]==='GBP'){echo round($pordernumgbp1[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur1[0]==='EUR'){ echo round($pordervalueeur1[0],2); } else if ($pordercurregbp1[0]==='GBP'){echo round($pordervaluegbp1[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>			 
						 
			
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			  
			<?php $pordernumeur2 = array(); $pordervalueeur2 = array(); $pordercurreur2 = array(); ?>
            <?php $pordernumgbp2 = array(); $pordervaluegbp2 = array(); $pordercurregbp2 = array(); ?>
            <?php foreach ($countselectdates2 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur2[] = $previousweeks[0]['orderid']; $pordervalueeur2[] = $previousweeks[0]['ordervalues']; $pordercurreur2[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp2[] = $previousweeks[0]['orderid']; $pordervaluegbp2[] = $previousweeks[0]['ordervalues']; $pordercurregbp2[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur2 += $previousweeks[0]['orderid']; $Totalordersumeur2+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp2 += $previousweeks[0]['orderid'];  $Totalordersumegbp2+= $previousweeks[0]['ordervalues'];} ?>
           
			 <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur2[0]==='EUR'){ echo round($pordernumeur2[0],2); } else if ($pordercurregbp2[0]==='GBP'){echo round($pordernumgbp2[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur2[0]==='EUR'){ echo round($pordervalueeur2[0],2); } else if ($pordercurregbp2[0]==='GBP'){echo round($pordervaluegbp2[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			  
			<?php $pordernumeur3 = array(); $pordervalueeur3 = array(); $pordercurreur3 = array(); ?>
            <?php $pordernumgbp3 = array(); $pordervaluegbp3 = array(); $pordercurregbp3 = array(); ?>
            <?php foreach ($countselectdates3 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur3[] = $previousweeks[0]['orderid']; $pordervalueeur3[] = $previousweeks[0]['ordervalues']; $pordercurreur3[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp3[] = $previousweeks[0]['orderid']; $pordervaluegbp3[] = $previousweeks[0]['ordervalues']; $pordercurregbp3[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur3 += $previousweeks[0]['orderid']; $Totalordersumeur3+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp3 += $previousweeks[0]['orderid'];  $Totalordersumegbp3+= $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur3[0]==='EUR'){ echo round($pordernumeur3[0],2); } else if ($pordercurregbp3[0]==='GBP'){echo round($pordernumgbp3[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur3[0]==='EUR'){ echo round($pordervalueeur3[0],2); } else if ($pordercurregbp3[0]==='GBP'){echo round($pordervaluegbp3[0],2); } else {echo "-";}?></td>
              
			<?php  } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))) { ?>
			  
			<?php $pordernumeur4 = array(); $pordervalueeur4 = array(); $pordercurreur4 = array(); ?>
            <?php $pordernumgbp4 = array(); $pordervaluegbp4 = array(); $pordercurregbp4= array(); ?>
            <?php foreach ($countselectdates4 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur4[] = $previousweeks[0]['orderid']; $pordervalueeur4[] = $previousweeks[0]['ordervalues']; $pordercurreur4[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp4[] = $previousweeks[0]['orderid']; $pordervaluegbp4[] = $previousweeks[0]['ordervalues']; $pordercurregbp4[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur4 += $previousweeks[0]['orderid']; $Totalordersumeur4+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp4 += $previousweeks[0]['orderid'];  $Totalordersumegbp4+= $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur4[0]==='EUR'){ echo round($pordernumeur4[0],2); } else if ($pordercurregbp4[0]==='GBP'){echo round($pordernumgbp4[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur4[0]==='EUR'){ echo round($pordervalueeur4[0],2); } else if ($pordercurregbp4[0]==='GBP'){echo round($pordervaluegbp4[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>		
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			  
			<?php $pordernumeur5 = array(); $pordervalueeur5 = array(); $pordercurreur5 = array(); ?>
            <?php $pordernumgbp5 = array(); $pordervaluegbp5 = array(); $pordercurregbp5= array(); ?>
            <?php foreach ($countselectdates5 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur5[] = $previousweeks[0]['orderid']; $pordervalueeur5[] = $previousweeks[0]['ordervalues']; $pordercurreur5[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp5[] = $previousweeks[0]['orderid']; $pordervaluegbp5[] = $previousweeks[0]['ordervalues']; $pordercurregbp5[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur5 += $previousweeks[0]['orderid']; $Totalordersumeur5+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp5 += $previousweeks[0]['orderid'];  $Totalordersumegbp5+= $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur5[0]==='EUR'){ echo round($pordernumeur5[0],2); } else if ($pordercurregbp5[0]==='GBP'){echo round($pordernumgbp5[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur5[0]==='EUR'){ echo round($pordervalueeur5[0],2); } else if ($pordercurregbp5[0]==='GBP'){echo round($pordervaluegbp5[0],2); } else {echo "-";}?></td>
            <?php  } ?>
		
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			  
			<?php $pordernumeur6 = array(); $pordervalueeur6 = array(); $pordercurreur6 = array(); ?>
            <?php $pordernumgbp6 = array(); $pordervaluegbp6 = array(); $pordercurregbp6= array(); ?>
            <?php foreach ($countselectdates6 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur6[] = $previousweeks[0]['orderid']; $pordervalueeur6[] = $previousweeks[0]['ordervalues']; $pordercurreur6[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp6[] = $previousweeks[0]['orderid']; $pordervaluegbp6[] = $previousweeks[0]['ordervalues']; $pordercurregbp6[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur6 += $previousweeks[0]['orderid']; $Totalordersumeur6+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp6 += $previousweeks[0]['orderid'];  $Totalordersumegbp6+= $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur6[0]==='EUR'){ echo round($pordernumeur6[0],2); } else if ($pordercurregbp6[0]==='GBP'){echo round($pordernumgbp6[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur6[0]==='EUR'){ echo round($pordervalueeur6[0],2); } else if ($pordercurregbp6[0]==='GBP'){echo round($pordervaluegbp6[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){        ?>
			  
			<?php $pordernumeur7 = array(); $pordervalueeur7 = array(); $pordercurreur7 = array(); ?>
            <?php $pordernumgbp7 = array(); $pordervaluegbp7 = array(); $pordercurregbp7 = array(); ?>
            <?php foreach ($countselectdates7 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur7[] = $previousweeks[0]['orderid']; $pordervalueeur7[] = $previousweeks[0]['ordervalues']; $pordercurreur7[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp7[] = $previousweeks[0]['orderid']; $pordervaluegbp7[] = $previousweeks[0]['ordervalues']; $pordercurregbp7[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur7 += $previousweeks[0]['orderid']; $Totalordersumeur7+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp7 += $previousweeks[0]['orderid'];  $Totalordersumegbp7+= $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur7[0]==='EUR'){ echo round($pordernumeur7[0],2); } else if ($pordercurregbp7[0]==='GBP'){echo round($pordernumgbp7[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur7[0]==='EUR'){ echo round($pordervalueeur7[0],2); } else if ($pordercurregbp7[0]==='GBP'){echo round($pordervaluegbp7[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){  ?>
			  
			<?php $pordernumeur8 = array(); $pordervalueeur8 = array(); $pordercurreur8 = array(); ?>
            <?php $pordernumgbp8 = array(); $pordervaluegbp8 = array(); $pordercurregbp8 = array(); ?>
            <?php foreach ($countselectdates8 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur8[] = $previousweeks[0]['orderid']; $pordervalueeur8[] = $previousweeks[0]['ordervalues']; $pordercurreur8[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp8[] = $previousweeks[0]['orderid']; $pordervaluegbp8[] = $previousweeks[0]['ordervalues']; $pordercurregbp8[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur8 += $previousweeks[0]['orderid']; $Totalordersumeur8+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp8 += $previousweeks[0]['orderid'];  $Totalordersumegbp8 += $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur8[0]==='EUR'){ echo round($pordernumeur8[0],2); } else if ($pordercurregbp8[0]==='GBP'){echo round($pordernumgbp8[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur8[0]==='EUR'){ echo round($pordervalueeur8[0],2); } else if ($pordercurregbp8[0]==='GBP'){echo round($pordervaluegbp8[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){  ?>
			  
			<?php $pordernumeur9 = array(); $pordervalueeur9 = array(); $pordercurreur9 = array(); ?>
            <?php $pordernumgbp9 = array(); $pordervaluegbp9 = array(); $pordercurregbp9 = array(); ?>
            <?php foreach ($countselectdates9 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur9[] = $previousweeks[0]['orderid']; $pordervalueeur9[] = $previousweeks[0]['ordervalues']; $pordercurreur9[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp9[] = $previousweeks[0]['orderid']; $pordervaluegbp9[] = $previousweeks[0]['ordervalues']; $pordercurregbp9[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur9 += $previousweeks[0]['orderid']; $Totalordersumeur9+= $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp9 += $previousweeks[0]['orderid'];  $Totalordersumegbp9 += $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur9[0]==='EUR'){ echo round($pordernumeur9[0],2); } else if ($pordercurregbp9[0]==='GBP'){echo round($pordernumgbp9[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur9[0]==='EUR'){ echo round($pordervalueeur9[0],2); } else if ($pordercurregbp9[0]==='GBP'){echo round($pordervaluegbp9[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){  ?>
			  
			<?php $pordernumeur10 = array(); $pordervalueeur10 = array(); $pordercurreur10 = array(); ?>
            <?php $pordernumgbp10 = array(); $pordervaluegbp10 = array(); $pordercurregbp10 = array(); ?>
            <?php foreach ($countselectdates12 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur10[] = $previousweeks[0]['orderid']; $pordervalueeur10[] = $previousweeks[0]['ordervalues']; $pordercurreur10[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp10[] = $previousweeks[0]['orderid']; $pordervaluegbp10[] = $previousweeks[0]['ordervalues']; $pordercurregbp10[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur10 += $previousweeks[0]['orderid']; $Totalordersumeur10 += $previousweeks[0]['ordervalues']*0.84;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp10 += $previousweeks[0]['orderid'];  $Totalordersumegbp10 += $previousweeks[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php echo "sdgvfdg"; if($pordercurreur10[0]==='EUR'){ echo round($pordernumeur10[0],2); } else if ($pordercurregbp10[0]==='GBP'){echo round($pordernumgbp10[0],2); } else {echo "-";}?></td>
            <td><?php echo "sfdsdfg"; if($pordercurreur10[0]==='EUR'){ echo round($pordervalueeur10[0],2); } else if ($pordercurregbp10[0]==='GBP'){echo round($pordervaluegbp10[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<?php if((!empty($month_interval)) && ($month_interval=='12')){ ?>
			  
			<?php $pordernumeur13 = array(); $pordervalueeur13 = array(); $pordercurreur13 = array(); ?>
            <?php $pordernumgbp13 = array(); $pordervaluegbp13 = array(); $pordercurregbp13 = array(); ?>
            <?php foreach ($countselectdates13 as $previousweeks13): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks13['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks13['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks13['ProcessedOrder']['currency']==='EUR'){$pordernumeur13[] = $previousweeks13[0]['orderid']; $pordervalueeur13[] = $previousweeks13[0]['ordervalues']; $pordercurreur11[] = $previousweeks13['ProcessedOrder']['currency'];} else if($previousweeks13['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp13[] = $previousweeks13[0]['orderid']; $pordervaluegbp13[] = $previousweeks13[0]['ordervalues']; $pordercurregbp13[] = $previousweeks13['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks13['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur13 += $previousweeks13[0]['orderid']; $Totalordersumeur13+= $previousweeks13[0]['ordervalues']*0.84;}else if($previousweeks13['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp13 += $previousweeks13[0]['orderid'];  $Totalordersumegbp13+= $previousweeks13[0]['ordervalues'];} ?>
           <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur13[0]==='EUR'){ echo round($pordernumeur13[0],2); } else if ($pordercurregbp13[0]==='GBP'){echo round($pordernumgbp13[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur13[0]==='EUR'){ echo round($pordervalueeur13[0],2); } else if ($pordercurregbp13[0]==='GBP'){echo round($pordervaluegbp13[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			
			<?php if((!empty($month_interval)) && ($month_interval=='2')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
            <?php } else if((!empty($month_interval)) && ($month_interval=='3')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		 <?php } else if((!empty($month_interval)) && ($month_interval=='4')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		 <?php } else if((!empty($month_interval)) && ($month_interval=='5')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
			<?php } else if((!empty($month_interval)) && ($month_interval=='6')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='7')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='8')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='9')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='10')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='11')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='12')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<?php } else { ?>
			<td><?php if($pordercurreur[0]==='EUR'){ echo "<div class='rTableCell green'>".round($pordernumeur[0],2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){echo "<div class='rTableCell green'>".round($pordernumgbp[0],2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ echo "<div class='rTableCell green'>".round($pordervalueeur[0],2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){echo "<div class='rTableCell green'>".round($pordervaluegbp[0],2)."</div>"; } else {echo "-";}?></td>
            
			<?php } ?>
			</tr>
			
           <?php endforeach; ?> 
		    <tr><td></td><td colspan="2"><?php echo " Total in GBP"; ?></td><td><?php echo $Totalnumbsumegbp; ?></td><td><?php echo round($Totalordersumegbp,2); ?></td>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8')) || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12')){ ?>
			<?php echo "<td>". $Totalnumbsumegbp1 . "</td><td>" . round($Totalordersumegbp1,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp2 . "</td><td>" . round($Totalordersumegbp2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp3 . "</td><td>" . round($Totalordersumegbp3,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp4 . "</td><td>" . round($Totalordersumegbp4,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp5 . "</td><td>" . round($Totalordersumegbp5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp6 . "</td><td>" . round($Totalordersumegbp6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){?>
			<?php echo "<td>". $Totalnumbsumegbp7 . "</td><td>" . round($Totalordersumegbp7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp8 . "</td><td>" . round($Totalordersumegbp8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){?>
			<?php echo "<td>". $Totalnumbsumegbp9 . "</td><td>" . round($Totalordersumegbp9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbp10 . "</td><td>" . round($Totalordersumegbp10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && ($month_interval=='12')){  ?>
			<?php echo "<td>". $Totalnumbsumegbp13 . "</td><td>" . round($Totalordersumegbp13,2) ."</td>"; }?>
			
			
			
			<td colspan="2"></td>
			</tr>
			<tr><td></td><td colspan="2"><?php echo " Total in EUR"; ?></td><td><?php echo $Totalnumbsumeur; ?></td><td><?php echo round($Totalordersumeur,2); ?></td>
			 <?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur1 . "</td><td>" . round($Totalordersumeur1,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur2 . "</td><td>" . round($Totalordersumeur2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur3 . "</td><td>" . round($Totalordersumeur3,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur4 . "</td><td>" . round($Totalordersumeur4,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur5 . "</td><td>" . round($Totalordersumeur5,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8')  || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>			 
			<?php echo "<td>". $Totalnumbsumeur6 . "</td><td>" . round($Totalordersumeur6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){?>
			<?php echo "<td>". $Totalnumbsumeur7 . "</td><td>" . round($Totalordersumeur7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur8 . "</td><td>" . round($Totalordersumeur8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){?>
			<?php echo "<td>". $Totalnumbsumeur9 . "</td><td>" . round($Totalordersumeur9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){  ?>
			<?php echo "<td>". $Totalnumbsumeur10 . "</td><td>" . round($Totalordersumeur10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && ($month_interval=='12')){  ?>
			<?php echo "<td>". $Totalnumbsumeur13 . "</td><td>" . round($Totalordersumeur13,2) ."</td>"; }?>
			
			
			
			<td colspan="2"></td>	 
			 
			</tr>
			
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
    	var days = monthDiff(start,end);
	    var months = days.toFixed(0)
        $("#number_period").val(months);
    }
	});

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth();
    return months <= 0 ? 0 : months+2;
}
	
});
</script>
<script type="text/javascript">
$.noConflict();  //Not to conflict with other scripts
jQuery(document).ready(function($) {
var tableOffset = $("#table-1").offset().top;
var $header = $("#table-1 > thead").clone();
var $fixedHeader = $("#header-fixed").append($header);

$(window).bind("scroll", function() {
    var offset = $(this).scrollTop();
    
    if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
        $fixedHeader.show();
    }
    else if (offset < tableOffset) {
        $fixedHeader.hide();
    }
});

});
</script>