<?php 
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
//$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
if(((empty($sale_fbauk)) && (!empty($sale_fbagerman))) && (!empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,array('0.00'),$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
} else if(((!empty($sale_fbauk)) && (empty($sale_fbagerman))) && (!empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,array('0.00'),$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
} else if(((!empty($sale_fbauk)) && (!empty($sale_fbagerman))) && (empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,array('0.00'),$sale_error);
} else if(((empty($sale_fbauk)) && (empty($sale_fbagerman))) && (empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,array('0.00'),$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,array('0.00'),$web_fr,$sale_price_fr,array('0.00'),$sale_error);
} else if(((empty($sale_fbauk)) && (empty($sale_fbagerman))) && (!empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,array('0.00'),$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,array('0.00'),$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
} else if(((empty($sale_fbauk)) && (!empty($sale_fbagerman))) && (empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,array('0.00'),$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,array('0.00'),$sale_error);
} else if(((!empty($sale_fbauk)) && (empty($sale_fbagerman))) && (empty($sale_fbfrance))){
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,array('0.00'),$web_fr,$sale_price_fr,array('0.00'),$sale_error);
} else{
$line = array_merge($line_code, $line_cate,$line_name,$line_ams,$line_sku,$web_uk_rp,$tasko_rp,$uk_rp,$web_uk,$web_tasko,$web_dm,$sale_price_uk,$sale_fbauk,$web_rrp_de,$rrp_de,$web_rrp_fr,$rrp_fr,$web_de,$sale_price_de,$sale_fbagerman,$web_fr,$sale_price_fr,$sale_fbfrance,$sale_error);
}
echo $csv->addRow($line);
endforeach;

$filename='code_listings';
echo $csv->render($filename);
}else{	
 ?>
 <hr>
 <?php //print_r($Amazonuk); die();?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
 <h1 class="sub-header"><?php __('Master listing database');?></h1>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  //echo $form->create('MasterListing',array('action'=>'index','id'=>'saveForm')); ?>
        <div class="col-md-8 mobile-bottomspace">
         <!--<?php //echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php //echo $this->Paginator->sort('Error', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>-->
        <?php //if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'master_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?><?php // } ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
         <?php //if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Replace Or Del sku', true), array('controller' => 'master_listings', 'action' => 'repdelcode'),array('class' => 'btn btn-info btn-sm')); ?><?php // } ?>
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
 <div class="table-responsive catname">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table">
         <th colspan="5"><p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p></th>
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg"><?= __('Sale Price (GBP)');?></th>
          <th></th>
          <th colspan="7" class="text-center text-uppercase color-white eur-bg"><?=__('Sale Price (EUR)');?></th>         
        </tr>
        <tr>
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
         <th><?=__('Linnworks Code');?></th>
           <!--<th class="wid-20"><?=__('Amazon SKU');?></th>-->
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php // $Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php // foreach ($Catname as $Catna): ?>
                     <li><a href="<?php // echo  $actual_link ; ?>/master_listings/category/<?php // echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php // echo $Catna->CategoryName; ?></a></li>
                 <?php // endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>
          <th><?= __('Product name');?></th>
          <th class="<?= __('pink-price');?>"><?=__('RRP');?></th>
          <th><?=__('Web UK');?></th>
          <th><?=__('Tesco');?></th>
          <th><?= __('Amazon UK');?></th>
          <th><?= __('Amazon UK Prime');?></th>
          <th><?= __('Daily Mail');?></th>
          <th><?= __('EBay');?></th>          
          <th class="<?= __('pink-price');?>"><?= __('RRP');?></th>
          <th><?= __('Web DE');?></th>
          <th><?=__('Amazon DE');?></th>
          <th><?=__('Amazon DE Prime');?></th>
          <th><?= __('Web FR');?></th>
          <th><?= __('Amazon FR');?></th>
          <th><?= __('Amazon FR Prime');?></th>
          <th><?= __('CDiscount');?></th>  
        </tr>
      </thead>
      <tbody>
<?php foreach ($masterListings as $code_listing): ?>
        <tr>
		<td><?php $productid = $this->Number->format($code_listing->id); if(!empty($code_listing->error)){$class ='checkerror';}else{$class ='checkbox1';}
            echo $this->Form->input('id',array('class'=>$class, 'selected'=>'selected','label'=>false,'multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($code_listing->error)){echo "&#8595;";} ?></td>
        <td class="wid-20"><?= h($code_listing->linnworks_code) ?></td>
        <td><?= h($code_listing->inventory_code->category) ?></td>
		<td><?= h($code_listing->inventory_code->product_name) ?></td>      
         <td class="pink-price"><?php  echo $code_listing->linnworks_code; ?></td>             
         <td  class="pink-price"><?php  echo $code_listing->price_de; ?></td>
        
    
   
        </tr>
    <?php endforeach; ?>
    <?php echo $this->Form->end();?>
      </tbody>
    </table>
  </div>
<hr>
  <nav>
        <ul class="pagination pagination-sm margin-0">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
   </nav>
<?php } 