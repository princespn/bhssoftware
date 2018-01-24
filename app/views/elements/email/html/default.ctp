<?php echo $content_for_layout; ?>
 <div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
  <thead><tr>
   <th><strong><?php __('Sales Platform');?></strong></th>
   <th><strong><?php __('Sales Channel');?></strong></th>
   <th><strong><?php __('Currency');?></strong></th>
   <th><strong><?php __('Current(C)');?></strong></th>
   <th><strong><?php __('Old(L)');?></strong></th>
   <th><strong><?php __('(C-L/L)');?></strong></th>
   </tr></thead>
   
 <?php foreach ($savetodays as $value): ?>
  
	<?php foreach ($savesamedays as $oldRecords): ?>
 
 
 <?php if((!empty($oldRecords['ProcessedListing']['plateform'])) && (!empty($oldRecords['ProcessedListing']['subsource']))){?>
						<?php if(($value['ProcessedListing']['subsource'] === $oldRecords['ProcessedListing']['subsource']) && ($value['ProcessedListing']['plateform'] === $oldRecords['ProcessedListing']['plateform']) && ($value['ProcessedListing']['currency'] === $oldRecords['ProcessedListing']['currency'])) {?>
						<tr>
						<td><?php echo $oldRecords['ProcessedListing']['plateform']; ?></td>
						<td><?php echo $oldRecords['ProcessedListing']['subsource'];?></td>
						<td><?php echo $oldRecords['ProcessedListing']['currency'];?></td>
						<td><?php $currorder = $value[0]['orderid'];  echo $currorder; ?></td>
						<td><?php $oldorder = $oldRecords[0]['orderid'];  echo $oldorder; ?></td>
						<?php $percentorder = ((($currorder - $oldorder)/$oldorder)*100);  //echo $percentorder; ?>
						<td><?php  if($percentorder < 0){ echo "<div class='rTableCell color-red'>".round($percentorder,2)."%"."</div>";}else { echo "<div class='rTableCell green'>".round($percentorder,2)."%"."</div>";} ?></td>
						</tr>
				<?php } ?>
		<?php } ?>
	 <?php endforeach; ?> 
 <?php endforeach; ?>
</table>
</div> 
