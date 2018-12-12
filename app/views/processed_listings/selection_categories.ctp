<?php  //echo"<div class='bgimg'><div class='middle'><h1>COMING SOON</h1></div><div class='bottomleft'><p>Site under maintenance</p></div></div>"; die();
if(($session->read('Auth.User.group_id')!='4'))
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<hr>
<?php  //print_r($query_date); die(); ?>
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
    <!--<table id="header-fixed" class="table table-bordered table-striped table-hover"></table>-->
   <table id="table-1" class="table table-bordered table-striped table-hover">
        <thead><tr><td><strong><?php __('Category name');?></strong></td>		
		<?php $i = 0; $len = count($query_date); foreach($query_date as $firstandlast){  $yrdata = strtotime($firstandlast);   if ($i == $len - 1){ }else {?><td><table class="table table-bordered table-striped table-hover"><tr><td width="100px" colspan="2"><strong><?php echo date('M-Y', $yrdata); $i++; ?></strong></td></tr>
			<tr><td width="100px">No of Orders</td><td width="100px">Order values</td></tr></table></td><?php } ?><?php } ?>
			<td width="100px"><strong><?php __('Total No of Order'); ?></strong></td>
			<td width="100px"><strong><?php __('Total Order vlues'); ?></strong></td></tr></thead>
			<?php    $a = '0'; foreach ($countselectdates as $value): ?>  
			<?php $b = $value['ProcessedListing']['cat_name']; ?>			
			
			<?php $Totalnumbsumeur = array(); $Totalnumbsumegbp = array();  $Totalordersumeur = array();  $Totalordersumegbp = array(); ?>
		    <?php foreach ($Catsaveall as $currentsweeks): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur[] = $currentsweeks[0]['orderid']; $Totalordersumeur[] = $currentsweeks[0]['ordervalues']*0.89;}else if($currentsweeks['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp[] = $currentsweeks[0]['orderid'];  $Totalordersumegbp[] = $currentsweeks[0]['ordervalues'];} ?>
           <?php } ?>
		   <?php endforeach; ?> 		   
		   <?php $TotalNumb = $Totalnumbsumeur[0]+$Totalnumbsumegbp[0]; $TotalOrder = $Totalordersumeur[0]+$Totalordersumegbp[0]; ?>
           
		   <?php $Totalnumbsumeur1 = array(); $Totalnumbsumegbp1 = array();  $Totalordersumeur1 = array();  $Totalordersumegbp1 = array(); ?>
		    <?php foreach ($Catsaveall1 as $currentweek1): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweek1['ProcessedListing']['cat_name'])) {?>
			<?php if($currentweek1['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur1[] = $currentweek1[0]['orderid']; $Totalordersumeur1[] = $currentweek1[0]['ordervalues']*0.89;}else if($currentweek1['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp1[] = $currentweek1[0]['orderid'];  $Totalordersumegbp1[] = $currentweek1[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb1 = $Totalnumbsumeur1[0]+$Totalnumbsumegbp1[0]; $TotalOrder1 = $Totalordersumeur1[0]+$Totalordersumegbp1[0];  ?>
			
			
		   <?php $Totalnumbsumeur2 = array(); $Totalnumbsumegbp2 = array();  $Totalordersumeur2 = array();  $Totalordersumegbp2 = array(); ?>
		    <?php foreach ($Catsaveall2 as $currentsweeks2): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks2['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks2['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur2[] = $currentsweeks2[0]['orderid']; $Totalordersumeur2[] = $currentsweeks2[0]['ordervalues']*0.89;}else if($currentsweeks2['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp2[] = $currentsweeks2[0]['orderid'];  $Totalordersumegbp2[] = $currentsweeks2[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb2 = $Totalnumbsumeur2[0]+$Totalnumbsumegbp2[0]; $TotalOrder2 = $Totalordersumeur2[0]+$Totalordersumegbp2[0];  ?>
			
			<?php $Totalnumbsumeur3 = array(); $Totalnumbsumegbp3 = array();  $Totalordersumeur3 = array();  $Totalordersumegbp3 = array(); ?>
			<?php foreach ($Catsaveall3 as $currentsweek3): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek3['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek3['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur3[] = $currentsweek3[0]['orderid']; $Totalordersumeur3[] = $currentsweek3[0]['ordervalues']*0.89;}else if($currentsweek3['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp3[] = $currentsweek3[0]['orderid'];  $Totalordersumegbp3[] = $currentsweek3[0]['ordervalues'];} ?>
            <?php } ?>
            <?php endforeach; ?>			
			<?php  $TotalNumb3 = $Totalnumbsumeur3[0]+$Totalnumbsumegbp3[0]; $TotalOrder3 = $Totalordersumeur3[0]+$Totalordersumegbp3[0];  ?>
			
			<?php $Totalnumbsumeur4 = array(); $Totalnumbsumegbp4 = array();  $Totalordersumeur4 = array();  $Totalordersumegbp4 = array(); ?>
			<?php foreach ($Catsaveall4 as $currentsweeks4): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks4['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks4['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur4[] = $currentsweeks4[0]['orderid']; $Totalordersumeur4[] = $currentsweeks4[0]['ordervalues']*0.89;}else if($currentsweeks4['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp4[] = $currentsweeks4[0]['orderid'];  $Totalordersumegbp4[] = $currentsweeks4[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>
			<?php $TotalNumb4 = $Totalnumbsumeur4[0]+$Totalnumbsumegbp4[0]; $TotalOrder4 = $Totalordersumeur4[0]+$Totalordersumegbp4[0];  ?>
			
			<?php $Totalnumbsumeur5 = array(); $Totalnumbsumegbp5 = array();  $Totalordersumeur5 = array();  $Totalordersumegbp5 = array(); ?>
			<?php foreach ($Catsaveall5 as $currentsweeks5): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweeks5['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweeks5['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur5[] = $currentsweeks5[0]['orderid']; $Totalordersumeur5[] = $currentsweeks5[0]['ordervalues']*0.89;}else if($currentsweeks5['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp5[] = $currentsweeks5[0]['orderid'];  $Totalordersumegbp5[] = $currentsweeks5[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>			
			<?php $TotalNumb5 = $Totalnumbsumeur5[0]+$Totalnumbsumegbp5[0]; $TotalOrder5 = $Totalordersumeur5[0]+$Totalordersumegbp5[0]; ?>
			
			<?php $Totalnumbsumeur6 = array(); $Totalnumbsumegbp6 = array();  $Totalordersumeur6 = array();  $Totalordersumegbp6 = array(); ?>
			<?php foreach ($Catsaveall6 as $currentsweek6): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek6['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek6['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur6[] = $currentsweek6[0]['orderid']; $Totalordersumeur6[] = $currentsweek6[0]['ordervalues']*0.89;}else if($currentsweek6['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp6[] = $currentsweek6[0]['orderid'];  $Totalordersumegbp6[] = $currentsweek6[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb6 = $Totalnumbsumeur6[0]+$Totalnumbsumegbp6[0]; $TotalOrder6 = $Totalordersumeur6[0]+$Totalordersumegbp6[0]; ?>
			
			<?php $Totalnumbsumeur7 = array(); $Totalnumbsumegbp7 = array();  $Totalordersumeur7 = array();  $Totalordersumegbp7 = array(); ?>
			<?php foreach ($Catsaveall7 as $currentsweek7): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek7['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek7['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur7[] = $currentsweek7[0]['orderid']; $Totalordersumeur7[] = $currentsweek7[0]['ordervalues']*0.89;}else if($currentsweek7['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp7[] = $currentsweek7[0]['orderid'];  $Totalordersumegbp7[] = $currentsweek7[0]['ordervalues'];} ?>
            <?php  } ?>
            <?php endforeach; ?>			
			<?php $TotalNumb7 = $Totalnumbsumeur7[0]+$Totalnumbsumegbp7[0]; $TotalOrder7 = $Totalordersumeur7[0]+$Totalordersumegbp7[0];  ?>
			
			<?php $Totalnumbsumeur8 = array(); $Totalnumbsumegbp8 = array();  $Totalordersumeur8 = array();  $Totalordersumegbp8 = array(); ?>
			<?php foreach ($Catsaveall8 as $currentsweek8): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek8['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek8['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur8[] = $currentsweek8[0]['orderid']; $Totalordersumeur8[] = $currentsweek8[0]['ordervalues']*0.89;}else if($currentsweek8['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp8[] = $currentsweek8[0]['orderid'];  $Totalordersumegbp8[] = $currentsweek8[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb8 = $Totalnumbsumeur8[0]+$Totalnumbsumegbp8[0]; $TotalOrder8 = $Totalordersumeur8[0]+$Totalordersumegbp8[0];?>
         
			<?php $Totalnumbsumeur9 = array(); $Totalnumbsumegbp9 = array();  $Totalordersumeur9 = array();  $Totalordersumegbp9 = array(); ?>
			<?php foreach ($Catsaveall9 as $currentsweek9): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek9['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek9['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur9[] = $currentsweek9[0]['orderid']; $Totalordersumeur9[] = $currentsweek9[0]['ordervalues']*0.89;}else if($currentsweek9['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp9[] = $currentsweek9[0]['orderid'];  $Totalordersumegbp9[] = $currentsweek9[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb9 = $Totalnumbsumeur9[0]+$Totalnumbsumegbp9[0]; $TotalOrder9 = $Totalordersumeur9[0]+$Totalordersumegbp9[0];?>
         
		 	<?php $Totalnumbsumeur12 = array(); $Totalnumbsumegbp12 = array();  $Totalordersumeur12 = array();  $Totalordersumegbp12 = array(); ?>
			<?php foreach ($Catsaveall12 as $currentsweek10): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek10['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek10['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur12[] = $currentsweek10[0]['orderid']; $Totalordersumeur12[] = $currentsweek10[0]['ordervalues']*0.89;}else if($currentsweek10['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp12[] = $currentsweek10[0]['orderid'];  $Totalordersumegbp12[] = $currentsweek10[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb10 = $Totalnumbsumeur12[0]+$Totalnumbsumegbp12[0]; $TotalOrder10 = $Totalordersumeur12[0]+$Totalordersumegbp12[0];?>

					
			<?php $Totalnumbsumeur13 = array(); $Totalnumbsumegbp13 = array();  $Totalordersumeur13 = array();  $Totalordersumegbp13 = array(); ?>
			<?php foreach ($Catsaveall13 as $currentsweek13): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentsweek13['ProcessedListing']['cat_name'])) {?>
			<?php if($currentsweek13['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeur13[] = $currentsweek13[0]['orderid']; $Totalordersumeur13[] = $currentsweek13[0]['ordervalues']*0.89;}else if($currentsweek13['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbp13[] = $currentsweek13[0]['orderid'];  $Totalordersumegbp13[] = $currentsweek13[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumb13 = $Totalnumbsumeur13[0]+$Totalnumbsumegbp13[0]; $TotalOrder13 = $Totalordersumeur13[0]+$Totalordersumegbp13[0];?>
         		
			<!-- Start 13 Month -->
			
			<?php $Totalnumbsumeurone = array(); $Totalnumbsumegbpone = array();  $Totalordersumeurone = array();  $Totalordersumegbpone = array(); ?>
			<?php foreach ($Catsaveaone as $Catsavea1): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsavea1['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsavea1['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurone[] = $Catsavea1[0]['orderid']; $Totalordersumeurone[] = $Catsavea1[0]['ordervalues']*0.89;}else if($Catsavea1['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpone[] = $Catsavea1[0]['orderid'];  $Totalordersumegbpone[] = $Catsavea1[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbone = $Totalnumbsumeurone[0]+$Totalnumbsumegbpone[0]; $TotalOrderone = $Totalordersumeurone[0]+$Totalordersumegbpone[0];?>
         		
			<?php $Totalnumbsumeurtwo = array(); $Totalnumbsumegbptwo = array();  $Totalordersumeurtwo = array();  $Totalordersumegbptwo = array(); ?>
			<?php foreach ($Catsaveatwo as $Catsaveatw): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveatw['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveatw['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurtwo[] = $Catsaveatw[0]['orderid']; $Totalordersumeurtwo[] = $Catsaveatw[0]['ordervalues']*0.89;}else if($Catsaveatw['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbptwo[] = $Catsaveatw[0]['orderid'];  $Totalordersumegbptwo[] = $Catsaveatw[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbtwo = $Totalnumbsumeurtwo[0]+$Totalnumbsumegbptwo[0]; $TotalOrdertwo = $Totalordersumeurtwo[0]+$Totalordersumegbptwo[0];?>
         		
					
			<?php $Totalnumbsumeurfive = array(); $Totalnumbsumegbpfive = array();  $Totalordersumeurfive = array();  $Totalordersumegbpfive = array(); ?>
			<?php foreach ($Catsaveafives as $Catsaveafive): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveafive['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveafive['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurfive[] = $Catsaveafive[0]['orderid']; $Totalordersumeurfive[] = $Catsaveafive[0]['ordervalues']*0.89;}else if($Catsaveafive['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpfive[] = $Catsaveafive[0]['orderid'];  $Totalordersumegbpfive[] = $Catsaveafive[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbfive = $Totalnumbsumeurfive[0]+$Totalnumbsumegbpfive[0]; $TotalOrderfive = $Totalordersumeurfive[0]+$Totalordersumegbpfive[0];?>
         		
					
			<?php $Totalnumbsumeursix = array(); $Totalnumbsumegbpsix = array();  $Totalordersumeursix = array();  $Totalordersumegbpsix = array(); ?>
			<?php foreach ($Catsaveasixes as $Catsaveasix): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveasix['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveasix['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeursix[] = $Catsaveasix[0]['orderid']; $Totalordersumeursix[] = $Catsaveasix[0]['ordervalues']*0.89;}else if($Catsaveasix['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpsix[] = $Catsaveasix[0]['orderid'];  $Totalordersumegbpsix[] = $Catsaveasix[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbsix = $Totalnumbsumeursix[0]+$Totalnumbsumegbpsix[0]; $TotalOrdersix = $Totalordersumeursix[0]+$Totalordersumegbpsix[0];?>
         	
					
			<?php $Totalnumbsumeursev = array(); $Totalnumbsumegbpsev = array();  $Totalordersumeursev = array();  $Totalordersumegbpsev = array(); ?>
			<?php foreach ($Catsaveaseves as $Catsaveaseve): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveaseve['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveaseve['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeursev[] = $Catsaveaseve[0]['orderid']; $Totalordersumeursev[] = $Catsaveaseve[0]['ordervalues']*0.89;}else if($Catsaveaseve['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpsev[] = $Catsaveaseve[0]['orderid'];  $Totalordersumegbpsev[] = $Catsaveaseve[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbsev = $Totalnumbsumeursev[0]+$Totalnumbsumegbpsev[0]; $TotalOrdersev = $Totalordersumeursev[0]+$Totalordersumegbpsev[0];?>
         		
					
			<?php $Totalnumbsumeureight = array(); $Totalnumbsumegbpeight = array();  $Totalordersumeureight = array();  $Totalordersumegbpeight = array(); ?>
			<?php foreach ($Catsaveaeights as $Catsaveaeight): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveaeight['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveaeight['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeureight[] = $Catsaveaeight[0]['orderid']; $Totalordersumeureight[] = $Catsaveaeight[0]['ordervalues']*0.89;}else if($Catsaveaeight['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpeight[] = $Catsaveaeight[0]['orderid'];  $Totalordersumegbpeight[] = $Catsaveaeight[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbeight = $Totalnumbsumeureight[0]+$Totalnumbsumegbpeight[0]; $TotalOrdereight = $Totalordersumeureight[0]+$Totalordersumegbpeight[0];?>
         		
			<?php $Totalnumbsumeurnin = array(); $Totalnumbsumegbpnin = array();  $Totalordersumeurnin = array();  $Totalordersumegbpnin = array(); ?>
			<?php foreach ($Catsavnines as $Catsavnine): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsavnine['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsavnine['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurnin[] = $Catsavnine[0]['orderid']; $Totalordersumeurnin[] = $Catsavnine[0]['ordervalues']*0.89;}else if($Catsavnine['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpnin[] = $Catsavnine[0]['orderid'];  $Totalordersumegbpnin[] = $Catsavnine[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbnin = $Totalnumbsumeurnin[0]+$Totalnumbsumegbpnin[0]; $TotalOrdernin = $Totalordersumeurnin[0]+$Totalordersumegbpnin[0];?>
         		
				
			<?php $Totalnumbsumeurten = array(); $Totalnumbsumegbpten = array();  $Totalordersumeurten = array();  $Totalordersumegbpten = array(); ?>
			<?php foreach ($Catsavetens as $Catsaveten): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveten['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveten['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurten[] = $Catsaveten[0]['orderid']; $Totalordersumeurten[] = $Catsaveten[0]['ordervalues']*0.89;}else if($Catsaveten['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpten[] = $Catsaveten[0]['orderid'];  $Totalordersumegbpten[] = $Catsaveten[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbten = $Totalnumbsumeurten[0]+$Totalnumbsumegbpten[0]; $TotalOrderten = $Totalordersumeurten[0]+$Totalordersumegbpten[0];?>
         	
			<?php $Totalnumbsumeurelev = array(); $Totalnumbsumegbpelev = array();  $Totalordersumeurelev = array();  $Totalordersumegbpelev = array(); ?>
			<?php foreach ($Catsaveaelevs as $Catsaveaelev): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveaelev['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveaelev['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurelev[] = $Catsaveaelev[0]['orderid']; $Totalordersumeurelev[] = $Catsaveaelev[0]['ordervalues']*0.89;}else if($Catsaveaelev['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpelev[] = $Catsaveaelev[0]['orderid'];  $Totalordersumegbpelev[] = $Catsaveaelev[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbelev = $Totalnumbsumeurelev[0]+$Totalnumbsumegbpelev[0]; $TotalOrderelev = $Totalordersumeurelev[0]+$Totalordersumegbpelev[0];?>
         				
			
			<?php $Totalnumbsumeurtwel = array(); $Totalnumbsumegbptwel = array();  $Totalordersumeurtwel = array();  $Totalordersumegbptwel = array(); ?>
			<?php foreach ($Catsaveatweles as $Catsaveatwel): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveatwel['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveatwel['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurtwel[] = $Catsaveatwel[0]['orderid']; $Totalordersumeurtwel[] = $Catsaveatwel[0]['ordervalues']*0.89;}else if($Catsaveatwel['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbptwel[] = $Catsaveatwel[0]['orderid'];  $Totalordersumegbptwel[] = $Catsaveatwel[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbtwel = $Totalnumbsumeurtwel[0]+$Totalnumbsumegbptwel[0]; $TotalOrdertwel = $Totalordersumeurtwel[0]+$Totalordersumegbptwel[0];?>
         				
			<?php $Totalnumbsumeurthrety = array(); $Totalnumbsumegbpthrety = array();  $Totalordersumeurthrety = array();  $Totalordersumegbpthrety = array(); ?>
			<?php foreach ($Catsaveathretyes as $Catsaveathrety): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveathrety['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveathrety['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurthrety[] = $Catsaveathrety[0]['orderid']; $Totalordersumeurthrety[] = $Catsaveathrety[0]['ordervalues']*0.89;}else if($Catsaveathrety['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpthrety[] = $Catsaveathrety[0]['orderid'];  $Totalordersumegbpthrety[] = $Catsaveathrety[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbthrety = $Totalnumbsumeurthrety[0]+$Totalnumbsumegbpthrety[0]; $TotalOrderthrety = $Totalordersumeurthrety[0]+$Totalordersumegbpthrety[0];?>
         				
			<?php $Totalnumbsumeurforthy = array(); $Totalnumbsumegbpforthy= array();  $Totalordersumeurforthy = array();  $Totalordersumegbpforthy = array(); ?>
			<?php foreach ($Catsaveaforthyes as $Catsaveaforthy): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $Catsaveaforthy['ProcessedListing']['cat_name'])) {?>
			<?php if($Catsaveaforthy['ProcessedListing']['currency'] ==='EUR'){ $Totalnumbsumeurforthy[] = $Catsaveaforthy[0]['orderid']; $Totalordersumeurforthy[] = $Catsaveaforthy[0]['ordervalues']*0.89;}else if($Catsaveaforthy['ProcessedListing']['currency'] ==='GBP'){ $Totalnumbsumegbpforthy[] = $Catsaveaforthy[0]['orderid'];  $Totalordersumegbpforthy[] = $Catsaveaforthy[0]['ordervalues'];} ?>
            <?php   } ?>
            <?php endforeach; ?>
			<?php $TotalNumbforthy = $Totalnumbsumeurforthy[0]+$Totalnumbsumegbpforthy[0]; $TotalOrderforthy = $Totalordersumeurforthy[0]+$Totalordersumegbpforthy[0];?>
         				
			
			<!-- End 22 Month --->
			
			<?php if($a!==$b){ echo "<tr><td colspan='28'><div class='accordion sale-by-category'><table class='table-responsive category'><tr><td class='width10'><table class='table-responsive table-bordered'><tr><td class='width10'>".$b."</td></tr></table></td><td class='width60'><table class='table-responsive table-bordered'><tr>"; ?>
			
			<?php echo "<td width='100px'>". $TotalNumb ."</td><td width='100px'>" .  round($TotalOrder,2) . "</td>"; ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb1 ."</td><td width='100px'>" .  round($TotalOrder1,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb2 ."</td><td width='100px'>" .  round($TotalOrder2,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb3 ."</td><td width='100px'>" .  round($TotalOrder3,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb4 ."</td><td width='100px'>" .  round($TotalOrder4,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb5 ."</td><td width='100px'>" .  round($TotalOrder5,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			 <?php  echo "<td width='100px'>". $TotalNumb6 ."</td><td width='100px'>" .  round($TotalOrder6,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb7 ."</td><td width='100px'>" .  round($TotalOrder7,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb8 ."</td><td width='100px'>" .  round($TotalOrder8,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb9 ."</td><td width='100px'>" .  round($TotalOrder9,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb10 ."</td><td width='100px'>" .  round($TotalOrder10,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumb13 ."</td><td width='100px'>" .  round($TotalOrder13,2) . "</td>"; ?>
			<?php } ?>
			
			<!-- Start 13 Month   -->
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbone ."</td><td width='100px'>" .  round($TotalOrderone,2) . "</td>"; ?>
			<?php } ?>			
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbtwo ."</td><td width='100px'>" .  round($TotalOrdertwo,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbfive ."</td><td width='100px'>" .  round($TotalOrderfive,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbsix ."</td><td width='100px'>" .  round($TotalOrdersix,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbsev ."</td><td width='100px'>" .  round($TotalOrdersev,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbeight ."</td><td width='100px'>" .  round($TotalOrdereight,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbnin ."</td><td width='100px'>" .  round($TotalOrdernin,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbten ."</td><td width='100px'>" .  round($TotalOrderten,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbelev ."</td><td width='100px'>" .  round($TotalOrderelev,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && ($month_interval=='22')){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbtwel ."</td><td width='100px'>" .  round($TotalOrdertwel,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbthrety ."</td><td width='100px'>" .  round($TotalOrderthrety,2) . "</td>"; ?>
			<?php } ?>
			<?php if((!empty($month_interval)) && ($month_interval=='24')){ ?>
			<?php  echo "<td width='100px'>". $TotalNumbforthy ."</td><td width='100px'>" .  round($TotalOrderforthy,2) . "</td>"; ?>
			<?php } ?>
			
			
		<!-- End 16 Month -->
		
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
		<?php } else if((!empty($month_interval)) && ($month_interval=='12')){ ?>
		<?php  $sums13 = $TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sums13; ?>
		<!-- Start 13 Month   -->
		<?php } else if((!empty($month_interval)) && ($month_interval=='13')){ ?>
		<?php  $sumsone = $TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumsone; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='14')){ ?>
		<?php  $sumstwo = $TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumstwo; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='15')){ ?>
		<?php  $sumsfive = $TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumsfive; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='16')){ ?>
		<?php  $sumssix = $TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumssix; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='17')){ ?>
		<?php  $sumssev = $TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumssev; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='18')){ ?>
		<?php  $sumseight = $TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumseight; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='19')){ ?>
		<?php  $sumnin = $TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumnin; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='20')){ ?>
		<?php  $sumten = $TotalNumbten+$TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumten; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='21')){ ?>
		<?php  $sumelev = $TotalNumbelev+$TotalNumbten+$TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumelev; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='22')){ ?>
		<?php  $sumtwel = $TotalNumbtwel+$TotalNumbelev+$TotalNumbten+$TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumtwel; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='23')){ ?>
		<?php  $sumthrety = $TotalNumbthrety+$TotalNumbtwel+$TotalNumbelev+$TotalNumbten+$TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumthrety; ?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='24')){ ?>
		<?php  $sumthrety = $TotalNumbforthy+$TotalNumbthrety+$TotalNumbtwel+$TotalNumbelev+$TotalNumbten+$TotalNumbnin+$TotalNumbeight+$TotalNumbsev+$TotalNumbsix+$TotalNumbfive+$TotalNumbtwo+$TotalNumbone+$TotalNumb13+$TotalNumb10+$TotalNumb9+$TotalNumb8+$TotalNumb7+$TotalNumb6+$TotalNumb5+$TotalNumb4+$TotalNumb3+$TotalNumb2+TotalNumb1+$TotalNumb; echo $sumthrety; ?>
		<!-- End 16 Month   -->
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
		<?php } else if((!empty($month_interval)) && ($month_interval=='12')){ ?>
		<?php $toorder13 = $TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorder13,2);?>
		<!-- Start 13 Month   -->
		<?php } else if((!empty($month_interval)) && ($month_interval=='13')){ ?>
		<?php $toorderone = $TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderone,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='14')){ ?>
		<?php $toordertwo = $TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordertwo,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='15')){ ?>
		<?php $toorderfive = $TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderfive,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='16')){ ?>
		<?php $toordersix = $TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordersix,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='17')){ ?>
		<?php $toordersev = $TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordersev,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='18')){ ?>
		<?php $toordereight = $TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordereight,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='19')){ ?>
		<?php $toordernin = $TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordernin,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='20')){ ?>
		<?php $toorderten = $TotalOrderten+$TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderten,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='21')){ ?>
		<?php $toorderelev = $TotalOrderelev+$TotalOrderten+$TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderelev,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='22')){ ?>
		<?php $toordertwel = $TotalOrdertwel+$TotalOrderelev+$TotalOrderten+$TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toordertwel,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='23')){ ?>
		<?php $toorderthrety = $TotalOrderthrety+$TotalOrdertwel+$TotalOrderelev+$TotalOrderten+$TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderthrety,2);?>
		<?php } else if((!empty($month_interval)) && ($month_interval=='24')){ ?>
		<?php $toorderforthy = $TotalOrderforthy+$TotalOrderthrety+$TotalOrdertwel+$TotalOrderelev+$TotalOrderten+$TotalOrdernin+$TotalOrdereight+$TotalOrdersev+$TotalOrdersix+$TotalOrderfive+$TotalOrdertwo+$TotalOrderone+$TotalOrder13+$TotalOrder10+$TotalOrder9+$TotalOrder8+$TotalOrder7+$TotalOrder6+$TotalOrder5+$TotalOrder4+$TotalOrder+$TotalOrder1+$TotalOrder2+$TotalOrder3; echo round($toorderforthy,2);?>
		<!-- End 24 Month  -->
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
            <?php if((!empty($currentvalueeur[0])) && ($currentcurreur[0]==='EUR')){ $currvaluemain = $currentvalueeur[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain,2) ."</div>"; } else if((!empty($currentvaluegbp[0])) && ($currentcurrgbp[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
             
			<?php if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur1 = array(); $currentvalueeur1 = array(); $currentcurreur1 = array(); ?>
            <?php  $currentnumgbp1 = array(); $currentvaluegbp1 = array(); $currentcurrgbp1 = array(); ?>
            <?php foreach ($countselectdates1 as $currentweeksone): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeksone['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeksone['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeksone['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeksone['ProcessedListing']['currency']==='EUR'){$currentnumeur1[] = $currentweeksone[0]['orderid']; $currentvalueeur1[] = $currentweeksone[0]['ordervalues']; $currentcurreur1[] = $currentweeksone['ProcessedListing']['currency'];} else if($currentweeksone['ProcessedListing']['currency']==='GBP'){ $currentnumgbp1[] = $currentweeksone[0]['orderid']; $currentvaluegbp1[] = $currentweeksone[0]['ordervalues']; $currentcurrgbp1[] = $currentweeksone['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur1[0])) && ($currentcurreur1[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur1[0] ."</div>";} else if((!empty($currentnumgbp1[0])) && ($currentcurrgbp1[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp1[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur1[0])) && ($currentcurreur1[0]==='EUR')){ $currvaluemain1 = $currentvalueeur1[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain1,2) ."</div>"; } else if((!empty($currentvaluegbp1[0])) && ($currentcurrgbp1[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp1[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurtwo = array(); $currentvalueeurtwo = array(); $currentcurreurtwo = array(); ?>
            <?php  $currentnumgbptwo = array(); $currentvaluegbptwo = array(); $currentcurrgbptwo = array(); ?>
            <?php foreach ($countselectdates2 as $currentweekstwo): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweekstwo['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweekstwo['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweekstwo['ProcessedListing']['plateform'])) {?>
            <?php if($currentweekstwo['ProcessedListing']['currency']==='EUR'){$currentnumeurtwo[] = $currentweekstwo[0]['orderid']; $currentvalueeurtwo[] = $currentweekstwo[0]['ordervalues']; $currentcurreurtwo[] = $currentweekstwo['ProcessedListing']['currency'];} else if($currentweekstwo['ProcessedListing']['currency']==='GBP'){ $currentnumgbptwo[] = $currentweekstwo[0]['orderid']; $currentvaluegbptwo[] = $currentweekstwo[0]['ordervalues']; $currentcurrgbptwo[] = $currentweekstwo['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurtwo[0] ."</div>";} else if((!empty($currentnumgbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbptwo[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ $currvaluemaintwo = $currentvalueeurtwo[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemaintwo,2) ."</div>"; } else if((!empty($currentvaluegbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbptwo[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurthree = array(); $currentvalueeurthree = array(); $currentcurreurthree = array(); ?>
            <?php  $currentnumgbpthree = array(); $currentvaluegbpthree = array(); $currentcurrgbpthree = array(); ?>
            <?php foreach ($countselectdates3 as $currentweeksthree): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeksthree['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeksthree['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeksthree['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeksthree['ProcessedListing']['currency']==='EUR'){$currentnumeurthree[] = $currentweeksthree[0]['orderid']; $currentvalueeurthree[] = $currentweeksthree[0]['ordervalues']; $currentcurreurthree[] = $currentweeksthree['ProcessedListing']['currency'];} else if($currentweeksthree['ProcessedListing']['currency']==='GBP'){ $currentnumgbpthree[] = $currentweeksthree[0]['orderid']; $currentvaluegbpthree[] = $currentweeksthree[0]['ordervalues']; $currentcurrgbpthree[] = $currentweeksthree['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeurthree[0])) && ($currentcurreurthree[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurthree[0] ."</div>";} else if((!empty($currentnumgbpthree[0])) && ($currentcurrgbpthree[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpthree[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurthree[0])) && ($currentcurreurthree[0]==='EUR')){ $currvaluemainthree = $currentvalueeurthree[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainthree,2) ."</div>"; } else if((!empty($currentvaluegbpthree[0])) && ($currentcurrgbpthree[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpthree[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>	
			
			
			<?php if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur4 = array(); $currentvalueeur4 = array(); $currentcurreur4 = array(); ?>
            <?php  $currentnumgbp4 = array(); $currentvaluegbp4 = array(); $currentcurrgbp4 = array(); ?>
            <?php foreach ($countselectdates4 as $currentweeks4): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks4['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks4['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks4['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks4['ProcessedListing']['currency']==='EUR'){$currentnumeur4[] = $currentweeks4[0]['orderid']; $currentvalueeur4[] = $currentweeks4[0]['ordervalues']; $currentcurreur4[] = $currentweeks4['ProcessedListing']['currency'];} else if($currentweeks4['ProcessedListing']['currency']==='GBP'){ $currentnumgbp4[] = $currentweeks4[0]['orderid']; $currentvaluegbp4[] = $currentweeks4[0]['ordervalues']; $currentcurrgbp4[] = $currentweeks4['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur4[0])) && ($currentcurreur4[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur4[0] ."</div>";} else if((!empty($currentnumgbp4[0])) && ($currentcurrgbp4[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp4[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur4[0])) && ($currentcurreur4[0]==='EUR')){ $currvaluemain4 = $currentvalueeur4[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain4,2) ."</div>"; } else if((!empty($currentvaluegbp4[0])) && ($currentcurrgbp4[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp4[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
				
			<?php if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur5 = array(); $currentvalueeur5 = array(); $currentcurreur5 = array(); ?>
            <?php  $currentnumgbp5 = array(); $currentvaluegbp5 = array(); $currentcurrgbp5 = array(); ?>
            <?php foreach ($countselectdates5 as $currentweeks5): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks5['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks5['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks5['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks5['ProcessedListing']['currency']==='EUR'){$currentnumeur5[] = $currentweeks5[0]['orderid']; $currentvalueeur5[] = $currentweeks5[0]['ordervalues']; $currentcurreur5[] = $currentweeks5['ProcessedListing']['currency'];} else if($currentweeks5['ProcessedListing']['currency']==='GBP'){ $currentnumgbp5[] = $currentweeks5[0]['orderid']; $currentvaluegbp5[] = $currentweeks5[0]['ordervalues']; $currentcurrgbp5[] = $currentweeks5['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur5[0])) && ($currentcurreur5[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur5[0] ."</div>";} else if((!empty($currentnumgbp5[0])) && ($currentcurrgbp5[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp5[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur5[0])) && ($currentcurreur5[0]==='EUR')){ $currvaluemain5 = $currentvalueeur5[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain5,2) ."</div>"; } else if((!empty($currentvaluegbp5[0])) && ($currentcurrgbp5[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp5[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur6 = array(); $currentvalueeur6 = array(); $currentcurreur6 = array(); ?>
            <?php  $currentnumgbp6 = array(); $currentvaluegbp6 = array(); $currentcurrgbp6 = array(); ?>
            <?php foreach ($countselectdates6 as $currentweeks6): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks6['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks6['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks6['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks6['ProcessedListing']['currency']==='EUR'){$currentnumeur6[] = $currentweeks6[0]['orderid']; $currentvalueeur6[] = $currentweeks6[0]['ordervalues']; $currentcurreur6[] = $currentweeks6['ProcessedListing']['currency'];} else if($currentweeks6['ProcessedListing']['currency']==='GBP'){ $currentnumgbp6[] = $currentweeks6[0]['orderid']; $currentvaluegbp6[] = $currentweeks6[0]['ordervalues']; $currentcurrgbp6[] = $currentweeks6['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur6[0])) && ($currentcurreur6[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur6[0] ."</div>";} else if((!empty($currentnumgbp6[0])) && ($currentcurrgbp6[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp6[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur6[0])) && ($currentcurreur6[0]==='EUR')){ $currvaluemain6 = $currentvalueeur6[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain6,2) ."</div>"; } else if((!empty($currentvaluegbp6[0])) && ($currentcurrgbp6[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp6[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur7 = array(); $currentvalueeur7 = array(); $currentcurreur7 = array(); ?>
            <?php  $currentnumgbp7 = array(); $currentvaluegbp7 = array(); $currentcurrgbp7 = array(); ?>
            <?php foreach ($countselectdates7 as $currentweeks7): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks7['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks7['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks7['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks7['ProcessedListing']['currency']==='EUR'){$currentnumeur7[] = $currentweeks7[0]['orderid']; $currentvalueeur7[] = $currentweeks7[0]['ordervalues']; $currentcurreur7[] = $currentweeks7['ProcessedListing']['currency'];} else if($currentweeks7['ProcessedListing']['currency']==='GBP'){ $currentnumgbp7[] = $currentweeks7[0]['orderid']; $currentvaluegbp7[] = $currentweeks7[0]['ordervalues']; $currentcurrgbp7[] = $currentweeks7['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur7[0])) && ($currentcurreur7[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur7[0] ."</div>";} else if((!empty($currentnumgbp7[0])) && ($currentcurrgbp7[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp7[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur7[0])) && ($currentcurreur7[0]==='EUR')){ $currvaluemain7 = $currentvalueeur7[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain7,2) ."</div>"; } else if((!empty($currentvaluegbp7[0])) && ($currentcurrgbp7[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp7[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur8 = array(); $currentvalueeur8 = array(); $currentcurreur8 = array(); ?>
            <?php  $currentnumgbp8 = array(); $currentvaluegbp8 = array(); $currentcurrgbp8 = array(); ?>
            <?php foreach ($countselectdates8 as $currentweeks8): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks8['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks8['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks8['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks8['ProcessedListing']['currency']==='EUR'){$currentnumeur8[] = $currentweeks8[0]['orderid']; $currentvalueeur7[] = $currentweeks8[0]['ordervalues']; $currentcurreur8[] = $currentweeks8['ProcessedListing']['currency'];} else if($currentweeks8['ProcessedListing']['currency']==='GBP'){ $currentnumgbp8[] = $currentweeks8[0]['orderid']; $currentvaluegbp8[] = $currentweeks8[0]['ordervalues']; $currentcurrgbp8[] = $currentweeks8['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>		
               
            <?php if((!empty($currentnumeur8[0])) && ($currentcurreur8[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur8[0] ."</div>";} else if((!empty($currentnumgbp8[0])) && ($currentcurrgbp8[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp8[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur8[0])) && ($currentcurreur8[0]==='EUR')){ $currvaluemain8 = $currentvalueeur8[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain8,2) ."</div>"; } else if((!empty($currentvaluegbp8[0])) && ($currentcurrgbp8[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp8[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>

			<?php if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur9 = array(); $currentvalueeur9 = array(); $currentcurreur9 = array(); ?>
            <?php  $currentnumgbp9 = array(); $currentvaluegbp9 = array(); $currentcurrgbp9 = array(); ?>
            <?php foreach ($countselectdates9 as $currentweeks9): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks9['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks9['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks9['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks9['ProcessedListing']['currency']==='EUR'){$currentnumeur9[] = $currentweeks9[0]['orderid']; $currentvalueeur9[] = $currentweeks9[0]['ordervalues']; $currentcurreur9[] = $currentweeks9['ProcessedListing']['currency'];} else if($currentweeks9['ProcessedListing']['currency']==='GBP'){ $currentnumgbp9[] = $currentweeks9[0]['orderid']; $currentvaluegbp9[] = $currentweeks9[0]['ordervalues']; $currentcurrgbp9[] = $currentweeks9['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeur9[0])) && ($currentcurreur9[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur9[0] ."</div>";} else if((!empty($currentnumgbp9[0])) && ($currentcurrgbp9[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp9[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur9[0])) && ($currentcurreur9[0]==='EUR')){ $currvaluemain9 = $currentvalueeur9[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain9,2) ."</div>"; } else if((!empty($currentvaluegbp9[0])) && ($currentcurrgbp9[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp9[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur10 = array(); $currentvalueeur10 = array(); $currentcurreur10 = array(); ?>
            <?php  $currentnumgbp10 = array(); $currentvaluegbp10 = array(); $currentcurrgbp10 = array(); ?>
            <?php foreach ($countselectdates12 as $currentweeks10): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks10['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks10['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks10['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks10['ProcessedListing']['currency']==='EUR'){$currentnumeur10[] = $currentweeks10[0]['orderid']; $currentvalueeur10[] = $currentweeks10[0]['ordervalues']; $currentcurreur10[] = $currentweeks10['ProcessedListing']['currency'];} else if($currentweeks10['ProcessedListing']['currency']==='GBP'){ $currentnumgbp10[] = $currentweeks10[0]['orderid']; $currentvaluegbp10[] = $currentweeks10[0]['ordervalues']; $currentcurrgbp10[] = $currentweeks10['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeur10[0])) && ($currentcurreur10[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur10[0] ."</div>";} else if((!empty($currentnumgbp10[0])) && ($currentcurrgbp10[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp10[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur10[0])) && ($currentcurreur10[0]==='EUR')){ $currvaluemain10 = $currentvalueeur10[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain10,2) ."</div>"; } else if((!empty($currentvaluegbp10[0])) && ($currentcurrgbp10[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp10[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>	

			<?php if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeur13 = array(); $currentvalueeur13 = array(); $currentcurreur13 = array(); ?>
            <?php  $currentnumgbp13 = array(); $currentvaluegbp13 = array(); $currentcurrgbp13 = array(); ?>
            <?php foreach ($countselectdates13 as $currentweeks13): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $currentweeks13['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $currentweeks13['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $currentweeks13['ProcessedListing']['plateform'])) {?>
            <?php if($currentweeks13['ProcessedListing']['currency']==='EUR'){$currentnumeur13[] = $currentweeks13[0]['orderid']; $currentvalueeur13[] = $currentweeks13[0]['ordervalues']; $currentcurreur13[] = $currentweeks13['ProcessedListing']['currency'];} else if($currentweeks13['ProcessedListing']['currency']==='GBP'){ $currentnumgbp13[] = $currentweeks13[0]['orderid']; $currentvaluegbp13[] = $currentweeks13[0]['ordervalues']; $currentcurrgbp13[] = $currentweeks13['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeur13[0])) && ($currentcurreur13[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeur13[0] ."</div>";} else if((!empty($currentnumgbp13[0])) && ($currentcurrgbp13[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbp13[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeur13[0])) && ($currentcurreur13[0]==='EUR')){ $currvaluemain13 = $currentvalueeur13[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemain13,2) ."</div>"; } else if((!empty($currentvaluegbp13[0])) && ($currentcurrgbp13[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbp13[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>	
			<!------Start 13 Month --->
			
			<?php if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurone = array(); $currentvalueeurone = array(); $currentcurreurone = array(); ?>
            <?php  $currentnumgbpone = array(); $currentvaluegbpone = array(); $currentcurrgbpone = array(); ?>
            <?php foreach ($countselectdatesone as $countdatesone): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdatesone['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdatesone['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdatesone['ProcessedListing']['plateform'])) {?>
            <?php if($countdatesone['ProcessedListing']['currency']==='EUR'){$currentnumeurone[] = $countdatesone[0]['orderid']; $currentvalueeurone[] = $countdatesone[0]['ordervalues']; $currentcurreurone[] = $countdatesone['ProcessedListing']['currency'];} else if($countdatesone['ProcessedListing']['currency']==='GBP'){ $currentnumgbpone[] = $countdatesone[0]['orderid']; $currentvaluegbpone[] = $countdatesone[0]['ordervalues']; $currentcurrgbpone[] = $countdatesone['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurone[0])) && ($currentcurreurone[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurone[0] ."</div>";} else if((!empty($currentnumgbpone[0])) && ($currentcurrgbpone[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpone[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurone[0])) && ($currentcurreurone[0]==='EUR')){ $currvaluemainone = $currentvalueeurone[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainone,2) ."</div>"; } else if((!empty($currentvaluegbpone[0])) && ($currentcurrgbpone[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpone[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>			
		
			<?php if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurtwo = array(); $currentvalueeurtwo = array(); $currentcurreurtwo = array(); ?>
            <?php  $currentnumgbptwo = array(); $currentvaluegbptwo = array(); $currentcurrgbptwo = array(); ?>
            <?php foreach ($countselectdatestwo as $countdatestwo): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdatestwo['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdatesone['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdatesone['ProcessedListing']['plateform'])) {?>
            <?php if($countdatestwo['ProcessedListing']['currency']==='EUR'){$currentnumeurtwo[] = $countdatesone[0]['orderid']; $currentvalueeurtwo[] = $countdatesone[0]['ordervalues']; $currentcurreurtwo[] = $countdatesone['ProcessedListing']['currency'];} else if($countdatesone['ProcessedListing']['currency']==='GBP'){ $currentnumgbptwo[] = $countdatesone[0]['orderid']; $currentvaluegbptwo[] = $countdatesone[0]['ordervalues']; $currentcurrgbptwo[] = $countdatesone['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurtwo[0] ."</div>";} else if((!empty($currentnumgbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbptwo[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurtwo[0])) && ($currentcurreurtwo[0]==='EUR')){ $currvaluemaintwo = $currentvalueeurtwo[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemaintwo,2) ."</div>"; } else if((!empty($currentvaluegbptwo[0])) && ($currentcurrgbptwo[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbptwo[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurfive = array(); $currentvalueeurfive = array(); $currentcurreurfive = array(); ?>
            <?php  $currentnumgbpfive = array(); $currentvaluegbpfive = array(); $currentcurrgbpfive = array(); ?>
            <?php foreach ($countselectdatesfive as $countdatesfive): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdatesfive['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdatesfive['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdatesfive['ProcessedListing']['plateform'])) {?>
            <?php if($countdatesfive['ProcessedListing']['currency']==='EUR'){$currentnumeurfive[] = $countdatesfive[0]['orderid']; $currentvalueeurfive[] = $countdatesfive[0]['ordervalues']; $currentcurreurfive[] = $countdatesfive['ProcessedListing']['currency'];} else if($countdatesfive['ProcessedListing']['currency']==='GBP'){ $currentnumgbpfive[] = $countdatesfive[0]['orderid']; $currentvaluegbpfive[] = $countdatesfive[0]['ordervalues']; $currentcurrgbpfive[] = $countdatesfive['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurfive[0])) && ($currentcurreurfive[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurfive[0] ."</div>";} else if((!empty($currentnumgbpfive[0])) && ($currentcurrgbpfive[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpfive[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurfive[0])) && ($currentcurreurfive[0]==='EUR')){ $currvaluemainfive = $currentvalueeurfive[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainfive,2) ."</div>"; } else if((!empty($currentvaluegbpfive[0])) && ($currentcurrgbpfive[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpfive[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeursix = array(); $currentvalueeursix = array(); $currentcurreursix = array(); ?>
            <?php  $currentnumgbpsix = array(); $currentvaluegbpsix= array(); $currentcurrgbpsix = array(); ?>
            <?php foreach ($countselectdatessix as $countdatessix): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdatessix['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdatessix['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdatessix['ProcessedListing']['plateform'])) {?>
            <?php if($countdatessix['ProcessedListing']['currency']==='EUR'){$currentnumeursix[] = $countdatessix[0]['orderid']; $currentvalueeursix[] = $countdatessix[0]['ordervalues']; $currentcurreursix[] = $countdatessix['ProcessedListing']['currency'];} else if($countdatessix['ProcessedListing']['currency']==='GBP'){ $currentnumgbpsix[] = $countdatessix[0]['orderid']; $currentvaluegbpsix[] = $countdatessix[0]['ordervalues']; $currentcurrgbpsix[] = $countdatessix['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeursix[0])) && ($currentcurreursix[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeursix[0] ."</div>";} else if((!empty($currentnumgbpsix[0])) && ($currentcurrgbpsix[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpsix[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeursix[0])) && ($currentcurreursix[0]==='EUR')){ $currvaluemainsix = $currentvalueeursix[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainsix,2) ."</div>"; } else if((!empty($currentvaluegbpsix[0])) && ($currentcurrgbpsix[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpsix[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
				<?php if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeursev = array(); $currentvalueeursev = array(); $currentcurreursev = array(); ?>
            <?php  $currentnumgbpsev = array(); $currentvaluegbpsev = array(); $currentcurrgbpsev = array(); ?>
            <?php foreach ($countselectdatessev as $countdatessev): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdatessev['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdatessev['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdatessev['ProcessedListing']['plateform'])) {?>
            <?php if($countdatessev['ProcessedListing']['currency']==='EUR'){$currentnumeursev[] = $countdatessev[0]['orderid']; $currentvalueeursev[] = $countdatessev[0]['ordervalues']; $currentcurreursev[] = $countdatessev['ProcessedListing']['currency'];} else if($countdatessev['ProcessedListing']['currency']==='GBP'){ $currentnumgbpsev[] = $countdatessev[0]['orderid']; $currentvaluegbpsev[] = $countdatessev[0]['ordervalues']; $currentcurrgbpsev[] = $countdatessev['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeursev[0])) && ($currentcurreursev[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeursev[0] ."</div>";} else if((!empty($currentnumgbpsev[0])) && ($currentcurrgbpsev[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpsev[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeursev[0])) && ($currentcurreursev[0]==='EUR')){ $currvaluemainsev = $currentvalueeursev[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainsev,2) ."</div>"; } else if((!empty($currentvaluegbpsev[0])) && ($currentcurrgbpsev[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpsev[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeureight = array(); $currentvalueeureight = array(); $currentcurreureight = array(); ?>
            <?php  $currentnumgbpeight = array(); $currentvaluegbpeight = array(); $currentcurrgbpeight = array(); ?>
            <?php foreach ($countselectdateseight as $countdateseight): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countdateseight['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countdateseight['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countdateseight['ProcessedListing']['plateform'])) {?>
            <?php if($countdateseight['ProcessedListing']['currency']==='EUR'){$currentnumeureight[] = $countdateseight[0]['orderid']; $currentvalueeureight[] = $countdateseight[0]['ordervalues']; $currentcurreureight[] = $countdateseight['ProcessedListing']['currency'];} else if($countdateseight['ProcessedListing']['currency']==='GBP'){ $currentnumgbpeight[] = $countdateseight[0]['orderid']; $currentvaluegbpeight[] = $countdateseight[0]['ordervalues']; $currentcurrgbpeight[] = $countdateseight['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeureight[0])) && ($currentcurreureight[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeureight[0] ."</div>";} else if((!empty($currentnumgbpeight[0])) && ($currentcurrgbpeight[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpeight[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeureight[0])) && ($currentcurreureight[0]==='EUR')){ $currvaluemaineight = $currentvalueeureight[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemaineight,2) ."</div>"; } else if((!empty($currentvaluegbpeight[0])) && ($currentcurrgbpeight[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpeight[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurnin = array(); $currentvalueeurnin = array(); $currentcurreurnin = array(); ?>
            <?php  $currentnumgbpnin = array(); $currentvaluegbpnin = array(); $currentcurrgbpnin = array(); ?>
            <?php foreach ($countselectdatenines as $countselectdatenine): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdatenine['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdatenine['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdatenine['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdatenine['ProcessedListing']['currency']==='EUR'){$currentnumeurnin[] = $countselectdatenine[0]['orderid']; $currentvalueeurnin[] = $countselectdatenine[0]['ordervalues']; $currentcurreurnin[] = $countselectdatenine['ProcessedListing']['currency'];} else if($countselectdatenine['ProcessedListing']['currency']==='GBP'){ $currentnumgbpnin[] = $countselectdatenine[0]['orderid']; $currentvaluegbpnin[] = $countselectdatenine[0]['ordervalues']; $currentcurrgbpnin[] = $countselectdatenine['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurnin[0])) && ($currentcurreurnin[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurnin[0] ."</div>";} else if((!empty($currentnumgbpnin[0])) && ($currentcurrgbpnin[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpnin[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurnin[0])) && ($currentcurreurnin[0]==='EUR')){ $currvaluemainnin = $currentvalueeurnin[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainnin,2) ."</div>"; } else if((!empty($currentvaluegbpnin[0])) && ($currentcurrgbpnin[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpnin[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurten = array(); $currentvalueeurten = array(); $currentcurreurten = array(); ?>
            <?php  $currentnumgbpten = array(); $currentvaluegbpten = array(); $currentcurrgbpten = array(); ?>
            <?php foreach ($countselectdatetens as $countselectdateten): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdateten['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdateten['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdateten['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdateten['ProcessedListing']['currency']==='EUR'){$currentnumeurten[] = $countselectdateten[0]['orderid']; $currentvalueeurten[] = $countselectdateten[0]['ordervalues']; $currentcurreurten[] = $countselectdateten['ProcessedListing']['currency'];} else if($countselectdateten['ProcessedListing']['currency']==='GBP'){ $currentnumgbpten[] = $countselectdateten[0]['orderid']; $currentvaluegbpten[] = $countselectdateten[0]['ordervalues']; $currentcurrgbpten[] = $countselectdateten['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurten[0])) && ($currentcurreurten[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurten[0] ."</div>";} else if((!empty($currentnumgbpten[0])) && ($currentcurrgbpten[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpten[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurten[0])) && ($currentcurreurten[0]==='EUR')){ $currvaluemainten = $currentvalueeurten[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainten,2) ."</div>"; } else if((!empty($currentvaluegbpten[0])) && ($currentcurrgbpten[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpten[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurelev = array(); $currentvalueeurelev = array(); $currentcurreurelev = array(); ?>
            <?php  $currentnumgbpelev = array(); $currentvaluegbpelev = array(); $currentcurrgbpelev = array(); ?>
            <?php foreach ($countselectdateleves as $countselectdatelev): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdatelev['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdatelev['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdatelev['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdatelev['ProcessedListing']['currency']==='EUR'){$currentnumeurelev[] = $countselectdatelev[0]['orderid']; $currentvalueeurelev[] = $countselectdatelev[0]['ordervalues']; $currentcurreurelev[] = $countselectdatelev['ProcessedListing']['currency'];} else if($countselectdatelev['ProcessedListing']['currency']==='GBP'){ $currentnumgbpelev[] = $countselectdatelev[0]['orderid']; $currentvaluegbpelev[] = $countselectdatelev[0]['ordervalues']; $currentcurrgbpelev[] = $countselectdatelev['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurelev[0])) && ($currentcurreurelev[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurelev[0] ."</div>";} else if((!empty($currentnumgbpelev[0])) && ($currentcurrgbpelev[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpelev[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurelev[0])) && ($currentcurreurelev[0]==='EUR')){ $currvaluemainelev = $currentvalueeurelev[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainelev,2) ."</div>"; } else if((!empty($currentvaluegbpelev[0])) && ($currentcurrgbpelev[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpelev[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='22')  || ($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurtwel = array(); $currentvalueeurtwel = array(); $currentcurreurtwel = array(); ?>
            <?php  $currentnumgbptwel = array(); $currentvaluegbptwel= array(); $currentcurrgbptwel = array(); ?>
            <?php foreach ($countselectdatetwels as $countselectdatetwel): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdatetwel['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdatetwel['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdatetwel['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdatetwel['ProcessedListing']['currency']==='EUR'){$currentnumeurtwel[] = $countselectdatetwel[0]['orderid']; $currentvalueeurtwel[] = $countselectdatetwel[0]['ordervalues']; $currentcurreurtwel[] = $countselectdatetwel['ProcessedListing']['currency'];} else if($countselectdatetwel['ProcessedListing']['currency']==='GBP'){ $currentnumgbptwel[] = $countselectdatetwel[0]['orderid']; $currentvaluegbptwel[] = $countselectdatetwel[0]['ordervalues']; $currentcurrgbptwel[] = $countselectdatetwel['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurtwel[0])) && ($currentcurreurtwel[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurtwel[0] ."</div>";} else if((!empty($currentnumgbptwel[0])) && ($currentcurrgbptwel[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbptwel[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurtwel[0])) && ($currentcurreurtwel[0]==='EUR')){ $currvaluemaintwel = $currentvalueeurtwel[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemaintwel,2) ."</div>"; } else if((!empty($currentvaluegbptwel[0])) && ($currentcurrgbptwel[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbptwel[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){ ?>
			<?php $currentnumeurthrety = array(); $currentvalueeurthrety = array(); $currentcurreurthrety = array(); ?>
            <?php  $currentnumgbpthrety = array(); $currentvaluegbpthrety = array(); $currentcurrgbpthrety = array(); ?>
            <?php foreach ($countselectdatethretyes as $countselectdatethrety): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdatethrety['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdatethrety['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdatethrety['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdatethrety['ProcessedListing']['currency']==='EUR'){$currentnumeurthrety[] = $countselectdatethrety[0]['orderid']; $currentvalueeurthrety[] = $countselectdatethrety[0]['ordervalues']; $currentcurreurthrety[] = $countselectdatethrety['ProcessedListing']['currency'];} else if($countselectdatethrety['ProcessedListing']['currency']==='GBP'){ $currentnumgbpthrety[] = $countselectdatethrety[0]['orderid']; $currentvaluegbpthrety[] = $countselectdatethrety[0]['ordervalues']; $currentcurrgbpthrety[] = $countselectdatethrety['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurthrety[0])) && ($currentcurreurthrety[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurthrety[0] ."</div>";} else if((!empty($currentnumgbpthrety[0])) && ($currentcurrgbpthrety[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpthrety[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurthrety[0])) && ($currentcurreurthrety[0]==='EUR')){ $currvaluemainthrety = $currentvalueeurthrety[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainthrety,2) ."</div>"; } else if((!empty($currentvaluegbpthrety[0])) && ($currentcurrgbpthrety[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpthrety[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<?php if((!empty($month_interval)) && (($month_interval=='24'))){ ?>
			<?php $currentnumeurforthy = array(); $currentvalueeurforthy = array(); $currentcurreurforthy = array(); ?>
            <?php  $currentnumgbpforthy = array(); $currentvaluegbpforthy = array(); $currentcurrgbpforthy = array(); ?>
            <?php foreach ($countselectdateforthyes as $countselectdateforthy): ?>  
            <?php if(($value['ProcessedListing']['cat_name'] === $countselectdateforthy['ProcessedListing']['cat_name']) && ($value['ProcessedListing']['subsource'] === $countselectdateforthy['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $countselectdateforthy['ProcessedListing']['plateform'])) {?>
            <?php if($countselectdateforthy['ProcessedListing']['currency']==='EUR'){$currentnumeurforthy[] = $countselectdateforthy[0]['orderid']; $currentvalueeurtwel[] = $countselectdateforthy[0]['ordervalues']; $currentcurreurtwel[] = $countselectdateforthy['ProcessedListing']['currency'];} else if($countselectdateforthy['ProcessedListing']['currency']==='GBP'){ $currentnumgbptwel[] = $countselectdateforthy[0]['orderid']; $currentvaluegbptwel[] = $countselectdateforthy[0]['ordervalues']; $currentcurrgbptwel[] = $countselectdateforthy['ProcessedListing']['currency']; }  ?>                              
            <?php } ?>
			<?php endforeach; ?>	
               
            <?php if((!empty($currentnumeurforthy[0])) && ($currentcurreurforthy[0]==='EUR')){ echo "<div class='rTableCell'>". $currentnumeurforthy[0] ."</div>";} else if((!empty($currentnumgbpforthy[0])) && ($currentcurrgbpforthy[0]==='GBP')){ echo "<div class='rTableCell'>". $currentnumgbpforthy[0] ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php if((!empty($currentvalueeurforthy[0])) && ($currentcurreurforthy[0]==='EUR')){ $currvaluemainforthy = $currentvalueeurforthy[0]*0.89;  echo "<div class='rTableCell'>". round($currvaluemainforthy,2) ."</div>"; } else if((!empty($currentvaluegbpforthy[0])) && ($currentcurrgbpforthy[0]==='GBP')){ echo "<div class='rTableCell'>". round($currentvaluegbpforthy[0],2) ."</div>"; } else { echo "<div class='rTableCell'>-</div>"; } ?>
            <?php } ?>
			
			<!---End 20 Month --->
			
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
       		<?php } else if((!empty($month_interval)) && ($month_interval=='12')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<!------Start 13 Month --->
			<?php } else if((!empty($month_interval)) && ($month_interval=='13')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='14')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='15')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='16')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='17')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='18')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='19')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='20')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]+$currentnumeurten[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]+$currentnumgbpten[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0]+$currentvalueeurten[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]+$currentvaluegbpten[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='21')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]+$currentnumeurten[0]+$currentnumeurelev[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]+$currentnumgbpten[0]+$currentnumgbpelev[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0]+$currentvalueeurten[0]+$currentvalueeurelev[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]+$currentvaluegbpten[0]+$currentvaluegbpelev[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='22')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]+$currentnumeurten[0]+$currentnumeurelev[0]+$currentnumeurtwel[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]+$currentnumgbpten[0]+$currentnumgbpelev[0]+$currentnumgbptwel[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0]+$currentvalueeurten[0]+$currentvalueeurelev[0]+$currentvalueeurtwel[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]+$currentvaluegbpten[0]+$currentvaluegbpelev[0]+$currentvaluegbptwel[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='23')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]+$currentnumeurten[0]+$currentnumeurelev[0]+$currentnumeurtwel[0]+$currentnumeurthrety[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]+$currentnumgbpten[0]+$currentnumgbpelev[0]+$currentnumgbptwel[0]+$currentnumgbpthrety[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0]+$currentvalueeurten[0]+$currentvalueeurelev[0]+$currentvalueeurtwel[0]+$currentvalueeurthrety[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]+$currentvaluegbpten[0]+$currentvaluegbpelev[0]+$currentvaluegbptwel[0]+$currentvaluegbpthrety[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       		<?php } else if((!empty($month_interval)) && ($month_interval=='24')){ ?>
			<?php if($currentcurreur[0]==='EUR'){ $totalnumbeur = $currentnumeur[0]+$currentnumeur1[0]+$currentnumeurtwo[0]+$currentnumeurthree[0]+$currentnumeur4[0]+$currentnumeur5[0]+$currentnumeur6[0]+$currentnumeur7[0]+$currentnumeur8[0]+$currentnumeur9[0]+$currentnumeur10[0]+$currentnumeur13[0]+$currentnumeurone[0]+$currentnumeurtwo[0]+$currentnumeurfive[0]+$currentnumeursix[0]+$currentnumeursev[0]+$currentnumeureight[0]+$currentnumeurnin[0]+$currentnumeurten[0]+$currentnumeurelev[0]+$currentnumeurtwel[0]+$currentnumeurthrety[0]+$currentnumeurforthy[0]; echo "<div class='rTableCell'>".round($totalnumbeur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){ $Totalnumbgbp = $currentnumgbp[0]+$currentnumgbp1[0]+$currentnumgbptwo[0]+$currentnumgbpthree[0]+$currentnumgbp4[0]+$currentnumgbp5[0]+$currentnumgbp6[0]+$currentnumgbp7[0]+$currentnumgbp8[0]+$currentnumgbp9[0]+$currentnumgbp10[0]+$currentnumgbp13[0]+$currentnumgbpone[0]+$currentnumgbptwo[0]+$currentnumgbpfive[0]+$currentnumgbpsix[0]+$currentnumgbpsev[0]+$currentnumgbpeight[0]+$currentnumgbpnin[0]+$currentnumgbpten[0]+$currentnumgbpelev[0]+$currentnumgbptwel[0]+$currentnumgbpthrety[0]+$currentnumgbpforthy[0]; echo "<div class='rTableCell'>".round($Totalnumbgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ $totalvaleur = $currentvalueeur[0]+$currentvalueeur1[0]+$currentvalueeurtwo[0]+$currentvalueeurthree[0]+$currentvalueeur4[0]+$currentvalueeur5[0]+$currentvalueeur6[0]+$currentvalueeur7[0]+$currentvalueeur8[0]+$currentvalueeur9[0]+$currentvalueeur10[0]+$currentvalueeur13[0]+$currentvalueeurone[0]+$currentvalueeurtwo[0]+$currentvalueeurfive[0]+$currentvalueeursix[0]+$currentvalueeursev[0]+$currentvalueeureight[0]+$currentvalueeurnin[0]+$currentvalueeurten[0]+$currentvalueeurelev[0]+$currentvalueeurtwel[0]+$currentvalueeurthrety[0]+$currentvalueeurforthy[0];  echo "<div class='rTableCell'>".round($totalvaleur,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){$Totalvalgbp = $currentvaluegbp[0]+$currentvaluegbp1[0]+$currentvaluegbptwo[0]+$currentvaluegbpthree[0]+$currentvaluegbp4[0]+$currentvaluegbp5[0]+$currentvaluegbp6[0]+$currentvaluegbp7[0]+$currentvaluegbp8[0]+$currentvaluegbp9[0]+$currentvaluegbp10[0]+$currentvaluegbp13[0]+$currentvaluegbpone[0]+$currentvaluegbptwo[0]+$currentvaluegbpfive[0]+$currentvaluegbpsix[0]+$currentvaluegbpsev[0]+$currentvaluegbpeight[0]+$currentvaluegbpnin[0]+$currentvaluegbpten[0]+$currentvaluegbpelev[0]+$currentvaluegbptwel[0]+$currentvaluegbpthrety[0]+$currentvaluegbpforthy[0]; echo "<div class='rTableCell'>".round($Totalvalgbp,2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
       						
			
						
			<!------End 22 Month --->
			<?php } else { ?>
			<?php if($currentcurreur[0]==='EUR'){ echo "<div class='rTableCell'>".round($currentnumeur[0],2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){echo "<div class='rTableCell'>".round($currentnumgbp[0],2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
            <?php if($currentcurreur[0]==='EUR'){ echo "<div class='rTableCell'>".round($currentvalueeur[0]*0.89,2)."</div>"; } else if ($currentcurrgbp[0]==='GBP'){echo "<div class='rTableCell'>".round($pordervaluegbp[0],2)."</div>"; } else {echo "<div class='rTableCell'>-</div>";}?>
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
<!--<script>
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

</script>-->