<?php
class MainListingsController extends AppController {

	var $name = 'MainListings';
        var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');       

  

    function beforeFilter() {
        
        parent::beforeFilter();
         $this->Auth->allow(array('categories','repdelcode', 'index_prices', 'index','importcode','category','edit','delete'));	
	}

    public function token_value(){

        $auth_data = array(
            'applicationId' =>'b72fc47a-ef82-4cb3-8179-2113f09c50ff',
            'applicationSecret' =>'e727f554-7d27-4fd2-bcaf-dad3e0079821',
            'token' =>'cd431b31abd667bbb1e947be42077e9d');
        $header = array("POST:https://api.linnworks.net//api/Auth/AuthorizeByApplication HTTP/1.1","Host:api.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, ; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate");
        $url = 'https://api.linnworks.net//api/Auth/AuthorizeByApplication?applicationId='.$auth_data['applicationId'].'&applicationSecret='.$auth_data['applicationSecret'].'&token='.$auth_data['token'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $auth_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $yummy = json_decode($result);
        curl_close($ch);
        //print_r($yummy);die();
        $Token = $yummy->{'Token'};
        if(!empty($Token)){return $Token ;}else{throw new MissingWidgetHelperException('Token not authorized to view this page.', 401);}
    }



    public function categname() {
        $userkey = $this->token_value();
        $some_data = array('token' => $userkey);
        $header = array("POST:https://eu1.linnworks.net//api/Inventory/GetCategories HTTP/1.1<", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Inventory/GetCategories';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $catgory = json_decode($result);
        curl_close($ch);
        //print_r($catgory);die();
        return $catgory;
    }

 public function repdelcode(){

        $this->set('title', 'Linnwork  Replace or delete Old Amazon SKU.');

        if (!empty($this->data)) {
            $filename = $this->data['MainListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            //print_r($this->data['MainListing']['file']['tmp_name']); die();

            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['MainListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['MainListing']['file']['name']))
                    // $messages = $this->MainListing->importcode($filename);
                    $messages = $this->MainListing->repdelcode($filename);
                $this->Session->setFlash(__('Linnwork Amazon SKU delete successfully.', true));

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


    function index() {
             
        $this->set('title', 'Diagnosis Linnwork codes and SKU Mapping Inventory Database.');
        $categories = $this->categname();
           
         
        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['MainListing']['all_item']))) {
            
            $string = explode(",", trim($this->data['MainListing']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('MainListing.linnworks_code LIKE' => '%' . $prname . '%', 'MainListing.linnworks_code LIKE' => '%' . $prsku . '%');
                $this->MainListing->recursive = 1;
                $this->paginate = array('limit' => 100, 'order' => 'MainListing.id', 'conditions' => $conditions);
            }
            
            if ((!empty($prsku))) {
                $conditions = array(
                   'OR' => array('MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.linnworks_code LIKE' => "%$prsku%"));
                   $this->MainListing->recursive = 1;
               $this->paginate = array('limit' => 100, 'order' => 'MainListing.id', 'conditions' => $conditions);
            }

            $this->set('code_listings', $this->paginate());
            $this->set(compact('categories'));
        }
          
        else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "code_listings.csv";
            $csv->auto($filepath);
            $this->MainListing->recursive = 1;
            $this->set('code_listings',$this->MainListing->find('all', array('fields' => array('MainListing.linnworks_code','InventoryCode.category','InventoryCode.product_name','MainListing.channel_sku','Listing.web_sku','Listing.web_price_uk','Listing.web_price_dm','MainListing.price_uk','Listing.web_sale_price_uk','Listing.web_sale_price_tesco','Listing.web_sale_price_dm','MainListing.sale_price_uk','Listing.web_price_de','MainListing.price_de','Listing.web_price_fr','MainListing.price_fr','Listing.web_sale_price_de','MainListing.sale_price_de','Listing.web_sale_price_fr','MainListing.sale_price_fr','MainListing.error'),'conditions' => array('MainListing.id' => $checkboxid))));
            //$this->set('code_listings', $this->MainListing->find('all', array('MainListing.id ASC', 'conditions' => array('MainListing.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MainListing->recursive = 1;
            $this->paginate = array('limit' => 100, 'order' => 'MainListing.id');
            $this->set('code_listings', $this->paginate());
            $this->set(compact('categories'));
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
                $this->paginate = array('limit' => 100, 'order' => 'MainListing.id', 'conditions' => $conditions);
            }
            
            if ((!empty($prsku))) {

                $conditions = array(
                    'OR' => array('MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.linnworks_code LIKE' => "%$prsku%", 'MainListing.amazon_sku LIKE' => "%$prsku%"));
               $this->MainListing->recursive = 1;
               $this->paginate = array('limit' => 100, 'order' => 'MainListing.id', 'conditions' => $conditions);
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
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->MainListing->recursive = 1;
            $this->paginate = array('limit' => 100, 'order' => 'MainListing.id');
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
    
    /*public function categories(){
        
        $procategory = $this->MainListing->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
        return $procategory;      
        
    }*/
    
       
    
    public function category($catn) {

        $this->set('title', 'Linnwork codes and SKU Mapping Inventory Database.');
        $categories = $this->categname();
            
          $catname = urldecode($catn);
              // print_r(urldecode($catname));die();
        
        if (empty($catname)) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'main_listings', 'action' => 'index'));
        } else {
            
                $this->MainListing->recursive = 1;
                $conditions = array('InventoryCode.category LIKE' => '%' . $catname . '%');                
                $this->paginate = array('limit' => 1000, 'order' => 'MainListing.id', 'conditions' => $conditions);
            
        }
        $this->MainListing->recursive = 1;
        $this->set('code_listings', $this->paginate());
        $this->set(compact('categories'));
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
    
    
    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid UK Listing ID in database.', true));
            $this->redirect(array('controller' => 'main_listings', 'action' => 'index_prices'));
        } else {

            if ($this->MainListing->delete($id)) {

                $this->Session->setFlash(__('The Amazon Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'main_listings', 'action' => 'index_prices'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Amazon Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'main_listings', 'action' => 'index_prices'));
    }
    
    
	

}
