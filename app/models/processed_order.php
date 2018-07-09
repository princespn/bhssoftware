<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
///App::uses('AppModel', 'Model');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class ProcessedOrder extends AppModel {

    var $name = 'ProcessedOrder';
       var $validate = array(
		'order_id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ), 
		
		'order_date' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),		
		
		'currency' => array(
            'Unique-4' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),
		
		'plateform' => array(
            'Unique-5' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),
		
		'subsource' => array(
            'Unique-6' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        )
  
    );
      
    
    
    public function importprocessed($filename){
        
        $i = null;
        $error = null;
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $filename;
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $return = array(
            //'messages' => array(),
            'errors' => array(),
        );

        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
            $erritem = array();

            foreach ($header as $k => $head) {
                if (strpos($head, '.') !== false) {
                    $h = explode('.', $head);
                    $data[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';
                } else {
                    $data['ProcessedOrder'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('ProcessedOrder.order_id' => $id)));
                $lincode = $pcodes[0]['ProcessedOrder']['order_id'];    
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['ProcessedOrder']) && is_array($pcodes[0]['ProcessedOrder'])) ? ($pcodes[0]['ProcessedOrder']) : array();
                    $data['ProcessedOrder'] = (isset($data['ProcessedOrder']) && is_array($data['ProcessedOrder'])) ? ($data['ProcessedOrder']) : array();
                    $data['ProcessedOrder'] = array_merge($apiConfig, $data['ProcessedOrder']);
                    
                    if(((!empty($apiConfig['order_id'])) && (!empty($lincode))) && ($apiConfig['order_id'] === $lincode)) {                        
                        $limit = 'Order Id Already Exist in Database.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->order_id = $i));
                        }
                    
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['order_id'])) {
                    $limit = $this->validationErrors['order_id'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->order_id = $id));

                }
            }
        }
        return $return;
        //fclose($handle);
    }        
       

}
