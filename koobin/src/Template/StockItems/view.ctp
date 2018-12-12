<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockItem $stockItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Item'), ['action' => 'edit', $stockItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Item'), ['action' => 'delete', $stockItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Item'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockItems view large-9 medium-8 columns content">
    <h3><?= h($stockItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item Number') ?></th>
            <td><?= h($stockItem->item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Title') ?></th>
            <td><?= h($stockItem->item_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Barcode Number') ?></th>
            <td><?= h($stockItem->barcode_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Name') ?></th>
            <td><?= h($stockItem->category_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supp Name') ?></th>
            <td><?= h($stockItem->supp_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supp Id') ?></th>
            <td><?= h($stockItem->supp_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Heights') ?></th>
            <td><?= h($stockItem->heights) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Widths') ?></th>
            <td><?= h($stockItem->widths) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Depths') ?></th>
            <td><?= h($stockItem->depths) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weights') ?></th>
            <td><?= h($stockItem->weights) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockItem->id) ?></td>
        </tr>
    </table>
</div>
