<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Channel'), ['action' => 'edit', $channel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Channel'), ['action' => 'delete', $channel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $channel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Channels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Channel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Master Listings'), ['controller' => 'MasterListings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Listing'), ['controller' => 'MasterListings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="channels view large-9 medium-8 columns content">
    <h3><?= h($channel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Channel Code') ?></th>
            <td><?= h($channel->channel_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Channel Name') ?></th>
            <td><?= h($channel->channel_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($channel->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Master Listings') ?></h4>
        <?php if (!empty($channel->master_listings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Amazon Sku') ?></th>
                <th scope="col"><?= __('Channel Id') ?></th>
                <th scope="col"><?= __('Linnworks Code') ?></th>
                <th scope="col"><?= __('Price Uk') ?></th>
                <th scope="col"><?= __('Sale Price Uk') ?></th>
                <th scope="col"><?= __('Price Fr') ?></th>
                <th scope="col"><?= __('Sale Price Fr') ?></th>
                <th scope="col"><?= __('Price De') ?></th>
                <th scope="col"><?= __('Sale Price De') ?></th>
                <th scope="col"><?= __('Price Es') ?></th>
                <th scope="col"><?= __('Sale Price Es') ?></th>
                <th scope="col"><?= __('Price Ebay') ?></th>
                <th scope="col"><?= __('Sale Price Ebay') ?></th>
                <th scope="col"><?= __('Price Cdiscount') ?></th>
                <th scope="col"><?= __('Sale Price Cdiscount') ?></th>
                <th scope="col"><?= __('Prime Date') ?></th>
                <th scope="col"><?= __('Error') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($channel->master_listings as $masterListings): ?>
            <tr>
                <td><?= h($masterListings->id) ?></td>
                <td><?= h($masterListings->amazon_sku) ?></td>
                <td><?= h($masterListings->channel_id) ?></td>
                <td><?= h($masterListings->linnworks_code) ?></td>
                <td><?= h($masterListings->price_uk) ?></td>
                <td><?= h($masterListings->sale_price_uk) ?></td>
                <td><?= h($masterListings->price_fr) ?></td>
                <td><?= h($masterListings->sale_price_fr) ?></td>
                <td><?= h($masterListings->price_de) ?></td>
                <td><?= h($masterListings->sale_price_de) ?></td>
                <td><?= h($masterListings->price_es) ?></td>
                <td><?= h($masterListings->sale_price_es) ?></td>
                <td><?= h($masterListings->price_ebay) ?></td>
                <td><?= h($masterListings->sale_price_ebay) ?></td>
                <td><?= h($masterListings->price_cdiscount) ?></td>
                <td><?= h($masterListings->sale_price_cdiscount) ?></td>
                <td><?= h($masterListings->prime_date) ?></td>
                <td><?= h($masterListings->error) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MasterListings', 'action' => 'view', $masterListings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MasterListings', 'action' => 'edit', $masterListings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MasterListings', 'action' => 'delete', $masterListings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterListings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
