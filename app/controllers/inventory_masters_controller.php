<?php

class InventoryMastersController extends AppController {

    var $name = 'InventoryMasters';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
         
        $this->Auth->allow(array('index', 'delete', 'edit', 'import', 'update', 'categoriesPro', 'category', 'saleprice'));
    }

    function index() {
        $this->set('title', 'Master UK Amazon Listing information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['InventoryMaster']['all_item']))) {

            $string = explode(",", trim($this->data['InventoryMaster']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {
                $this->loadModel('ProductListing');
                $conditions = array('InventoryMaster.item_sku LIKE' => '%' . $prname . '%', 'InventoryMaster.item_sku LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 500, 'order' => 'InventoryMaster.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('InventoryMaster.item_sku LIKE' => "%$prsku%", 'InventoryMaster.item_sku LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 500, 'order' => 'InventoryMaster.id  ASC', 'conditions' => $conditions);
            }
            $this->InventoryMaster->recursive = 1;
            $this->set('inventory_masters', $this->paginate());
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($this->data['InventoryMaster']['error']) == 'error')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'InventoryMaster.error  DESC';
            } else {
                $orderfinal = 'InventoryMaster.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "inventory_masters.csv";
            $csv->auto($filepath); // array('InventoryMaster.id' => $checkboxid,'not' => array('InventoryMaster.error'=>null))		
            $conditions = array(array('InventoryMaster.id' => $checkboxid), 'AND' => array('InventoryMaster.error !=' => ''));
            $this->set('inventory_masters', $this->InventoryMaster->find('all', array('order' => $orderfinal, 'conditions' => $conditions)));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } elseif ((!empty($_POST['checkid'])) && (!empty($_POST['exports'])) && (($_POST['selecctall']) == 'All')) {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $orderfinal = 'InventoryMaster.error  DESC';
            } else {
                $orderfinal = 'InventoryMaster.id  ASC';
            }
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "inventory_masters.csv";
            $csv->auto($filepath);
            $this->set('inventory_masters', $this->InventoryMaster->find('all', array('order' => $orderfinal, 'conditions' => array('InventoryMaster.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->InventoryMaster->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'InventoryMaster.id  ASC');
            $this->set('inventory_masters', $this->paginate());
        }
    }

    function categoriesPro() {
        $this->loadModel('ProductListing');
        $procategory = $this->ProductListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
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

        $this->set('title', 'Master UK Amazon Listing information.');

        if ((empty($id)) && (($id) === '--Select Category--')) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
        } else {
            $catname = urldecode($id);
            $this->loadModel('ProductListing');
            $procategory = $this->ProductListing->find('list', array('fields' => 'product_sku', 'conditions' => array('ProductListing.category LIKE' => "%$catname%")));
            $this->InventoryMaster->recursive = 1;
            $conditions = array('InventoryMaster.item_sku' => $procategory);
            $this->paginate = array('limit' => 500, 'order' => 'InventoryMaster.id  ASC', 'conditions' => $conditions);
            $this->set('foo', $id);
        }
        $this->InventoryMaster->recursive = 1;
        $this->set('inventory_masters', $this->paginate());
    }
    

    function import() {
        $this->set('title', 'Import Master UK Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['InventoryMaster']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['InventoryMaster']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['InventoryMaster']['file']['name']))
                    $messages = $this->InventoryMaster->import($filename);
                $this->Session->setFlash(__('The Master listing has Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->InventoryMaster->import($filename);
        }
    }
    

    function update() {

        $this->set('title', 'Update Master UK Amazon Listing.');

        if (!empty($this->data)) {
            $filename = $this->data['InventoryMaster']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['InventoryMaster']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['InventoryMaster']['file']['name']))
                    $messages = $this->InventoryMaster->update($filename);
                $this->Session->setFlash(__('The Master Listing was Update successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('The Master Listing File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->InventoryMaster->import($filename);
        }
    }

   
  
    public function edit($item_sku = null) {
        $this->set('title', 'Edit Master UK Amazon Listing.');

        if (!(empty($item_sku))) {
            $itemid = $this->InventoryMaster->findAllByItemSku($item_sku);
            $id = $itemid[0]['InventoryMaster']['id'];
        } else {
            $this->Session->setFlash(__('Invalid Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
        }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Master Listing Product sku.', true));
            $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->InventoryMaster->save($this->data['InventoryMaster'])) {
                $this->Session->setFlash(__('The Master Listing was saved successfully', true));
                $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->InventoryMaster->read(null, $id);
        }
    
    }
    
    
    

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Master Listing ID in database.', true));
            $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
        } else {

            if ($this->InventoryMaster->delete($id)) {

                $this->Session->setFlash(__('The Master Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Master Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'inventory_masters', 'action' => 'index'));
    }

}