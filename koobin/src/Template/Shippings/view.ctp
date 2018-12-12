<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shipping'), ['action' => 'edit', $shipping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shipping'), ['action' => 'delete', $shipping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shippings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shipping'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shippings view large-9 medium-8 columns content">
    <h3><?= h($shipping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($shipping->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($shipping->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shipping Cost') ?></th>
            <td><?= h($shipping->shipping_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shipping->id) ?></td>
        </tr>
    </table>
</div>
