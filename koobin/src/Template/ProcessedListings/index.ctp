<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProcessedListing[]|\Cake\Collection\CollectionInterface $processedListings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Processed Listing'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="processedListings index large-9 medium-8 columns content">
    <h3><?= __('Processed Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plateform') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subsource') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cat_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_per_product') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($processedListings as $processedListing): ?>
            <tr>
                <td><?= $this->Number->format($processedListing->id) ?></td>
                <td><?= h($processedListing->order_id) ?></td>
                <td><?= h($processedListing->order_date) ?></td>
                <td><?= h($processedListing->currency) ?></td>
                <td><?= h($processedListing->plateform) ?></td>
                <td><?= h($processedListing->subsource) ?></td>
                <td><?= h($processedListing->cat_name) ?></td>
                <td><?= h($processedListing->product_sku) ?></td>
                <td><?= h($processedListing->product_name) ?></td>
                <td><?= $this->Number->format($processedListing->quantity) ?></td>
                <td><?= h($processedListing->price_per_product) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $processedListing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $processedListing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $processedListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $processedListing->id)]) ?>
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
