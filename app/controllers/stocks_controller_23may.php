<?php
class StocksController extends AppController {

	var $name = 'Stocks';
	 var $components = array('Acl', 'Auth', 'Session','RequestHandler');
     var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');
		
		function beforeFilter()
                {
                    parent::beforeFilter();
                    $this->Auth->allow(array('login','logout','index','update','category'));
                    $this->Auth->userModel = 'User';  
                    $this->Session->activate();
					$this->layout = 'admin';
                }
	
	
		 function import() {
                        if (!empty($this->data))
                        {
                        $filename = $this->data['Stock']['file']['name'];
                        $fileExt = explode(".", $filename);
                        $fileExt2 = end($fileExt);
                            if($fileExt2 == 'csv') {
                                if(move_uploaded_file($this->data['Stock']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['Stock']['file']['name'])) 
                                $messages = $this->Stock->import_inventory($filename);
                                $this->Session->setFlash(__('The Master Inventory was Imports successfully.', true));
                                    if (!empty($messages)){
                                    $this->set('anything', $messages);
                                    Configure::write('debug', '2');
                                    }
                            }
                            else
                            {
                            $this->Session->setFlash(__('The Master Inventory File format not supported.</br>Please upload .CSV file format only.', true));
                            }
                        }			
                        else 
                        {
                        //$filename = 'inventory_master-old.csv';
                        }
                }
		
		
		
		public function tokenkey(){
		 $auth_data = array(
			'userName' =>'roopa@homescapesonline.com',
			'password' =>'bhslinn',
			'userId' =>'ffc7e454-b0b3-4d67-ad10-23c639a61992'); 
			$header = array("POST:https://api.linnworks.net//api/Auth/Authorize HTTP/1.1","Host:api.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate");
			$url = 'https://api.linnworks.net//api/Auth/Authorize?userName='.$auth_data['userName'].'&password='.$auth_data['password'].'&userId='.$auth_data['userId'];
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$auth_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					return $yummy->{'Token'};
							
	}	
	
		public function category() {
			$userkey = $this->tokenkey();
			$some_data = array('token' => $userkey); 
			$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetCategories HTTP/1.1<","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
			$url = 'https://eu1.linnworks.net//api/Inventory/GetCategories';

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$yummy = json_decode($result);
					curl_close($ch);
					return $yummy;
			 }		
	
		public function index($catname = null) {
		if(!empty($catname)){
		$options =$catname;
		}
		$this->set('title', 'Master inventory information taken from Linnwork.');
		$categories = $this->category();
				if((!empty($catname)) && (substr_count($catname, ' '))){	
				$keyword = substr(trim($catname),0,3);
				
				}
			else if ((!empty($catname))){		
			$keyword = substr(trim($catname),0,5);
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(is_numeric($this->data['Stock']['keyword'])))
			{
				
			$keyword = trim($this->data['Stock']['keyword']);
			
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')==0))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,8);	
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')<=3))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,3);	
			}
			else if ((!empty($this->data['Stock']['keyword'])) &&(substr_count($this->data['Stock']['keyword'],' ')>=4))
			{		
			$catname = trim($this->data['Stock']['keyword']);
			$keyword = substr($catname,0,4);	
			}
			else{
			$keyword = '';
			}
		
		$locationId = '00000000-0000-0000-0000-000000000000';
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItems HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Stock/GetStockItems?keyWord='.$keyword.'&locationId='.$locationId.'&entriesPerPage=10000&pageNumber=1&excludeComposites=true';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$stocks = json_decode($result);
					curl_close($ch);
					$this->set(compact('stocks','categories','options'));				
	}
	
	
	
	public function gettitle($id) {				
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemTitles HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemTitles?inventoryItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$tdesc = json_decode($result);
					curl_close($ch);
					return $tdesc;
					
	}
	
	public function getbinloc($id) {				
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemLocations HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemLocations?inventoryItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$locations = json_decode($result);
					curl_close($ch);
					return $locations;
					
	}
	
	public function getuname($id) {				
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemAuditTrail HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemAuditTrail?inventoryItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$getunames = json_decode($result);
					curl_close($ch);
					return $getunames;
					
	}
	
	public function getmeasures($id) {				
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockLevel HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Stock/GetStockLevel?stockItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$measures = json_decode($result);
					curl_close($ch);
					return $measures;
					
	}
	
	public function detail($ids) {							
				
		$locationId = '00000000-0000-0000-0000-000000000000';
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Stock/GetStockItems HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Stock/GetStockItems?keyWord='.$ids.'&locationId='.$locationId.'&entriesPerPage=10000&pageNumber=1&excludeComposites=true';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$detail = json_decode($result);
					curl_close($ch);
					return $detail;				
	}
	
	public function imageid($id) {							
		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemImages HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemImages?inventoryItemId='.$id;
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$imag = json_decode($result);
					curl_close($ch);
					return $imag;				
	}
	
	public function mainprice($id) {							
		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemPrices HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemPrices?inventoryItemId='.$id;
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$mprices = json_decode($result);
					curl_close($ch);
					return $mprices;				
	}
	
	public function getchannels($id) {							
		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemChannelSKUs HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemChannelSKUs?inventoryItemId='.$id;
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$channels = json_decode($result);
					curl_close($ch);
					return $channels;				
	}
	
	public function getproperties($id) {							
		
		$userkey = $this->tokenkey();
		$some_data = array('token' => $userkey);
		$header = array("POST:https://eu1.linnworks.net//api/Inventory/GetInventoryItemExtendedProperties HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemExtendedProperties?inventoryItemId='.$id;
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$Propertys = json_decode($result);
					curl_close($ch);
					return $Propertys;				
	}
	
	public function update($id,$ids) {//print_r($ids);die();
	$this->set('title', 'All information displayed here for Amazon UK,DE,FR and Ebey.');
		
		//$gettitles = $this->gettitle($id);
		$itemids = $this->getbinloc($id);
		//$getunames = $this->getuname($id);
		$measures = $this->getmeasures($id);
		$details = $this->detail($ids);
		$imagds = $this->imageid($id);
		//$mainprices = $this->mainprice($id);
		$channels = $this->getchannels($id);
		//$properties = $this->getproperties($id);
		
		$userkey = $this->tokenkey();		
		$some_data = array('token' => $userkey);
		$header = array("POST:POST https://eu1.linnworks.net//api/Inventory/GetInventoryItemDescriptions HTTP/1.1","Host: eu1.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate","Authorization:".$some_data['token']);
		$url = 'https://eu1.linnworks.net//api/Inventory/GetInventoryItemDescriptions?inventoryItemId='.$id.'';
		
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_POSTFIELDS,$some_data);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
					//curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($ch);
					$descs = json_decode($result);
					curl_close($ch);
					//$this->set(compact('gettitles','descs','itemids','getunames','measures','details','imagds','mainprices','channels','properties'));
					$this->set(compact('descs','itemids','measures','details','imagds','channels'));
			}
	
	
	
}