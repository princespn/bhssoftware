 <?php die(); ?>
 <hr>
 <?php  echo $form->create('PurchaseOrder',array('action'=>'index','id'=>'saveForm')); ?>
<h1 class="sub-header"><?php __('Cost Calculator');?></h1>
<div class="panel panel-default">
    <div class="panel-body">       
      <div class="row">     
        <div class="col-md-8 mobile-bottomspace">
        <?php echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php echo $this->Paginator->sort('Sort by update', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import data', true), array('controller' => 'purchase_orders', 'action' => 'importdata'),array('class' => 'btn btn-info btn-sm')); ?><?php } ?>
        <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
           <div class="input-group">
            <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
            <?php  echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code,Category...', 'class'=>'form-control pa-left')); ?>
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
           <th></th>
          <th colspan="6" class="text-center text-uppercase color-white gbp-bg"><?php __('GBP');?></th> 
         
          <th colspan="6" class="text-center text-uppercase color-white eur-bg"><?php __('EUR');?></th> 
       
          <th></th> 
        </tr>
        <tr> 
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
          <th class="wid-200"><?php __('Linnworks Code');?></th>
          <th><?php __('Product Name');?></th>          
          <th><?php __('Invoice value');?></th>
          <th><?php __('Latest Invoice');?></th>
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <?php foreach ($categories as $category): ?>
                     
                    <li><a href="<?php echo  $actual_link ; ?>/purchase_orders/category/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul>
          </th>      
          <th><?php __('Supplier');?></th>          
          <th><?php __('Currency');?></th>          
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>       
          <th><?php __('Selling Price');?></th>
          <th><?php __('Web Price');?></th>
          
          <th class="wid-20"><?php __('Landed Price');?></th>
          <th class="wid-20"><?php __('S.P.1');?></th>
          <th class="wid-20"><?php __('S.P.2');?></th>
          <th class="wid-20"><?php __('S.P.3');?></th>
          <th><?php __('Selling Price');?></th>
          <th><?php __('Web Price');?></th>          
         <?php if($session->read('Auth.User.group_id')!='3') { ?> <th class="wid-20"><?php __('Action');?></th><?php } ?>
        </tr>
      </thead>
      <tbody>
            
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
$(document).ready(function() {
    $('#PurchaseOrderError').click(function(event) {  //on click
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
		$('#PurchaseOrderError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#PurchaseOrderError').removeAttr('disabled','disabled');
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