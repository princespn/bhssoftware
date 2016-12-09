<ul class="nav main">
    <li>
        <?php echo $this->Html->link(__('Master Listing', true), array('controller' => 'stocks', 'action' => 'index/?page=1')); ?>
       
           <ul>
           <li><?php echo $this->Html->link(__('Website Prices', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link(__('Amazon Prices', true), array('controller' => 'main_listings', 'action' => 'index')); ?></li>
           </ul>
           </li>
           <li>
               
           <?php echo $this->Html->link(__('UK Product Code', true), array('controller' => 'product_listings', 'action' => 'index')); ?>
           
          <ul>
	    <li><?php echo $this->Html->link(__('UK Product Code', true), array('controller' => 'product_listings', 'action' => 'index')); ?></li>
             <li><?php echo $this->Html->link(__('FR Product Code', true), array('controller' => 'france_product_listings', 'action' => 'index')); ?></li>
             <li><?php echo $this->Html->link(__('DE Product Code', true), array('controller' => 'german_product_listings', 'action' => 'index')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Master UK Listing', true), array('controller' => 'inventory_masters', 'action' => 'index')); ?>
		<ul>
		<li><?php echo $this->Html->link(__('Import Listing', true), array('controller' => 'inventory_masters', 'action' => 'import')); ?></li>
		<li><?php echo $this->Html->link(__('Update Listing', true), array('controller' => 'inventory_masters', 'action' => 'update')); ?></li>
		</ul>	
	</li>	
	<li>
	<?php echo $this->Html->link(__('Amazon UK Listing', true), array('controller' => 'english_listings', 'action' => 'index')); ?>
		<ul>
			 <li><?php echo $this->Html->link(__('Import UK Listing', true), array('controller' => 'english_listings', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('Update UK Listing', true), array('controller' => 'english_listings', 'action' => 'update')); ?></li>
		</ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('FR Product Code', true), array('controller' => 'france_product_listings', 'action' => 'index')); ?>
		<ul>
		<li><?php echo $this->Html->link(__('Import Product code', true), array('controller' => 'france_product_listings', 'action' => 'importcode')); ?></li>
        </ul>	
	</li>
	<li>
	<?php echo $this->Html->link(__('Master FR Listing', true), array('controller' => 'france_master_listings', 'action' => 'index')); ?>
		<ul>
		<li><?php echo $this->Html->link(__('Import Listing', true), array('controller' => 'france_master_listings', 'action' => 'import')); ?></li>
		<li><?php echo $this->Html->link(__('Update Listing', true), array('controller' => 'france_master_listings', 'action' => 'update')); ?></li>
		</ul>	
	</li>
        	<li>
	<?php echo $this->Html->link(__('Amazon FR Listing', true), array('controller' => 'france_listings', 'action' => 'index')); ?>
		<ul>
			 <li><?php echo $this->Html->link(__('Import FR Listing', true), array('controller' => 'france_listings', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('Update FR Listing', true), array('controller' => 'france_listings', 'action' => 'update')); ?></li>
		</ul>	
	</li>
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