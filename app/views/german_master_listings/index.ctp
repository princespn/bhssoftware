<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}

if((!empty($_POST['checkid'])) && (!empty($_POST['exports']))){
$line= $german_master_listings[0]['GermanMasterListing'];	
$mapping = array('','','Lagerhaltungsnummer','','Produktname','Hersteller-Barcode','Barcode-Typ','Produkttyp','Marke','Hersteller','Artikelnummer','Produktbeschreibung','Update / Löschen','Anzahl','Preis','Währung','Zustandstyp des Angebots','Angebotsbedingung Anmerkung','Produkt-Site Startdatum','Vorlaufzeit für die Lieferung','Veröffentlichungsdatum','Termin zur Wiederauffüllung','Angebotspreis','Startdatum des Sonderangebots','Enddatum des Sonderangebots','Max. Menge Aggregatversand','Maximale Bestellmenge','Angebot kann als Geschenk versendet werden','Angebot kann als Geschenk eingepackt werden','Fehlender Hauptgrund','Wird vom Hersteller nicht mehr hergestellt','Packungseinheit','Steuerkennziffer des Produkts','SKU-Liste für Lieferung zum Wunschtermin','Verkäuferversandgruppe','Versandgewicht','Maßeinheit des auf der Webseite angegebenen Versandgewichts','Artikelgewicht','Maßeinheit des Artikelgewichts','Artikellänge','Maßeinheit der Artikellänge','Artikelbreite','Maßeinheit der Artikelweite','Artikelhöhe','Maßeinheit der Artikelhöhe','Artikeltiefe','Maßeinheit der Tiefe des Artikels','Artikeldurchmesser','Maßeinheit des Durchmessers des Artikels','Attribut1','Attribut2','Attribut3','Attribut4','Attribut5','Produktkategorisierung Suchpfad1','Produktkategorisierung Suchpfad2','Allgemeine Schlüsselwörter1','Allgemeine Schlüsselwörter2','Allgemeine Schlüsselwörter3','Allgemeine Schlüsselwörter4','Allgemeine Schlüsselwörter5','Katalognummer','Platinum Schlüsselwörter1','Platinum Schlüsselwörter2','Platinum Schlüsselwörter3','Platinum Schlüsselwörter4','Platinum Schlüsselwörter5','Zielgruppe','URL Hauptbild','URL Musterbild','URL Weiteres Produktbild1','URL Weiteres Produktbild2','URL Weiteres Produktbild3','URL Weiteres Produktbild4','URL Weiteres Produktbild5','URL Weiteres Produktbild6','URL Weiteres Produktbild7','URL Weiteres Produktbild8','Versandzentrum-ID','Paketbreite','Pakethöhe','Maßeinheit der Verpackungslänge','Paketgewicht','Maßeinheit des Verpackungsgewichts','Produktbeziehungs-Typ','Variantenbestandteil','SKU des übergeordneten Produkts','Varianten-Design','','','','','','','','','','','','','','','','','','','','','','','','','','','','Farbe (Herstellerbezeichnung)','Standardfarbe','Produktspezifische Größe','Gewindeanzahl','Material','','','');
echo $csv->addRow($mapping);
$csv->addRow(array_keys($line));
foreach ($german_master_listings as $german_master_listing){		
$line = $german_master_listing['GermanMasterListing'];
echo $csv->addRow($line);
}
$filename='german_master_listings';
echo $csv->render($filename);
}else{ ?>
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<?php echo $this->Session->flash(); ?>
 <hr>
<h1 class="sub-header"><?php __('Master Amazon German Database.');?> </h1>
<?php  echo $form->create('GermanMasterListing',array('action'=>'index','id'=>'saveForm')); ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">       
        <?php echo $form->checkbox('error',array('label'=>'','value'=>'error','class'=>'wid-20')); ?><?php echo $this->Paginator->sort('Error', 'error', array('direction' => 'desc','class'=>'btn btn-info btn-sm')); ?>
        <?php echo $this->Html->link(__('Import Listing', true), array('controller' => 'german_master_listings', 'action' => 'import'),array('class' => 'btn btn-info btn-sm')); ?>
         <button type="submit" disabled="disabled" value="exports" name="exports" id="exportfile" class="btn btn-primary btn-sm">Export Data</button>
        </div>
          <div class="col-md-4">
          <div class="form-group margin-bottom-0">
            <div class="input-group">
              <span class="search-icon"><i aria-hidden="true" class="fa fa-search"></i></span>
               <?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Linnworks Code, Amazon SKU...', 'class'=>'form-control pa-left')); ?>
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
          <th><?php __('Category');?><select id="GermanMasterListingCategory" name="data[GermanMasterListing][category]">
                <option value='--Select Category--'>--Select Category--</option>
                <?php $option = $this->requestAction('/german_master_listings/categoriesPro'); //echo $this->Form->select('category',array($option)); 
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
    <?php $output = $this->requestAction('/german_listings/saleprice');  $keywords = preg_split("/[\n]+/", $output); ?>
    <?php foreach ($german_listings as $german_listing): ?>
    <?php $wordlist = split ("\_", $german_listing['GermanListing']['item_sku']); ?>
    <tr>
    <td><?php $productid = $german_master_listing['GermanMasterListing']['id'];if(!empty($german_master_listing['GermanMasterListing']['error'])){$class ='checkerror';}else{$class ='checkbox1';}
echo $this->Form->input('GermanMasterListing.id',array('class'=>$class, 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?><?php if(!empty($german_master_listing['GermanMasterListing']['error'])){echo "&#8595;";} ?></td>
   <td><?php  if(!empty($german_master_listing['GermanMasterListing']['main_image_url'])){	echo "<img width='70px' src=".$german_master_listing['GermanMasterListing']['main_image_url'].">";}else { echo '<img width=70px src=/img/images.png>';}?></td>
   <td><?php echo $german_master_listing['GermanProductListing']['product_code']; ?></td>
    <td><?php echo $german_master_listing['GermanMasterListing']['item_sku']; ?></td>
    <td><?php if (!empty($german_master_listing['GermanProductListing']['category'])){ echo $german_master_listing['ProductListing']['category'];} ?></td>
    <td><?php if(($german_master_listing['GermanMasterListing']['recommended_browse_nodes1'])!=($german_master_listing['GermanMasterListing']['recommended_browse_nodes1'])){echo "<div style='color:red;'>Browse nodes is did not match master database.</div>";}else{echo $german_master_listing['GermanMasterListing']['recommended_browse_nodes1'];} ?></td>
    <td><?php if(((isset($wordlist[1]))!=='FBA') && (empty($german_master_listing['GermanMasterListing']['item_name'])))
	{
	echo "<div style='color:red;'>The Title is required</div>";
	}
	else
	{
				$row1 = $german_master_listing['GermanMasterListing']['item_name'];
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
$saleprice = $german_master_listing['GermanMasterListing']['standard_price'];
if(!(empty($saleprice)))
{
	echo $saleprice;
	echo "</BR>";
        echo "<span style='color:red;'>Standard Price is did not match.</span>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if(isset($pieces[1])===($german_master_listing['GermanMasterListing']['item_sku'])){
	if((is_int(isset($pieces[3]))) !== (is_int($saleprice)) || (is_float(isset($pieces[3]))) !== (is_float($saleprice))){echo "<span style='color:red;'>Standard Price is did not match.</span>";}	
	}
	}
}
else if(($german_master_listing['GermanMasterListing']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Standard Price is Required</span>";
}
?></td>	
   <td class="checkbox"><?php 
$stanprice = $german_master_listing['GermanMasterListing']['sale_price'];
if(!(empty($stanprice)))
{
	echo $stanprice;
	echo "</BR>";
        echo "<span style='color:red;'>Sale Price is did not match.</span>";
	foreach ($keywords as $keyword){
	$pieces = explode(",", $keyword);
	if((isset($pieces[1]))===($german_master_listing['GermanMasterListing']['item_sku'])){
	if((is_int(isset($pieces[3]))) !== (is_int($stanprice)) || (is_float(isset($pieces[3]))) !== (is_float($stanprice))){echo "<span style='color:red;'>Sale Price is did not match.</span>";}	
	}
	}
}
else if(($german_master_listing['GermanMasterListing']['parent_child'])==='parent')
{
	echo "<span style='color:red;'>Parent</span>";
}
else
{
echo "<span style='color:red;'>Sale Price is Required</span>";
}
?></td>  
 <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'german_master_listings','action'=>'edit', $german_master_listing['GermanMasterListing']['item_sku']),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'inventory_masters','action' => 'delete', $german_master_listing['GermanMasterListing']['item_sku']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $german_master_listing['GermanMasterListing']['item_sku']));  ?></td>
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
    document.getElementById("GermanMasterListingCategory").onchange = function () {
        var selectedOption = $(this).find('option:selected').text();
        window.location.href = "<?php echo  $actual_link ; ?>/german_master_listings/category/" + selectedOption;
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#GermanMasterListingError').click(function(event) {  //on click
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
		$('#GermanMasterListingError').attr('disabled','disabled');
            });
		$('.checkerror').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1" 
		 $('#exportfile').removeAttr('disabled');
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
		$('#exportfile').attr("disabled", "disabled");
		$('#GermanMasterListingError').removeAttr('disabled','disabled');
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