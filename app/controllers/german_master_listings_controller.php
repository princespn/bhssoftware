<?php

class GermanMasterListingsController extends AppController {

    var $name = 'GermanMasterListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        
        //  Configure::write('Config.language', 'de');
        $this->Auth->allow(array('index', 'delete', 'edit', 'import', 'update', 'categoriesPro', 'category', 'saleprice'));
    }

    public function index() {
        $this->set('title', 'Master DE Amazon Listing information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['GermanMasterListing']['all_item']))) {

            $string = explode(",", trim($this->data['GermanMasterListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {
                $conditions = array('GermanMasterListing.item_sku LIKE' => '%' . $prname . '%', 'GermanMasterListing.item_sku LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'GermanMasterListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('GermanMasterListing.item_sku LIKE' => "%$prsku%", 'GermanMasterListing.item_sku LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'GermanMasterListing.id  ASC', 'conditions' => $conditions);
            }
            $this->germanMasterListing->recursive = 1;
            $this->set('german_master_listings', $this->paginate());
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($this->data['GermanMasterListing']['error']) == 'error')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'GermanMasterListing.error  DESC';
            } else {
                $orderfinal = 'GermanMasterListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "german_master_listings.csv";
            $csv->auto($filepath); // array('GermanMasterListing.id' => $checkboxid,'not' => array('GermanMasterListing.error'=>null))		
            $conditions = array(array('GermanMasterListing.id' => $checkboxid), 'AND' => array('GermanMasterListing.error !=' => ''));
            $this->set('german_master_listings', $this->GermanMasterListing->find('all', array('order' => $orderfinal, 'conditions' => $conditions)));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($_POST['selecctall']) == 'All')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'GermanMasterListing.error  DESC';
            } else {
                $orderfinal = 'GermanMasterListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "german_master_listings.csv";
            $csv->auto($filepath);
            $this->set('german_master_listings', $this->GermanMasterListing->find('all', array('order' => $orderfinal, 'conditions' => array('GermanMasterListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->GermanMasterListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'GermanMasterListing.id  ASC');
            $this->set('german_master_listings', $this->paginate());
        }
    }

    function categoriesPro() {
        $this->loadModel('GermanProductListing');
        $procategory = $this->GermanProductListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
        return $procategory;
    }

    public function saleprice() {
        $url = 'freeopd.com/homescapes/downloadCSV.php?regularprice';
        $ch = curl_init();
        $timeout = 15;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function category($id) {

        $this->set('title', 'Master DE Amazon Listing information.');

        if ((!empty($id)) && (($id) === '--Select Category--')) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
        } else {
            $this->loadModel('GermanProductListing');
            $procategory = $this->GermanProductListing->find('list', array('fields' => 'product_sku', 'conditions' => array('GermanProductListing.category LIKE' => "%$id%")));
            $this->GermanMasterListing->recursive = 1;
            $conditions = array('GermanMasterListing.item_sku' => $procategory);
            $this->paginate = array('limit' => 500, 'order' => 'GermanMasterListing.id  ASC', 'conditions' => $conditions);
            $this->set('foo', $id);
        }
        $this->GermanMasterListing->recursive = 1;
        $this->set('german_master_listings', $this->paginate());
    }

    function import() {

        $this->set('title', 'Import Master DE Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['GermanMasterListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['GermanMasterListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanMasterListing']['file']['name']))
                    $messages = $this->GermanMasterListing->import($filename);
                $this->Session->setFlash(__('The Master Amazon DE listing has Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master Amazon DE listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'german_master_listings-old.csv';
            //$messages = $this->GermanMasterListing->import($filename);
        }
    }

    public function update() {

        $this->set('title', 'Update Master DE Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['GermanMasterListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['GermanMasterListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanMasterListing']['file']['name']))
                    $messages = $this->GermanMasterListing->update($filename);
                $this->Session->setFlash(__('The Master DE Listing was Update successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master DE Listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->GermanMasterListing->import($filename);
        }
    }

    public function edit($item_sku = null) {
        $this->set('title', 'Edit Master UK Amazon Listing.');

        if (!(empty($item_sku))) {
            $itemid = $this->GermanMasterListing->findAllByItemSku($item_sku);
            $id = $itemid[0]['GermanMasterListing']['id'];
        } else {
            $this->Session->setFlash(__('Invalid DE Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->GermanMasterListing->save($this->data['GermanMasterListing'])) {
                $this->Session->setFlash(__('The DE Master Listing was saved successfully', true));
                $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->GermanMasterListing->read(null, $id);
        }
        //$users = $this->GermanMasterListing->User->find('list');
        //$this->set(compact('users','class'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid DE Master Listing ID in database.', true));
            $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
        } else {

            if ($this->GermanMasterListing->delete($id)) {

                $this->Session->setFlash(__('The DE Master Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The DE Master Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'german_master_listings', 'action' => 'index'));
    }

}
