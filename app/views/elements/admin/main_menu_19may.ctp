<ul class="nav main">
	<li>
	<?php echo $this->Html->link(__('Inventory Master', true), array('controller' => 'stocks', 'action' => 'index')); ?>
	<ul><?php if($session->read('Auth.User.group_id')=='1') { ?>
		 <li><?php echo $this->Html->link(__('Import Master Inventory', true), array('controller' => 'inventory_masters', 'action' => 'import_inventory')); ?></li>
                <?php } ?>
               <li><?php echo $this->Html->link(__('Manage Master Inventory', true), array('controller' => 'stocks', 'action' => 'index')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Amazon UK Listing', true), array('controller' => 'english_listings', 'action' => 'index')); ?>
		<ul>
			 <li><?php echo $this->Html->link(__('Import UK Listing', true), array('controller' => 'english_listings', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('Update UK Listing', true), array('controller' => 'english_listings', 'action' => 'update')); ?></li>
			 <li><?php echo $this->Html->link(__('Manage UK Listing', true), array('controller' => 'english_listings', 'action' => 'index')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Amazon FR Listing', true), array('controller' => 'france_listings', 'action' => 'index')); ?>
		<ul>
			 <li><?php echo $this->Html->link(__('Import FR Listing', true), array('controller' => 'france_listings', 'action' => 'import')); ?></li>
            <li><?php echo $this->Html->link(__('Update FR Listing', true), array('controller' => 'france_listings', 'action' => 'update')); ?></li>
			 <li><?php echo $this->Html->link(__('Manage FR Listing', true), array('controller' => 'france_listings', 'action' => 'index')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Amazon DE Listing', true), array('controller' => 'german_listings', 'action' => 'index')); ?>
		<ul>
             <li><?php echo $this->Html->link(__('Import DE Listing', true), array('controller' => 'german_listings', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('Update DE Listing', true), array('controller' => 'german_listings', 'action' => 'update')); ?></li>
			 <li><?php echo $this->Html->link(__('Manage DE Listing', true), array('controller' => 'german_listings', 'action' => 'index')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Ebay Listing', true), array('controller' => 'ebayenglish_listings', 'action' => 'index')); ?>
		<ul>
			 <li><?php echo $this->Html->link(__('Import Ebay Listing', true), array('controller' => 'ebayenglish_listings', 'action' => 'import')); ?></li>
             <!--<li><?php echo $this->Html->link(__('Update Ebay Listing', true), array('controller' => 'ebayenglish_listings', 'action' => 'update')); ?></li>-->
			 <li><?php echo $this->Html->link(__('Manage Ebay Listing', true), array('controller' => 'ebayenglish_listings', 'action' => 'index')); ?></li>
    </ul>	
	</li>
	<li>
	<li>
		<?php echo $this->Html->link(__('My Account', true), array('controller' => 'users','action' => 'index'));?>	
	          <ul>
            <li class="green"><?php echo $this->Html->link(__('Users', true), array('controller' => 'users','action' => 'index'));?></li>
			<?php if($session->read('Auth.User.group_id')=='1') { ?>
			<li><?php echo $this->Html->link(__('Add New User', true), array('controller' => 'users', 'action' => 'add')); ?></li>
            <?php } ?>
            <li><a href="<?php echo $this->Html->url('/users/logout', true); ?>">logout</a></li>            
			</ul>
	</li>
	<li style="float:right;"><a href="#"><b>Welcome</b> <?php echo $session->read('Auth.User.username'); ?></a></li>
</ul>