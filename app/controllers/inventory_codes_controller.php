<?php

class InventoryCodesController extends AppController {

    var $name = 'InventoryCodes';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
         
        $this->Auth->allow(array('index','linnworkcode'));
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