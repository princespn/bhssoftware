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
class ProcessedListing extends AppModel {

    var $name = 'ProcessedListing';
      public $useTable = "processed_listings";
      //public $recursive = 1;
      
      
      public function importcategory($filename){
        
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
                    $data['ProcessedListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                /*$pcodes = $this->find('all', array('conditions' => array('ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id)));
                $lincode = $pcodes[0]['ProcessedListing']['order_number'];    
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['ProcessedListing']) && is_array($pcodes[0]['ProcessedListing'])) ? ($pcodes[0]['ProcessedListing']) : array();
                    $data['ProcessedListing'] = (isset($data['ProcessedListing']) && is_array($data['ProcessedListing'])) ? ($data['ProcessedListing']) : array();
                    $data['ProcessedListing'] = array_merge($apiConfig, $data['ProcessedListing']);
                    
                    if(((!empty($apiConfig['order_number'])) && (!empty($lincode))) && ($apiConfig['order_number'] === $lincode)) {                        
                        $limit = 'Order Id Already Exist in Database.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                        }
                    
                } else {
                    $this->id = $id;
                }*/
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
