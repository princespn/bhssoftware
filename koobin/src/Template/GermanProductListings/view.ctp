<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GermanProductListing $germanProductListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit German Product Listing'), ['action' => 'edit', $germanProductListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete German Product Listing'), ['action' => 'delete', $germanProductListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $germanProductListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List German Product Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New German Product Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="germanProductListings view large-9 medium-8 columns content">
    <h3><?= h($germanProductListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Sku') ?></th>
            <td><?= h($germanProductListing->product_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Code') ?></th>
            <td><?= h($germanProductListing->product_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Asin') ?></th>
            <td><?= h($germanProductListing->product_asin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fulfillmentchannel') ?></th>
            <td><?= h($germanProductListing->fulfillmentchannel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sku') ?></th>
            <td><?= h($germanProductListing->web_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($germanProductListing->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($germanProductListing->id) ?></td>
        </tr>
    </table>
</div>
