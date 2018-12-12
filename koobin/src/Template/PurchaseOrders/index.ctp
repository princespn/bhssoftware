<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOrders index large-9 medium-8 columns content">
    <h3><?= __('Purchase Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('linnworks_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latest_invoice') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landed_price_gbp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp1_value_gbp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp2_value_gbp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp3_value_gbp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_price_gbp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landed_price_eur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp1_value_eur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp2_value_eur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp3_value_eur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale_price_euro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('import_dates') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseOrders as $purchaseOrder): ?>
            <tr>
                <td><?= $this->Number->format($purchaseOrder->id) ?></td>
                <td><?= h($purchaseOrder->linnworks_code) ?></td>
                <td><?= h($purchaseOrder->product_name) ?></td>
                <td><?= h($purchaseOrder->invoice_value) ?></td>
                <td><?= h($purchaseOrder->latest_invoice) ?></td>
                <td><?= h($purchaseOrder->category) ?></td>
                <td><?= h($purchaseOrder->supplier) ?></td>
                <td><?= h($purchaseOrder->invoice_currency) ?></td>
                <td><?= h($purchaseOrder->landed_price_gbp) ?></td>
                <td><?= h($purchaseOrder->sp1_value_gbp) ?></td>
                <td><?= h($purchaseOrder->sp2_value_gbp) ?></td>
                <td><?= h($purchaseOrder->sp3_value_gbp) ?></td>
                <td><?= h($purchaseOrder->sale_price_gbp) ?></td>
                <td><?= h($purchaseOrder->landed_price_eur) ?></td>
                <td><?= h($purchaseOrder->sp1_value_eur) ?></td>
                <td><?= h($purchaseOrder->sp2_value_eur) ?></td>
                <td><?= h($purchaseOrder->sp3_value_eur) ?></td>
                <td><?= h($purchaseOrder->sale_price_euro) ?></td>
                <td><?= h($purchaseOrder->import_dates) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseOrder->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseOrder->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
