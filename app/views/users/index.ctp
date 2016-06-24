<?php if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='5' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='4') 
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr style="background:#666666;">
			<th><div class="title-text"><?php __('User name');?></div></th>
			<th><div class="title-text"><?php __('Group');?></div></th>
			<th><div class="title-text"><?php __('Email Address');?></div></th>
			<th><div class="title-text"><?php __('Date Create');?></div></th>
			<th align="right" style="color:#000;"><?php // __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<?php 
if($session->read('Auth.User.group_id')!='1'){

if(($session->read('Auth.User.group_id')=='2') && ($user['User']['group_id'] !='1') && ($user['User']['group_id'] !='4') &&($user['User']['group_id'] !='3'))
{ ?>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>

		<td>
			<?php echo $user['Group']['name']; ?>
		</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php // echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			
		</td>
		
	<?php }
if(($session->read('Auth.User.group_id')=='4') && ($user['User']['group_id'] !='1') && ($user['User']['group_id'] !='2') &&($user['User']['group_id'] !='6') &&($user['User']['group_id'] !='7') &&($user['User']['group_id'] !='5'))
		{ ?> 
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>

		<td>
			<?php echo $user['Group']['name']; ?>
		</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php // echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			
		</td>
	<?php }

	}

	 else
	{
	?>

		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		
		<td>
			<?php echo $user['Group']['name']; ?>
		</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td>
		<?php
		echo $this->Html->link($this->Html->image('edit.jpg'), array('action' => 'edit', $user['User']['id']), array('escape' => false));
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $this->Html->link($this->Html->image('delete.jpg'), array('action' => 'delete', $user['User']['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['username'])); 
		//$size = array(''=>'Select','/users/edit/'.$user['User']['id']=>'Edit','/users/delete/'.$user['User']['id']=>'Delete');
			
			//echo $this->Form->input('', array('id'=>'usersid','type'=>'select','label' => '','options' =>$size));
		 ?>
		</td>
		
<?php } ?>
	
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></div><div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<script type="text/javascript">
   $(document).ready( function() {
      // bind change event to select
      $('#usersid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>