<?php //print_r($Skucurrentsweeks);  ?>
<h1 class="sub-header"><?php __('Daily Sales Report per category');?></h1>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
	    <div class="col-md-12">
	    <div class="col-md-5">
		</div>
      <?php  echo $form->create('',array('action'=>'','id'=>'saveForm')); ?>
        <div class="col-md-5">
         <div class="form-group margin-bottom-0">
			<div class="input-group">
				<span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
				<?php echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product SKU...', 'class'=>'form-control pa-left')); ?>
				<div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
			</div>
          </div>
        </div>
      </div>
	 </div>
    </div>
  </div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <thead>
	<tr>
	<th><?php __('Item'); ?><?php __(' SKU'); ?></th>   
	<th><?php __('Item'); ?><?php __(' Title'); ?></th>
	<th><?php __('Category'); ?></th>
	<th><?php __('Current Week'); ?></th>	
	<th><?php __('Last Week'); ?></th>
	<th><?php __('Same Week last Year'); ?></th>
	<th><?php __('Current Month'); ?></th>
	<th><?php __('Last Month'); ?></th>
	<th><?php __('Current YTD'); ?></th>
	<th><?php __('Previous YTD'); ?></th>	
	</tr>
    </thead>
		
		<?php  foreach ($CatSaveallweeks as $value): ?>  
        
		<tr>
		<td><?php echo $value['ProcessedListing']['product_sku']; ?><?php echo "( ".$value[0]['orderid']." )" ?></td>
        <td><?php echo $value['ProcessedListing']['product_name']; ?></td>
        <td><?php echo $value['ProcessedListing']['cat_name']; ?></td>
		<?php $currday_Rep = 0; foreach($Skucurrentsweeks as $currday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $currday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $currday_Report['ProcessedListing']['cat_name'])){?>
		<?php $currday_Rep = $currday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $currday_Rep; ?></td>
		<?php $prevday_Rep = 0; foreach($Skupreviousweeks as $prevday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $prevday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $prevday_Report['ProcessedListing']['cat_name'])){?>
		<?php $prevday_Rep = $prevday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $prevday_Rep; ?></td>
		<?php $lastday_Rep = 0; foreach($Skulastweeks as $lastday_Report): ?>
		<?php  if(($value['ProcessedListing']['product_sku'] === $lastday_Report['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['cat_name'] === $lastday_Report['ProcessedListing']['cat_name'])){?>
		<?php $lastday_Rep = $lastday_Report[0]['orderid']; ?>
		<?php break;} ?>
		<?php endforeach; ?>  
		<td><?php echo $lastday_Rep; ?></td>
		
		
		
		<tr>
		
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
 