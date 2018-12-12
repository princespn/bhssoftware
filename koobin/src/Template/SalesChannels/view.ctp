<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesChannel $salesChannel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Channel'), ['action' => 'edit', $salesChannel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Channel'), ['action' => 'delete', $salesChannel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesChannel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Channels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Channel'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesChannels view large-9 medium-8 columns content">
    <h3><?= h($salesChannel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Channel Code') ?></th>
            <td><?= h($salesChannel->channel_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Channel Name') ?></th>
            <td><?= h($salesChannel->channel_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesChannel->id) ?></td>
        </tr>
    </table>
</div>
