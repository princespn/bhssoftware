<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesChannel $salesChannel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesChannel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesChannel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Channels'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="salesChannels form large-9 medium-8 columns content">
    <?= $this->Form->create($salesChannel) ?>
    <fieldset>
        <legend><?= __('Edit Sales Channel') ?></legend>
        <?php
            echo $this->Form->control('channel_code');
            echo $this->Form->control('channel_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
