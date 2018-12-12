<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Listing'), ['action' => 'edit', $listing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Listing'), ['action' => 'delete', $listing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="listings view large-9 medium-8 columns content">
    <h3><?= h($listing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Web Sku') ?></th>
            <td><?= h($listing->web_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($listing->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Uk') ?></th>
            <td><?= h($listing->web_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Uk') ?></th>
            <td><?= h($listing->web_sale_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Fr') ?></th>
            <td><?= h($listing->web_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Fr') ?></th>
            <td><?= h($listing->web_sale_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price De') ?></th>
            <td><?= h($listing->web_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price De') ?></th>
            <td><?= h($listing->web_sale_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Dm') ?></th>
            <td><?= h($listing->web_price_dm) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Dm') ?></th>
            <td><?= h($listing->web_sale_price_dm) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Price Tesco') ?></th>
            <td><?= h($listing->web_price_tesco) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Web Sale Price Tesco') ?></th>
            <td><?= h($listing->web_sale_price_tesco) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($listing->id) ?></td>
        </tr>
    </table>
</div>
