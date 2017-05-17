<?php

class OpenOrdersController extends AppController {

    var $name = 'OpenOrders';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'tokenkey','getallopenorders'));
        $this->Session->activate();

    }



     public function tokenkey() {
                    $auth_data = array(
			'applicationId' =>'b72fc47a-ef82-4cb3-8179-2113f09c50ff',
			'applicationSecret' =>'e727f554-7d27-4fd2-bcaf-dad3e0079821',
			'token' =>'cd431b31abd667bbb1e947be42077e9d');
			$header = array("POST:https://api.linnworks.net//api/Auth/AuthorizeByApplication HTTP/1.1","Host:api.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate");
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

        
    
    
    public function getallopen(){

        //This function return only order id identifiers -pkOrderID

        $this->set('title', 'Linnworks all open Orders.');
        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
       
      
         $fillCenter  = '00000000-0000-0000-0000-000000000000';

        $header = array("POST:https://eu1.linnworks.net//api/Orders/GetAllOpenOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Orders/GetAllOpenOrders?fulfilmentCenter='.$fillCenter;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $porders = json_decode($result);
       //print_r($porders); die();
      curl_close($ch);
       if(!empty($porders)){return $porders ;}else{throw new MissingWidgetHelperException('Open orders not authorized to view this page.', 401);}

        $this->set(compact('porders'));

    }
    
    
     public function index(){

        $this->set('title', 'Linnworks All Open Orders.');
        //$page = $this->params['url']['page'];



        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
        
        $orders = $this->getallopen();      
        $pkid = array();
        
        foreach ($orders  as $order) { 
       // $pkid[] =  $order;
        $pkid[] = "'". $order . "'";
        }
       
       $Orderkid = implode(",",$pkid);
       
       //print_r($Orderkid);die();
       
       
       $header = array("POST:https://eu1.linnworks.net//api/Orders/GetOrdersById HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
       $url = "https://eu1.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=['79aae513-e22b-402e-ad00-527ad5d7a657','c54892ff-3709-4469-93bc-abdc1386126d']";
       
       $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $orders = json_decode($result);
       print_r($result); die();
        curl_close($ch);
       
            if (!empty($orders)) {
                foreach ($orders as $order){
                   $sku = array();
                   $catname = array();
                   $pname = array();
                   $quanty = array();
                   $stock = array();
                   $priceunit = array();
for ($i = 0;$i<=count($order->Items); $i++) {
   /*$sku[$i] = $order->Items[$i]->SKU;
   $catname[$i] = $order->Items[$i]->CategoryName;
    $pname[$i] = $order->Items[$i]->Title;
   $quanty[$i] = $order->Items[$i]->Quantity;
   $stock[$i] = $order->Items[$i]->AvailableStock;
   $priceunit[$i] = $order->Items[$i]->CostIncTax;

    $skuname = implode("  ",$sku);
    $catname = implode("  ",$catname);
    $pname = implode("  ",$pname);
    $quanty = implode("  ",$quanty);
    $stock = implode("  ",$stock);
    $priceunit = implode("  ",$priceunit);*/
    $days = strtotime($order->GeneralInfo->ReceivedDate);

    $this_week_sd = date("Y-m-d",$days);
    
if((count($order->Items)) > '1'){$ordertitle = $order->Items[$i]->Title."Name-".$i;}else {$ordertitle = $order->Items[$i]->Title;}
     
     $this->loadModel('ProcessedListing');
      
    $this->ProcessedListing->create();
   
    $this->ProcessedListing->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum,'order_date' => $this_week_sd,  'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'product_sku' => $order->Items[$i]->SKU, 'cat_name' => $order->Items[$i]->CategoryName, 'product_name' => $ordertitle, 'quantity' =>  $order->Items[$i]->Quantity, 'price_per_product' => $order->Items[$i]->CostIncTax));
         
        
} 

    $days = strtotime($order->GeneralInfo->ReceivedDate);

    $this_week_sd = date("Y-m-d",$days);
    
   $this->ProcessedOrder->create();
   $this->ProcessedOrder->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $order->TotalsInfo->TotalCharge));
             
     

}

 }
        $this->set(compact('orders','pagination'));
            
    }

    
}
