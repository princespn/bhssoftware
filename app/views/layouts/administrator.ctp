<!DOCTYPE html>
<head>
<?php echo $this->Html->charset('ISO-8859-1'); ?>
<meta name=viewport content="width=device-width, initial-scale=1">
<?php echo $this->Html->meta('keywords','Listing,import');?>
<?php echo $this->Html->meta('description','Inventory Management System');?>
<title><?php __('Inventory Management'); ?> <?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('text', 'grid', 'layout', 'nav'));
		echo $scripts_for_layout;
	?>
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
</head>
<body>
	<div class="container_16">			
		<div class="grid_16">
			<h1 id="branding">
			<?php echo $this->Html->link(__('Inventory Management', true), array('controller' => 'users', 'action' => 'login')); ?>
				
			</h1>
		
		<div class="clear"></div>				
		<div class="clear" style="height: 10px; width: 100%;"></div>
		
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>
		
		<div class="clear"></div>
	</div>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
