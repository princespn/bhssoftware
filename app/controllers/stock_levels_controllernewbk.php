<?php
class StockLevelsController extends AppController {

	var $name = 'StockLevels';
    var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index','stockitemid','stock_status'));
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

/*
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

        
		
				$url = 'https://eu1.linnworks.net//api/Stock/GetStockItemsFull?keyword=' . $keywords . '&locationId='. $location . '&loadCompositeParents=true&loadVariationParents=true&entriesPerPage=200&pageNumber='. $page .'&dataRequirements=[0,0]&searchTypes=[0,0]';

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

				for ($i = 0;$i<=count($order->StockLevels); $i++) {
				
						
						if($order->StockLevels[$i]->Location->LocationName === 'Default'){
							$stockvalue[] = $order->StockLevels[$i]->StockValue;
							$stockleb[] = $order->StockLevels[$i]->StockLevel;
								}
										
						

							}


						$days = strtotime($order->CreationDate);
						$this_week_sd = date("Y-m-d",$days);
						
						//echo $this_week_sd;die();

				$this->StockLevel->create(); 					
				$this->StockLevel->saveAll(array('item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName,'create_date' => $this_week_sd, 'uk_stock_level'=> $stockleb[0] ,'uk_stock_value'=> $stockvalue[0], 'purchase_price' => $order->PurchasePrice,'retail_price' => $order->Quantity,'height' =>$order->Height, 'width' =>$order->Width, 'depth' =>$order->Depth, 'weight' =>$order->Weight));

				 
						
					    	
	}
		   }  		   
       	 $this->set(compact('orders','pagination'));
   }
   
   
   
*/


				public function stockitemid($page){
      				  
      
      				  $userkey = $this->tokenkey();
     				  $some_data = array('token' => $userkey);
		
				//if(!empty($page)){
				$page = $this->params['url']['page'];
				//}else {$page=1;}
				
				//$page=1;
		
				$keywords = '';
				$location = '';
				
				//	$stockitmid = $this->stock_withpurchase();
				//	$stockpurid = $this->stock_purprice();

        
				$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItems HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

       				 $url = 'https://eu1.linnworks.net//api/Stock/GetStockItems?keyword=' . $keywords . '&locationId='. $location . '&entriesPerPage=100&pageNumber='. $page .'&excludeComposites=true';

		
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
						//print_r($orders->Data); die();
						curl_close($ch);
						if(!empty($porders)){return $porders;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}

						$this->set(compact('porders'));	

						}

			
			
			public function index(){
				
						$this->set('title', 'Linnworks Get Stock Consumption.');
      
						$userkey = $this->tokenkey();

						$some_data = array('token' => $userkey);

						$page = $this->params['url']['page'];

					  
						$process_orders = $this->stockitemid($page); 

						$pkid = array(); 

						foreach ($process_orders->Data  as $process_order) {
						         $pkid[] = $process_order->StockItemId;
						//	$pkid[] =  $process_order->StockItemId;

						}
						$stockItemId = implode(",",$pkid);
						//echo "sdfcsf".count($pkid);die();
					//	print_r($stockItemId);
					
                      for($i=0;$i<count($pkid); $i++){						
					//	$stockItemId = 'f625b541-c746-4172-a349-b262178bfccc';	    
						$locationId = '00000000-0000-0000-0000-000000000000';
						$entriesPerPage = '500';	    
						$pageNumber = '1';
						 
					//$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItemsFull HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
	 
						 
					$header = array("POST:https://eu1.linnworks.net//api/Stock/GetItemChangesHistory HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

       				 $url = 'https://eu1.linnworks.net//api/Stock/GetItemChangesHistory?pageNumber=' . $page . '&locationId=00000000-0000-0000-0000-000000000000&entriesPerPage=50&stockItemId='.$pkid[$i];
					 
					  //$url = "https://eu1.linnworks.net//api/Stock/GetItemChangesHistory?pageNumber=1&locationId=00000000-0000-0000-0000-000000000000&entriesPerPage=5&stockItemId=f0e11abd-f804-46e8-89ce-000d0db89b59";

	//	print_r($url);die();
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
			
					// print_r($orders); //die();
				       curl_close($ch);
					    $this->set(compact('orders')); 
					  
			      // if(!empty($orders)){return $orders;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}
       
		
					 if (!empty($orders)) {
                foreach ($orders->Data as $order){	
				
				  $days = strtotime($order->Date);

				$this_week_sd = date("Y-m-d",$days);
	
				$this->StockLevel->create(); 

				
				$this->StockLevel->saveAll(array('date_change' => $this_week_sd,'stock_level' => $order->Level, 'stock_value' => $order->StockValue,'stock_itemid' => $order->StockItemId));
				}
					 }
					  }	
						 
					 }
					 
	
	public function stock_status(){
		
		
		$this->set('title', 'Linnworks Get Stock Items Information.');
	    $this_start_date = '2017-08-01';	    
	    $this_end_date = '2017-08-01';

    
    
 $conditions = array('StockLevel.date_change <=' => $this_end_date,
     'StockLevel.date_change >=' => $this_start_date);

    
    
     $this->StockLevel->recursive = 1;	
//$this->set('datastocks', $this->StockLevel->find('all', array('fields' => array(),'conditions' => $conditions,'order' =>array('StockLevel.date_change  ASC'))));  
    //$this->set(compact('datastocks')); 
$this->set('datastocks',$this->StockLevel->find('all', array('fields' => array('StockLevel.date_change', 'StockItem.item_number', 'StockItem.item_title', 'StockItem.purchase_price', 'StockItem.category_name', 'StockLevel.stock_level', 'StockLevel.stock_value', 'StockLevel.stock_itemid'),'conditions' =>$conditions)));
           
	 	
		

		
		
		
		
	}
   

   
}
