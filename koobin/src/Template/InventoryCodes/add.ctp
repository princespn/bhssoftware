<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Inventory Codes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="inventoryCodes form large-9 medium-8 columns content">
    <?= $this->Form->create($inventoryCode) ?>
    <fieldset>
        <legend><?= __('Add Inventory Code') ?></legend>
        <?php
            echo $this->Form->control('linnworks_code');
            echo $this->Form->control('product_name');
            echo $this->Form->control('category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
