<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasePrice $purchasePrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Price'), ['action' => 'edit', $purchasePrice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Price'), ['action' => 'delete', $purchasePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchasePrice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Price'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchasePrices view large-9 medium-8 columns content">
    <h3><?= h($purchasePrice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Id') ?></th>
            <td><?= h($purchasePrice->purchase_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier Id') ?></th>
            <td><?= h($purchasePrice->supplier_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Itemid') ?></th>
            <td><?= h($purchasePrice->stock_itemid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Sku') ?></th>
            <td><?= h($purchasePrice->item_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Title') ?></th>
            <td><?= h($purchasePrice->item_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Currency') ?></th>
            <td><?= h($purchasePrice->invoice_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= h($purchasePrice->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax') ?></th>
            <td><?= h($purchasePrice->tax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= h($purchasePrice->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Price') ?></th>
            <td><?= h($purchasePrice->purchase_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchasePrice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Date') ?></th>
            <td><?= h($purchasePrice->purchase_date) ?></td>
        </tr>
    </table>
</div>
