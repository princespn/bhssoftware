<?php ?>
 <hr>
 <h1 class="sub-header"><?php __('Stock inventory information');?></h1>
 <?php //print_r($datastocks); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr>
	<th><?php __('SKU');?></th>
	<th><?php __('Item Title');?></th>
	<th><?php __('Purchase Price');?></th>
	<th><?php __('Category');?></th>
      <th><?php __('Stock Date');?></th>
      <th><?php __('Stock Level');?></th> 
     <th><?php __('Stock Value');?></th>
	 <th><?php __('Stock location');?></th>
	 <th><?php __('Stock Itemid');?></th>
	 
    
      </tr>
      </thead>
      <tbody>

<?php foreach ($datastocks as $datastock): ?>  
      <tr>     
		<td><?php echo $datastock['StockLevel']['item_number'];?></td>
		<td><?php echo $datastock['StockLevel']['item_title'];?></td>
	    <td><?php // echo round($datastock['PurchasePrice']['purchase_price'],2);?></td>
		<td><?php echo $datastock['StockLevel']['category_name'];?></td>
        <td><?php echo $datastock['StockLevel']['change_date']; ?></td>       
        <td><?php echo $datastock['StockLevel']['stock_lev']; ?></td>  
        <td><?php echo round($datastock['StockLevel']['stock_val'],2); ?></td>
		<td><?php echo $datastock['StockLevel']['location_name']; ?></td> 		
		<td><?php echo $datastock['StockLevel']['stock_itemid']; ?></td> 		
      </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>

