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
}else{  $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<div class="france_listings index">
    <div class="grid_16">
        <h2 id="page-heading"><?php __('Master Amazon France Database.');?></h2>
        <table cellpadding="0" cellspacing="0">
<?php  echo $form->create('FranceMasterListing',array('action'=>'index','id'=>'saveForm')); ?>
            <tr style="color:#ffffff;">
                <th colspan="3"><?php echo $form->checkbox('error',array('label'=>'','value'=>'error')); ?><?php echo $this->Paginator->sort('error', 'error', array('direction' => 'desc')); ?></th>
                <th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
                <th colspan="6"></th>
            </tr>
            <tr style="background:#666666;color:#ffffff;">
                <th><input type="checkbox" id="selecctall" name="selecctall" value="All"/></th>
                <th><?php __('Image');?></th>
                <th><?php __('Linnworks Code');?></th>
                <th><?php __('Amazon SKU');?></th>
                <th style="width:30px;"><?php __('Category');?>
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
                <th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
            </tr>
<?php //$output = $this->requestAction('/france_master_listings/saleprice');  
$keywords = preg_split("/[\n]+/", $output);
$i = 0;
foreach ($france_master_listings as $france_master_listing):
$class = null;

if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
$wordlist = split ("\-", $france_master_listing['FranceMasterListing']['item_sku']); 
if($wordlist[1]==='FBA'){$final=$wordlist[1];}
if($wordlist[2]==='FBA'){$final=$wordlist[2];}	
?>
            <tr<?php echo $class;?>>
                <td><?php $productid = $france_master_listing['FranceMasterListing']['id'];if(!empty($france_master_listing['FranceMasterListing']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
echo $this->Form->input('FranceMasterListing.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($france_master_listing['FranceMasterListing']['error'])){echo "&#8595;";} ?></td>
                <td class="checkbox"><?php  if(!empty($france_master_listing['FranceMasterListing']['main_image_url'])){	echo "<img width='70px' src=".$france_master_listing['FranceMasterListing']['main_image_url'].">";
}else { echo '<img width=70px src=/img/images.png>';	}?></td>
                <td><?php echo $france_master_listing['FranceProductListing']['product_code']; ?></td>
                <td><?php echo $france_master_listing['FranceMasterListing']['item_sku']; ?></td>
                <td><?php if (!empty($france_master_listing['FranceProductListing']['category'])){ echo $france_master_listing['FranceProductListing']['category'];} ?></td>
                <td><?php if(($france_master_listing['FranceMasterListing']['recommended_browse_nodes1'])!=($france_master_listing['FranceMasterListing']['recommended_browse_nodes1']))
{echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";
}else{echo $france_master_listing['FranceMasterListing']['recommended_browse_nodes1'];} ?></td>
                <td><?php
	if((($final)!=='FBA') && (empty($france_master_listing['FranceMasterListing']['item_name'])))
	{
	echo "<div style='color:red;'>The Title is required</div>";
	}
	else
	{
				$row1 = $france_master_listing['FranceMasterListing']['item_name'];
				$item = strlen($row1); 
					if($item >= '500')
					{
					echo "<div style='color:red;'>The Title must be no long 500 characters.</div>";
					}
					else
					{	$itemname = utf8_encode(substr($row1,0,50)); 
						echo ($itemname);						
					}
	}

?></td>
                <td class="checkbox"><?php 
$saleprice = $france_master_listing['FranceMasterListing']['standard_price'];
if(!(empty($saleprice)))
{
	echo $saleprice;
	echo "</BR>";
       // echo "<span style='color:red;'>Standard Price is did not match.</span>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if($pieces[1]===($france_master_listing['FranceMasterListing']['item_sku'])){
	if((is_int($pieces[3])) !== (is_int($saleprice)) || (is_float($pieces[3])) !== (is_float($saleprice))){echo "<span style='color:red;'>Standard Price is did not match.</span>";}	
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
                <td class="checkbox"><?php 
$stanprice = $france_master_listing['FranceMasterListing']['sale_price'];
if(!(empty($stanprice)))
{
	echo $stanprice;
	echo "</BR>";
        //echo "<span style='color:red;'>Sale Price is did not match.</span>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if(($pieces[1])===($france_master_listing['FranceMasterListing']['item_sku'])){
	if((is_int($pieces[3])) !== (is_int($stanprice)) || (is_float($pieces[3])) !== (is_float($stanprice))){echo "<span style='color:red;'>Sale Price is did not match.</span>";}	
	}
	}
}
else if(($france_master_listing['FranceMasterListing']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Sale Price is Required</span>";
}
?></td>
                <td>
<?php
echo $this->Html->link($this->Html->image('edit.jpg'), array('action' => 'edit', $france_master_listing['FranceMasterListing']['item_sku']), array('escape' => false));
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo $this->Html->link($this->Html->image('delete.jpg'), array('action' => 'delete', $france_master_listing['FranceMasterListing']['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $france_master_listing['FranceMasterListing']['item_sku'])); 
?>
                </td>
            </tr>
<?php endforeach; 
 echo $this->Form->end();?>
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
    $(document).ready(function () {
// bind change event to select
        $('#inventory_mastersid').live('click', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
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
<?php } ?>