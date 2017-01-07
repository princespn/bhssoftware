<?php
class Multiplier extends AppModel {

    var $name = 'Multiplier';
    var $validate = array(
        'supplier' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Supplier name is required.'
            ),
        ),

        'multiplier' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Multiplier name is required.'
            ),
        ),
    );
//pr($this->SupplierMultiplier->schema());



    var $hasOne = array(
        'PurchaseOrder' => array(
            'className' => 'PurchaseOrder',
            'foreignKey' => false,
            'conditions' => array('Multiplier.category = PurchaseOrder.category','Multiplier.supplier = PurchaseOrder.supplier')
        )
    );
    
}