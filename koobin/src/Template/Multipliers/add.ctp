<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Multipliers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="multipliers form large-9 medium-8 columns content">
    <?= $this->Form->create($multiplier) ?>
    <fieldset>
        <legend><?= __('Add Multiplier') ?></legend>
        <?php
            echo $this->Form->control('category');
            echo $this->Form->control('supplier');
            echo $this->Form->control('multiplier');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
