<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<?php echo $this->Html->charset(); ?>
<meta name=viewport content="width=device-width, initial-scale=1">
<?php echo $this->Html->meta('keywords','Listing,import');?>
<?php echo $this->Html->meta('description','Inventory Management System');?>
<title><?php __('Inventory Management'); ?> <?php echo $title_for_layout; ?></title>
		<?php
		echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('ap-scroll-top','text', 'grid', 'layout', 'nav'));
		//echo $this->Html->script(array('jquery-1.3.2.min.js', 'jquery-ui.js', 'jquery-fluid16.js'));
		//echo $scripts_for_layout;
	?>
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
<!--<?php //echo $this->Html->script('scripts'); echo $this->Html->script('jquery-1.11.1.min');?>-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#GermanProductListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#GermanMasterListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#GermanListingFile').change(function(){
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
</head>
<body>
	<div class="container_16">			
		<div class="grid_16">
			<h1 id="branding">
			<?php echo $this->Html->link(__('Inventory Management', true), array('controller' => 'german_listings', 'action' => 'index')); ?>
				
			</h1>
		</div>
		<div class="grid_16">
			 <?php echo $this->element('admin/main_menu'); ?>
		
		
		<div class="clear" style="height: 10px; width: 100%;"></div>
		<h2 id="page-heading"><?php echo $this->Session->flash(); ?></h2>
			

			<?php echo $content_for_layout; ?>
		
		</div>
            <p id="back-top"><a href="#top"><span></span>Back to Top</a></p>
	</div>
	<?php  // echo $this->element('sql_dump'); ?>
</body>
</html>
