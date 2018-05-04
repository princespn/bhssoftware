<?php 
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<h1 class="sub-header"><?php __('Settings');?></h1>
<?php echo $this->Session->flash(); ?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']; //echo $MinDevalue;?>
 <hr>
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
     <?php  echo $form->create('CostSetting',array('action'=>'add','id'=>'sales')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Currency Master Information');?></h1>
            </div>
          
          <div class="col-md-12 mobile-bottomspace">          
                 <div class="col-md-2"><?php $base_currency = array('GBP'=>'GBP','EUR'=>'EUR'); echo $this->Form->input('sale_base_currency',array('placeholder'=>'Sale Base Currency..','options'=>$base_currency)); ?></div>
                 <div class="col-md-2"><?php $invoice_currency = array('GBP'=>'GBP','EUR'=>'EUR','USD'=>'USD','INR'=>'INR'); echo $this->Form->input('invoice_currency',array('placeholder'=>'Invoice Currency..','options'=>$invoice_currency)); ?></div>
                 <div class="col-md-3"><?php echo $this->Form->input('exchange_rate',array('placeholder'=>'Exchange Rate')); ?></div>
                 <div class="col-md-3"><?php echo $this->Form->input('variation',array('placeholder'=>'Dynamic variation')); ?></div>
                 <div class="col-md-2"><?php echo $this->Form->button('Submit', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>       
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
          <th><?php __('Exchange Rate Use API');?></th>
          <th><?php __('Dynamic variation');?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($getCost as $exchange_rate): ?>
        <tr>         
          <td></td>
           <td><?php echo $exchange_rate['CostSetting']['sale_base_currency']; ?></td>
          <td><?php echo $exchange_rate['CostSetting']['invoice_currency']; ?></td>
          <td><?php echo $exchange_rate['CostSetting']['exchange_rate']; ?></td>
         
           <td><?php  $amount = "1"; $from = $exchange_rate['CostSetting']['invoice_currency']; $to =  $exchange_rate['CostSetting']['sale_base_currency'];
                                    //$url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
                                   //$url  = "http://rate-exchange.herokuapp.com/fetchRate?from=$from&to=$to";
								 /*  $url  = "https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to";
                                   
								   $data = file_get_contents($url);
								   $get = explode("<span class=bld>",$data);
									$get = explode("</span>",$get[1]);  
									$converted = preg_replace("/[^0-9\.]/", null, $get[0]);
																		
                                   //$yummy = json_decode($data);
								   //print_r($converted_amount);die();
                                   //$converted = $yummy->{'Rate'};
                                   $ExRate = round($converted, 2);                          
                                   if($ExRate =='0'){echo "1";}else {echo $ExRate;}*/                                 
                                   ?></td> 
            <td><?php echo $exchange_rate['CostSetting']['variation']; ?></td>
          </tr>
          <?php endforeach; ?>  
      </tbody>
    </table>
 </div>
<!-- supplier information -->
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <?php  echo $form->create('Multiplier',array('action'=>'add','id'=>'sales')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Supplier Multiplier Master Information');?></h1>
            </div>          
            <div class="col-md-12 mobile-bottomspace">       
                    <div class="col-md-3"><strong><?php __('Category'); ?></strong><select id="category" name="data[Multiplier][category]">
                    <option value=''><?php __('Please select category.');?></option>
                    <?php foreach ($categories as $category): ?>
                    <?php if((!empty($options)) && ($options===$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($category->CategoryName) .'>'. $category->CategoryName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>
                    <div class="col-md-3"><strong><?php __('Supplier'); ?></strong><select id="supplier" name="data[Multiplier][supplier]">
                    <option value=''><?php __('Please select supplier.');?></option>
                    <?php foreach ($suppname as $supplier): ?>
                    <?php if((!empty($options)) && ($options===$supplier->SupplierName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($supplier->SupplierName) .'>'. $supplier->SupplierName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>
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
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php //$Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo  $actual_link ; ?>/purchase_orders/settings/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul></th>
           <th><?php __('Supplier');?></th>          
          <th><?php __('Multiplier');?></th>
          <th class="wid-20"><?php __('Action');?></th>  
          <th></th>         
        </tr>
      </thead>
      <tbody>
       <?php foreach ($getMultiplier as $multiplier_order): ?>
        <tr>         
          <td></td>
          <td><?php echo $multiplier_order['Multiplier']['category']; ?></td>
          <td><?php echo $multiplier_order['Multiplier']['supplier']; ?></td>
          <td><?php echo $multiplier_order['Multiplier']['multiplier']; ?></td>
          <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'multipliers','action' => 'delete',$multiplier_order['Multiplier']['id']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $multiplier_order['Multiplier']['id']));  ?></td>
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
     <?php  echo $form->create('SupplierMultiplier',array('action'=>'add','id'=>'supplir')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Sales Price Multiplier');?></h1>
            </div>
          
          <div class="col-md-12 mobile-bottomspace"> 
                <div class="col-md-3"><?php $base_curr = array('GBP'=>'GBP','EUR'=>'EUR','USD'=>'USD'); echo $this->Form->input('invoice_currency',array('options'=>$base_curr)); ?></div>
                <div class="col-md-3"><strong><?php __('Category'); ?></strong><select id="category" name="data[SupplierMultiplier][category]">
                    <option value='category'><?php __('Please select category.');?></option>
                    <?php foreach ($categories as $category): ?>
                    <?php if((!empty($options)) && ($options===$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($category->CategoryName) .'>'. $category->CategoryName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>
                     <div class="col-md-3"><strong><?php __('Supplier'); ?></strong><select id="supplier" name="data[SupplierMultiplier][supplier]">
                    <option value=''><?php __('Please select supplier.');?></option>
                    <?php foreach ($suppname as $supplier): ?>
                    <?php if((!empty($options)) && ($options===$supplier->SupplierName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($supplier->SupplierName) .'>'. $supplier->SupplierName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>                   
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
          <th><?php __('Sale/Base Currency');?></th>
           <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php //$Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo  $actual_link ; ?>/purchase_orders/settings/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul></th>
           <th><?php __('Supplier');?></th>         
          <th><?php __('SP1 Multiplier');?></th>
          <th><?php __('SP2 Multiplier');?></th>
          <th><?php __('SP3 Multiplier');?></th>  
           <th class="wid-20"><?php __('Action');?></th>  
        </tr>
      </thead>
      <tbody>
          <?php foreach ($getSupplier as $supplier_order): ?>          
          <tr>         
          <td><?php echo $supplier_order['SupplierMultiplier']['invoice_currency']; ?></td>
          <td><?php echo $supplier_order['SupplierMultiplier']['category']; ?></td>
          <td><?php echo $supplier_order['SupplierMultiplier']['supplier']; ?></td>
          <td><?php echo $supplier_order['SupplierMultiplier']['sp1_multiplier']; ?></td>
          <td><?php echo $supplier_order['SupplierMultiplier']['sp2_multiplier']; ?></td>
          <td><?php echo $supplier_order['SupplierMultiplier']['sp3_multiplier']; ?></td>   
           <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'supplier_multipliers','action' => 'delete',$supplier_order['SupplierMultiplier']['id']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $supplier_order['SupplierMultiplier']['id']));  ?></td>
        </tr>  
         <?php endforeach; ?>    
      </tbody>
    </table>
 </div>

<!-- Add Shipping Cost information -->
<div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <?php  echo $form->create('Shipping',array('action'=>'add','id'=>'sales')); ?>
            <div class="col-md-12 mobile-bottomspace">     
            <h1 class="sub-header"><?php __('Shipping Cost Information');?></h1>
            </div>          
            <div class="col-md-12 mobile-bottomspace">       
                    <div class="col-md-3"><strong><?php __('Category'); ?></strong><select id="category" name="data[Shipping][category]">
                    <option value=''><?php __('Please select category.');?></option>
                    <?php foreach ($categories as $category): ?>
                    <?php if((!empty($options)) && ($options===$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($category->CategoryName) .'>'. $category->CategoryName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>
                    <div class="col-md-3"><strong><?php __('Country'); ?></strong><select id="country" name="data[Shipping][country]">
                    <option value=''><?php __('Please select country.');?></option>
                    <?php foreach ($countryname as $countryn): ?>
                    <?php echo '<option'.' '.$select.' '.'value='. rawurlencode($countryn->CountryCode) .'>'. $countryn->CountryName .'</option>'; ?>
                    <?php endforeach; ?>
                     </select></div>
                    <div class="col-md-3"><?php echo $this->Form->input('shipping_cost',array('placeholder'=>'Shipping  cost')); ?></div>
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
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
               <?php //$Catname = $this->requestAction('/master_listings/categories'); // print_r($option); die(); ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo  $actual_link ; ?>/purchase_orders/settings/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul></th>
           <th><?php __('Country');?></th>          
          <th><?php __('Shipping Cost');?></th>
          <th class="wid-20"><?php __('Action');?></th>  
          <th></th>         
        </tr>
      </thead>
      <tbody>
       <?php foreach ($getShipping  as $shipping_cost): ?>
        <tr>         
          <td></td>
          <td><?php echo $shipping_cost['Shipping']['category']; ?></td>
          <td><?php echo $shipping_cost['Shipping']['country']; ?></td>
          <td><?php echo $shipping_cost['Shipping']['shipping_cost']; ?></td>
          <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'shippings','action' => 'delete',$shipping_cost['Shipping']['id']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $shipping_cost['Shipping']['id']));  ?></td>
            <td></td>
          </tr>
        <?php endforeach; ?>    
      </tbody>
    </table>
 </div>
<!-- sales price multipliers -->