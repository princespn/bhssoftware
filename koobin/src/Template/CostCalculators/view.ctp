<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CostCalculator $costCalculator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cost Calculator'), ['action' => 'edit', $costCalculator->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cost Calculator'), ['action' => 'delete', $costCalculator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $costCalculator->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cost Calculators'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cost Calculator'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="costCalculators view large-9 medium-8 columns content">
    <h3><?= h($costCalculator->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linnworks Code') ?></th>
            <td><?= h($costCalculator->linnworks_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($costCalculator->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($costCalculator->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($costCalculator->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Currency') ?></th>
            <td><?= h($costCalculator->invoice_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landed Price Gbp') ?></th>
            <td><?= h($costCalculator->landed_price_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp1 Value Gbp') ?></th>
            <td><?= h($costCalculator->sp1_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp2 Value Gbp') ?></th>
            <td><?= h($costCalculator->sp2_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp3 Value Gbp') ?></th>
            <td><?= h($costCalculator->sp3_value_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Gbp') ?></th>
            <td><?= h($costCalculator->sale_price_gbp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landed Price Eur') ?></th>
            <td><?= h($costCalculator->landed_price_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp1 Value Eur') ?></th>
            <td><?= h($costCalculator->sp1_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp2 Value Eur') ?></th>
            <td><?= h($costCalculator->sp2_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sp3 Value Eur') ?></th>
            <td><?= h($costCalculator->sp3_value_eur) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price Euro') ?></th>
            <td><?= h($costCalculator->sale_price_euro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Import Dates') ?></th>
            <td><?= h($costCalculator->import_dates) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($costCalculator->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Error') ?></h4>
        <?= $this->Text->autoParagraph(h($costCalculator->error)); ?>
    </div>
</div>
