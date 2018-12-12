<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $price_listings[0]['Listing'];	
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($price_listings as $price_listing){		
$line = $price_listing['Listing'];
echo $csv->addRow($line);
}
$filename='prices_listings';
echo $csv->render($filename);
}else{	
// echo $this->Session->flash(); ?>
 <hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']; ?>
 <h1 class="sub-header"><?=__('Linnworks codes and All Prices Comparison');?></h1>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
   <?php  echo $this->Form->create('main-listings', ['url' => ['action' => 'index']]); ?>
        <div class="col-md-8 mobile-bottomspace">
         <?php echo $this->Form->control('error',array('label'=>'','type'=>'checkbox','value'=>'error','class'=>'wid-20')); ?><?= $this->Paginator->sort('error') ?><?php // echo $this->Paginator->sort('Error', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'main_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        <?php echo $this->Html->link(__('Replace Or Del sku', true), array('controller' => 'main_listings', 'action' => 'repdelcode'),array('class' => 'btn btn-info btn-sm')); ?>
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
         <th colspan="5"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></th>
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg"><?= __('Sale Price (GBP)');?></th>
          <th></th>
          <th colspan="7" class="text-center text-uppercase color-white eur-bg"><?= __('Sale Price (EUR)');?></th>         
        </tr>
       <tr>
        <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
         <th><?= __('Linnworks code');?></th>
           <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($categories as $category): ?>                     
                    <li><a href="<?php  echo  $actual_link ; ?>/main-listings/category/<?php  echo rawurlencode($category->CategoryName); ?>" target="_self"><?php  echo $category->CategoryName; ?></a></li>
                  <?php  endforeach; ?> 
                </ul>
              </li>
            </ul>
          </th>
          <th><?= __('Product name');?></th>
          <th class="<?= __('pink-price');?>"><?= __('RRP');?></th>
          <th><?= __('Web UK');?></th>
          <th><?= __('Tesco');?></th>
          <th><?= __('Amazon UK');?></th>
          <th><?= __('Amazon UK Prime');?></th>
          <th><?= __('Daily Mail');?></th> 
          <th><?= __('EBay');?></th>  
          <th class="<?= __('pink-price');?>"><?= __('RRP');?></th>
          <th><?= __('Web DE');?></th>
          <th><?= __('Amazon DE');?></th>
          <th><?= __('Amazon DE Prime');?></th>
          <th><?= __('Web FR');?></th>
          <th><?= __('Amazon FR');?></th>
          <th><?= __('Amazon FR Prime');?></th> 
          <th><?= __('CDiscount');?></th>  
        </tr>
      </thead>
      <tbody>
      <?php foreach ($mainListings as $mainListing): ?>
        <tr>
            <td><?php $productid = $this->Number->format($mainListing->id); if(!empty($mainListing->error)){$class ='checkerror';}else{$class ='checkbox1';}
            echo $this->Form->input('id',array('class'=>$class, 'selected'=>'selected','label'=>false,'multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($mainListing->error)){echo "&#8595;";} ?></td>
            <td class="wid-20"><?= h($mainListing->linnworks_code) ?></td>
            <td><?= h($mainListing->inventory_code->category) ?></td>
			  <td><?= h($mainListing->inventory_code->product_name) ?></td>          
            <td><?= h($mainListing->price_uk) ?></td>
            <td></td>
            <td></td>
             <td><?= h($mainListing->sale_price_uk) ?></td>
            <td><?= h($mainListing->sale_price_uk) ?></td>
            <td></td>
             <td><?= h($mainListing->sale_price_ebay) ?></td>
             <td><?= h($mainListing->price_de) ?></td> 
              <td></td>
              <td><?= h($mainListing->sale_price_de) ?></td>
              <td><?= h($mainListing->sale_price_de) ?></td>
               <td></td>
                <td><?= h($mainListing->sale_price_fr) ?></td>
				<td><?= h($mainListing->sale_price_fr) ?></td>
				<td><?= h($mainListing->sale_price_cdiscount) ?></td>

				
						 
			 </tr>
    <?php endforeach; ?>
  <?php echo $this->Form->end();?>
      </tbody>
    </table>
  </div>
 <hr>
<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
<ul class="pagination pagination-sm margin-0">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
</ul>
<script type="text/javascript">
$(document).ready(function() {
    $('#error').click(function(event) {  //on click
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
		$('#error').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#error').removeAttr('disabled','disabled');
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
