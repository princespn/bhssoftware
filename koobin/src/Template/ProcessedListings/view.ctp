<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProcessedListing $processedListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Processed Listing'), ['action' => 'edit', $processedListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Processed Listing'), ['action' => 'delete', $processedListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $processedListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Processed Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Processed Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="processedListings view large-9 medium-8 columns content">
    <h3><?= h($processedListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order Id') ?></th>
            <td><?= h($processedListing->order_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($processedListing->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plateform') ?></th>
            <td><?= h($processedListing->plateform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subsource') ?></th>
            <td><?= h($processedListing->subsource) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cat Name') ?></th>
            <td><?= h($processedListing->cat_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Sku') ?></th>
            <td><?= h($processedListing->product_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($processedListing->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Per Product') ?></th>
            <td><?= h($processedListing->price_per_product) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($processedListing->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($processedListing->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Date') ?></th>
            <td><?= h($processedListing->order_date) ?></td>
        </tr>
    </table>
</div>
