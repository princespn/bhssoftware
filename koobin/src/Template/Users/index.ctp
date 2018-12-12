<?php
/**
  * @var \App\View\AppView $this
  */
?>

<?php //echo $this->Session->flash(); ?>
<h1 class="sub-header"><?= __('All Users information'); ?></h1>
  <hr>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th><?= $this->Paginator->sort('id') ?></th>
          <th><?= $this->Paginator->sort('username') ?></th>
          <th class="wid-200"><?= $this->Paginator->sort('role') ?></th>
          <th><?= $this->Paginator->sort('email') ?></th>
          <th class="wid-200"><?= $this->Paginator->sort('created') ?></th>
          <th class="wid-200"><?= $this->Paginator->sort('modified') ?></th>
          <th class="wid-70"><?= __('Actions') ?></th>
        </tr>
      </thead>
	  <tbody><?php	foreach ($users as $user): ?>
            <tr>
				<td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
				 <td><?= h($user->role) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
				<td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'users','action'=>'edit',  $user->id),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'users','action' => 'delete',  $user->id), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete User # %s?', true),  $user->username));  ?></td>
        
              
            </tr>
	    <?php endforeach; ?>
		</tbody>
		</table>
</div>		
 
  <nav>
        <ul class="pagination pagination-sm margin-0">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
   </nav>


