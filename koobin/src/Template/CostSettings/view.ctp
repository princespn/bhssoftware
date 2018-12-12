<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cost Setting'), ['action' => 'edit', $costSetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cost Setting'), ['action' => 'delete', $costSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $costSetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cost Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cost Setting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="costSettings view large-9 medium-8 columns content">
    <h3><?= h($costSetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sale Base Currency') ?></th>
            <td><?= h($costSetting->sale_base_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Currency') ?></th>
            <td><?= h($costSetting->invoice_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exchange Rate') ?></th>
            <td><?= h($costSetting->exchange_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($costSetting->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variation') ?></th>
            <td><?= $this->Number->format($costSetting->variation) ?></td>
        </tr>
    </table>
</div>
