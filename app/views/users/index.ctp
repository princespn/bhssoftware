<?php if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='3' && $session->read('Auth.User.group_id')!='4') 
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<hr>
<?php echo $this->Session->flash(); ?>
<h1 class="sub-header"><?php __('All Users information'); ?></h1>
  <hr>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>        
        <tr>
          <th class="wid-20">#</th>
          <th>User name</th>
          <th class="wid-200">Group</th>
          <th>Email Address</th>
          <th class="wid-200">Date</th>
          <th class="wid-200">Time</th>
          <th class="wid-70">Action</th>
        </tr>
      </thead>
      <tbody><?php	foreach ($users as $user): ?>
        <tr>
     <?php if($session->read('Auth.User.group_id')!='1'){
                if(($session->read('Auth.User.group_id')=='2') && ($user['User']['group_id'] !='1') && ($user['User']['group_id'] !='4') &&($user['User']['group_id'] !='3')){ ?>
            <td><?php echo $user['User']['id']; ?></td>
             <td class="text-capitalize"><?php echo $user['User']['username']; ?></td>
             <td><?php echo $user['Group']['name']; ?></td>
             <td><?php echo $user['User']['email']; ?></td>
             <td><?php echo $user['User']['created']; ?></td>
             <td><?php echo $user['User']['created']; ?></td>
             <?php } ?>
             <?php } else { ?>        
             <td><?php echo $user['User']['id']; ?></td>
             <td class="text-capitalize"><?php echo $user['User']['username']; ?></td>
             <td><?php echo $user['Group']['name']; ?></td>
             <td><?php echo $user['User']['email']; ?></td>
            <td><?php echo $user['User']['created']; ?></td>
            <td><?php echo $user['User']['created']; ?></td>
            <td><?php echo $this->Html->link('<i aria-hidden="true" class="fa fa-edit"></i>',array('controller'=>'users','action'=>'edit', $user['User']['id']),array('class'=> 'edit-btn','escape'=>false)); echo $this->Html->link('<i aria-hidden="true" class="fa fa-close"></i>', array('controller'=>'users','action' => 'delete', $user['User']['id']), array('class'=> 'delete-btn','escape' => false), sprintf(__('Are you sure you want to delete User # %s?', true), $user['User']['username']));  ?></td>
        <?php } ?>    
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

 