<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnglishListing[]|\Cake\Collection\CollectionInterface $englishListings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New English Listing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="englishListings index large-9 medium-8 columns content">
    <h3><?= __('English Listings') ?></h3>
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
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eu_toys_safety_directive_warning8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color_map') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_pieces') ?></th>
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
                <th scope="col"><?= $this->Paginator->sort('error') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($englishListings as $englishListing): ?>
            <tr>
                <td><?= $this->Number->format($englishListing->id) ?></td>
                <td><?= $englishListing->has('user') ? $this->Html->link($englishListing->user->id, ['controller' => 'Users', 'action' => 'view', $englishListing->user->id]) : '' ?></td>
                <td><?= h($englishListing->item_sku) ?></td>
                <td><?= h($englishListing->external_product_id) ?></td>
                <td><?= h($englishListing->external_product_id_type) ?></td>
                <td><?= h($englishListing->item_name) ?></td>
                <td><?= h($englishListing->brand_name) ?></td>
                <td><?= h($englishListing->manufacturer) ?></td>
                <td><?= h($englishListing->feed_product_type) ?></td>
                <td><?= h($englishListing->part_number) ?></td>
                <td><?= h($englishListing->update_delete) ?></td>
                <td><?= h($englishListing->product_site_launch_date) ?></td>
                <td><?= h($englishListing->standard_price) ?></td>
                <td><?= h($englishListing->currency) ?></td>
                <td><?= h($englishListing->quantity) ?></td>
                <td><?= h($englishListing->item_package_quantity) ?></td>
                <td><?= h($englishListing->product_tax_code) ?></td>
                <td><?= h($englishListing->merchant_release_date) ?></td>
                <td><?= h($englishListing->sale_price) ?></td>
                <td><?= h($englishListing->sale_from_date) ?></td>
                <td><?= h($englishListing->sale_end_date) ?></td>
                <td><?= h($englishListing->condition_type) ?></td>
                <td><?= h($englishListing->condition_note) ?></td>
                <td><?= h($englishListing->fulfillment_latency) ?></td>
                <td><?= h($englishListing->restock_date) ?></td>
                <td><?= h($englishListing->max_aggregate_ship_quantity) ?></td>
                <td><?= h($englishListing->offering_can_be_gift_messaged) ?></td>
                <td><?= h($englishListing->offering_can_be_giftwrapped) ?></td>
                <td><?= h($englishListing->is_discontinued_by_manufacturer) ?></td>
                <td><?= h($englishListing->missing_keyset_reason) ?></td>
                <td><?= h($englishListing->website_shipping_weight) ?></td>
                <td><?= h($englishListing->website_shipping_weight_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_length) ?></td>
                <td><?= h($englishListing->item_display_length_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_width) ?></td>
                <td><?= h($englishListing->item_display_width_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_height) ?></td>
                <td><?= h($englishListing->item_display_height_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_depth) ?></td>
                <td><?= h($englishListing->item_display_depth_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_diameter) ?></td>
                <td><?= h($englishListing->item_display_diameter_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_weight) ?></td>
                <td><?= h($englishListing->item_display_weight_unit_of_measure) ?></td>
                <td><?= h($englishListing->volume_capacity_name) ?></td>
                <td><?= h($englishListing->volume_capacity_name_unit_of_measure) ?></td>
                <td><?= h($englishListing->item_display_volume) ?></td>
                <td><?= h($englishListing->item_display_volume_unit_of_measure) ?></td>
                <td><?= h($englishListing->recommended_browse_nodes1) ?></td>
                <td><?= h($englishListing->recommended_browse_nodes2) ?></td>
                <td><?= h($englishListing->catalog_number) ?></td>
                <td><?= h($englishListing->main_image_url) ?></td>
                <td><?= h($englishListing->swatch_image_url) ?></td>
                <td><?= h($englishListing->other_image_url1) ?></td>
                <td><?= h($englishListing->other_image_url2) ?></td>
                <td><?= h($englishListing->other_image_url3) ?></td>
                <td><?= h($englishListing->other_image_url4) ?></td>
                <td><?= h($englishListing->other_image_url5) ?></td>
                <td><?= h($englishListing->other_image_url6) ?></td>
                <td><?= h($englishListing->other_image_url7) ?></td>
                <td><?= h($englishListing->other_image_url8) ?></td>
                <td><?= h($englishListing->package_length) ?></td>
                <td><?= h($englishListing->package_width) ?></td>
                <td><?= h($englishListing->package_height) ?></td>
                <td><?= h($englishListing->package_length_unit_of_measure) ?></td>
                <td><?= h($englishListing->fulfillment_center_id) ?></td>
                <td><?= h($englishListing->parent_child) ?></td>
                <td><?= h($englishListing->parent_sku) ?></td>
                <td><?= h($englishListing->relationship_type) ?></td>
                <td><?= h($englishListing->variation_theme) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning1) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning2) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning3) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning4) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning5) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning6) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning7) ?></td>
                <td><?= h($englishListing->eu_toys_safety_directive_warning8) ?></td>
                <td><?= h($englishListing->color_name) ?></td>
                <td><?= h($englishListing->color_map) ?></td>
                <td><?= h($englishListing->size_name) ?></td>
                <td><?= h($englishListing->number_of_pieces) ?></td>
                <td><?= h($englishListing->material_type1) ?></td>
                <td><?= h($englishListing->material_type2) ?></td>
                <td><?= h($englishListing->material_type3) ?></td>
                <td><?= h($englishListing->material_type4) ?></td>
                <td><?= h($englishListing->material_type5) ?></td>
                <td><?= h($englishListing->material_type6) ?></td>
                <td><?= h($englishListing->material_type7) ?></td>
                <td><?= h($englishListing->material_type8) ?></td>
                <td><?= h($englishListing->special_features1) ?></td>
                <td><?= h($englishListing->special_features2) ?></td>
                <td><?= h($englishListing->special_features3) ?></td>
                <td><?= h($englishListing->special_features4) ?></td>
                <td><?= h($englishListing->special_features5) ?></td>
                <td><?= h($englishListing->error) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $englishListing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $englishListing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $englishListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $englishListing->id)]) ?>
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
