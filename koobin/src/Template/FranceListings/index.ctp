<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New France Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="franceListings index large-9 medium-8 columns content">
    <h3><?= __('France Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('external_product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('external_product_id_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feed_product_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('part_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_delete') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_site_launch_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('standard_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_package_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_tax_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('merchant_release_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_from_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fulfillment_latency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('restock_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_aggregate_ship_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offering_can_be_gift_messaged') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offering_can_be_giftwrapped') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_discontinued_by_manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('missing_keyset_reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weee_tax_value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weee_tax_value_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('merchant_shipping_group_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website_shipping_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website_shipping_weight_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_length_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_width_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_height_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_depth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_depth_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_diameter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_diameter_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_weight_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volume_capacity_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volume_capacity_name_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_volume') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_volume_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recommended_browse_nodes1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('recommended_browse_nodes2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('catalog_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('main_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('swatch_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other_image_url8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_length_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fulfillment_center_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_child') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relationship_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('variation_theme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_age_warning') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_language8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_string') ?></th>
                <th scope="col"><?= $this->Paginator->sort('safety_warning') ?></th>
                <th scope="col"><?= $this->Paginator->sort('energy_efficiency_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_efficiency_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_stain_resistant') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_map') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('warranty_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_sets') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wattage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seating_capacity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pattern_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paper_size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paint_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_doors') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_composition') ?></th>
                <th scope="col"><?= $this->Paginator->sort('line_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_type_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_styling') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_shape') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_hardness') ?></th>
                <th scope="col"><?= $this->Paginator->sort('installation_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components9') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components10') ?></th>
                <th scope="col"><?= $this->Paginator->sort('frame_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_factor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_type1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_type2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_type3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_type4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_type5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adjustment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('are_batteries_included') ?></th>
                <th scope="col"><?= $this->Paginator->sort('batteries_required') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_batteries') ?></th>
                <th scope="col"><?= $this->Paginator->sort('efficiency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thermal_performance_description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($franceListings as $franceListing): ?>
            <tr>
                <td><?= $this->Number->format($franceListing->id) ?></td>
                <td><?= $franceListing->has('user') ? $this->Html->link($franceListing->user->id, ['controller' => 'Users', 'action' => 'view', $franceListing->user->id]) : '' ?></td>
                <td><?= h($franceListing->item_sku) ?></td>
                <td><?= h($franceListing->external_product_id) ?></td>
                <td><?= h($franceListing->external_product_id_type) ?></td>
                <td><?= h($franceListing->item_name) ?></td>
                <td><?= h($franceListing->brand_name) ?></td>
                <td><?= h($franceListing->manufacturer) ?></td>
                <td><?= h($franceListing->feed_product_type) ?></td>
                <td><?= h($franceListing->part_number) ?></td>
                <td><?= h($franceListing->update_delete) ?></td>
                <td><?= h($franceListing->product_site_launch_date) ?></td>
                <td><?= h($franceListing->standard_price) ?></td>
                <td><?= h($franceListing->currency) ?></td>
                <td><?= h($franceListing->quantity) ?></td>
                <td><?= h($franceListing->item_package_quantity) ?></td>
                <td><?= h($franceListing->product_tax_code) ?></td>
                <td><?= h($franceListing->merchant_release_date) ?></td>
                <td><?= h($franceListing->sale_price) ?></td>
                <td><?= h($franceListing->sale_from_date) ?></td>
                <td><?= h($franceListing->sale_end_date) ?></td>
                <td><?= h($franceListing->condition_type) ?></td>
                <td><?= h($franceListing->condition_note) ?></td>
                <td><?= h($franceListing->fulfillment_latency) ?></td>
                <td><?= h($franceListing->restock_date) ?></td>
                <td><?= h($franceListing->max_aggregate_ship_quantity) ?></td>
                <td><?= h($franceListing->offering_can_be_gift_messaged) ?></td>
                <td><?= h($franceListing->offering_can_be_giftwrapped) ?></td>
                <td><?= h($franceListing->is_discontinued_by_manufacturer) ?></td>
                <td><?= h($franceListing->missing_keyset_reason) ?></td>
                <td><?= h($franceListing->weee_tax_value) ?></td>
                <td><?= h($franceListing->weee_tax_value_unit_of_measure) ?></td>
                <td><?= h($franceListing->merchant_shipping_group_name) ?></td>
                <td><?= h($franceListing->website_shipping_weight) ?></td>
                <td><?= h($franceListing->website_shipping_weight_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_length) ?></td>
                <td><?= h($franceListing->item_display_length_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_width) ?></td>
                <td><?= h($franceListing->item_display_width_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_height) ?></td>
                <td><?= h($franceListing->item_display_height_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_depth) ?></td>
                <td><?= h($franceListing->item_display_depth_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_diameter) ?></td>
                <td><?= h($franceListing->item_display_diameter_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_weight) ?></td>
                <td><?= h($franceListing->item_display_weight_unit_of_measure) ?></td>
                <td><?= h($franceListing->volume_capacity_name) ?></td>
                <td><?= h($franceListing->volume_capacity_name_unit_of_measure) ?></td>
                <td><?= h($franceListing->item_display_volume) ?></td>
                <td><?= h($franceListing->item_display_volume_unit_of_measure) ?></td>
                <td><?= h($franceListing->recommended_browse_nodes1) ?></td>
                <td><?= h($franceListing->recommended_browse_nodes2) ?></td>
                <td><?= h($franceListing->catalog_number) ?></td>
                <td><?= h($franceListing->main_image_url) ?></td>
                <td><?= h($franceListing->swatch_image_url) ?></td>
                <td><?= h($franceListing->other_image_url1) ?></td>
                <td><?= h($franceListing->other_image_url2) ?></td>
                <td><?= h($franceListing->other_image_url3) ?></td>
                <td><?= h($franceListing->other_image_url4) ?></td>
                <td><?= h($franceListing->other_image_url5) ?></td>
                <td><?= h($franceListing->other_image_url6) ?></td>
                <td><?= h($franceListing->other_image_url7) ?></td>
                <td><?= h($franceListing->other_image_url8) ?></td>
                <td><?= h($franceListing->package_length) ?></td>
                <td><?= h($franceListing->package_width) ?></td>
                <td><?= h($franceListing->package_height) ?></td>
                <td><?= h($franceListing->package_length_unit_of_measure) ?></td>
                <td><?= h($franceListing->fulfillment_center_id) ?></td>
                <td><?= h($franceListing->parent_child) ?></td>
                <td><?= h($franceListing->parent_sku) ?></td>
                <td><?= h($franceListing->relationship_type) ?></td>
                <td><?= h($franceListing->variation_theme) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_age_warning) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning1) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning2) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning3) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning4) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning5) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning6) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning7) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_warning8) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language1) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language2) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language3) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language4) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language5) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language6) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language7) ?></td>
                <td><?= h($franceListing->eu_toys_safety_directive_language8) ?></td>
                <td><?= h($franceListing->country_string) ?></td>
                <td><?= h($franceListing->safety_warning) ?></td>
                <td><?= h($franceListing->energy_efficiency_image_url) ?></td>
                <td><?= h($franceListing->product_efficiency_image_url) ?></td>
                <td><?= h($franceListing->is_stain_resistant) ?></td>
                <td><?= h($franceListing->color_name) ?></td>
                <td><?= h($franceListing->color_map) ?></td>
                <td><?= h($franceListing->size_name) ?></td>
                <td><?= h($franceListing->warranty_description) ?></td>
                <td><?= h($franceListing->number_of_sets) ?></td>
                <td><?= h($franceListing->wattage) ?></td>
                <td><?= h($franceListing->material_type1) ?></td>
                <td><?= h($franceListing->material_type2) ?></td>
                <td><?= h($franceListing->material_type3) ?></td>
                <td><?= h($franceListing->material_type4) ?></td>
                <td><?= h($franceListing->material_type5) ?></td>
                <td><?= h($franceListing->material_type6) ?></td>
                <td><?= h($franceListing->material_type7) ?></td>
                <td><?= h($franceListing->material_type8) ?></td>
                <td><?= h($franceListing->special_features1) ?></td>
                <td><?= h($franceListing->special_features2) ?></td>
                <td><?= h($franceListing->special_features3) ?></td>
                <td><?= h($franceListing->special_features4) ?></td>
                <td><?= h($franceListing->special_features5) ?></td>
                <td><?= h($franceListing->seating_capacity) ?></td>
                <td><?= h($franceListing->pattern_name) ?></td>
                <td><?= h($franceListing->paper_size) ?></td>
                <td><?= h($franceListing->paint_type) ?></td>
                <td><?= h($franceListing->occasion_type1) ?></td>
                <td><?= h($franceListing->occasion_type2) ?></td>
                <td><?= h($franceListing->occasion_type3) ?></td>
                <td><?= h($franceListing->occasion_type4) ?></td>
                <td><?= h($franceListing->occasion_type5) ?></td>
                <td><?= h($franceListing->number_of_doors) ?></td>
                <td><?= h($franceListing->material_composition) ?></td>
                <td><?= h($franceListing->line_weight) ?></td>
                <td><?= h($franceListing->item_type_name) ?></td>
                <td><?= h($franceListing->item_styling) ?></td>
                <td><?= h($franceListing->item_shape) ?></td>
                <td><?= h($franceListing->item_hardness) ?></td>
                <td><?= h($franceListing->installation_type) ?></td>
                <td><?= h($franceListing->included_components1) ?></td>
                <td><?= h($franceListing->included_components2) ?></td>
                <td><?= h($franceListing->included_components3) ?></td>
                <td><?= h($franceListing->included_components4) ?></td>
                <td><?= h($franceListing->included_components5) ?></td>
                <td><?= h($franceListing->included_components6) ?></td>
                <td><?= h($franceListing->included_components7) ?></td>
                <td><?= h($franceListing->included_components8) ?></td>
                <td><?= h($franceListing->included_components9) ?></td>
                <td><?= h($franceListing->included_components10) ?></td>
                <td><?= h($franceListing->frame_type) ?></td>
                <td><?= h($franceListing->form_factor) ?></td>
                <td><?= h($franceListing->finish_type1) ?></td>
                <td><?= h($franceListing->finish_type2) ?></td>
                <td><?= h($franceListing->finish_type3) ?></td>
                <td><?= h($franceListing->finish_type4) ?></td>
                <td><?= h($franceListing->finish_type5) ?></td>
                <td><?= h($franceListing->adjustment_type) ?></td>
                <td><?= h($franceListing->are_batteries_included) ?></td>
                <td><?= h($franceListing->batteries_required) ?></td>
                <td><?= h($franceListing->battery_type) ?></td>
                <td><?= h($franceListing->number_of_batteries) ?></td>
                <td><?= h($franceListing->efficiency) ?></td>
                <td><?= h($franceListing->thermal_performance_description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $franceListing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $franceListing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $franceListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $franceListing->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
