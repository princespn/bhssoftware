<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php
if ((!empty($this->request->data['exports'])) && (!empty($this->request->data['checkid']))) {
	
foreach ($data as $row):
	foreach ($row['AdminListing'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	echo implode(',', $row['AdminListing']) . "\n";
endforeach;

}else{	
?>
 <hr>
<h1 class="sub-header"><?= __('Master Website Price Listing'); ?> </h1>
<?php  echo $this->Form->create('admin-listings', ['url' => ['action' => 'index']]); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php // if($session->read('Auth.User.group_id')!='3') { ?><?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'admin_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?><?php // } ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
       </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
              <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Web SKU...', 'class'=>'form-control pa-left')); ?>
                <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th class="wid-20"><input type="checkbox" id="selecctall"/></th>
          <th class="wid-200"><?= __('Linnworks code');?></th>
          <th class="wid-200"><?= __('Category');?></th>
          <th><?= __('Web sku');?></th>
          <th><?=  __('RRP(GBP)');?></th>
          <th><?= __('Web UK');?></th>
          <th><?=  __('RRP(EUR)');?></th>
          <th><?=  __('Web DE');?></th>
           <th><?=  __('RRP(EUR)');?></th>
          <th><?=  __('Web FR');?></th>          
          <th><?=  __('Tesco');?></th>
          <th><?=  __('RRP(GBP)');?></th>
          <th><?=  __('Daily Mail');?></th>
          <?php // if($session->read('Auth.User.group_id')!='3') { ?><th class="wid-70"><?= __('Action');?></th><?php // } ?>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($adminListings as $adminListing): ?>
        <tr>
		   <td><?php $productid = $this->Number->format($adminListing->id);   echo $this->Form->input('id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>false,'multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox'));  ?></td>
                  <td><?= h($adminListing->linnworks_code) ?></td>
			<td><?= h($adminListing->inventory_code->category) ?></td>
				  <td><?= h($adminListing->web_sku) ?></td>              
                <td><?= h($adminListing->web_price_uk) ?></td>
                <td><?= h($adminListing->web_sale_price_uk) ?></td>
				 <td><?= h($adminListing->web_price_de) ?></td>
                <td><?= h($adminListing->web_sale_price_de) ?></td>
                <td><?= h($adminListing->web_price_fr) ?></td>
                <td><?= h($adminListing->web_sale_price_fr) ?></td>
				 <td><?= h($adminListing->web_sale_price_tesco) ?></td>               
                <td><?= h($adminListing->web_price_dm) ?></td>
                <td><?= h($adminListing->web_sale_price_dm) ?></td>         
    <?php // if($session->read('Auth.User.group_id')!='3') { ?>
    <td><?php  echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'admin-listings','action'=>'edit', $adminListing->id),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'admin-listings','action' => 'delete',$adminListing->id), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $adminListing->web_sku));  ?></td><?Php // } ?>
         </tr>        
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php echo $this->Form->end();?>
 <hr>
     <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
   
<ul class="pagination pagination-sm margin-0">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
 </ul>

<script type="text/javascript">
    document.getElementById("AdminListingCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/listings/category/" + selectedOption;
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"                 
                 $('#exportfile').removeAttr('disabled');
			
            });
			
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
				
            }); 
			
        }
    });
   
});
</script>
<?php } 
