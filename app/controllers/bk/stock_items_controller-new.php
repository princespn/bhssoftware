<?php
class StockItemsController extends AppController {

		var $name = 'StockItems';
   	 	var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
    		var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    	function beforeFilter() {
        	parent::beforeFilter();
        	$this->Auth->allow(array('minimum_level','salesvalue_reports','dailyplyvalue_reports', 'dailyplateform_reports','dailysales_reports','category','stock_category', 'index'));
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
	
	 public function getsupp() {
                 $userkey = $this->tokenkey();
				$some_data = array('token' => $userkey);
               
              $header = array("POST:https://eu-ext.linnworks.net//api/Inventory/GetSuppliers HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, ; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
              $url = 'https://eu-ext.linnworks.net//api/Inventory/GetSuppliers';


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
                $supplier = json_decode($result);
                curl_close($ch);
              // print_r($supplier);die();
                return $supplier;
    }

		
 		public function index(){
		
					$this->set('title', 'Linnworks Get Stock Items Information.');
					
					$Catname = $this->categname();
										
					//$date = date('Y-m-d',strtotime("-1 days"));
					$date = '2018-05-24';
					//print_r($date);die();
					
					$this->loadModel('StockLevel');
					
					$ukstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
					
					$waterstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'WATERFALL LANE','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
					
					$ukfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'United Kingdom FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
					
					$frfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'France FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));

					$gerfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Germany FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
					
					$esfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Spain FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));

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
					$date = '2018-05-24';

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
					
					
					public function minimum_level($catn){
		
					$this->set('title', 'Minimum Stock level Report.');
					
					$Catname = $this->categname();
					
					$Suppname = $this->getsupp();
					
					//print_r($Suppname);die();
					
					
					
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
							'StockLevel.change_date >= ' => $six_firstdate,'StockLevel.stock_lev !='=>'0');

					 /*$six_stock_condition =  array ( array('StockLevel.change_date <= ' => $lastdate,'StockLevel.change_date >= ' => $six_firstdate),
							'OR' => array(
							array('StockLevel.location_name' => 'Default'))); */
		
					
					$grouplast = array(('StockLevel.item_number'));
					
					$Last_6_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days'), 'conditions' => $six_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					/* End Calculation last 6 month */
					
					/* Start Calculation last 3 month */
					
					$three_firstdate = date('Y-m-d', strtotime("-3 months", strtotime($lastdate)));//2017-08-06
					

					$three_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $three_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$three_month_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$three_condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
					
					$three_stock_condition = array('StockLevel.change_date <= ' => $lastdate,
							'StockLevel.change_date >= ' => $three_firstdate,'StockLevel.stock_lev !='=>'0','StockLevel.location_name' => 'Default');

					
					/* $three_stock_condition =  array ( array('StockLevel.change_date <= ' => $lastdate,'StockLevel.change_date >= ' => $three_firstdate),
							'OR' => array(
							array('StockLevel.location_name' => 'Default'))); */
		
										
					$Last_3_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days'), 'conditions' => $three_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					
					//print_r($Last_6_month_stocks);die();
					/* End Calculation last 3 month */
					
					
					/* Current Stock  */
					
					$currentdate = '2018-05-24';
					
					$Cuurentstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'sum(StockLevel.due_level) as due_level','sum(StockLevel.stock_lev) as stock_lev'),'group' => $grouplast, 'conditions' => array('StockLevel.change_date' => $currentdate,'StockLevel.location_name !='=>'Serene Furnishings Ltd.'), 'order' => array('StockLevel.item_number ASC')));
					
					 $minimum_cond =  array ( array('StockLevel.change_date' => $currentdate),
							'OR' => array(
							array('StockLevel.location_name' => 'WATERFALL LANE'),
							array('StockLevel.location_name' => 'Default')));
		
		
					$Minimum_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'sum(StockLevel.minimum_level) as minimum_level'),'group' => $grouplast, 'conditions' => $minimum_cond, 'order' => array('StockLevel.item_number ASC')));
					
					//No of days out of stock in last 12 months
					
					 $stock_condition = array(array('StockLevel.change_date <= ' => $lastdate,
							'StockLevel.change_date >= ' => $firstdate,'StockLevel.stock_lev !='=>'0',
							'AND' =>array(array('StockLevel.location_name' => 'Default',
							'OR' => array('StockLevel.location_name' => 'Spain FBA'),
							'OR' => array('StockLevel.location_name' => 'Germany FBA'),
							'OR' => array('StockLevel.location_name' => 'France FBA'),							
							'OR' => array('StockLevel.location_name' => 'United Kingdom FBA'),
							'OR' => array('StockLevel.location_name' => 'WATERFALL LANE'),
							
								))));

					 /*$stock_condition =  array ( array('StockLevel.change_date <= ' => $lastdate,'StockLevel.change_date >= ' => $firstdate),
							'OR' => array(
							array('StockLevel.location_name' => 'Default',)));*/
		
		
					$Last_12_month_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days','StockLevel.location_name'), 'conditions' => $stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
					
					//print_r($Last_12_month_stocks);die();
					
					//$this->StockItem->recursive = 1;
					$catnaam = urldecode($catn);
					
              if(!empty($catnaam)){
				  

				  
				    $conditions =  array (
							'OR' => array(
							array('StockItem.category_name LIKE' => '%' . $catnaam . '%'),
							array('StockItem.supp_name LIKE' => '%' . $catnaam . '%')));
		
		
			  	$this->paginate = array('limit' => 100, 'conditions' => $conditions, 'order' => array('StockItem.item_number ASC'));
			  
			  } 
			else  if ((!empty($_POST['checkid'])) && (!empty($_POST['exports']))) {
            $checkboxid = $_POST['checkid'];
			//print_r($checkboxid);die();
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "minimum_level.csv";
            $csv->auto($filepath);           
            $this->set('stockall_reports',$this->StockItem->find('all', array('fields' => array('StockItem.item_number','StockItem.item_title','StockItem.category_name','StockItem.supp_name'),'conditions' => array('StockItem.id' => $checkboxid))));
			$this->set(compact('three_month_Reports', 'Last_3_month_stocks', 'Last_6_month_stocks', 'sixmonth_Reports', 'Last_12_month_stocks','MaxReports','Cuurentstocks','Minimum_stocks','salesLastMonthReports','salesReports'));
		   $$this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '0');
				}
			  
			  else
			  {					
					$this->paginate = array('limit' => 100, 'order' => array('StockItem.item_number ASC'));
			  }
					$this->set('stock_names', $this->paginate()); 
					$this->set(compact('Suppname', 'Catname', 'three_month_Reports', 'Last_3_month_stocks', 'Last_6_month_stocks', 'sixmonth_Reports', 'Last_12_month_stocks','MaxReports','Cuurentstocks','Minimum_stocks','salesLastMonthReports','stock_names','salesReports','datediff'));
			}
			
			
			
			public function dailysales_reports($month){
				
					$this->set('title', 'Daily Sales Reports - Top SKU Ordered by Quantity.');
					
					
					/* Current Stock  */
					
					$lastdate = date("Y-m-d"); //2018-02-06
					
					$this->loadModel('StockLevel');
					
					$this->loadModel('ProcessedListing');

					$groupby = array(('ProcessedListing.product_sku'));
					
					$get_month = urldecode($month);
					
				    if(!empty($get_month)){$six_firstdate = date('Y-m-d', strtotime($get_month, strtotime($lastdate)));}else{$six_firstdate = date('Y-m-d', strtotime("-6 months", strtotime($lastdate)));}
					
					
					
					
					$last_yeardate = date('Y-m-d', strtotime("-12 months", strtotime($lastdate)));//2017-08-06
					
					
					
					
						$previous_week = strtotime("-1 week +1 day");

						$start_week = strtotime("last monday midnight",$previous_week);
						$end_week = strtotime("next sunday",$start_week);

						$this_week_sd = date("Y-m-d",$start_week); ////2018-03-19
						$this_week_ed = date("Y-m-d",$end_week); //2018-03-25
					//print_r($this_week_ed);die();
					
					
										

					
					
					$six_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $six_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$sixmonth_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency', 'sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$six_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc'), 'limit' => 100));
					
					$currweek_condition = array('ProcessedListing.order_date <= ' => $this_week_ed,
                    'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$currweek_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$currweek_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
					
					$present_week = strtotime("-2 week +1 day");

					$second_week = strtotime("last monday midnight",$present_week);
					
					$send_week = strtotime("next sunday",$second_week);

					$start_week = date("Y-m-d",$second_week); //2018-03-12
					
					$end_week = date("Y-m-d",$send_week); //2018-03-12
					
									
				
					
					$lastweek_condition = array('ProcessedListing.order_date <= ' => $end_week,
                    'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
					$lastweek_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency', 'sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastweek_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
					
					
					$samemonth_lastweek = date('Y-m-d', strtotime("-1 months", strtotime($start_week))); //2018-02-12
					
					$samemonth_endweek = date('Y-m-d', strtotime("-1 months", strtotime($end_week)));//2018-02-18
					
							
					
					$lastmonth_condition = array('ProcessedListing.order_date <= ' => $samemonth_endweek,
                    'ProcessedListing.order_date >= ' => $samemonth_lastweek,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
				
				 	$lastmonth_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastmonth_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
				
				  	$samemonth_lastyear = date('Y-m-d', strtotime("-12 months", strtotime($start_week)));//2017-03-12
					
					$samemonth_end = date('Y-m-d', strtotime("-12 months", strtotime($end_week)));//2017-03-18
					

					
					$lastyear_condition = array('ProcessedListing.order_date <= ' => $samemonth_end,
                    'ProcessedListing.order_date >= ' => $samemonth_lastyear,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
				
					$lastyear_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastyear_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
				
					
					
				//print_r($sixmonth_Reports);die();
								
					
					$currentdate = '2018-05-24';
					
					$Cuurent_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.stock_lev', 'StockLevel.due_level'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $currentdate), 'order' => array('StockLevel.item_number ASC')));
				
					$this->paginate = array('limit' => 100, 'order' => array('StockItem.item_number ASC'));
					$this->set('stock_names', $this->paginate()); 
					$this->set(compact('sixmonth_Reports','currweek_Reports','lastweek_Reports','lastmonth_Reports','lastyear_Reports','stock_names','Cuurent_stocks'));
				
				
				
				
				
			}
			
			

//order value
			
			public function salesvalue_reports($month){
				
					$this->set('title', 'Daily Sales Reports - Top SKU Ordered by Value.');
					
					
					/* Current Stock  */
					
					$lastdate = date("Y-m-d"); //2018-02-06
					
					$this->loadModel('StockLevel');
					
					$this->loadModel('ProcessedListing');

					$groupby = array(('ProcessedListing.product_sku'),
							'AND'=> 'ProcessedListing.currency');
 
					///$groupby = array(('ProcessedListing.product_sku'));
					
										
					$get_month = urldecode($month);
					
				    if(!empty($get_month)){$six_firstdate = date('Y-m-d', strtotime($get_month, strtotime($lastdate)));}else{$six_firstdate = date('Y-m-d', strtotime("-6 months", strtotime($lastdate)));}
					
					
					
					
					$last_yeardate = date('Y-m-d', strtotime("-12 months", strtotime($lastdate)));//2017-08-06
					
					
					
					
						$previous_week = strtotime("-1 week +1 day");

						$start_week = strtotime("last monday midnight",$previous_week);
						$end_week = strtotime("next sunday",$start_week);

						$this_week_sd = date("Y-m-d",$start_week); ////2018-03-19
						$this_week_ed = date("Y-m-d",$end_week); //2018-03-25
					//print_r($this_week_ed);die();
					
					
										

					
					
					$six_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $six_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$sixmonth_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.price_per_product) as sales_qty'), 'conditions' =>$six_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.price_per_product) desc'), 'limit' => 100));
					
					$currweek_condition = array('ProcessedListing.order_date <= ' => $this_week_ed,
                    'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
					$currweek_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.price_per_product) as sales_qty'), 'conditions' =>$currweek_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.price_per_product) desc')));
					
					
					$present_week = strtotime("-2 week +1 day");

					$second_week = strtotime("last monday midnight",$present_week);
					
					$send_week = strtotime("next sunday",$second_week);

					$start_week = date("Y-m-d",$second_week); //2018-03-12
					
					$end_week = date("Y-m-d",$send_week); //2018-03-12
					
									
				
					
					$lastweek_condition = array('ProcessedListing.order_date <= ' => $end_week,
                    'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
					$lastweek_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.price_per_product) as sales_qty'), 'conditions' =>$lastweek_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.price_per_product) desc')));
					
					
					
					$samemonth_lastweek = date('Y-m-d', strtotime("-1 months", strtotime($start_week))); //2018-02-12
					
					$samemonth_endweek = date('Y-m-d', strtotime("-1 months", strtotime($end_week)));//2018-02-18
					
							
					
					$lastmonth_condition = array('ProcessedListing.order_date <= ' => $samemonth_endweek,
                    'ProcessedListing.order_date >= ' => $samemonth_lastweek,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
				
				 	$lastmonth_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.price_per_product) as sales_qty'), 'conditions' =>$lastmonth_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.price_per_product) desc')));
					
				
				  	$samemonth_lastyear = date('Y-m-d', strtotime("-12 months", strtotime($start_week)));//2017-03-12
					
					$samemonth_end = date('Y-m-d', strtotime("-12 months", strtotime($end_week)));//2017-03-18
					

					
					$lastyear_condition = array('ProcessedListing.order_date <= ' => $samemonth_end,
                    'ProcessedListing.order_date >= ' => $samemonth_lastyear,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                
				
					$lastyear_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.product_name', 'ProcessedListing.cat_name', 'ProcessedListing.currency','sum(ProcessedListing.price_per_product) as sales_qty'), 'conditions' =>$lastyear_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.price_per_product) desc')));
					
				
					
					
				//print_r($sixmonth_Reports);die();
								
					
					$currentdate = '2018-05-24';
					
					$Cuurent_stocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.stock_lev', 'StockLevel.due_level'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.change_date' => $currentdate), 'order' => array('StockLevel.item_number ASC')));
				
					$this->paginate = array('limit' => 100, 'order' => array('StockItem.item_number ASC'));
					$this->set('stock_names', $this->paginate()); 
					$this->set(compact('sixmonth_Reports','currweek_Reports','lastweek_Reports','lastmonth_Reports','lastyear_Reports','stock_names','Cuurent_stocks'));
				
				}
					




			public function dailyplateform_reports($last_sku){
				
					$this->set('title', 'Daily Sales Reports - Top Plateform Quantity Ordered.');
					 
					$last_sku = urldecode($last_sku);
					$lastdate = date("Y-m-d"); //2018-04-03
					
									
					$this->loadModel('ProcessedListing');

					//$groupby = array(('ProcessedListing.subsource'));
					
				$groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource');
					
					$condition = array('ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                 
					$Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
					
					$yes_date = date('Y-m-d', strtotime("-1 days", strtotime($lastdate)));//2018-04-02
					
					
										
					$yes_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $yes_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  
				  
					
					$yes_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$yes_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
			
					
					$lastseven_date = date('Y-m-d', strtotime("-7 days", strtotime($lastdate)));//2018-03-27
					
					
										
					$lastseven_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lastseven_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                   
					
					$lastseven_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastseven_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					
					
					
					$lasttherty_date = date('Y-m-d', strtotime("-30 days", strtotime($lastdate)));//2018-03-04
								
					
										
					$lasttherty_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lasttherty_date,'ProcessedListing.product_sku' => $last_sku, 'ProcessedListing.product_sku !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                   
					
					
					$lasttherty_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lasttherty_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					//print_r($lasttherty_Reports);die();
					
					$lastninty_date = date('Y-m-d', strtotime("-90 days", strtotime($lastdate)));//2018-01-03
								
												//print_r($lastninty_date); die();	
					$lastninty_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lastninty_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'','ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  
				  
					$lastninty_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastninty_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					//print_r();die();
				
					$last365_date = date('Y-m-d', strtotime("-365 days", strtotime($lastdate)));//2017-08-06
						
										
					$last365_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $last365_date,'ProcessedListing.product_sku' => $last_sku, 'ProcessedListing.product_sku !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  
					
					$last365_Reports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$last365_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					//print_r();die();
				
				
				
					
					$this->set(compact('Reports','yes_Reports','lastseven_Reports','lasttherty_Reports','lastninty_Reports', 'last365_Reports'));
				
			}
		
		
			
		}