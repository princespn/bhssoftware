<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php echo $this->Html->charset(); ?>
<meta name=viewport content="width=device-width, initial-scale=1">
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
<title><?php echo $title; ?></title>
<?php echo $this->Html->css(array('bootstrap.min.css','dashboard.css')); ?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<?php echo $this->Html->script('responsive-tabs.js'); ?>
<?php echo $this->Html->script('jquery.fancybox.pack.js'); ?>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
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
<?php echo $this->element('admin/main_menu'); ?>
<div class="container-fluid">
<?php echo $content_for_layout; ?>
<p id="back-top"><a href="#top"><span></span>Back to Top</a></p>
<hr>
<p class="text-muted">Copyright &copy; 2016 Homescapes. All rights reserved.</p>
</div>
<?php //echo $this->element('admin/adduser'); ?>
<script>
$(document).ready(function(){
	$('#FranceProductListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script> 
<script>
$(document).ready(function(){
	$('#InventoryMasterFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#EnglishListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#ProductListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script type="text/javascript">
$.noConflict();
   $(document).ready( function() {
            $('.checkbox1').change(function () {
                if ($(this).is(":checked")) {
                    $('div.btnClick').show();
                }
                else {
                    var isChecked = false;
                    $('.checkbox1').each(function () {
                        if ($(this).is(":checked")) {
                             $('div.btnClick').show();
                            isChecked = true;
                        }
                    });
                    if (!isChecked) {
                        $('div.btnClick').hide();
                    }
                }
 
 
            })
        });
</script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php echo $this->Html->script('bootstrap.min.js'); ?>   
<?php  // echo $this->element('sql_dump'); ?>
</body>
</html>