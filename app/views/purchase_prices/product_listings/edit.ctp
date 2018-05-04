<?php

if($session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='2')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
<div class="projects form">
<?php echo $this->Form->create('ProductListing');?>
    <fieldset>
        <legend><?php __('Edit Product code'); ?></legend>
        <div style="float:right;"><?php echo $this->Form->button('Save data', array('value'=>'Save data','type'=>'submit','id'=>'hide')); ?></div>
<?php
echo $this->Form->hidden('id',array('value'=>$this->data['ProductListing']['id']));
echo $this->Form->input('product_code',array('readonly' => 'readonly','value'=>$this->data ['ProductListing']['product_code']));
echo $this->Form->input('product_sku',array('readonly' => 'readonly','value'=>$this->data ['ProductListing']['product_sku']));
echo $this->Form->input('web_sku',array('readonly' => 'readonly','value'=>$this->data ['ProductListing']['web_sku']));
echo $this->Form->input('product_asin',array('readonly' => 'readonly','value'=>$this->data ['ProductListing']['product_asin']));
echo $this->Form->input('fulfillmentchannel',array('readonly' => 'readonly','value'=>$this->data ['ProductListing']['fulfillmentchannel']));
?>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script>
    $(document).ready(function () {
        $("#hide").click(function () {
            $("#hiderror").hide();
        });
    });
</script>