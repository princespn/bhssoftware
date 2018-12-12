<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Supplier Multiplier'), ['action' => 'edit', $supplierMultiplier->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Supplier Multiplier'), ['action' => 'delete', $supplierMultiplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierMultiplier->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Supplier Multipliers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier Multiplier'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="supplierMultipliers view large-9 medium-8 columns content">
    <h3><?= h($supplierMultiplier->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($supplierMultiplier->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($supplierMultiplier->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp1 Multiplier') ?></th>
            <td><?= h($supplierMultiplier->sp1_multiplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp2 Multiplier') ?></th>
            <td><?= h($supplierMultiplier->sp2_multiplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp3 Multiplier') ?></th>
            <td><?= h($supplierMultiplier->sp3_multiplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($supplierMultiplier->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Invoice Currency') ?></h4>
        <?= $this->Text->autoParagraph(h($supplierMultiplier->invoice_currency)); ?>
    </div>
</div>
