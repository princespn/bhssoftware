<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GermanMasterListing[]|\Cake\Collection\CollectionInterface $germanMasterListings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New German Master Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="germanMasterListings index large-9 medium-8 columns content">
    <h3><?= __('German Master Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('external_product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('external_product_id_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feed_product_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('part_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_delete') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('standard_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_site_launch_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fulfillment_latency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('merchant_release_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('restock_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_from_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_aggregate_ship_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_order_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offering_can_be_gift_messaged') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offering_can_be_giftwrapped') ?></th>
                <th scope="col"><?= $this->Paginator->sort('missing_keyset_reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_discontinued_by_manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_package_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_tax_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delivery_schedule_group_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('merchant_shipping_group_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website_shipping_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website_shipping_weight_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_weight_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_length_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_width_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_height_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_depth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_depth_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_diameter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_display_diameter_unit_of_measure') ?></th>
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
                <th scope="col"><?= $this->Paginator->sort('fulfillment_center_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_length_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_weight_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relationship_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_child') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('variation_theme') ?></th>
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
                <th scope="col"><?= $this->Paginator->sort('legal_disclaimer_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fedas_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_string') ?></th>
                <th scope="col"><?= $this->Paginator->sort('energy_efficiency_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_efficiency_image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_pieces') ?></th>
                <th scope="col"><?= $this->Paginator->sort('scent_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_stain_resistant') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thread_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_sets') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wattage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_count_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thermal_performance_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('special_features') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seasons1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seasons2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seasons3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seasons4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outer_material_type1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outer_material_type2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outer_material_type3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outer_material_type4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outer_material_type5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occupancy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mfg_minimum') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_composition') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_type_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_thickness_derived') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_thickness_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_shape') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inner_material_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('capacity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('capacity_unit_of_measure') ?></th>
                <th scope="col"><?= $this->Paginator->sort('are_batteries_included') ?></th>
                <th scope="col"><?= $this->Paginator->sort('batteries_required') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_type1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_type2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('battery_type3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_batteries1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_batteries2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_batteries3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('efficiency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('theme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('style_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('specific_uses_for_product') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seating_capacity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pattern_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paper_size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paint_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('occasion_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_doors') ?></th>
                <th scope="col"><?= $this->Paginator->sort('line_weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_styling') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_hardness') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adjustment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('installation_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('included_components') ?></th>
                <th scope="col"><?= $this->Paginator->sort('frame_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_factor') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($germanMasterListings as $germanMasterListing): ?>
            <tr>
                <td><?= $this->Number->format($germanMasterListing->id) ?></td>
                <td><?= $germanMasterListing->has('user') ? $this->Html->link($germanMasterListing->user->id, ['controller' => 'Users', 'action' => 'view', $germanMasterListing->user->id]) : '' ?></td>
                <td><?= h($germanMasterListing->item_sku) ?></td>
                <td><?= h($germanMasterListing->item_name) ?></td>
                <td><?= h($germanMasterListing->external_product_id) ?></td>
                <td><?= h($germanMasterListing->external_product_id_type) ?></td>
                <td><?= h($germanMasterListing->feed_product_type) ?></td>
                <td><?= h($germanMasterListing->brand_name) ?></td>
                <td><?= h($germanMasterListing->manufacturer) ?></td>
                <td><?= h($germanMasterListing->part_number) ?></td>
                <td><?= h($germanMasterListing->update_delete) ?></td>
                <td><?= h($germanMasterListing->quantity) ?></td>
                <td><?= h($germanMasterListing->standard_price) ?></td>
                <td><?= h($germanMasterListing->currency) ?></td>
                <td><?= h($germanMasterListing->condition_type) ?></td>
                <td><?= h($germanMasterListing->condition_note) ?></td>
                <td><?= h($germanMasterListing->product_site_launch_date) ?></td>
                <td><?= h($germanMasterListing->fulfillment_latency) ?></td>
                <td><?= h($germanMasterListing->merchant_release_date) ?></td>
                <td><?= h($germanMasterListing->restock_date) ?></td>
                <td><?= h($germanMasterListing->sale_price) ?></td>
                <td><?= h($germanMasterListing->sale_from_date) ?></td>
                <td><?= h($germanMasterListing->sale_end_date) ?></td>
                <td><?= h($germanMasterListing->max_aggregate_ship_quantity) ?></td>
                <td><?= h($germanMasterListing->max_order_quantity) ?></td>
                <td><?= h($germanMasterListing->offering_can_be_gift_messaged) ?></td>
                <td><?= h($germanMasterListing->offering_can_be_giftwrapped) ?></td>
                <td><?= h($germanMasterListing->missing_keyset_reason) ?></td>
                <td><?= h($germanMasterListing->is_discontinued_by_manufacturer) ?></td>
                <td><?= h($germanMasterListing->item_package_quantity) ?></td>
                <td><?= h($germanMasterListing->product_tax_code) ?></td>
                <td><?= h($germanMasterListing->delivery_schedule_group_id) ?></td>
                <td><?= h($germanMasterListing->merchant_shipping_group_name) ?></td>
                <td><?= h($germanMasterListing->website_shipping_weight) ?></td>
                <td><?= h($germanMasterListing->website_shipping_weight_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_weight) ?></td>
                <td><?= h($germanMasterListing->item_weight_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_length) ?></td>
                <td><?= h($germanMasterListing->item_length_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_width) ?></td>
                <td><?= h($germanMasterListing->item_width_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_height) ?></td>
                <td><?= h($germanMasterListing->item_height_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_display_depth) ?></td>
                <td><?= h($germanMasterListing->item_display_depth_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_display_diameter) ?></td>
                <td><?= h($germanMasterListing->item_display_diameter_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->recommended_browse_nodes1) ?></td>
                <td><?= h($germanMasterListing->recommended_browse_nodes2) ?></td>
                <td><?= h($germanMasterListing->catalog_number) ?></td>
                <td><?= h($germanMasterListing->main_image_url) ?></td>
                <td><?= h($germanMasterListing->swatch_image_url) ?></td>
                <td><?= h($germanMasterListing->other_image_url1) ?></td>
                <td><?= h($germanMasterListing->other_image_url2) ?></td>
                <td><?= h($germanMasterListing->other_image_url3) ?></td>
                <td><?= h($germanMasterListing->other_image_url4) ?></td>
                <td><?= h($germanMasterListing->other_image_url5) ?></td>
                <td><?= h($germanMasterListing->other_image_url6) ?></td>
                <td><?= h($germanMasterListing->other_image_url7) ?></td>
                <td><?= h($germanMasterListing->other_image_url8) ?></td>
                <td><?= h($germanMasterListing->fulfillment_center_id) ?></td>
                <td><?= h($germanMasterListing->package_length) ?></td>
                <td><?= h($germanMasterListing->package_width) ?></td>
                <td><?= h($germanMasterListing->package_height) ?></td>
                <td><?= h($germanMasterListing->package_length_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->package_weight) ?></td>
                <td><?= h($germanMasterListing->package_weight_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->relationship_type) ?></td>
                <td><?= h($germanMasterListing->parent_child) ?></td>
                <td><?= h($germanMasterListing->parent_sku) ?></td>
                <td><?= h($germanMasterListing->variation_theme) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning1) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning2) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning3) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning4) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning5) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning6) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning7) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_warning8) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language1) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language2) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language3) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language4) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language5) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language6) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language7) ?></td>
                <td><?= h($germanMasterListing->eu_toys_safety_directive_language8) ?></td>
                <td><?= h($germanMasterListing->legal_disclaimer_description) ?></td>
                <td><?= h($germanMasterListing->fedas_id) ?></td>
                <td><?= h($germanMasterListing->country_string) ?></td>
                <td><?= h($germanMasterListing->energy_efficiency_image_url) ?></td>
                <td><?= h($germanMasterListing->product_efficiency_image_url) ?></td>
                <td><?= h($germanMasterListing->number_of_pieces) ?></td>
                <td><?= h($germanMasterListing->scent_name) ?></td>
                <td><?= h($germanMasterListing->is_stain_resistant) ?></td>
                <td><?= h($germanMasterListing->color_name) ?></td>
                <td><?= h($germanMasterListing->size_name) ?></td>
                <td><?= h($germanMasterListing->thread_count) ?></td>
                <td><?= h($germanMasterListing->material_type) ?></td>
                <td><?= h($germanMasterListing->number_of_sets) ?></td>
                <td><?= h($germanMasterListing->wattage) ?></td>
                <td><?= h($germanMasterListing->unit_count) ?></td>
                <td><?= h($germanMasterListing->unit_count_type) ?></td>
                <td><?= h($germanMasterListing->thermal_performance_description) ?></td>
                <td><?= h($germanMasterListing->special_features) ?></td>
                <td><?= h($germanMasterListing->seasons1) ?></td>
                <td><?= h($germanMasterListing->seasons2) ?></td>
                <td><?= h($germanMasterListing->seasons3) ?></td>
                <td><?= h($germanMasterListing->seasons4) ?></td>
                <td><?= h($germanMasterListing->outer_material_type1) ?></td>
                <td><?= h($germanMasterListing->outer_material_type2) ?></td>
                <td><?= h($germanMasterListing->outer_material_type3) ?></td>
                <td><?= h($germanMasterListing->outer_material_type4) ?></td>
                <td><?= h($germanMasterListing->outer_material_type5) ?></td>
                <td><?= h($germanMasterListing->occupancy) ?></td>
                <td><?= h($germanMasterListing->mfg_minimum) ?></td>
                <td><?= h($germanMasterListing->material_composition) ?></td>
                <td><?= h($germanMasterListing->item_type_name) ?></td>
                <td><?= h($germanMasterListing->item_thickness_derived) ?></td>
                <td><?= h($germanMasterListing->item_thickness_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->item_shape) ?></td>
                <td><?= h($germanMasterListing->inner_material_type) ?></td>
                <td><?= h($germanMasterListing->capacity) ?></td>
                <td><?= h($germanMasterListing->capacity_unit_of_measure) ?></td>
                <td><?= h($germanMasterListing->are_batteries_included) ?></td>
                <td><?= h($germanMasterListing->batteries_required) ?></td>
                <td><?= h($germanMasterListing->battery_type1) ?></td>
                <td><?= h($germanMasterListing->battery_type2) ?></td>
                <td><?= h($germanMasterListing->battery_type3) ?></td>
                <td><?= h($germanMasterListing->number_of_batteries1) ?></td>
                <td><?= h($germanMasterListing->number_of_batteries2) ?></td>
                <td><?= h($germanMasterListing->number_of_batteries3) ?></td>
                <td><?= h($germanMasterListing->efficiency) ?></td>
                <td><?= h($germanMasterListing->theme) ?></td>
                <td><?= h($germanMasterListing->style_name) ?></td>
                <td><?= h($germanMasterListing->specific_uses_for_product) ?></td>
                <td><?= h($germanMasterListing->seating_capacity) ?></td>
                <td><?= h($germanMasterListing->pattern_name) ?></td>
                <td><?= h($germanMasterListing->paper_size) ?></td>
                <td><?= h($germanMasterListing->paint_type) ?></td>
                <td><?= h($germanMasterListing->occasion_type) ?></td>
                <td><?= h($germanMasterListing->number_of_doors) ?></td>
                <td><?= h($germanMasterListing->line_weight) ?></td>
                <td><?= h($germanMasterListing->item_styling) ?></td>
                <td><?= h($germanMasterListing->item_hardness) ?></td>
                <td><?= h($germanMasterListing->adjustment_type) ?></td>
                <td><?= h($germanMasterListing->installation_type) ?></td>
                <td><?= h($germanMasterListing->included_components) ?></td>
                <td><?= h($germanMasterListing->frame_type) ?></td>
                <td><?= h($germanMasterListing->form_factor) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $germanMasterListing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $germanMasterListing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $germanMasterListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $germanMasterListing->id)]) ?>
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
