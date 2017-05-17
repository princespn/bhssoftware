<?php
class MainListing extends AppModel {

    var $name = 'MainListing';
    var $validate = array(        
        'channel_id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Channel code is required'
            ),
        ),

        'linnworks_code' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Linnworks code is required'
            ),
        ),
        
         'amazon_sku' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Channel sku is required'
            ),
        )

    );
    

    
    

    public function repdelcode($filename)
    {

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
                $rowcount = $this->find('count', array('conditions' => array('MainListing.linnworks_code' =>  $pcodes[0]['MainListing']['linnworks_code'],'MainListing.channel_id' => $pcodes[0]['MainListing']['channel_id'])));
                //print_r($rowcount); die();
              if (((strpos($pcodes[0]['MainListing']['amazon_sku'], 'FBA') === false) && ($rowcount > 2)) && (!empty($data['MainListing']['new_amazon_sku'])) && (($id === $pcodes[0]['MainListing']['amazon_sku']) && ($data['MainListing']['channel_id']=== $pcodes[0]['MainListing']['channel_id']))) {      
                  $condition = array('MainListing.id' => $pcodes[0]['MainListing']['id']);
                  
                   
                    $this->deleteAll($condition, false);                  
                    $limit = 'Listing  Old SKU Deleted.';
                    $return['errors'][] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->amazon_sku = $id));

                }

                if ((!empty($data['MainListing']['amazon_sku'])) && (!empty($data['MainListing']['new_amazon_sku'])) && (($id === $pcodes[0]['MainListing']['amazon_sku']) && ($data['MainListing']['channel_id']=== $pcodes[0]['MainListing']['channel_id']))) {

                   $db = $this->getDataSource();
                    $value = $db->value($data['MainListing']['new_amazon_sku'], 'string');
                    $this->updateAll(
                        array('MainListing.amazon_sku' => $value),
                        array('MainListing.amazon_sku' => $id,'MainListing.channel_id' => $data['MainListing']['channel_id'])
                    );
                    
                                 
                    $limit = 'Listing  Old SKU Updated.';
                    $return['errors'][] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->amazon_sku = $id));
                }

            }


        }
        return $return;
    }


    
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
            $cid = isset($row[1]) ? $row[1] : 1;           
            if ((!empty($id)) && (!empty($cid))) {

                $pcodes = $this->find('all', array('conditions' => array('MainListing.amazon_sku' => $id,'MainListing.channel_id' => $cid)));
                $lincode = $pcodes[0]['MainListing']['linnworks_code'];                
                $Webcodes = $this->AdminListing->find('all', array('conditions' => array('AdminListing.linnworks_code' => $lincode)));
                $WebList = $this->Listing->find('all', array('conditions' => array('Listing.linnworks_code' => $lincode)));

                if ((!empty($pcodes))) {
                    
                                $apiConfig = (isset($pcodes[0]['MainListing']) && is_array($pcodes[0]['MainListing'])) ? ($pcodes[0]['MainListing']) : array();
                                $data['MainListing'] = array_merge($apiConfig, $data['MainListing']);


                                $WebConfig = (isset($Webcodes[0]['AdminListing']) && is_array($Webcodes[0]['AdminListing'])) ? ($Webcodes[0]['AdminListing']) : array();
                                $WebListConfig = (isset($WebList[0]['Listing']) && is_array($WebList[0]['Listing'])) ? ($WebList[0]['Listing']) : array();




                                  if((empty($apiConfig['linnworks_code'])) && (empty($data['MainListing']['linnworks_code']))) {
                                    //$data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                                    $limit = 'Linnworks code not Exist in Database.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                    }

                                else if(((!empty($WebListConfig['web_sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($WebListConfig['web_sale_price_uk']))) {
                                    $limit = 'Master Web UK and Web UK Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                               else if(((!empty($WebListConfig['web_sale_price_tesco'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($WebListConfig['web_sale_price_tesco']))) {
                                    $limit = 'Master Web UK and Tesco Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }


                               else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($data['MainListing']['sale_price_uk']))) {
                                    $limit = 'Master Web UK and Amazon UK Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') !== false) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebListConfig['web_sale_price_dm']))) && (($WebListConfig['web_sale_price_dm'])!==($data['MainListing']['sale_price_uk']))) {
                                    $limit = 'Amazon Prime UK and DM Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_de']))) && (($WebConfig['web_sale_price_de'])!==($data['MainListing']['sale_price_de']))) {
                                    $limit = 'Master Web DE and Amazon DE Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }
                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_fr'])) && (!empty($WebConfig['web_sale_price_fr']))) && (($WebConfig['web_sale_price_fr'])!==($data['MainListing']['sale_price_fr']))) {
                                    $limit = 'Master Web FR and Amazon FR Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                 }else {      /* echo "Welcome";       */ }                               
                                                           
                    
                    
                    
                                } else {    $this->id = $id; }
            
                        } else {  $this->create();   }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['amazon_sku'])) {
                    $limit = $this->validationErrors['amazon_sku'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                
                }
            }
            
            
            if (($this->saveAll($data, $validate = false)) && (!empty($id))) {
                
                    $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                     if (!empty($err)) {    $this->saveField('error', $err, array($this->id = $apiConfig['id']));}
                     
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
        ),       
       
        'SalesChannel' => array(
            'className' => 'SalesChannel',
            'foreignKey' => false,
            'conditions' => 'MainListing.channel_id = SalesChannel.id'
        ),
        
        'AdminListing' => array(
            'className' => 'AdminListing',
            'foreignKey' => false,
            'conditions' => 'MainListing.linnworks_code = AdminListing.linnworks_code'
        ),
       
        'InventoryCode' => array(
            'className' => 'InventoryCode',
            'foreignKey' => false,
            'conditions' => 'MainListing.linnworks_code = InventoryCode.linnworks_code'
        )

    );


}