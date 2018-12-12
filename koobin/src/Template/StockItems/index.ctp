<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockItem[]|\Cake\Collection\CollectionInterface $stockItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Item'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockItems index large-9 medium-8 columns content">
    <h3><?= __('Stock Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('barcode_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supp_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supp_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('heights') ?></th>
                <th scope="col"><?= $this->Paginator->sort('widths') ?></th>
                <th scope="col"><?= $this->Paginator->sort('depths') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weights') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockItems as $stockItem): ?>
            <tr>
                <td><?= $this->Number->format($stockItem->id) ?></td>
                <td><?= h($stockItem->item_number) ?></td>
                <td><?= h($stockItem->item_title) ?></td>
                <td><?= h($stockItem->barcode_number) ?></td>
                <td><?= h($stockItem->category_name) ?></td>
                <td><?= h($stockItem->supp_name) ?></td>
                <td><?= h($stockItem->supp_id) ?></td>
                <td><?= h($stockItem->heights) ?></td>
                <td><?= h($stockItem->widths) ?></td>
                <td><?= h($stockItem->depths) ?></td>
                <td><?= h($stockItem->weights) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockItem->id)]) ?>
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
