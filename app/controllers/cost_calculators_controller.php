<?php
class CostCalculatorsController extends AppController {

	var $name = 'CostCalculators';
        var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');   


        public function beforeFilter() {
              
                parent::beforeFilter();
                $this->Auth->allow(array('update_invoice','categname','category','getsupp','edit','index','importdata','settings','categories','suppliername','country','index_last'));
                
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
           
			public function suppliername() {
				
                $userkey = $this->token_value();
				
				$some_data = array('token' => $userkey);
               
              $header = array("POST:https://eu-ext.linnworks.net//api/Inventory/GetSuppliers HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, ; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
              $url = 'https://eu-ext.linnworks.net//api/Inventory/GetSuppliers';


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
                $supplier = json_decode($result);
                curl_close($ch);
              // print_r($supplier);die();
                return $supplier;
    }
          
    public function categname() {
        $userkey = $this->token_value();
        $some_data = array('token' => $userkey);
        $header = array("POST:https://eu-ext.linnworks.net//api/Inventory/GetCategories HTTP/1.1<", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
		$url = 'https://eu-ext.linnworks.net//api/Inventory/GetCategories';
	
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

     public function country() {
        $userkey = $this->token_value();
        $some_data = array('token' => $userkey);
        $header = array("POST:https://eu1.linnworks.net//api/Inventory/GetCountries HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Inventory/GetCountries';

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
        $catname = json_decode($result);
        curl_close($ch);
       // print_r($catname);        die();
        return $catname;
    }
    
    public function index() {

        $this->set('title', 'Cost Calculator');

        $categories = $this->categname();
        $this->loadModel('CostSetting');
        $getCost    =   $this->CostSetting->find('all');         
        $this->loadModel('SupplierMultiplier');
        $getsupp    =  $this->SupplierMultiplier->find('all');
        
        

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['CostCalculator']['all_item']))) {

            $string = explode(",", trim($this->data['CostCalculator']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('CostCalculator.linnworks_code LIKE' => '%' . $prname . '%', 'CostCalculator.category LIKE' => '%' . $prsku . '%');
                $this->CostCalculator->recursive = 1;
                $this->paginate = array('limit' => 100, 'order' => array('CostCalculator.error DESC','CostCalculator.import_dates DESC'), 'conditions' => $conditions);
            }

            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('CostCalculator.category LIKE' => "%$prsku%", 'CostCalculator.linnworks_code LIKE' => "%$prsku%", 'CostCalculator.supplier LIKE' => "%$prsku%"));
               $this->CostCalculator->recursive = 1;
               $this->paginate = array('limit' => 100, 'order' => array('CostCalculator.error DESC','CostCalculator.import_dates DESC'), 'conditions' => $conditions);
            }
           $this->CostCalculator->recursive = 1;
            $this->set('purchase_orders', $this->paginate());
            $this->set(compact('categories','getCost','getsupp'));
        }

       /* else if((!empty($this->data['CostCalculator']['uk_min_price'])) && (!empty($this->data['CostCalculator']['uk_max_price'])) && (!empty($this->data['CostCalculator']['category'])) && (!empty($_POST['Apply']))){

        // print_r($this->data['CostCalculator']['category']);die();
         $catename = $this->data['CostCalculator']['category'];
         $Minvalue = $this->data['CostCalculator']['uk_min_price'];
         $Maxvalue = $this->data['CostCalculator']['uk_max_price'];
         $MinDevalue = $this->data['CostCalculator']['de_min_price'];
         $MaxDevalue = $this->data['CostCalculator']['de_max_price'];
         $conditions = array('CostCalculator.category LIKE' => '%' . $catename . '%');
         $this->CostCalculator->recursive = 1;
         $this->paginate = array('limit' => 7000, 'order' => 'CostCalculator.amazon_sku', 'conditions' => $conditions);
         $this->set('purchase_orders', $this->paginate());
         $this->set(compact('Minvalue','Maxvalue','MaxDevalue','MinDevalue'));
        }
        */
        else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "cost_calculators.csv";
            $csv->auto($filepath);
           $this->CostCalculator->recursive = 1;
            $this->set('purchase_orders',$this->CostCalculator->find('all', array('fields' => array('CostCalculator.linnworks_code','CostCalculator.product_name','PurchasePrice.purchase_price','CostCalculator.category','CostCalculator.supplier','CostCalculator.invoice_currency','CostCalculator.landed_price_gbp','CostCalculator.sp1_value_gbp','CostCalculator.sp2_value_gbp','CostCalculator.sp3_value_gbp','AdminListing.web_sale_price_uk','CostCalculator.sale_price_gbp','CostCalculator.landed_price_eur','CostCalculator.sp1_value_eur','CostCalculator.sp2_value_eur','CostCalculator.sp3_value_eur','AdminListing.web_sale_price_de','CostCalculator.sale_price_euro','CostCalculator.error'),'order' => 'CostCalculator.error DESC', 'conditions' => array('CostCalculator.id' => $checkboxid))));
            //$this->set('purchase_orders', $this->CostCalculator->find('all', array('CostCalculator.id ASC', 'conditions' => array('CostCalculator.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
			//print_r($getCost);die();
                           
			foreach ($purchase_orders as $purchase_order){
							
							 
                                     foreach ($getCost as $exchange_rate){
                                        if(($exchange_rate['CostSetting']['invoice_currency'])===($purchase_order['PurchasePrice']['invoice_currency']) && (($exchange_rate['CostSetting']['sale_base_currency'])==='GBP')){
                                        $GbpLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                                           echo $$exchange_rate['CostSetting']['invoice_currency'];  break;                                        
                                        }
                                       
                                     }
                                     foreach ($getCost as $exchange_rate){
                                       if(($exchange_rate['CostSetting']['invoice_currency'])===($purchase_order['PurchasePrice']['invoice_currency']) && (($exchange_rate['CostSetting']['sale_base_currency'])==='EUR')){
                                        $EurLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                                           echo $$exchange_rate['CostSetting']['invoice_currency'];  break;                                        
                                        }
                                     }
                                     
                                     foreach ($getsupp as $getsupps){
                                         if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='GBP')){
                                             
                                             $sp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];
                                             $sp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];
                                             $sp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];
                                              break;
                                                 }                                             
                                            }
                                            
                                        foreach ($getsupp as $getsupps){
                                      if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='EUR')){
                                             
                                             $Eursp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];
                                             $Eursp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];
                                             $Eursp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];
                                              break;
                                                 }
                                            }
												
                                            
                                                 
                 $this->CostCalculator->updateAll(array('CostCalculator.landed_price_gbp' => round($GbpLP, 2),'CostCalculator.sp1_value_gbp' =>round($GbpLP*$sp1, 2),'CostCalculator.sp2_value_gbp' =>round($GbpLP*$sp2, 2),'CostCalculator.sp3_value_gbp' =>round($GbpLP*$sp3, 2),'CostCalculator.landed_price_eur' =>round($EurLP, 2),'CostCalculator.sp1_value_eur' =>round($EurLP*$Eursp1, 2),'CostCalculator.sp2_value_eur' =>round($EurLP*$Eursp2, 2),'CostCalculator.sp3_value_eur' =>round($EurLP*$Eursp3, 2)), array('CostCalculator.linnworks_code' => $purchase_order['CostCalculator']['linnworks_code'], 'CostCalculator.id' => $purchase_order['CostCalculator']['id']));
       
                     }
            $this->CostCalculator->recursive = 1;
            $this->paginate = array('limit' => 100, 'order' => array('CostCalculator.error DESC','CostCalculator.import_dates DESC'));
           $this->set('purchase_orders', $this->paginate());
           $this->set(compact('categories','getCost','getsupp'));
           // print_r($purchase_orders); die();
            
        }


	}

    /*public function index_last() {

        $this->set('title', 'Cost Calculator');

        $categories = $this->categname();
        $this->loadModel('CostSetting');
        $getCost    =   $this->CostSetting->find('all');

        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['CostCalculator']['all_item']))) {

            $string = explode(",", trim($this->data['CostCalculator']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('CostCalculator.linnworks_code LIKE' => '%' . $prname . '%', 'CostCalculator.category LIKE' => '%' . $prsku . '%');
                $this->CostCalculator->recursive = 0;
                $this->paginate = array('limit' => 100, 'order' => 'CostCalculator.import_dates  DESC', 'conditions' => $conditions);
            }

            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('CostCalculator.category LIKE' => "%$prsku%", 'CostCalculator.linnworks_code LIKE' => "%$prsku%", 'CostCalculator.supplier LIKE' => "%$prsku%"));
                $this->CostCalculator->recursive = 0;
                $this->paginate = array('limit' => 100, 'order' => 'CostCalculator.import_dates  DESC', 'conditions' => $conditions);
            }
            $this->CostCalculator->recursive = 0;
            $this->set('purchase_orders', $this->paginate());
            $this->set(compact('categories','getCost'));
        }

        else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "code_purchase_orders.csv";
            $csv->auto($filepath);
            $this->CostCalculator->recursive = 0;
               $this->set('purchase_orders',$this->CostCalculator->find('all', array('fields' => array('CostCalculator.linnworks_code','CostCalculator.product_name','CostCalculator.invoice_value','CostCalculator.latest_invoice','CostCalculator.category','CostCalculator.supplier','CostCalculator.invoice_currency','CostCalculator.landed_price_gbp','CostCalculator.sp1_value_gbp','CostCalculator.sp2_value_gbp','CostCalculator.sp3_value_gbp','AdminListing.web_sale_price_uk','CostCalculator.sale_price_gbp','CostCalculator.landed_price_eur','CostCalculator.sp1_value_eur','CostCalculator.sp2_value_eur','CostCalculator.sp3_value_eur','AdminListing.web_sale_price_de','CostCalculator.sale_price_euro','CostCalculator.error'),'conditions' => array('CostCalculator.id' => $checkboxid))));
            //$this->set('purchase_orders', $this->CostCalculator->find('all', array('CostCalculator.id ASC', 'conditions' => array('CostCalculator.id' => $checkboxid))));
            $this->layout = null;       
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->CostCalculator->recursive = 0;
            $this->paginate = array('limit' => 100, 'order' => 'CostCalculator.import_dates  DESC');
            $this->set('purchase_orders', $this->paginate());
            $this->set(compact('categories','getCost'));
        }


    }*/


    function category($catn) {


        $this->set('title', 'Cost Calculator');

        $categories = $this->categname();
        $options = urldecode($catn);
        // print_r(urldecode($catname));die();
        $this->loadModel('CostSetting');
        $getCost	=	$this->CostSetting->find('all');
  
        
        $this->loadModel('SupplierMultiplier');
        $getsupp	=	$this->SupplierMultiplier->find('all');

        if (empty($options)) {
            $this->Session->setFlash(__('Please select valid category.', true));
            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
        } else {

            $this->CostCalculator->recursive = 1;
            $conditions = array('CostCalculator.category LIKE' => '%' . $options . '%');
            $this->paginate = array('limit' => 100, 'order' => array('CostCalculator.error DESC','CostCalculator.import_dates DESC'), 'conditions' => $conditions);

        }
        $this->CostCalculator->recursive = 1;
        //$this->set('purchase_orders', $this->paginate());
        //$this->set(compact('categories','options','getCost','getsupp'));
        
            /* Add Sp1 and Sp2,Sp3 in DB  */
             $purchase_orders = $this->paginate();            
            $this->set(compact('purchase_orders','categories','getCost','getsupp'));
            //print_r($purchase_orders); die();
            
                        foreach ($purchase_orders as $purchase_order){
                            
                                     foreach ($getCost as $exchange_rate){
                                        if(($exchange_rate['CostSetting']['invoice_currency'])===($purchase_order['CostCalculator']['invoice_currency']) && (($exchange_rate['CostSetting']['sale_base_currency'])==='GBP')){
                                        $GbpLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                                            break;                                        
                                        }
                                       
                                     }
                                     foreach ($getCost as $exchange_rate){
                                       if(($exchange_rate['CostSetting']['invoice_currency'])===($purchase_order['CostCalculator']['invoice_currency']) && (($exchange_rate['CostSetting']['sale_base_currency'])==='EUR')){
                                        $EurLP = ($exchange_rate['CostSetting']['exchange_rate'])*($purchase_order['PurchasePrice']['purchase_price'])*($purchase_order['Multiplier']['multiplier']);
                                            break;                                        
                                        }
                                     }
                                     
                                     foreach ($getsupp as $getsupps){
                                         if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='GBP')){
                                             
                                             $sp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];
                                             $sp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];
                                             $sp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];
                                              break;
                                                 }                                             
                                            }
                                            
                                        foreach ($getsupp as $getsupps){
                                      if(((($getsupps['SupplierMultiplier']['category'])===($purchase_order['CostCalculator']['category'])) && (($getsupps['SupplierMultiplier']['supplier'])===($purchase_order['CostCalculator']['supplier']))) && (($getsupps['SupplierMultiplier']['invoice_currency'])==='EUR')){
                                             
                                             $Eursp1 = $getsupps['SupplierMultiplier']['sp1_multiplier'];
                                             $Eursp2 = $getsupps['SupplierMultiplier']['sp2_multiplier'];
                                             $Eursp3 = $getsupps['SupplierMultiplier']['sp3_multiplier'];
                                              break;
                                                 }
                                            }
                                            
                                                 
                 $this->CostCalculator->updateAll(array('CostCalculator.landed_price_gbp' => round($GbpLP, 2),'CostCalculator.sp1_value_gbp' =>round($GbpLP*$sp1, 2),'CostCalculator.sp2_value_gbp' =>round($GbpLP*$sp2, 2),'CostCalculator.sp3_value_gbp' =>round($GbpLP*$sp3, 2),'CostCalculator.landed_price_eur' =>round($EurLP, 2),'CostCalculator.sp1_value_eur' =>round($EurLP*$Eursp1, 2),'CostCalculator.sp2_value_eur' =>round($EurLP*$Eursp2, 2),'CostCalculator.sp3_value_eur' =>round($EurLP*$Eursp3, 2)), array('CostCalculator.linnworks_code' => $purchase_order['CostCalculator']['linnworks_code'], 'CostCalculator.id' => $purchase_order['CostCalculator']['id']));
       
                     }
                /* End Sp1 and Sp2,Sp3 in DB  */
    }



    public function importdata() {


            $this->set('title', 'Import Cost Calculator Data.');

         if (!empty($this->data)) {
                $filename = $this->data['CostCalculator']['file']['name'];
                $fileExt = explode(".", $filename);
                $fileExt2 = end($fileExt);
                //print_r($this->data['CostCalculator']['file']['name']); die();

            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['CostCalculator']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['CostCalculator']['file']['name']))
               // $messages = $this->CostCalculator->importcode($filename);
                $messages = $this->CostCalculator->importdata($filename);
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




     public function settings($catn = null){

         $this->set('title', 'Setting Cost Calculator');
         $download = urldecode($catn);
         $categories = $this->categname();
         $suppname = $this->suppliername();
         $countryname = $this->country();
         $catname = urldecode($this->data['CostCalculator']['category']);
         $subname = urldecode($this->data['CostCalculator']['supplier']);
         $this->loadModel('CostSetting');
         $getCost   =   $this->CostSetting->find('all');
         $this->loadModel('SupplierMultiplier');
         $this->loadModel('Multiplier');
         $this->loadModel('Shipping');
        

                 if (!empty($download)) {

                                $conditions = array('SupplierMultiplier.category LIKE' => '%' . $download . '%');
                                $this->paginate = array('limit' => 2000, 'order' => 'SupplierMultiplier.category', 'conditions' => $conditions);
                                 $getSupplier = $this->paginate('SupplierMultiplier');
                                 
                                 $cond = array('Multiplier.category LIKE' => '%' . $download . '%');
                                 $this->paginate = array('limit' => 1000, 'order' => 'Multiplier.category', 'conditions' => $cond);
                                 $getMultiplier = $this->paginate('Multiplier');  
                                 
                                 $condition = array('Shipping.category LIKE' => '%' . $download . '%');
                                 $this->paginate = array('limit' => 100, 'order' => 'Shipping.category', 'conditions' => $condition);
                                 $getShipping = $this->paginate('Shipping'); 
                                 
                                $this->set(compact('categories','suppname','getCost','getSupplier','getMultiplier','countryname'));

                   }else{
                       $getSupplier =   $this->SupplierMultiplier->find('all');
                       $getMultiplier   =   $this->Multiplier->find('all');  
                       $getShipping  =   $this->Shipping->find('all');  
                     $this->set(compact('categories','suppname','getCost','getSupplier','getMultiplier','countryname','getShipping'));

                 }

        }


    public function edit($id = null) {


        $this->set('title', 'Edit Cost Calculator Data.');

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid ID.', true));
            $this->redirect(array('controller' => 'purchase_orders ', 'action' => 'index'));
        }
        if (!empty($this->data)) {
			
//print_r($this->data['MasterListing']);die();
            if ($this->CostCalculator->save($this->data['CostCalculator'])) {
                $this->Session->setFlash(__('The Price listing save successfully', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->CostCalculator->read(null, $id);
        }
    }


    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
        } else {

            if ($this->MasterListing->delete($id)) {

                $this->Session->setFlash(__('The Cost Listing was deleted successfully.', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Cost Listing could not be deleted!', true));
        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
    }


    public function update_invoice($invoiceid = null){

        $this->set('title', 'Cost Calculator');

        $categories = $this->categname();  
         
        $this->loadModel('CostSetting');
        $getCost	=	$this->CostSetting->find('all');
  
        $this->loadModel('SupplierMultiplier');
        $getsupp	=	$this->SupplierMultiplier->find('all');


        if (!$invoiceid && empty($this->data)) {
            $this->Session->setFlash(__('Invalid ID.', true));
            $this->redirect(array('controller' => 'purchase_orders ', 'action' => 'index'));
        }
        if (!empty($this->data)) {

//print_r($this->data['MasterListing']);die();
            if (!empty($this->data['CostCalculator']['invoice_value'])) {
               // $this->saveField('invoice_value', $err, array($this->id = $this->data['CostCalculator']['id']));
                $this->CostCalculator->updateAll(array('CostCalculator.invoice_value' => $this->data['CostCalculator']['invoice_value']), array('CostCalculator.id' => $this->data['CostCalculator']['id']));

                $this->Session->setFlash(__('Update Invoice value successfully', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->CostCalculator->read(null, $invoiceid);
        }

        $this->CostCalculator->recursive = 1;
        $this->paginate = array('limit' => 100, 'order' => 'CostCalculator.import_dates  DESC');
        //$this->set('purchase_orders', $this->paginate());
        $purchase_orders = $this->paginate();
        $this->set(compact('purchase_orders','categories','getCost','getsupp'));
       // $this->set(compact('categories','invoiceid','getCost','Webprices'));
    }




}
