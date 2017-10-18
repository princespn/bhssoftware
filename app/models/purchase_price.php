<?php
class PurchasePrice extends AppModel {

    var $name = 'PurchasePrice';
    var $validate = array(
    'id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'id is required'
            ),
        ),       
  
    );
    
    
  /*
    var $hasOne = array(
        'StockLevel' => array(
            'className' => 'StockLevel',
            'foreignKey' => false,
            'conditions' => 'PurchasePrice.stock_itemid = StockLevel.stock_itemid'
    )
    );*/

}
