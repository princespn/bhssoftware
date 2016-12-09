<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php echo $this->Html->charset(); ?>
<meta name=viewport content="width=device-width, initial-scale=1">
<?php echo $this->Html->meta('keywords','Listing,import');?>
<?php echo $this->Html->meta('description','Inventory Management System');?>
<title><?php echo $title; ?></title>
<?php	echo $this->Html->css(array('ap-scroll-top','cake','bootstrap','nav'));	?>
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
<?php echo $this->Html->script('responsive-tabs.js'); ?>  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
	<div class="container">
	   <div class="dashboards home">
	    <div class="row">
			<div class="col-md-12">
			 <?php echo $this->element('admin/main_menu'); ?>
		</div>
		</div>
	<div class="clearfix"></div>
<div class="clearfix"></div>

			<?php echo $content_for_layout; ?>
	
		<p id="back-top"><a href="#top"><span></span>Back to Top</a></p>
  </div>
</div>	
<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>
</body>
</html>
