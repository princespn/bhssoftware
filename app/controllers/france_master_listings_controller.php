<?php

class FranceMasterListingsController extends AppController {

    var $name = 'FranceMasterListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        Configure::write('Config.language', 'fra');
        $this->Auth->allow(array('index', 'delete', 'edit', 'import', 'update', 'categoriesPro', 'category', 'saleprice'));
    }

    public function index() {
        $this->set('title', 'Master FR Amazon Listing information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['FranceMasterListing']['all_item']))) {

            $string = explode(",", trim($this->data['FranceMasterListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {
                $conditions = array('FranceMasterListing.item_sku LIKE' => '%' . $prname . '%', 'FranceMasterListing.item_sku LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'FranceMasterListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('FranceMasterListing.item_sku LIKE' => "%$prsku%", 'FranceMasterListing.item_sku LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'FranceMasterListing.id  ASC', 'conditions' => $conditions);
            }
            $this->FranceMasterListing->recursive = 1;
            $this->set('france_master_listings', $this->paginate());
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($this->data['FranceMasterListing']['error']) == 'error')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'FranceMasterListing.error  DESC';
            } else {
                $orderfinal = 'FranceMasterListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "france_master_listings.csv";
            $csv->auto($filepath); // array('FranceMasterListing.id' => $checkboxid,'not' => array('FranceMasterListing.error'=>null))		
            $conditions = array(array('FranceMasterListing.id' => $checkboxid), 'AND' => array('FranceMasterListing.error !=' => ''));
            $this->set('france_master_listings', $this->FranceMasterListing->find('all', array('order' => $orderfinal, 'conditions' => $conditions)));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($_POST['selecctall']) == 'All')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'FranceMasterListing.error  DESC';
            } else {
                $orderfinal = 'FranceMasterListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "france_master_listings.csv";
            $csv->auto($filepath);
            $this->set('france_master_listings', $this->FranceMasterListing->find('all', array('order' => $orderfinal, 'conditions' => array('FranceMasterListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->FranceMasterListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'FranceMasterListing.id  ASC');
            $this->set('france_master_listings', $this->paginate());
        }
    }

    function categoriesPro() {
        $this->loadModel('FranceProductListing');
        $procategory = $this->FranceProductListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
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

        $this->set('title', 'Master FR Amazon Listing information.');

        if ((!empty($id)) && (($id) === '--Select Category--')) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
        } else {
            $this->loadModel('FranceProductListing');
            $procategory = $this->FranceProductListing->find('list', array('fields' => 'product_sku', 'conditions' => array('FranceProductListing.category LIKE' => "%$id%")));
            $this->FranceMasterListing->recursive = 1;
            $conditions = array('FranceMasterListing.item_sku' => $procategory);
            $this->paginate = array('limit' => 500, 'order' => 'FranceMasterListing.id  ASC', 'conditions' => $conditions);
            $this->set('foo', $id);
        }
        $this->FranceMasterListing->recursive = 1;
        $this->set('france_master_listings', $this->paginate());
    }

    function import() {

        $this->set('title', 'Import Master FR Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['FranceMasterListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['FranceMasterListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceMasterListing']['file']['name']))
                    $messages = $this->FranceMasterListing->import($filename);
                $this->Session->setFlash(__('The Master Amazon FR listing has Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master Amazon FR listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'france_master_listings-old.csv';
            //$messages = $this->FranceMasterListing->import($filename);
        }
    }

    public function update() {

        $this->set('title', 'Update Master FR Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['FranceMasterListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['FranceMasterListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceMasterListing']['file']['name']))
                    $messages = $this->FranceMasterListing->update($filename);
                $this->Session->setFlash(__('The Master FR Listing was Update successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master FR Listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->FranceMasterListing->import($filename);
        }
    }

    public function edit($item_sku = null) {
        $this->set('title', 'Edit Master UK Amazon Listing.');

        if (!(empty($item_sku))) {
            $itemid = $this->FranceMasterListing->findAllByItemSku($item_sku);
            $id = $itemid[0]['FranceMasterListing']['id'];
        } else {
            $this->Session->setFlash(__('Invalid FR Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->FranceMasterListing->save($this->data['FranceMasterListing'])) {
                $this->Session->setFlash(__('The FR Master Listing was saved successfully', true));
                $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FranceMasterListing->read(null, $id);
        }
        //$users = $this->FranceMasterListing->User->find('list');
        //$this->set(compact('users','class'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid FR Master Listing ID in database.', true));
            $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
        } else {

            if ($this->FranceMasterListing->delete($id)) {

                $this->Session->setFlash(__('The FR Master Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The FR Master Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'france_master_listings', 'action' => 'index'));
    }

}
