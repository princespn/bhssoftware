<?php
class CostSetting extends AppModel {

    var $name = 'CostSetting';

    var $hasOne = array(
        'PurchaseOrder' => array(
            'className' => 'PurchaseOrder',
            'foreignKey' => false,
            'conditions' => 'CostSetting.invoice_currency = PurchaseOrder.invoice_currency'
        ),
        'SupplierMultiplier' => array(
            'className' => 'SupplierMultiplier',
            'foreignKey' => false,
            'conditions' => 'CostSetting.sale_base_currency = SupplierMultiplier.sale_base_curr'
        )

    );


}