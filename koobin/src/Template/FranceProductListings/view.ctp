<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit France Product Listing'), ['action' => 'edit', $franceProductListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete France Product Listing'), ['action' => 'delete', $franceProductListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $franceProductListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List France Product Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New France Product Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="franceProductListings view large-9 medium-8 columns content">
    <h3><?= h($franceProductListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Sku') ?></th>
            <td><?= h($franceProductListing->product_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Code') ?></th>
            <td><?= h($franceProductListing->product_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Asin') ?></th>
            <td><?= h($franceProductListing->product_asin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillmentchannel') ?></th>
            <td><?= h($franceProductListing->fulfillmentchannel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sku') ?></th>
            <td><?= h($franceProductListing->web_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($franceProductListing->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($franceProductListing->id) ?></td>
        </tr>
    </table>
</div>
