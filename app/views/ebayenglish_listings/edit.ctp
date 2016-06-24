<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="ebayenglish_listings form">
<?php echo $this->Form->create('EbayenglishListing');?>
	<fieldset>
		<legend><?php __('Edit Ebay UK Listing'); ?></legend>
		<div style="float:right;"><?php echo $this->Form->button('Save data', array('value'=>'Save data','type'=>'submit')); ?></div>
		<?php
		echo $this->Form->hidden('id',array('value'=>$this->data['EbayenglishListing']['id']));
                echo $this->Form->input('product_code');
	   	echo $this->Form->input('item_sku');		
		 $title = mb_convert_encoding($this->data['EbayenglishListing']['title'], "UTF-8", mb_detect_encoding($this->data['EbayenglishListing']['title'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('title',array('id'=>'sessiontitle','value'=>$title,'maxlength'=>'500','error' => 'Title maximum length is 500 characters.'));
		?>
		<div class="text_errror">Number of chars: <span id="sessiontitle_counter">500</span></div>
		<?php 
		echo $this->Form->input('keywords');
		$description = mb_convert_encoding($this->data['EbayenglishListing']['description'], "UTF-8", mb_detect_encoding($this->data['EbayenglishListing']['description'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('description',array('id'=>'sessionedesc','value'=>$description,'maxlength'=>'2000','error' => 'description maximum length is 2000 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionedesc_counter">2000</span></div>
		<?php echo $this->Form->input('sale_price');
		echo $this->Form->input('size');
		echo $this->Form->input('brand');
		echo $this->Form->input('color');
		echo $this->Form->input('color1');		
		echo $this->Form->input('material');
		echo $this->Form->input('room');
		echo $this->Form->input('type');
		echo $this->Form->input('sub_type');
		echo $this->Form->input('plant_required');
		echo $this->Form->input('image');
		echo $this->Form->input('image1');
		$modify_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('modify_by',array('value'=>$modify_by));
		?>		
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
$(document).ready(function(){
var maxChars = $("#sessiontitle");
var max_length = maxChars.attr('maxlength');
if (max_length > 0) {
    maxChars.bind('keyup', function(e){
        length = new Number(maxChars.val().length);
        counter = max_length-length;
        $("#sessiontitle_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionedesc");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionedesc_counter").text(counter);
    });
}
});
</script>