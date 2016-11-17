<?php
class MainListingsController extends AppController {

	var $name = 'MainListings';
        var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');       

  

    function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'defaultm';
        $this->Auth->allow(array('categories', 'index_prices', 'index','importcode','category','edit'));	
	}
        
        
         function index() {
             
            $this->set('title', 'Linnwork codes and SKU Mapping Inventory Database.');
            
         
               
        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['MainListing']['all_item']))) {
            
            $string = explode(",", trim($this->data['MainListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('MainListing.linnworks_code LIKE' => '%' . $prname . '%', 'MainListing.linnworks_code LIKE' => '%' . $prsku . '%', 'MainListing.amazon_sku LIKE' => '%' . $prsku . '%');
                $this->MainListing->recursive = 1;
                $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC', 'conditions' => $conditions);
            }
            
            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.amazon_sku LIKE' => "%$prsku%"));
               $this->MainListing->recursive = 1;
               $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC', 'conditions' => $conditions);
            }

            $this->set('code_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "code_listings.csv";
            $csv->auto($filepath);
            $this->MainListing->recursive = 1;
            $this->set('code_listings',$this->MainListing->find('all', array('fields' => array('MainListing.linnworks_code','MainListing.category','MainListing.product_name','MainListing.amazon_sku','Listing.web_sku','Listing.web_price_uk','Listing.web_price_tesco','MainListing.price_uk','Listing.web_sale_price_uk','Listing.web_sale_price_tesco','MainListing.sale_price_uk','Listing.web_price_de','MainListing.price_de','Listing.web_price_fr','MainListing.price_fr','Listing.web_sale_price_de','MainListing.sale_price_de','Listing.web_sale_price_fr','MainListing.sale_price_fr','MainListing.error'),'conditions' => array('MainListing.id' => $checkboxid))));
            //$this->set('code_listings', $this->MainListing->find('all', array('MainListing.id ASC', 'conditions' => array('MainListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MainListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC');
            $this->set('code_listings', $this->paginate());
        }

	}
        
         function index_prices() {
             
	$this->set('title', 'Amazon Prices  Inventory Database.');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['MainListing']['all_item']))) {

            $string = explode(",", trim($this->data['MainListing']['all_item']));
            $prsku = $string[0];
            
            if (!empty($string[1])){$prname = $string[1];}
            
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('MainListing.linnworks_code LIKE' => '%' . $prname . '%', 'MainListing.linnworks_code LIKE' => '%' . $prsku . '%', 'MainListing.amazon_sku LIKE' => '%' . $prsku . '%');
                $this->MainListing->recursive = 1;
                $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC', 'conditions' => $conditions);
            }
            
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.amazon_sku LIKE' => "%$prsku%"));
               $this->MainListing->recursive = 1;
               $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC', 'conditions' => $conditions);
            }

            $this->set('code_listings', $this->paginate());
        } else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "amazon_price_listings.csv";
            $csv->auto($filepath);
            $this->MainListing->recursive = 1;
            $this->set('code_listings',$this->MainListing->find('list', array('fields' => array('MainListing.linnworks_code','listings.web_sku'), 'joins' => array(array('table' => 'listings', 'type' => 'LEFT','conditions' => array('MainListing.id' => $checkboxid))))));
           // $this->set('code_listings', $this->MainListing->find('all', array('MainListing.id ASC', 'conditions' => array('MainListing.id' => $checkboxid))));
            //print_r($code_listings);die();
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MainListing->recursive = 1;
            $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC');
            $this->set('code_listings', $this->paginate());
        }

	}
        
        
        
        function importcode() {
		
	$this->set('title', 'Linnwork codes and SKU Mapping information.');

        if (!empty($this->data)) {
            $filename = $this->data['MainListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            //print_r($this->data['MainListing']['file']['tmp_name']); die();
			
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['MainListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['MainListing']['file']['name']))
               // $messages = $this->MainListing->importcode($filename);
                $messages = $this->MainListing->importcode($filename);
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
        
        $procategory = $this->MainListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
        return $procategory;      
        
    }
    
        function category($catn) {

        $this->set('title', 'Linnwork codes and SKU Mapping Inventory Database.');   
            
          $catname = urldecode($catn);
              // print_r(urldecode($catname));die();
        
        if (empty($catname)) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'main_listings', 'action' => 'index'));
        } else {
            
                $this->MainListing->recursive = 1;
                $conditions = array('MainListing.category LIKE' => '%' . $catname . '%');                
                $this->paginate = array('limit' => 500, 'order' => 'MainListing.id  ASC', 'conditions' => $conditions);
            
        }
        $this->MainListing->recursive = 1;
        $this->set('code_listings', $this->paginate());
    }
    
    public function edit($id = null) {


        $this->set('title', 'Edit Amazon Price Listing.');


        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Amazon price id.', true));
            $this->redirect(array('controller' => 'main_listings ', 'action' => 'index'));
        }
        if (!empty($this->data)) {


            if ($this->MainListing->save($this->data['MainListing'])) {
                $this->Session->setFlash(__('The Amazon price listing save successfully', true));
                $this->redirect(array('controller' => 'main_listings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->MainListing->read(null, $id);
        }
    }
    
    
	

}
