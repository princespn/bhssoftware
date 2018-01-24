<?php 
if($session->read('Auth.User.group_id')!='4')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('All Groups information'); ?></h1>
  <hr>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
       <tr>
           <th></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Group name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th style="color:#000;" align="center"><?php __('Actions');?></th>
	</tr>
      </thead>
      <tbody><?php foreach ($groups as $group): ?>
        <tr>
          <td></td>
          <td><?php echo $group['Group']['id']; ?>&nbsp;</td>
		<td><?php echo $group['Group']['name']; ?>&nbsp;</td>
		<td><?php echo $group['Group']['created']; ?>&nbsp;</td>
		<td><?php echo $group['Group']['modified']; ?>&nbsp;</td>
		<td class="actions">
                    <?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'groups','action'=>'edit', $group['Group']['id']),array('class'=> 'edit-btn','escape'=>false)); ?>
                    </td>     
        </tr>
       <?php endforeach; ?>     
      </tbody>
    </table>
  </div>
  <p><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
 <nav>
     <ul class="pagination pagination-sm margin-0">
         <li><?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?></li>
         <li><?php echo $this->Paginator->numbers();?></li>
         <li><?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?></li>
     </ul>
 </nav>
 
  