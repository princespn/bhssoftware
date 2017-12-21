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

}
