<?php
class MasterListing extends AppModel {

    var $name = 'MasterListing';
    var $validate = array(
        'amazon_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Amazon SKU is required.'
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
                    $data['MasterListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;            
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('MasterListing.amazon_sku' => $id))); 
              
                $lincode = $pcodes[0]['MasterListing']['linnworks_code'];                
                $Webcodes = $this->AdminListing->find('all', array('conditions' => array('AdminListing.linnworks_code' => $lincode)));               
                
                if ((!empty($pcodes))) {
                    
                    $apiConfig = (isset($pcodes[0]['MasterListing']) && is_array($pcodes[0]['MasterListing'])) ? ($pcodes[0]['MasterListing']) : array();
                    $data['MasterListing'] = array_merge($apiConfig, $data['MasterListing']);
                    $WebConfig = (isset($Webcodes[0]['AdminListing']) && is_array($Webcodes[0]['AdminListing'])) ? ($Webcodes[0]['AdminListing']) : array();
                    
                    
                     $itemsku = split("\_", $apiConfig['amazon_sku']); 
                     $frsku = split ("\-", $apiConfig['amazon_sku']); 
                     if($frsku[1]==='FBA'){$final=$frsku[1];}
                     if($frsku[2]==='FBA'){$final= $frsku[2];}
                              
                                         
                     if((($itemsku[1]) !== 'FBA') && (!empty($WebConfig['web_price_uk'])) && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MasterListing']['sale_price_uk'])) && (!empty($WebConfig['web_price_tesco'])) && (!empty($data['MasterListing']['price_uk'])) && ((($WebConfig['web_price_uk']) !== ($data['MasterListing']['price_uk'])) && (($WebConfig['web_price_tesco']) !== ($data['MasterListing']['price_uk'])) )) {
                        //$data['MasterListing'] = array_merge($apiConfig['price_uk'], $data['MasterListing']['price_uk']);
                        $limit = 'RRP  Web UK and Amazon UK and Tesco Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MasterListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk'])) && (!empty($data['MasterListing']['sale_price_uk'])) && (($WebConfig['web_sale_price_uk']) !== ($data['MasterListing']['sale_price_uk']))) {
                        // $data['MasterListing'] = array_merge($apiConfig['price_uk'], $data['MasterListing']['price_uk']);
                         $limit = 'Web UK and Amazon UK Sale Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                       
                   
                    }
                    
                    if((($itemsku[1]) === 'FBA') && (!empty($apiConfig['price_uk'])) && (!empty($data['MasterListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))){
                       // $data['MasterListing'] = array_merge($apiConfig['sale_price_uk'], $data['MasterListing']['sale_price_uk']);
                        $val = $data['MasterListing']['sale_price_uk']; $min = $WebConfig['web_sale_price_uk']+3; $max = $WebConfig['web_sale_price_uk']+6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Amazon UK Prim Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));                    
                         
                     }
                    }
                    if((($itemsku[1]) === 'FBA')){
                        
                        // FBA price adding
                        
                         $this->saveField('prime_price_uk',$data['MasterListing']['sale_price_uk'] , array($this->linnworks_code = $data['MasterListing']['linnworks_code'])); 
                         
                    }
                     if((($frsku[1]) === 'FBA')){
                        
                        // FBA price adding
                        
                         $this->saveField('prime_price_uk',$data['MasterListing']['sale_price_uk'] , array($this->linnworks_code = $data['MasterListing']['linnworks_code'])); 
                   
                    }
                     if((($frsku[2]) === 'FBA')){
                        
                        // FBA price adding
                        
                         $this->saveField('prime_price_uk',$data['MasterListing']['sale_price_uk'] , array($this->linnworks_code = $data['MasterListing']['linnworks_code'])); 
                   
                    }
                      
                    if((($itemsku[1]) === 'FBA') && (!empty($apiConfig['sale_price_uk'])) && (!empty($data['MasterListing']['sale_price_uk']))  && (!empty($data['MasterListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_dm'])) && (($WebConfig['web_sale_price_dm'])!==($data['MasterListing']['sale_price_uk']))) { 
                         //  $data['MasterListing'] = array_merge($apiConfig['sale_price_uk'], $data['MasterListing']['sale_price_uk']);
                        $limit = 'DM Price and UK Prime Sale Price Mismatch.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                      }
                // GBP Codition End and Start EUR Condition
                      
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_de'])) && (!empty($data['MasterListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_uk'])) && (!empty($WebConfig['web_sale_price_de']))){
                        //$data['MasterListing'] = array_merge($apiConfig['sale_price_uk'], $data['MasterListing']['sale_price_uk']);
                        $val = $WebConfig['web_sale_price_de']; $min = $WebConfig['web_sale_price_uk']*1.25; $max = $WebConfig['web_sale_price_uk']*1.6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Web DE Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));  
                        
                         
                     }
                    }
                    
                    if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (!empty($apiConfig['sale_price_de'])) && (!empty($data['MasterListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_de']))){
                       //$data['MasterListing'] = array_merge($apiConfig['sale_price_de'], $data['MasterListing']['sale_price_de']);
                       $val = $data['MasterListing']['sale_price_de']; $min = $WebConfig['web_sale_price_uk']*1.25; $max = $WebConfig['web_sale_price_uk']*1.6;
                     if($val >= $min && $val <= $max){ }else{
                         $limit = 'Amazon DE Min Price '.$min.'And Max Price '.$max;
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));        
                         
                     }
                    }
                   
                     if((($itemsku[1]) !== 'FBA') && (($final) !== 'FBA') && (((!empty($apiConfig['price_de'])) && (!empty($data['MasterListing']['price_de']))) || (!empty($apiConfig['price_fr']))) && (!empty($data['MasterListing']['price_de'])) && (!empty($WebConfig['web_price_de'])) && (!empty($data['MasterListing']['price_fr'])) && (!empty($WebConfig['web_price_fr'])) && ((($data['MasterListing']['price_fr'])!==($WebConfig['web_price_de'])) && (($data['MasterListing']['price_de'])!==($WebConfig['web_price_fr']))) && ((($data['MasterListing']['price_fr'])!==($data['MasterListing']['price_de'])) && (($WebConfig['price_de'])!==($WebConfig['web_price_fr'])))){
     
                        //$data['MasterListing'] = array_merge($apiConfig['price_fr'], $data['MasterListing']['price_fr']);
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
        'AdminListing' => array(
            'className' => 'AdminListing',
            'foreignKey' => false,
            'conditions' => 'MasterListing.linnworks_code = AdminListing.linnworks_code'
        )
               
    );
    
}