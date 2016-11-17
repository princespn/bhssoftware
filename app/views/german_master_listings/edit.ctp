<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="projects form">
<?php echo $this->Form->create('InventoryMaster');?>
    <fieldset>
        <legend><?php __('Edit Master Listing'); ?></legend>
        <div style="float:right;"><?php echo $this->Form->button('Save data', array('value'=>'Save data','type'=>'submit','id'=>'hide')); ?></div>
<?php
echo $this->Form->hidden('id',array('value'=>$this->data['InventoryMaster']['id']));
$wordlist = split ("\_", $this->data['InventoryMaster']['item_sku']); 	
echo $this->Form->input('item_sku',array('readonly' => 'readonly','value'=>$this->data['InventoryMaster']['item_sku']));		
echo $this->Form->input('external_product_id',array('type'=>'text','label' =>'External Product Id','value'=>$this->data['InventoryMaster']['external_product_id']));
echo $this->Form->input('external_product_id_type',array('value'=>$this->data['InventoryMaster']['external_product_id_type']));
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['item_name']))){echo $this->Form->input('item_name',array('value'=>$this->data['InventoryMaster']['item_name'],'id'=>'sessionNum','maxLength'=>'500','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['item_name'])>'500'){echo $this->Form->input('item_name',array('value'=>$this->data['InventoryMaster']['item_name'],'id'=>'sessionNum','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('item_name',array('value'=>$this->data['InventoryMaster']['item_name'],'id'=>'sessionNum','maxLength'=>'500'));}
?><div class="text_errror">Number of chars: <span id="sessionNum_counter">500</span>&nbsp;&nbsp;&nbsp;<a href=""><?php echo "Title cheker"; ?></a></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['brand_name']))){echo $this->Form->input('brand_name',array('value'=>$this->data['InventoryMaster']['brand_name'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('brand_name',array('value'=>$this->data['InventoryMaster']['brand_name'],'readonly'=>'readonly'));}
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['manufacturer']))){echo $this->Form->input('manufacturer',array('value'=>$this->data['InventoryMaster']['manufacturer'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('manufacturer',array('value'=>$this->data['InventoryMaster']['manufacturer'],'readonly'=>'readonly'));}
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['feed_product_type']))){echo $this->Form->input('feed_product_type',array('value'=>$this->data['InventoryMaster']['feed_product_type'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('feed_product_type',array('value'=>$this->data['InventoryMaster']['feed_product_type'],'readonly'=>'readonly'));}
echo $this->Form->input('part_number',array('value'=>$this->data['InventoryMaster']['part_number']));
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['product_description']))){echo $this->Form->input('product_description',array('value'=>$this->data['InventoryMaster']['product_description'],'id'=>'sessiondesc','maxLength'=>'2000','class'=>'warning'));}elseif(strlen($this->data['InventoryMaster']['product_description'])>'2000'){echo $this->Form->input('product_description',array('value'=>$this->data['InventoryMaster']['product_description'],'id'=>'sessiondesc','maxLength'=>'2000','class'=>'warning'));}else{echo $this->Form->input('product_description',array('value'=>$this->data['InventoryMaster']['product_description'],'id'=>'sessiondesc','maxLength'=>'2000')); } ?><div class="text_errror">Number of chars: <span id="sessiondesc_counter">2000</span></div>
<?php echo $this->Form->input('update_delete',array('value'=>$this->data['InventoryMaster']['update_delete']));
echo $this->Form->input('product_site_launch_date',array('value'=>$this->data['InventoryMaster']['product_site_launch_date']));
if((($this->data['InventoryMaster']['parent_child'])!=='parent') && (empty($this->data['InventoryMaster']['standard_price']))){echo $this->Form->input('standard_price',array('value'=>$this->data['InventoryMaster']['standard_price'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('standard_price',array('value'=>$this->data['InventoryMaster']['standard_price'],'readonly'=>'readonly'));}
echo $this->Form->input('currency',array('value'=>$this->data['InventoryMaster']['currency']));
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['quantity']))){}else{echo $this->Form->input('quantity',array('value'=>$this->data['InventoryMaster']['quantity']));}
echo $this->Form->input('item_package_quantity',array('value'=>$this->data['InventoryMaster']['item_package_quantity']));
echo $this->Form->input('product_tax_code',array('value'=>$this->data['InventoryMaster']['product_tax_code']));
echo $this->Form->input('merchant_release_date',array('value'=>$this->data['InventoryMaster']['merchant_release_date']));
//echo $this->Form->input('sale_price',array('value'=>$this->data['InventoryMaster']['sale_price'],'readonly'=>'readonly'));
if((($this->data['InventoryMaster']['parent_child'])!=='parent') && (empty($this->data['InventoryMaster']['sale_price']))){echo $this->Form->input('sale_price',array('value'=>$this->data['InventoryMaster']['sale_price'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('sale_price',array('value'=>$this->data['InventoryMaster']['sale_price'],'readonly'=>'readonly'));}
echo $this->Form->input('sale_from_date',array('value'=>$this->data['InventoryMaster']['sale_from_date']));
echo $this->Form->input('sale_end_date',array('value'=>$this->data['InventoryMaster']['sale_end_date']));
echo $this->Form->input('condition_type',array('value'=>$this->data['InventoryMaster']['condition_type']));
echo $this->Form->input('condition_note',array('value'=>$this->data['InventoryMaster']['condition_note']));
echo $this->Form->input('fulfillment_latency',array('value'=>$this->data['InventoryMaster']['fulfillment_latency']));
echo $this->Form->input('restock_date',array('value'=>$this->data['InventoryMaster']['restock_date']));
/*echo $this->Form->input('max_aggregate_ship_quantity');
echo $this->Form->input('offering_can_be_gift_messaged');
echo $this->Form->input('offering_can_be_giftwrapped');
echo $this->Form->input('is_discontinued_by_manufacturer');
echo $this->Form->input('missing_keyset_reason');
echo $this->Form->input('website_shipping_weight');
echo $this->Form->input('website_shipping_weight_unit_of_measure');
echo $this->Form->input('item_display_length');
echo $this->Form->input('item_display_length_unit_of_measure');
echo $this->Form->input('item_display_width');
echo $this->Form->input('item_display_width_unit_of_measure');
echo $this->Form->input('item_display_height');
echo $this->Form->input('item_display_height_unit_of_measure');
echo $this->Form->input('item_display_depth');
echo $this->Form->input('item_display_depth_unit_of_measure');
echo $this->Form->input('item_display_diameter');
echo $this->Form->input('item_display_diameter_unit_of_measure');
echo $this->Form->input('item_display_weight');
echo $this->Form->input('item_display_weight_unit_of_measure');
echo $this->Form->input('volume_capacity_name');
echo $this->Form->input('volume_capacity_name_unit_of_measure');
echo $this->Form->input('item_display_volume');
echo $this->Form->input('item_display_volume_unit_of_measure');*/
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['recommended_browse_nodes1']))){echo $this->Form->input('recommended_browse_nodes1',array('class'=>'warning'));}else{echo $this->Form->input('recommended_browse_nodes1');}
echo $this->Form->input('recommended_browse_nodes2');
echo $this->Form->input('catalog_number');
if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['bullet_point1']))){echo $this->Form->input('bullet_point1',array('value'=>$this->data['InventoryMaster']['bullet_point1'],'id'=>'sessionbullet1','maxLength'=>'500','class'=>'warning'));}elseif(strlen($this->data['InventoryMaster']['bullet_point1'])>'500'){echo $this->Form->input('bullet_point1',array('value'=>$this->data['InventoryMaster']['bullet_point1'],'id'=>'sessionbullet1','maxLength'=>'500','class'=>'warning'));}else{echo $this->Form->input('bullet_point1',array('value'=>$this->data['InventoryMaster']['bullet_point1'],'id'=>'sessionbullet1','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet1_counter">500</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['bullet_point2']))){echo $this->Form->input('bullet_point2',array('value'=>$this->data['InventoryMaster']['bullet_point2'],'id'=>'sessionbullet2','maxLength'=>'500','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['bullet_point2'])>'500'){echo $this->Form->input('bullet_point2',array('value'=>$this->data['InventoryMaster']['bullet_point2'],'id'=>'sessionbullet2','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point2',array('value'=>$this->data['InventoryMaster']['bullet_point2'],'id'=>'sessionbullet2','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet2_counter">500</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['bullet_point3']))){echo $this->Form->input('bullet_point3',array('value'=>$this->data['InventoryMaster']['bullet_point3'],'id'=>'sessionbullet3','maxLength'=>'500','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['bullet_point3'])>'500'){echo $this->Form->input('bullet_point3',array('value'=>$this->data['InventoryMaster']['bullet_point3'],'id'=>'sessionbullet3','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point3',array('value'=>$this->data['InventoryMaster']['bullet_point3'],'id'=>'sessionbullet3','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet3_counter">500</span></div>
<?php  if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['bullet_point4']))){echo $this->Form->input('bullet_point4',array('value'=>$this->data['InventoryMaster']['bullet_point4'],'id'=>'sessionbullet4','maxLength'=>'500','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['bullet_point4'])>'500'){echo $this->Form->input('bullet_point4',array('value'=>$this->data['InventoryMaster']['bullet_point4'],'id'=>'sessionbullet4','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point4',array('value'=>$this->data['InventoryMaster']['bullet_point4'],'id'=>'sessionbullet4','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet4_counter">500</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['bullet_point5']))){echo $this->Form->input('bullet_point5',array('value'=>$this->data['InventoryMaster']['bullet_point5'],'id'=>'sessionbullet5','maxLength'=>'500','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['bullet_point5'])>'500'){echo $this->Form->input('bullet_point5',array('value'=>$this->data['InventoryMaster']['bullet_point5'],'id'=>'sessionbullet5','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point5',array('value'=>$this->data['InventoryMaster']['bullet_point5'],'id'=>'sessionbullet5','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet5_counter">500</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['generic_keywords1']))){echo $this->Form->input('generic_keywords1',array('value'=>$this->data['InventoryMaster']['generic_keywords1'],'id'=>'sessiongen_key1','maxLength'=>'50','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['generic_keywords1'])>'50'){echo $this->Form->input('generic_keywords1',array('value'=>$this->data['InventoryMaster']['generic_keywords1'],'id'=>'sessiongen_key1','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords1',array('value'=>$this->data['InventoryMaster']['generic_keywords1'],'id'=>'sessiongen_key1','maxLength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter1">50</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['generic_keywords2']))){echo $this->Form->input('generic_keywords2',array('value'=>$this->data['InventoryMaster']['generic_keywords2'],'id'=>'sessiongen_key2','maxLength'=>'50','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['generic_keywords2'])>'50'){echo $this->Form->input('generic_keywords2',array('value'=>$this->data['InventoryMaster']['generic_keywords2'],'id'=>'sessiongen_key2','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords2',array('value'=>$this->data['InventoryMaster']['generic_keywords2'],'id'=>'sessiongen_key2','maxLength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter2">50</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['generic_keywords3']))){echo $this->Form->input('generic_keywords3',array('value'=>$this->data['InventoryMaster']['generic_keywords3'],'id'=>'sessiongen_key3','maxLength'=>'50','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['generic_keywords3'])>'50'){echo $this->Form->input('generic_keywords3',array('value'=>$this->data['InventoryMaster']['generic_keywords3'],'id'=>'sessiongen_key3','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords3',array('value'=>$this->data['InventoryMaster']['generic_keywords3'],'id'=>'sessiongen_key3','maxLength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter3">50</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['generic_keywords4']))){echo $this->Form->input('generic_keywords4',array('value'=>$this->data['InventoryMaster']['generic_keywords4'],'id'=>'sessiongen_key4','maxLength'=>'50','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['generic_keywords4'])>'50'){echo $this->Form->input('generic_keywords4',array('value'=>$this->data['InventoryMaster']['generic_keywords4'],'id'=>'sessiongen_key4','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords4',array('value'=>$this->data['InventoryMaster']['generic_keywords4'],'id'=>'sessiongen_key4','maxLength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter4">50</span></div>
<?php if(((isset($wordlist[1]))!=='FBA') && (empty($this->data['InventoryMaster']['generic_keywords5']))){echo $this->Form->input('generic_keywords5',array('value'=>$this->data['InventoryMaster']['generic_keywords5'],'id'=>'sessiongen_key5','maxLength'=>'50','class' =>'warning'));}elseif(strlen($this->data['InventoryMaster']['generic_keywords5'])>'50'){echo $this->Form->input('generic_keywords5',array('value'=>$this->data['InventoryMaster']['generic_keywords5'],'id'=>'sessiongen_key5','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords5',array('value'=>$this->data['InventoryMaster']['generic_keywords5'],'id'=>'sessiongen_key5','maxLength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter5">50</span></div>
<?php 
echo $this->Form->input('platinum_keywords1',array('value'=>$this->data['InventoryMaster']['platinum_keywords1']));
echo $this->Form->input('platinum_keywords2',array('value'=>$this->data['InventoryMaster']['platinum_keywords2']));
echo $this->Form->input('platinum_keywords3',array('value'=>$this->data['InventoryMaster']['platinum_keywords3']));
echo $this->Form->input('platinum_keywords4',array('value'=>$this->data['InventoryMaster']['platinum_keywords4']));
echo $this->Form->input('platinum_keywords5',array('value'=>$this->data['InventoryMaster']['platinum_keywords5']));
/*echo $this->Form->input('target_audience_keywords1',array('value'=>$this->data['InventoryMaster']['target_audience_keywords1']));
echo $this->Form->input('target_audience_keywords2',array('value'=>$this->data['InventoryMaster']['target_audience_keywords2']));
echo $this->Form->input('target_audience_keywords3',array('value'=>$this->data['InventoryMaster']['target_audience_keywords3']));
echo $this->Form->input('target_audience_keywords4',array('value'=>$this->data['InventoryMaster']['target_audience_keywords4']));
echo $this->Form->input('target_audience_keywords5',array('value'=>$this->data['InventoryMaster']['target_audience_keywords5']));*/
echo $this->Form->input('main_image_url',array('value'=>$this->data['InventoryMaster']['main_image_url']));
echo $this->Form->input('swatch_image_url',array('value'=>$this->data['InventoryMaster']['swatch_image_url']));
echo $this->Form->input('other_image_url2',array('value'=>$this->data['InventoryMaster']['other_image_url2']));
echo $this->Form->input('other_image_url3',array('value'=>$this->data['InventoryMaster']['other_image_url3']));
echo $this->Form->input('other_image_url4',array('value'=>$this->data['InventoryMaster']['other_image_url4']));
echo $this->Form->input('other_image_url5',array('value'=>$this->data['InventoryMaster']['other_image_url5']));
echo $this->Form->input('other_image_url6',array('value'=>$this->data['InventoryMaster']['other_image_url6']));
echo $this->Form->input('other_image_url7',array('value'=>$this->data['InventoryMaster']['other_image_url7']));
echo $this->Form->input('other_image_url8',array('value'=>$this->data['InventoryMaster']['other_image_url8']));
echo $this->Form->input('parent_child',array('value'=>$this->data['InventoryMaster']['parent_child']));
echo $this->Form->input('parent_sku',array('value'=>$this->data['InventoryMaster']['parent_sku']));
echo $this->Form->input('relationship_type',array('value'=>$this->data['InventoryMaster']['relationship_type']));
echo $this->Form->input('variation_theme',array('value'=>$this->data['InventoryMaster']['variation_theme']));
echo $this->Form->input('color_name',array('value'=>$this->data['InventoryMaster']['color_name']));
echo $this->Form->input('color_map',array('value'=>$this->data['InventoryMaster']['color_map']));
echo $this->Form->input('size_name',array('value'=>$this->data['InventoryMaster']['size_name']));
echo $this->Form->input('material_type1',array('value'=>$this->data['InventoryMaster']['material_type1']));
echo $this->Form->input('material_type2',array('value'=>$this->data['InventoryMaster']['material_type2']));
$error_by = '';
echo $this->Form->hidden('error',array('value'=>$error_by));
$modify_by = $session->read('Auth.User.username');
echo $this->Form->hidden('modify_by',array('value'=>$modify_by));
?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var maxChars = $("#sessionNum");
        var max_length = maxChars.attr('maxLength');
        if (max_length > 0) {
            maxChars.bind('keyup', function (e) {
                length = new Number(maxChars.val().length);
                counter = max_length - length;
                $("#sessionNum_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiondesc");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiondesc_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessionbullet1");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessionbullet1_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessionbullet2");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessionbullet2_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessionbullet3");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessionbullet3_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessionbullet4");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessionbullet4_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessionbullet5");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessionbullet5_counter").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiongen_key1");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiongen_counter1").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiongen_key2");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiongen_counter2").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiongen_key3");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiongen_counter3").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiongen_key4");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiongen_counter4").text(counter);
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxCharsdesc = $("#sessiongen_key5");
        var max_lengthdesc = maxCharsdesc.attr('maxLength');
        if (max_lengthdesc > 0) {
            maxCharsdesc.bind('keyup', function (e) {
                length = new Number(maxCharsdesc.val().length);
                counter = max_lengthdesc - length;
                $("#sessiongen_counter5").text(counter);
            });
        }
    });
</script>
<script>
    $(document).ready(function () {
        $("#hide").click(function () {
            $("#hiderror").hide();
        });
    });
</script>