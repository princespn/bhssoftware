<?php
if($session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='3')
{
$this->requestAction('/users/logout/', array('return'));
}
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
<?php echo $this->Session->flash(); ?>
 <hr>
<h1 class="sub-header"><?php __('Linnworks Codes Database');?> </h1>
<?php  echo $form->create('InventoryCode',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">       
        <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Linnworks codes', true), array('controller' => 'inventory_codes', 'action' => 'linnworkcode'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
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
           <th><?php __('Linnworks code');?></th>          
            <th><?php __('Product name');?></th>
          <th><?php __('Category');?></th>          
         <?php if($session->read('Auth.User.group_id')!='3') { ?> <th><?php __('Action');?></th><?php } ?>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($inventory_codes as $inventory_code): ?>
         <tr>
          <td><?php  $productid = $inventory_code['InventoryCode']['id'];if(!empty($inventory_code['InventoryCode']['error'])){$class ='checkerror';}else{$class ='checkbox1';} 
          echo $this->Form->input('InventoryCode.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($inventory_code['InventoryCode']['error'])){echo "&#8595;";} ?></td>
                 
          <td><?php echo $inventory_code['InventoryCode']['linnworks_code']; ?></td>          
          <td><?php echo $inventory_code['InventoryCode']['product_name']; ?></td>
          <td><?php echo $inventory_code['InventoryCode']['category']; ?></td>
           <?php if($session->read('Auth.User.group_id')!='3') { ?><td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'inventory_codes','action'=>'edit', $productid),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'inventory_codes','action' => 'delete',$productid), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $inventory_code['InventoryCode']['linnworks_code']));  ?></td><?php } ?>
  
      </tr>        
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php echo $this->Form->end();?>
 <hr>
 <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
 <nav>
     <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
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