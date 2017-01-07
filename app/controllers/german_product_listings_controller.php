<?php

class GermanProductListingsController extends AppController {

    var $name = 'GermanProductListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

     function beforeFilter() {
        parent::beforeFilter();
       
        $this->Auth->allow(array('delete', 'logout', 'index', 'edit', 'importcode'));
    }


    public function index() {
        $this->set('title', 'German Product code information.');
        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['GermanProductListing']['all_item']))) {

            $string = explode(",", trim($this->data['GermanProductListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('GermanProductListing.product_code LIKE' => '%' . $prname . '%', 'GermanProductListing.product_sku LIKE' => '%' . $prsku . '%', 'GermanProductListing.product_asin LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'GermanProductListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('GermanProductListing.product_code LIKE' => "%$prsku%", 'GermanProductListing.product_sku LIKE' => "%$prsku%", 'GermanProductListing.product_asin LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'GermanProductListing.id  ASC', 'conditions' => $conditions);
            }

            $this->set('german_product_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "german_product_listings.csv";
            $csv->auto($filepath);
            $this->set('german_product_listings', $this->GermanProductListing->find('all', array('GermanProductListing.id ASC', 'conditions' => array('GermanProductListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->GermanProductListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'GermanProductListing.id  ASC');
            $this->set('german_product_listings', $this->paginate());
        }
    }

    public function importcode() {
        $this->set('title', 'Import German Product code information.');

        if (!empty($this->data)) {
            $filename = $this->data['GermanProductListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['GermanProductListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanProductListing']['file']['name']))
                    $messages = $this->GermanProductListing->importcode($filename);
                $this->Session->setFlash(__('Product Code Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {
                $this->Session->setFlash(__('Product Code File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }
    }

}
