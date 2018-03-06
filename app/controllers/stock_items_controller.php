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
					$date = '2018-02-20';
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
					$date = '2018-02-20';

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
					
					$lastdate = date("Y-m-d"); //2018-02-06
					$ts = strtotime("last year", strtotime($lastdate));
					$firstdate = date('Y-m-d', $ts); //2017-02-01
					
									
					$lastmonthfirst = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1)); //2017-12-01
					
					$lastmonthend =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0)); //2017-12-31
					

					$this->loadModel('ProcessedListing');

					$groupby = array(('ProcessedListing.product_sku'));
							
					$groupmax = array(('ProcessedListing.product_sku'),
							'AND'=> 'month_name');
						
					
					
					$condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$condlastmonth = array('ProcessedListing.order_date <= ' => $lastmonthend,
                    'ProcessedListing.order_date >= ' => $lastmonthfirst,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					//12 Month sales
					
					$salesReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					$MaxReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'MONTHNAME(ProcessedListing.order_date) as month_name','sum(ProcessedListing.quantity) as total_qty'), 'conditions' =>$condition, 'group' => $groupmax, 'order' => array('ProcessedListing.product_sku ASC')));
					
					//print_r($MaxReports);die();
					//Last Month sales
					
					$salesLastMonthReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condlastmonth, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					
					$this->loadModel('StockLevel');
					
					/* Start Calculation last 6 month */
					
					$six_firstdate = date('Y-m-d', strtotime("-6 months", strtotime($lastdate)));//2017-08-06
					
					$six_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $six_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$sixmonth_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$six_condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					$six_stock_condition = array('StockLevel.change_date <= ' => $lastdate,
                    'StockLevel.change_date >= ' => $six_firstdate,'StockLevel.location_name'=>'Default','StockLevel.stock_lev !='=>'0');
					
					$grouplast = array(('StockLevel.item_number'));
					
					$Last_6_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.stock_lev) as No_of_days'), 'conditions' => $six_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					/* End Calculation last 6 month */
					
					/* Start Calculation last 3 month */
					
					$three_firstdate = date('Y-m-d', strtotime("-3 months", strtotime($lastdate)));//2017-08-06
					
					$three_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $three_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$three_month_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$three_condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					$three_stock_condition = array('StockLevel.change_date <= ' => $lastdate,
                    'StockLevel.change_date >= ' => $three_firstdate,'StockLevel.location_name'=>'Default','StockLevel.stock_lev !='=>'0');
					
					//$grouplast = array(('StockLevel.item_number'));
					
					$Last_3_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.stock_lev) as No_of_days'), 'conditions' => $three_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					
					//print_r($Last_6_month_stocks);die();
					/* End Calculation last 3 month */
					
					
					/* Current Stock  */
					
					$currentdate = '2018-02-20';
					$Cuurentstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $currentdate), 'order' => array('StockLevel.item_number ASC')));
					
					//No of days out of stock in last 12 months
					$stock_condition = array('StockLevel.change_date <= ' => $lastdate,
                    'StockLevel.change_date >= ' => $firstdate,'StockLevel.location_name'=>'Default','StockLevel.stock_lev !='=>'0');
					
					//$grouplast = array(('StockLevel.item_number'));
					
					$Last_12_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.stock_lev) as No_of_days'), 'conditions' => $stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					//print_r($Last_12_month_stocks);die();
					
					//$this->StockItem->recursive = 1;
					$this->paginate = array('limit' => 100, 'order' => array('StockItem.item_number ASC'));
					$this->set('stock_names', $this->paginate()); 
					$this->set(compact('three_month_Reports', 'Last_3_month_stocks', 'Last_6_month_stocks', 'sixmonth_Reports', 'Last_12_month_stocks','MaxReports','Cuurentstocks','salesLastMonthReports','stock_names','salesReports','datediff'));
			}
							
		
		}