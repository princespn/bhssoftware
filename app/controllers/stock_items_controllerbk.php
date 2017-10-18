<?php
class StockItemsController extends AppController {

		var $name = 'StockItems';
   	 	var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    		var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    	function beforeFilter() {
        	parent::beforeFilter();
        	$this->Auth->allow(array('stock_purprice', 'stock_withpurchase','index','stock_values'));
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
	
	
   		 public function stock_withpurchase(){

        //This function return only order id identifiers -pkOrderID

				        $this->set('title', 'Linnworks Get Stock Channels Reports.');
				        $userkey = $this->tokenkey();
				        $some_data = array('token' => $userkey);		
		
					$stockitemids = '"e45f5539-7222-43c0-ba56-0e92daf7d2af"';
					$StockLocationId ='"00000000-0000-0000-0000-000000000000"';

					$header = array("POST:https://eu.linnworks.net/api/PurchaseOrder/GetPurchaseOrdersWithStockItems HTTP/1.1", "Connection: keep-alive", "Content-Length: 139", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

	
					$url = 'https://eu1.linnworks.net//api/PurchaseOrder/GetPurchaseOrdersWithStockItems?purchaseOrder={"StockItemId":'. $stockitemids .',"LocationIds":['. $StockLocationId .']}';


		
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
				       print_r($porders); die();
				       curl_close($ch);
				       if(!empty($porders)){return $porders ;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}
        //$this->set(compact('porders'));
				
	     	 }


    
				
       		public function stock_purprice(){

        
	
        			$this->set('title', 'Linnworks Get Stock Channels Purchase Prices.');
	        		$userkey = $this->tokenkey();
				$some_data = array('token' => $userkey);

				$purchaseid = "2efa09b6-af37-461d-9983-4cd19eee1192";
		
				$header = array("POST:https://eu1.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder HTTP/1.1", "Connection: keep-alive", "Content-Length: 139", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

			         $url = 'https://eu1.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder?pkPurchaseId='.$purchaseid;
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
			       print_r($porders); die();
			       curl_close($ch);
			       if(!empty($porders)){return $porders;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}
        //$this->set(compact('porders'));
			
		}


    			 public function stock_values(){

      				  $this->set('title', 'Linnworks Get Stock Items Information.');
      
      				  $userkey = $this->tokenkey();
     				  $some_data = array('token' => $userkey);
		
				//if(!empty($page)){
				$page = $this->params['url']['page'];
				//}else {$page=1;}
		
				$keywords = '';
				$location = '';
				//	$stockitmid = $this->stock_withpurchase();
				//	$stockpurid = $this->stock_purprice();

        
				$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItems HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

       				 $url = 'https://eu1.linnworks.net//api/Stock/GetStockItems?keyword=' . $keywords . '&locationId='. $location . '&entriesPerPage=500&pageNumber='. $page .'&excludeComposites=true';

		
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
			
					print_r($orders); die();
				        curl_close($ch);
	
				
			 }



 		   public function index(){

    			    $this->set('title', 'Linnworks Get Stock Items Information.');
      
     			   $userkey = $this->tokenkey();
     			   $some_data = array('token' => $userkey);
		
			  //if(!empty($page)){

			   $page = $this->params['url']['page'];
				//}else {$page=1;}
		
		$keywords = '';
		$location = '';
	//	$stockitmid = $this->stock_withpurchase();
	//	$stockpurid = $this->stock_purprice();

        
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItemsFull HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

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
			
			print_r($orders); die();
		        curl_close($ch);
		
		  	 if (!empty($orders)) {
               			 foreach ($orders as $order){
					for ($i = 0;$i<=count($order->StockLevels); $i++) {
						$this->loadModel('StockLevel');	
						$StockItemId = $order->StockLevels[$i]->StockItemId;
						$LocationIds  =  $order->StockLevels[$i]->Location->StockLocationId;
						$stocksReports = $this->stock_withpurchase($StockItemId,$LocationIds);
					
						$this->StockLevel->create(); 	
					
					    	$this->StockLevel->saveAll(array('item_number' => $order->ItemNumber, 'stock_location_id' =>$order->StockLevels[$i]->Location->StockLocationId,'location_name' => $order->StockLevels[$i]->Location->LocationName,'available' => $order->StockLevels[$i]->Available,'min_level' => $order->StockLevels[$i]->MinimumLevel,'stock_value' => $order->StockLevels[$i]->StockValue,'stock_level' => $order->StockLevels[$i]->StockLevel,'unit_cost' => $order->StockLevels[$i]->UnitCost));
         					}	
	
				$days = strtotime($order->CreationDate);
				$this_week_sd = date("Y-m-d",$days);

				$this->StockItem->create(); 	
				$this->StockItem->saveAll(array('item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName,'creation_date' => $this_week_sd));
   				}
		   }  		   
       	 $this->set(compact('orders','pagination'));
        	}
	
 
	}
