<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Supplier Multiplier'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supplierMultipliers index large-9 medium-8 columns content">
    <h3><?= __('Supplier Multipliers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp1_multiplier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp2_multiplier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sp3_multiplier') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplierMultipliers as $supplierMultiplier): ?>
            <tr>
                <td><?= $this->Number->format($supplierMultiplier->id) ?></td>
                <td><?= h($supplierMultiplier->category) ?></td>
                <td><?= h($supplierMultiplier->supplier) ?></td>
                <td><?= h($supplierMultiplier->sp1_multiplier) ?></td>
                <td><?= h($supplierMultiplier->sp2_multiplier) ?></td>
                <td><?= h($supplierMultiplier->sp3_multiplier) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $supplierMultiplier->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplierMultiplier->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplierMultiplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierMultiplier->id)]) ?>
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
