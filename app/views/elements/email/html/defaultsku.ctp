<?php echo $content_for_layout; ?>
<h1 class="sub-header"><?php __('E-mail Notification of Open Orders');?></h1>
<hr>
 <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
 <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-md-8 mobile-bottomspace">
                <div class="col-md-4">             
              <ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category name: <span class="caret"></span></a>
              <ul class="dropdown-menu">
                   <?php foreach ($categories as $Catna): ?>    
                     <li><a href="<?php echo  $actual_link ; ?>/processed_listings/productsku_notifications/<?php echo rawurlencode($Catna->CategoryName); ?>" target="_self"><?php echo $Catna->CategoryName; ?></a></li>
                 <?php endforeach; ?>
                </ul>
              </li>
            </ul>         
        </div>       
       </div>
       <?php  echo $form->create('ProcessedListing',array('action'=>'productsku_notifications')); ?>
        <div class="col-md-4">
         <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php echo $this->Form->input('productskuname',array('label'=>'','placeholder'=>'Search Product SKU...', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>
        <?php echo $this->Form->end();?>
      </div>
    </div>
  </div> 
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
     <thead><tr>
				<th><strong><?php __('Product sku');?></strong></th>
			   <th><strong><?php __('Sales Platform');?></strong></th>
			   <th><strong><?php __('Sales Channel');?></strong></th>
			   <th><strong><?php __('Currency');?></strong></th>
			   <th><strong><?php __('Current(C)');?></strong></th>
			   <th><strong><?php __('Old(L)');?></strong></th>
			   <th><strong><?php __('(C-L/L)');?></strong></th>
			   </tr></thead> 
		<?php  $a = '0'; foreach ($saveproductskutodays as $value): ?>  
        <?php $b = $value['ProcessedListing']['product_sku']; ?>
		<?php $oldorder = array(); $currorder = array(); $oldform = array(); $oldsource = array(); $oldcurency = array(); ?>
		<?php foreach ($saveproductskusamedays as $oldRecords): ?>				
					<?php if(($value['ProcessedListing']['product_sku'] === $oldRecords['ProcessedListing']['product_sku']) && ($value['ProcessedListing']['subsource'] === $oldRecords['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $oldRecords['ProcessedListing']['plateform'])) {?>
					<?php 
					$oldorder[] = $oldRecords[0]['orderid']; 
					$currorder[] = $value[0]['orderid']; 
					$oldform[] = $oldRecords['ProcessedListing']['plateform'];
					$oldsource[] = $oldRecords['ProcessedListing']['subsource'];
					$oldcurency[] = $oldRecords['ProcessedListing']['currency'];
					 ?>					 
				<?php } ?>					
		<?php endforeach; ?> 					
     	<?php if((!empty($oldorder[0])) && (!empty($currorder[0]))){?>
				<?php $percentorder = ((($currorder[0] - $oldorder[0])/$oldorder[0])*100);   
				if(($percentorder <=-20) || ($percentorder >=20)) { ?>
								
		<?php if($a!==$b){ echo "<tr><td colspan='7'><table class='table-responsive'><tr><td colspan='7'>".$b."</td></tr></table>";} ?>
        <?php // if($a!==$b) {  ?>                                               
            <?php // } ?> 
            <?php // $a = $b; ?>					
						<tr>
						<td></td>
						<td><?php echo $oldform[0]; ?></td>
						<td><?php echo  $oldsource[0]; ?></td>                                 
						<td><?php echo $oldcurency[0]; ?></td>
						<td><?php echo $currorder[0]; ?></td>                                 
						<td><?php  echo $oldorder[0]; ?></td>
						<td><?php  if($percentorder <=-20){ echo "<div class='rTableCell color-red'>".round($percentorder,2)."%"."</div>";}else if($percentorder >=20){ echo "<div class='rTableCell green'>".round($percentorder,2)."%"."</div>";} ?></td>
						</tr>     
       <?php $a = $b; ?>
         <?php if($a!==$b) { echo "</td></tr>";} ?>
				<?php } ?>
				<?php } ?>
         <?php endforeach; ?>     
    </table>
 </div>