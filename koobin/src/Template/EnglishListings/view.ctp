<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnglishListing $englishListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit English Listing'), ['action' => 'edit', $englishListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete English Listing'), ['action' => 'delete', $englishListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $englishListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List English Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New English Listing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="englishListings view large-9 medium-8 columns content">
    <h3><?= h($englishListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $englishListing->has('user') ? $this->Html->link($englishListing->user->id, ['controller' => 'Users', 'action' => 'view', $englishListing->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Sku') ?></th>
            <td><?= h($englishListing->item_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id') ?></th>
            <td><?= h($englishListing->external_product_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id Type') ?></th>
            <td><?= h($englishListing->external_product_id_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($englishListing->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand Name') ?></th>
            <td><?= h($englishListing->brand_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manufacturer') ?></th>
            <td><?= h($englishListing->manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Product Type') ?></th>
            <td><?= h($englishListing->feed_product_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Part Number') ?></th>
            <td><?= h($englishListing->part_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Delete') ?></th>
            <td><?= h($englishListing->update_delete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Site Launch Date') ?></th>
            <td><?= h($englishListing->product_site_launch_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard Price') ?></th>
            <td><?= h($englishListing->standard_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($englishListing->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= h($englishListing->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Package Quantity') ?></th>
            <td><?= h($englishListing->item_package_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Tax Code') ?></th>
            <td><?= h($englishListing->product_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Release Date') ?></th>
            <td><?= h($englishListing->merchant_release_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price') ?></th>
            <td><?= h($englishListing->sale_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale From Date') ?></th>
            <td><?= h($englishListing->sale_from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale End Date') ?></th>
            <td><?= h($englishListing->sale_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Type') ?></th>
            <td><?= h($englishListing->condition_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Note') ?></th>
            <td><?= h($englishListing->condition_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Latency') ?></th>
            <td><?= h($englishListing->fulfillment_latency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Restock Date') ?></th>
            <td><?= h($englishListing->restock_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Aggregate Ship Quantity') ?></th>
            <td><?= h($englishListing->max_aggregate_ship_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Gift Messaged') ?></th>
            <td><?= h($englishListing->offering_can_be_gift_messaged) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Giftwrapped') ?></th>
            <td><?= h($englishListing->offering_can_be_giftwrapped) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Discontinued By Manufacturer') ?></th>
            <td><?= h($englishListing->is_discontinued_by_manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Missing Keyset Reason') ?></th>
            <td><?= h($englishListing->missing_keyset_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight') ?></th>
            <td><?= h($englishListing->website_shipping_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight Unit Of Measure') ?></th>
            <td><?= h($englishListing->website_shipping_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length') ?></th>
            <td><?= h($englishListing->item_display_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width') ?></th>
            <td><?= h($englishListing->item_display_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_width_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height') ?></th>
            <td><?= h($englishListing->item_display_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_height_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth') ?></th>
            <td><?= h($englishListing->item_display_depth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_depth_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter') ?></th>
            <td><?= h($englishListing->item_display_diameter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_diameter_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight') ?></th>
            <td><?= h($englishListing->item_display_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name') ?></th>
            <td><?= h($englishListing->volume_capacity_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name Unit Of Measure') ?></th>
            <td><?= h($englishListing->volume_capacity_name_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume') ?></th>
            <td><?= h($englishListing->item_display_volume) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume Unit Of Measure') ?></th>
            <td><?= h($englishListing->item_display_volume_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes1') ?></th>
            <td><?= h($englishListing->recommended_browse_nodes1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes2') ?></th>
            <td><?= h($englishListing->recommended_browse_nodes2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalog Number') ?></th>
            <td><?= h($englishListing->catalog_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Main Image Url') ?></th>
            <td><?= h($englishListing->main_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swatch Image Url') ?></th>
            <td><?= h($englishListing->swatch_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url1') ?></th>
            <td><?= h($englishListing->other_image_url1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url2') ?></th>
            <td><?= h($englishListing->other_image_url2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url3') ?></th>
            <td><?= h($englishListing->other_image_url3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url4') ?></th>
            <td><?= h($englishListing->other_image_url4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url5') ?></th>
            <td><?= h($englishListing->other_image_url5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url6') ?></th>
            <td><?= h($englishListing->other_image_url6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url7') ?></th>
            <td><?= h($englishListing->other_image_url7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url8') ?></th>
            <td><?= h($englishListing->other_image_url8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length') ?></th>
            <td><?= h($englishListing->package_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Width') ?></th>
            <td><?= h($englishListing->package_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Height') ?></th>
            <td><?= h($englishListing->package_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length Unit Of Measure') ?></th>
            <td><?= h($englishListing->package_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Center Id') ?></th>
            <td><?= h($englishListing->fulfillment_center_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Child') ?></th>
            <td><?= h($englishListing->parent_child) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Sku') ?></th>
            <td><?= h($englishListing->parent_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relationship Type') ?></th>
            <td><?= h($englishListing->relationship_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variation Theme') ?></th>
            <td><?= h($englishListing->variation_theme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning1') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning2') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning3') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning4') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning5') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning6') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning7') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning8') ?></th>
            <td><?= h($englishListing->eu_toys_safety_directive_warning8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Name') ?></th>
            <td><?= h($englishListing->color_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Map') ?></th>
            <td><?= h($englishListing->color_map) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Name') ?></th>
            <td><?= h($englishListing->size_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Pieces') ?></th>
            <td><?= h($englishListing->number_of_pieces) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type1') ?></th>
            <td><?= h($englishListing->material_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type2') ?></th>
            <td><?= h($englishListing->material_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type3') ?></th>
            <td><?= h($englishListing->material_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type4') ?></th>
            <td><?= h($englishListing->material_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type5') ?></th>
            <td><?= h($englishListing->material_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type6') ?></th>
            <td><?= h($englishListing->material_type6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type7') ?></th>
            <td><?= h($englishListing->material_type7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type8') ?></th>
            <td><?= h($englishListing->material_type8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features1') ?></th>
            <td><?= h($englishListing->special_features1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features2') ?></th>
            <td><?= h($englishListing->special_features2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features3') ?></th>
            <td><?= h($englishListing->special_features3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features4') ?></th>
            <td><?= h($englishListing->special_features4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features5') ?></th>
            <td><?= h($englishListing->special_features5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Error') ?></th>
            <td><?= h($englishListing->error) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($englishListing->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Description') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->product_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point1') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->bullet_point1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point2') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->bullet_point2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point3') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->bullet_point3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point4') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->bullet_point4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point5') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->bullet_point5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->generic_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->generic_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->generic_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->generic_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->generic_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->platinum_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->platinum_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->platinum_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->platinum_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->platinum_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->target_audience_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->target_audience_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->target_audience_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->target_audience_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->target_audience_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Eu Toys Safety Directive Age Warning') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->eu_toys_safety_directive_age_warning)); ?>
    </div>
    <div class="row">
        <h4><?= __('Warranty Description') ?></h4>
        <?= $this->Text->autoParagraph(h($englishListing->warranty_description)); ?>
    </div>
</div>
