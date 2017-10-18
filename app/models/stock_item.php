<?php
class StockItem extends AppModel {

    var $name = 'StockItem';
    var $validate = array(
    'id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),       
  
    );
    
    
  
    var $hasOne = array(
        'StockLevel' => array(
            'className' => 'StockLevel',
            'foreignKey' => false,
            'conditions' => 'StockItem.stock_itemid = StockLevel.stock_itemid'
    )
    );

}
