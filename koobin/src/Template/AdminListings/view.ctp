<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin Listing'), ['action' => 'edit', $adminListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin Listing'), ['action' => 'delete', $adminListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admin Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="adminListings view large-9 medium-8 columns content">
    <h3><?= h($adminListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Web Sku') ?></th>
            <td><?= h($adminListing->web_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($adminListing->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Uk') ?></th>
            <td><?= h($adminListing->web_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Uk') ?></th>
            <td><?= h($adminListing->web_sale_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Fr') ?></th>
            <td><?= h($adminListing->web_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Fr') ?></th>
            <td><?= h($adminListing->web_sale_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price De') ?></th>
            <td><?= h($adminListing->web_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price De') ?></th>
            <td><?= h($adminListing->web_sale_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Dm') ?></th>
            <td><?= h($adminListing->web_price_dm) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Dm') ?></th>
            <td><?= h($adminListing->web_sale_price_dm) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Tesco') ?></th>
            <td><?= h($adminListing->web_price_tesco) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Tesco') ?></th>
            <td><?= h($adminListing->web_sale_price_tesco) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($adminListing->id) ?></td>
        </tr>
    </table>
</div>
