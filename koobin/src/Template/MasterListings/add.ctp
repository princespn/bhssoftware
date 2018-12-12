<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Master Listings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="masterListings form large-9 medium-8 columns content">
    <?= $this->Form->create($masterListing) ?>
    <fieldset>
        <legend><?= __('Add Master Listing') ?></legend>
        <?php
            echo $this->Form->control('amazon_sku');
            echo $this->Form->control('channel_id');
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
