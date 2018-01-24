 <hr>
 <h1 class="sub-header"><?php __('Stock inventory information');?></h1>
 <?php //print_r($orders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      <th><?php __('Date');?></th>
      <th><?php __('Item sku');?></th> 
     <th><?php __('Item Title');?></th>
     <th><?php __('Stock ItemId');?></th>   
      </tr>
      </thead>
      <tbody>

<?php foreach ($orders as $order): ?>  
      <tr>     
     
        <td><?php echo $this_week_sd; ?></td>       
        <td><?php echo $order->ItemNumber;?></td>  
        <td><?php echo $order->ItemTitle;?></td> 
         <td><?php echo $order->StockItemId;?></td>
		 
      </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
 <p><nav><?php //print_r($pagination); ?></nav></p>
<a href="#" onclick="pageloader();">Click here</a>
<script>
function pageloader()
{
<?php for ($i=1; $i<=200; $i++) { ?>
 window.open("http://ukwalahome.com/stock_levels/?page=<?php echo $i; ?>", '_blank');
<?php } ?>
}
</script>
<?php  echo "Amit kumar tiwari";