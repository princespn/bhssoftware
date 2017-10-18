<?php
class StockLevelsController extends AppController {

	var $name = 'StockLevels';
    var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('searchpurorder','getpurchaseprice','orderswithstock','index','stockitemid','stock_status','getstockitems'));
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
					
					
				ini_set('memory_limit', '-1');
					
     			  $this->set('title', 'Linnworks Get Full Stock Items Information.');
      
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

      		$url = 'https://eu1.linnworks.net//api/Stock/GetStockItemsFull?keyword=' . $keywords . '&locationId='. $location . '&loadCompositeParents=true&loadVariationParents=true&entriesPerPage=100&pageNumber='. $page .'&dataRequirements=[0,0]&searchTypes=[0,0]';

		
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
		        curl_close($ch);
				
				//print_r($orders); 
					//die();
		
		  	 if (!empty($orders)) {
               			 foreach ($orders as $order){
					for ($i = 0;$i<=count($order->StockLevels); $i++) {
						
					//echo  $order->StockLevels[$i]->StockItemId;
					//echo  $order->StockLevels[$i]->Location->StockLocationId;
					
				
				$this_week_sd = date("Y-m-d");
				$this->StockLevel->create(); 	
				$this->StockLevel->saveAll(array('change_date' => $this_week_sd,'item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName, 'location_name' => $order->StockLevels[$i]->Location->LocationName, 'stock_lev' => $order->StockLevels[$i]->StockLevel, 'stock_val' => $order->StockLevels[$i]->StockValue, 'unit_costs' => $order->StockLevels[$i]->UnitCost, 'stock_itemid' => $order->StockLevels[$i]->StockItemId, 'stock_location_id' => $order->StockLevels[$i]->Location->StockLocationId));
   				}
				$this->loadModel('StockItem');	
				$today_date = date("Y-m-d");
				$this->StockItem->create(); 	
				$this->StockItem->saveAll(array('change_date' => $today_date,'item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName, 'heights' =>$order->Height, 'widths' =>$order->Width, 'depths' =>$order->Depth, 'weights' =>$order->Weight));
				}
		   }  		   
       	 $this->set(compact('orders','pagination','this_week_sd'));
        	}
	
   
   
   
   public function stock_status(){		
		
		$this->set('title', 'Linnworks Get Stock Items Information.');
	    
		$this_start_date = '2017-10-18';	    
	    $this_end_date = '2017-10-18';
    
    
		 $conditions = array('StockLevel.change_date <=' => $this_end_date,
			 'StockLevel.change_date >=' => $this_start_date);

		 $groupby = array(('StockLevel.change_date'),
         'AND'=> 'StockLevel.category_name');

    
		$this->StockItem->recursive = 1;	
		$this->set('datastocks',$this->StockLevel->find('all', array('fields' => array('StockLevel.change_date', 'StockLevel.item_number', 'StockLevel.item_title', 'StockLevel.category_name', 'StockLevel.stock_lev', 'StockLevel.stock_val', 'StockLevel.stock_itemid','StockLevel.unit_costs','StockLevel.location_name'),'conditions' =>$conditions)));
	}
   



				

				
			
			/*public function orderswithstock(){				
				
						$this->set('title', 'Linnworks Get Stock Consumption.');
      
						$userkey = $this->tokenkey();

						$some_data = array('token' => $userkey);*/
				
						
						//$header = array("POST:https://eu1.linnworks.net//api/PurchaseOrder/GetPurchaseOrdersWithStockItems HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

						
						//$url ='https://eu1.linnworks.net//api/PurchaseOrder/GetPurchaseOrdersWithStockItems?purchaseOrder={"StockItemId":"0ff12e50-4c36-4014-8c08-cf702978f915","LocationIds":["00000000-0000-0000-0000-000000000000","631e1a93-27b9-4e7d-8acc-3095d2056eb3"]}';
						
														
						/*$ch = curl_init();
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
						if(!empty($porders)){return $porders;}

					   
					 }*/
					 
					 
			
   
}
