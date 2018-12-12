 <hr>
 <h1 class="sub-header"><?php __('Processed Orders');?></h1>
 <?php //print_r($orders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      <th><?= __('OrderId');?></th>
      <th><?= __('Currency');?></th> 
     <th><?= __('Plateform');?></th>
     <th><?= __('SubSource');?></th>
      <th><?=  __('Product SKU');?></th>
      <th><?=  __('Category');?></th>
      <th><?= __('Product name');?></th>
       <th><?= __('Quantity');?></th>
       <th><?= __('Cost PerUnit');?></th>       
       <th><?= __('Order Date');?></th>
       <th><?= __('Order value');?></th> 
       </tr>
      </thead>
      <tbody>

<?php foreach ($orders as $order): ?>  
      <tr>     
        <td><?php echo $order->GeneralInfo->ExternalReferenceNum; ?></td>       
        <td><?php echo $order->TotalsInfo->Currency;?></td>  
        <td><?php echo $order->GeneralInfo->Source;?></td> 
         <td><?php echo $order->GeneralInfo->SubSource;?></td>
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if (isset($order->Items[$i]->SKU)) {echo $order->Items[$i]->SKU; echo "</BR>";} ?>    
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>
         <?php if (isset($order->Items[$i]->CategoryName)) {echo $order->Items[$i]->CategoryName; echo "</BR>";} ?>    
           <?php } ?></td> 
          <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if (isset($order->Items[$i]->Title)) { echo $order->Items[$i]->Title; echo "</BR>"; }  ?>  
          <?php } ?></td> 
           <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if (isset($order->Items[$i]->Quantity)) { echo  $quantity = $order->Items[$i]->Quantity; echo "</BR>"; }?>    
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if (isset($order->Items[$i]->CostIncTax)) { echo  $order->Items[$i]->CostIncTax; echo "</BR>";} ?>    
         <?php } ?></td>
         <td><?php echo $order->GeneralInfo->ReceivedDate; ?></td>        
         <td><?php echo number_format($order->TotalsInfo->TotalCharge,2);?></td>        
          <?Php //if($order->GeneralInfo->SubSource ==='Germany'){$Gersum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='United Kingdom'){$Uksum+= $order->TotalsInfo->TotalCharge; } ?>
           <?Php //if($order->GeneralInfo->SubSource ==='EBAY0'){$Ebsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='France'){$Frsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='Tesco UK'){$Tessum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='http://www.homescapesonline.com'){$Magsum+= $order->TotalsInfo->TotalCharge; } ?>        
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
<?php for ($i=1; $i<=400; $i++){ ?>
 window.open("http://kool.ukwalahome.com/processed_orders/?page=<?php echo $i; ?>", '_blank');
<?php } ?>
}
</script>
<?php  echo "Amit kumar tiwari";