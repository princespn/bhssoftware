<?php

class InventoryCodesController extends AppController {

    var $name = 'InventoryCodes';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
         
        $this->Auth->allow(array('index','linnworkcode','delete','edit'));
    }

     public function index() {
        $this->set('title', 'Linnworks code information.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['InventoryCode']['all_item']))) {

            $string = explode(",", trim($this->data['InventoryCode']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {
                $prname = $string[1];
            }
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('InventoryCode.linnworks_code LIKE' => '%' . $prname . '%', 'InventoryCode.linnworks_code LIKE' => '%' . $prsku . '%');
                $this->paginate = array('limit' => 1000, 'order' => 'InventoryCode.id  ASC', 'conditions' => $conditions);
            }
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('InventoryCode.linnworks_code LIKE' => "%$prsku%", 'InventoryCode.linnworks_code LIKE' => "%$prsku%"));
                $this->paginate = array('limit' => 1000, 'order' => 'InventoryCode.id  ASC', 'conditions' => $conditions);
            }

            $this->set('inventory_codes', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "inventory_codes.csv";
            $csv->auto($filepath);
            $this->set('inventory_codes', $this->InventoryCode->find('all', array('InventoryCode.id ASC', 'conditions' => array('InventoryCode.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;            
            Configure::write('debug', '2');
        } else {
            $this->InventoryCode->recursive = 1;
            $this->paginate = array('limit' => 1000, 'order' => 'InventoryCode.id  ASC');
            $this->set('inventory_codes', $this->paginate());
        }
    }


    public function edit($id = null) {


        $this->set('title', 'Edit Linnworks Code Information Data.');


        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid ID.', true));
            $this->redirect(array('controller' => 'inventory_codes ', 'action' => 'index'));
        }
        if (!empty($this->data)) {

//print_r($this->data['MasterListing']);die();
            if ($this->InventoryCode->save($this->data['InventoryCode'])) {
                $this->Session->setFlash(__('The Linnworks Code save successfully', true));
                $this->redirect(array('controller' => 'inventory_codes', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->InventoryCode->read(null, $id);
        }
    }


    public function delete($id = null) {
        //print_r($id);die();
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'inventory_codes', 'action' => 'index'));
        } else {

            if ($this->InventoryCode->delete($id)) {

                $this->Session->setFlash(__('The Linnworks Code was deleted successfully.', true));
                $this->redirect(array('controller' => 'inventory_codes', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Linnworks Code could not be deleted!', true));
        $this->redirect(array('controller' => 'inventory_codes', 'action' => 'index'));
    }

    

    public function linnworkcode() {

        $this->set('title', 'Import Linnworks code information');

        if (!empty($this->data)) {
            $filename = $this->data['InventoryCode']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['InventoryCode']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['InventoryCode']['file']['name']))
                    $messages = $this->InventoryCode->linnworkcode($filename);
                $this->Session->setFlash(__('Linnworks Code Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('Linnworks Code File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }
    }


}