<hr>
 <h1 class="sub-header"><?php __('Purchase Price information');?></h1>
 <?php //print_r($datastocks); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      <th><?php __('stock id');?></th>
      <th><?php __('Item Number');?></th> 
     <th><?php __('Item Title'); ?></th>
	 <th><?php __('Quantity');?></th>
	<th><?php __('Tax');?></th> 
     <th><?php __('Cost');?></th> 
	<th><?php __('Purchase Price');?></th>
	<th><?php __('Date');?></th>  
      </tr>
      </thead>
      <tbody>

<?php foreach ($datastocks as $datastock): ?>  
      <tr> 
		<td><?php echo $datastock['PurchasePrice']['stock_itemid'];?></td>
		<td><?php echo $datastock['PurchasePrice']['item_sku'];?></td>
		<td><?php echo $datastock['PurchasePrice']['item_title'];?></td>
		<td><?php echo $datastock['PurchasePrice']['quantity'];?></td>
		<td><?php echo $datastock['PurchasePrice']['tax'];?></td>
       	<td><?php echo $datastock['PurchasePrice']['cost'];?></td>
       <td><?php echo $datastock['PurchasePrice']['purchase_price'];?></td>
	   <td><?php echo $datastock['PurchasePrice']['purchase_date'];?></td>
       
       
	  </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
 <p><nav><?php //print_r($pagination); ?></nav></p>
