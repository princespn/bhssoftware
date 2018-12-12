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
                ['action' => 'delete', $productListing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productListing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Product Listings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="productListings form large-9 medium-8 columns content">
    <?= $this->Form->create($productListing) ?>
    <fieldset>
        <legend><?= __('Edit Product Listing') ?></legend>
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
