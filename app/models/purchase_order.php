<?php
class PurchaseOrder extends AppModel {

    var $name = 'PurchaseOrder';
    var $validate = array(
        'linnworks_code' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Linnworks code is required.'
            ),
        ),

      );
    
    
         public function importdata($filename) {
     
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
                    $data['PurchaseOrder'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('PurchaseOrder.linnworks_code' => $id)));
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['PurchaseOrder']) && is_array($pcodes[0]['PurchaseOrder'])) ? ($pcodes[0]['PurchaseOrder']) : array();
                    $data['PurchaseOrder'] = (isset($data['PurchaseOrder']) && is_array($data['PurchaseOrder'])) ? ($data['PurchaseOrder']) : array();
                    $data['PurchaseOrder'] = array_merge($apiConfig, $data['PurchaseOrder']);
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
           if (($this->saveAll($data, $validate = false)) && (!empty($id))) {
           
                    $value = date("Y-m-d");                   
                   $this->saveField('import_dates', $value, array($this->linnworks_code = $id));

               
            }
        }
        return $return;
        //fclose($handle);
    }



    var $hasOne = array(
        'AdminListing' => array(
            'className' => 'AdminListing',
            'foreignKey' => false,
            'conditions' => 'PurchaseOrder.linnworks_code = AdminListing.linnworks_code'
        ),
		
        'Multiplier' => array(
            'className' => 'Multiplier',
            'foreignKey' => false,
            'conditions' => array('PurchaseOrder.category = Multiplier.category','PurchaseOrder.supplier = Multiplier.supplier')
        ),
		
		'PurchasePrice' => array(
            'className' => 'PurchasePrice',
            'foreignKey' => false,
            'conditions' => 'PurchaseOrder.linnworks_code = PurchasePrice.item_sku'
        ),
		
		'StockItem' => array(
            'className' => 'StockItem',
            'foreignKey' => false,
            'conditions' => 'PurchaseOrder.linnworks_code = StockItem.item_number'
        )
       
    );
    
}