<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasePrice $purchasePrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchasePrice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchasePrice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Prices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="purchasePrices form large-9 medium-8 columns content">
    <?= $this->Form->create($purchasePrice) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Price') ?></legend>
        <?php
            echo $this->Form->control('purchase_id');
            echo $this->Form->control('supplier_id');
            echo $this->Form->control('stock_itemid');
            echo $this->Form->control('item_sku');
            echo $this->Form->control('item_title');
            echo $this->Form->control('invoice_currency');
            echo $this->Form->control('quantity');
            echo $this->Form->control('tax');
            echo $this->Form->control('cost');
            echo $this->Form->control('purchase_price');
            echo $this->Form->control('purchase_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
