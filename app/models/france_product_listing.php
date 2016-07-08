<?php
class FranceProductListing extends AppModel {
	
         var $name = 'FranceProductListing';
		 var $validate = array(
                    'product_sku' => array(				
					'Unique-1' => array(
					'rule' => 'notempty',					
					'message' => 'Product sku is required'
					),									
					),			
					 
        );

		public function importcode($filename)
			{
                $i = null; $error = null;
                $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
                $handle = fopen($filename, "r");
                $header = fgetcsv($handle);
                $return = array(
                //'messages' => array(),
                'errors' => array(),
                );

                while (($row = fgetcsv($handle)) !== FALSE)
                {
                        $i++;
                        $data = array();
                        $erritem = array();

                        foreach ($header as $k=>$head)
                        {
                            if (strpos($head,'.')!==false) 
                            {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                            }
                            else 
                            {
                            $data['FranceProductListing'][$head]=(isset($row[$k])) ? $row[$k] : '';
                            }
                        }

                        $id = isset($row[0]) ? $row[0] : 0;
                        if (!empty($id))
                        {	
							
							$pcodes = $this->find('all', array('conditions' => array('FranceProductListing.product_sku' =>$id)));
                                                        if ((!empty($pcodes)))
                                                        {
                                                            $apiConfig = (isset($pcodes[0]['FranceProductListing']) && is_array($pcodes[0]['FranceProductListing'])) ? ($pcodes[0]['FranceProductListing']) : array(); 
                                                            $data['FranceProductListing'] = array_merge($apiConfig,$data['FranceProductListing']);

                                                        }
							else 
                                                        {					   
                                                     $this->id = $id;						
                                                        }
                        }
                        else 
                        {
                        $this->create();
                        }
                        //debug($data);

                             $this->set($data);
                            if (!$this->validates())
                            {		if(!empty($this->validationErrors['product_sku'])){
                                    $limit = $this->validationErrors['product_sku'] ;				
                                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.",$i), true);
                                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.",$i), true);
                                        }									 
                            }
                            if ($this->saveAll($data,$validate = false)) 
                            {
                                if (!empty($id)) {
                                $err = implode("\n",$erritem);
                                $this->saveField('error',$err,array($this->product_sku = $id));
                                }
                                else
                                {
                                $err = implode("\n",$erritem);
                                $this->saveField('error',$err,array($this->id = $i));		

                                }
                            }
                }
                return $return;
                fclose($handle);
        }	
        
		var $hasOne = array(
            'FranceMasterListing' => array(
            'className' => 'FranceMasterListing',
            'foreignKey' => false,
            'conditions' =>  'FranceProductListing.product_sku = FranceMasterListing.item_sku'
            ),			
        );

}