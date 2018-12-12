<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product Listing'), ['action' => 'edit', $productListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product Listing'), ['action' => 'delete', $productListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Product Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productListings view large-9 medium-8 columns content">
    <h3><?= h($productListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Sku') ?></th>
            <td><?= h($productListing->product_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Code') ?></th>
            <td><?= h($productListing->product_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Asin') ?></th>
            <td><?= h($productListing->product_asin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillmentchannel') ?></th>
            <td><?= h($productListing->fulfillmentchannel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sku') ?></th>
            <td><?= h($productListing->web_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($productListing->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($productListing->id) ?></td>
        </tr>
    </table>
</div>
