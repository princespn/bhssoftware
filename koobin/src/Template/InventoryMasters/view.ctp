<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryMaster $inventoryMaster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inventory Master'), ['action' => 'edit', $inventoryMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inventory Master'), ['action' => 'delete', $inventoryMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inventoryMasters view large-9 medium-8 columns content">
    <h3><?= h($inventoryMaster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $inventoryMaster->has('user') ? $this->Html->link($inventoryMaster->user->id, ['controller' => 'Users', 'action' => 'view', $inventoryMaster->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Sku') ?></th>
            <td><?= h($inventoryMaster->item_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id') ?></th>
            <td><?= h($inventoryMaster->external_product_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('External Product Id Type') ?></th>
            <td><?= h($inventoryMaster->external_product_id_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($inventoryMaster->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand Name') ?></th>
            <td><?= h($inventoryMaster->brand_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manufacturer') ?></th>
            <td><?= h($inventoryMaster->manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Product Type') ?></th>
            <td><?= h($inventoryMaster->feed_product_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Part Number') ?></th>
            <td><?= h($inventoryMaster->part_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Delete') ?></th>
            <td><?= h($inventoryMaster->update_delete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Site Launch Date') ?></th>
            <td><?= h($inventoryMaster->product_site_launch_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard Price') ?></th>
            <td><?= h($inventoryMaster->standard_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($inventoryMaster->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= h($inventoryMaster->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Package Quantity') ?></th>
            <td><?= h($inventoryMaster->item_package_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Tax Code') ?></th>
            <td><?= h($inventoryMaster->product_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Merchant Release Date') ?></th>
            <td><?= h($inventoryMaster->merchant_release_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price') ?></th>
            <td><?= h($inventoryMaster->sale_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale From Date') ?></th>
            <td><?= h($inventoryMaster->sale_from_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale End Date') ?></th>
            <td><?= h($inventoryMaster->sale_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Type') ?></th>
            <td><?= h($inventoryMaster->condition_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Note') ?></th>
            <td><?= h($inventoryMaster->condition_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Latency') ?></th>
            <td><?= h($inventoryMaster->fulfillment_latency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Restock Date') ?></th>
            <td><?= h($inventoryMaster->restock_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Aggregate Ship Quantity') ?></th>
            <td><?= h($inventoryMaster->max_aggregate_ship_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Gift Messaged') ?></th>
            <td><?= h($inventoryMaster->offering_can_be_gift_messaged) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offering Can Be Giftwrapped') ?></th>
            <td><?= h($inventoryMaster->offering_can_be_giftwrapped) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Discontinued By Manufacturer') ?></th>
            <td><?= h($inventoryMaster->is_discontinued_by_manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Missing Keyset Reason') ?></th>
            <td><?= h($inventoryMaster->missing_keyset_reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight') ?></th>
            <td><?= h($inventoryMaster->website_shipping_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website Shipping Weight Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->website_shipping_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length') ?></th>
            <td><?= h($inventoryMaster->item_display_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Length Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width') ?></th>
            <td><?= h($inventoryMaster->item_display_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Width Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_width_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height') ?></th>
            <td><?= h($inventoryMaster->item_display_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Height Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_height_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth') ?></th>
            <td><?= h($inventoryMaster->item_display_depth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Depth Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_depth_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter') ?></th>
            <td><?= h($inventoryMaster->item_display_diameter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Diameter Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_diameter_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight') ?></th>
            <td><?= h($inventoryMaster->item_display_weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Weight Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_weight_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name') ?></th>
            <td><?= h($inventoryMaster->volume_capacity_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume Capacity Name Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->volume_capacity_name_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume') ?></th>
            <td><?= h($inventoryMaster->item_display_volume) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Display Volume Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->item_display_volume_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes1') ?></th>
            <td><?= h($inventoryMaster->recommended_browse_nodes1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommended Browse Nodes2') ?></th>
            <td><?= h($inventoryMaster->recommended_browse_nodes2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalog Number') ?></th>
            <td><?= h($inventoryMaster->catalog_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Main Image Url') ?></th>
            <td><?= h($inventoryMaster->main_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swatch Image Url') ?></th>
            <td><?= h($inventoryMaster->swatch_image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url1') ?></th>
            <td><?= h($inventoryMaster->other_image_url1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url2') ?></th>
            <td><?= h($inventoryMaster->other_image_url2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url3') ?></th>
            <td><?= h($inventoryMaster->other_image_url3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url4') ?></th>
            <td><?= h($inventoryMaster->other_image_url4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url5') ?></th>
            <td><?= h($inventoryMaster->other_image_url5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url6') ?></th>
            <td><?= h($inventoryMaster->other_image_url6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url7') ?></th>
            <td><?= h($inventoryMaster->other_image_url7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Image Url8') ?></th>
            <td><?= h($inventoryMaster->other_image_url8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length') ?></th>
            <td><?= h($inventoryMaster->package_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Width') ?></th>
            <td><?= h($inventoryMaster->package_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Height') ?></th>
            <td><?= h($inventoryMaster->package_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package Length Unit Of Measure') ?></th>
            <td><?= h($inventoryMaster->package_length_unit_of_measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillment Center Id') ?></th>
            <td><?= h($inventoryMaster->fulfillment_center_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Child') ?></th>
            <td><?= h($inventoryMaster->parent_child) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Sku') ?></th>
            <td><?= h($inventoryMaster->parent_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relationship Type') ?></th>
            <td><?= h($inventoryMaster->relationship_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variation Theme') ?></th>
            <td><?= h($inventoryMaster->variation_theme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning1') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning2') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning3') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning4') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning5') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning6') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning7') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eu Toys Safety Directive Warning8') ?></th>
            <td><?= h($inventoryMaster->eu_toys_safety_directive_warning8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Name') ?></th>
            <td><?= h($inventoryMaster->color_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color Map') ?></th>
            <td><?= h($inventoryMaster->color_map) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Name') ?></th>
            <td><?= h($inventoryMaster->size_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Pieces') ?></th>
            <td><?= h($inventoryMaster->number_of_pieces) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type1') ?></th>
            <td><?= h($inventoryMaster->material_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type2') ?></th>
            <td><?= h($inventoryMaster->material_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type3') ?></th>
            <td><?= h($inventoryMaster->material_type3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type4') ?></th>
            <td><?= h($inventoryMaster->material_type4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type5') ?></th>
            <td><?= h($inventoryMaster->material_type5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type6') ?></th>
            <td><?= h($inventoryMaster->material_type6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type7') ?></th>
            <td><?= h($inventoryMaster->material_type7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material Type8') ?></th>
            <td><?= h($inventoryMaster->material_type8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features1') ?></th>
            <td><?= h($inventoryMaster->special_features1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features2') ?></th>
            <td><?= h($inventoryMaster->special_features2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features3') ?></th>
            <td><?= h($inventoryMaster->special_features3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features4') ?></th>
            <td><?= h($inventoryMaster->special_features4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Features5') ?></th>
            <td><?= h($inventoryMaster->special_features5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($inventoryMaster->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Error') ?></th>
            <td><?= h($inventoryMaster->error) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventoryMaster->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Description') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->product_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point1') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->bullet_point1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point2') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->bullet_point2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point3') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->bullet_point3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point4') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->bullet_point4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Bullet Point5') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->bullet_point5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->generic_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->generic_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->generic_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->generic_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Generic Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->generic_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->platinum_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->platinum_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->platinum_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->platinum_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Platinum Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->platinum_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords1') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->target_audience_keywords1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords2') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->target_audience_keywords2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords3') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->target_audience_keywords3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords4') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->target_audience_keywords4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Target Audience Keywords5') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->target_audience_keywords5)); ?>
    </div>
    <div class="row">
        <h4><?= __('Eu Toys Safety Directive Age Warning') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->eu_toys_safety_directive_age_warning)); ?>
    </div>
    <div class="row">
        <h4><?= __('Warranty Description') ?></h4>
        <?= $this->Text->autoParagraph(h($inventoryMaster->warranty_description)); ?>
    </div>
</div>
