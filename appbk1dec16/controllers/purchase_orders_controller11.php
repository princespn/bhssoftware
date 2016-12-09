<?php
class PurchaseOrdersController extends AppController {

	var $name = 'PurchaseOrders';
        var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');   

          function beforeFilter() {
              
                parent::beforeFilter();
                $this->Auth->allow(array('edit','index','importdata','settings','categories','suppliers'));
                
                }
               
                
            
             /*   public function token_value(){
                
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
            
         /* public function index() {
                $userkey = $this->token_value();
                $id = "c006a3fe-a7d1-49a8-995e-cdbad6679e4e";
                $some_data = array('token' => $userkey);
                //$header = array("POST:https://eu1.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, ; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
               //$url = 'https://eu1.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder?pkPurchaseId=' . $id . '';            

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
                $yummy = json_decode($result);
                //curl_close($ch);
                //print_r($yummy);die();
                //return $yummy;
    }
  
                
    public function convertCurrency($amount, $from, $to){
    $url  = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return round($converted, 3);
    }  */

    public function index() {
          
        $this->set('title', 'Cost Calculator');      
               
        if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['PurchaseOrder']['all_item']))) {
            
            $string = explode(",", trim($this->data['PurchaseOrder']['all_item']));
            $prsku = $string[0];
            if (!empty($string[1])) {$prname = $string[1];}
            if ((!empty($prsku)) && (!empty($prname))) {

                $conditions = array('PurchaseOrder.linnworks_code LIKE' => '%' . $prname . '%', 'PurchaseOrder.linnworks_code LIKE' => '%' . $prsku . '%', 'PurchaseOrder.amazon_sku LIKE' => '%' . $prsku . '%');
                $this->PurchaseOrder->recursive = 1;
                $this->paginate = array('limit' => 1000, 'order' => 'PurchaseOrder.id', 'conditions' => $conditions);
            }
            
            if ((!empty($prsku))) {
                $conditions = array(
                    'OR' => array('PurchaseOrder.linnworks_code LIKE' => "%$prsku%", 'PurchaseOrder.linnworks_code LIKE' => "%$prsku%", 'PurchaseOrder.amazon_sku LIKE' => "%$prsku%"));
               $this->PurchaseOrder->recursive = 1;
               $this->paginate = array('limit' => 1000, 'order' => 'PurchaseOrder.id', 'conditions' => $conditions);
            }

            $this->set('purchase_orders', $this->paginate());
        }
        
       /* else if((!empty($this->data['PurchaseOrder']['uk_min_price'])) && (!empty($this->data['PurchaseOrder']['uk_max_price'])) && (!empty($this->data['PurchaseOrder']['category'])) && (!empty($_POST['Apply']))){
            
        // print_r($this->data['PurchaseOrder']['category']);die(); 
         $catename = $this->data['PurchaseOrder']['category'];
         $Minvalue = $this->data['PurchaseOrder']['uk_min_price'];
         $Maxvalue = $this->data['PurchaseOrder']['uk_max_price'];
         $MinDevalue = $this->data['PurchaseOrder']['de_min_price'];
         $MaxDevalue = $this->data['PurchaseOrder']['de_max_price'];
         $conditions = array('PurchaseOrder.category LIKE' => '%' . $catename . '%');
         $this->PurchaseOrder->recursive = 1;
         $this->paginate = array('limit' => 7000, 'order' => 'PurchaseOrder.amazon_sku', 'conditions' => $conditions);
         $this->set('purchase_orders', $this->paginate());
         $this->set(compact('Minvalue','Maxvalue','MaxDevalue','MinDevalue'));        
        } 
        */
        else if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "purchase_orders.csv";
            $csv->auto($filepath);
            $this->PurchaseOrder->recursive = 1;
            $this->set('purchase_orders',$this->PurchaseOrder->find('all', array('fields' => array('PurchaseOrder.linnworks_code','PurchaseOrder.category','PurchaseOrder.product_name','PurchaseOrder.amazon_sku','AdminListing.web_sku','AdminListing.web_price_uk','AdminListing.web_price_tesco','PurchaseOrder.price_uk','AdminListing.web_sale_price_uk','AdminListing.web_sale_price_tesco','PurchaseOrder.sale_price_uk','AdminListing.web_price_de','PurchaseOrder.price_de','AdminListing.web_price_fr','PurchaseOrder.price_fr','AdminListing.web_sale_price_de','PurchaseOrder.sale_price_de','AdminListing.web_sale_price_fr','PurchaseOrder.sale_price_fr','PurchaseOrder.error'),'conditions' => array('PurchaseOrder.id' => $checkboxid))));
            //$this->set('purchase_orders', $this->PurchaseOrder->find('all', array('PurchaseOrder.id ASC', 'conditions' => array('PurchaseOrder.id' => $checkboxid))));
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
        } else {
            $this->PurchaseOrder->recursive = 1;
            $this->paginate = array('limit' => 1000, 'order' => 'PurchaseOrder.id');
            $this->set('purchase_orders', $this->paginate());
        }

	}
        
        
        
      public function importdata() {
          
          
            $this->set('title', 'Import Cost Calculator Data.');

         if (!empty($this->data)) {
                $filename = $this->data['PurchaseOrder']['file']['name'];
                $fileExt = explode(".", $filename);
                $fileExt2 = end($fileExt);
                //print_r($this->data['PurchaseOrder']['file']['name']); die();
			
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['PurchaseOrder']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['PurchaseOrder']['file']['name']))
               // $messages = $this->PurchaseOrder->importcode($filename);
                $messages = $this->PurchaseOrder->importdata($filename);
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
        
        $category = $this->PurchaseOrder->find('list', array('fields' => 'category', 'group' => 'category', 'recursive' => 0));
        return $category;      
        
    }
    
    public function suppliers(){
        
        $supplier = $this->PurchaseOrder->find('list', array('fields' => 'supplier', 'group' => 'supplier', 'recursive' => 0));
        return $supplier;      
        
    }
    
    
    public function settings(){
        
          $this->set('title', 'Setting Cost Calculator');
          
                $catname = urldecode($this->data['PurchaseOrder']['category']);
                 $subname = urldecode($this->data['PurchaseOrder']['supplier']);
                 
          // print_r($catname);die();
          
         if((!empty($this->data['PurchaseOrder']['exchange_rate'])) && (!empty($this->data['PurchaseOrder']['sale_base_currency'])) && (!empty($this->data['PurchaseOrder']['invoice_currency']))){
                
                                         if (($this->PurchaseOrder->save($this->request->data)) && (empty($this->data['PurchaseOrder']['exchange_rate']))) {
                                         $this->Session->setFlash(__('The setting exchange rate save successfully', true));
                                         $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                                         }else{
                                         $this->PurchaseOrder->updateAll(array('PurchaseOrder.exchange_rate' => $this->data['PurchaseOrder']['exchange_rate']), array('PurchaseOrder.sale_base_currency' => $this->data['PurchaseOrder']['sale_base_currency'],'PurchaseOrder.invoice_currency' => $this->data['PurchaseOrder']['invoice_currency']));
                                         $this->Session->setFlash(__('The setting exchange rate save successfully', true));
                                         $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                                         }             
                }else if((!empty ($catname)) && (!empty($subname)) && ($this->data['PurchaseOrder']['multiplier'])){
            
                $this->PurchaseOrder->updateAll(array('PurchaseOrder.multiplier' => $this->data['PurchaseOrder']['multiplier']), array('PurchaseOrder.supplier' => $subname,'PurchaseOrder.category' => $catname));
             
                $this->Session->setFlash(__('The setting multiplier value save successfully', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
              
                }else if((!empty ($this->data['PurchaseOrder']['sale_base_currency'])) && (!empty($catname)) && (!empty($subname)) && ($this->data['PurchaseOrder']['sp1_multiplier']) && ($this->data['PurchaseOrder']['sp2_multiplier']) && ($this->data['PurchaseOrder']['sp3_multiplier'])){
             
                $this->PurchaseOrder->updateAll(array('PurchaseOrder.sp1_multiplier' => $this->data['PurchaseOrder']['sp1_multiplier'],'PurchaseOrder.sp2_multiplier' => $this->data['PurchaseOrder']['sp2_multiplier'],'PurchaseOrder.sp3_multiplier' => $this->data['PurchaseOrder']['sp3_multiplier']), array('PurchaseOrder.sale_base_currency' => $this->data['PurchaseOrder']['sale_base_currency'],'PurchaseOrder.category' => $catname,'PurchaseOrder.supplier' => $subname));
                $this->Session->setFlash(__('The setting multipliers value save successfully', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
              
              
             }else{
            $this->PurchaseOrder->recursive = 1;
            $this->paginate = array('limit' => 100, 'group' => 'PurchaseOrder.exchange_rate');
            $this->set('exchange_rates', $this->paginate());      
             }
            $this->PurchaseOrder->recursive = 1;
            $this->paginate = array('limit' => 100, 'group' => 'PurchaseOrder.category');
            $this->set('supplier_orders', $this->paginate());   
        
    }
    

}
