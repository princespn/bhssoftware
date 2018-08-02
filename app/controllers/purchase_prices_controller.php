<?php
class PurchasePricesController extends AppController {

	var $name = 'PurchasePrices';
   	var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    	function beforeFilter() {
        	parent::beforeFilter();
        	$this->Auth->allow(array('productprice','tokenkey','index','searchpurorder','getpurchaseprice','suppliername'));
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


		 
			public function searchpurorder($pagenum){				
				
						$this->set('title', 'Linnworks Get Search Purchase Order.');
      
						$userkey = $this->tokenkey();

						$some_data = array('token' => $userkey);
						
						$header = array("POST:https://eu-ext.linnworks.net//api/PurchaseOrder/Search_PurchaseOrders HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
						
						$url ='https://eu-ext.linnworks.net//api/PurchaseOrder/Search_PurchaseOrders?searchParameter={"DateFrom":"2018-04-11T00:00:00","DateTo":"2018-08-02T00:00:00","Status":"DELIVERED","EntriesPerPage":02,"PageNumber":'. $pagenum .'}';
																				
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
						//print_r($porders->Result); die();
						curl_close($ch);
						if(!empty($porders)){return $porders;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}
					}
					 
					 
					 
					 public function index(){      				  
      
						$userkey = $this->tokenkey();
						$some_data = array('token' => $userkey);
						$page = $this->params['url']['page'];
					
						$pkpurchaseids = $this->searchpurorder($page);						
							//print_r($pkpurchaseids); die();
						
						$pkid = array(); $min = 200;
						
						foreach ($pkpurchaseids->Result as $pkpurchaseid) { 
							
							$pkid[] = $pkpurchaseid->pkPurchaseID;
						}
	   
						for ($i = 1;$i<=$min; $i++){
	   
						//$pkpurchaseid = '4f3edaeb-f224-4fd7-ba74-408ff05a9c44';
				
						$header = array("POST:https://eu-ext.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder HTTP/1.1", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

						$url = "https://eu-ext.linnworks.net//api/PurchaseOrder/Get_PurchaseOrder?pkPurchaseId=".$pkid[$i];

					  
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
								//print_r($porders); 
								curl_close($ch);
								$days = strtotime($porders->PurchaseOrderHeader->DateOfDelivery);
								$date = date("Y-m-d",$days);
								$updeta = date("Ymd",$days);
								$lang = 60*60*24;
								
								$supp = $porders->PurchaseOrderHeader->fkSupplierId;
								$curr = $porders->PurchaseOrderHeader->Currency;
																			
							
							 foreach ($porders->PurchaseOrderItem as $order){
							
							$purprices = round((($order->Cost-$order->Tax)/$order->Quantity),2);
																					
							$data = $this->PurchasePrice->find('all', array('conditions' => array('PurchasePrice.item_sku' => $order->SKU)));	
							$oldd = strtotime($data[0]['PurchasePrice']['purchase_date']);
							$diff = floor(($days-$oldd)/$lang);
						
							
							
							//if ((($data[0]['PurchasePrice']['purchase_price']) === '0') && ($purprices != '0')){ //echo "hello".$data[0]['PurchasePrice']['purchase_price']; die();
							if (((!empty($oldd)) && ($diff>=2)) && (($purprices != '0') && ($days >= $oldd))){ 
																									
								$db = $this->PurchasePrice->getDataSource();
								$valuep = $db->value($purprices, 'string');
								$valued = $db->value($date, 'string');																
								
								$this->PurchasePrice->updateAll(
									array('PurchasePrice.purchase_price' => $valuep,'PurchasePrice.purchase_date' => $valued),
									array('PurchasePrice.item_sku' => $data[0]['PurchasePrice']['item_sku'],'PurchasePrice.id' => $data[0]['PurchasePrice']['id']));
							
							/*} else if (((!empty($oldd)) && ($diff>1)) && (($purprices != '0') && ($data[0]['PurchasePrice']['purchase_date'] !== $date))){ //echo "hello"; die();
								
											
								$db = $this->PurchasePrice->getDataSource();
								$value = $db->value($date, 'string');								
								
								
								$this->PurchasePrice->updateAll(
									array('PurchasePrice.purchase_date' => $value),
									array('PurchasePrice.item_sku' => $data[0]['PurchasePrice']['item_sku'],'PurchasePrice.id' => $data[0]['PurchasePrice']['id']));
						
								*/
							} else if (((!empty($oldd)) && ($diff>=2)) && ($data[0]['PurchasePrice']['invoice_currency'] !== $curr)){ //echo "hello"; die();
																			
								$db = $this->PurchasePrice->getDataSource();
								$value = $db->value($curr, 'string');
								
								
								$this->PurchasePrice->updateAll(
									array('PurchasePrice.invoice_currency' => $value),
									array('PurchasePrice.item_sku' => $data[0]['PurchasePrice']['item_sku'],'PurchasePrice.id' => $data[0]['PurchasePrice']['id']));
							}else {
							
							/* Add sku conditions  
	
							if($order->SKU === 'D0-XCPS-BUS3-MADE'){
							$productsku = 'D0-XCPS-BUS3';
							} else if($order->SKU === 'DFDPILLOWPAIR-MADE'){
							$productsku = 'DFDPILLOWPAIR';
							} else if($order->SKU === 'UPILLOWPAIR-MADE'){
							$productsku = 'DUPILLOWPAIR';		
							} else if($order->SKU === 'MFPILLOWP-MADE'){
							$productsku = 'MFPILLOWP';		
							}else {
							$productsku = $order->SKU;
							}
						
						 End sku conditions */
							
							$this->PurchasePrice->create();							
							$this->PurchasePrice->saveAll(array('purchase_id'=>$order->pkPurchaseItemId, 'supplier_id'=>$supp, 'stock_itemid'=>$order->fkStockItemId, 'item_sku'=>$order->SKU, 'item_title'=>$order->ItemTitle, 'invoice_currency'=>$curr, 'quantity'=>$order->Quantity, 'tax'=>$order->Tax, 'cost'=>$order->Cost, 'purchase_price'=>$purprices, 'purchase_date'=>$date));
							 //echo "hello vzxb xcbbvbh";die();
							 }							
							$this->set(compact('porders','date'));				
							}	
					}

				} 


				public function suppliername(){
				
				$this->set('title', 'Linnworks Get Purchase Prices Information.');
	    		
				$userkey = $this->tokenkey();

						$some_data = array('token' => $userkey);
						
						$header = array("POST:https://eu-ext.linnworks.net//api/Inventory/GetSuppliers HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
						
						$url ='https://eu-ext.linnworks.net//api/Inventory/GetSuppliers';
																				
						$ch = curl_init();
	      				curl_setopt($ch, CURLOPT_URL, $url);
        				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				        curl_setopt($ch, CURLOPT_POST, 1);
				        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
				        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				        $result = curl_exec($ch);
				        $supliers = json_decode($result);
						//print_r($supliers); die();
						curl_close($ch);
						if(!empty($supliers)){return $supliers;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}
					}
				
	}       		