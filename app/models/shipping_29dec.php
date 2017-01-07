<?php
class Shipping extends AppModel {

    var $name = 'Shipping';
    
    var $hasOne = array(
        'MasterListing' => array(
            'className' => 'MasterListing',
            'foreignKey' => false,
            'conditions' => 'Shipping.category = MasterListing.category'
        )
               
    );
    
}