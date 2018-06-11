<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
<title><?php echo $title; ?></title>
<?php echo $this->Html->css(array('bootstrap.min.css','dashboard.css')); ?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php echo $this->element('admin/header'); ?>
<div class="container-fluid">
<?php echo $content_for_layout; ?>
<hr>
<p class="text-muted">Copyright &copy; 2018 Homescapes. All rights reserved.</p>
</div> 
</body>
</html>