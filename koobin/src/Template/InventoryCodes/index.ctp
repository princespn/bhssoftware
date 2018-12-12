<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php
if((!empty($_POST['checkid'])) && (!empty($_POST['exports']))){
	$line = $inventory_codes[0]['InventoryCode'];	
	$mapping = array('linnworks_code','product_name','category');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($inventory_codes as $inventory_code){		
	$line = $inventory_code['InventoryCode'];
	echo $csv->addRow($line);
	}
$filename='inventory_codes';
echo $csv->render($filename);
}else{	
?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<?php // echo $this->request->session->flash(); ?>
 <hr>
<h1 class="sub-header"><?=  __('Linnworks Codes Database');?> </h1>
<?php  // echo $form->create('InventoryCode',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">       
        <?php // if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Linnworks codes', true), array('controller' => 'inventory_codes', 'action' => 'linnworkcode'),array('class' => 'btn btn-info btn-sm')); ?><?php // } ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
               <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code', 'class'=>'form-control pa-left')); ?>
                <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th><input type="checkbox" id="selecctall" name="selecctall" value="All"/></th>
           <th><?= __('Linnworks code');?></th>          
            <th><?= __('Product name');?></th>
          <th><?= __('Category');?></th>          
         <?php // if($session->read('Auth.User.group_id')!='3') { ?> <th><?php __('Action');?></th><?php // } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($inventoryCodes as $inventoryCode): ?>
         <tr>
          <td><?php  $productid = $this->Number->format($inventoryCode->id); if(!empty($inventory_code['InventoryCode']['error'])){$class ='checkerror';}else{$class ='checkbox1';} 
          echo $this->Form->input('InventoryCode.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($inventory_code['InventoryCode']['error'])){echo "&#8595;";} ?></td>
			   
                <td><?= h($inventoryCode->linnworks_code) ?></td>
                <td><?= h($inventoryCode->product_name) ?></td>
                <td><?= h($inventoryCode->category) ?></td>         
           <?php // if($session->read('Auth.User.group_id')!='3') { ?><td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'inventory_codes','action'=>'edit',  $inventoryCode->id),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'inventory-codes','action' => 'delete', $inventoryCode->id), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true),  $inventoryCode->linnworks_code));  ?></td><?php // } ?>
  
      </tr>        
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php echo $this->Form->end();?>
 <hr>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    
 <nav>
     <ul class="pagination pagination-sm margin-0">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
 </nav>
<script type="text/javascript">
    document.getElementById("InventoryCodeCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/inventory_masters/category/" + selectedOption;
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#InventoryCodeError').click(function(event) {  //on click
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
		$('#InventoryCodeError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#InventoryCodeError').removeAttr('disabled','disabled');
            }); 
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
            }); 
        }
    });
   
});
</script>
<?php } 
