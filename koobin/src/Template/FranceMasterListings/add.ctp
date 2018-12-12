<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FranceMasterListing $franceMasterListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List France Master Listings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="franceMasterListings form large-9 medium-8 columns content">
    <?= $this->Form->create($franceMasterListing) ?>
    <fieldset>
        <legend><?= __('Add France Master Listing') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('item_sku');
            echo $this->Form->control('external_product_id');
            echo $this->Form->control('external_product_id_type');
            echo $this->Form->control('item_name');
            echo $this->Form->control('brand_name');
            echo $this->Form->control('manufacturer');
            echo $this->Form->control('feed_product_type');
            echo $this->Form->control('part_number');
            echo $this->Form->control('product_description');
            echo $this->Form->control('update_delete');
            echo $this->Form->control('product_site_launch_date');
            echo $this->Form->control('standard_price');
            echo $this->Form->control('currency');
            echo $this->Form->control('quantity');
            echo $this->Form->control('item_package_quantity');
            echo $this->Form->control('product_tax_code');
            echo $this->Form->control('merchant_release_date');
            echo $this->Form->control('sale_price');
            echo $this->Form->control('sale_from_date');
            echo $this->Form->control('sale_end_date');
            echo $this->Form->control('condition_type');
            echo $this->Form->control('condition_note');
            echo $this->Form->control('fulfillment_latency');
            echo $this->Form->control('restock_date');
            echo $this->Form->control('max_aggregate_ship_quantity');
            echo $this->Form->control('offering_can_be_gift_messaged');
            echo $this->Form->control('offering_can_be_giftwrapped');
            echo $this->Form->control('is_discontinued_by_manufacturer');
            echo $this->Form->control('missing_keyset_reason');
            echo $this->Form->control('weee_tax_value');
            echo $this->Form->control('weee_tax_value_unit_of_measure');
            echo $this->Form->control('merchant_shipping_group_name');
            echo $this->Form->control('website_shipping_weight');
            echo $this->Form->control('website_shipping_weight_unit_of_measure');
            echo $this->Form->control('item_display_length');
            echo $this->Form->control('item_display_length_unit_of_measure');
            echo $this->Form->control('item_display_width');
            echo $this->Form->control('item_display_width_unit_of_measure');
            echo $this->Form->control('item_display_height');
            echo $this->Form->control('item_display_height_unit_of_measure');
            echo $this->Form->control('item_display_depth');
            echo $this->Form->control('item_display_depth_unit_of_measure');
            echo $this->Form->control('item_display_diameter');
            echo $this->Form->control('item_display_diameter_unit_of_measure');
            echo $this->Form->control('item_display_weight');
            echo $this->Form->control('item_display_weight_unit_of_measure');
            echo $this->Form->control('volume_capacity_name');
            echo $this->Form->control('volume_capacity_name_unit_of_measure');
            echo $this->Form->control('item_display_volume');
            echo $this->Form->control('item_display_volume_unit_of_measure');
            echo $this->Form->control('recommended_browse_nodes1');
            echo $this->Form->control('recommended_browse_nodes2');
            echo $this->Form->control('catalog_number');
            echo $this->Form->control('bullet_point1');
            echo $this->Form->control('bullet_point2');
            echo $this->Form->control('bullet_point3');
            echo $this->Form->control('bullet_point4');
            echo $this->Form->control('bullet_point5');
            echo $this->Form->control('generic_keywords1');
            echo $this->Form->control('generic_keywords2');
            echo $this->Form->control('generic_keywords3');
            echo $this->Form->control('generic_keywords4');
            echo $this->Form->control('generic_keywords5');
            echo $this->Form->control('platinum_keywords1');
            echo $this->Form->control('platinum_keywords2');
            echo $this->Form->control('platinum_keywords3');
            echo $this->Form->control('platinum_keywords4');
            echo $this->Form->control('platinum_keywords5');
            echo $this->Form->control('target_audience_keywords1');
            echo $this->Form->control('target_audience_keywords2');
            echo $this->Form->control('target_audience_keywords3');
            echo $this->Form->control('target_audience_keywords4');
            echo $this->Form->control('target_audience_keywords5');
            echo $this->Form->control('main_image_url');
            echo $this->Form->control('swatch_image_url');
            echo $this->Form->control('other_image_url1');
            echo $this->Form->control('other_image_url2');
            echo $this->Form->control('other_image_url3');
            echo $this->Form->control('other_image_url4');
            echo $this->Form->control('other_image_url5');
            echo $this->Form->control('other_image_url6');
            echo $this->Form->control('other_image_url7');
            echo $this->Form->control('other_image_url8');
            echo $this->Form->control('package_length');
            echo $this->Form->control('package_width');
            echo $this->Form->control('package_height');
            echo $this->Form->control('package_length_unit_of_measure');
            echo $this->Form->control('fulfillment_center_id');
            echo $this->Form->control('parent_child');
            echo $this->Form->control('parent_sku');
            echo $this->Form->control('relationship_type');
            echo $this->Form->control('variation_theme');
            echo $this->Form->control('eu_toys_safety_directive_age_warning');
            echo $this->Form->control('eu_toys_safety_directive_warning1');
            echo $this->Form->control('eu_toys_safety_directive_warning2');
            echo $this->Form->control('eu_toys_safety_directive_warning3');
            echo $this->Form->control('eu_toys_safety_directive_warning4');
            echo $this->Form->control('eu_toys_safety_directive_warning5');
            echo $this->Form->control('eu_toys_safety_directive_warning6');
            echo $this->Form->control('eu_toys_safety_directive_warning7');
            echo $this->Form->control('eu_toys_safety_directive_warning8');
            echo $this->Form->control('eu_toys_safety_directive_language1');
            echo $this->Form->control('eu_toys_safety_directive_language2');
            echo $this->Form->control('eu_toys_safety_directive_language3');
            echo $this->Form->control('eu_toys_safety_directive_language4');
            echo $this->Form->control('eu_toys_safety_directive_language5');
            echo $this->Form->control('eu_toys_safety_directive_language6');
            echo $this->Form->control('eu_toys_safety_directive_language7');
            echo $this->Form->control('eu_toys_safety_directive_language8');
            echo $this->Form->control('country_string');
            echo $this->Form->control('safety_warning');
            echo $this->Form->control('energy_efficiency_image_url');
            echo $this->Form->control('product_efficiency_image_url');
            echo $this->Form->control('is_stain_resistant');
            echo $this->Form->control('color_name');
            echo $this->Form->control('color_map');
            echo $this->Form->control('size_name');
            echo $this->Form->control('warranty_description');
            echo $this->Form->control('number_of_sets');
            echo $this->Form->control('wattage');
            echo $this->Form->control('material_type1');
            echo $this->Form->control('material_type2');
            echo $this->Form->control('material_type3');
            echo $this->Form->control('material_type4');
            echo $this->Form->control('material_type5');
            echo $this->Form->control('material_type6');
            echo $this->Form->control('material_type7');
            echo $this->Form->control('material_type8');
            echo $this->Form->control('special_features1');
            echo $this->Form->control('special_features2');
            echo $this->Form->control('special_features3');
            echo $this->Form->control('special_features4');
            echo $this->Form->control('special_features5');
            echo $this->Form->control('seating_capacity');
            echo $this->Form->control('pattern_name');
            echo $this->Form->control('paper_size');
            echo $this->Form->control('paint_type');
            echo $this->Form->control('occasion_type1');
            echo $this->Form->control('occasion_type2');
            echo $this->Form->control('occasion_type3');
            echo $this->Form->control('occasion_type4');
            echo $this->Form->control('occasion_type5');
            echo $this->Form->control('number_of_doors');
            echo $this->Form->control('material_composition');
            echo $this->Form->control('line_weight');
            echo $this->Form->control('item_type_name');
            echo $this->Form->control('item_styling');
            echo $this->Form->control('item_shape');
            echo $this->Form->control('item_hardness');
            echo $this->Form->control('installation_type');
            echo $this->Form->control('included_components1');
            echo $this->Form->control('included_components2');
            echo $this->Form->control('included_components3');
            echo $this->Form->control('included_components4');
            echo $this->Form->control('included_components5');
            echo $this->Form->control('included_components6');
            echo $this->Form->control('included_components7');
            echo $this->Form->control('included_components8');
            echo $this->Form->control('included_components9');
            echo $this->Form->control('included_components10');
            echo $this->Form->control('frame_type');
            echo $this->Form->control('form_factor');
            echo $this->Form->control('finish_type1');
            echo $this->Form->control('finish_type2');
            echo $this->Form->control('finish_type3');
            echo $this->Form->control('finish_type4');
            echo $this->Form->control('finish_type5');
            echo $this->Form->control('adjustment_type');
            echo $this->Form->control('are_batteries_included');
            echo $this->Form->control('batteries_required');
            echo $this->Form->control('battery_type');
            echo $this->Form->control('number_of_batteries');
            echo $this->Form->control('efficiency');
            echo $this->Form->control('thermal_performance_description');
            echo $this->Form->control('error');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
