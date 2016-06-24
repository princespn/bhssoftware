<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="row">
        <div class="col-md-12">
            <div class="panel blue"><h3>Master Inventory</h3></div>
        </div>
    </div>
   <div class="clearfix"></div>
   <div class="row"><div class="col-md-12">
   <div class="col-md-4"></div>
    <div class="col-md-6">
	   <?php
        echo $this->Form->create(null, ['class' => 'form-inline', 'url' => ['controller' => 'stocks', 'action' => 'index']]);
        echo $this->Form->input('keyword',array('label'=>false,'class'=>'form-control input-lg','placeholder'=>'Search Barcode,Category..')); 
		?></div>
		<div class="col-md-2">
		<?php echo $this->Form->button('Search', array('type'=>'submit'));
        echo $this->Form->end();
		?>
		</div>
    </div>
	</div>
    <div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12">
					<div class="col-md-6">
						<div class="panel blue">List the inventory as follows</div>
					</div>					
					<div class="col-md-2">
					<div class="panel blue"><strong>Category Name:</strong></div>
					</div>
					<div class="col-md-4">
						<div class="panel blue"><select id="catid" name="data[Masterinventory][catename]">
								<option value='category'>Please select category.</option>
								<?php foreach ($categories as $category): ?>
								<?php if((!empty($options)) && ($options==$category->CategoryName)){$select='selected=selected';}else {$select='';} ?>
								<?php echo '<option'.' '.$select.' '.'value='. $category->CategoryName .'>'. $category->CategoryName .'</option>'; ?>
								<?php endforeach; ?></select>
						</div>
					</div>
					
				</div>
			</div>
    <div class="row">
        <div class="col-md-2">
            <div class="recent panel green">
                  <div class="item">                   
                        <span class="modified"><strong>Item Number(SKU)</strong></span>
                   </div>
			</div>
        </div>
        <div class="col-md-4">
            <div class="recent panel orange">
					<div class="item">                   
                        <span class="modified"><strong>Product name</strong></span>
                   </div>            
			</div>
        </div>
        <div class="col-md-2">
            <div class="recent-prices panel purple">
					<div class="item">                   
                        <span class="modified"><strong>Barcode Number</strong></span>
                   </div>
            </div>
        </div>
		<div class="col-md-2">
            <div class="recent-prices panel purple">
					<div class="item">                   
                        <span class="modified"><strong>Retail  price</strong></span>
                   </div>
            </div>
        </div>
		<div class="col-md-2">
            <div class="recent-prices panel purple">
					<div class="item">                   
                        <span class="modified"><strong>Quantity</strong></span>
                   </div>
            </div>
        </div>		 
    </div> 
	<div class="row">
        <div class="col-md-12">
            <div class="panel blue"><?php //print_r($stocks->Data);?></div>
        </div>
    </div>
		<?php foreach ($stocks->Data as $data): ?>
		<div class="row">
        <div class="col-md-2">
            <div class="recent panel green">
                    <div class="item">
                      <span class="modified"><?= h($data->ItemNumber) ?></span>
                    </div>                
            </div>
        </div>
        <div class="col-md-4">
            <div class="recent panel orange">
            <div class="item">
                      <span class="modified"><?= h($data->ItemTitle) ?></span>
                    </div> 
			</div>
        </div>
        <div class="col-md-2">
            <div class="recent-prices panel purple">
				  <div class="item">
						  <span class="modified"><?= h($data->BarcodeNumber) ?></span>
				   </div> 
			</div> 
		</div>
		<div class="col-md-2">
            <div class="recent-prices panel purple">
				  <div class="item">
						  <span class="modified"><?= h($data->RetailPrice) ?></span>
				   </div> 
			</div> 
		</div>
		<div class="col-md-1">
            <div class="recent-prices panel purple">
				  <div class="item">
						  <span class="modified"><?= h($data->Quantity) ?></span>
				   </div> 
			</div> 
		</div>
		<div class="col-md-1">
            <div class="recent panel green">
				  <div class="item">
				  <?php if(!empty($data->BarcodeNumber)){$sid=$data->BarcodeNumber;}else{$sid=$data->ItemNumber;} ?>
						<span class="label"><?= $this->Html->link('Edit', ['controller' => 'stocks', 'action' => 'update',$data->StockItemId,$sid]);?></span>
				   </div> 
			</div>              
        </div>		
        </div>
		<?php endforeach; ?>
		<div class="row">
        <div class="col-md-12">
		 <div class="col-md-3"></div>
            <div class="col-md-6"><?php print_r($pagination); ?></div>
			 <div class="col-md-3"></div>
        </div>
    </div>
	
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'];?>
<script type="text/javascript">
document.getElementById("catid").onchange = function() {
var selectedOption = $(this).find('option:selected').text();
window.location.href = "<?php echo  $actual_link ; ?>/stocks/index/" + selectedOption;
}
</script>

