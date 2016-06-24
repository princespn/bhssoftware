<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>


<div class="imports form">
<?php 
echo $this->Form->create('EnglishListing',array('action' => 'import','enctype'=>'multipart/form-data'));?>
<fieldset>
<legend><?php __('Import UK Listing'); ?></legend>
<?php
echo $this->Form->input('file', array('label'=>'Import UK listing','type'=>'file') );
echo $form->input('user_id', array('type' => 'hidden'));

$created_by = $session->read('Auth.User.username');

echo $this->Form->hidden('created_by',array('value'=>$created_by));
?> 

</fieldset>
<div class='submit'>
<?php 
echo $this->Form->button('Import the listing', array('id'=>'submit','disabled'=>'disabled','type'=>'submit'));
?>
</div>
<?php
echo $this->Form->end();?>
<?php 
if (!empty($anything)){ ?>
<div class="errorSummary">
<ul>
<?php
$key = $anything['errors']; if(!empty($key)):?>
<table style="width:100%">
  <tr style="background-color:#dedede">
    <td>Error</td>    
    <td>SKU</td>
  </tr> 

<?php endif; $str = 0;
foreach ($key as $value){  ?>
<li style="background-color:#dedede;color: #000;list-style-type:none;">
 <?php if(!empty($value)): ?>
  <tr>   
    <td><?php $res = explode(":", $value);
	if($str !== $res[1]){echo $res[1];$str = $res[1];} ?></td>
    <td><?php $res1 = explode("sku", $res[0]);
	echo $res1[1]; ?></td>
  </tr>
  <?php endif ?>
</li>
<?php 
}
?>
</table>
</ul>
</div>
<?php 
} else {
?>
<div id="progress" style="display: none;"><?php echo $html->image('home2.gif');?></div>
<?php } ?>

</div>
<?php // echo $this->element('admin_sidebar'); 
?> 
