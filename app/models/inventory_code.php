<?php

class InventoryCode extends AppModel {

    var $name = 'InventoryCode';
    var $validate = array(
        'linnworks_code' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Linnwork code is required.'
            ),
        ),

        'product_name' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Product Name is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Item Name must be no long 500 characters .'
            ),
        ),

        'category' => array(
            'rule-b' => array(
                'rule' => 'notempty',
                'message' => 'Category Name is required.'
            ),
        )


    );


    public function linnworkcode($filename) {
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
                    $data['InventoryCode'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('InventoryCode.linnworks_code' => $id)));
                $lincode = $pcodes[0]['InventoryCode']['linnworks_code'];    
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['InventoryCode']) && is_array($pcodes[0]['InventoryCode'])) ? ($pcodes[0]['InventoryCode']) : array();
                    $data['InventoryCode'] = (isset($data['InventoryCode']) && is_array($data['InventoryCode'])) ? ($data['InventoryCode']) : array();
                    $data['InventoryCode'] = array_merge($apiConfig, $data['InventoryCode']);
                    
                    if(((!empty($apiConfig['linnworks_code'])) && (!empty($lincode))) && ($apiConfig['linnworks_code'] === $lincode)) {
 
                        $limit = 'Linnworks code Already Exist in Database.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
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
                if (!empty($this->validationErrors['linnworks_code'])) {
                    $limit = $this->validationErrors['linnworks_code'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->linnworks_code = $id));

                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        //fclose($handle);
    }




}
