<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProcessedListing $processedListing
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $processedListing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $processedListing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Processed Listings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="processedListings form large-9 medium-8 columns content">
    <?= $this->Form->create($processedListing) ?>
    <fieldset>
        <legend><?= __('Edit Processed Listing') ?></legend>
        <?php
            echo $this->Form->control('order_id');
            echo $this->Form->control('order_date');
            echo $this->Form->control('currency');
            echo $this->Form->control('plateform');
            echo $this->Form->control('subsource');
            echo $this->Form->control('cat_name');
            echo $this->Form->control('product_sku');
            echo $this->Form->control('product_name');
            echo $this->Form->control('quantity');
            echo $this->Form->control('price_per_product');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
