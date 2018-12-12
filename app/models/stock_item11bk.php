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
        'CostCalculator' => array(
            'className' => 'CostCalculator',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = CostCalculator.linnworks_code'
        ),

		'PurchasePrice' => array(
            'className' => 'PurchasePrice',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = PurchasePrice.item_sku'
        ) 
       
    );	
  

}
