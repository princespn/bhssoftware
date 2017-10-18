<?php
class StockLevelsController extends AppController {

	var $name = 'StockLevels';
    var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index','stockitems'));
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
        if(!empty($Token)){return $Token;}else{throw new MissingWidgetHelperException('Token not authorized to view this page.', 401);}
    }

    public function categname() {

        $userkey = $this->tokenkey();
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


   public function index(){

    		    $this->set('title', 'Linnworks Get Stock Items Information.');
      
     			   $userkey = $this->tokenkey();
     			   $some_data = array('token' => $userkey);
		
			  //if(!empty($page)){

			   $page = $this->params['url']['page'];
				//}else {$page=1;}
		
		$keywords = '';
		$location ='00000000-0000-0000-0000-000000000000';
	//	$stockitmid = $this->stock_withpurchase();
	//	$stockpurid = $this->stock_purprice();

        
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItemsFull HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

      		$url = 'https://eu1.linnworks.net//api/Stock/GetStockItemsFull?keyword=' . $keywords . '&locationId='. $location . '&loadCompositeParents=true&loadVariationParents=true&entriesPerPage=1&pageNumber='. $page .'&dataRequirements=[0,0]&searchTypes=[0,0]';

		
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
		
		  	 if (!empty($orders)) {
				 foreach ($orders as $order){
					 
					

				 $stockvalue = array(); $stockleb = array();
				 
				 $uk_fba_stockvalue = array(); $uk_fba_stockleb = array();
				 
				 $fr_fba_stockvalue = array(); $fr_fba_stockleb = array();
				 
				 $de_fba_stockvalue = array(); $de_fba_stockleb = array();
				  
				 $es_fba_stockvalue = array(); $es_fba_stockleb = array();

					for ($i = 0;$i<=count($order->StockLevels); $i++) {
				 echo $order->StockLevels[$i]->Location->LocationName;
						
						if($order->StockLevels[$i]->Location->LocationName === 'Default'){
					
							$stockvalue[] = $order->StockLevels[$i]->StockValue;
							$stockleb[] = $order->StockLevels[$i]->StockLevel;
					
										}

							
							
							else if($order->StockLevels[$i]->Location->LocationName === 'United Kingdom FBA'){
					
							$uk_fba_stockvalue[] = $order->StockLevels[$i]->StockValue;
							$uk_fba_stockleb[] = $order->StockLevels[$i]->StockLevel;
					
										}
										
										
							else if($order->StockLevels[$i]->Location->LocationName === 'France FBA'){
					
							$fr_fba_stockvalue[] = $order->StockLevels[$i]->StockValue;
							$fr_fba_stockleb[] = $order->StockLevels[$i]->StockLevel;
					
										}
							else if($order->StockLevels[$i]->Location->LocationName === 'Germany FBA'){
					
							$de_fba_stockvalue[] = $order->StockLevels[$i]->StockValue;
							$de_fba_stockleb[] = $order->StockLevels[$i]->StockLevel;
					
										}
										
													
							else if($order->StockLevels[$i]->Location->LocationName === 'Spain FBA'){
					
							$es_fba_stockvalue[] = $order->StockLevels[$i]->StockValue;
							$es_fba_stockleb[] = $order->StockLevels[$i]->StockLevel;
					
										}
										else{}
						
										
										

							}


						$days = strtotime($order->CreationDate);
						$this_week_sd = date("Y-m-d",$days);
						
						//echo $this_week_sd;die();

				$this->StockLevel->create(); 					
				$this->StockLevel->saveAll(array('item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName,'create_date' => $this_week_sd, 'uk_stock_level'=> $stockleb[0] ,'uk_stock_value'=> $stockvalue[0],'fba_uk_stock_value'=> $uk_fba_stockvalue[0], 'fba_uk_stock_level'=> $uk_fba_stockleb[0],  'fba_fr_stock_value'=> $fr_fba_stockvalue[0],  'fba_fr_stock_level'=> $fr_fba_stockleb[0],  'fba_de_stock_value'=> $de_fba_stockvalue[0],  'fba_de_stock_level'=> $de_fba_stockleb[0],   'fba_es_stock_value'=> $es_fba_stockvalue[0],  'fba_es_stock_level'=> $es_fba_stockleb[0], 'purchase_price' => $order->PurchasePrice,'retail_price' => $order->Quantity,'height' =>$order->Height, 'width' =>$order->Width, 'depth' =>$order->Depth, 'weight' =>$order->Weight));

				 
						
					    	
	}
		   }  		   
       	 $this->set(compact('orders','pagination'));
   }


    public function stockitems(){
		
		$this->set('title', 'Linnworks Get Stock Items Information.');
	    $this_start_date = '2017-04-11';	    
	    $this_end_date = '2017-08-01';

    
    
 $conditions = array('StockLevel.create_date <=' => $this_end_date,
     'StockLevel.create_date >=' => $this_start_date);

    
    
    $groupby = array('StockLevel.category_name');
	
	$datastocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name','sum(StockLevel.uk_stock_value) AS stockvalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('StockLevel.category_name  ASC')));  
    $this->set(compact('datastocks')); 
    
    }
	
   

   
}
