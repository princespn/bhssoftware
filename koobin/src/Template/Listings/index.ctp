<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $price_listings[0]['listing'];	
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($price_listings as $price_listing){		
$line = $price_listing['listing'];
echo $csv->addRow($line);
}
$filename='prices_listings';
echo $csv->render($filename);
}else{	
?>
 <hr>
<h1 class="sub-header"><?= __('Diagnosis Website Price Listing');?> </h1>
<?php  // echo $form->create('listing',array('action'=>'index','id'=>'saveForm')); ?>
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
      <?php  foreach ($listings as $listing):  ?>
        <tr>
		   <td><?php $productid = $this->Number->format($listing->id);   echo $this->Form->input('listing.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>false,'multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox'));  ?></td>
                  <td><?= h($listing->linnworks_code) ?></td>
				   <td><?= h($listing->inventory_code->category) ?></td>
				  <td><?= h($listing->web_sku) ?></td>              
                <td><?= h($listing->web_price_uk) ?></td>
                <td><?= h($listing->web_sale_price_uk) ?></td>
				 <td><?= h($listing->web_price_de) ?></td>
                <td><?= h($listing->web_sale_price_de) ?></td>
                <td><?= h($listing->web_price_fr) ?></td>
                <td><?= h($listing->web_sale_price_fr) ?></td>
				 <td><?= h($listing->web_sale_price_tesco) ?></td>               
                <td><?= h($listing->web_price_dm) ?></td>
                <td><?= h($listing->web_sale_price_dm) ?></td>
         
    <?php // if($session->read('Auth.User.group_id')!='3') { ?>
    <td><?php  echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'listings','action'=>'edit', $listing->id),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'listings','action' => 'delete',$listing->id), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $listing->web_sku));  ?></td><?Php // } ?>
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
    document.getElementById("listingCategory").onchange = function () {
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
