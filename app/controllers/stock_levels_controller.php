<?php
class StockLevelsController extends AppController {

	var $name = 'StockLevels';
    var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index','stock_category'));
        $this->Session->activate();
    }
	
	function presentdate(){	
	
	//$date = date('Y-m-d',strtotime("-1 days"));
					
		$newdate = '2018-11-18';			
		return $newdate;		
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
       // print_r($yummy);die();
        $Token = $yummy->{'Token'};
        if(!empty($Token)){return $Token;}else{throw new MissingWidgetHelperException('Token not authorized to view this page.', 401);}
    }

    public function categname() {

        $userkey = $this->tokenkey();
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

	
	

   public function index(){		
					
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

        
		$header = array("POST:https://eu-ext.linnworks.net//api/Stock/GetStockItemsFull HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

      	$url = 'https://eu-ext.linnworks.net//api/Stock/GetStockItemsFull?keyword=' . $keywords . '&locationId='. $location . '&loadCompositeParents=true&loadVariationParents=true&entriesPerPage=100&pageNumber='. $page .'&dataRequirements=["Supplier","StockLevels"]&searchTypes=[0,0]';

		
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
				//print_r($orders);die();
				
						
		  	 if (!empty($orders)) {
               		foreach ($orders as $order){
					
					for ($i = 0;$i<=count($order->StockLevels); $i++) 
					{
					
				if(($order->CategoryName !=='Swatches') && ($order->CategoryName !=='SAMPLES')){
												
				$this_week_sd = date("Y-m-d");
				//$this_week_sd = '2018-09-03';
				$this->StockLevel->create(); 	
				$this->StockLevel->saveAll(array('change_date' => $this_week_sd,'item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName, 'location_name' => $order->StockLevels[$i]->Location->LocationName, 'stock_lev' => $order->StockLevels[$i]->StockLevel, 'stock_val' => $order->StockLevels[$i]->StockValue, 'minimum_level' => $order->StockLevels[$i]->MinimumLevel,  'due_level' => $order->StockLevels[$i]->Due, 'unit_costs' => $order->StockLevels[$i]->UnitCost, 'stock_itemid' => $order->StockLevels[$i]->StockItemId, 'stock_location_id' => $order->StockLevels[$i]->Location->StockLocationId));
					}
				
				}
				
				$this->loadModel('StockItem');	
				$today_date = date("Y-m-d");				
				$suppname = $order->Suppliers[0]->Supplier;	
				$suppcurr = $order->Suppliers[0]->SupplierCurrency;
				$suppid = $order->Suppliers[0]->SupplierID;	
				
				
				
							
				$stockitemcode = $this->StockItem->find('all', array('conditions' => array('StockItem.item_number' => $order->ItemNumber)));
				
			//print_r($stockitemcode[0]['StockItem']['item_number']);
				if (($order->ItemNumber !== $stockitemcode[0]['StockItem']['item_number']) && (!empty($order->CategoryName))){

				$this->StockItem->create(); 	
				$this->StockItem->saveAll(array('change_date' => $today_date,'item_number' => $order->ItemNumber,'item_title' => $order->ItemTitle, 'barcode_number' => $order->BarcodeNumber,'category_name' => $order->CategoryName,  'supp_name' =>$suppname, 'supp_id' =>$suppid, 'heights' =>$order->Height, 'widths' =>$order->Width, 'depths' =>$order->Depth, 'weights' =>$order->Weight));
				}else{
					
					$db = $this->StockItem->getDataSource();
                    $value = $db->value($suppname, 'string');
					
					 $this->StockItem->updateAll(
                        array('StockItem.supp_name' => $value),
                        array('StockItem.item_number' => $stockitemcode[0]['StockItem']['item_number'],'StockItem.id' => $stockitemcode[0]['StockItem']['id']));
						
					//$this->StockItem->updateAll(array('StockItem.supp_name' => $suppname,'StockItem.category_name' => $order->CategoryName,'StockItem.item_title' =>$order->ItemTitle), array('StockItem.linnworks_code' => $stockitemcode[0]['StockItem']['item_number'], 'StockItem.id' => $stockitemcode[0]['StockItem']['id']));
       
				}
				
				$this->loadModel('CostCalculator');				
				$pcodes = $this->CostCalculator->find('all', array('conditions' => array('CostCalculator.linnworks_code' => $order->ItemNumber)));
				
					if($pcodes[0]['CostCalculator']['supplier'] !== $suppname){
					$db = $this->CostCalculator->getDataSource();
                    $value = $db->value($suppname, 'string');
												
                    $this->CostCalculator->updateAll(
                        array('CostCalculator.supplier' => $value),
                        array('CostCalculator.linnworks_code' => $pcodes[0]['CostCalculator']['linnworks_code'],'CostCalculator.id' => $pcodes[0]['CostCalculator']['id']));
							
					}else if($pcodes[0]['CostCalculator']['category'] !== $order->CategoryName){
												
					$db = $this->CostCalculator->getDataSource();
                    $value = $db->value($order->CategoryName, 'string');
												
                    $this->CostCalculator->updateAll(
                        array('CostCalculator.category' => $value),
                        array('CostCalculator.linnworks_code' => $pcodes[0]['CostCalculator']['linnworks_code'],'CostCalculator.id' => $pcodes[0]['CostCalculator']['id']));
					}else if($pcodes[0]['CostCalculator']['product_name'] !== $order->ItemTitle){
												
					$db = $this->CostCalculator->getDataSource();
                    $value = $db->value($order->CategoryName, 'string');
												
                    $this->CostCalculator->updateAll(
                        array('CostCalculator.product_name' => $value),
                        array('CostCalculator.linnworks_code' => $pcodes[0]['CostCalculator']['linnworks_code'],'CostCalculator.id' => $pcodes[0]['CostCalculator']['id']));
					
					}else {
					$this->CostCalculator->create(); 	
					$this->CostCalculator->saveAll(array('linnworks_code' => $order->ItemNumber,'product_name' => $order->ItemTitle, 'category' => $order->CategoryName, 'supplier' => $suppname, 'invoice_currency' =>$suppcurr,'import_dates' => $today_date));
					}	
							
				$this->loadModel('InventoryCode');
				$Maincodes = $this->InventoryCode->find('all', array('conditions' => array('InventoryCode.linnworks_code' => $order->ItemNumber)));
				
				if (($order->ItemNumber !== $Maincodes[0]['InventoryCode']['linnworks_code']) && (!empty($order->CategoryName))){
										
				$this->InventoryCode->create(); 	
				$this->InventoryCode->saveAll(array('linnworks_code' => $order->ItemNumber,'product_name' => $order->ItemTitle, 'category' => $order->CategoryName));
				
								
					}else {						
						
					$db = $this->InventoryCode->getDataSource();
                    $valuecat = $db->value($order->CategoryName, 'string');
					$valuepro = $db->value($order->ItemTitle, 'string');
					
					$this->InventoryCode->updateAll(
                        array('InventoryCode.category' => $valuecat,'InventoryCode.product_name' => $valuepro),
                        array('InventoryCode.linnworks_code' => $Maincodes[0]['InventoryCode']['linnworks_code'],'InventoryCode.id' => $Maincodes[0]['InventoryCode']['id']));
						
					    }
				}
		   }  		   
       	$this->set(compact('orders','this_week_sd'));
    }
			
			public function stock_category(){
		
					$this->set('title', 'Stock Value Per Category Report.');
					
					$date = $this->presentdate();
					
					$lastday = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
					$lastmonthday = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 0));
					$lastlastmonthday = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 0));
	
					
					
					$this->StockLevel->recursive = 1;
					
					$ukstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.change_date' => $date,'StockLevel.category_name !='=> 'Swatches'),'order' =>array('StockLevel.category_name  ASC')));
					
					/*$waterstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.location_name' =>'WATERFALL LANE','StockLevel.change_date' => $date),'order' =>array('StockLevel.category_name  ASC')));
					
					$ukfbstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.location_name' =>'United Kingdom FBA','StockLevel.change_date' => $date),'order' =>array('StockLevel.category_name  ASC')));
					
					$frfbstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.location_name' =>'France FBA','StockLevel.change_date' => $date),'order' =>array('StockLevel.category_name  ASC')));
					
					$defbstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.location_name' =>'Germany FBA','StockLevel.change_date' => $date),'order' =>array('StockLevel.category_name  ASC')));
					
	   				$esfbstocks =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp', 'CostCalculator.invoice_currency', 'PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => array('StockLevel.location_name' =>'Spain FBA','StockLevel.change_date' => $date),'order' =>array('StockLevel.category_name  ASC')));
					*/
					
					$conditions = array('StockLevel.change_date' => $lastday,'StockLevel.category_name !='=> 'Swatches');
	
					$previousmonth =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'CostCalculator.invoice_currency', 'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp','PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => $conditions, 'order' =>array('StockLevel.category_name  ASC')));
					
					$lastconditions = array('StockLevel.change_date' => $lastmonthday,'StockLevel.category_name !='=> 'Swatches');
	
					$lastmonths =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'CostCalculator.invoice_currency', 'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp','PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => $lastconditions, 'order' =>array('StockLevel.category_name  ASC')));
					
					$lastlastconditions = array('StockLevel.change_date' => $lastlastmonthday,'StockLevel.category_name !='=> 'Swatches');
	
					$lastlastmonths =  $this->StockLevel->find('all', array('fields' => array('StockLevel.category_name', 'StockLevel.item_number' ,'CostCalculator.invoice_currency', 'StockLevel.stock_lev','StockLevel.location_name','CostCalculator.landed_price_gbp','PurchasePrice.purchase_price','PurchasePrice.item_sku'), 'conditions' => $lastlastconditions, 'order' =>array('StockLevel.category_name  ASC')));
					
	   				$this->loadModel('StockItem');
					
					$groupin = array('StockItem.category_name');				
					
					$catnames =  $this->StockItem->find('all', array('fields' => array('StockItem.category_name'), 'group' => $groupin,'order' =>array('StockItem.category_name  ASC')));
					
					//$this->set(compact('lastmonth','lastlastmonth','catnames','ukfbstocks','waterstocks','frfbstocks','defbstocks','esfbstocks','ukstocks','previousmonth'));
					$this->set(compact('previousmonth','lastlastmonths','catnames','ukstocks','lastmonths'));

			}
			
}
