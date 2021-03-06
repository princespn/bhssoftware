<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Shippings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="shippings form large-9 medium-8 columns content">
    <?= $this->Form->create($shipping) ?>
    <fieldset>
        <legend><?= __('Add Shipping') ?></legend>
        <?php
            echo $this->Form->control('category');
            echo $this->Form->control('country');
            echo $this->Form->control('shipping_cost');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
