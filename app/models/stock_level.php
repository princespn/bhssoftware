<?php
class StockLevel extends AppModel {

    var $name = 'StockLevel';
    var $validate = array(
    'item_number' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'item number is required'
            ),
        ),
			
		'item_title' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'item title is required'
            ),
        ),
		
		'category_name' => array(
            'Unique-3' => array(
                'rule' => 'notempty',
                'message' => 'category name is required'
            ),
        ),
		
		'barcode_number' => array(
            'Unique-4' => array(
                'rule' => 'notempty',
                'message' => 'barcode number is required'
            ),
        ),
		
		'location_name' => array(
            'Unique-4' => array(
                'rule' => 'notempty',
                'message' => 'location name is required'
            ),
        )
  
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
