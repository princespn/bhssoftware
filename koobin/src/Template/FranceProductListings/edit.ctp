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
                ['action' => 'delete', $franceProductListing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $franceProductListing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List France Product Listings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="franceProductListings form large-9 medium-8 columns content">
    <?= $this->Form->create($franceProductListing) ?>
    <fieldset>
        <legend><?= __('Edit France Product Listing') ?></legend>
        <?php
            echo $this->Form->control('product_sku');
            echo $this->Form->control('product_code');
            echo $this->Form->control('product_asin');
            echo $this->Form->control('fulfillmentchannel');
            echo $this->Form->control('web_sku');
            echo $this->Form->control('category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
