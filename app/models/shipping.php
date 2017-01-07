<?php
class Shipping extends AppModel {

    var $name = 'Shipping';
    
    var $hasOne = array(
        'MasterListing' => array(
            'className' => 'MasterListing',
            'foreignKey' => false,
            'conditions' => 'Shipping.category = MasterListing.category'
        ),
        'MainListing' => array(
            'className' => 'MainListing',
            'foreignKey' => false,
            'conditions' => 'Shipping.category = MainListing.category'
        )
               
    );
    
}