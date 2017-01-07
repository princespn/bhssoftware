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

}