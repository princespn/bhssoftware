<h1 class="sub-header"><?php __('Settings');?></h1>
<?php echo $this->Session->flash(); ?>
 <hr>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('PurchaseOrder',array('action'=>'settings','id'=>'currency')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Currency Master Information');?></h1>
            </div>
          
          <div class="col-md-12 mobile-bottomspace">          
                 <div class="col-md-3"><?php $base_currency = array('GBP'=>'GBP','EUR'=>'EUR'); echo $this->Form->input('sale_base_currency',array('placeholder'=>'Sale Base Currency..','options'=>$base_currency)); ?></div>
                 <div class="col-md-3"><?php $invoice_currency = array('GBP'=>'GBP','EUR'=>'EUR','USD'=>'USD'); echo $this->Form->input('invoice_currency',array('placeholder'=>'Invoice Currency..','options'=>$invoice_currency)); ?></div>
                  <div class="col-md-3"><?php echo $this->Form->input('exchange_rate',array('placeholder'=>'Exchange Rate')); ?></div>
                 <div class="col-md-3"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>       
         </div>       
       <?php echo $this->Form->end();?>      
      </div>
     </div>
</div>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>       
        <tr>
          <th></th>
          <th><?php __('Sale/Base Currency');?></th>
          <th><?php __('Invoice Currency');?></th>
          <th><?php __('Exchange Rate');?></th>
          <th></th>         
        </tr>
      </thead>
      <tbody>
      <?php foreach ($exchange_rates as $exchange_rate): ?>
        <tr>         
          <td></td>
           <td><?php echo $exchange_rate['PurchaseOrder']['sale_base_currency']; ?></td>
          <td><?php echo $exchange_rate['PurchaseOrder']['invoice_currency']; ?></td>
          <td><?php echo $exchange_rate['PurchaseOrder']['exchange_rate']; ?></td>
          <td></td>
          </tr>
          <?php endforeach; ?>  
      </tbody>
    </table>
 </div>
<!-- supplier information -->
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('PurchaseOrder',array('action'=>'settings','id'=>'supplier')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Supplier Multiplier Master Information');?></h1>
            </div>          
          <div class="col-md-12 mobile-bottomspace">       
              <div class="col-md-3"><strong><?php __('Category'); ?></strong><select id="category" name="data[PurchaseOrder][category]"><option value='--Select Category--'>--Select Category--</option><?php $option = $this->requestAction('/purchase_orders/categories');foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';} echo '<option'.' '.$select.' '.'value='.rawurlencode($option).'>'.$option.'</option>';}?></select></div>
                 <div class="col-md-3"><strong><?php __('Supplier'); ?></strong><select id="supplier" name="data[PurchaseOrder][supplier]"><option value='--Select Supplier--'>--Select Supplier--</option><?php $suppliers = $this->requestAction('/purchase_orders/suppliers');foreach ($suppliers as $key => $supplier){if($foo==$supplier){$select='selected=selected';}else {$select='';} echo '<option'.' '.$select.' '.'value='.rawurlencode($supplier).'>'.$supplier.'</option>';}?></select></div>
                  <div class="col-md-3"><?php echo $this->Form->input('multiplier',array('placeholder'=>'Multiplier')); ?></div>
                 <div class="col-md-3"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>       
         </div>       
       <?php echo $this->Form->end();?>        
      </div>
    </div>
</div>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>       
        <tr>
          <th></th>
          <th><?php __('Category');?></th>
          <th><?php __('Supplier');?></th>
          <th><?php __('Multiplier');?></th>
          <th></th>         
        </tr>
      </thead>
      <tbody>
       <?php foreach ($supplier_orders as $supplier_order): ?>
        <tr>         
          <td></td>
           <td><?php echo $supplier_order['PurchaseOrder']['category']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['supplier']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['multiplier']; ?></td>
          <td></td>
          </tr>
        <?php endforeach; ?>    
      </tbody>
    </table>
 </div>
<!-- sales price multipliers -->
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
      <?php  echo $form->create('PurchaseOrder',array('action'=>'settings','id'=>'sales')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Sales Price Multiplier');?></h1>
            </div>
          
          <div class="col-md-12 mobile-bottomspace"> 
                <div class="col-md-3"><?php $base_sale_currency = array('GBP','EUR','USD'); echo $this->Form->input('sale_base_currency',array('placeholder'=>'Sale Base Currency..','options'=>$base_currency)); ?></div>
                <div class="col-md-3"><strong><?php __('Category'); ?></strong><select id="Inventory" name="data[PurchaseOrder][category]"><option value='--Select Category--'>--Select Category--</option><?php $option = $this->requestAction('/purchase_orders/categories');foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';} echo '<option'.' '.$select.' '.'value='.rawurlencode($option).'>'.$option.'</option>';}?></select></div>
                <div class="col-md-3"><strong><?php __('Supplier'); ?></strong><select id="supplier" name="data[PurchaseOrder][supplier]"><option value='--Select Supplier--'>--Select Supplier--</option><?php $suppliers = $this->requestAction('/purchase_orders/suppliers');foreach ($suppliers as $key => $supplier){if($foo==$supplier){$select='selected=selected';}else {$select='';} echo '<option'.' '.$select.' '.'value='.rawurlencode($supplier).'>'.$supplier.'</option>';}?></select></div>
                <div class="col-md-3"><?php echo $this->Form->input('sp1_multiplier',array('placeholder'=>'SP1 Multiplier')); ?></div>
          </div>
          <div class="col-md-12 margin-bottom-0 mobile-bottomspace">
                <div class="col-md-3"><?php echo $this->Form->input('sp2_multiplier',array('placeholder'=>'SP2 Multiplier')); ?></div>
                <div class="col-md-3"><?php echo $this->Form->input('sp3_multiplier',array('placeholder'=>'SP3 Multiplier')); ?></div>
                 <div class="col-md-3"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>       
         </div>       
       <?php echo $this->Form->end();?>      
      </div>
   </div>
</div>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>       
        <tr>
          <th></th>
          <th><?php __('Sale/Base Currency');?></th>
          <th><?php __('Category');?></th>
          <th><?php __('Supplier');?></th>
          <th><?php __('SP1 Multiplier');?></th>
          <th><?php __('SP2 Multiplier');?></th>
          <th><?php __('SP3 Multiplier');?></th>
          <th></th>         
        </tr>
      </thead>
      <tbody>
        <?php foreach ($supplier_orders as $supplier_order): ?>
        <tr>         
          <td></td>
          <td><?php echo $supplier_order['PurchaseOrder']['sale_base_currency']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['category']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['supplier']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['sp1_multiplier']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['sp2_multiplier']; ?></td>
          <td><?php echo $supplier_order['PurchaseOrder']['sp3_multiplier']; ?></td>
          <td></td>
          </tr>  
             <?php endforeach; ?>    
      </tbody>
    </table>
 </div>