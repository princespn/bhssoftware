<div class="panel-heading custom-panel-heading"><?= __('Edit Cost Calculator') ?></div>
  <hr>
  <div class="row">
      <div class="col-lg-5 col-lg-offset-3">
         <div class="panel panel-info">
          <div class="panel-body form-horizontal">
            
               </div>
                         
                       
    <?= $this->Form->create($costCalculator) ?>

        <?php
            echo $this->Form->control('linnworks_code',array('readonly'=>'readonly','class'=>'form-control'));
            echo $this->Form->control('product_name',array('readonly'=>'readonly','class'=>'form-control'));
            echo $this->Form->control('category',array('readonly'=>'readonly','class'=>'form-control'));
            echo $this->Form->control('supplier',array('readonly'=>'readonly','class'=>'form-control'));
            echo $this->Form->control('invoice_currency',array('readonly'=>'readonly','class'=>'form-control'));
            echo $this->Form->control('landed_price_gbp',array('class'=>'form-control'));
            echo $this->Form->control('sp1_value_gbp',array('class'=>'form-control'));
            echo $this->Form->control('sp2_value_gbp',array('class'=>'form-control'));
            echo $this->Form->control('sp3_value_gbp',array('class'=>'form-control'));
            echo $this->Form->control('sale_price_gbp',array('class'=>'form-control'));
            echo $this->Form->control('landed_price_eur',array('class'=>'form-control'));
            echo $this->Form->control('sp1_value_eur',array('class'=>'form-control'));
            echo $this->Form->control('sp2_value_eur',array('class'=>'form-control'));
            echo $this->Form->control('sp3_value_eur',array('class'=>'form-control'));
            echo $this->Form->control('sale_price_euro',array('class'=>'form-control'));
            echo $this->Form->control('import_dates',array('class'=>'form-control'));
            echo $this->Form->control('error',array('class'=>'form-control'));
        ?>
  
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
 
  </div>
         </div>
</div>
