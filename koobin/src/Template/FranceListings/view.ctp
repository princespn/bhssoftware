<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit France Listing'), ['action' => 'edit', $franceListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete France Listing'), ['action' => 'delete', $franceListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $franceListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List France Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New France Listing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="franceListings view large-9 medium-8 columns content">
    <h3><?= h($franceListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $franceListing->has('user') ? $this->Html->link($franceListing->user->id, ['controller' => 'Users', 'action' => 'view', $franceListing->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Sku') ?></th>
            <td><?= h($franceListing->item_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id') ?></th>
            <td><?= h($franceListing->external_product_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id Type') ?></th>
            <td><?= h($franceListing->external_product_id_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($franceListing->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand Name') ?></th>
            <td><?= h($franceListing->brand_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manufacturer') ?></th>
            <td><?= h($franceListing->manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Product Type') ?></th>
            <td><?= h($franceListing->feed_product_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Part Number') ?></th>
            <td><?= h($franceListing->part_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Delete') ?></th>
            <td><?= h($franceListing->update_delete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Site Launch Date') ?></th>
            <td><?= h($franceListing->product_site_launch_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard Price') ?></th>
            <td><?= h($franceListing->standard_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($franceListing->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= h($franceListing->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Package Quantity') ?></th>
            <td><?= h($franceListing->item_package_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Tax Code') ?></th>
            <td><?= h($franceListing->product_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Release Date') ?></th>
            <td><?= h($franceListing->merchant_release_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price') ?></th>
            <td><?= h($franceListing->sale_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale From Date') ?></th>
            <td><?= h($franceListing->sale_from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale End Date') ?></th>
            <td><?= h($franceListing->sale_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Type') ?></th>
            <td><?= h($franceListing->condition_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Note') ?></th>
            <td><?= h($franceListing->condition_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Latency') ?></th>
            <td><?= h($franceListing->fulfillment_latency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Restock Date') ?></th>
            <td><?= h($franceListing->restock_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Aggregate Ship Quantity') ?></th>
            <td><?= h($franceListing->max_aggregate_ship_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Gift Messaged') ?></th>
            <td><?= h($franceListing->offering_can_be_gift_messaged) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Giftwrapped') ?></th>
            <td><?= h($franceListing->offering_can_be_giftwrapped) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Discontinued By Manufacturer') ?></th>
            <td><?= h($franceListing->is_discontinued_by_manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Missing Keyset Reason') ?></th>
            <td><?= h($franceListing->missing_keyset_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weee Tax Value') ?></th>
            <td><?= h($franceListing->weee_tax_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weee Tax Value Unit Of Measure') ?></th>
            <td><?= h($franceListing->weee_tax_value_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Shipping Group Name') ?></th>
            <td><?= h($franceListing->merchant_shipping_group_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight') ?></th>
            <td><?= h($franceListing->website_shipping_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight Unit Of Measure') ?></th>
            <td><?= h($franceListing->website_shipping_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length') ?></th>
            <td><?= h($franceListing->item_display_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width') ?></th>
            <td><?= h($franceListing->item_display_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_width_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height') ?></th>
            <td><?= h($franceListing->item_display_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_height_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth') ?></th>
            <td><?= h($franceListing->item_display_depth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_depth_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter') ?></th>
            <td><?= h($franceListing->item_display_diameter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_diameter_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight') ?></th>
            <td><?= h($franceListing->item_display_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name') ?></th>
            <td><?= h($franceListing->volume_capacity_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name Unit Of Measure') ?></th>
            <td><?= h($franceListing->volume_capacity_name_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume') ?></th>
            <td><?= h($franceListing->item_display_volume) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume Unit Of Measure') ?></th>
            <td><?= h($franceListing->item_display_volume_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes1') ?></th>
            <td><?= h($franceListing->recommended_browse_nodes1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes2') ?></th>
            <td><?= h($franceListing->recommended_browse_nodes2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalog Number') ?></th>
            <td><?= h($franceListing->catalog_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Main Image Url') ?></th>
            <td><?= h($franceListing->main_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swatch Image Url') ?></th>
            <td><?= h($franceListing->swatch_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url1') ?></th>
            <td><?= h($franceListing->other_image_url1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url2') ?></th>
            <td><?= h($franceListing->other_image_url2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url3') ?></th>
            <td><?= h($franceListing->other_image_url3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url4') ?></th>
            <td><?= h($franceListing->other_image_url4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url5') ?></th>
            <td><?= h($franceListing->other_image_url5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url6') ?></th>
            <td><?= h($franceListing->other_image_url6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url7') ?></th>
            <td><?= h($franceListing->other_image_url7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url8') ?></th>
            <td><?= h($franceListing->other_image_url8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length') ?></th>
            <td><?= h($franceListing->package_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Width') ?></th>
            <td><?= h($franceListing->package_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Height') ?></th>
            <td><?= h($franceListing->package_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length Unit Of Measure') ?></th>
            <td><?= h($franceListing->package_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Center Id') ?></th>
            <td><?= h($franceListing->fulfillment_center_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Child') ?></th>
            <td><?= h($franceListing->parent_child) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Sku') ?></th>
            <td><?= h($franceListing->parent_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relationship Type') ?></th>
            <td><?= h($franceListing->relationship_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variation Theme') ?></th>
            <td><?= h($franceListing->variation_theme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Age Warning') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_age_warning) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning1') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning2') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning3') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning4') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning5') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning6') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning7') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning8') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_warning8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language1') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language2') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language3') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language4') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language5') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language6') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language7') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Language8') ?></th>
            <td><?= h($franceListing->eu_toys_safety_directive_language8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country String') ?></th>
            <td><?= h($franceListing->country_string) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Safety Warning') ?></th>
            <td><?= h($franceListing->safety_warning) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Energy Efficiency Image Url') ?></th>
            <td><?= h($franceListing->energy_efficiency_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Efficiency Image Url') ?></th>
            <td><?= h($franceListing->product_efficiency_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Stain Resistant') ?></th>
            <td><?= h($franceListing->is_stain_resistant) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Name') ?></th>
            <td><?= h($franceListing->color_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Map') ?></th>
            <td><?= h($franceListing->color_map) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Name') ?></th>
            <td><?= h($franceListing->size_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Warranty Description') ?></th>
            <td><?= h($franceListing->warranty_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Sets') ?></th>
            <td><?= h($franceListing->number_of_sets) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Wattage') ?></th>
            <td><?= h($franceListing->wattage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type1') ?></th>
            <td><?= h($franceListing->material_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type2') ?></th>
            <td><?= h($franceListing->material_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type3') ?></th>
            <td><?= h($franceListing->material_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type4') ?></th>
            <td><?= h($franceListing->material_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type5') ?></th>
            <td><?= h($franceListing->material_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type6') ?></th>
            <td><?= h($franceListing->material_type6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type7') ?></th>
            <td><?= h($franceListing->material_type7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type8') ?></th>
            <td><?= h($franceListing->material_type8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features1') ?></th>
            <td><?= h($franceListing->special_features1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features2') ?></th>
            <td><?= h($franceListing->special_features2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features3') ?></th>
            <td><?= h($franceListing->special_features3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features4') ?></th>
            <td><?= h($franceListing->special_features4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features5') ?></th>
            <td><?= h($franceListing->special_features5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seating Capacity') ?></th>
            <td><?= h($franceListing->seating_capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pattern Name') ?></th>
            <td><?= h($franceListing->pattern_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paper Size') ?></th>
            <td><?= h($franceListing->paper_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paint Type') ?></th>
            <td><?= h($franceListing->paint_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type1') ?></th>
            <td><?= h($franceListing->occasion_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type2') ?></th>
            <td><?= h($franceListing->occasion_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type3') ?></th>
            <td><?= h($franceListing->occasion_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type4') ?></th>
            <td><?= h($franceListing->occasion_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occasion Type5') ?></th>
            <td><?= h($franceListing->occasion_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Doors') ?></th>
            <td><?= h($franceListing->number_of_doors) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Composition') ?></th>
            <td><?= h($franceListing->material_composition) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Line Weight') ?></th>
            <td><?= h($franceListing->line_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Type Name') ?></th>
            <td><?= h($franceListing->item_type_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Styling') ?></th>
            <td><?= h($franceListing->item_styling) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Shape') ?></th>
            <td><?= h($franceListing->item_shape) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Hardness') ?></th>
            <td><?= h($franceListing->item_hardness) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Installation Type') ?></th>
            <td><?= h($franceListing->installation_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components1') ?></th>
            <td><?= h($franceListing->included_components1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components2') ?></th>
            <td><?= h($franceListing->included_components2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components3') ?></th>
            <td><?= h($franceListing->included_components3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components4') ?></th>
            <td><?= h($franceListing->included_components4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components5') ?></th>
            <td><?= h($franceListing->included_components5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components6') ?></th>
            <td><?= h($franceListing->included_components6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components7') ?></th>
            <td><?= h($franceListing->included_components7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components8') ?></th>
            <td><?= h($franceListing->included_components8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components9') ?></th>
            <td><?= h($franceListing->included_components9) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Included Components10') ?></th>
            <td><?= h($franceListing->included_components10) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Frame Type') ?></th>
            <td><?= h($franceListing->frame_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Factor') ?></th>
            <td><?= h($franceListing->form_factor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Type1') ?></th>
            <td><?= h($franceListing->finish_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Type2') ?></th>
            <td><?= h($franceListing->finish_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Type3') ?></th>
            <td><?= h($franceListing->finish_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Type4') ?></th>
            <td><?= h($franceListing->finish_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finish Type5') ?></th>
            <td><?= h($franceListing->finish_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adjustment Type') ?></th>
            <td><?= h($franceListing->adjustment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Are Batteries Included') ?></th>
            <td><?= h($franceListing->are_batteries_included) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Batteries Required') ?></th>
            <td><?= h($franceListing->batteries_required) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Battery Type') ?></th>
            <td><?= h($franceListing->battery_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Batteries') ?></th>
            <td><?= h($franceListing->number_of_batteries) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Efficiency') ?></th>
            <td><?= h($franceListing->efficiency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thermal Performance Description') ?></th>
            <td><?= h($franceListing->thermal_performance_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($franceListing->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Description') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->product_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point1') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->bullet_point1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point2') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->bullet_point2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point3') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->bullet_point3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point4') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->bullet_point4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point5') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->bullet_point5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->generic_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->generic_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->generic_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->generic_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->generic_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->platinum_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->platinum_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->platinum_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->platinum_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->platinum_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->target_audience_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->target_audience_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->target_audience_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->target_audience_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->target_audience_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Error') ?></h4>
        <?= $this->Text->autoParagraph(h($franceListing->error)); ?>
    </div>
</div>
