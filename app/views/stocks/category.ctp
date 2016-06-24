<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>

 <?php
// debug($categorieslist);die();
 if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

	$line= $inventorymasters[0]['InventoryMaster'];	
	//$mapping = array('','','','SKU','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
	//echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($inventorymasters as $project){		
	  $line = $project['InventoryMaster'];
	  echo $csv->addRow($line);
	}
	$filename='inventorymasterdb';
	echo $csv->render($filename);
	}else{	
  ?>
 <?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="projects index">
<div class="grid_16">
<h2 id="page-heading"><?php __('Inventory Masters Database');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('InventoryMaster',array('action'=>'index','id'=>'saveForm')); ?>
	<tr style="color:#ffffff;">
	<th colspan="3"></th>
	<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
	<th colspan="6"></th>
	</tr>
	<tr style="background:#666666;color:#ffffff;">				
			<th><input type="checkbox" id="selecctall"/></th>
			<th><?php __('Product Code');?></th>
			<th><?php __('Product SKU');?></th>
            <th><?php __('Barcodes');?></th>
				<th style="width:30px;"><?php __('Category');?>
                       <select id="InventoryMasterCategory" name="data[InventoryMaster][category]">
                       <?php $option = $this->requestAction('/inventory_masters/categorieslist'); //echo $this->Form->select('category',array($option)); 
						foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';}
                         echo '<option'.' '.$select.' '.'value='.$option.'>'.$option.'</option>';
                         }?> </select></th>
                        <th><?php __('Browse nodes');?></th>
			<th><?php __('Price');?></th>
                        <th><?php __('Title');?></th>
			<th colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
			
	</tr>

	<?php
	$i = 0;
	foreach ($inventorymasters as $project):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	
		<td><?php	
		 $productid = $project['InventoryMaster']['id'];
		echo $this->Form->input('InventoryMaster.id',array('class'=>'checkbox1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
		<td class="checkbox"><?php echo $project['InventoryMaster']['product_code']; ?></td>
                <td class="checkbox"><?php echo $project['InventoryMaster']['item_sku']; ?></td>
		<td class="checkbox"><?php echo $project['InventoryMaster']['barcodes']; ?></td>		
		<td class="checkbox"><?php echo $project['InventoryMaster']['category']; ?></td>
		<td class="checkbox"><?php echo $project['InventoryMaster']['recommended_browse_nodes1']; ?></td>	
		<td class="checkbox"><?php 
		$stanprice = $project['InventoryMaster']['sale_price'];
		if(empty($stanprice))
		 {
		   echo "<span style='color:red;' title='Price is Required.'>Price is Required</span>";
                 }
		 else
		 {
			  $pric = $project['InventoryMaster']['error'];
			   $pieces = explode(":", $pric);
			if((!empty($pieces[1])) && ($pieces[1] == 'Price did not match.'))
			{
			  
				if(!empty($pieces[1]))
					{
				echo "<span style='color:red;' title='Price did not match.'>$stanprice</span>";
					}
			}
			else
			{
				echo $stanprice;
			}
		}
	 ?></td>
                <td><?php 
		 if(!empty($project['InventoryMaster']['item_name']))
		{
		$row1 = $project['InventoryMaster']['item_name'];
		$keyword = $project['InventoryMaster']['keyword'].','.$project['InventoryMaster']['category'];
		$item = strlen($row1); 
				 if($item >= '500'){
				 echo "<div style='color:red;'>Item Name must be no long 500 characters.</div>";
				 
				 }else {
				$percentage = 0;
				$keyword = similar_text($row1,$keyword,$percentage);
				$itemname = substr($row1,0,200); 				 
				echo ($itemname);
				echo "</BR>";
				printf("<div style='color:red;'>The Title has %d percent Keyword.</div>", $percentage);
    			 }
		
		}else{
		echo "<div style='color:red;'>The Title is required.</div>";
		}?></td>
		<td class="actions">
		<?php 
			$size = array(''=>'Select','/inventory_masters/edit_inventory/'.$project['InventoryMaster']['id']=>'Edit','/inventory_masters/delete_inventory/'.$project['InventoryMaster']['id']=>'Delete');
			echo $this->Form->input('', array('id'=>'projectsid','type'=>'select','label' => '','options' =>$size));
		 ?>
		
		</td>
	</tr>
<?php endforeach; ?>
<?php echo $this->Form->end();?>
</table>
<div class="paging">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></div><div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
</div>
<script type="text/javascript">
   $(document).ready( function() {
      // bind change event to select
      $('#projectsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
<script type="text/javascript">
document.getElementById("InventoryMasterCategory").onchange = function() {
     var selectedOption = $(this).find('option:selected').text();
     window.location.href = "<?php echo  $actual_link ; ?>/inventory_masters/category/" + selectedOption;
}
</script>
<?php } 