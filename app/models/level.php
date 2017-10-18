<?php
class Level extends AppModel {

    var $name = 'Level';
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
            'conditions' => 'Level.item_number = StockItem.item_number'
    )
    );
       

}
