<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLevel[]|\Cake\Collection\CollectionInterface $stockLevels
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Level'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockLevels index large-9 medium-8 columns content">
    <h3><?= __('Stock Levels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('change_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('barcode_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_lev') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_val') ?></th>
                <th scope="col"><?= $this->Paginator->sort('minimum_level') ?></th>
                <th scope="col"><?= $this->Paginator->sort('due_level') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_costs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_itemid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_location_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockLevels as $stockLevel): ?>
            <tr>
                <td><?= $this->Number->format($stockLevel->id) ?></td>
                <td><?= h($stockLevel->change_date) ?></td>
                <td><?= h($stockLevel->item_number) ?></td>
                <td><?= h($stockLevel->item_title) ?></td>
                <td><?= h($stockLevel->barcode_number) ?></td>
                <td><?= h($stockLevel->category_name) ?></td>
                <td><?= h($stockLevel->location_name) ?></td>
                <td><?= h($stockLevel->stock_lev) ?></td>
                <td><?= h($stockLevel->stock_val) ?></td>
                <td><?= h($stockLevel->minimum_level) ?></td>
                <td><?= h($stockLevel->due_level) ?></td>
                <td><?= h($stockLevel->unit_costs) ?></td>
                <td><?= h($stockLevel->stock_itemid) ?></td>
                <td><?= h($stockLevel->stock_location_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockLevel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockLevel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLevel->id)]) ?>
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
