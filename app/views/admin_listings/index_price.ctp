<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

$line= $price_listings[0]['AdminListing'];	
//$mapping = array('','','SKU','','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
//echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($price_listings as $price_listing){		
$line = $price_listing['AdminListing'];
echo $csv->addRow($line);
}
$filename='prices_listings';
echo $csv->render($filename);
}else{	
echo $this->Session->flash(); ?>
 <hr>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST']; //echo $MinDevalue;?>
 <h1 class="sub-header"><?php __('Master Listing database');?></h1>
<?php  echo $form->create('AdminListing',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
         <?php echo $this->Html->link(__('Import Prices', true), array('controller' => 'admin_listings', 'action' => 'importcode'),array('class' => 'btn btn-info btn-sm')); ?>
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
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr id="head-table">
         <th colspan="5"><?php echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));  ?></th>
          <th colspan="5" class="text-center text-uppercase color-white gbp-bg"><?php __('Sale Price (GBP)');?></th>
          <th></th>
          <th colspan="6" class="text-center text-uppercase color-white eur-bg"><?php __('Sale Price (EUR)');?></th>         
        </tr>
        <tr>
          <th class="wid-20"><input name="selecctall" id="selecctall" type="checkbox"></th>
         <th><?php __('Linnworks Code');?></th>
           <!--<th class="wid-20"><?php __('Amazon SKU');?></th>-->
          <th><ul class="select-drop">
              <li class="dropdown"><a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Category <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo  $actual_link ; ?>/admin_listings/index_price/<?php echo rawurlencode($category->CategoryName); ?>" target="_self"><?php echo $category->CategoryName; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            </ul></th>
          <th><?php __('Product name');?></th>
          <th class="<?php __('pink-price');?>"><?php __('RRP');?></th>
          <th><?php __('Web UK');?></th>
          <th><?php __('Tesco');?></th>
          <th><?php __('Amazon UK');?></th>
          <th><?php __('Amazon UK Prime');?></th>
          <th><?php __('Daily Mail');?></th>
         
          <th class="<?php __('pink-price');?>"><?php __('RRP');?></th>
          <th><?php __('Web DE');?></th>
          <th><?php __('Amazon DE');?></th>
          <th><?php __('Amazon DE Prime');?></th>
          <th><?php __('Web FR');?></th>
          <th><?php __('Amazon FR');?></th>
          <th><?php __('Amazon FR Prime');?></th>        
        </tr>
      </thead>
      <tbody>
<?php foreach ($price_listings as $code_listing): ?>
        <tr>
         <td><?php $productid = $code_listing['AdminListing']['id']; if(!empty($code_listing['AdminListing']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
         echo $this->Form->input('AdminListing.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?> <?php if(!empty($code_listing['AdminListing']['error'])){echo "&#8595;";} ?></td>
          <td class="wid-20"><?php echo $code_listing['AdminListing']['linnworks_code']; ?></td>
          <!--<td><?php //echo $code_listing['MasterListing']['amazon_sku']; ?></td>-->
    
       <?php foreach ($Amazonprices as $amazonprice): ?>
       <?php if(($code_listing['AdminListing']['linnworks_code']) === ($amazonprice['MasterListing']['linnworks_code'])){  ?>   
       
          <td><?php echo $amazonprice['MasterListing']['category']; ?></td>
          <td><?php echo $amazonprice['MasterListing']['product_name']; ?></td>           
            <?php break; } ?>
           <?php endforeach; ?>
          <td class="pink-price"><?php  echo $code_listing['AdminListing']['web_price_uk']; ?></td>          
          <td><?php  echo $code_listing['AdminListing']['web_sale_price_uk']; ?></td>          
          <td><?php echo $code_listing['AdminListing']['web_sale_price_tesco']; ?></td>
          
          
       <?php foreach ($Amazonuk as $amazonukprice): ?>
       <?php if(($code_listing['AdminListing']['linnworks_code']) === ($amazonukprice['MasterListing']['linnworks_code'])){  ?>  
       
         <?php  if ((strpos($amazonukprice['MasterListing']['amazon_sku'], 'FBA') === false) && (!empty($amazonukprice['MasterListing']['sale_price_uk']))){?>
             <td><?php echo $amazonukprice['MasterListing']['sale_price_uk']; ?></td>
            <?php } else {?>
             <td></td>
            <?php } ?>
            <?php break; } ?>
           <?php endforeach; ?>
         
             <?php foreach ($Amazonuk as $amazonukfba): ?>
       <?php if(($code_listing['AdminListing']['linnworks_code']) === ($amazonukfba['MasterListing']['linnworks_code'])){  ?>  
       
         <?php  if ((strpos($amazonukfba['MasterListing']['amazon_sku'], 'FBA') !== false) && (!empty($amazonukfba['MasterListing']['sale_price_uk']))){?>
             <td><?php echo $amazonukfba['MasterListing']['sale_price_uk']; ?></td>
            <?php break; } ?>
             <?php } ?>
           <?php endforeach; ?>
                        
     
         <?php if(!empty($code_listing['AdminListing']['web_sale_price_dm'])){ ?>
          <td><?php echo $code_listing['AdminListing']['web_sale_price_dm']; ?></td>  
         <?php }else { ?><td></td><?php } ?>
     
        <td  class="pink-price"><?php  echo $code_listing['AdminListing']['web_price_de']; ?></td>      
   
        <td><?php echo $code_listing['AdminListing']['web_sale_price_de']  ?></td>         
        
      
        
      <td><?php // echo $code_listing['MasterListing']['sale_price_de']  ?></td> 
             
        <td><?php // echo $code_listing['MasterListing']['sale_price_de']  ?></td> 
        
         <td><?php  echo $code_listing['AdminListing']['web_sale_price_fr']; ?></td>         
           
       <?php foreach ($Amazonfr as $amazonfr): ?>
       <?php if(($code_listing['AdminListing']['linnworks_code']) === ($amazonfr['MasterListing']['linnworks_code'])){  ?>  
       <?php  if ((strpos($amazonfr['MasterListing']['amazon_sku'], 'FBA') === false) && ($amazonfr['MasterListing']['sale_price_fr'])){?>
            <td><?php echo $amazonfr['MasterListing']['sale_price_fr'];  ?></td> 
            <?php break; } ?>
             <?php } ?>
           <?php endforeach; ?>
            
        <td><?php // echo $code_listing['MasterListing']['sale_price_fr']  ?></td>          
        </tr>
    <?php endforeach; ?>
    <?php echo $this->Form->end();?>
      </tbody>
    </table>
  </div>
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
    $('#MasterListingError').click(function(event) {  //on click
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
		$('#MasterListingError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#MasterListingError').removeAttr('disabled','disabled');
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