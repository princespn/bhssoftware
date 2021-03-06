<?php
if($session->read('Auth.User.group_id')!='1')
{
$this->requestAction('/users/logout/', array('return'));

}
?>
<?php echo $this->Form->create('EnglishListing');?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('Edit Amazon UK Listing');?></h1>
<hr>
<div class="row">
<div class="col-lg-5 col-lg-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading custom-panel-heading"><?php __('Amazon UK Listing');?></div>
            <div class="panel-body form-horizontal">
                <div class="form-group">          
                    <div class="col-sm-9">
                                  <?php echo $this->Form->hidden('id',array('value'=>$this->data['EnglishListing']['id'])); ?>
                                  <?php $wordlist = split ("\_", $this->data['EnglishListing']['item_sku']);  ?>
                    </div>
                </div>        
    <div class="form-group">                               
    <div class="col-sm-9">   
 <?php
echo $this->Form->hidden('id',array('value'=>$this->data['EnglishListing']['id']));
$wordlist = split ("\_", $this->data['EnglishListing']['item_sku']); 	
echo $this->Form->input('item_sku',array('readonly' => 'readonly','value'=>$this->data['EnglishListing']['item_sku']));		
echo $this->Form->input('external_product_id',array('type'=>'text','label' =>'External Product Id','value'=>$this->data['EnglishListing']['external_product_id']));
echo $this->Form->input('external_product_id_type',array('value'=>$this->data['EnglishListing']['external_product_id_type']));
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['item_name']))){echo $this->Form->input('item_name',array('value'=>$this->data['EnglishListing']['item_name'],'id'=>'sessionNum','maxlength'=>'500','class' =>'warning'));}else{echo $this->Form->input('item_name',array('value'=>$this->data['EnglishListing']['item_name'],'id'=>'sessionNum','maxlength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionNum_counter">500</span>&nbsp;&nbsp;&nbsp;<a href=""><?php echo "Title cheker"; ?></a></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['brand_name']))){echo $this->Form->input('brand_name',array('value'=>$this->data['EnglishListing']['brand_name'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('brand_name',array('value'=>$this->data['EnglishListing']['brand_name'],'readonly'=>'readonly'));}
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['manufacturer']))){echo $this->Form->input('manufacturer',array('value'=>$this->data['EnglishListing']['manufacturer'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('manufacturer',array('value'=>$this->data['EnglishListing']['manufacturer'],'readonly'=>'readonly'));}
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['feed_product_type']))){echo $this->Form->input('feed_product_type',array('value'=>$this->data['EnglishListing']['feed_product_type'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('feed_product_type',array('value'=>$this->data['EnglishListing']['feed_product_type'],'readonly'=>'readonly'));}
//echo $this->Form->input('brand_name',array('value'=>$this->data['EnglishListing']['brand_name']));
//echo $this->Form->input('manufacturer',array('value'=>$this->data['EnglishListing']['manufacturer']));
//echo $this->Form->input('feed_product_type',array('value'=>$this->data['EnglishListing']['feed_product_type']));
echo $this->Form->input('part_number',array('value'=>$this->data['EnglishListing']['part_number']));
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['product_description']))){echo $this->Form->input('product_description',array('value'=>$this->data['EnglishListing']['product_description'],'id'=>'sessiondesc','maxlength'=>'2000','class'=>'warning')); }else{echo $this->Form->input('product_description',array('value'=>$this->data['EnglishListing']['product_description'],'id'=>'sessiondesc','maxlength'=>'2000'));}?><div class="text_errror">Number of chars: <span id="sessiondesc_counter">2000</span></div>
<?php echo $this->Form->input('update_delete',array('value'=>$this->data['EnglishListing']['update_delete']));
echo $this->Form->input('product_site_launch_date',array('value'=>$this->data['EnglishListing']['product_site_launch_date']));
if((($this->data['EnglishListing']['parent_child'])!=='parent') && (empty($this->data['EnglishListing']['standard_price']))){echo $this->Form->input('standard_price',array('value'=>$this->data['EnglishListing']['standard_price'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('standard_price',array('value'=>$this->data['EnglishListing']['standard_price'],'readonly'=>'readonly'));}
echo $this->Form->input('currency',array('value'=>$this->data['EnglishListing']['currency']));
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['quantity']))){}else{echo $this->Form->input('quantity',array('value'=>$this->data['EnglishListing']['quantity']));}
echo $this->Form->input('item_package_quantity',array('value'=>$this->data['EnglishListing']['item_package_quantity']));
echo $this->Form->input('product_tax_code',array('value'=>$this->data['EnglishListing']['product_tax_code']));
echo $this->Form->input('merchant_release_date',array('value'=>$this->data['EnglishListing']['merchant_release_date']));
if((($this->data['EnglishListing']['parent_child'])!=='parent') && (empty($this->data['EnglishListing']['sale_price']))){echo $this->Form->input('sale_price',array('value'=>$this->data['EnglishListing']['sale_price'],'readonly'=>'readonly','class'=>'warning'));}else{echo $this->Form->input('sale_price',array('value'=>$this->data['EnglishListing']['sale_price'],'readonly'=>'readonly'));}
//echo $this->Form->input('sale_price',array('value'=>$this->data['EnglishListing']['sale_price'],'readonly'=>'readonly'));
echo $this->Form->input('sale_from_date',array('value'=>$this->data['EnglishListing']['sale_from_date']));
echo $this->Form->input('sale_end_date',array('value'=>$this->data['EnglishListing']['sale_end_date']));
echo $this->Form->input('condition_type',array('value'=>$this->data['EnglishListing']['condition_type']));
echo $this->Form->input('condition_note',array('value'=>$this->data['EnglishListing']['condition_note']));
echo $this->Form->input('fulfillment_latency',array('value'=>$this->data['EnglishListing']['fulfillment_latency']));
echo $this->Form->input('restock_date',array('value'=>$this->data['EnglishListing']['restock_date']));
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
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['recommended_browse_nodes1']))){echo $this->Form->input('recommended_browse_nodes1',array('class'=>'warning'));}else{echo $this->Form->input('recommended_browse_nodes1');}
echo $this->Form->input('recommended_browse_nodes2');
echo $this->Form->input('catalog_number');
if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['bullet_point1']))){echo $this->Form->input('bullet_point1',array('value'=>$this->data['EnglishListing']['bullet_point1'],'id'=>'sessionbullet1','maxLength'=>'500','class'=>'warning'));}else{echo $this->Form->input('bullet_point1',array('value'=>$this->data['EnglishListing']['bullet_point1'],'id'=>'sessionbullet1','maxLength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet1_counter">500</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['bullet_point2']))){echo $this->Form->input('bullet_point2',array('value'=>$this->data['EnglishListing']['bullet_point2'],'id'=>'sessionbullet2','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point2',array('value'=>$this->data['EnglishListing']['bullet_point2'],'id'=>'sessionbullet2','maxlength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet2_counter">500</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['bullet_point3']))){echo $this->Form->input('bullet_point3',array('value'=>$this->data['EnglishListing']['bullet_point3'],'id'=>'sessionbullet3','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point3',array('value'=>$this->data['EnglishListing']['bullet_point3'],'id'=>'sessionbullet3','maxlength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet3_counter">500</span></div>
<?php  if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['bullet_point4']))){echo $this->Form->input('bullet_point4',array('value'=>$this->data['EnglishListing']['bullet_point4'],'id'=>'sessionbullet4','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point4',array('value'=>$this->data['EnglishListing']['bullet_point4'],'id'=>'sessionbullet4','maxlength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet4_counter">500</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['bullet_point5']))){echo $this->Form->input('bullet_point5',array('value'=>$this->data['EnglishListing']['bullet_point5'],'id'=>'sessionbullet5','maxLength'=>'500','class' =>'warning'));}else{echo $this->Form->input('bullet_point5',array('value'=>$this->data['EnglishListing']['bullet_point5'],'id'=>'sessionbullet5','maxlength'=>'500'));} ?><div class="text_errror">Number of chars: <span id="sessionbullet5_counter">500</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['generic_keywords1']))){echo $this->Form->input('generic_keywords1',array('value'=>$this->data['EnglishListing']['generic_keywords1'],'id'=>'sessiongen_key1','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords1',array('value'=>$this->data['EnglishListing']['generic_keywords1'],'id'=>'sessiongen_key1','maxlength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter1">50</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['generic_keywords2']))){echo $this->Form->input('generic_keywords2',array('value'=>$this->data['EnglishListing']['generic_keywords2'],'id'=>'sessiongen_key2','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords2',array('value'=>$this->data['EnglishListing']['generic_keywords2'],'id'=>'sessiongen_key2','maxlength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter2">50</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['generic_keywords3']))){echo $this->Form->input('generic_keywords3',array('value'=>$this->data['EnglishListing']['generic_keywords3'],'id'=>'sessiongen_key3','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords3',array('value'=>$this->data['EnglishListing']['generic_keywords3'],'id'=>'sessiongen_key3','maxlength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter3">50</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['generic_keywords4']))){echo $this->Form->input('generic_keywords4',array('value'=>$this->data['EnglishListing']['generic_keywords4'],'id'=>'sessiongen_key4','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords4',array('value'=>$this->data['EnglishListing']['generic_keywords4'],'id'=>'sessiongen_key4','maxlength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter4">50</span></div>
<?php if((($wordlist[1])!=='FBA') && (empty($this->data['EnglishListing']['generic_keywords5']))){echo $this->Form->input('generic_keywords5',array('value'=>$this->data['EnglishListing']['generic_keywords5'],'id'=>'sessiongen_key5','maxLength'=>'50','class' =>'warning'));}else{echo $this->Form->input('generic_keywords5',array('value'=>$this->data['EnglishListing']['generic_keywords5'],'id'=>'sessiongen_key5','maxlength'=>'50'));} ?><div class="text_errror">Number of chars: <span id="sessiongen_counter5">50</span></div>
<?php 
echo $this->Form->input('platinum_keywords1',array('value'=>$this->data['EnglishListing']['platinum_keywords1']));
echo $this->Form->input('platinum_keywords2',array('value'=>$this->data['EnglishListing']['platinum_keywords2']));
echo $this->Form->input('platinum_keywords3',array('value'=>$this->data['EnglishListing']['platinum_keywords3']));
echo $this->Form->input('platinum_keywords4',array('value'=>$this->data['EnglishListing']['platinum_keywords4']));
echo $this->Form->input('platinum_keywords5',array('value'=>$this->data['EnglishListing']['platinum_keywords5']));
/*echo $this->Form->input('target_audience_keywords1',array('value'=>$this->data['EnglishListing']['target_audience_keywords1']));
echo $this->Form->input('target_audience_keywords2',array('value'=>$this->data['EnglishListing']['target_audience_keywords2']));
echo $this->Form->input('target_audience_keywords3',array('value'=>$this->data['EnglishListing']['target_audience_keywords3']));
echo $this->Form->input('target_audience_keywords4',array('value'=>$this->data['EnglishListing']['target_audience_keywords4']));
echo $this->Form->input('target_audience_keywords5',array('value'=>$this->data['EnglishListing']['target_audience_keywords5']));*/
echo $this->Form->input('main_image_url',array('value'=>$this->data['EnglishListing']['main_image_url']));
echo $this->Form->input('swatch_image_url',array('value'=>$this->data['EnglishListing']['swatch_image_url']));
echo $this->Form->input('other_image_url2',array('value'=>$this->data['EnglishListing']['other_image_url2']));
echo $this->Form->input('other_image_url3',array('value'=>$this->data['EnglishListing']['other_image_url3']));
echo $this->Form->input('other_image_url4',array('value'=>$this->data['EnglishListing']['other_image_url4']));
echo $this->Form->input('other_image_url5',array('value'=>$this->data['EnglishListing']['other_image_url5']));
echo $this->Form->input('other_image_url6',array('value'=>$this->data['EnglishListing']['other_image_url6']));
echo $this->Form->input('other_image_url7',array('value'=>$this->data['EnglishListing']['other_image_url7']));
echo $this->Form->input('other_image_url8',array('value'=>$this->data['EnglishListing']['other_image_url8']));
echo $this->Form->input('parent_child',array('value'=>$this->data['EnglishListing']['parent_child']));
echo $this->Form->input('parent_sku',array('value'=>$this->data['EnglishListing']['parent_sku']));
echo $this->Form->input('relationship_type',array('value'=>$this->data['EnglishListing']['relationship_type']));
echo $this->Form->input('variation_theme',array('value'=>$this->data['EnglishListing']['variation_theme']));
echo $this->Form->input('color_name',array('value'=>$this->data['EnglishListing']['color_name']));
echo $this->Form->input('color_map',array('value'=>$this->data['EnglishListing']['color_map']));
echo $this->Form->input('size_name',array('value'=>$this->data['EnglishListing']['size_name']));
echo $this->Form->input('material_type1',array('value'=>$this->data['EnglishListing']['material_type1']));
echo $this->Form->input('material_type2',array('value'=>$this->data['EnglishListing']['material_type2']));
$error_by = '';
echo $this->Form->hidden('error',array('value'=>$error_by));
$modify_by = $session->read('Auth.User.username');
echo $this->Form->hidden('modify_by',array('value'=>$modify_by));
?>
    </div>
        </div> 
                              <div class="panel panel-default">
                                    <div class="panel-body">
                                      <?php echo $this->Form->button('Update', array('type' => 'submit','class' =>'btn btn-info'));  ?>  
                                    </div>
                               </div>   
                         </div>
                 </div>
         </div>
</div>
 <?php echo $this->Form->end(); ?>
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