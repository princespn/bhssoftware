<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CostCalculator $costCalculator
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cost Calculators'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="costCalculators form large-9 medium-8 columns content">
    <?= $this->Form->create($costCalculator) ?>
    <fieldset>
        <legend><?= __('Add Cost Calculator') ?></legend>
        <?php
            echo $this->Form->control('linnworks_code');
            echo $this->Form->control('product_name');
            echo $this->Form->control('category');
            echo $this->Form->control('supplier');
            echo $this->Form->control('invoice_currency');
            echo $this->Form->control('landed_price_gbp');
            echo $this->Form->control('sp1_value_gbp');
            echo $this->Form->control('sp2_value_gbp');
            echo $this->Form->control('sp3_value_gbp');
            echo $this->Form->control('sale_price_gbp');
            echo $this->Form->control('landed_price_eur');
            echo $this->Form->control('sp1_value_eur');
            echo $this->Form->control('sp2_value_eur');
            echo $this->Form->control('sp3_value_eur');
            echo $this->Form->control('sale_price_euro');
            echo $this->Form->control('import_dates');
            echo $this->Form->control('error');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
