<?php
class SupplierMultiplier extends AppModel {

    var $name = 'SupplierMultiplier';
    var $validate = array(
        'category' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Category name is required.'
            ),
        ),

        'supplier' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Supplier name is required.'
            ),
        ),
    );
//pr($this->SupplierMultiplier->schema());


    var $hasOne = array(
        'PurchaseOrder' => array(
            'className' => 'PurchaseOrder',
            'foreignKey' => false,
            'conditions' => 'SupplierMultiplier.category = PurchaseOrder.category'
        ),
        'CostSetting' => array(
            'className' => 'CostSetting',
            'foreignKey' => false,
            'conditions' => 'SupplierMultiplier.sale_base_curr = CostSetting.sale_base_currency'
        )

    );


}