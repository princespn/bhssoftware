<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLevel $stockLevel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Levels'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="stockLevels form large-9 medium-8 columns content">
    <?= $this->Form->create($stockLevel) ?>
    <fieldset>
        <legend><?= __('Add Stock Level') ?></legend>
        <?php
            echo $this->Form->control('change_date');
            echo $this->Form->control('item_number');
            echo $this->Form->control('item_title');
            echo $this->Form->control('barcode_number');
            echo $this->Form->control('category_name');
            echo $this->Form->control('location_name');
            echo $this->Form->control('stock_lev');
            echo $this->Form->control('stock_val');
            echo $this->Form->control('minimum_level');
            echo $this->Form->control('due_level');
            echo $this->Form->control('unit_costs');
            echo $this->Form->control('stock_itemid');
            echo $this->Form->control('stock_location_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
