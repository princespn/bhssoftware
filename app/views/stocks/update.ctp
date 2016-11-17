<?php 
if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
 <h1 class="sub-header"><?php __('Linnworks Listing Basic Inventory Information');?></h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 mobile-bottomspace">
        </div>
        <div class="col-md-4">
          <div class="form-group margin-bottom-0">            
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
     <thead>
        <tr>
        <th colspan="4">
         <?php if(!empty($imagds[0]->Source)): ?>
		<img src="<?php echo $imagds[0]->Source; ?>" title="<?php echo $imagds[0]->Source; ?>"/>
		   <?php elseif(!empty($imagds[1]->Source)): ?>
		   <img src="<?php echo $imagds[1]->Source; ?>" title="<?php echo $imagds[1]->Source; ?>"/>
		   <?php elseif(!empty($imagds[2]->Source)): ?>
		   <img src="<?php echo $imagds[2]->Source; ?>" title="<?php echo $imagds[2]->Source; ?>"/>
		<?php else: ?>
		<img src="/img/images.png" width="70px"/>
		<?php endif; ?></th>          
        </tr>
        </thead>
        <tbody>
        <?php foreach ($details->Data as  $detail): ?>	
        <tr>
        <td></td>
	<td><?php echo $this->Form->input('Item Number(sku)',array('readonly' => 'readonly','value'=>$detail->ItemNumber)); ?></td>
	<td><?php echo $this->Form->input('Product name',array('value'=>$detail->ItemTitle)); ?></td>
	<td><?php echo $this->Form->input('Barcode number',array('value'=>$detail->BarcodeNumber)); ?></td>
	 </tr>
         <?php endforeach; ?>
        <tr>   
        <td colspan="2"></td>
	<td></td>
	<td></td>
	</tr>      
        <?php foreach ($itemids as  $itemid): ?>
        <tr>   
        <td colspan="2"></td>
	<td><?php echo $this->Form->input('Location',array('value'=>$itemid->LocationName)); ?></td>
	<td><?php echo $this->Form->input('Bin Rack',array('value'=>$itemid->BinRack)); ?></td>
	</tr>   
        <?php endforeach; ?>
        <tr>   
        <td colspan="2"></td>
	<td></td>
	<td></td>
	</tr>  
       <tr>   
        <td><?php echo $this->Form->input('Stock level',array('value'=>$measures[0]->StockLevel)); ?></td>
	<td><?php echo $this->Form->input('Available',array('value'=>$measures[0]->Available)); ?></td>
	<td><?php echo $this->Form->input('Min level',array('value'=>$measures[0]->MinimumLevel)); ?></td>
         <td><?php echo $this->Form->input('Stock Due',array('value'=>$measures[0]->Due)); ?></td>
       </tr>
       <tr>   
        <td colspan="2"></td>
	<td></td>
	<td></td>
	</tr>  
        <tr> 
         <td></td>
        <td> <?php __('Sales Chanel');?></td>
	<td><?php __('Sales Price');?></td>
	<td></td>
	</tr> 
          <tr>   
        <td colspan="2"></td>
	<td></td>
	<td></td>
	</tr>
 </tbody>
    </table>
  </div>

<div class="panel-body">
              <ul class="nav nav-tabs responsive">
                  <li class="active"><a href="#home-test-new">Amazon UK</a></li>
                  <li><a href="#profile-test-new">Amazon De</a></li>
                  <li><a href="#messages-test-new">Amazon FR</a></li>
                  <li><a href="#fourth-test-new">Ebay</a></li>
                    <li><a href="#fifth-test-new">Tesco</a></li>
              </ul>

              <div class="tab-content responsive">
                  <div class="tab-pane active" id="home-test-new"> 
                      
					<div class="col-md-12">
                                         <hr>
						<?php foreach ($channels as  $channel): ?>
						<?php if(('United Kingdom'==$channel->SubSource) || ('AMAZON UNITED KINGDOM'==$channel->SubSource)): ?>
					   <div class="col-md-3"><?php echo $this->Html->link($channel->SKU, array('controller' => 'inventory_masters','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>			 						  
					</div>
													 
                    </div>
                  <div class="tab-pane" id="profile-test-new">
				<div class="col-md-12">	
                                    <hr>
						<?php foreach ($channels as  $channel): ?>
						<?php if(('Germany'==$channel->SubSource) || ('Germany'==$channel->SubSource)): ?>
                                                <div class="col-md-3"><?php echo $this->Html->link($channel->SKU, array('controller' => 'german_master_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
                                                <?php endif; ?>				  
						<?php endforeach; ?>					 						  
				</div>
                    </div>
                  <div class="tab-pane" id="messages-test-new">
					<div class="col-md-12">	
                                            <hr>
						<?php foreach ($channels as  $channel): ?>
						<?php if(('France'==$channel->SubSource) || ('France'==$channel->SubSource)): ?>
                                                <div class="col-md-3"><?php echo $this->Html->link($channel->SKU, array('controller' => 'france_master_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
                                                <?php endif; ?>				  
						<?php endforeach; ?>					 						  
					</div>
		</div>
                        <div class="tab-pane" id="fourth-test-new">
                                     <div class="col-md-12">
                                         <hr>
                                                <?php foreach ($channels as  $channel): ?>
						<?php if(('EBAY0'==$channel->SubSource) || ('EBAY0'==$channel->SubSource)): ?>
                                                 <div class="col-md-3"><?php echo $this->Html->link($channel->SKU, array('controller' => 'english_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
                                                  <?php endif; ?>				  
						<?php endforeach; ?>					 						  
                                    </div>
			</div>
			<div class="tab-pane" id="fifth-test-new"> 
						<div class="col-md-12">	
                                                   <hr>
						<?php foreach ($channels as  $channel): ?>
						<?php if(('Tesco UK'==$channel->SubSource) || ('Tesco UK'==$channel->SubSource)): ?>
                                                <div class="col-md-3"><?php echo $this->Html->link($channel->SKU, array('controller' => 'english_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
                                                  <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						
						</div>					
					</div>
              </div>
    </div>


















<!--




<div class="row">
        <div class="col-md-12">
            <div class="panel blue"><h3>Master Inventory</h3></div>
        </div>
    </div>
   <div class="clearfix"></div>
   <div class="clearfix"></div> 
  <div class="row">
  <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">List the Basic Inventory Information</h3>
          </div>
		  <?php //print_r($imagds);?>
			<div class="row">
			<div class="col-md-12">		 
		  <?php if(!empty($imagds[0]->Source)): ?>
			<div class="col-md-3"><img src="<?php echo $imagds[0]->Source; ?>" title="<?php echo $imagds[0]->Source; ?>"/></div>
		   <?php elseif(!empty($imagds[1]->Source)): ?>
		   <div class="col-md-3"><img src="<?php echo $imagds[1]->Source; ?>" title="<?php echo $imagds[1]->Source; ?>"/></div>
		   <?php elseif(!empty($imagds[2]->Source)): ?>
		   <div class="col-md-3"><img src="<?php echo $imagds[2]->Source; ?>" title="<?php echo $imagds[2]->Source; ?>"/></div>
			<?php else: ?>
			<div class="col-md-3"><img width=70px src="/img/images.png"/></div>
			<?php endif; ?>					 
		  <?php foreach ($details->Data as  $detail): ?>				  
		  <div class="col-md-3"><?php echo $this->Form->input('Item Number(sku)',array('readonly' => 'readonly','value'=>$detail->ItemNumber)); ?></div>
		   <div class="col-md-3"> <?php echo $this->Form->input('Product name',array('value'=>$detail->ItemTitle)); ?></div>
		   <div class="col-md-3"> <?php echo $this->Form->input('Barcode number',array('value'=>$detail->BarcodeNumber)); ?></div>
		<?php endforeach; ?>
		 </div>
		 </div>
		  <div class="clearfix"><hr/></div>
			
		 <div class="row">
		 <div class="col-md-12">
			<?php foreach ($itemids as  $itemid): ?>
				<div class="col-md-6"></div>
				<div class="col-md-3"><?php echo $this->Form->input('Location',array('value'=>$itemid->LocationName)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('Bin Rack',array('value'=>$itemid->BinRack)); ?></div>
				<?php endforeach; ?>			
		  </div>
		  </div>
		    <div class="clearfix"><hr/></div>
			 <?php //print_r($measures);?>
		  <div class="row">
		 <div class="col-md-12">				
				<div class="col-md-3"><?php echo $this->Form->input('Stock level',array('value'=>$measures[0]->StockLevel)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('Available',array('value'=>$measures[0]->Available)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('Min level',array('value'=>$measures[0]->MinimumLevel)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('Stock Due',array('value'=>$measures[0]->Due)); ?></div>
						
		  </div>
		  </div>
		 <div class="clearfix"><hr/></div>
		  <div class="row">
			<div class="col-md-12">
				<div class="col-md-2"></div>
				<div class="col-md-3"><?php __('Sales Chanel');?></div>
				<div class="col-md-2"><div class="vertical-line"></div></div>
				<div class="col-md-3"><?php __('Sales Price');?></div>					
				<div class="col-md-2"></div>
			</div>					  
		  </div>
		  <div class="clearfix"><hr/></div>
          <div class="panel-body">
              <ul class="nav nav-tabs responsive">
                  <li class="active"><a href="#home-test-new">Amazon UK</a></li>
                  <li><a href="#profile-test-new">Amazon De</a></li>
                  <li><a href="#messages-test-new">Amazon FR</a></li>
                  <li><a href="#fourth-test-new">Ebay</a></li>
				   <li><a href="#fifth-test-new">Tesco</a></li>
              </ul>

              <div class="tab-content responsive">
                  <div class="tab-pane active" id="home-test-new">  
					<div class="clearfix"><hr/></div>
					<?php //print_r($channels);?>
						<div class="row">
						<div class="col-md-12">
						<?php foreach ($channels as  $channel): ?>
						<?php if(('United Kingdom'==$channel->SubSource) || ('AMAZON UNITED KINGDOM'==$channel->SubSource)): ?>
					   <div class="col-md-4"><?php echo $this->Html->link($channel->SKU, array('controller' => 'inventory_masters','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						</div>
						</div>
						 <div class="clearfix"><hr/></div>							 
					</div>
                  <div class="tab-pane" id="profile-test-new">
				
					<div class="clearfix"><hr/></div>
						<div class="row">
						<div class="col-md-12">
						<?php foreach ($channels as  $channel): ?>
						<?php if(('Germany'==$channel->SubSource) || ('Germany'==$channel->SubSource)): ?>
					   <div class="col-md-4"><?php echo $this->Html->link($channel->SKU, array('controller' => 'german_master_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						</div>
						</div>
						 <div class="clearfix"><hr/></div>
					</div>
                  <div class="tab-pane" id="messages-test-new">
					<div class="clearfix"><hr/></div>
						<div class="row">
						<div class="col-md-12">
						<?php foreach ($channels as  $channel): ?>
						<?php if(('France'==$channel->SubSource) || ('France'==$channel->SubSource)): ?>
					   <div class="col-md-4"><?php echo $this->Html->link($channel->SKU, array('controller' => 'france_master_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						</div>
						</div>
						 <div class="clearfix"><hr/></div>
				  </div>
                  <div class="tab-pane" id="fourth-test-new">
				  <div class="clearfix"><hr/></div>
						<div class="row">
						<div class="col-md-12">
						<?php foreach ($channels as  $channel): ?>
						<?php if(('EBAY0'==$channel->SubSource) || ('EBAY0'==$channel->SubSource)): ?>
					  <div class="col-md-4"><?php echo $this->Html->link($channel->SKU, array('controller' => 'english_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						</div>
						</div>
						 <div class="clearfix"><hr/></div>						 
					</div>
					<div class="tab-pane" id="fifth-test-new"> 
						<div class="clearfix"><hr/></div>
						<div class="row">
						<div class="col-md-12">
						<?php foreach ($channels as  $channel): ?>
						<?php if(('Tesco UK'==$channel->SubSource) || ('Tesco UK'==$channel->SubSource)): ?>
					  <div class="col-md-4"><?php echo $this->Html->link($channel->SKU, array('controller' => 'english_listings','action'=> 'edit',$channel->SKU), array( 'class' => 'button')); ?></div>
					    <?php endif; ?>				  
						<?php endforeach; ?>					 						  
						</div>
						</div>
						 <div class="clearfix"><hr/></div>
					</div>
              </div>			  
          </div>		  
      </div>        
   </div>-->