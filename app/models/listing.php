<?php

class Listing extends AppModel {

    var $name = 'Listing';
    var $validate = array(
    'web_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Web sku is required'
            ),
        ),       
  
    );
    
   /* public function CheckPriceMatch(){
      
      if($this->data['ProductListing']['sale_price'] === $this->data['ProductListing']['Amazon_UK'] && $this->data['ProductListing']['Amazon_UK'] === $this->data['ProductListing']['Tesco'] && $this->data['ProductListing']['Tesco'] === $this->data['ProductListing']['sale_price']){
    
            return true;
                      
        }else{
            
             return false;
        }     
    }
    
    public function CheckPriceMin(){
        if($this->data['ProductListing']['sale_price'] === $this->data['ProductListing']['Amazon_UK']){
            return true;
                      
        }else{
            
             return false;
        }     
    }
    
     public function CheckPriceMax(){
        if($this->data['ProductListing']['Amazon_UK'] === $this->data['ProductListing']['Amazon_FR']){
            return true;
                      
        }else{
            
             return false;
        }     
    }
   */
    
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
                    $data['Listing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('Listing.web_sku' => $id)));
               
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['Listing']) && is_array($pcodes[0]['Listing'])) ? ($pcodes[0]['Listing']) : array();
                    //$data['Listing'] = (isset($data['Listing']) && is_array($data['Listing'])) ? ($data['Listing']) : array();
                    $data['Listing'] = array_merge($apiConfig, $data['Listing']);
                    
                    if ((empty($apiConfig['linnworks_code'])) && (empty($data['Listing']['linnworks_code']))) {
                        //$data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                        $limit = 'Linnworks code not Exist in Database.';
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
                if (!empty($this->validationErrors['id'])) {
                    $limit = $this->validationErrors['id'];
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
        'MainListing' => array(
            'className' => 'MainListing',
            'foreignKey' => false,
            'conditions' => 'Listing.linnworks_code = MainListing.linnworks_code'
        )
               
    );
    
      /* public $belongsTo = array(
        'MainListing' => array(
            'className' => 'MainListing',
            'foreignKey' => 'linnworks_code',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ));*/
}