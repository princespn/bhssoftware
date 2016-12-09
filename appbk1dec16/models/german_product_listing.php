<?php

class GermanProductListing extends AppModel {

    var $name = 'GermanProductListing';
    var $validate = array(
        'product_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Product sku is required'
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
                    $data['GermanProductListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('GermanProductListing.product_sku' => $id)));
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['GermanProductListing']) && is_array($pcodes[0]['GermanProductListing'])) ? ($pcodes[0]['GermanProductListing']) : array();
                    $data['GermanProductListing'] = array_merge($apiConfig, $data['GermanProductListing']);
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['product_sku'])) {
                    $limit = $this->validationErrors['product_sku'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->product_sku = $id));
                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        fclose($handle);
    }

    var $hasOne = array(
        'GermanMasterListing' => array(
            'className' => 'GermanMasterListing',
            'foreignKey' => false,
            'conditions' => 'GermanProductListing.product_sku = GermanMasterListing.item_sku'
        ),
        'GermanListing' => array(
            'className' => 'GermanListing',
            'foreignKey' => false,
            'conditions' => 'GermanProductListing.product_sku = GermanListing.item_sku'
        ),
    );

}
