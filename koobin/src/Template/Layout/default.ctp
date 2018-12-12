<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Homescapes:';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>-<?php echo $title; ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('dashboard.css') ?>
	<?= $this->Html->script('responsive-tabs.js') ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<script type="text/javascript">
      $(document).ready(function(){//alert('fsdfds');
		$('ul.nav.nav-tabs a').click(function(e){//alert('fdsf');
		e.preventDefault();
		$(this).tab('show');	
	
	});
    
	});
	</script>
</head>
<body>   
<div class="container-fluid">
 <?= $this->element('menu') ?>
 <?= $this->Flash->render() ?>
 <?= $this->fetch('content') ?>
<hr>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php echo $this->Html->script('bootstrap.min.js'); ?> 
<p class="text-muted">Copyright &copy; 2016 Homescapes. All rights reserved.</p>
</div>
</body>
</html>