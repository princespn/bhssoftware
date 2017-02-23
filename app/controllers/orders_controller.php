<?php

class OrdersController extends AppController {

    var $name = 'Orders';
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

    public function index (){

        $this->set('title', 'Linnworks Open Orders.');

        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
        $limit = 50000;
        $page = 1;
        $addFilter = '';
        $fillCenter  = '00000000-0000-0000-0000-000000000000';
        $sortOrder = json_decode(array('FieldCode'=>'ITEMS_CATEGORY','Direction'=>'','Order'=>'ITEMS_CATEGORY'));

        // for open orders
        $header = array("POST:https://eu1.linnworks.net//api/Orders/GetOpenOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Orders/GetOpenOrders?additionalFilter=' . $addFilter . '&fulfilmentCenter=' . $fillCenter . '&entriesPerPage=' . $limit . '&pageNumber=' . $page . '&sorting='.$sortOrder;

        // draft orders
        //$header = array("POST:https://eu1.linnworks.net//api/Orders/GetDraftOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        // $url = 'https://eu1.linnworks.net//api/Orders/GetDraftOrders';


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
        //print_r($orders); die();
        curl_close($ch);
        $this->set(compact('orders'));

    }


    public function getallopenorders(){

        $this->set('title', 'Linnworks All Open Orders.');

        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
        $limit = 50000;
        $page = 1;
        $addFilter = '';
        $fillCenter  = '00000000-0000-0000-0000-000000000000';
        $sortOrder = json_decode(array('FieldCode'=>'ITEMS_CATEGORY','Direction'=>'','Order'=>'ITEMS_CATEGORY'));

        // for open orders
        $header = array("POST:https://eu1.linnworks.net//api/Orders/GetOpenOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Orders/GetOpenOrders?additionalFilter=' . $addFilter . '&fulfilmentCenter=' . $fillCenter . '&entriesPerPage=' . $limit . '&pageNumber=' . $page . '&sorting='.$sortOrder;

        // draft orders
        //$header = array("POST:https://eu1.linnworks.net//api/Orders/GetDraftOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        // $url = 'https://eu1.linnworks.net//api/Orders/GetDraftOrders';


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
        //print_r($orders); die();
        curl_close($ch);
      $this->set(compact('orders'));





            if (!empty($orders)) {
                foreach ($orders->Data as $order) {
                    $this->Order->create();
                    $this->Order->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'product_sku' => $order->Items[0]->SKU,'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'category' => $order->Items[0]->CategoryName, 'product_name' => $order->Items[0]->Title, 'quantity' => $order->Items[0]->Quantity, 'stocks' => $order->Items[0]->AvailableStock, 'order_date' => $order->GeneralInfo->ReceivedDate,'order_value' => $order->TotalsInfo->TotalCharge));
                }

            }




    }

}
