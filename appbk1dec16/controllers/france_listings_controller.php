<?php

class FranceListingsController extends AppController {

    var $name = 'FranceListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        Configure::write('Config.language', 'fra');
        $this->Auth->allow(array('index', 'delete', 'edit', 'import', 'update', 'categoriesPro', 'category', 'saleprice'));
    }

    public function index() {
        $this->set('title', 'France Amazon Listing information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['FranceListing']['all_item']))) {

            $string = explode(",", trim($this->data['FranceListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {
                $conditions = array('FranceListing.item_sku LIKE' => '%' . $prname . '%', 'FranceListing.item_sku LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'FranceListing.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('FranceListing.item_sku LIKE' => "%$prsku%", 'FranceListing.item_sku LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'FranceListing.id  ASC', 'conditions' => $conditions);
            }
            $this->FranceListing->recursive = 1;
            $this->set('france_listings', $this->paginate());
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($this->data['FranceListing']['error']) == 'error')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'FranceListing.error  DESC';
            } else {
                $orderfinal = 'FranceListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "france_listings.csv";
            $csv->auto($filepath); // array('FranceListing.id' => $checkboxid,'not' => array('FranceListing.error'=>null))		
            $conditions = array(array('FranceListing.id' => $checkboxid), 'AND' => array('FranceListing.error !=' => ''));
            $this->set('france_listings', $this->FranceListing->find('all', array('order' => $orderfinal, 'conditions' => $conditions)));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($_POST['selecctall']) == 'All')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'FranceListing.error  DESC';
            } else {
                $orderfinal = 'FranceListing.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "france_listings.csv";
            $csv->auto($filepath);
            $this->set('france_listings', $this->FranceListing->find('all', array('order' => $orderfinal, 'conditions' => array('FranceListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->FranceListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'FranceListing.id  ASC');
            $this->set('france_listings', $this->paginate());
        }
    }

    public function categoriesPro() {
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

    public function category($id) {

        $this->set('title', 'Master FR Amazon Listing information.');

        if ((!empty($id)) && (($id) === '--Select Category--')) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
        } else {
            $this->loadModel('FranceProductListing');
            $procategory = $this->FranceProductListing->find('list', array('fields' => 'product_sku', 'conditions' => array('FranceProductListing.category LIKE' => "%$id%")));
            $this->FranceListing->recursive = 1;
            $conditions = array('FranceListing.item_sku' => $procategory);
            $this->paginate = array('limit' => 500, 'order' => 'FranceListing.id  ASC', 'conditions' => $conditions);
            $this->set('foo', $id);
        }
        $this->FranceListing->recursive = 1;
        $this->set('france_listings', $this->paginate());
    }

    public function import() {

        $this->set('title', 'Import France Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['FranceListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['FranceListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceListing']['file']['name']))
                    $messages = $this->FranceListing->import($filename);
                $this->Session->setFlash(__('The France Amazon listing has Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {
                $this->Session->setFlash(__('The france Amazon listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'france_listings-old.csv';
            //$messages = $this->FranceListing->import($filename);
        }
    }

    public function update() {
        $this->set('title', 'Update France Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['FranceListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['FranceListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceListing']['file']['name']))
                    $messages = $this->FranceListing->update($filename);
                $this->Session->setFlash(__('The France Listing was Update successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The France Listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->FranceListing->import($filename);
        }
    }

    public function edit($item_sku = null) {
        $this->set('title', 'Edit France Amazon Listing.');

        if (!(empty($item_sku))) {
            $itemid = $this->FranceListing->findAllByItemSku($item_sku);
            $id = $itemid[0]['FranceListing']['id'];
        } else {
            $this->Session->setFlash(__('Invalid France Listing Product sku.', true));
            $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid France Listing Product sku.', true));
            $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->FranceListing->save($this->data['FranceListing'])) {
                $this->Session->setFlash(__('The France Listing was saved successfully', true));
                $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FranceListing->read(null, $id);
        }
        //$users = $this->FranceListing->User->find('list');
        //$this->set(compact('users','class'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid France Listing ID in database.', true));
            $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
        } else {

            if ($this->FranceListing->delete($id)) {

                $this->Session->setFlash(__('The France Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The France Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'france_listings', 'action' => 'index'));
    }

}
