<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="inventory_masters form">

<?php echo $this->Form->create('InventoryMaster',array('charset'=>'UTF-8')); ?>
	<fieldset>
		<legend><?php __('Edit Inventory Masters Database'); ?></legend>
		<div style="float:right;"><?php echo $this->Form->button('Save data', array('value'=>'Save data','type'=>'submit')); ?></div>
		<?php
	    	echo $this->Form->hidden('id',array('value'=>$this->data['InventoryMaster']['id']));
                echo $this->Form->input('product_code');
		echo $this->Form->input('item_sku');		
		echo $this->Form->input('barcodes');
		echo $this->Form->input('category');
		echo $this->Form->input('recommended_browse_nodes1');
		echo $this->Form->input('recommended_browse_nodes2');
		echo $this->Form->input('sale_price',array('readonly'=>'readonly'));		
		echo $this->Form->input('item_name',array('id'=>'sessiontitle','maxlength'=>'500','error' => 'Title maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiontitle_counter">500</span></div>
	
	<?php 	echo $this->Form->input('keyword');
	echo $this->Form->input('product_description',array('id'=>'sessiondesc','maxlength'=>'2000','error' => 'description maximum length is 2000 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiondesc_counter">2000</span></div>
                
        	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>       
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiontitle");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiontitle_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiondesc");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiondesc_counter").text(counter);
    });
}
});
</script>