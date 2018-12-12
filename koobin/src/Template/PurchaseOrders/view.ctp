<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Order'), ['action' => 'edit', $purchaseOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Order'), ['action' => 'delete', $purchaseOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseOrders view large-9 medium-8 columns content">
    <h3><?= h($purchaseOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($purchaseOrder->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($purchaseOrder->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Value') ?></th>
            <td><?= h($purchaseOrder->invoice_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latest Invoice') ?></th>
            <td><?= h($purchaseOrder->latest_invoice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($purchaseOrder->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($purchaseOrder->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Currency') ?></th>
            <td><?= h($purchaseOrder->invoice_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landed Price Gbp') ?></th>
            <td><?= h($purchaseOrder->landed_price_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp1 Value Gbp') ?></th>
            <td><?= h($purchaseOrder->sp1_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp2 Value Gbp') ?></th>
            <td><?= h($purchaseOrder->sp2_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp3 Value Gbp') ?></th>
            <td><?= h($purchaseOrder->sp3_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Gbp') ?></th>
            <td><?= h($purchaseOrder->sale_price_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landed Price Eur') ?></th>
            <td><?= h($purchaseOrder->landed_price_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp1 Value Eur') ?></th>
            <td><?= h($purchaseOrder->sp1_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp2 Value Eur') ?></th>
            <td><?= h($purchaseOrder->sp2_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp3 Value Eur') ?></th>
            <td><?= h($purchaseOrder->sp3_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Euro') ?></th>
            <td><?= h($purchaseOrder->sale_price_euro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Import Dates') ?></th>
            <td><?= h($purchaseOrder->import_dates) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseOrder->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Error') ?></h4>
        <?= $this->Text->autoParagraph(h($purchaseOrder->error)); ?>
    </div>
</div>
