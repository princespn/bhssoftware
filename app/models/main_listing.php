<?php

class MainListing extends AppModel {

    var $name = 'MainListing';
    var $validate = array(        
        'amazon_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Amazon sku is required'
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
              
                $lincode = $pcodes[0]['MainListing']['linnworks_code'];                
                $Webcodes = $this->Listing->find('all', array('conditions' => array('Listing.linnworks_code' => $lincode)));               
                
                if ((!empty($pcodes))) {
                    
                    $apiConfig = (isset($pcodes[0]['MainListing']) && is_array($pcodes[0]['MainListing'])) ? ($pcodes[0]['MainListing']) : array();
                    $data['MainListing'] = array_merge($apiConfig, $data['MainListing']);
                    $WebConfig = (isset($Webcodes[0]['Listing']) && is_array($Webcodes[0]['Listing'])) ? ($Webcodes[0]['Listing']) : array();
                    
                    
                     $itemsku = split("\_", $apiConfig['amazon_sku']); 
                     $frsku = split ("\-", $apiConfig['amazon_sku']); 
                     if($frsku[1]==='FBA'){$final=$frsku[1];}
                     if($frsku[2]==='FBA'){$final= $frsku[2];}
                              
                       if((empty($apiConfig['linnworks_code'])) && (empty($data['MainListing']['linnworks_code']))) {
                        //$data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                        $limit = 'Linnworks code not Exist in Database.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                        }
                     
                     if((($itemsku[1]) !== 'FBA') && (!empty($WebConfig['web_price_uk'])) && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_price_tesco'])) && (!empty($data['MainListing']['price_uk'])) && ((($WebConfig['web_price_uk']) !== ($data['MainListing']['price_uk'])) && (($WebConfig['web_price_tesco']) !== ($data['MainListing']['price_uk'])) )) {
                        //$data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                        $limit = 'RRP  Web UK and Amazon UK and Tesco Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk'])) && (!empty($data['MainListing']['sale_price_uk'])) && (($WebConfig['web_sale_price_uk']) !== ($data['MainListing']['sale_price_uk']))) {
                        // $data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                         $limit = 'Web UK and Amazon UK Sale Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    
                    if((($itemsku[1]) === 'FBA') && (!empty($apiConfig['price_uk'])) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))){
                       // $data['MainListing'] = array_merge($apiConfig['sale_price_uk'], $data['MainListing']['sale_price_uk']);
                        $val = $data['MainListing']['sale_price_uk']; $min = $WebConfig['web_sale_price_uk']+3; $max = $WebConfig['web_sale_price_uk']+6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Amazon UK Prim Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));        
                         
                     }
                    }
                      
                    if((($itemsku[1]) === 'FBA') && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MainListing']['sale_price_uk']))  && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_dm'])) && (($WebConfig['web_sale_price_dm'])!==($data['MainListing']['sale_price_uk']))) { 
                         //  $data['MainListing'] = array_merge($apiConfig['sale_price_uk'], $data['MainListing']['sale_price_uk']);
                        $limit = 'DM Price and UK Prime Sale Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                      }
       // GBP Codition End and Start EUR Condition
                      
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_de'])) && (!empty($data['MainListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_uk'])) && (!empty($WebConfig['web_sale_price_de']))){
                        //$data['MainListing'] = array_merge($apiConfig['sale_price_uk'], $data['MainListing']['sale_price_uk']);
                        $val = $WebConfig['web_sale_price_de']; $min = $WebConfig['web_sale_price_uk']*1.25; $max = $WebConfig['web_sale_price_uk']*1.6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Web DE Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));        
                         
                     }
                    }
                    
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_de'])) && (!empty($data['MainListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_de']))){
                       //$data['MainListing'] = array_merge($apiConfig['sale_price_de'], $data['MainListing']['sale_price_de']);
                       $val = $data['MainListing']['sale_price_de']; $min = $WebConfig['web_sale_price_uk']*1.25; $max = $WebConfig['web_sale_price_uk']*1.6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Amazon DE Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));        
                         
                     }
                    }
                   
                     if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (((!empty($apiConfig['price_de'])) && (!empty($data['MainListing']['price_de']))) || (!empty($apiConfig['price_fr']))) && (!empty($data['MainListing']['price_de'])) && (!empty($WebConfig['web_price_de'])) && (!empty($data['MainListing']['price_fr'])) && (!empty($WebConfig['web_price_fr'])) && ((($data['MainListing']['price_fr'])!==($WebConfig['web_price_de'])) && (($data['MainListing']['price_de'])!==($WebConfig['web_price_fr']))) && ((($data['MainListing']['price_fr'])!==($data['MainListing']['price_de'])) && (($WebConfig['price_de'])!==($WebConfig['web_price_fr'])))){
     
                        //$data['MainListing'] = array_merge($apiConfig['price_fr'], $data['MainListing']['price_fr']);
                        $limit = 'RRP  Web FR, Amazon FR And Web DE, Amazon DE Price Mismatch.';
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
                if (!empty($this->validationErrors['amazon_sku'])) {
                    $limit = $this->validationErrors['amazon_sku'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                }
            }
            
            
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                     if (!empty($err)) {$this->saveField('error', $err, array($this->amazon_sku = $id));} else {$this->saveField('error',' ', array($this->amazon_sku = $id));}
                     
                    
                } else {
                    $err = implode("\n", $erritem);
                    if (!empty($err)) {$this->saveField('error', $err, array($this->id = $i));} else { $this->saveField('error',' ', array($this->id = $i));}
                   
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
        ),
        'AdminListing' => array(
            'className' => 'AdminListing',
            'foreignKey' => false,
            'conditions' => 'MainListing.linnworks_code = AdminListing.linnworks_code'
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