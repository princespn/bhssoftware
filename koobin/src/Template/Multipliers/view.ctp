<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Multiplier'), ['action' => 'edit', $multiplier->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Multiplier'), ['action' => 'delete', $multiplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multiplier->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Multipliers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multiplier'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="multipliers view large-9 medium-8 columns content">
    <h3><?= h($multiplier->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($multiplier->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($multiplier->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Multiplier') ?></th>
            <td><?= h($multiplier->multiplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($multiplier->id) ?></td>
        </tr>
    </table>
</div>
