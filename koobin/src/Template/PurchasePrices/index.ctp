<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasePrice[]|\Cake\Collection\CollectionInterface $purchasePrices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Price'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchasePrices index large-9 medium-8 columns content">
    <h3><?= __('Purchase Prices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_itemid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasePrices as $purchasePrice): ?>
            <tr>
                <td><?= $this->Number->format($purchasePrice->id) ?></td>
                <td><?= h($purchasePrice->purchase_id) ?></td>
                <td><?= h($purchasePrice->supplier_id) ?></td>
                <td><?= h($purchasePrice->stock_itemid) ?></td>
                <td><?= h($purchasePrice->item_sku) ?></td>
                <td><?= h($purchasePrice->item_title) ?></td>
                <td><?= h($purchasePrice->invoice_currency) ?></td>
                <td><?= h($purchasePrice->quantity) ?></td>
                <td><?= h($purchasePrice->tax) ?></td>
                <td><?= h($purchasePrice->cost) ?></td>
                <td><?= h($purchasePrice->purchase_price) ?></td>
                <td><?= h($purchasePrice->purchase_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchasePrice->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchasePrice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchasePrice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchasePrice->id)]) ?>
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
