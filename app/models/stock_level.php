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
        'CostCalculator' => array(
            'className' => 'CostCalculator',
            'foreignKey' => false,
            'conditions' => 'StockLevel.item_number = CostCalculator.linnworks_code'
        ),

		'PurchasePrice' => array(
            'className' => 'PurchasePrice',
            'foreignKey' => false,
            'conditions' => 'StockLevel.item_number = PurchasePrice.item_sku'
        ) 
       
    );	
  

}
