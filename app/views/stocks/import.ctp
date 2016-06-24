<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="row">
        <div class="col-md-12">
            <div class="panel blue"><h3>Import Master Inventory</h3></div>
        </div>
</div>
   <div class="clearfix"></div>
   <div class="clearfix"></div>
  <div class="row">
  <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Import Master Inventory</h3>
          </div>
		  <?php echo $this->Form->create('InventoryMaster',array('action' => 'import_inventory','enctype'=>'multipart/form-data'));?>
			<div class="row">
			<div class="col-md-12">
			<div class="col-md-6">	
		<?php
		echo $this->Form->input('file', array('label'=>false,'type'=>'file') );
		echo $form->input('user_id', array('type' => 'hidden'));
		$created_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('created_by',array('value'=>$created_by));
		?> 
		</div>
		<div class="col-md-6">	
		<?php 
		echo $this->Form->button('Submit', array('id'=>'submit','disabled'=>'disabled','type'=>'submit'));
		echo $this->Form->button('Reset', array('id'=>'reset','type'=>'reset','enable'=>'enable'));
		?>
		</div>
			</div>
			</div>
			<?php echo $this->Form->end();?>
			<div class="row">
			<div class="col-md-12">
				<?php if (!empty($anything)){ ?>
			<div class="errorSummary">
			<ul> 
			<?php
			$key = $anything['errors'];
			foreach ($key as $value){  ?>
			 <li style="background-color:#dedede;color: #000;list-style-type:none;"><?php  echo $value; ?></li>
			<?php 
			}
			?>
			</ul>
			</div>

			<?php 
			} else {
			?>
			 <div id="progress" style="display: none;"><?php echo $html->image('home2.gif');?></div>
			 <?php } ?>

			</div>
			</div>
</div>
</div>	