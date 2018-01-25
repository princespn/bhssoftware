<?php
class StockItemsController extends AppController {

		var $name = 'StockItems';
   	 	var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    		var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    	function beforeFilter() {
        	parent::beforeFilter();
        	$this->Auth->allow(array('minimum_level','category','stock_category', 'index'));
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
					
					$Catname = $this->categname();
					
					
					//$date = date('Y-m-d',strtotime("-1 days"));
					$date = '2018-01-23';
					//print_r($date);die();
					
					$this->loadModel('StockLevel');
					
					$ukstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $date)));
					
					$waterstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'WATERFALL LANE','StockLevel.change_date' => $date)));
					
					$ukfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'United Kingdom FBA','StockLevel.change_date' => $date)));
					
					$frfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'France FBA','StockLevel.change_date' => $date)));

					$gerfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Germany FBA','StockLevel.change_date' => $date)));
					
					$esfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Spain FBA','StockLevel.change_date' => $date)));

					if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['StockItem']['all_item']))) {
            		$string = trim($this->data['StockItem']['all_item']);   
					//print_r($string);die();
					$condsku = array('StockItem.item_number LIKE' => '%' . $string . '%');
					$orders = array('StockItem.item_number ASC');
					$this->paginate = array('limit' => 100, 'order' => $orders, 'conditions' => $condsku);
					}else{						
					$orders = array('StockItem.item_number ASC');
					$this->paginate = array('limit' => 100, 'order' => $orders);
					}
					$this->StockItem->recursive = 1;
					$this->set('stocks', $this->paginate());
					$this->set(compact('esfbastocks','waterstocks','gerfbastocks','frfbastocks','ukfbastocks','ukstocks','Catname'));
					
			}
					
					
					public function category($catn){
		
					$this->set('title', 'Linnworks Get Stock Items Information.');
					
					$Catname = $this->categname();					
					
					$cat = urldecode($catn);
					//print_r($cat);die();
						  
					//$date = date('Y-m-d',strtotime("-1 days"));
					$date = '2018-01-23';

					$this->loadModel('StockLevel');
					
					$ukstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $date, 'StockLevel.category_name' => $cat)));
					
					$waterstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'WATERFALL LANE','StockLevel.change_date' => $date, 'StockLevel.category_name' => $cat)));
					
					$ukfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'United Kingdom FBA','StockLevel.change_date' => $date, 'StockLevel.category_name' => $cat)));
					
					$frfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'France FBA','StockLevel.change_date' => $date, 'StockLevel.category_name' => $cat)));

					$gerfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Germany FBA','StockLevel.change_date' => $date, 'StockLevel.category_name' => $cat)));
					
					$esfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Spain FBA','StockLevel.change_date' => $date)));
					
					if (empty($cat)) {
					$this->Session->setFlash(__('Please select valid category.', true));
					$this->redirect(array('controller' => 'stock_items', 'action' => 'stockitems'));
					} else {
						
						$orders = array('StockItem.item_number ASC');
						$conditions = array('StockItem.category_name LIKE' => '%' . $cat . '%');                
						$this->paginate = array('limit' => 100, 'order' => $orders, 'conditions' => $conditions);
					}
					//print_r($waterstocks);die();								
					$this->StockItem->recursive = 1;
					$this->set('stocks', $this->paginate());
					
					$this->set(compact('esfbastocks','waterstocks','gerfbastocks','frfbastocks','ukfbastocks','ukstocks','Catname'));
					}
					
					
					public function minimum_level(){
		
					$this->set('title', 'Minimum Stock level Report.');
					
					$firstdate = '2017-01-24';
					$lastdate = '2018-01-24';
					
					$lastmonthfirst = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
					$lastmonthend =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));


					$this->loadModel('ProcessedListing');

					$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
						
					
					
					$condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$condlastmonth = array('ProcessedListing.order_date <= ' => $lastmonthend,
                    'ProcessedListing.order_date >= ' => $lastmonthfirst,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					//12 Month sales
					
					$salesReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					//Last Month sales
					
					$salesLastMonthReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condlastmonth, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					// Current Stock 
					
					$currentdate = '2018-01-23';

					$this->loadModel('StockLevel');
					
					$Cuurentstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $currentdate), 'order' => array('StockLevel.item_number ASC')));
					
					
					
					//print_r($Cuurentstocks);die();
					
					//$this->StockItem->recursive = 1;
					$this->paginate = array('limit' => 100, 'order' => array('StockItem.item_number ASC'));
					$this->set('stock_names', $this->paginate()); 
					$this->set(compact('Cuurentstocks','salesLastMonthReports','stock_names','salesReports','datediff'));
				   
					
					
									
					//$stock_names =  $this->StockItem->find('all', array('fields' => array(), 'order' =>array()));
					//$this->set(compact('stock_names','salesReports'));

			}
					
					
    


					
		
		}