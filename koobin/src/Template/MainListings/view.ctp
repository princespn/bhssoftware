<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Main Listing'), ['action' => 'edit', $mainListing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Main Listing'), ['action' => 'delete', $mainListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mainListing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Main Listings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Main Listing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Channels'), ['controller' => 'Channels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Channel'), ['controller' => 'Channels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mainListings view large-9 medium-8 columns content">
    <h3><?= h($mainListing->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Amazon Sku') ?></th>
            <td><?= h($mainListing->amazon_sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Channel') ?></th>
            <td><?= $mainListing->has('channel') ? $this->Html->link($mainListing->channel->id, ['controller' => 'Channels', 'action' => 'view', $mainListing->channel->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($mainListing->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Uk') ?></th>
            <td><?= h($mainListing->price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Uk') ?></th>
            <td><?= h($mainListing->sale_price_uk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Fr') ?></th>
            <td><?= h($mainListing->price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Fr') ?></th>
            <td><?= h($mainListing->sale_price_fr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price De') ?></th>
            <td><?= h($mainListing->price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price De') ?></th>
            <td><?= h($mainListing->sale_price_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Es') ?></th>
            <td><?= h($mainListing->price_es) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Es') ?></th>
            <td><?= h($mainListing->sale_price_es) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Ebay') ?></th>
            <td><?= h($mainListing->price_ebay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Ebay') ?></th>
            <td><?= h($mainListing->sale_price_ebay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Cdiscount') ?></th>
            <td><?= h($mainListing->price_cdiscount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Cdiscount') ?></th>
            <td><?= h($mainListing->sale_price_cdiscount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prime Date') ?></th>
            <td><?= h($mainListing->prime_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mainListing->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Error') ?></h4>
        <?= $this->Text->autoParagraph(h($mainListing->error)); ?>
    </div>
</div>
