<?php

class AdminListing extends AppModel {

    var $name = 'AdminListing';   
      var $validate = array(
        'web_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Web SKU is required.'
            ),
        ),
        
        'linnworks_code' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Linnworks code is required.'
            ),
        ),
      );
    
 
    
    public function importcode($filename) {
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
                    $data['AdminListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('AdminListing.web_sku' => $id)));
               
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['AdminListing']) && is_array($pcodes[0]['AdminListing'])) ? ($pcodes[0]['AdminListing']) : array();
                    //$data['AdminListing'] = (isset($data['AdminListing']) && is_array($data['AdminListing'])) ? ($data['AdminListing']) : array();
                    $data['AdminListing'] = array_merge($apiConfig, $data['AdminListing']);
                  
                    
                    } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['web_sku'])) {
                    $limit = $this->validationErrors['web_sku'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($this->validationErrors['linnworks_code']))) {
                    $limit = $this->validationErrors['linnworks_code'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->web_sku = $id));
                    
                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        //fclose($handle);
    }

    var $hasOne = array(
            'InventoryCode' => array(
            'className' => 'InventoryCode',
            'foreignKey' => false,
            'conditions' => 'AdminListing.linnworks_code = InventoryCode.linnworks_code'
        ) 


    );
      
}