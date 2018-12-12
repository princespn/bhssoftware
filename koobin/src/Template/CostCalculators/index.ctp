<hr>
<?php  echo $this->Form->create('purchase_order', ['url' => ['action' => 'index']]); ?>
 <?php  // echo $form->create('',array('action'=>'index','id'=>'saveForm')); ?>
<h1 class="sub-header"><?php __('Cost Calculator');?></h1>
<div class="panel panel-default">
    <div class="panel-body">       
      <div class="row">     
        <div class="col-md-8 mobile-bottomspace">
        <?php echo $this->Form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php echo $this->Paginator->sort('Sort by update', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php //if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import data', true), array('controller' => 'cost_calculators', 'action' => 'importdata'),array('class' => 'btn btn-info btn-sm')); ?><?php //} ?>
        <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php  echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search from Linnworks Code.', 'class'=>'form-control pa-left')); ?>
            <div class="input-group-btn"><?php  echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>      
      </div>
    </div>
</div> 
<div class="table-responsive catname">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>  
          <th></th>          
          <th colspan="5" class="text-center text-uppercase color-white gbp-bg"><?= __('GBP');?></th> 
         
          <th colspan="5" class="text-center text-uppercase color-white eur-bg"><?= __('EUR');?></th> 
       
          <th></th> 
        </tr>
        <tr> 
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
          <th class="wid-200"><?= __('Linnworks Code');?></th>
          <th><?= __('Product Name');?></th>      
          <th><?= __('Purchase Price');?></th>
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                 <?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
                   <?php  foreach ($categories as $category): ?>
                     
                    <li><a href="<?php echo  $actual_link ; ?>/cost-calculators/display/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>      
          <th><?= __('Supplier');?></th>          
          <th><?= __('Currency');?></th>          
          <th class="wid-20"><?= __('Landed Price');?></th>
          <th class="wid-20"><?= __('S.P.1');?></th>
          <th class="wid-20"><?= __('S.P.2');?></th>
          <th class="wid-20"><?= __('S.P.3');?></th>       
          <th><?= __('Web Price');?></th>
          <th class="wid-20"><?= __('Landed Price');?></th>
          <th class="wid-20"><?= __('S.P.1');?></th>
          <th class="wid-20"><?= __('S.P.2');?></th>
          <th class="wid-20"><?= __('S.P.3');?></th>
          <th><?= __('Web Price');?></th>          
         <?php // if($session->read('Auth.User.group_id')!='3') { ?> <th class="wid-20"><?= __('Action');?></th><?php // } ?>
        </tr>
      </thead>
      <tbody>
     <?php foreach ($costCalculators as $purchase_order): ?>
         <tr>
		<td><?php $pid = $this->Number->format($purchase_order->id); if(!empty($purchase_order->error)){$class ='checkerror';}else{$class ='checkbox1';}
         echo $this->Form->input('purchase_order.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$pid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> 
		 <?php if(!empty($purchase_order->error)){echo "&#8595;";} ?></td>
			<td><?= h($purchase_order->linnworks_code) ?></td>
				<?php if(!empty($purchase_order->purchase_price->item_title)){ ?>
				<td><?= h($purchase_order->purchase_price->item_title) ?></td>
				<?php } else { ?>		  
                <td><?= h($purchase_order->product_name) ?></td>
                <?php } ?>
				<td><?php if(!empty($purchase_order->purchase_price->purchase_price)){ ?><?= h($purchase_order->purchase_price->purchase_price) ?> <?php } ?></td>                
				<td><?= h($purchase_order->category) ?></td>
                <td><?= h($purchase_order->supplier) ?></td>
                <?php if(!empty($purchase_order->purchase_price->invoice_currency)){ ?>
				<td><?= h($purchase_order->purchase_price->invoice_currency) ?></td>
				<?php } else { ?>		  
                <td><?= h($purchase_order->invoice_currency) ?></td>
                <?php } ?>
                <td><?php // Currency Master Information in GBP---   
				if(!empty($purchase_order->purchase_price->invoice_currency)){$purr = $purchase_order->purchase_price->invoice_currency;}else {$purr = $purchase_order->invoice_currency;}
                $GbpLP = '0'; foreach ($getCost as $exchange_rate):
                      if(($exchange_rate->invoice_currency)===($purr) && (($exchange_rate->sale_base_currency)==='GBP')):
                    if((!empty($purchase_order->purchase_price->purchase_price)) && (!empty($purchase_order->multiplier->multiplier))){  $GbpLP = ($exchange_rate->exchange_rate)*($purchase_order->purchase_price->purchase_price)*($purchase_order->multiplier->multiplier);
                    echo "<div><span class=blue>". round($GbpLP, 2) ."</span></div>"; } ?>
            <?php   break;endif; endforeach; ?></td> 
			<?php   $sp1 = '0'; $sp2 = '0'; $sp3 = '0'; foreach ($getsupp as $getsupps):
           if(((($getsupps->category)===($purchase_order->category)) && (($getsupps->supplier)===($purchase_order->supplier))) && (($getsupps->invoice_currency)==='GBP')): ?>
            <?php   $sp1 = $getsupps->sp1_multiplier; $sp2 = $getsupps->sp2_multiplier; $sp3 = $getsupps->sp3_multiplier;?>
          	<?php   break;endif; endforeach; ?>
			
			 <td><?php if(!empty($sp1)){ echo "<div><span class=blue>".round($GbpLP*$sp1, 2)."</span></div>";}    ?></td>
             <td><?php if(!empty($sp2)) { echo "<div><span class=blue>".round($GbpLP*$sp2, 2)."</span></div>"; }  ?></td>
             <td><?php if(!empty($sp3)){  echo "<div><span class=blue>".round($GbpLP*$sp3, 2) ."</span></div>"; }   ?></td>
              <?php if(!empty($purchase_order->admin_listing->web_sale_price_uk)){ $salegbp = $purchase_order->admin_listing->web_sale_price_uk;}else{$salegbp ='0';}
             if(($salegbp > $GbpLP*$sp1) && ($salegbp < $GbpLP*$sp3)){ ?>
             <td><?php if(!empty($salegbp)){echo $purchase_order->admin_listing->web_sale_price_uk;}  ?></td>
             <?php } else { ?>
             <td class="red-info" title="<?php echo "Selling Price not in Between Sp1->".$GbpLP*$sp1. " Sp2->".$GbpLP*$sp2. " Sp3->".$GbpLP*$sp3;?>"><?php if(!empty($salegbp)){ echo $purchase_order->admin_listing->web_sale_price_uk; } ?></td>
            <?php } ?> 
            
                        
			          
             <td><?php // Currency Master Information in EUR---                   
                $EurLP  = '0'; foreach ($getCost as $exchange_rate):
                      if(($exchange_rate->invoice_currency)===($purr) && (($exchange_rate->sale_base_currency)==='EUR')):
                      $ExEurRate = $exchange_rate->exchange_rate;
                     if(!empty($purchase_order->purchase_price->purchase_price)){ $Eurinvoice = $purchase_order->purchase_price->purchase_price; }else {$Eurinvoice = '0';}
                       if(!empty($purchase_order->multiplier->multiplier)){ $EurMull = $purchase_order->multiplier->multiplier;}else {$EurMull = '0';}
                     if(!empty($purchase_order->purchase_price->purchase_price)){ $EurLP = ($exchange_rate->exchange_rate)*($Eurinvoice)*($EurMull);
                       echo "<div><span class=blue>". round($EurLP, 2) ."</span></div>"; }  ?>
            <?php  break; endif; endforeach; ?></td>
            
            <?php  $sp1 = '0'; $sp2 = '0'; $sp3 = '0';  foreach ($getsupp as $getsupps):
           if(((($getsupps->category)===($purchase_order->category)) && (($getsupps->supplier)===($purchase_order->supplier))) && (($getsupps->invoice_currency)==='EUR')): ?>
               <?php   $sp1 = $getsupps->sp1_multiplier; $sp2 = $getsupps->sp2_multiplier; $sp3 = $getsupps->sp3_multiplier;?>
            <?php   break;endif; endforeach; ?>
			  <td><?php   echo "<div><span class=blue>".round($EurLP*$sp1, 2) ."</span></div>";    ?></td>
             <td><?php   echo "<div><span class=blue>". round($EurLP*$sp2, 2) ."</span></div>";   ?></td>
             <td><?php  echo "<div><span class=blue>". round($EurLP*$sp3, 2) ."</span></div>";    ?></td>
           <?php if(!empty($purchase_order->admin_listing->web_sale_price_de)){ $saleeur = $purchase_order->admin_listing->web_sale_price_de;}else{$saleeur ='0';}
             if(($saleeur > $EurLP*$sp1) && ($saleeur < $EurLP*$sp3)){ ?>            
             <td><?php if(!empty($saleeur)){ echo $purchase_order->admin_listing->web_sale_price_de; }?></td>
             <?php } else { ?>
             <td class="red-info" title="<?php echo "Selling Price not in Between Sp1->".$EurLP*$sp1. " Sp2->".$EurLP*$sp2. " Sp3->".$EurLP*$sp3;?>"><?php if(!empty($saleeur)){ echo $purchase_order->admin_listing->web_sale_price_de;} ?></td>
              <?php } ?>
            
			  <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'cost-calculators','action'=>'edit',$purchase_order->id),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'cost-calculators','action' => 'delete',$purchase_order->id), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $purchase_order['purchase_order']['id']));  ?></td><?php // } ?>
            </tr>         
         <?php endforeach; ?>            
      </tbody>
    </table>
  </div>
 <?php echo $this->Form->end();?>
<hr>
<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#purchase_orderError').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
                $('#exportfile').removeAttr('disabled');
		$('#selecctall').attr('disabled','disabled');
            });
        }else{
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#selecctall').removeAttr('disabled','disabled');
            });        
        }
    });
   
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		$('#exportfile').removeAttr('disabled');
		$('#purchase_orderError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#purchase_orderError').removeAttr('disabled','disabled');
            }); 
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
            }); 
        }
    });
   
});
</script>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<script type="text/javascript">
document.getElementById("category").onchange = function() {
var selectedOption = $(this).find('option:selected').text();
window.location.href = "<?php echo  $actual_link ; ?>/purchase_orders/category/" + selectedOption;
}
</script>
