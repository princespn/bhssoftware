<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inventory Code'), ['action' => 'edit', $inventoryCode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inventory Code'), ['action' => 'delete', $inventoryCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryCode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Codes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Code'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inventoryCodes view large-9 medium-8 columns content">
    <h3><?= h($inventoryCode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($inventoryCode->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($inventoryCode->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($inventoryCode->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventoryCode->id) ?></td>
        </tr>
    </table>
</div>
