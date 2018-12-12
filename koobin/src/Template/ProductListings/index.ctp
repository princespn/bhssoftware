<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product Listing'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="productListings index large-9 medium-8 columns content">
    <h3><?= __('Product Listings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_asin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fulfillmentchannel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('web_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productListings as $productListing): ?>
            <tr>
                <td><?= $this->Number->format($productListing->id) ?></td>
                <td><?= h($productListing->product_sku) ?></td>
                <td><?= h($productListing->product_code) ?></td>
                <td><?= h($productListing->product_asin) ?></td>
                <td><?= h($productListing->fulfillmentchannel) ?></td>
                <td><?= h($productListing->web_sku) ?></td>
                <td><?= h($productListing->category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $productListing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productListing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productListing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productListing->id)]) ?>
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
