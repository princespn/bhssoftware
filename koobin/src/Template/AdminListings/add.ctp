<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Admin Listings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="adminListings form large-9 medium-8 columns content">
    <?= $this->Form->create($adminListing) ?>
    <fieldset>
        <legend><?= __('Add Admin Listing') ?></legend>
        <?php
            echo $this->Form->control('web_sku');
            echo $this->Form->control('linnworks_code');
            echo $this->Form->control('web_price_uk');
            echo $this->Form->control('web_sale_price_uk');
            echo $this->Form->control('web_price_fr');
            echo $this->Form->control('web_sale_price_fr');
            echo $this->Form->control('web_price_de');
            echo $this->Form->control('web_sale_price_de');
            echo $this->Form->control('web_price_dm');
            echo $this->Form->control('web_sale_price_dm');
            echo $this->Form->control('web_price_tesco');
            echo $this->Form->control('web_sale_price_tesco');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
