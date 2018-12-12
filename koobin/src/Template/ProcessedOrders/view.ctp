<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProcessedOrder $processedOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Processed Order'), ['action' => 'edit', $processedOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Processed Order'), ['action' => 'delete', $processedOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $processedOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Processed Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Processed Order'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="processedOrders view large-9 medium-8 columns content">
    <h3><?= h($processedOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order Id') ?></th>
            <td><?= h($processedOrder->order_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($processedOrder->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plateform') ?></th>
            <td><?= h($processedOrder->plateform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subsource') ?></th>
            <td><?= h($processedOrder->subsource) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Value') ?></th>
            <td><?= h($processedOrder->order_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($processedOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Date') ?></th>
            <td><?= h($processedOrder->order_date) ?></td>
        </tr>
    </table>
</div>
