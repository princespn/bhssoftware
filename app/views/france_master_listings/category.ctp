<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}

if((!empty($_POST['checkid'])) && (!empty($_POST['exports']))){
$line= $france_master_listings[0]['FranceMasterListing'];	
$mapping = array('','','SKU','','','AM-FR Title','','','','','AM-FR Description','','','AM-FR Standard Price','','','','','','AM-FR Sale Price','AM-FR Sale from date','AM-FR Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR bullet_point 1','AM-FR bullet_point 2','AM-FR bullet_point 3','AM-FR bullet_point 4','AM-FR bullet_point 5','AM-FR Search Terms 1','AM-FR Search Terms 2','AM-FR Search Terms 3','AM-FR Search Terms 4','AM-FR Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR Colour Map1','AM-FR Colour Map2','AM-FR Size Map','','','','AM-FR Material','AM-FR Material1');
echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($france_master_listings as $france_master_listing){		
$line = $france_master_listing['FranceMasterListing'];
echo $csv->addRow($line);
}
$filename='france_master_listings';
echo $csv->render($filename);
}else{ ?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<?php echo $this->Session->flash(); ?>
 <hr>
<h1 class="sub-header"><?php __('Master Amazon France Database.');?> </h1>
<?php  echo $form->create('FranceMasterListing',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">       
        <?php echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php echo $this->Paginator->sort('Error', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php echo $this->Html->link(__('Import Listing', true), array('controller' => 'france_master_listings', 'action' => 'import'),array('class' => 'btn btn-info btn-sm')); ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
               <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code, Amazon SKU...', 'class'=>'form-control pa-left')); ?>
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
          <th class="wid-20"><input type="checkbox" id="selecctall" name="selecctall" value="All"/></th>
          <th><?php __('Image');?></th>
          <th class="wid-200"><?php __('Linnworks code');?></th>          
             <th><?php __('Amazon SKU');?></th>
          <th><?php __('Category');?>
           <select id="FranceMasterListingCategory" name="data[FranceMasterListing][category]">
                        <option value='--Select Category--'>--Select Category--</option>
<?php $option = $this->requestAction('/france_master_listings/categoriesPro'); //echo $this->Form->select('category',array($option)); 
foreach ($option as $key => $option){if($foo==$option){$select='selected=selected';}else {$select='';}
echo '<option'.' '.$select.' '.'value='.$option.'>'.$option.'</option>';
}?></select></th>  
          <th><?php __('Browse nodes');?></th>
           <th><?php __('Product name');?></th>
          <th><?php __('Standard price');?></th>           
          <th><?php __('Sale price');?></th>  
          <th class="wid-70"><?php __('Action');?></th>
        </tr>
      </thead>
      <tbody>
          <?php $output = $this->requestAction('/france_master_listings/saleprice'); $keywords = preg_split("/[\n]+/", $output); ?>
          <?php foreach ($france_master_listings as $france_master_listing): ?>
          <?php  $wordlist = split ("\-", $france_master_listing['FranceMasterListing']['item_sku']); 
          if(isset($wordlist[1])==='FBA'){$final=isset($wordlist[1]);}
          if(isset($wordlist[2])==='FBA'){$final=isset($wordlist[2]);} ?>
        <tr>
          <td><?php  $productid = $france_master_listing['FranceMasterListing']['id'];if(!empty($france_master_listing['FranceMasterListing']['error'])){$class ='checkerror';}else{$class ='checkbox1';} 
          echo $this->Form->input('FranceMasterListing.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($france_master_listing['FranceMasterListing']['error'])){echo "&#8595;";} ?></td>
          <td><?php  if(!empty($france_master_listing['FranceMasterListing']['main_image_url'])){echo "<img width='70px' src=".$france_master_listing['FranceMasterListing']['main_image_url'].">";}else { echo '<img width=70px src=/img/images.png>';	}?></td>          
          <td><?php echo $france_master_listing['FranceProductListing']['product_code']; ?></td>          
          <td><?php echo $france_master_listing['FranceMasterListing']['item_sku']; ?></td>
          <td><?php if (!empty($france_master_listing['FranceProductListing']['category'])){ echo $france_master_listing['FranceProductListing']['category'];} ?></td>
           <td><?php if(($france_master_listing['FranceMasterListing']['recommended_browse_nodes1'])!=($france_master_listing['FranceMasterListing']['recommended_browse_nodes1'])){echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";}else{echo $france_master_listing['FranceMasterListing']['recommended_browse_nodes1'];} ?></td>
           <td><?php	if(((isset($final))!=='FBA') && (empty($france_master_listing['FranceMasterListing']['item_name']))){echo "<div style='color:red;'>The Title is required</div>";}else{$row1 = $france_master_listing['FranceMasterListing']['item_name'];$item = strlen($row1); if($item >= '500'){	echo "<div style='color:red;'>The Title must be no long 500 characters.</div>";	}else{	$itemname = utf8_encode(substr($row1,0,50)); echo ($itemname);}}?></td>
            <td><?php $saleprice = $france_master_listing['FranceMasterListing']['standard_price'];if(!(empty($saleprice))){
	echo $saleprice;
	echo "</BR>";
       
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);       
	if(isset($pieces[1])===($france_master_listing['FranceMasterListing']['item_sku'])){
	if((is_int(isset($pieces[3]))) !== (is_int($saleprice)) || (is_float(isset($pieces[3]))) !== (is_float($saleprice))){echo "<span style='color:red;'>Standard Price is did not match.</span>";}	
	}
	}
}
else if(($france_master_listing['FranceMasterListing']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Standard Price is Required</span>";
}
?></td>
 <td><?php $stanprice = $france_master_listing['FranceMasterListing']['sale_price'];if(!(empty($stanprice))){echo $stanprice;echo "</BR>";foreach ($keywords as $keyword){$pieces = explode(",", $keyword);if((isset($pieces[1]))===($france_master_listing['FranceMasterListing']['item_sku'])){if((is_int(isset($pieces[3]))) !== (is_int($stanprice)) || (is_float(isset($pieces[3]))) !== (is_float($stanprice))){echo "<span style='color:red;'>Sale Price is did not match.</span>";}}}}else if(($france_master_listing['FranceMasterListing']['parent_child'])==='parent'){echo "<span style='color:red;'>Parent</span>";}else{echo "<span style='color:red;'>Sale Price is Required</span>";}?></td>      
    <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'france_master_listings','action'=>'edit', $france_master_listing['FranceMasterListing']['item_sku']),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'france_master_listings','action' => 'delete', $france_master_listing['FranceMasterListing']['item_sku']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $france_master_listing['FranceMasterListing']['item_sku']));  ?></td>
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
    document.getElementById("FranceMasterListingCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/france_master_listings/category/" + selectedOption;
    }
</script>
<script>
$(document).ready(function() {
    $('#FranceMasterListingError').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
				 $('div.btnClick').show();
				 $('#selecctall').attr('disabled','disabled');
            });
        }else{
            $('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				$('div.btnClick').hide();
				$('#selecctall').removeAttr('disabled','disabled');
            });        
        }
    });
   
});
</script>
<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
				 $('div.btnClick').show();
				 $('#FranceMasterListingError').attr('disabled','disabled');
            });
			 $('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
				 $('div.btnClick').show();
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				$('div.btnClick').hide();
				$('#FranceMasterListingError').removeAttr('disabled','disabled');
            }); 
			$('.checkerror').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				$('div.btnClick').hide();
            }); 
        }
    });
   
});
</script>
<?php } 