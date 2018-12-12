<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mainListing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mainListing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Main Listings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Channels'), ['controller' => 'Channels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Channel'), ['controller' => 'Channels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mainListings form large-9 medium-8 columns content">
    <?= $this->Form->create($mainListing) ?>
    <fieldset>
        <legend><?= __('Edit Main Listing') ?></legend>
        <?php
            echo $this->Form->control('amazon_sku');
            echo $this->Form->control('channel_id', ['options' => $channels]);
            echo $this->Form->control('linnworks_code');
            echo $this->Form->control('price_uk');
            echo $this->Form->control('sale_price_uk');
            echo $this->Form->control('price_fr');
            echo $this->Form->control('sale_price_fr');
            echo $this->Form->control('price_de');
            echo $this->Form->control('sale_price_de');
            echo $this->Form->control('price_es');
            echo $this->Form->control('sale_price_es');
            echo $this->Form->control('price_ebay');
            echo $this->Form->control('sale_price_ebay');
            echo $this->Form->control('price_cdiscount');
            echo $this->Form->control('sale_price_cdiscount');
            echo $this->Form->control('prime_date');
            echo $this->Form->control('error');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
