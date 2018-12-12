<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLevel $stockLevel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Level'), ['action' => 'edit', $stockLevel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Level'), ['action' => 'delete', $stockLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLevel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Levels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Level'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockLevels view large-9 medium-8 columns content">
    <h3><?= h($stockLevel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Change Date') ?></th>
            <td><?= h($stockLevel->change_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Number') ?></th>
            <td><?= h($stockLevel->item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Title') ?></th>
            <td><?= h($stockLevel->item_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Barcode Number') ?></th>
            <td><?= h($stockLevel->barcode_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Name') ?></th>
            <td><?= h($stockLevel->category_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location Name') ?></th>
            <td><?= h($stockLevel->location_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Lev') ?></th>
            <td><?= h($stockLevel->stock_lev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Val') ?></th>
            <td><?= h($stockLevel->stock_val) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Level') ?></th>
            <td><?= h($stockLevel->minimum_level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Due Level') ?></th>
            <td><?= h($stockLevel->due_level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Costs') ?></th>
            <td><?= h($stockLevel->unit_costs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Itemid') ?></th>
            <td><?= h($stockLevel->stock_itemid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Location Id') ?></th>
            <td><?= h($stockLevel->stock_location_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockLevel->id) ?></td>
        </tr>
    </table>
</div>
