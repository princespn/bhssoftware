<!-- Navigation Start -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
      	<span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.html" class="navbar-brand"> <?php echo $this->Html->image('hs-logo.svg', array('width' => '200px','alt'=>'')); ?></div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><?php echo $this->Html->link(__('Master Listing', true), array('controller' => 'stocks', 'action' => 'index/?page=1')); ?></li>
                <li><?php echo $this->Html->link(__('Website Prices', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Amazon Prices', true), array('controller' => 'main_listings', 'action' => 'index')); ?></li>
            </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Product Code <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo $this->Html->link(__('UK Product Code', true), array('controller' => 'product_listings', 'action' => 'index')); ?></li>
             <li><?php echo $this->Html->link(__('FR Product Code', true), array('controller' => 'france_product_listings', 'action' => 'index')); ?></li>
             <li><?php echo $this->Html->link(__('DE Product Code', true), array('controller' => 'german_product_listings', 'action' => 'index')); ?></li>
        </ul>           
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master UK Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><?php echo $this->Html->link(__('Import Master UK Listing', true), array('controller' => 'inventory_masters', 'action' => 'import')); ?></li>
            <li><?php echo $this->Html->link(__('Update Master UK Listing', true), array('controller' => 'inventory_masters', 'action' => 'update')); ?></li>
		<!--<li><a href="#" data-toggle="modal" data-target="#myModal">Import Master UK Listing</a></li>-->           
          </ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon UK Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li><?php echo $this->Html->link(__('Import Amazon UK Listing', true), array('controller' => 'english_listings', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('Update Amazon UK Listing', true), array('controller' => 'english_listings', 'action' => 'update')); ?></li>
		
	</ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master FR Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><?php echo $this->Html->link(__('Import Master FR Listing', true), array('controller' => 'france_master_listings', 'action' => 'import')); ?></li>
	<li><?php echo $this->Html->link(__('Update Master FR Listing', true), array('controller' => 'france_master_listings', 'action' => 'update')); ?></li>
	</ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon FR Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><?php echo $this->Html->link(__('Import Amazon FR Listing', true), array('controller' => 'france_listings', 'action' => 'import')); ?></li>
          <li><?php echo $this->Html->link(__('Update Amazon FR Listing', true), array('controller' => 'france_listings', 'action' => 'update')); ?></li>
	</ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Master DE Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><?php echo $this->Html->link(__('Import Master DE Listing', true), array('controller' => 'german_master_listings', 'action' => 'import')); ?></li>
            <li><?php echo $this->Html->link(__('Update Master DE Listing', true), array('controller' => 'german_master_listings', 'action' => 'update')); ?></li>
	</ul>
        </li>
        <li class="dropdown"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Amazon DE Listing <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><?php echo $this->Html->link(__('Import Amazon DE Listing', true), array('controller' => 'german_listings', 'action' => 'import')); ?></li>
           <li><?php echo $this->Html->link(__('Update Amazon DE Listing', true), array('controller' => 'german_listings', 'action' => 'update')); ?></li>
	</ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">My Account <b class="caret"></b></a> <span class="dropdown-arrow dropdown-arrow-inverse"></span>
          <ul class="dropdown-menu dropdown-inverse">
            <li><?php echo $this->Html->link(__('Users', true), array('controller' => 'users','action' => 'index'));?></li>
			<?php if($session->read('Auth.User.group_id')=='1') { ?>
			<li><?php echo $this->Html->link(__('Add New User', true), array('controller' => 'users', 'action' => 'add')); ?></li>
            <?php } ?>
            <li><a href="<?php echo $this->Html->url('/users/logout', true); ?>">logout</a></li>            
            
            
            <!--<li><a href="#" data-toggle="modal" data-target="#addNewuser">Add New User</a></li>-->
            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- / Navigation Start -->