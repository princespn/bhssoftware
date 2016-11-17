<?php

class ProductListingsController extends AppController {

    var $name = 'ProductListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
       // $this->layout = 'defaultm';
        $this->Auth->allow(array('delete', 'logout', 'index', 'edit', 'importcode'));
    }
    

    public function index() {//die();
        $this->set('title', 'Product code information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['ProductListing']['all_item']))) {

            $string = explode(",", trim($this->data['ProductListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('ProductListing.product_code LIKE' => '%' . $prname . '%', 'ProductListing.product_sku LIKE' => '%' . $prsku . '%', 'ProductListing.product_asin LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'ProductListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('ProductListing.product_code LIKE' => "%$prsku%", 'ProductListing.product_sku LIKE' => "%$prsku%", 'ProductListing.product_asin LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'ProductListing.id  ASC', 'conditions' => $conditions);
            }

            $this->set('product_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "product_listings.csv";
            $csv->auto($filepath);
            $this->set('product_listings', $this->ProductListing->find('all', array('ProductListing.id ASC', 'conditions' => array('ProductListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;            
            Configure::write('debug', '2');
        } else {
            $this->ProductListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'ProductListing.id  ASC');
            $this->set('product_listings', $this->paginate());
        }
    }
    

    public function importcode() {

        $this->set('title', 'Import Product code information.');

        if (!empty($this->data)) {
            $filename = $this->data['ProductListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['ProductListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['ProductListing']['file']['name']))
                    $messages = $this->ProductListing->importcode($filename);
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

    public function edit($id = null) {


        $this->set('title', 'Edit Product code information.');


        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Product Code Id.', true));
            $this->redirect(array('controller' => 'product_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->ProductListing->save($this->data['EnglishListing'])) {
                $this->Session->setFlash(__('The Product Code saved successfully', true));
                $this->redirect(array('controller' => 'product_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->ProductListing->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Product Code ID in database.', true));
            $this->redirect(array('controller' => 'product_listings', 'action' => 'index'));
        } else {

            if ($this->ProductListing->delete($id)) {

                $this->Session->setFlash(__('Product Code deleted successfully.', true));
                $this->redirect(array('controller' => 'product_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! Product Code could not be deleted!', true));
        $this->redirect(array('controller' => 'product_listings', 'action' => 'index'));
    }

}
