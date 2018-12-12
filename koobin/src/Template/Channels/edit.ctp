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
                ['action' => 'delete', $channel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $channel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Channels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Master Listings'), ['controller' => 'MasterListings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Listing'), ['controller' => 'MasterListings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="channels form large-9 medium-8 columns content">
    <?= $this->Form->create($channel) ?>
    <fieldset>
        <legend><?= __('Edit Channel') ?></legend>
        <?php
            echo $this->Form->control('channel_code');
            echo $this->Form->control('channel_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
