<?php
class MasterListingsController extends AppController {

    var $name = 'MasterListings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');



    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('categories', 'index_prices', 'index','importcode','category','edit','delete'));
    }




    public function index() {

        $this->loadModel('Shipping');

        $this->paginate = array('limit' => 3, 'order' => 'Shipping.id');
        $getshipppings   =	$this->Shipping->find('all',array('fields' => array('Shipping.*')),$this->paginate());

        $this->set('title', 'Master listing database.');
        $condFba = (strpos('MasterListing.amazon_sku', 'FBA') !== false);

        $this->paginate = array('limit' => 100, 'order' => 'MasterListing.id', 'conditions' => $condFba);
        $Amazonuk   =	$this->MasterListing->find('all',array('fields' => array('MasterListing.*')),$this->paginate());
        $this->set(compact('Amazonuk','getshipppings'));

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['MasterListing']['all_item']))) {
            $string = explode(",", trim($this->data['MasterListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('MasterListing.linnworks_code LIKE' => '%' . $prname . '%', 'MasterListing.linnworks_code LIKE' => '%' . $prsku . '%', 'MasterListing.amazon_sku LIKE' => '%' . $prsku . '%');
                $this->MasterListing->recursive = 1;
                $this->paginate = array('limit' => 100, 'group' => 'MasterListing.linnworks_code','order' => 'MasterListing.id', 'conditions' => $conditions);
            }

            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('MasterListing.linnworks_code LIKE' => "%$prsku%", 'MasterListing.linnworks_code LIKE' => "%$prsku%", 'MasterListing.amazon_sku LIKE' => "%$prsku%"));
                $this->MasterListing->recursive = 1;
                $this->paginate = array('limit' => 100, 'group' => 'MasterListing.linnworks_code','order' => 'MasterListing.id', 'conditions' => $conditions);
            }

            $this->set('code_listings', $this->paginate());

        }


        else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "code_listings.csv";
            $csv->auto($filepath);
            $this->MasterListing->recursive = 1;
            $this->set('code_listings',$this->MasterListing->find('all', array('fields' => array('MasterListing.linnworks_code','MasterListing.category','MasterListing.product_name','MasterListing.amazon_sku','AdminListing.web_sku','AdminListing.web_price_uk','AdminListing.web_price_dm','MasterListing.price_uk','AdminListing.web_sale_price_uk','AdminListing.web_sale_price_tesco','AdminListing.web_sale_price_dm','MasterListing.sale_price_uk','AdminListing.web_price_de','MasterListing.price_de','AdminListing.web_price_fr','MasterListing.price_fr','AdminListing.web_sale_price_de','MasterListing.sale_price_de','AdminListing.web_sale_price_fr','MasterListing.sale_price_fr','MasterListing.error'),'conditions' => array('MasterListing.id' => $checkboxid))));
            //$this->set('code_listings', $this->MasterListing->find('all', array('MasterListing.id ASC', 'conditions' => array('MasterListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MasterListing->recursive = 1;
            $this->paginate = array('limit' => 100, 'group' => 'MasterListing.linnworks_code','order' => 'MasterListing.id');
            $this->set('code_listings', $this->paginate());

        }

    }


    public function index_prices() {

        $this->set('title', 'Amazon Prices  Inventory Database.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['MasterListing']['all_item']))) {

            $string = explode(",", trim($this->data['MasterListing']['all_item']));
            $prsku = $string[0];

            if (!empty($string[1])){$prname = $string[1];}

            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('MasterListing.linnworks_code LIKE' => '%' . $prname . '%', 'MasterListing.linnworks_code LIKE' => '%' . $prsku . '%', 'MasterListing.amazon_sku LIKE' => '%' . $prsku . '%');
                $this->MasterListing->recursive = 1;
                $this->paginate = array('limit' => 500, 'order' => 'MasterListing.id', 'conditions' => $conditions);
            }

            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('MasterListing.linnworks_code LIKE' => "%$prsku%", 'MasterListing.linnworks_code LIKE' => "%$prsku%", 'MasterListing.amazon_sku LIKE' => "%$prsku%"));
                $this->MasterListing->recursive = 1;
                $this->paginate = array('limit' => 500, 'order' => 'MasterListing.id', 'conditions' => $conditions);
            }

            $this->set('code_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "amazon_price_listings.csv";
            $csv->auto($filepath);
            $this->MasterListing->recursive = 1;
            $this->set('code_listings', $this->MasterListing->find('all', array('MasterListing.id ASC', 'conditions' => array('MasterListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MasterListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'MasterListing.amazon_sku');
            Configure::write('debug', '0');
            $this->set('code_listings', $this->paginate());
        }

    }




    public function importcode() {

        $this->set('title', 'Linnwork codes and SKU Mapping information.');

        if (!empty($this->data)) {
            $filename = $this->data['MasterListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            //print_r($this->data['MasterListing']['file']['tmp_name']); die();

            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['MasterListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['MasterListing']['file']['name']))
                    // $messages = $this->MasterListing->importcode($filename);
                    $messages = $this->MasterListing->importcode($filename);
                $this->Session->setFlash(__('Linnwork codes and SKU Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('File format not supported,Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }
    }

    public function categories(){

        $procategory = $this->MasterListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
        return $procategory;

    }


    public function category($catn) {

        $this->set('title', 'Master listing database.');

        $catname = urldecode($catn);

        $this->loadModel('Shipping');

        $this->paginate = array('limit' => 3, 'order' => 'Shipping.id');
        $getshipppings   =	$this->Shipping->find('all',array('fields' => array('Shipping.*')),$this->paginate());


        $conditions = array('MasterListing.category LIKE' => '%' . $catname . '%');
        $this->paginate = array('limit' => 100, 'order' => 'MasterListing.id', 'conditions' => $conditions);
        $Amazonuk   =	$this->MasterListing->find('all',array('fields' => array('MasterListing.*')),$this->paginate());
        $this->set(compact('Amazonuk','getshipppings'));


        if (empty($catname)) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'master_listings', 'action' => 'index'));
        } else {

            $this->MasterListing->recursive = 1;
            $conditions = array('MasterListing.category LIKE' => '%' . $catname . '%');
            $this->paginate = array('limit' => 100, 'group' => 'MasterListing.linnworks_code','order' => 'MasterListing.id', 'conditions' => $conditions);
           // $this->set(compact('Amazonuk'));

        }
        $this->MasterListing->recursive = 1;
        $this->set('code_listings', $this->paginate());
        //$this->set(compact('Amazonuk'));
    }


    public function edit($id = null) {


        $this->set('title', 'Edit Amazon Price Listing.');


        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Amazon price id.', true));
            $this->redirect(array('controller' => 'master_listings ', 'action' => 'index'));
        }
        if (!empty($this->data)) {

//print_r($this->data['MasterListing']);die();
            if ($this->MasterListing->save($this->data['MasterListing'])) {
                $this->Session->setFlash(__('The Amazon price listing save successfully', true));
                $this->redirect(array('controller' => 'master_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->MasterListing->read(null, $id);
        }
    }


    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid UK Listing ID in database.', true));
            $this->redirect(array('controller' => 'master_listings', 'action' => 'index_prices'));
        } else {

            if ($this->MasterListing->delete($id)) {

                $this->Session->setFlash(__('The Amazon Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'master_listings', 'action' => 'index_prices'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Amazon Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'master_listings', 'action' => 'index_prices'));
    }





}
