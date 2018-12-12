<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cost Settings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="costSettings form large-9 medium-8 columns content">
    <?= $this->Form->create($costSetting) ?>
    <fieldset>
        <legend><?= __('Add Cost Setting') ?></legend>
        <?php
            echo $this->Form->control('sale_base_currency');
            echo $this->Form->control('invoice_currency');
            echo $this->Form->control('exchange_rate');
            echo $this->Form->control('variation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
