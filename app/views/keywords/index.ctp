<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="keywords index"><div class="grid_16">
<h2 id="page-heading"><?php __('keywords UK Listing');?></h2>
<table cellpadding="0" cellspacing="0">
	<tr style="color:#ffffff;">
	<th colspan="1"></th>	
	</tr>
	<tr style="background:#666666;color:#ffffff;">				
			<th style="width:90px;"><a class="checkall" href="#">Check All</a><?php echo ' | ' ; ?> <a class="uncheckall" href="#">Uncheck All</a></th>
			<th><div class="title-text"><?php __('Image');?></div></th>
			<th><div class="title-text"><?php __('Product Code');?></th>
                        <th><?php __('SKU');?></th>
			<th><div class="title-text"><?php __('Product name');?></th>
			<th><div class="title-text"><?php __('Available');?></th>
			<th><div class="title-text"><?php __('Price');?></th>
			<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
	</tr>
	</table>

<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<script type="text/javascript">
   $(document).ready( function() {
      // bind change event to select
      $('#projectsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>