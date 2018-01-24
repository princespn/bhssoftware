<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php  echo $form->create('Stock',array('action'=>'index','id'=>'saveForm')); ?>
 <h1 class="sub-header"><?php __('Linnworks Listing Used Linnworks API.');?></h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <select id="catid" name="data[Masterinventory][catename]">
	<option value='category'><?php __('Please select category.');?></option>
	<?php foreach ($categories as $category): ?>
	<?php if((!empty($options)) && ($options===$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
	<?php echo '<option'.' '.$select.' '.'value='. rawurlencode($category->CategoryName) .'>'. $category->CategoryName .'</option>'; ?>
	<?php endforeach; ?>
         </select>
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
                     <?php  echo $this->Form->input('keyword',array('label'=>false,'class'=>'form-control pa-left','placeholder'=>'Search Barcode,Category..'));  ?>
          
              <div class="input-group-btn"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','class'=>'btn btn-primary','type'=>'submit')); ?>
               <?php echo $this->Form->end(); ?>
              </div>
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
          
          <th class="wid-200"><?php __('Item Number(SKU)');?></th>
          <th class="wid-400"><?php __('Product name');?></th>
          <th class="wid-200"><?php __('Barcode Number');?></th>
          <th class="wid-200"><?php __('Retail price');?></th>
          <th><?php __('Quantity');?></th>  
          <th class="wid-20"><?php __('Action');?></th>
        </tr>
      </thead>
      <tbody>
       <?php print_r($locations);die();foreach ($stocks->Data as $data): ?>
        <tr>
         
          <td><?= h($data->ItemNumber) ?></td>
          <td><?= h($data->ItemTitle) ?></td>
          <td><?= h($data->BarcodeNumber) ?></td>
          <td><?= h($data->RetailPrice) ?></td>
          <td><?= h($data->Quantity) ?></td> 
          
           <?php if(!empty($data->BarcodeNumber)){$sid=$data->BarcodeNumber;}else{$sid=$data->ItemNumber;} ?>				   
         <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'stocks','action'=>'update',$data->StockItemId,$sid),array('class'=> 'edit-btn','escape'=>false)); ?></td>
       
        </tr>  
        <?php endforeach; ?>   
          
      </tbody>
    </table>
  </div>
  <p><?php print_r($pagination); ?></p>	
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<script type="text/javascript">
document.getElementById("catid").onchange = function() {
var selectedOption = $(this).find('option:selected').text();
window.location.href = "<?php echo  $actual_link ; ?>/stocks/index/" + selectedOption;
}
</script>