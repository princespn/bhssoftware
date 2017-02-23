<?php
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}

if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
    
$mapping = array('Linnworks Code','Category','Product name','Amazon SKU','Web SKU','Web UK RRP','DM RRP','Amazon UK RRP','Web Sale Price UK','Web Sale Price Tesco','Web Sale Price dm','Amazon UK Sale Price','Amazon UK FBA Sale Price','Web DE RRP','Amazon DE RRP','Web FR RRP','Amazon FR RRP','Web DE Sale Price','Amazon DE Sale Price','Amazon DE FBA Sale Price','Web FR Sale Price','Amazon FR Sale Price','Amazon FBA FR Sale Price','Errors');
echo $csv->addRow($mapping);

foreach ($code_listings as $code_listing):
$line_code = array($code_listing['MasterListing']['linnworks_code']);
$line_cate = array($code_listing['InventoryCode']['category']);
$line_name = array($code_listing['InventoryCode']['product_name']);
$line_ams = array($code_listing['MasterListing']['amazon_sku']);
$line_sku = array($code_listing['AdminListing']['web_sku']);
$web_uk_rp = array($code_listing['AdminListing']['web_price_uk']);
$tasko_rp = array($code_listing['AdminListing']['web_price_dm']);
//$uk_rp = array($code_listing['MasterListing']['price_uk']);

/*  Add Amazon UK RRP Price */
$uk_rp = array();
foreach ($Amazonuk as $Amazondeukfba):
if(((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($Amazondeukfba['MasterListing']['price_uk']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Amazondeukfba['MasterListing']['linnworks_code'])){ 
 $uk_rp [0] = $Amazondeukfba['MasterListing']['price_uk'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End Amazon UK Price */


$web_uk = array($code_listing['AdminListing']['web_sale_price_uk']);
$web_tasko = array($code_listing['AdminListing']['web_sale_price_tesco']);
$web_dm = array($code_listing['AdminListing']['web_sale_price_dm']);
//$sale_price_uk = array($code_listing['MasterListing']['sale_price_uk']);
/*  Add Amazon UK Price */
$sale_price_uk = array();
foreach ($Amazonuk as $Amazondeukfba):
if(((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($Amazondeukfba['MasterListing']['sale_price_uk']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Amazondeukfba['MasterListing']['linnworks_code'])){ 
 $sale_price_uk [0] = $Amazondeukfba['MasterListing']['sale_price_uk'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End Amazon UK Price */

/*  Add FBA UK Price */
$sale_fbauk = array();
foreach ($Amazonuk as $Amazondeukfba):
if(((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($Amazondeukfba['MasterListing']['sale_price_uk']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Amazondeukfba['MasterListing']['linnworks_code'])){ 
 $sale_fbauk [0] = $Amazondeukfba['MasterListing']['sale_price_uk'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  FBA UK Price */
$web_rrp_de = array($code_listing['AdminListing']['web_price_de']);
//$rrp_de = array($code_listing['MasterListing']['price_de']);

/*  Add Amazon FR Price */
$rrp_de = array();
foreach ($Germany_primes as $Germany_prime):
if(((strpos($Germany_prime['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($Germany_prime['MasterListing']['price_de']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Germany_prime['MasterListing']['linnworks_code'])){ 
 $rrp_de [0] = $Germany_prime['MasterListing']['price_de'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  Amazon GE Price */

$web_rrp_fr = array($code_listing['AdminListing']['web_price_fr']);
//$rrp_fr = array($code_listing['MasterListing']['price_fr']);

/*  Add Amazon RRP Price */
$rrp_fr = array();
foreach ($France_primes as $France_prime):
if(((strpos($France_prime['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($France_prime['MasterListing']['price_fr']))) && ($code_listing['MasterListing']['linnworks_code']) === ($France_prime['MasterListing']['linnworks_code'])){ 
 $rrp_fr [0] = $France_prime['MasterListing']['price_fr'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  Amazon RRP Price */

$web_de = array($code_listing['AdminListing']['web_sale_price_de']);
//$sale_price_de = array($code_listing['MasterListing']['sale_price_de']);

/*  Add Amazon GE Price */
$sale_price_de = array();
foreach ($Germany_primes as $Germany_prime):
if(((strpos($Germany_prime['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($Germany_prime['MasterListing']['sale_price_de']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Germany_prime['MasterListing']['linnworks_code'])){ 
 $sale_price_de [0] = $Germany_prime['MasterListing']['sale_price_de'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  Amazon GE Price */

/*  Add FBA GE Price */
$sale_fbagerman = array();
foreach ($Germany_primes as $Germany_prime):
if(((strpos($Germany_prime['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($Germany_prime['MasterListing']['sale_price_de']))) && ($code_listing['MasterListing']['linnworks_code']) === ($Germany_prime['MasterListing']['linnworks_code'])){ 
 $sale_fbagerman [0] = $Germany_prime['MasterListing']['sale_price_de'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  FBA GE Price */

$web_fr = array($code_listing['AdminListing']['web_sale_price_fr']);
//$sale_price_fr = array($code_listing['MasterListing']['sale_price_fr']);

/*  Add Amazon FR Price */
$sale_price_fr = array();
foreach ($France_primes as $France_prime):
if(((strpos($France_prime['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($France_prime['MasterListing']['sale_price_fr']))) && ($code_listing['MasterListing']['linnworks_code']) === ($France_prime['MasterListing']['linnworks_code'])){ 
 $sale_price_fr [0] = $France_prime['MasterListing']['sale_price_fr'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  Amazon FR Price */


/*  Add FBA FR Price */
$sale_fbfrance = array();
foreach ($France_primes as $France_prime):
if(((strpos($France_prime['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($France_prime['MasterListing']['sale_price_fr']))) && ($code_listing['MasterListing']['linnworks_code']) === ($France_prime['MasterListing']['linnworks_code'])){ 
 $sale_fbfrance [0] = $France_prime['MasterListing']['sale_price_fr'];
 //echo $sale_fbauk ;die();
}
endforeach;
/*  End  FBA FR Price */

$sale_error = array($code_listing['MasterListing']['error']);
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
echo $csv->addRow($line);
endforeach;

$filename='code_listings';
echo $csv->render($filename);
}else{	
echo $this->Session->flash(); ?>
 <hr>
 
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
 <h1 class="sub-header"><?php __('Master listing database');?></h1>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('MasterListing',array('action'=>'index','id'=>'saveForm')); ?>
        <div class="col-md-8 mobile-bottomspace">
         <!--<?php //echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php //echo $this->Paginator->sort('Error', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>-->
         <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'master_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
         <?php echo $this->Html->link(__('Replace Or Del sku', true), array('controller' => 'master_listings', 'action' => 'repdelcode'),array('class' => 'btn btn-info btn-sm')); ?>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table">
         <th colspan="5"><?php //echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));  ?></th>
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg"><?php __('Sale Price (GBP)');?></th>
          <th></th>
          <th colspan="7" class="text-center text-uppercase color-white eur-bg"><?php __('Sale Price (EUR)');?></th>         
        </tr>
        <tr>
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
         <th><?php __('Linnworks Code');?></th>
           <!--<th class="wid-20"><?php __('Amazon SKU');?></th>-->
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php // $Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($Catname as $Catna): ?>
                     <li><a href="<?php echo  $actual_link ; ?>/master_listings/category/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>
          <th><?php __('Product name');?></th>
          <th class="<?php __('pink-price');?>"><?php __('RRP');?></th>
          <th><?php __('Web UK');?></th>
          <th><?php __('Tesco');?></th>
          <th><?php __('Amazon UK');?></th>
          <th><?php __('Amazon UK Prime');?></th>
          <th><?php __('Daily Mail');?></th>
          <th><?php __('EBay');?></th>          
          <th class="<?php __('pink-price');?>"><?php __('RRP');?></th>
          <th><?php __('Web DE');?></th>
          <th><?php __('Amazon DE');?></th>
          <th><?php __('Amazon DE Prime');?></th>
          <th><?php __('Web FR');?></th>
          <th><?php __('Amazon FR');?></th>
          <th><?php __('Amazon FR Prime');?></th>
          <th><?php __('CDiscount');?></th>  
        </tr>
      </thead>
      <tbody>
<?php foreach ($code_listings as $code_listing): ?>
        <tr>
         <td><?php $productid = $code_listing['MasterListing']['id']; if(!empty($code_listing['MasterListing']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
         echo $this->Form->input('MasterListing.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($code_listing['MasterListing']['error'])){echo "&#8595;";} ?></td>
          <td class="wid-20"><?php echo $code_listing['InventoryCode']['linnworks_code']; ?></td>
          <!--<td><?php echo $code_listing['MasterListing']['amazon_sku']; ?></td>-->
          <td><?php echo $code_listing['InventoryCode']['category']; ?></td>
          <td><?php echo $code_listing['InventoryCode']['product_name']; ?></td>
      
          <?php  if(!empty($code_listing['MasterListing']['price_uk'])) { ?>
           <td class="pink-price"><?php  echo $code_listing['MasterListing']['price_uk']; ?></td>   
          <?php } else if(!empty($code_listing['AdminListing']['web_price_uk'])) { ?>
           <td class="pink-price"><?php  echo $code_listing['AdminListing']['web_price_uk']; ?></td>  
           <?php }else { ?>
          <td class="pink-price"><?php echo 'NA';?></td>
          <?php } ?>
           
           <?php  if(!empty($code_listing['AdminListing']['web_sale_price_uk'])) { ?>
          <td><?php  echo $code_listing['AdminListing']['web_sale_price_uk']; ?></td>
           <?php } else { ?><td></td><?php } ?>
           
            <?php if(((!empty($code_listing['AdminListing']['web_sale_price_tesco'])) && (!empty($code_listing['AdminListing']['web_sale_price_uk']))) && (($code_listing['AdminListing']['web_sale_price_uk']) !==($code_listing['AdminListing']['web_sale_price_tesco']))){  ?>
            <td class="red-info" title="<?php Echo "Web UK :: ".$code_listing['AdminListing']['web_sale_price_uk']." Tesco  :: ".$code_listing['AdminListing']['web_sale_price_tesco']." Sale Price Mismatch."; ?>"><?php  echo $code_listing['AdminListing']['web_sale_price_tesco']; ?></td> 
            <?php  } else if(!empty($code_listing['AdminListing']['web_sale_price_tesco'])) { ?>
          <td><?php  echo $code_listing['AdminListing']['web_sale_price_tesco']; ?></td>
           <?php } else { ?><td><?php echo 'NA';?></td><?php } ?>
           
           
      
        <td><?php foreach ($Amazonuk as $Amazondeukfba): ?>
       <?php if(($code_listing['MasterListing']['linnworks_code']) === ($Amazondeukfba['MasterListing']['linnworks_code'])){  ?>  
         <?php if((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') === false) && ((!empty($Amazondeukfba['MasterListing']['sale_price_uk'])) && (!empty($code_listing['AdminListing']['web_sale_price_uk']))) && (($Amazondeukfba['MasterListing']['sale_price_uk']) !==($code_listing['AdminListing']['web_sale_price_uk']))){  ?>
        <div class="red-info" title="<?php Echo "Web UK :: ".$code_listing['AdminListing']['web_sale_price_uk']." Amazon UK ".$Amazondeukfba['MasterListing']['sale_price_uk']." Sale Price Mismatch."; ?>"><?php  echo $Amazondeukfba['MasterListing']['sale_price_uk']; ?></div> 
        <?php } else if ((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($Amazondeukfba['MasterListing']['sale_price_uk']))) { ?>
        <?php echo $Amazondeukfba['MasterListing']['sale_price_uk']; ?>
        <?php break; } ?>
        <?php } ?>
        <?php endforeach; ?></td> 
           
        
        <?php   foreach ($getshipppings as $getdeshiping): ?>
              <?php if((($getdeshiping['Shipping']['country']) ==='GB') && ($getdeshiping['Shipping']['category']) === ($code_listing['InventoryCode']['category'])):  ?>
                <?php $gbpCountry = $getdeshiping['Shipping']['country'];
                $gbpCategory = $getdeshiping['Shipping']['category'];
               $gbpCost = $getdeshiping['Shipping']['shipping_cost']; ?>
        <?php   break;endif; endforeach; ?>
        
         <td><?php foreach ($Amazonuk as $Amazondeukfba): ?>
        <?php if(($code_listing['MasterListing']['linnworks_code']) === ($Amazondeukfba['MasterListing']['linnworks_code'])){  ?>  
        <?php if((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (($code_listing['InventoryCode']['category'] === $gbpCategory) && ($gbpCountry === 'GB')) && ((!empty($Amazondeukfba['MasterListing']['sale_price_uk'])) && (!empty($code_listing['AdminListing']['web_sale_price_uk']))) && ((int)$Amazondeukfba['MasterListing']['sale_price_uk'] !==(int)$code_listing['AdminListing']['web_sale_price_uk']+(int)$gbpCost)){  ?>
        <div class="red-info" title="<?php  echo "Amazon Prime (".$Amazondeukfba['MasterListing']['sale_price_uk'].") = Web Price (".$code_listing['AdminListing']['web_sale_price_uk'].") + Shipping cost  ".$gbpCost; ?>"><?php echo $Amazondeukfba['MasterListing']['sale_price_uk']; ?></div>
        <?php } else if((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') !== false) && ((!empty($Amazondeukfba['MasterListing']['sale_price_uk'])) && (!empty($code_listing['AdminListing']['web_sale_price_dm']))) && (($Amazondeukfba['MasterListing']['sale_price_uk']) !==($code_listing['AdminListing']['web_sale_price_dm']))){  ?>
        <div class="red-info" title="<?php echo "Web DM :: ".$code_listing['AdminListing']['web_sale_price_dm']." Amazon Prime UK ".$Amazondeukfba['MasterListing']['sale_price_uk']." Sale Price Mismatch."; ?>"><?php  echo $Amazondeukfba['MasterListing']['sale_price_uk']; ?></div> 
        <?php } else if((strpos($Amazondeukfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($Amazondeukfba['MasterListing']['sale_price_uk']))){  ?>
        <?php echo $Amazondeukfba['MasterListing']['sale_price_uk']; ?>
        <?php break; } ?>                                   
        <?php } ?>
        <?php endforeach; ?></td>
        
          
       <?php if(!empty($code_listing['AdminListing']['web_sale_price_dm'])) { ?>        
         <td><?php  echo $code_listing['AdminListing']['web_sale_price_dm']; ?></td>
        <?php } else { ?><td></td><?php } ?>      
     
        <?php if(!empty($code_listing['MasterListing']['sale_price_ebay'])) { ?>
        <td><?php  echo $code_listing['MasterListing']['sale_price_ebay']; ?></td>  
        <?php }else { ?>
        <td><?php echo 'NA';?></td>
        <?php } ?>  
        
        <?php  if(!empty($code_listing['MasterListing']['price_de'])) { ?>            
        <td  class="pink-price"><?php  echo $code_listing['MasterListing']['price_de']; ?></td>
        <?php } else if(!empty($code_listing['MasterListing']['price_fr'])){  ?>
        <td  class="pink-price"><?php  echo $code_listing['MasterListing']['price_fr']; ?></td>
          <?php } else if(!empty($code_listing['AdminListing']['web_price_de'])){  ?>
        <td  class="pink-price"><?php  echo $code_listing['AdminListing']['web_price_de']; ?></td>    
        <?php } else { ?>
        <td  class="pink-price"><?php  echo $code_listing['AdminListing']['web_price_fr']; ?></td> 
        <?php } ?>  
        
        <?php  if(!empty($code_listing['AdminListing']['web_sale_price_de'])) { ?>
        <td><?php  echo $code_listing['AdminListing']['web_sale_price_de']; ?></td>
        <?php } else { ?><td></td><?php } ?>  
           
    
      
           <td><?php foreach ($Germany_primes as $amazondefba): ?>
       <?php if(($code_listing['MasterListing']['linnworks_code']) === ($amazondefba['MasterListing']['linnworks_code'])){  ?>  
         <?php if((strpos($amazondefba['MasterListing']['amazon_sku'], 'FBA') === false) && ((!empty($amazondefba['MasterListing']['sale_price_de'])) && (!empty($code_listing['AdminListing']['web_sale_price_de']))) && (($amazondefba['MasterListing']['sale_price_de']) !==($code_listing['AdminListing']['web_sale_price_de']))){  ?>
        <div class="red-info" title="<?php Echo "Web DE :: ".$code_listing['AdminListing']['web_sale_price_de']." Amazon UK ".$amazondefba['MasterListing']['sale_price_de']." Sale Price Mismatch."; ?>"><?php  echo $amazondefba['MasterListing']['sale_price_de']; ?></div> 
        <?php } else if ((strpos($amazondefba['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($amazondefba['MasterListing']['sale_price_de']))) { ?>
        <?php echo $amazondefba['MasterListing']['sale_price_de']; ?>
        <?php break; } ?>
        <?php } ?>
        <?php endforeach; ?></td> 
        
             
          <?php   foreach ($getshipppings as $getshippping): ?>
              <?php if((($getshippping['Shipping']['country']) ==='DE') && ($getshippping['Shipping']['category']) === ($code_listing['InventoryCode']['category'])):  ?>
                <?php $debCountry = $getshippping['Shipping']['country'];
                $debCategory = $getshippping['Shipping']['category'];
               $debCost = $getshippping['Shipping']['shipping_cost']; ?>
        <?php   break;endif; endforeach; ?>
        
        <td><?php foreach ($Germany_primes as $amazondefba): ?>
        <?php if(($code_listing['MasterListing']['linnworks_code']) === ($amazondefba['MasterListing']['linnworks_code'])){  ?>  
        <?php if((strpos($amazondefba['MasterListing']['amazon_sku'], 'FBA') !== false) && (($code_listing['InventoryCode']['category'] === $debCategory) && ($debCountry === 'DE')) && ((!empty($amazondefba['MasterListing']['sale_price_de'])) && (!empty($code_listing['AdminListing']['web_sale_price_de']))) && ((int)$amazondefba['MasterListing']['sale_price_de'] !==(int)$code_listing['AdminListing']['web_sale_price_de']+(int)$debCost)){  ?>
        <div class="red-info" title="<?php  echo "Amazon Prime (".$amazondefba['MasterListing']['sale_price_de'].") = Web Price (".$code_listing['AdminListing']['web_sale_price_de'].") + Shipping cost  ".$debCost; ?>"><?php echo $amazondefba['MasterListing']['sale_price_de']; ?></div>
        <?php } else if((strpos($amazondefba['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($amazondefba['MasterListing']['sale_price_de']))){  ?>
        <?php echo $amazondefba['MasterListing']['sale_price_de']; ?>
        <?php break; } ?>                                   
        <?php } ?>
        <?php endforeach; ?></td>
        
        
             
       
           
          <?php if(((!empty($code_listing['AdminListing']['web_sale_price_fr'])) && (!empty($code_listing['AdminListing']['web_sale_price_de']))) && (($code_listing['AdminListing']['web_sale_price_fr']) !==($code_listing['AdminListing']['web_sale_price_de']))){  ?>
            <td class="red-info" title="<?php Echo "Web FR :: ".$code_listing['AdminListing']['web_sale_price_fr']." Web DE  :: ".$code_listing['AdminListing']['web_sale_price_de']." Sale Price Mismatch."; ?>"><?php  echo $code_listing['AdminListing']['web_sale_price_fr']; ?></td> 
            <?php  } else if(!empty($code_listing['AdminListing']['web_sale_price_fr'])) { ?>
          <td><?php  echo $code_listing['AdminListing']['web_sale_price_fr']; ?></td>
           <?php } else { ?><td><?php echo 'NA';?></td><?php } ?>
           
      
        <td><?php foreach ($France_primes as $amazonfrfba): ?>
       <?php if(($code_listing['MasterListing']['linnworks_code']) === ($amazonfrfba['MasterListing']['linnworks_code'])){  ?>  
         <?php if((strpos($amazonfrfba['MasterListing']['amazon_sku'], 'FBA') === false) && ((!empty($amazonfrfba['MasterListing']['sale_price_fr'])) && (!empty($code_listing['AdminListing']['web_sale_price_fr']))) && (($amazonfrfba['MasterListing']['sale_price_fr']) !==($code_listing['AdminListing']['web_sale_price_fr']))){  ?>
        <div class="red-info" title="<?php Echo "Web FR :: ".$code_listing['AdminListing']['web_sale_price_fr']." Amazon UK ".$amazonfrfba['MasterListing']['sale_price_fr']." Sale Price Mismatch."; ?>"><?php  echo $amazonfrfba['MasterListing']['sale_price_fr']; ?></div> 
        <?php } else if ((strpos($amazonfrfba['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($amazonfrfba['MasterListing']['sale_price_fr']))) { ?>
        <?php echo $amazonfrfba['MasterListing']['sale_price_fr']; ?>
        <?php break; } ?>
        <?php } ?>
        <?php endforeach; ?></td> 
          
                   
           <?php  foreach ($getshipppings as $getfrshippping): ?>
              <?php if((($getfrshippping['Shipping']['country']) ==='FR') && ($getfrshippping['InventoryCode']['category']) === ($code_listing['MasterListing']['category'])):  ?>
                <?php $frbCountry = $getfrshippping['Shipping']['country'];
                $frbCategory = $getfrshippping['Shipping']['category'];
               $frbCost = $getfrshippping['Shipping']['shipping_cost']; ?>
        <?php   break;endif; endforeach; ?>
        
    
        
          <td><?php foreach ($France_primes as $amazonfrfba): ?>
        <?php if(($code_listing['MasterListing']['linnworks_code']) === ($amazonfrfba['MasterListing']['linnworks_code'])){  ?>  
        <?php if((strpos($amazonfrfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (($code_listing['InventoryCode']['category'] === $frbCategory) && ($frbCountry === 'FR')) && ((!empty($amazonfrfba['MasterListing']['sale_price_fr'])) && (!empty($code_listing['AdminListing']['web_sale_price_fr']))) && ((int)$amazonfrfba['MasterListing']['sale_price_fr'] !==(int)$code_listing['AdminListing']['web_sale_price_fr']+(int)$frbCost)){  ?>
        <div class="red-info" title="<?php  echo "Amazon Prime (".$amazonfrfba['MasterListing']['sale_price_fr'].") = Web Price (".$code_listing['AdminListing']['web_sale_price_fr'].") + Shipping cost  ".$frbCost; ?>"><?php echo $amazonfrfba['MasterListing']['sale_price_fr']; ?></div>
        <?php } else if((strpos($amazonfrfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($amazonfrfba['MasterListing']['sale_price_fr']))){  ?>
        <?php echo $amazonfrfba['MasterListing']['sale_price_fr']; ?>
        <?php break; } ?>                                   
        <?php } ?>
        <?php endforeach; ?></td>
          
        <?php if(!empty($code_listing['MasterListing']['sale_price_cdiscount'])) { ?>
        <td><?php  echo $code_listing['MasterListing']['sale_price_cdiscount']; ?></td>  
        <?php }else { ?>
        <td><?php echo 'NA';?></td>
        <?php } ?>    
        </tr>
    <?php endforeach; ?>
    <?php echo $this->Form->end();?>
      </tbody>
    </table>
  </div>
<hr>
<?php
echo $this->Paginator->counter(array(
    'format' => 'Page %page% of %pages%, showing %current% records out of
             %count% total, starting on record %start%, ending on %end%'
));
?>
<nav>
     <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
     </ul>
 </nav>
<script type="text/javascript">
$(document).ready(function() {
    $('#MasterListingError').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
                $('#exportfile').removeAttr('disabled');
		$('#selecctall').attr('disabled','disabled');
            });
        }else{
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#selecctall').removeAttr('disabled','disabled');
            });        
        }
    });
   
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		$('#exportfile').removeAttr('disabled');
		$('#MasterListingError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#MasterListingError').removeAttr('disabled','disabled');
            }); 
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
            }); 
        }
    });
   
});
</script>    
<?php } 