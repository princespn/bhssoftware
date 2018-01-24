<?php ?>
<hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];  //print_r($Amazonuk[]);?>
<h1 class="sub-header"><?php __('Stock value Reports ');?></h1>
<div class="panel panel-default" >
        <?php  echo $form->create('StockItem',array('action'=>'index')); ?>
		<div class="panel-body" ng-app="">
		<!--<div class="row">
			<div class="col-md-12 mobile-bottomspace">
            <div class="col-md-4"><b>Date Selection</b></div><div class="col-md-4"><?php echo $this->Form->input('date_from',array('label'=>false,'div'=>false,'id'=>'date_from','placeholder'=>'yyyy-mm-dd', 'class'=>'form-control'));?></div><div class="col-md-3 input-group-btn"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
			</div>          
		</div><hr>-->
		      
		<div class="row">
		<div class="col-md-4"></div>
			<div class="col-md-5 mobile-bottomspace">
			 <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Item SKU...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
       		</div> 
			</div> 
		<div class="col-md-3"></div>			
		</div>
		</div>
   <?php echo $this->Form->end();?>
  </div> 
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
     <thead>      
      <tr> 
    <th><?php __('Item SKU');?></th>
	<th><?php __('Title');?></th>
	<th><?php __('Landed');?></br><?php __('Price'); ?></th>
	<th><?php __('Purchase');?></br><?php __('Price'); ?></th>
	<th><?php __('Invoice');?></br><?php __('Currency'); ?></th>
	 <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php // $Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($Catname as $Catna): ?>
                     <li><a href="<?php echo  $actual_link ; ?>/stock_items/category/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>
	<th><?php __('UK Stock');?></th>
	<th><?php __('Waterfall');?></br><?php __('Lane Stock');?></th>
	<th><?php __('FBA UK Stock');?></th>
	<th><?php __('FBA FR Stock');?></th>
	<th><?php __('FBA DE Stock');?></th>
	<th><?php __('FBA ES Stock');?></th>
	<th><?php __('Stock');?></br><?php __('value in');?></br><?php __('(GBP,PP)'); ?></th>
	<th><?php __('Stock');?></br><?php __('value in');?></br><?php __('(GBP,LP)'); ?></th>
	</tr>
      </thead>
      <tbody>
 <?php foreach ($stocks as $stock): ?>  
      <tr>
       		<td><?php echo $stock['StockItem']['item_number']; ?></td>
			<td><?php echo $stock['StockItem']['item_title']; ?></td>
			<td><?php echo $stock['CostCalculator']['landed_price_gbp']; ?></td>
			<td><?php echo round($stock['PurchasePrice']['purchase_price'],2); ?></td>
			<td><?php echo $stock['CostCalculator']['invoice_currency']; ?></td>
			<td><?php echo $stock['StockItem']['category_name']; ?></td>	
		    <td>
			 <?php $uk = array(); foreach ($ukstocks as $ukstock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $ukstock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $ukstock['StockLevel']['item_number'])){
			$uk[] = $ukstock['StockLevel']['stock_lev']; echo $ukstock['StockLevel']['stock_lev'];
			 }
			 ?>
			<?php endforeach; ?>   
			</td>
			<td>
			<?php $water = array(); foreach ($waterstocks as $waterstock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $waterstock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $waterstock['StockLevel']['item_number'])){
				$water[] = $waterstock['StockLevel']['stock_lev']; echo $waterstock['StockLevel']['stock_lev'];
			 }
			 ?>
			<?php endforeach; ?>   
			</td>			
			<td>
			 <?php $ukfba = array(); foreach ($ukfbastocks as $ukfbastock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $ukfbastock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $ukfbastock['StockLevel']['item_number'])){
				$ukfba[] = $ukfbastock['StockLevel']['stock_lev']; echo $ukfbastock['StockLevel']['stock_lev'];
			 }
			 ?>
			<?php endforeach; ?>   
			</td>
			<td>
			 <?php $frfba = array(); foreach ($frfbastocks as $frfbastock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $frfbastock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $frfbastock['StockLevel']['item_number'])){
			$frfba[] = $frfbastock['StockLevel']['stock_lev']; echo $frfbastock['StockLevel']['stock_lev'];
			 }
			 ?>
			<?php endforeach; ?>   
			</td>
			<td>
			 <?php $gerfba = array();foreach ($gerfbastocks as $gerfbastock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $gerfbastock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $gerfbastock['StockLevel']['item_number'])){
			$gerfba[] = $gerfbastock['StockLevel']['stock_lev']; echo $gerfbastock['StockLevel']['stock_lev'];
			 }
			 ?>

			<?php endforeach; ?>   
			</td>
			<td>
			 <?php $esfba = array(); foreach ($esfbastocks as $esfbastock): ?>			
			<?php if(($stock['StockItem']['barcode_number'] === $esfbastock['StockLevel']['barcode_number']) && ($stock['StockItem']['item_number'] === $esfbastock['StockLevel']['item_number'])){
			$esfba[] = $esfbastock['StockLevel']['stock_lev']; echo $esfbastock['StockLevel']['stock_lev'];
			 }
			 ?>
			<?php endforeach; ?>   
			</td>			
			<td><?php $finalnum = $uk[0]+$ukfba[0]+$frfba[0]+$gerfba[0]+$esfba[0]; $pp = round($stock['PurchasePrice']['purchase_price'],2); $finalpp = $pp*$finalnum; if($stock['CostCalculator']['invoice_currency']==='EUR'){echo round($finalpp*0.89,2);}else if($stock['CostCalculator']['invoice_currency']==='USD'){echo round($finalpp*0.76,2);}else if($stock['CostCalculator']['invoice_currency']==='INR'){echo round($finalpp*0.01,2);}else {echo $finalpp;} ?></td>
			<td><?php  $lp = round($stock['CostCalculator']['landed_price_gbp'],2); $finallp = $lp*$finalnum; echo $finallp; ?></td>
		</tr> 
    <?php endforeach; ?>   
      </tbody>
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
