<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockItem $stockItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stock Items'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="stockItems form large-9 medium-8 columns content">
    <?= $this->Form->create($stockItem) ?>
    <fieldset>
        <legend><?= __('Edit Stock Item') ?></legend>
        <?php
            echo $this->Form->control('item_number');
            echo $this->Form->control('item_title');
            echo $this->Form->control('barcode_number');
            echo $this->Form->control('category_name');
            echo $this->Form->control('supp_name');
            echo $this->Form->control('supp_id');
            echo $this->Form->control('heights');
            echo $this->Form->control('widths');
            echo $this->Form->control('depths');
            echo $this->Form->control('weights');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
