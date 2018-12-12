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
                ['action' => 'delete', $purchaseOrder->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="purchaseOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseOrder) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Order') ?></legend>
        <?php
            echo $this->Form->control('linnworks_code');
            echo $this->Form->control('product_name');
            echo $this->Form->control('invoice_value');
            echo $this->Form->control('latest_invoice');
            echo $this->Form->control('category');
            echo $this->Form->control('supplier');
            echo $this->Form->control('invoice_currency');
            echo $this->Form->control('landed_price_gbp');
            echo $this->Form->control('sp1_value_gbp');
            echo $this->Form->control('sp2_value_gbp');
            echo $this->Form->control('sp3_value_gbp');
            echo $this->Form->control('sale_price_gbp');
            echo $this->Form->control('landed_price_eur');
            echo $this->Form->control('sp1_value_eur');
            echo $this->Form->control('sp2_value_eur');
            echo $this->Form->control('sp3_value_eur');
            echo $this->Form->control('sale_price_euro');
            echo $this->Form->control('import_dates');
            echo $this->Form->control('error');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
