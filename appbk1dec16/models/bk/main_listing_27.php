<?php

class MainListing extends AppModel {

    var $name = 'MainListing';
    var $validate = array(        
        'id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Linnwork code is required'
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
                    $data['MainListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('MainListing.amazon_sku' => $id)));
               
                
                
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['MainListing']) && is_array($pcodes[0]['MainListing'])) ? ($pcodes[0]['MainListing']) : array();
                    $data['MainListing'] = (isset($data['MainListing']) && is_array($data['MainListing'])) ? ($data['MainListing']) : array();
                    $data['MainListing'] = array_merge($apiConfig, $data['MainListing']);
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['id'])) {
                    $limit = $this->validationErrors['id'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                   $this->saveField('error', $err, array($this->amazon_sku = $id));
                    
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
        'Listing' => array(
            'className' => 'Listing',
            'foreignKey' => false,
            'conditions' => 'MainListing.linnworks_code = Listing.linnworks_code'
        )
               
    );
    
   /*var $belongsTo = array(
        'Listing' => array(
            'className' => 'Listing',
            'foreignKey' => 'linnworks_code',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );*/

}