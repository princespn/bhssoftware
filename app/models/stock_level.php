<?php
class StockLevel extends AppModel {

    var $name = 'StockLevel';
    var $validate = array(
    'id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),       
  
    );
    
    
  var $hasOne = array(
        'StockItem' => array(
            'className' => 'StockItem',
            'foreignKey' => false,
            'conditions' => 'StockLevel.stock_itemid = StockItem.stock_itemid'
    )
    );
       

}
