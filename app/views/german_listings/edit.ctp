<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="german_listings form">

<?php // echo $this->Form->create('GermanListing',array('enctype'=>'multipart/form-data'));
echo $this->Form->create('GermanListing');
?>
	<fieldset>
		<legend><?php __('Edit Amazon Germany Listing'); ?></legend>
		<div style="float:right;"><?php echo $this->Form->button('Save data', array('value'=>'Save data','type'=>'submit')); ?></div>
		<?php
	    echo $this->Form->hidden('id',array('value'=>$this->data['GermanListing']['id']));
        echo $this->Form->input('product_code');	
		echo $this->Form->input('item_sku');					
		$item_name = mb_convert_encoding($this->data['GermanListing']['item_name'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['item_name'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('item_name',array('id'=>'sessionNum','value'=>$item_name,'maxlength'=>'500','error' => 'Item name maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionNum_counter">500</span></div>
		<?php
		echo $this->Form->input('keywords');
		$external_id = mb_convert_encoding($this->data['GermanListing']['external_product_id'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['external_product_id'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('external_product_id',array('type'=>'text','label' =>'External Product Id','value'=>$external_id));
		echo $this->Form->input('external_product_id_type');
		echo $this->Form->input('feed_product_type');
		echo $this->Form->input('brand_name');
		echo $this->Form->input('manufacturer');		
		echo $this->Form->input('part_number');
		 $description = mb_convert_encoding($this->data['GermanListing']['product_description'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['product_description'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('product_description',array('id'=>'sessiondesc','value'=>$description,'maxlength'=>'2000','error' => 'description maximum length is 2000 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiondesc_counter">2000</span></div>
		<?php echo $this->Form->input('update_delete');
		echo $this->Form->input('quantity');
		echo $this->Form->input('standard_price',array('readonly'=>'readonly'));
		echo $this->Form->input('currency');
		echo $this->Form->input('condition_type');
		echo $this->Form->input('condition_note');
		echo $this->Form->input('product_site_launch_date');
		echo $this->Form->input('fulfillment_latency');
		echo $this->Form->input('merchant_release_date');
		echo $this->Form->input('restock_date');
		echo $this->Form->input('sale_price',array('readonly'=>'readonly'));
		echo $this->Form->input('sale_from_date');
		echo $this->Form->input('sale_end_date');
		echo $this->Form->input('max_aggregate_ship_quantity');
		echo $this->Form->input('offering_can_be_gift_messaged');
		echo $this->Form->input('offering_can_be_giftwrapped');		
		echo $this->Form->input('missing_keyset_reason');
		echo $this->Form->input('is_discontinued_by_manufacturer');		
		echo $this->Form->input('item_package_quantity');
		echo $this->Form->input('product_tax_code');
		$group_id = mb_convert_encoding($this->data['GermanListing']['delivery_schedule_group_id'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['delivery_schedule_group_id'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('delivery_schedule_group_id',array('type'=>'text','value'=>$group_id));
		echo $this->Form->input('merchant_shipping_group_name');		
		echo $this->Form->input('website_shipping_weight');
		echo $this->Form->input('website_shipping_weight_unit_of_measure');
		echo $this->Form->input('item_weight');
		echo $this->Form->input('item_weight_unit_of_measure');
		echo $this->Form->input('item_length');
		echo $this->Form->input('item_length_unit_of_measure');
		echo $this->Form->input('item_width');
		echo $this->Form->input('item_width_unit_of_measure');
		echo $this->Form->input('item_height');
		echo $this->Form->input('item_height_unit_of_measure');
		echo $this->Form->input('item_display_depth');
		echo $this->Form->input('item_display_depth_unit_of_measure');
		echo $this->Form->input('item_display_diameter');
		echo $this->Form->input('item_display_diameter_unit_of_measure');
		$bull_point1 = mb_convert_encoding($this->data['GermanListing']['bullet_point1'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['bullet_point1'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('bullet_point1',array('id'=>'sessionbullet1','value'=>$bull_point1,'maxlength'=>'500','error' => 'Bullet Point1 maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionbullet1_counter">500</span></div>
	<?php 
	$bull_point2 = mb_convert_encoding($this->data['GermanListing']['bullet_point2'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['bullet_point2'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
	echo $this->Form->input('bullet_point2',array('id'=>'sessionbullet2','value'=>$bull_point2,'maxlength'=>'500','error' => 'Bullet Point1 maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionbullet2_counter">500</span></div>
	<?php 
	$bull_point3 = mb_convert_encoding($this->data['GermanListing']['bullet_point3'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['bullet_point3'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
	echo $this->Form->input('bullet_point3',array('id'=>'sessionbullet3','value'=>$bull_point3,'maxlength'=>'500','error' => 'Bullet Point1 maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionbullet3_counter">500</span></div>
	<?php $bull_point4 = mb_convert_encoding($this->data['GermanListing']['bullet_point4'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['bullet_point4'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
	echo $this->Form->input('bullet_point4',array('id'=>'sessionbullet4','value'=>$bull_point4,'maxlength'=>'500','error' => 'Bullet Point1 maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionbullet4_counter">500</span></div>
	<?php $bull_point5 = mb_convert_encoding($this->data['GermanListing']['bullet_point5'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['bullet_point5'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
	echo $this->Form->input('bullet_point5',array('id'=>'sessionbullet5','value'=>$bull_point5,'maxlength'=>'500','error' => 'Bullet Point1 maximum length is 500 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessionbullet5_counter">500</span></div>
	
		<?php 
		echo $this->Form->input('recommended_browse_nodes1');
		echo $this->Form->input('recommended_browse_nodes2');	
		$gen_keywords1 = mb_convert_encoding($this->data['GermanListing']['generic_keywords1'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['generic_keywords1'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('generic_keywords1',array('value'=>$gen_keywords1,'id'=>'sessiongen_key1','maxlength'=>'50','error' => 'Generic keywords1 maximum length is 50 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiongen_counter1">50</span></div>
                <?php $gen_keywords2 = mb_convert_encoding($this->data['GermanListing']['generic_keywords2'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['generic_keywords2'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('generic_keywords2',array('value'=>$gen_keywords2,'id'=>'sessiongen_key2','maxlength'=>'50','error' => 'Generic keywords2 maximum length is 50 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiongen_counter2">50</span></div>
                <?php $gen_keywords3 = mb_convert_encoding($this->data['GermanListing']['generic_keywords3'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['generic_keywords3'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('generic_keywords3',array('value'=>$gen_keywords3,'id'=>'sessiongen_key3','maxlength'=>'50','error' => 'Generic keywords3 maximum length is 50 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiongen_counter3">50</span></div>
                <?php $gen_keywords4 = mb_convert_encoding($this->data['GermanListing']['generic_keywords4'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['generic_keywords4'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('generic_keywords4',array('value'=>$gen_keywords4,'id'=>'sessiongen_key4','maxlength'=>'50','error' => 'Generic keywords4 maximum length is 50 characters.'));
		?><div class="text_errror">Number of chars: <span id="sessiongen_counter4">50</span></div>
                <?php $gen_keywords5 = mb_convert_encoding($this->data['GermanListing']['generic_keywords5'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['generic_keywords5'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('generic_keywords5',array('value'=>$gen_keywords5,'id'=>'sessiongen_key5','maxlength'=>'50','error' => 'Generic keywords5 maximum length is 50 characters.'));		
		?><div class="text_errror">Number of chars: <span id="sessiongen_counter5">50</span></div>
                <?php echo $this->Form->input('catalog_number');
		echo $this->Form->input('platinum_keywords1');
		echo $this->Form->input('platinum_keywords2');
		echo $this->Form->input('platinum_keywords3');
		echo $this->Form->input('platinum_keywords4');
		echo $this->Form->input('platinum_keywords5');
		echo $this->Form->input('target_audience_keywords');		
		echo $this->Form->input('main_image_url');
		echo $this->Form->input('swatch_image_url');
		echo $this->Form->input('other_image_url2');
		echo $this->Form->input('other_image_url3');
		echo $this->Form->input('other_image_url4');
		echo $this->Form->input('other_image_url5');
		echo $this->Form->input('other_image_url6');
		echo $this->Form->input('other_image_url7');
		echo $this->Form->input('other_image_url8');
		$center_id = mb_convert_encoding($this->data['GermanListing']['fulfillment_center_id'], "UTF-8", mb_detect_encoding($this->data['GermanListing']['fulfillment_center_id'], "UTF-8, ISO-8859-1, ISO-8859-15", true));
		echo $this->Form->input('fulfillment_center_id',array('type'=>'text','value'=>$center_id));
		echo $this->Form->input('package_length');
		echo $this->Form->input('package_width');
		echo $this->Form->input('package_height');
		echo $this->Form->input('package_length_unit_of_measure');
		echo $this->Form->input('package_weight');
		echo $this->Form->input('package_weight_unit_of_measure');
		echo $this->Form->input('relationship_type');
		echo $this->Form->input('parent_child');
		echo $this->Form->input('parent_sku');		
		echo $this->Form->input('variation_theme');		
		echo $this->Form->input('legal_disclaimer_description');		
		echo $this->Form->input('color_name');		
		echo $this->Form->input('size_name');
		echo $this->Form->input('special_features');
		echo $this->Form->input('material_type');
		echo $this->Form->input('number_of_sets');
		echo $this->Form->input('special_features');
		echo $this->Form->input('material_composition');
		
		
		
		$modify_by = $session->read('Auth.User.username');

		echo $this->Form->hidden('modify_by',array('value'=>$modify_by));
		?>
		
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<script type="text/javascript">
$(document).ready(function(){
var maxChars = $("#sessionNum");
var max_length = maxChars.attr('maxlength');
if (max_length > 0) {
    maxChars.bind('keyup', function(e){
        length = new Number(maxChars.val().length);
        counter = max_length-length;
        $("#sessionNum_counter").text(counter);
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
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionbullet1");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionbullet1_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionbullet2");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionbullet2_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionbullet3");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionbullet3_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionbullet4");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionbullet4_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessionbullet5");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessionbullet5_counter").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiongen_key1");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiongen_counter1").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiongen_key2");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiongen_counter2").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiongen_key3");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiongen_counter3").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiongen_key4");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiongen_counter4").text(counter);
    });
}
});
</script>
<script type="text/javascript">
$(document).ready(function(){
var maxCharsdesc = $("#sessiongen_key5");
var max_lengthdesc = maxCharsdesc.attr('maxlength');
if (max_lengthdesc > 0) {
    maxCharsdesc.bind('keyup', function(e){
        length = new Number(maxCharsdesc.val().length);
        counter = max_lengthdesc-length;
        $("#sessiongen_counter5").text(counter);
    });
}
});
</script>
