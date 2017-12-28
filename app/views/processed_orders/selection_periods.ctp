<?php if(($session->read('Auth.User.group_id')!='4'))
{
$this->requestAction('/users/logout/', array('return'));
}?>
<hr>
<?php //print_r($query_date);die();?>
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
         <thead><tr><th><strong><?php __('Sales Platform');?></strong></th><th><strong><?php __('Sales Channel');?></strong></th><th><strong><?php __('Currency');?></strong></th><?php $i = 1; $len = count($query_date); foreach($query_date as $firstandlast){  $yrdata = strtotime($firstandlast);   if ($i == $len - 0){ }else {?><th colspan="2"><strong><?php echo date('M-Y', $yrdata); $i++; ?></strong></th><?php } ?><?php } ?><th><strong><?php __('Total');?></strong></th><th><strong><?php __('Total');?></strong></th></tr>
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
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur += $previousweeks[0]['orderid']; $Totalordersumeur+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp += $previousweeks[0]['orderid'];  $Totalordersumegbp+= $previousweeks[0]['ordervalues'];} ?>
                         
						<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
			<?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur[0]==='EUR'){ echo round($pordernumeur[0],2); } else if ($pordercurregbp[0]==='GBP'){echo round($pordernumgbp[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ echo round($pordervalueeur[0],2); } else if ($pordercurregbp[0]==='GBP'){echo round($pordervaluegbp[0],2); } else {echo "-";}?></td>
        
            <?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur1 = array(); $pordervalueeur1 = array(); $pordercurreur1 = array(); ?>
            <?php $pordernumgbp1 = array(); $pordervaluegbp1 = array(); $pordercurregbp1 = array(); ?>
            <?php foreach ($countselectdates1 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur1[] = $previousweeks[0]['orderid']; $pordervalueeur1[] = $previousweeks[0]['ordervalues']; $pordercurreur1[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp1[] = $previousweeks[0]['orderid']; $pordervaluegbp1[] = $previousweeks[0]['ordervalues']; $pordercurregbp1[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
              <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur1 += $previousweeks[0]['orderid']; $Totalordersumeur1+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp1 += $previousweeks[0]['orderid'];  $Totalordersumegbp1+= $previousweeks[0]['ordervalues'];} ?>
                 
						<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek1 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek1 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany1 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany1 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france1 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france1 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain1 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain1 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>		   
			 <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur1[0]==='EUR'){ echo round($pordernumeur1[0],2); } else if ($pordercurregbp1[0]==='GBP'){echo round($pordernumgbp1[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur1[0]==='EUR'){ echo round($pordervalueeur1[0],2); } else if ($pordercurregbp1[0]==='GBP'){echo round($pordervaluegbp1[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>			 
						 
			
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur2 = array(); $pordervalueeur2 = array(); $pordercurreur2 = array(); ?>
            <?php $pordernumgbp2 = array(); $pordervaluegbp2 = array(); $pordercurregbp2 = array(); ?>
            <?php foreach ($countselectdates2 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur2[] = $previousweeks[0]['orderid']; $pordervalueeur2[] = $previousweeks[0]['ordervalues']; $pordercurreur2[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp2[] = $previousweeks[0]['orderid']; $pordervaluegbp2[] = $previousweeks[0]['ordervalues']; $pordercurregbp2[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur2 += $previousweeks[0]['orderid']; $Totalordersumeur2+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp2 += $previousweeks[0]['orderid'];  $Totalordersumegbp2+= $previousweeks[0]['ordervalues'];} ?>
           
		   			<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek2 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek2 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany2 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany2 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france2 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france2 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain2 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain2 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
			 <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur2[0]==='EUR'){ echo round($pordernumeur2[0],2); } else if ($pordercurregbp2[0]==='GBP'){echo round($pordernumgbp2[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur2[0]==='EUR'){ echo round($pordervalueeur2[0],2); } else if ($pordercurregbp2[0]==='GBP'){echo round($pordervaluegbp2[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur3 = array(); $pordervalueeur3 = array(); $pordercurreur3 = array(); ?>
            <?php $pordernumgbp3 = array(); $pordervaluegbp3 = array(); $pordercurregbp3 = array(); ?>
            <?php foreach ($countselectdates3 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur3[] = $previousweeks[0]['orderid']; $pordervalueeur3[] = $previousweeks[0]['ordervalues']; $pordercurreur3[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp3[] = $previousweeks[0]['orderid']; $pordervaluegbp3[] = $previousweeks[0]['ordervalues']; $pordercurregbp3[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur3 += $previousweeks[0]['orderid']; $Totalordersumeur3+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp3 += $previousweeks[0]['orderid'];  $Totalordersumegbp3+= $previousweeks[0]['ordervalues'];} ?>
              
						<?php 
						
						/* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek3 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek3 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany3 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany3 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france3 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france3 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain3 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain3 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur3[0]==='EUR'){ echo round($pordernumeur3[0],2); } else if ($pordercurregbp3[0]==='GBP'){echo round($pordernumgbp3[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur3[0]==='EUR'){ echo round($pordervalueeur3[0],2); } else if ($pordercurregbp3[0]==='GBP'){echo round($pordervaluegbp3[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>
			  <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))) { ?>
			  
			<?php $pordernumeur4 = array(); $pordervalueeur4 = array(); $pordercurreur4 = array(); ?>
            <?php $pordernumgbp4 = array(); $pordervaluegbp4 = array(); $pordercurregbp4= array(); ?>
            <?php foreach ($countselectdates4 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur4[] = $previousweeks[0]['orderid']; $pordervalueeur4[] = $previousweeks[0]['ordervalues']; $pordercurreur4[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp4[] = $previousweeks[0]['orderid']; $pordervaluegbp4[] = $previousweeks[0]['ordervalues']; $pordercurregbp4[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur4 += $previousweeks[0]['orderid']; $Totalordersumeur4+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp4 += $previousweeks[0]['orderid'];  $Totalordersumegbp4+= $previousweeks[0]['ordervalues'];} ?>
           
				   
						<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek4 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek4 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany4 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany4 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france4 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france4 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain4 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain4 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur4[0]==='EUR'){ echo round($pordernumeur4[0],2); } else if ($pordercurregbp4[0]==='GBP'){echo round($pordernumgbp4[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur4[0]==='EUR'){ echo round($pordervalueeur4[0],2); } else if ($pordercurregbp4[0]==='GBP'){echo round($pordervaluegbp4[0],2); } else {echo "-";}?></td>
              
			 <?php  } ?>		
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur5 = array(); $pordervalueeur5 = array(); $pordercurreur5 = array(); ?>
            <?php $pordernumgbp5 = array(); $pordervaluegbp5 = array(); $pordercurregbp5= array(); ?>
            <?php foreach ($countselectdates5 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur5[] = $previousweeks[0]['orderid']; $pordervalueeur5[] = $previousweeks[0]['ordervalues']; $pordercurreur5[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp5[] = $previousweeks[0]['orderid']; $pordervaluegbp5[] = $previousweeks[0]['ordervalues']; $pordercurregbp5[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur5 += $previousweeks[0]['orderid']; $Totalordersumeur5+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp5 += $previousweeks[0]['orderid'];  $Totalordersumegbp5+= $previousweeks[0]['ordervalues'];} ?>
          
				   
						<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek5 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek5 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany5 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany5 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france5 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france5 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain5 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain5 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>

			<?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur5[0]==='EUR'){ echo round($pordernumeur5[0],2); } else if ($pordercurregbp5[0]==='GBP'){echo round($pordernumgbp5[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur5[0]==='EUR'){ echo round($pordervalueeur5[0],2); } else if ($pordercurregbp5[0]==='GBP'){echo round($pordervaluegbp5[0],2); } else {echo "-";}?></td>
            <?php  } ?>
		
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur6 = array(); $pordervalueeur6 = array(); $pordercurreur6 = array(); ?>
            <?php $pordernumgbp6 = array(); $pordervaluegbp6 = array(); $pordercurregbp6= array(); ?>
            <?php foreach ($countselectdates6 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur6[] = $previousweeks[0]['orderid']; $pordervalueeur6[] = $previousweeks[0]['ordervalues']; $pordercurreur6[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp6[] = $previousweeks[0]['orderid']; $pordervaluegbp6[] = $previousweeks[0]['ordervalues']; $pordercurregbp6[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur6 += $previousweeks[0]['orderid']; $Totalordersumeur6+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp6 += $previousweeks[0]['orderid'];  $Totalordersumegbp6+= $previousweeks[0]['ordervalues'];} ?>
           		   
						<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek6 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek6 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany6 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany6 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france6 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france6 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain6 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain6 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur6[0]==='EUR'){ echo round($pordernumeur6[0],2); } else if ($pordercurregbp6[0]==='GBP'){echo round($pordernumgbp6[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur6[0]==='EUR'){ echo round($pordervalueeur6[0],2); } else if ($pordercurregbp6[0]==='GBP'){echo round($pordervaluegbp6[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){        ?>
			  
			<?php $pordernumeur7 = array(); $pordervalueeur7 = array(); $pordercurreur7 = array(); ?>
            <?php $pordernumgbp7 = array(); $pordervaluegbp7 = array(); $pordercurregbp7 = array(); ?>
            <?php foreach ($countselectdates7 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur7[] = $previousweeks[0]['orderid']; $pordervalueeur7[] = $previousweeks[0]['ordervalues']; $pordercurreur7[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp7[] = $previousweeks[0]['orderid']; $pordervaluegbp7[] = $previousweeks[0]['ordervalues']; $pordercurregbp7[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur7 += $previousweeks[0]['orderid']; $Totalordersumeur7+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp7 += $previousweeks[0]['orderid'];  $Totalordersumegbp7+= $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek7 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek7 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany7 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany7 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france7 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france7 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain7 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain7 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur7[0]==='EUR'){ echo round($pordernumeur7[0],2); } else if ($pordercurregbp7[0]==='GBP'){echo round($pordernumgbp7[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur7[0]==='EUR'){ echo round($pordervalueeur7[0],2); } else if ($pordercurregbp7[0]==='GBP'){echo round($pordervaluegbp7[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeur8 = array(); $pordervalueeur8 = array(); $pordercurreur8 = array(); ?>
            <?php $pordernumgbp8 = array(); $pordervaluegbp8 = array(); $pordercurregbp8 = array(); ?>
            <?php foreach ($countselectdates8 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur8[] = $previousweeks[0]['orderid']; $pordervalueeur8[] = $previousweeks[0]['ordervalues']; $pordercurreur8[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp8[] = $previousweeks[0]['orderid']; $pordervaluegbp8[] = $previousweeks[0]['ordervalues']; $pordercurregbp8[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur8 += $previousweeks[0]['orderid']; $Totalordersumeur8+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp8 += $previousweeks[0]['orderid'];  $Totalordersumegbp8 += $previousweeks[0]['ordervalues'];} ?>
			
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek8 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek8 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany8 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany8 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france8 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france8 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain8 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain8 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>

		  <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur8[0]==='EUR'){ echo round($pordernumeur8[0],2); } else if ($pordercurregbp8[0]==='GBP'){echo round($pordernumgbp8[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur8[0]==='EUR'){ echo round($pordervalueeur8[0],2); } else if ($pordercurregbp8[0]==='GBP'){echo round($pordervaluegbp8[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeur9 = array(); $pordervalueeur9 = array(); $pordercurreur9 = array(); ?>
            <?php $pordernumgbp9 = array(); $pordervaluegbp9 = array(); $pordercurregbp9 = array(); ?>
            <?php foreach ($countselectdates9 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur9[] = $previousweeks[0]['orderid']; $pordervalueeur9[] = $previousweeks[0]['ordervalues']; $pordercurreur9[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp9[] = $previousweeks[0]['orderid']; $pordervaluegbp9[] = $previousweeks[0]['ordervalues']; $pordercurregbp9[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur9 += $previousweeks[0]['orderid']; $Totalordersumeur9+= $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp9 += $previousweeks[0]['orderid'];  $Totalordersumegbp9 += $previousweeks[0]['ordervalues'];} ?>
           
		   
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek9 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek9 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany9 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany9 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france9 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france9 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain9 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain9 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur9[0]==='EUR'){ echo round($pordernumeur9[0],2); } else if ($pordercurregbp9[0]==='GBP'){echo round($pordernumgbp9[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur9[0]==='EUR'){ echo round($pordervalueeur9[0],2); } else if ($pordercurregbp9[0]==='GBP'){echo round($pordervaluegbp9[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12')  || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeur10 = array(); $pordervalueeur10 = array(); $pordercurreur10 = array(); ?>
            <?php $pordernumgbp10 = array(); $pordervaluegbp10 = array(); $pordercurregbp10 = array(); ?>
            <?php foreach ($countselectdates10 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeur10[] = $previousweeks[0]['orderid']; $pordervalueeur10[] = $previousweeks[0]['ordervalues']; $pordercurreur10[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp10[] = $previousweeks[0]['orderid']; $pordervaluegbp10[] = $previousweeks[0]['ordervalues']; $pordercurregbp10[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur10 += $previousweeks[0]['orderid']; $Totalordersumeur10 += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp10 += $previousweeks[0]['orderid'];  $Totalordersumegbp10 += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek10 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek10 += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany10 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germany10 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france10 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_france10 += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain10 += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spain10 += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur10[0]==='EUR'){ echo round($pordernumeur10[0],2); } else if ($pordercurregbp10[0]==='GBP'){echo round($pordernumgbp10[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur10[0]==='EUR'){ echo round($pordervalueeur10[0],2); } else if ($pordercurregbp10[0]==='GBP'){echo round($pordervaluegbp10[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			  
			<?php $pordernumeur13 = array(); $pordervalueeur13 = array(); $pordercurreur13 = array(); ?>
            <?php $pordernumgbp13 = array(); $pordervaluegbp13 = array(); $pordercurregbp13 = array(); ?>
            <?php foreach ($countselectdates13 as $previousweeks13): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks13['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks13['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks13['ProcessedOrder']['currency']==='EUR'){$pordernumeur13[] = $previousweeks13[0]['orderid']; $pordervalueeur13[] = $previousweeks13[0]['ordervalues']; $pordercurreur11[] = $previousweeks13['ProcessedOrder']['currency'];} else if($previousweeks13['ProcessedOrder']['currency']==='GBP'){ $pordernumgbp13[] = $previousweeks13[0]['orderid']; $pordervaluegbp13[] = $previousweeks13[0]['ordervalues']; $pordercurregbp13[] = $previousweeks13['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks13['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeur13 += $previousweeks13[0]['orderid']; $Totalordersumeur13+= $previousweeks13[0]['ordervalues']*0.89;}else if($previousweeks13['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbp13 += $previousweeks13[0]['orderid'];  $Totalordersumegbp13+= $previousweeks13[0]['ordervalues'];} ?>
           
		   
					<?php /* Combine data in Reports */
						if(($previousweeks13['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweek11 += $previousweeks13[0]['orderid']; $totalorder_amazon_preevweek11 += $previousweeks13[0]['ordervalues'];}
						if(($previousweeks13['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germany11 += $previousweeks13[0]['orderid']; $totalorder_amazon_preevweek_germany11 += $previousweeks13[0]['ordervalues']*0.89;}
						if(($previousweeks13['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_france11 += $previousweeks13[0]['orderid']; $totalorder_amazon_preevweek_france11 += $previousweeks13[0]['ordervalues']*0.89;}
						if(($previousweeks13['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spain11 += $previousweeks13[0]['orderid']; $totalorder_amazon_preevweek_spain11 += $previousweeks13[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreur13[0]==='EUR'){ echo round($pordernumeur13[0],2); } else if ($pordercurregbp13[0]==='GBP'){echo round($pordernumgbp13[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreur13[0]==='EUR'){ echo round($pordervalueeur13[0],2); } else if ($pordercurregbp13[0]==='GBP'){echo round($pordervaluegbp13[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<!--Start condition After 12 Month-->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurone = array(); $pordervalueeurone = array(); $pordercurreurone = array(); ?>
            <?php $pordernumgbpone = array(); $pordervaluegbpone = array(); $pordercurregbpone = array(); ?>
            <?php foreach ($countsecondyear1 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurone[] = $previousweeks[0]['orderid']; $pordervalueeurone[] = $previousweeks[0]['ordervalues']; $pordercurreurone[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpone[] = $previousweeks[0]['orderid']; $pordervaluegbpone[] = $previousweeks[0]['ordervalues']; $pordercurregbpone[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurone += $previousweeks[0]['orderid']; $Totalordersumeurone += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpone += $previousweeks[0]['orderid'];  $Totalordersumegbpone += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekone += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekone += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyone += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyone += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_franceone += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_franceone += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainone += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainone += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurone[0]==='EUR'){ echo round($pordernumeurone[0],2); } else if ($pordercurregbpone[0]==='GBP'){echo round($pordernumgbpone[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurone[0]==='EUR'){ echo round($pordervalueeurone[0],2); } else if ($pordercurregbpone[0]==='GBP'){echo round($pordervaluegbpone[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<!---  Start 14 -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurtwo= array(); $pordervalueeurtwo = array(); $pordercurreurtwo = array(); ?>
            <?php $pordernumgbptwo = array(); $pordervaluegbptwo = array(); $pordercurregbptwo = array(); ?>
            <?php foreach ($countsecondyear2 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurtwo[] = $previousweeks[0]['orderid']; $pordervalueeurtwo[] = $previousweeks[0]['ordervalues']; $pordercurreurtwo[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbptwo[] = $previousweeks[0]['orderid']; $pordervaluegbptwo[] = $previousweeks[0]['ordervalues']; $pordercurregbptwo[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurtwo += $previousweeks[0]['orderid']; $Totalordersumeurtwo += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbptwo += $previousweeks[0]['orderid'];  $Totalordersumegbptwo += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweektwo += $previousweeks[0]['orderid']; $totalorder_amazon_preevweektwo += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanytwo += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanytwo += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francetwo += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francetwo += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spaintwo += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spaintwo += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurtwo[0]==='EUR'){ echo round($pordernumeurtwo[0],2); } else if ($pordercurregbptwo[0]==='GBP'){echo round($pordernumgbptwo[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurtwo[0]==='EUR'){ echo round($pordervalueeurtwo[0],2); } else if ($pordercurregbptwo[0]==='GBP'){echo round($pordervaluegbptwo[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<!---  Start 15 -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurthree = array(); $pordervalueeurthree = array(); $pordercurreurthree = array(); ?>
            <?php $pordernumgbpthree = array(); $pordervaluegbpthree = array(); $pordercurregbpthree = array(); ?>
            <?php foreach ($countsecondyear3 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurthree[] = $previousweeks[0]['orderid']; $pordervalueeurthree[] = $previousweeks[0]['ordervalues']; $pordercurreurthree[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpthree[] = $previousweeks[0]['orderid']; $pordervaluegbpthree[] = $previousweeks[0]['ordervalues']; $pordercurregbpthree[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurthree += $previousweeks[0]['orderid']; $Totalordersumeurthree += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpthree += $previousweeks[0]['orderid'];  $Totalordersumegbpthree += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekthree += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekthree += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanythree += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanythree += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francethree += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francethree += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainthree += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainthree += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurthree[0]==='EUR'){ echo round($pordernumeurthree[0],2); } else if ($pordercurregbpthree[0]==='GBP'){echo round($pordernumgbpthree[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurthree[0]==='EUR'){ echo round($pordervalueeurthree[0],2); } else if ($pordercurregbpthree[0]==='GBP'){echo round($pordervaluegbpthree[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 16 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurfour = array(); $pordervalueeurfour = array(); $pordercurreurfour= array(); ?>
            <?php $pordernumgbpfour = array(); $pordervaluegbpfour = array(); $pordercurregbpfour = array(); ?>
            <?php foreach ($countsecondyear4 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurfour[] = $previousweeks[0]['orderid']; $pordervalueeurfour[] = $previousweeks[0]['ordervalues']; $pordercurreurfour[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpfour[] = $previousweeks[0]['orderid']; $pordervaluegbpfour[] = $previousweeks[0]['ordervalues']; $pordercurregbpfour[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurfour += $previousweeks[0]['orderid']; $Totalordersumeurfour += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpfour += $previousweeks[0]['orderid'];  $Totalordersumegbpfour += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekfour += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekfour += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyfour += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyfour += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francefour += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francefour += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainfour += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainfour += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurfour[0]==='EUR'){ echo round($pordernumeurfour[0],2); } else if ($pordercurregbpfour[0]==='GBP'){echo round($pordernumgbpfour[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurfour[0]==='EUR'){ echo round($pordervalueeurfour[0],2); } else if ($pordercurregbpfour[0]==='GBP'){echo round($pordervaluegbpfour[0],2); } else {echo "-";}?></td>
            <?php  } ?>				
			
			<!---  Start 17 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurfive = array(); $pordervalueeurfive = array(); $pordercurreurfive = array(); ?>
            <?php $pordernumgbpfive = array(); $pordervaluegbpfive = array(); $pordercurregbpfive = array(); ?>
            <?php foreach ($countsecondyear5 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurfive[] = $previousweeks[0]['orderid']; $pordervalueeurfive[] = $previousweeks[0]['ordervalues']; $pordercurreurfive[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpfive[] = $previousweeks[0]['orderid']; $pordervaluegbpfive[] = $previousweeks[0]['ordervalues']; $pordercurregbpfive[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurfive += $previousweeks[0]['orderid']; $Totalordersumeurfive += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpfive += $previousweeks[0]['orderid'];  $Totalordersumegbpfive += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekfive += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekfive += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyfive += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyfive += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francefive += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francefive += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainfive += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainfive += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurfive[0]==='EUR'){ echo round($pordernumeurfive[0],2); } else if ($pordercurregbpfive[0]==='GBP'){echo round($pordernumgbpfive[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurfive[0]==='EUR'){ echo round($pordervalueeurfive[0],2); } else if ($pordercurregbpfive[0]==='GBP'){echo round($pordervaluegbpfive[0],2); } else {echo "-";}?></td>
            <?php  } ?>	
			
			<!---  Start 18 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeursix = array(); $pordervalueeursix = array(); $pordercurreursix = array(); ?>
            <?php $pordernumgbpsix = array(); $pordervaluegbpsix = array(); $pordercurregbpsix = array(); ?>
            <?php foreach ($countsecondyear6 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeursix[] = $previousweeks[0]['orderid']; $pordervalueeursix[] = $previousweeks[0]['ordervalues']; $pordercurreursix[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpsix[] = $previousweeks[0]['orderid']; $pordervaluegbpsix[] = $previousweeks[0]['ordervalues']; $pordercurregbpsix[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeursix += $previousweeks[0]['orderid']; $Totalordersumeursix += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpsix += $previousweeks[0]['orderid'];  $Totalordersumegbpsix += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweeksix += $previousweeks[0]['orderid']; $totalorder_amazon_preevweeksix += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanysix += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanysix += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francesix += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francesix += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainsix += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainsix += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreursix[0]==='EUR'){ echo round($pordernumeursix[0],2); } else if ($pordercurregbpsix[0]==='GBP'){echo round($pordernumgbpsix[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreursix[0]==='EUR'){ echo round($pordervalueeursix[0],2); } else if ($pordercurregbpsix[0]==='GBP'){echo round($pordervaluegbpsix[0],2); } else {echo "-";}?></td>
            <?php  } ?>				
			
			<!---  Start 19 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeursiv = array(); $pordervalueeursiv = array(); $pordercurreursiv = array(); ?>
            <?php $pordernumgbpsiv = array(); $pordervaluegbpsiv = array(); $pordercurregbpsiv = array(); ?>
            <?php foreach ($countsecondyear7 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeursiv[] = $previousweeks[0]['orderid']; $pordervalueeursiv[] = $previousweeks[0]['ordervalues']; $pordercurreursiv[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpsiv[] = $previousweeks[0]['orderid']; $pordervaluegbpsiv[] = $previousweeks[0]['ordervalues']; $pordercurregbpsiv[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeursiv += $previousweeks[0]['orderid']; $Totalordersumeursiv += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpsiv += $previousweeks[0]['orderid'];  $Totalordersumegbpsiv += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweeksiv += $previousweeks[0]['orderid']; $totalorder_amazon_preevweeksiv += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanysiv += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanysiv += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francesiv += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francesiv += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainsiv += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainsiv += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreursiv[0]==='EUR'){ echo round($pordernumeursiv[0],2); } else if ($pordercurregbpsiv[0]==='GBP'){echo round($pordernumgbpsiv[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreursiv[0]==='EUR'){ echo round($pordervalueeursiv[0],2); } else if ($pordercurregbpsiv[0]==='GBP'){echo round($pordervaluegbpsiv[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 20 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeureaight = array(); $pordervalueeureaight = array(); $pordercurreureaight = array(); ?>
            <?php $pordernumgbpeaight = array(); $pordervaluegbpeaight = array(); $pordercurregbpeaight = array(); ?>
            <?php foreach ($countsecondyear8 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeureaight[] = $previousweeks[0]['orderid']; $pordervalueeureaight[] = $previousweeks[0]['ordervalues']; $pordercurreureaight[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpeaight[] = $previousweeks[0]['orderid']; $pordervaluegbpeaight[] = $previousweeks[0]['ordervalues']; $pordercurregbpeaight[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeureaight += $previousweeks[0]['orderid']; $Totalordersumeureaight += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpeaight += $previousweeks[0]['orderid'];  $Totalordersumegbpeaight += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekeaight += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekeaight += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyeaight += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyeaight += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_franceeaight += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_franceeaight += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spaineaight += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spaineaight += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreureaight[0]==='EUR'){ echo round($pordernumeureaight[0],2); } else if ($pordercurregbpeaight[0]==='GBP'){echo round($pordernumgbpeaight[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreureaight[0]==='EUR'){ echo round($pordervalueeureaight[0],2); } else if ($pordercurregbpeaight[0]==='GBP'){echo round($pordervaluegbpeaight[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 21 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurnin = array(); $pordervalueeurnin = array(); $pordercurreurnin = array(); ?>
            <?php $pordernumgbpnin = array(); $pordervaluegbpnin = array(); $pordercurregbpnin = array(); ?>
            <?php foreach ($countsecondyear9 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurnin[] = $previousweeks[0]['orderid']; $pordervalueeurnin[] = $previousweeks[0]['ordervalues']; $pordercurreurnin[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpnin[] = $previousweeks[0]['orderid']; $pordervaluegbpnin[] = $previousweeks[0]['ordervalues']; $pordercurregbpnin[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurnin += $previousweeks[0]['orderid']; $Totalordersumeurnin += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpnin += $previousweeks[0]['orderid'];  $Totalordersumegbpnin += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweeknin += $previousweeks[0]['orderid']; $totalorder_amazon_preevweeknin += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanynin += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanynin += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francenin += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francenin += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainnin += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainnin += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurnin[0]==='EUR'){ echo round($pordernumeurnin[0],2); } else if ($pordercurregbpnin[0]==='GBP'){echo round($pordernumgbpnin[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurnin[0]==='EUR'){ echo round($pordervalueeurnin[0],2); } else if ($pordercurregbpnin[0]==='GBP'){echo round($pordervaluegbpnin[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 22 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurten = array(); $pordervalueeurten = array(); $pordercurreurten = array(); ?>
            <?php $pordernumgbpten = array(); $pordervaluegbpten = array(); $pordercurregbpten = array(); ?>
            <?php foreach ($countsecondyear10 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurten[] = $previousweeks[0]['orderid']; $pordervalueeurten[] = $previousweeks[0]['ordervalues']; $pordercurreurten[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpten[] = $previousweeks[0]['orderid']; $pordervaluegbpten[] = $previousweeks[0]['ordervalues']; $pordercurregbpten[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurten += $previousweeks[0]['orderid']; $Totalordersumeurten += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpten += $previousweeks[0]['orderid'];  $Totalordersumegbpten += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekten += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekten += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyten += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyten += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_franceten += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_franceten += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainten += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainten += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurten[0]==='EUR'){ echo round($pordernumeurten[0],2); } else if ($pordercurregbpten[0]==='GBP'){echo round($pordernumgbpten[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurten[0]==='EUR'){ echo round($pordervalueeurten[0],2); } else if ($pordercurregbpten[0]==='GBP'){echo round($pordervaluegbpten[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 23 -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			  
			<?php $pordernumeurelev = array(); $pordervalueeurelev = array(); $pordercurreurelev = array(); ?>
            <?php $pordernumgbpelev = array(); $pordervaluegbpelev = array(); $pordercurregbpelev = array(); ?>
            <?php foreach ($countsecondyear11 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurelev[] = $previousweeks[0]['orderid']; $pordervalueeurelev[] = $previousweeks[0]['ordervalues']; $pordercurreurelev[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbpelev[] = $previousweeks[0]['orderid']; $pordervaluegbpelev[] = $previousweeks[0]['ordervalues']; $pordercurregbpelev[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurelev += $previousweeks[0]['orderid']; $Totalordersumeurelev += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbpelev += $previousweeks[0]['orderid'];  $Totalordersumegbpelev += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweekelev += $previousweeks[0]['orderid']; $totalorder_amazon_preevweekelev += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanyelev += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanyelev += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_franceelev+= $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_franceelev += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spainelev += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spainelev += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurelev[0]==='EUR'){ echo round($pordernumeurelev[0],2); } else if ($pordercurregbpelev[0]==='GBP'){echo round($pordernumgbpelev[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurelev[0]==='EUR'){ echo round($pordervalueeurelev[0],2); } else if ($pordercurregbpelev[0]==='GBP'){echo round($pordervaluegbpelev[0],2); } else {echo "-";}?></td>
            <?php  } ?>		
			
			<!---  Start 24 -->
			
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			  
			<?php $pordernumeurtwel = array(); $pordervalueeurtwel = array(); $pordercurreurtwel = array(); ?>
            <?php $pordernumgbptwel = array(); $pordervaluegbptwel = array(); $pordercurregbptwel = array(); ?>
            <?php foreach ($countsecondyear12 as $previousweeks): ?>  
            <?php if(($value['ProcessedOrder']['subsource'] === $previousweeks['ProcessedOrder']['subsource']) && ($value['ProcessedOrder']['plateform'] === $previousweeks['ProcessedOrder']['plateform'])) {?>
            <?php if($previousweeks['ProcessedOrder']['currency']==='EUR'){$pordernumeurtwel[] = $previousweeks[0]['orderid']; $pordervalueeurtwel[] = $previousweeks[0]['ordervalues']; $pordercurreurtwel[] = $previousweeks['ProcessedOrder']['currency'];} else if($previousweeks['ProcessedOrder']['currency']==='GBP'){ $pordernumgbptwel[] = $previousweeks[0]['orderid']; $pordervaluegbptwel[] = $previousweeks[0]['ordervalues']; $pordercurregbptwel[] = $previousweeks['ProcessedOrder']['currency']; }  ?>                              
            <?php if($previousweeks['ProcessedOrder']['currency'] ==='EUR'){ $Totalnumbsumeurtwel += $previousweeks[0]['orderid']; $Totalordersumeurtwel += $previousweeks[0]['ordervalues']*0.89;}else if($previousweeks['ProcessedOrder']['currency'] ==='GBP'){ $Totalnumbsumegbptwel += $previousweeks[0]['orderid'];  $Totalordersumegbptwel += $previousweeks[0]['ordervalues'];} ?>
           
					<?php /* Combine data in Reports */
						if(($previousweeks['ProcessedOrder']['subsource'])==='United Kingdom'){$totalnum_amazon_preevweektwel += $previousweeks[0]['orderid']; $totalorder_amazon_preevweektwel += $previousweeks[0]['ordervalues'];}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Germany'){$totalnum_amazon_preevweek_germanytwel += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_germanytwel += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='France'){$totalnum_amazon_preevweek_francetwel += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_francetwel += $previousweeks[0]['ordervalues']*0.89;}
						if(($previousweeks['ProcessedOrder']['subsource'])==='Spain'){$totalnum_amazon_preevweek_spaintwel += $previousweeks[0]['orderid']; $totalorder_amazon_preevweek_spaintwel += $previousweeks[0]['ordervalues']*0.89;}
						
						/* End Combine data in Reports */ ?>
		   
		   <?php } ?>
             <?php endforeach; ?> 
            <td><?php if($pordercurreurtwel[0]==='EUR'){ echo round($pordernumeurtwel[0],2); } else if ($pordercurregbptwel[0]==='GBP'){echo round($pordernumgbptwel[0],2); } else {echo "-";}?></td>
            <td><?php if($pordercurreurtwel[0]==='EUR'){ echo round($pordervalueeurtwel[0],2); } else if ($pordercurregbptwel[0]==='GBP'){echo round($pordervaluegbptwel[0],2); } else {echo "-";}?></td>
            <?php  } ?>
			
			<!-- End condition After 12 Month -->
			
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
       		
			<!--Start condition After 12 Month -->
			
			<?php } else if((!empty($month_interval)) && ($month_interval=='13')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 14 -->
			<?php } else if((!empty($month_interval)) && ($month_interval=='14')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 15 -->
			<?php } else if((!empty($month_interval)) && ($month_interval=='15')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 16 -->
			<?php } else if((!empty($month_interval)) && ($month_interval=='16')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 17 -->
			<?php } else if((!empty($month_interval)) && ($month_interval=='17')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]; echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0];  echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 18-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='18')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 19-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='19')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 20-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='20')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0]+$pordernumeureaight[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]+$pordernumgbpeaight[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]+$pordervalueeureaight[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]+$pordervaluegbpeaight[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 21-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='21')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0]+$pordernumeureaight[0]+$pordernumeurnin[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]+$pordernumgbpeaight[0]+$pordernumgbpnin[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]+$pordervalueeureaight[0]+$pordervalueeurnin[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]+$pordervaluegbpeaight[0]+$pordervaluegbpnin[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 22-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='22')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0]+$pordernumeureaight[0]+$pordernumeurnin[0]+$pordernumeurten[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]+$pordernumgbpeaight[0]+$pordernumgbpnin[0]+$pordernumgbpten[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]+$pordervalueeureaight[0]+$pordervalueeurnin[0]+$pordervalueeurten[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]+$pordervaluegbpeaight[0]+$pordervaluegbpnin[0]+$pordervaluegbpten[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 23-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='23')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0]+$pordernumeureaight[0]+$pordernumeurnin[0]+$pordernumeurten[0]+$pordernumeurelev[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]+$pordernumgbpeaight[0]+$pordernumgbpnin[0]+$pordernumgbpten[0]+$pordernumgbpelev[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]+$pordervalueeureaight[0]+$pordervalueeurnin[0]+$pordervalueeurten[0]+$pordervalueeurelev[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]+$pordervaluegbpeaight[0]+$pordervaluegbpnin[0]+$pordervaluegbpten[0]+$pordervaluegbpelev[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		<!-- start 24-->
			<?php } else if((!empty($month_interval)) && ($month_interval=='24')){ ?>
			<td><?php if($pordercurreur[0]==='EUR'){ $totalnumbeur = $pordernumeur[0]+$pordernumeur1[0]+$pordernumeur2[0]+$pordernumeur3[0]+$pordernumeur4[0]+$pordernumeur5[0]+$pordernumeur6[0]+$pordernumeur7[0]+$pordernumeur8[0]+$pordernumeur9[0]+$pordernumeur10[0]+$pordernumeur13[0]+$pordernumeurone[0]+$pordernumeurtwo[0]+$pordernumeurthree[0]+$pordernumeurfour[0]+$pordernumeurfive[0]+$pordernumeursix[0]+$pordernumeursiv[0]+$pordernumeureaight[0]+$pordernumeurnin[0]+$pordernumeurten[0]+$pordernumeurelev[0]+$pordernumeurtwel[0];echo "<div class='rTableCell green'>".round($totalnumbeur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){ $Totalnumbgbp = $pordernumgbp[0]+$pordernumgbp1[0]+$pordernumgbp2[0]+$pordernumgbp3[0]+$pordernumgbp4[0]+$pordernumgbp5[0]+$pordernumgbp6[0]+$pordernumgbp7[0]+$pordernumgbp8[0]+$pordernumgbp9[0]+$pordernumgbp10[0]+$pordernumgbp13[0]+$pordernumgbpone[0]+$pordernumgbptwo[0]+$pordernumgbpthree[0]+$pordernumgbpfour[0]+$pordernumgbpfive[0]+$pordernumgbpsix[0]+$pordernumgbpsiv[0]+$pordernumgbpeaight[0]+$pordernumgbpnin[0]+$pordernumgbpten[0]+$pordernumgbpelev[0]+$pordernumgbptwel[0]; echo "<div class='rTableCell green'>".round($Totalnumbgbp,2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ $totalvaleur = $pordervalueeur[0]+$pordervalueeur1[0]+$pordervalueeur2[0]+$pordervalueeur3[0]+$pordervalueeur4[0]+$pordervalueeur5[0]+$pordervalueeur6[0]+$pordervalueeur7[0]+$pordervalueeur8[0]+$pordervalueeur9[0]+$pordervalueeur10[0]+$pordervalueeur13[0]+$pordervalueeurone[0]+$pordervalueeurtwo[0]+$pordervalueeurthree[0]+$pordervalueeurfour[0]+$pordervalueeurfive[0]+$pordervalueeursix[0]+$pordervalueeursiv[0]+$pordervalueeureaight[0]+$pordervalueeurnin[0]+$pordervalueeurten[0]+$pordervalueeurelev[0]+$pordervalueeurtwel[0]; echo "<div class='rTableCell green'>".round($totalvaleur,2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){$Totalvalgbp = $pordervaluegbp[0]+$pordervaluegbp1[0]+$pordervaluegbp2[0]+$pordervaluegbp3[0]+$pordervaluegbp4[0]+$pordervaluegbp5[0]+$pordervaluegbp6[0]+$pordervaluegbp7[0]+$pordervaluegbp8[0]+$pordervaluegbp9[0]+$pordervaluegbp10[0]+$pordervaluegbp13[0]+$pordervaluegbpone[0]+$pordervaluegbptwo[0]+$pordervaluegbpthree[0]+$pordervaluegbpfour[0]+$pordervaluegbpfive[0]+$pordervaluegbpsix[0]+$pordervaluegbpsiv[0]+$pordervaluegbpeaight[0]+$pordervaluegbpnin[0]+$pordervaluegbpten[0]+$pordervaluegbpelev[0]+$pordervaluegbptwel[0]; echo "<div class='rTableCell green'>".round($Totalvalgbp,2)."</div>"; } else {echo "-";}?></td>
       		
			<!--End condition After 12 Month  -->	
			
			<?php } else { ?>
			<td><?php if($pordercurreur[0]==='EUR'){ echo "<div class='rTableCell green'>".round($pordernumeur[0],2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){echo "<div class='rTableCell green'>".round($pordernumgbp[0],2)."</div>"; } else {echo "-";}?></td>
            <td><?php if($pordercurreur[0]==='EUR'){ echo "<div class='rTableCell green'>".round($pordervalueeur[0],2)."</div>"; } else if ($pordercurregbp[0]==='GBP'){echo "<div class='rTableCell green'>".round($pordervaluegbp[0],2)."</div>"; } else {echo "-";}?></td>
            
			<?php } ?>
			</tr>
			
           <?php endforeach; ?> 
		  
		  
		  
		   	<tr><td></td><td colspan="2"><strong><?php echo " Total in Amazon UK :-"; ?></strong></td><td><?php $amazon_num = $totalnum_amazon_preevweek; echo $amazon_num; ?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order = $totalorder_amazon_preevweek;  echo round($amazon_order,2); ?></td><?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek1 . "</td><td>" . round($totalorder_amazon_preevweek1,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek2 . "</td><td>" . round($totalorder_amazon_preevweek2,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek3 . "</td><td>" . round($totalorder_amazon_preevweek3,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek4 . "</td><td>" . round($totalorder_amazon_preevweek4,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek5 . "</td><td>" . round($totalorder_amazon_preevweek5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek6 . "</td><td>" . round($totalorder_amazon_preevweek6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek7 . "</td><td>" . round($totalorder_amazon_preevweek7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek8 . "</td><td>" . round($totalorder_amazon_preevweek8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek9 . "</td><td>" . round($totalorder_amazon_preevweek9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek10 . "</td><td>" . round($totalorder_amazon_preevweek10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek11 . "</td><td>" . round($totalorder_amazon_preevweek11,2) ."</td>"; }?>
			
			<!--Start condition After 12 Month  -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekone . "</td><td>" . round($totalorder_amazon_preevweekone,2) ."</td>"; }?>
			<!-- start 14 -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweektwo . "</td><td>" . round($totalorder_amazon_preevweektwo,2) ."</td>"; }?>
			<!-- start 15 -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekthree . "</td><td>" . round($totalorder_amazon_preevweekthree,2) ."</td>"; }?>
			<!-- start 16 -->
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekfour . "</td><td>" . round($totalorder_amazon_preevweekfour,2) ."</td>"; }?>
			<!-- start 17 -->
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekfive . "</td><td>" . round($totalorder_amazon_preevweekfive,2) ."</td>"; }?>						
			<!-- start 18 -->
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweeksix . "</td><td>" . round($totalorder_amazon_preevweeksix,2) ."</td>"; }?>						
			<!-- start 19 -->
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweeksiv . "</td><td>" . round($totalorder_amazon_preevweeksiv,2) ."</td>"; }?>						
			<!-- start 20 -->
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekeaight . "</td><td>" . round($totalorder_amazon_preevweekeaight,2) ."</td>"; }?>						
			<!-- start 21 -->
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweeknin . "</td><td>" . round($totalorder_amazon_preevweeknin,2) ."</td>"; }?>						
			<!-- start 22 -->
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekten . "</td><td>" . round($totalorder_amazon_preevweekten,2) ."</td>"; }?>						
			<!-- start 23 -->
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweekelev . "</td><td>" . round($totalorder_amazon_preevweekelev,2) ."</td>"; }?>						
			<!-- start 24 -->
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweektwel . "</td><td>" . round($totalorder_amazon_preevweektwel,2) ."</td>"; }?>						
			
			<!--End condition After 12 Month  -->			
			<td></td><td></td></tr>		
			
			<tr><td></td><td colspan="2"><strong><?php echo " Total in Amazon Germany :-"; ?></strong></td><td><?php $amazon_num = $totalnum_amazon_preevweek_germany; echo $amazon_num; ?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order = $totalorder_amazon_preevweek_germany;  echo round($amazon_order,2); ?></td><?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany1 . "</td><td>" . round($totalorder_amazon_preevweek_germany1,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany2 . "</td><td>" . round($totalorder_amazon_preevweek_germany2,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany3 . "</td><td>" . round($totalorder_amazon_preevweek_germany3,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany4 . "</td><td>" . round($totalorder_amazon_preevweek_germany4,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany5 . "</td><td>" . round($totalorder_amazon_preevweek_germany5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany6 . "</td><td>" . round($totalorder_amazon_preevweek_germany6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany7 . "</td><td>" . round($totalorder_amazon_preevweek_germany7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany8 . "</td><td>" . round($totalorder_amazon_preevweek_germany8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany9 . "</td><td>" . round($totalorder_amazon_preevweek_germany9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany10 . "</td><td>" . round($totalorder_amazon_preevweek_germany10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germany11 . "</td><td>" . round($totalorder_amazon_preevweek_germany11,2) ."</td>"; }?>
			
			<!--Start condition After 12 Month  -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyone . "</td><td>" . round($totalorder_amazon_preevweek_germanyone,2) ."</td>"; }?>
			<!-- start 14 -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanytwo . "</td><td>" . round($totalorder_amazon_preevweek_germanytwo,2) ."</td>"; }?>
			<!-- start 15 -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanythree . "</td><td>" . round($totalorder_amazon_preevweek_germanythree,2) ."</td>"; }?>
			
			<!-- start 16 -->
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyfour . "</td><td>" . round($totalorder_amazon_preevweek_germanyfour,2) ."</td>"; }?>
				
			<!-- start 17 -->
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyfive . "</td><td>" . round($totalorder_amazon_preevweek_germanyfive,2) ."</td>"; }?>
			
			<!-- start 18 -->
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanysix . "</td><td>" . round($totalorder_amazon_preevweek_germanysix,2) ."</td>"; }?>
			<!-- start 19 -->
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanysiv . "</td><td>" . round($totalorder_amazon_preevweek_germanysiv,2) ."</td>"; }?>
					
			<!-- start 20 -->
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyeaight . "</td><td>" . round($totalorder_amazon_preevweek_germanyeaight,2) ."</td>"; }?>
			<!-- start 21 -->
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanynin . "</td><td>" . round($totalorder_amazon_preevweek_germanynin,2) ."</td>"; }?>
			<!-- start 22 -->
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyten . "</td><td>" . round($totalorder_amazon_preevweek_germanyten,2) ."</td>"; }?>
			<!-- start 23 -->
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanyelev . "</td><td>" . round($totalorder_amazon_preevweek_germanyelev,2) ."</td>"; }?>
			<!-- start 24 -->
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_germanytwel . "</td><td>" . round($totalorder_amazon_preevweek_germanytwel,2) ."</td>"; }?>
				
			<!--End condition After 12 Month  -->
			
			<td></td><td></td></tr>	
			
			<tr><td></td><td colspan="2"><strong><?php echo " Total in Amazon France :-"; ?></strong></td><td><?php $amazon_num = $totalnum_amazon_preevweek_france; echo $amazon_num; ?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order = $totalorder_amazon_preevweek_france;  echo round($amazon_order,2); ?></td><?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france1 . "</td><td>" . round($totalorder_amazon_preevweek_france1,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france2 . "</td><td>" . round($totalorder_amazon_preevweek_france2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france3 . "</td><td>" . round($totalorder_amazon_preevweek_france3,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france4 . "</td><td>" . round($totalorder_amazon_preevweek_france4,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france5 . "</td><td>" . round($totalorder_amazon_preevweek_france5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france6 . "</td><td>" . round($totalorder_amazon_preevweek_france6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france7 . "</td><td>" . round($totalorder_amazon_preevweek_france7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france8 . "</td><td>" . round($totalorder_amazon_preevweek_france8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france9 . "</td><td>" . round($totalorder_amazon_preevweek_france9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france10 . "</td><td>" . round($totalorder_amazon_preevweek_france10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_france11 . "</td><td>" . round($totalorder_amazon_preevweek_france11,2) ."</td>"; }?>
			
			<!--Start condition After 12 Month  -->			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_franceone . "</td><td>" . round($totalorder_amazon_preevweek_franceone,2) ."</td>"; }?>
			<!-- start 14 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francetwo . "</td><td>" . round($totalorder_amazon_preevweek_francetwo,2) ."</td>"; }?>
			<!-- start 15 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francethree . "</td><td>" . round($totalorder_amazon_preevweek_francethree,2) ."</td>"; }?>
			
			<!-- start 16 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francefour . "</td><td>" . round($totalorder_amazon_preevweek_francefour,2) ."</td>"; }?>
			
			<!-- start 17 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francefive . "</td><td>" . round($totalorder_amazon_preevweek_francefive,2) ."</td>"; }?>
			
			<!-- start 18 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francesix . "</td><td>" . round($totalorder_amazon_preevweek_francesix,2) ."</td>"; }?>
			<!-- start 19 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francesiv . "</td><td>" . round($totalorder_amazon_preevweek_francesiv,2) ."</td>"; }?>
			<!-- start 20 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_franceeaight . "</td><td>" . round($totalorder_amazon_preevweek_franceeaight,2) ."</td>"; }?>
			<!-- start 21 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francenin . "</td><td>" . round($totalorder_amazon_preevweek_francenin,2) ."</td>"; }?>
			<!-- start 22 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francenin . "</td><td>" . round($totalorder_amazon_preevweek_francenin,2) ."</td>"; }?>
			<!-- start 23 -->			
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francenin . "</td><td>" . round($totalorder_amazon_preevweek_francenin,2) ."</td>"; }?>
			<!-- start 24 -->			
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_francenin . "</td><td>" . round($totalorder_amazon_preevweek_francenin,2) ."</td>"; }?>
								
			<!--End condition After 12 Month  -->
			<td></td><td></td></tr>
			
			<tr><td></td><td colspan="2"><strong><?php echo " Total in Amazon Spain :-"; ?></strong></td><td><?php $amazon_num = $totalnum_amazon_preevweek_spain; echo $amazon_num; ?></td><?php if(($session->read('Auth.User.group_id')!='5')){ ?><td><?php $amazon_order = $totalorder_amazon_preevweek_spain;  echo round($amazon_order,2); ?></td><?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain1 . "</td><td>" . round($totalorder_amazon_preevweek_spain1,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain2 . "</td><td>" . round($totalorder_amazon_preevweek_spain2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain3 . "</td><td>" . round($totalorder_amazon_preevweek_spain3,2) ."</td>"; }?>
			  <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain4 . "</td><td>" . round($totalorder_amazon_preevweek_spain4,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain5 . "</td><td>" . round($totalorder_amazon_preevweek_spain5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain6 . "</td><td>" . round($totalorder_amazon_preevweek_spain6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain7 . "</td><td>" . round($totalorder_amazon_preevweek_spain7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain8 . "</td><td>" . round($totalorder_amazon_preevweek_spain8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain9 . "</td><td>" . round($totalorder_amazon_preevweek_spain9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain10 . "</td><td>" . round($totalorder_amazon_preevweek_spain10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spain11 . "</td><td>" . round($totalorder_amazon_preevweek_spain11,2) ."</td>"; }?>
			
			<!--Start condition After 12 Month  -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainone . "</td><td>" . round($totalorder_amazon_preevweek_spainone,2) ."</td>"; }?>
					
			<!-- start 14 -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spaintwo . "</td><td>" . round($totalorder_amazon_preevweek_spaintwo,2) ."</td>"; }?>
			
			<!-- start 15 -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainthree . "</td><td>" . round($totalorder_amazon_preevweek_spainthree,2) ."</td>"; }?>
			
			<!-- start 16 -->
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainfour . "</td><td>" . round($totalorder_amazon_preevweek_spainfour,2) ."</td>"; }?>
			<!-- start 17 -->
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainfive . "</td><td>" . round($totalorder_amazon_preevweek_spainfive,2) ."</td>"; }?>
			<!-- start 18 -->
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainsix . "</td><td>" . round($totalorder_amazon_preevweek_spainsix,2) ."</td>"; }?>
			<!-- start 19 -->
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainsiv . "</td><td>" . round($totalorder_amazon_preevweek_spainsiv,2) ."</td>"; }?>
			<!-- start 20 -->
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spaineaight . "</td><td>" . round($totalorder_amazon_preevweek_spaineaight,2) ."</td>"; }?>
			<!-- start 21 -->
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainnin . "</td><td>" . round($totalorder_amazon_preevweek_spainnin,2) ."</td>"; }?>
			<!-- start 22 -->
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainten . "</td><td>" . round($totalorder_amazon_preevweek_spainten,2) ."</td>"; }?>
			<!-- start 23 -->
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spainelev . "</td><td>" . round($totalorder_amazon_preevweek_spainelev,2) ."</td>"; }?>
			<!-- start 24 -->
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			<?php echo "<td>". $totalnum_amazon_preevweek_spaintwel . "</td><td>" . round($totalorder_amazon_preevweek_spaintwel,2) ."</td>"; }?>
			
			
			<!--End condition After 12 Month  -->
			<td></td><td></td></tr>	
			
			<tr><td></td><td colspan="2"><?php echo " Total in GBP"; ?></td><td><?php echo $Totalnumbsumegbp; ?></td><td><?php echo round($Totalordersumegbp,2); ?></td>
			
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp1 . "</td><td>" . round($Totalordersumegbp1,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp2 . "</td><td>" . round($Totalordersumegbp2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp3 . "</td><td>" . round($Totalordersumegbp3,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp4 . "</td><td>" . round($Totalordersumegbp4,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp5 . "</td><td>" . round($Totalordersumegbp5,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp6 . "</td><td>" . round($Totalordersumegbp6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $Totalnumbsumegbp7 . "</td><td>" . round($Totalordersumegbp7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumegbp8 . "</td><td>" . round($Totalordersumegbp8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $Totalnumbsumegbp9 . "</td><td>" . round($Totalordersumegbp9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbp10 . "</td><td>" . round($Totalordersumegbp10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbp13 . "</td><td>" . round($Totalordersumegbp13,2) ."</td>"; }?>
			
			<!--Start condition After 12 Month  -->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpone . "</td><td>" . round($Totalordersumegbpone,2) ."</td>"; }?>
			
			<!-- start 14 -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbptwo . "</td><td>" . round($Totalordersumegbptwo,2) ."</td>"; }?>
			
			<!-- start 15 -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpthree . "</td><td>" . round($Totalordersumegbpthree,2) ."</td>"; }?>
			
			<!-- start 16 -->
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpfour . "</td><td>" . round($Totalordersumegbpfour,2) ."</td>"; }?>
			<!-- start 17 -->
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpfive . "</td><td>" . round($Totalordersumegbpfive,2) ."</td>"; }?>
			
			<!-- start 18 -->
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpsix . "</td><td>" . round($Totalordersumegbpsix,2) ."</td>"; }?>
			<!-- start 19 -->
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpsiv . "</td><td>" . round($Totalordersumegbpsiv,2) ."</td>"; }?>
			
			<!-- start 20 -->
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpeaight . "</td><td>" . round($Totalordersumegbpeaight,2) ."</td>"; }?>
			
			<!-- start 21 -->
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpnin . "</td><td>" . round($Totalordersumegbpnin,2) ."</td>"; }?>
			
			<!-- start 22 -->
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpten . "</td><td>" . round($Totalordersumegbpten,2) ."</td>"; }?>
			
			<!-- start 23 -->
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumegbpelev . "</td><td>" . round($Totalordersumegbpelev,2) ."</td>"; }?>
			
			<!-- start 24 -->
			<?php if((!empty($month_interval)) && ($month_interval=='24')){  ?>
			<?php echo "<td>". $Totalnumbsumegbptwel . "</td><td>" . round($Totalordersumegbptwel,2) ."</td>"; }?>
			
			
			<!--End condition After 12 Month  -->
			
			
			<td colspan="2"></td></tr>
			<tr><td></td><td colspan="2"><?php echo " Total in EUR"; ?></td><td><?php echo $Totalnumbsumeur; ?></td><td><?php echo round($Totalordersumeur,2); ?></td>
			 <?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur1 . "</td><td>" . round($Totalordersumeur1,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur2 . "</td><td>" . round($Totalordersumeur2,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='4')  || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur3 . "</td><td>" . round($Totalordersumeur3,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur4 . "</td><td>" . round($Totalordersumeur4,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur5 . "</td><td>" . round($Totalordersumeur5,2) ."</td>"; }?>
			 <?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8')  || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>			 
			<?php echo "<td>". $Totalnumbsumeur6 . "</td><td>" . round($Totalordersumeur6,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $Totalnumbsumeur7 . "</td><td>" . round($Totalordersumeur7,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php echo "<td>". $Totalnumbsumeur8 . "</td><td>" . round($Totalordersumeur8,2) ."</td>"; }?>			
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){?>
			<?php echo "<td>". $Totalnumbsumeur9 . "</td><td>" . round($Totalordersumeur9,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeur10 . "</td><td>" . round($Totalordersumeur10,2) ."</td>"; }?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeur13 . "</td><td>" . round($Totalordersumeur13,2) ."</td>"; }?>
						
			<!--Start condition After 12 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurone . "</td><td>" . round($Totalordersumeurone,2) ."</td>"; }?>
			<!--Start 14 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurtwo . "</td><td>" . round($Totalordersumeurtwo,2) ."</td>"; }?>
			<!--Start 15 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurthree . "</td><td>" . round($Totalordersumeurthree,2) ."</td>"; }?>
		
			<!--Start 16 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurfour . "</td><td>" . round($Totalordersumeurfour,2) ."</td>"; }?>
			<!--Start 17 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurfive . "</td><td>" . round($Totalordersumeurfive,2) ."</td>"; }?>
			
			<!--Start 18 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeursix . "</td><td>" . round($Totalordersumeursix,2) ."</td>"; }?>
			<!--Start 19 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeursiv . "</td><td>" . round($Totalordersumeursiv,2) ."</td>"; }?>
			<!--Start 20 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeureaight . "</td><td>" . round($Totalordersumeureaight,2) ."</td>"; }?>
			
			<!--Start 21 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurnin . "</td><td>" . round($Totalordersumeurnin,2) ."</td>"; }?>
			
			<!--Start 22 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurten . "</td><td>" . round($Totalordersumeurten,2) ."</td>"; }?>
			
			<!--Start 23 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurelev . "</td><td>" . round($Totalordersumeurelev,2) ."</td>"; }?>
			
			<!--Start 24 Month  -->
			<?php if((!empty($month_interval)) && (($month_interval=='24'))){  ?>
			<?php echo "<td>". $Totalnumbsumeurtwel . "</td><td>" . round($Totalordersumeurtwel,2) ."</td>"; }?>
			
			<!--End condition After 12 Month  -->
			<td colspan="2"></td></tr>
			
    </table>
 </div>
<script type="text/javascript">
$.noConflict();  //Not to conflict with other scripts
jQuery(document).ready(function($) {
$("#date_from").datepicker({
    minDate: '-2Y-0M',
	numberOfMonths: 2,
    maxDate: '0',
    onSelect: function (dateStr) {
        var min = $(this).datepicker('getDate'); // Get selected date
        $("#date_to").datepicker('option', 'minDate', min || '+2Y+6M'); // Set other min, default to today
    }
});

$("#date_to").datepicker({
numberOfMonths: 2,
    minDate: '-2Y-0M',
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