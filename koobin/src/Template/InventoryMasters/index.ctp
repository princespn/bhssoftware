<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryMaster[]|\Cake\Collection\CollectionInterface $inventoryMasters
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Inventory Master'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryMasters index large-9 medium-8 columns content">
    <h3><?= __('Inventory Masters') ?></h3>
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
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('error') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventoryMasters as $inventoryMaster): ?>
            <tr>
                <td><?= $this->Number->format($inventoryMaster->id) ?></td>
                <td><?= $inventoryMaster->has('user') ? $this->Html->link($inventoryMaster->user->id, ['controller' => 'Users', 'action' => 'view', $inventoryMaster->user->id]) : '' ?></td>
                <td><?= h($inventoryMaster->item_sku) ?></td>
                <td><?= h($inventoryMaster->external_product_id) ?></td>
                <td><?= h($inventoryMaster->external_product_id_type) ?></td>
                <td><?= h($inventoryMaster->item_name) ?></td>
                <td><?= h($inventoryMaster->brand_name) ?></td>
                <td><?= h($inventoryMaster->manufacturer) ?></td>
                <td><?= h($inventoryMaster->feed_product_type) ?></td>
                <td><?= h($inventoryMaster->part_number) ?></td>
                <td><?= h($inventoryMaster->update_delete) ?></td>
                <td><?= h($inventoryMaster->product_site_launch_date) ?></td>
                <td><?= h($inventoryMaster->standard_price) ?></td>
                <td><?= h($inventoryMaster->currency) ?></td>
                <td><?= h($inventoryMaster->quantity) ?></td>
                <td><?= h($inventoryMaster->item_package_quantity) ?></td>
                <td><?= h($inventoryMaster->product_tax_code) ?></td>
                <td><?= h($inventoryMaster->merchant_release_date) ?></td>
                <td><?= h($inventoryMaster->sale_price) ?></td>
                <td><?= h($inventoryMaster->sale_from_date) ?></td>
                <td><?= h($inventoryMaster->sale_end_date) ?></td>
                <td><?= h($inventoryMaster->condition_type) ?></td>
                <td><?= h($inventoryMaster->condition_note) ?></td>
                <td><?= h($inventoryMaster->fulfillment_latency) ?></td>
                <td><?= h($inventoryMaster->restock_date) ?></td>
                <td><?= h($inventoryMaster->max_aggregate_ship_quantity) ?></td>
                <td><?= h($inventoryMaster->offering_can_be_gift_messaged) ?></td>
                <td><?= h($inventoryMaster->offering_can_be_giftwrapped) ?></td>
                <td><?= h($inventoryMaster->is_discontinued_by_manufacturer) ?></td>
                <td><?= h($inventoryMaster->missing_keyset_reason) ?></td>
                <td><?= h($inventoryMaster->website_shipping_weight) ?></td>
                <td><?= h($inventoryMaster->website_shipping_weight_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_length) ?></td>
                <td><?= h($inventoryMaster->item_display_length_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_width) ?></td>
                <td><?= h($inventoryMaster->item_display_width_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_height) ?></td>
                <td><?= h($inventoryMaster->item_display_height_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_depth) ?></td>
                <td><?= h($inventoryMaster->item_display_depth_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_diameter) ?></td>
                <td><?= h($inventoryMaster->item_display_diameter_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_weight) ?></td>
                <td><?= h($inventoryMaster->item_display_weight_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->volume_capacity_name) ?></td>
                <td><?= h($inventoryMaster->volume_capacity_name_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->item_display_volume) ?></td>
                <td><?= h($inventoryMaster->item_display_volume_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->recommended_browse_nodes1) ?></td>
                <td><?= h($inventoryMaster->recommended_browse_nodes2) ?></td>
                <td><?= h($inventoryMaster->catalog_number) ?></td>
                <td><?= h($inventoryMaster->main_image_url) ?></td>
                <td><?= h($inventoryMaster->swatch_image_url) ?></td>
                <td><?= h($inventoryMaster->other_image_url1) ?></td>
                <td><?= h($inventoryMaster->other_image_url2) ?></td>
                <td><?= h($inventoryMaster->other_image_url3) ?></td>
                <td><?= h($inventoryMaster->other_image_url4) ?></td>
                <td><?= h($inventoryMaster->other_image_url5) ?></td>
                <td><?= h($inventoryMaster->other_image_url6) ?></td>
                <td><?= h($inventoryMaster->other_image_url7) ?></td>
                <td><?= h($inventoryMaster->other_image_url8) ?></td>
                <td><?= h($inventoryMaster->package_length) ?></td>
                <td><?= h($inventoryMaster->package_width) ?></td>
                <td><?= h($inventoryMaster->package_height) ?></td>
                <td><?= h($inventoryMaster->package_length_unit_of_measure) ?></td>
                <td><?= h($inventoryMaster->fulfillment_center_id) ?></td>
                <td><?= h($inventoryMaster->parent_child) ?></td>
                <td><?= h($inventoryMaster->parent_sku) ?></td>
                <td><?= h($inventoryMaster->relationship_type) ?></td>
                <td><?= h($inventoryMaster->variation_theme) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning1) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning2) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning3) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning4) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning5) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning6) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning7) ?></td>
                <td><?= h($inventoryMaster->eu_toys_safety_directive_warning8) ?></td>
                <td><?= h($inventoryMaster->color_name) ?></td>
                <td><?= h($inventoryMaster->color_map) ?></td>
                <td><?= h($inventoryMaster->size_name) ?></td>
                <td><?= h($inventoryMaster->number_of_pieces) ?></td>
                <td><?= h($inventoryMaster->material_type1) ?></td>
                <td><?= h($inventoryMaster->material_type2) ?></td>
                <td><?= h($inventoryMaster->material_type3) ?></td>
                <td><?= h($inventoryMaster->material_type4) ?></td>
                <td><?= h($inventoryMaster->material_type5) ?></td>
                <td><?= h($inventoryMaster->material_type6) ?></td>
                <td><?= h($inventoryMaster->material_type7) ?></td>
                <td><?= h($inventoryMaster->material_type8) ?></td>
                <td><?= h($inventoryMaster->special_features1) ?></td>
                <td><?= h($inventoryMaster->special_features2) ?></td>
                <td><?= h($inventoryMaster->special_features3) ?></td>
                <td><?= h($inventoryMaster->special_features4) ?></td>
                <td><?= h($inventoryMaster->special_features5) ?></td>
                <td><?= h($inventoryMaster->category) ?></td>
                <td><?= h($inventoryMaster->error) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $inventoryMaster->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $inventoryMaster->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $inventoryMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryMaster->id)]) ?>
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
