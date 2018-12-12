<nav class="navbar">
  <div class="container-fluid">
     <ul class="nav navbar-nav">   
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Prices
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	         <li><?php echo $this->Html->link(__('Master Prices', true), array('controller' => 'master-listings', 'action' => 'index')); ?></li>
	   		 <li><?php echo $this->Html->link(__('Website Prices', true), array('controller' => 'admin-listings', 'action' => 'index')); ?></li>
	         <li><?php echo $this->Html->link(__('Amazon Prices', true), array('controller' => 'master-listings', 'action' => 'index_prices')); ?></li>
	         <li><?php echo $this->Html->link(__('Upload New Code', true), array('controller' => 'inventory-codes', 'action' => 'index')); ?></li>
	         <li><?php echo $this->Html->link(__('Cost Calculator', true), array('controller' => 'cost-calculators', 'action' => 'index')); ?></li>
	         <li><?php echo $this->Html->link(__('Cost Settings', true), array('controller' => 'cost-calculators', 'action' => 'settings')); ?></li>
	         </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Diagnosis Prices
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	        <li><?php echo $this->Html->link(__('Diagnosis Prices', true), array('controller' => 'main-listings', 'action' => 'index')); ?></li>
	        <li><?php echo $this->Html->link(__('Website Prices', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
	        <li><?php echo $this->Html->link(__('Amazon Prices', true), array('controller' => 'main-listings', 'action' => 'index_prices')); ?></li>
	        </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sales Per Channels
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	    	  <li><?php echo $this->Html->link(__('Evolution Weekly', true), array('controller' => 'processed-orders', 'action' => 'channel_weekly')); ?></li>
	    	  <li><?php echo $this->Html->link(__('Evolution Monthly', true), array('controller' => 'processed_listings', 'action' => 'category_monthly')); ?></li>
	    	  <li><?php echo $this->Html->link(__('Evolution Periodic', true), array('controller' => 'processed-orders', 'action' => 'selection_periods')); ?></li>
	   		 </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sales Per Category
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	        <li><?php echo $this->Html->link(__('Evolution Weekly', true), array('controller' => 'processed-listings', 'action' => 'category_weekly')); ?></li>
	        <li><?php echo $this->Html->link(__('Evolution Monthly', true), array('controller' => 'processed-listings', 'action' => 'category_monthly')); ?></li>
	        <li><?php echo $this->Html->link(__('Evolution Periodic', true), array('controller' => 'processed-listings', 'action' => 'selection_categories')); ?></li>
	        </ul>
      </li>
      
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sales Product SKU
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	        <li><?php echo $this->Html->link(__('Evolution Weekly', true), array('controller' => 'processed-listings', 'action' => 'productsku_weekly')); ?></li>
	        <li><?php echo $this->Html->link(__('Evolution Monthly', true), array('controller' => 'processed-listings', 'action' => 'productsku_monthly')); ?></li>
	       </ul>
      </li>
      
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stock Report
        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	        <li><?php echo $this->Html->link(__('Report By Items', true), array('controller' => 'stock-items', 'action' => 'index')); ?></li>
	        <li><?php echo $this->Html->link(__('Report By Category', true), array('controller' => 'stock-levels', 'action' => 'stock_category')); ?></li>
	       </ul>
      </li>
    
    </ul>
  </div>
</nav>