<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master Listing'), ['action' => 'edit', $masterListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master Listing'), ['action' => 'delete', $masterListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Master Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Listing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masterListings view large-9 medium-8 columns content">
    <h3><?= h($masterListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Amazon Sku') ?></th>
            <td><?= h($masterListing->amazon_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Channel Id') ?></th>
            <td><?= h($masterListing->channel_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($masterListing->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Uk') ?></th>
            <td><?= h($masterListing->price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Uk') ?></th>
            <td><?= h($masterListing->sale_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Fr') ?></th>
            <td><?= h($masterListing->price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Fr') ?></th>
            <td><?= h($masterListing->sale_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price De') ?></th>
            <td><?= h($masterListing->price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price De') ?></th>
            <td><?= h($masterListing->sale_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Es') ?></th>
            <td><?= h($masterListing->price_es) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Es') ?></th>
            <td><?= h($masterListing->sale_price_es) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Ebay') ?></th>
            <td><?= h($masterListing->price_ebay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Ebay') ?></th>
            <td><?= h($masterListing->sale_price_ebay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Cdiscount') ?></th>
            <td><?= h($masterListing->price_cdiscount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Cdiscount') ?></th>
            <td><?= h($masterListing->sale_price_cdiscount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prime Date') ?></th>
            <td><?= h($masterListing->prime_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Error') ?></th>
            <td><?= h($masterListing->error) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($masterListing->id) ?></td>
        </tr>
    </table>
</div>
