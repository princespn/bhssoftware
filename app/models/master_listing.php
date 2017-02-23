<?php
class MasterListing extends AppModel {

    var $name = 'MasterListing';
     var $validate = array(        
        'amazon_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Channel sku is required'
            ),
        ),

        'channel_id' => array(
            'Unique-2' => array(
                'rule' => 'notempty',
                'message' => 'Channel Id is required'
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
                    $data['MasterListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }
            //print_r($data['MasterListing']['new_amazon_sku']);die();

            $id = isset($row[0]) ? $row[0] : 0;    

            if (!empty($id)) {
                $pcodes = $this->find('all', array('conditions' => array('MasterListing.amazon_sku' => $id)));
                $rowcount = $this->find('count', array('conditions' => array('MasterListing.linnworks_code' =>  $pcodes[0]['MasterListing']['linnworks_code'],'MasterListing.channel_id' => $pcodes[0]['MasterListing']['channel_id'])));
                //print_r($rowcount); die();
              if (((strpos($pcodes[0]['MasterListing']['amazon_sku'], 'FBA') === false) && ($rowcount > 2)) && (!empty($data['MasterListing']['new_amazon_sku'])) && (($id === $pcodes[0]['MasterListing']['amazon_sku']) && ($data['MasterListing']['channel_id']=== $pcodes[0]['MasterListing']['channel_id']))) {      
                  $condition = array('MasterListing.id' => $pcodes[0]['MasterListing']['id']);
                  
                    $this->deleteAll($condition, false);                  
                    $limit = 'Listing  Old SKU Deleted.';
                    $return['errors'][] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and sku $id :$limit.", $i), true);
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->amazon_sku = $id));

                }

                if ((!empty($data['MasterListing']['amazon_sku'])) && (!empty($data['MasterListing']['new_amazon_sku'])) && (($id === $pcodes[0]['MasterListing']['amazon_sku']) && ($data['MasterListing']['channel_id']=== $pcodes[0]['MasterListing']['channel_id']))) {

                    $db = $this->getDataSource();
                    $value = $db->value($data['MasterListing']['new_amazon_sku'], 'string');
                    $this->updateAll(
                        array('MasterListing.amazon_sku' => $value),
                        array('MasterListing.amazon_sku' => $id,'MasterListing.channel_id' => $data['MasterListing']['channel_id'])
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
                    $data['MasterListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

                $id = isset($row[0]) ? $row[0] : 0;
                $cid = isset($row[1]) ? $row[1] : 1;
                if ((!empty($id)) && (!empty($cid))) {

                 /* Get linnwork code  using Channel name and Id */

                $pcodes = $this->find('all', array('conditions' => array('MasterListing.amazon_sku' => $id,'MasterListing.channel_id' => $cid)));

                $lincode = $pcodes[0]['MasterListing']['linnworks_code'];

                     /* Get All Website Data  using Linnwork code*/
                 $Webcodes = $this->AdminListing->find('all', array('conditions' => array('AdminListing.linnworks_code' => $lincode)));

                
                if (!empty($pcodes))
                          {
                                    $apiConfig = (isset($pcodes[0]['MasterListing']) && is_array($pcodes[0]['MasterListing'])) ? ($pcodes[0]['MasterListing']) : array();
                                    $data['MasterListing'] = array_merge($apiConfig, $data['MasterListing']);
                                    //print_r($apiConfig['sale_price_uk']);die();
                                    $WebConfig = (isset($Webcodes[0]['AdminListing']) && is_array($Webcodes[0]['AdminListing'])) ? ($Webcodes[0]['AdminListing']) : array();

                                    /* Start Conditions with Amazon price and Web Price */
                                   //print_r($data['MasterListing']['sale_price_uk']);die();
                                   if(((strpos($data['MasterListing']['amazon_sku'], 'FBA') === false)  && (!empty($data['MasterListing']['sale_price_uk']))) && ((($data['MasterListing']['channel_id']==='1') && (!empty($WebConfig['web_sale_price_uk']))) && ($WebConfig['web_sale_price_uk']!==$data['MasterListing']['sale_price_uk']))) {
                                        $limit = 'Web Price UK and Amazon UK Price Mismatch.';
                                        $return['errors'][] = __(sprintf("Listing  error on line %d and Channel sku $id :$limit.", $i), true);
                                        $erritem[] = __(sprintf("Listing  error on line %d and Channel sku $id :$limit.", $i), true);
                                        $err = implode("\n", $erritem);
                                        //$this->saveField('error', $err, array($this->id = $i));
                                        //$db = $this->getDataSource(); $value = $db->value($data['MasterListing']['sale_price_uk'], 'string'); $this->updateAll(array('MasterListing.sale_price_uk' => $value),array('MasterListing.amazon_sku' => $id ));
                                         $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));
                                    }
                                     else if(((strpos($data['MasterListing']['amazon_sku'], 'FBA') !== false)  && (!empty($apiConfig['sale_price_uk']))) && ((($apiConfig['channel_id']==='1') && (!empty($WebConfig['web_sale_price_dm']))) && ($WebConfig['web_sale_price_dm']!==$apiConfig['sale_price_uk']))) {
                                       $limit = 'DM Price and Amazon UK Prime Price Mismatch.';
                                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $err = implode("\n", $erritem);
                                       // $this->saveField('error', $err, array($this->id = $i));
                                          //$db = $this->getDataSource(); $value = $db->value($data['MasterListing']['sale_price_uk'], 'string'); $this->updateAll(array('MasterListing.sale_price_uk' => $value),array('MasterListing.amazon_sku' => $id ));
                                        $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));
                                    }
                                      else if(((strpos($data['MasterListing']['amazon_sku'], 'FBA') === false)  && (!empty($data['MasterListing']['sale_price_de']))) && ((($data['MasterListing']['channel_id']==='3') && (!empty($WebConfig['web_sale_price_de']))) && ($WebConfig['web_sale_price_de']!==$data['MasterListing']['sale_price_de']))) {
                                        $limit = 'Web Price DE and Amazon DE Price Mismatch.';
                                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $err = implode("\n", $erritem);
                                       // $this->saveField('error', $err, array($this->id = $i));
                                        //$db = $this->getDataSource(); $value = $db->value($data['MasterListing']['sale_price_de'], 'string'); $this->updateAll(array('MasterListing.sale_price_de' => $value),array('MasterListing.amazon_sku' => $id ));
                                        $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));
                                    }
                                      else if(((strpos($data['MasterListing']['amazon_sku'], 'FBA') === false)  && (!empty($data['MasterListing']['sale_price_fr']))) && ((($data['MasterListing']['channel_id']==='2') && (!empty($WebConfig['web_sale_price_fr']))) && ($WebConfig['web_sale_price_fr']!==$data['MasterListing']['sale_price_fr']))) {
                                        $limit = 'Web Price FR and Amazon FR Price Mismatch.';
                                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                        $err = implode("\n", $erritem);
                                        //$this->saveField('error', $err, array($this->id = $i));
                                         //$db = $this->getDataSource(); $value = $db->value($data['MasterListing']['sale_price_fr'], 'string'); $this->updateAll(array('MasterListing.sale_price_fr' => $value),array('MasterListing.amazon_sku' => $id ));
                                        $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));
                                    }else {      /* echo "Welcome";       */ }                               
                                                           
                    
                    
                    
                                } else {    $this->id = $id; }
            
                        } else {  $this->create();   }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                 if (!empty($this->validationErrors['amazon_sku'])) {
                    $limit = $this->validationErrors['amazon_sku'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                      $err = implode("\n", $erritem);
                      $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));
                }
                
            }
            
            
            if (($this->saveAll($data, $validate = false)) && (!empty($id))) {
               
                    $err = implode("\n", $erritem);
                     if (!empty($err)) { $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));} else { $db = $this->getDataSource(); $value = $db->value("", 'string'); $this->updateAll(array('MasterListing.error' => $value),array('MasterListing.amazon_sku' => $id ));}
               
             }
        }
        return $return;
        //fclose($handle);
    }

   var $hasOne = array(
        'AdminListing' => array(
            'className' => 'AdminListing',
            'foreignKey' => false,
            'conditions' => 'MasterListing.linnworks_code = AdminListing.linnworks_code'
        ),
       
        'SalesChannel' => array(
            'className' => 'SalesChannel',
            'foreignKey' => false,
            'conditions' => 'MasterListing.channel_id = SalesChannel.id'
        ),
       
        'InventoryCode' => array(
            'className' => 'InventoryCode',
            'foreignKey' => false,
            'conditions' => 'MasterListing.linnworks_code = InventoryCode.linnworks_code'
        )

    );

}


