<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProcessedOrder $processedOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Processed Orders'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="processedOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($processedOrder) ?>
    <fieldset>
        <legend><?= __('Add Processed Order') ?></legend>
        <?php
            echo $this->Form->control('order_id');
            echo $this->Form->control('order_date');
            echo $this->Form->control('currency');
            echo $this->Form->control('plateform');
            echo $this->Form->control('subsource');
            echo $this->Form->control('order_value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
