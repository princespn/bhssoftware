<?php
class Keyword extends AppModel {
	var $name = 'Keyword';
	var $validate = array(
	'keyword_name' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Keyword name is must Required.'

			),
		),     
            
            
	);
	
	
}
