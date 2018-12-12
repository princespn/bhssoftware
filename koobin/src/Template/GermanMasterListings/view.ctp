<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GermanMasterListing $germanMasterListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit German Master Listing'), ['action' => 'edit', $germanMasterListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete German Master Listing'), ['action' => 'delete', $germanMasterListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $germanMasterListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List German Master Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New German Master Listing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="germanMasterListings view large-9 medium-8 columns content">
    <h3><?= h($germanMasterListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $germanMasterListing->has('user') ? $this->Html->link($germanMasterListing->user->id, ['controller' => 'Users', 'action' => 'view', $germanMasterListing->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Sku') ?></th>
            <td><?= h($germanMasterListing->item_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($germanMasterListing->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id') ?></th>
            <td><?= h($germanMasterListing->external_product_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id Type') ?></th>
            <td><?= h($germanMasterListing->external_product_id_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Product Type') ?></th>
            <td><?= h($germanMasterListing->feed_product_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand Name') ?></th>
            <td><?= h($germanMasterListing->brand_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manufacturer') ?></th>
            <td><?= h($germanMasterListing->manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Part Number') ?></th>
            <td><?= h($germanMasterListing->part_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Delete') ?></th>
            <td><?= h($germanMasterListing->update_delete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= h($germanMasterListing->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard Price') ?></th>
            <td><?= h($germanMasterListing->standard_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($germanMasterListing->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Type') ?></th>
            <td><?= h($germanMasterListing->condition_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Note') ?></th>
            <td><?= h($germanMasterListing->condition_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Site Launch Date') ?></th>
            <td><?= h($germanMasterListing->product_site_launch_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Latency') ?></th>
            <td><?= h($germanMasterListing->fulfillment_latency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Release Date') ?></th>
            <td><?= h($germanMasterListing->merchant_release_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Restock Date') ?></th>
            <td><?= h($germanMasterListing->restock_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price') ?></th>
            <td><?= h($germanMasterListing->sale_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale From Date') ?></th>
            <td><?= h($germanMasterListing->sale_from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale End Date') ?></th>
            <td><?= h($germanMasterListing->sale_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Aggregate Ship Quantity') ?></th>
            <td><?= h($germanMasterListing->max_aggregate_ship_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Order Quantity') ?></th>
            <td><?= h($germanMasterListing->max_order_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Gift Messaged') ?></th>
            <td><?= h($germanMasterListing->offering_can_be_gift_messaged) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Giftwrapped') ?></th>
            <td><?= h($germanMasterListing->offering_can_be_giftwrapped) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Missing Keyset Reason') ?></th>
            <td><?= h($germanMasterListing->missing_keyset_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Discontinued By Manufacturer') ?></th>
            <td><?= h($germanMasterListing->is_discontinued_by_manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Package Quantity') ?></th>
            <td><?= h($germanMasterListing->item_package_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Tax Code') ?></th>
            <td><?= h($germanMasterListing->product_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delivery Schedule Group Id') ?></th>
            <td><?= h($germanMasterListing->delivery_schedule_group_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Shipping Group Name') ?></th>
            <td><?= h($germanMasterListing->merchant_shipping_group_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight') ?></th>
            <td><?= h($germanMasterListing->website_shipping_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->website_shipping_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Weight') ?></th>
            <td><?= h($germanMasterListing->item_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Weight Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Length') ?></th>
            <td><?= h($germanMasterListing->item_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Length Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Width') ?></th>
            <td><?= h($germanMasterListing->item_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Width Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_width_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Height') ?></th>
            <td><?= h($germanMasterListing->item_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Height Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_height_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth') ?></th>
            <td><?= h($germanMasterListing->item_display_depth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_display_depth_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter') ?></th>
            <td><?= h($germanMasterListing->item_display_diameter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_display_diameter_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes1') ?></th>
            <td><?= h($germanMasterListing->recommended_browse_nodes1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes2') ?></th>
            <td><?= h($germanMasterListing->recommended_browse_nodes2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalog Number') ?></th>
            <td><?= h($germanMasterListing->catalog_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Main Image Url') ?></th>
            <td><?= h($germanMasterListing->main_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swatch Image Url') ?></th>
            <td><?= h($germanMasterListing->swatch_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url1') ?></th>
            <td><?= h($germanMasterListing->other_image_url1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url2') ?></th>
            <td><?= h($germanMasterListing->other_image_url2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url3') ?></th>
            <td><?= h($germanMasterListing->other_image_url3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url4') ?></th>
            <td><?= h($germanMasterListing->other_image_url4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url5') ?></th>
            <td><?= h($germanMasterListing->other_image_url5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url6') ?></th>
            <td><?= h($germanMasterListing->other_image_url6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url7') ?></th>
            <td><?= h($germanMasterListing->other_image_url7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url8') ?></th>
            <td><?= h($germanMasterListing->other_image_url8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Center Id') ?></th>
            <td><?= h($germanMasterListing->fulfillment_center_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length') ?></th>
            <td><?= h($germanMasterListing->package_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Width') ?></th>
            <td><?= h($germanMasterListing->package_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Height') ?></th>
            <td><?= h($germanMasterListing->package_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->package_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Weight') ?></th>
            <td><?= h($germanMasterListing->package_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Weight Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->package_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relationship Type') ?></th>
            <td><?= h($germanMasterListing->relationship_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Child') ?></th>
            <td><?= h($germanMasterListing->parent_child) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Sku') ?></th>
            <td><?= h($germanMasterListing->parent_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variation Theme') ?></th>
            <td><?= h($germanMasterListing->variation_theme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning1') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning2') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning3') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning4') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning5') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning6') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning7') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning8') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_warning8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language1') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language2') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language3') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language4') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language5') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language6') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language7') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language8') ?></th>
            <td><?= h($germanMasterListing->eu_toys_safety_directive_language8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Legal Disclaimer Description') ?></th>
            <td><?= h($germanMasterListing->legal_disclaimer_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fedas Id') ?></th>
            <td><?= h($germanMasterListing->fedas_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country String') ?></th>
            <td><?= h($germanMasterListing->country_string) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Energy Efficiency Image Url') ?></th>
            <td><?= h($germanMasterListing->energy_efficiency_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Efficiency Image Url') ?></th>
            <td><?= h($germanMasterListing->product_efficiency_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Pieces') ?></th>
            <td><?= h($germanMasterListing->number_of_pieces) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scent Name') ?></th>
            <td><?= h($germanMasterListing->scent_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Stain Resistant') ?></th>
            <td><?= h($germanMasterListing->is_stain_resistant) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Name') ?></th>
            <td><?= h($germanMasterListing->color_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Name') ?></th>
            <td><?= h($germanMasterListing->size_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thread Count') ?></th>
            <td><?= h($germanMasterListing->thread_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type') ?></th>
            <td><?= h($germanMasterListing->material_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Sets') ?></th>
            <td><?= h($germanMasterListing->number_of_sets) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Wattage') ?></th>
            <td><?= h($germanMasterListing->wattage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Count') ?></th>
            <td><?= h($germanMasterListing->unit_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Count Type') ?></th>
            <td><?= h($germanMasterListing->unit_count_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thermal Performance Description') ?></th>
            <td><?= h($germanMasterListing->thermal_performance_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features') ?></th>
            <td><?= h($germanMasterListing->special_features) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seasons1') ?></th>
            <td><?= h($germanMasterListing->seasons1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seasons2') ?></th>
            <td><?= h($germanMasterListing->seasons2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seasons3') ?></th>
            <td><?= h($germanMasterListing->seasons3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seasons4') ?></th>
            <td><?= h($germanMasterListing->seasons4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outer Material Type1') ?></th>
            <td><?= h($germanMasterListing->outer_material_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outer Material Type2') ?></th>
            <td><?= h($germanMasterListing->outer_material_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outer Material Type3') ?></th>
            <td><?= h($germanMasterListing->outer_material_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outer Material Type4') ?></th>
            <td><?= h($germanMasterListing->outer_material_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outer Material Type5') ?></th>
            <td><?= h($germanMasterListing->outer_material_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occupancy') ?></th>
            <td><?= h($germanMasterListing->occupancy) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mfg Minimum') ?></th>
            <td><?= h($germanMasterListing->mfg_minimum) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Composition') ?></th>
            <td><?= h($germanMasterListing->material_composition) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Type Name') ?></th>
            <td><?= h($germanMasterListing->item_type_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Thickness Derived') ?></th>
            <td><?= h($germanMasterListing->item_thickness_derived) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Thickness Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->item_thickness_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Shape') ?></th>
            <td><?= h($germanMasterListing->item_shape) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inner Material Type') ?></th>
            <td><?= h($germanMasterListing->inner_material_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Capacity') ?></th>
            <td><?= h($germanMasterListing->capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Capacity Unit Of Measure') ?></th>
            <td><?= h($germanMasterListing->capacity_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Are Batteries Included') ?></th>
            <td><?= h($germanMasterListing->are_batteries_included) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Batteries Required') ?></th>
            <td><?= h($germanMasterListing->batteries_required) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Battery Type1') ?></th>
            <td><?= h($germanMasterListing->battery_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Battery Type2') ?></th>
            <td><?= h($germanMasterListing->battery_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Battery Type3') ?></th>
            <td><?= h($germanMasterListing->battery_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Batteries1') ?></th>
            <td><?= h($germanMasterListing->number_of_batteries1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Batteries2') ?></th>
            <td><?= h($germanMasterListing->number_of_batteries2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Batteries3') ?></th>
            <td><?= h($germanMasterListing->number_of_batteries3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Efficiency') ?></th>
            <td><?= h($germanMasterListing->efficiency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Theme') ?></th>
            <td><?= h($germanMasterListing->theme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Style Name') ?></th>
            <td><?= h($germanMasterListing->style_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specific Uses For Product') ?></th>
            <td><?= h($germanMasterListing->specific_uses_for_product) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seating Capacity') ?></th>
            <td><?= h($germanMasterListing->seating_capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pattern Name') ?></th>
            <td><?= h($germanMasterListing->pattern_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paper Size') ?></th>
            <td><?= h($germanMasterListing->paper_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paint Type') ?></th>
            <td><?= h($germanMasterListing->paint_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type') ?></th>
            <td><?= h($germanMasterListing->occasion_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Doors') ?></th>
            <td><?= h($germanMasterListing->number_of_doors) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Line Weight') ?></th>
            <td><?= h($germanMasterListing->line_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Styling') ?></th>
            <td><?= h($germanMasterListing->item_styling) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Hardness') ?></th>
            <td><?= h($germanMasterListing->item_hardness) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adjustment Type') ?></th>
            <td><?= h($germanMasterListing->adjustment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Installation Type') ?></th>
            <td><?= h($germanMasterListing->installation_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components') ?></th>
            <td><?= h($germanMasterListing->included_components) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Frame Type') ?></th>
            <td><?= h($germanMasterListing->frame_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Factor') ?></th>
            <td><?= h($germanMasterListing->form_factor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($germanMasterListing->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Description') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->product_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point1') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->bullet_point1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point2') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->bullet_point2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point3') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->bullet_point3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point4') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->bullet_point4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point5') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->bullet_point5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->generic_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->generic_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->generic_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->generic_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->generic_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->platinum_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->platinum_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->platinum_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->platinum_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->platinum_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->target_audience_keywords)); ?>
    </div>
    <div class="row">
        <h4><?= __('Eu Toys Safety Directive Age Warning') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->eu_toys_safety_directive_age_warning)); ?>
    </div>
    <div class="row">
        <h4><?= __('Warranty Description') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->warranty_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Error') ?></h4>
        <?= $this->Text->autoParagraph(h($germanMasterListing->error)); ?>
    </div>
</div>
