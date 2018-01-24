 <hr>
 <h1 class="sub-header"><?php __('Stock value reports ');?></h1>
 <?php //print_r($orders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      	<th><?php __('Category');?></th>
      	<th><?php __('UK Stock value');?></th>
	<th><?php __('FBA UK Stock value');?></th>
	 <th><?php __('FBA DE Stock value');?></th>
	<th><?php __('FBA FR Stock value');?></th>
	<th><?php __('FBA ES Stock value');?></th>
	<th><?php __('Total Stock value');?></th>       
       </tr>
      </thead>
      <tbody>

<?php foreach ($datastocks as $order): ?>  
      <tr>
      <td><?php echo $order['StockLevel']['category_name'] ?></td>
      <td><?php echo  $order[0]['stockvalues']; ?></td> 
	<td><?php echo  $order[0]['ukfba_stockvalues']; ?></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>	   
       </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
</div>
