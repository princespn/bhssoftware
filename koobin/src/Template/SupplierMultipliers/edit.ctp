<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $supplierMultiplier->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $supplierMultiplier->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Supplier Multipliers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="supplierMultipliers form large-9 medium-8 columns content">
    <?= $this->Form->create($supplierMultiplier) ?>
    <fieldset>
        <legend><?= __('Edit Supplier Multiplier') ?></legend>
        <?php
            echo $this->Form->control('category');
            echo $this->Form->control('invoice_currency');
            echo $this->Form->control('supplier');
            echo $this->Form->control('sp1_multiplier');
            echo $this->Form->control('sp2_multiplier');
            echo $this->Form->control('sp3_multiplier');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
