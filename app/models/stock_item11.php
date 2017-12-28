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
        'PurchaseOrder' => array(
            'className' => 'PurchaseOrder',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = PurchaseOrder.linnworks_code'
        )
       
    );	
  

}
