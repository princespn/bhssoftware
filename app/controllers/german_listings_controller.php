<?php

class GermanListingsController extends AppController {

    var $name = 'GermanListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
     
        /// Configure::write('Config.language', 'fra');
        $this->Auth->allow(array('index', 'delete', 'edit', 'import', 'update', 'categoriesPro', 'category', 'saleprice'));
    }

    public function index() {
        $this->set('title', 'German Amazon Listing information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['GermanListing']['all_item']))) {

            $string = explode(",", trim($this->data['GermanListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {
                $conditions = array('GermanListing.item_sku LIKE' => '%' . $prname . '%', 'GermanListing.item_sku LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'GermanListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('GermanListing.item_sku LIKE' => "%$prsku%", 'GermanListing.item_sku LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'GermanListing.id  ASC', 'conditions' => $conditions);
            }
            $this->GermanListing->recursive = 1;
            $this->set('german_listings', $this->paginate());
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($this->data['GermanListing']['error']) == 'error')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'GermanListing.error  DESC';
            } else {
                $orderfinal = 'GermanListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "german_listings.csv";
            $csv->auto($filepath); // array('GermanListing.id' => $checkboxid,'not' => array('GermanListing.error'=>null))		
            $conditions = array(array('GermanListing.id' => $checkboxid), 'AND' => array('GermanListing.error !=' => ''));
            $this->set('german_listings', $this->GermanListing->find('all', array('order' => $orderfinal, 'conditions' => $conditions)));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($_POST['selecctall']) == 'All')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'GermanListing.error  DESC';
            } else {
                $orderfinal = 'GermanListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "german_listings.csv";
            $csv->auto($filepath);
            $this->set('german_listings', $this->GermanListing->find('all', array('order' => $orderfinal, 'conditions' => array('GermanListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->GermanListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'GermanListing.id  ASC');
            $this->set('german_listings', $this->paginate());
        }
    }

    public function categoriesPro() {
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

    public function category($id) {

        $this->set('title', 'Master FR Amazon Listing information.');

        if ((!empty($id)) && (($id) === '--Select Category--')) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
        } else {
            $this->loadModel('GermanProductListing');
            $procategory = $this->GermanProductListing->find('list', array('fields' => 'product_sku', 'conditions' => array('GermanProductListing.category LIKE' => "%$id%")));
            $this->GermanListing->recursive = 1;
            $conditions = array('GermanListing.item_sku' => $procategory);
            $this->paginate = array('limit' => 500, 'order' => 'GermanListing.id  ASC', 'conditions' => $conditions);
            $this->set('foo', $id);
        }
        $this->GermanListing->recursive = 1;
        $this->set('german_listings', $this->paginate());
    }

    public function import() {

        $this->set('title', 'Import German Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['GermanListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['GermanListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanListing']['file']['name']))
                    $messages = $this->GermanListing->import($filename);
                $this->Session->setFlash(__('The German Amazon listing has Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {
                $this->Session->setFlash(__('The german Amazon listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'german_listings-old.csv';
            //$messages = $this->GermanListing->import($filename);
        }
    }

    public function update() {
        $this->set('title', 'Update German Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['GermanListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['GermanListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanListing']['file']['name']))
                    $messages = $this->GermanListing->update($filename);
                $this->Session->setFlash(__('The German Listing was Update successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The German Listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->GermanListing->import($filename);
        }
    }

    public function edit($item_sku = null) {
        $this->set('title', 'Edit German Amazon Listing.');

        if (!(empty($item_sku))) {
            $itemid = $this->GermanListing->findAllByItemSku($item_sku);
            $id = $itemid[0]['GermanListing']['id'];
        } else {
            $this->Session->setFlash(__('Invalid German Listing Product sku.', true));
            $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid German Listing Product sku.', true));
            $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->GermanListing->save($this->data['GermanListing'])) {
                $this->Session->setFlash(__('The German Listing was saved successfully', true));
                $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->GermanListing->read(null, $id);
        }
        //$users = $this->GermanListing->User->find('list');
        //$this->set(compact('users','class'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid German Listing ID in database.', true));
            $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
        } else {

            if ($this->GermanListing->delete($id)) {

                $this->Session->setFlash(__('The German Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The German Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'german_listings', 'action' => 'index'));
    }

}
