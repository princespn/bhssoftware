<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Channel'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Master Listings'), ['controller' => 'MasterListings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Listing'), ['controller' => 'MasterListings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="channels index large-9 medium-8 columns content">
    <h3><?= __('Channels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('channel_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('channel_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($channels as $channel): ?>
            <tr>
                <td><?= $this->Number->format($channel->id) ?></td>
                <td><?= h($channel->channel_code) ?></td>
                <td><?= h($channel->channel_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $channel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $channel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $channel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $channel->id)]) ?>
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
