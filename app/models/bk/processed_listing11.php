<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
///App::uses('AppModel', 'Model');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class ProcessedListing extends AppModel {

    var $name = 'ProcessedListing';
      public $useTable = "processed_listings";
      //public $recursive = 1;
      
      
      public function importcategory($filename){
        
        $i = null;
        $error = null;
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $filename;
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $return = array(
            //'messages' => array(),
            'errors' => array(),
        );

        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
            $erritem = array();

            foreach ($header as $k => $head) {
                if (strpos($head, '.') !== false) {
                    $h = explode('.', $head);
                    $data[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';
                } else {
                    $data['ProcessedListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                /*$pcodes = $this->find('all', array('conditions' => array('ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id,'ProcessedListing.order_number' => $id)));
                $lincode = $pcodes[0]['ProcessedListing']['order_number'];    
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['ProcessedListing']) && is_array($pcodes[0]['ProcessedListing'])) ? ($pcodes[0]['ProcessedListing']) : array();
                    $data['ProcessedListing'] = (isset($data['ProcessedListing']) && is_array($data['ProcessedListing'])) ? ($data['ProcessedListing']) : array();
                    $data['ProcessedListing'] = array_merge($apiConfig, $data['ProcessedListing']);
                    
                    if(((!empty($apiConfig['order_number'])) && (!empty($lincode))) && ($apiConfig['order_number'] === $lincode)) {                        
                        $limit = 'Order Id Already Exist in Database.';
                        $return['errors'][] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                        }
                    
                } else {
                    $this->id = $id;
                }*/
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['order_id'])) {
                    $limit = $this->validationErrors['order_id'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Order Id $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->order_id = $id));

                }
            }
        }
        return $return;
        //fclose($handle);
    }

	public function sku_currentweeks(){
        
	$previous_week = strtotime("-1 week +1 day");

	$start_week = strtotime("last monday midnight",$previous_week);
	$end_week = strtotime("next sunday",$start_week);

	$this_week_sd = date("Y-m-d",$start_week);
	$this_week_ed = date("Y-m-d",$end_week);
	

	 

	$conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
                    'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
      
	$groupby = array(('ProcessedListing.product_sku'),
    'AND'=> 'ProcessedListing.cat_name');

        $catcurrentweek =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catcurrentweek;       
        
    }
    
    
	
    public function sku_prevweeks(){
        
        
		$present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       
		$conditions = array('ProcessedListing.order_date <= ' => $end_week,
		'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

		$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $categoryprevweeks =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $categoryprevweeks;       
        
    }
    
    
    
		public function sku_lastweekly() {
					
			$present_year_week = strtotime("-53 week +1 day");

			$last_year_week = strtotime("last sunday midnight",$present_year_week);
			$end_year_week = strtotime("next saturday",$last_year_week);

			$main_last_week = date("Y-m-d",$last_year_week);//2017-06-04
			$main_end_week = date("Y-m-d",$end_year_week);//2017-06-10
			
			


			$conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
			'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');
			
			$groupby = array(('ProcessedListing.product_sku'),
			'AND'=> 'ProcessedListing.cat_name');
               
			$Catdatalastweeks =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
			return $Catdatalastweeks;
		
    }
	
	
	public function sku_currentmonths(){
        
	$this_month_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
	$this_month_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));


      $conditions = array('ProcessedListing.order_date <= ' => $this_month_ed,
      'ProcessedListing.order_date >= ' => $this_month_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

	  $groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $catcurrentmonth =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catcurrentmonth;
   }
	
	public function sku_prevmonths(){
		     
		$start_month = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
		$end_month =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));


      $conditions = array('ProcessedListing.order_date <= ' => $end_month,
      'ProcessedListing.order_date >= ' => $start_month,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

	  $groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $catprevmonth =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catprevmonth;
    }
	
	public function sku_lastmonths(){
        
	$main_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
	$main_end_month = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));

      $conditions = array('ProcessedListing.order_date <= ' => $main_end_month,
      'ProcessedListing.order_date >= ' => $main_last_month,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

		$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $catlastmonth =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catlastmonth;
  
    }
	
		
	
	
	public function sku_curryears(){
		
    $year   = date("Y"); 
	$cur_firstdate = date("Y-m-d", strtotime($year."-01-01"));
	$cur_lastday  = date("Y-m-d");
	
	
      $conditions = array('ProcessedListing.order_date <= ' => $cur_lastday,
      'ProcessedListing.order_date >= ' => $cur_firstdate,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

		$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $currentyears =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $currentyears;
  
    }
	
	public function sku_lastytdyears(){
		
	
	$year   = date("Y"); 
	$ytd_first = date("Y-m-d", strtotime($year."-01-01"));
	$start_ytd = date("Y-m-d",strtotime( "-12 months",strtotime($ytd_first)));
	$cur_last  = date("Y-m-d");
	$endytd_end = date("Y-m-d",strtotime( "-12 months",strtotime($cur_last)));
	//print_r($endytd_end);
	

      $conditions = array('ProcessedListing.order_date <= ' => $endytd_end,
      'ProcessedListing.order_date >= ' => $start_ytd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

		$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $catlastyear =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catlastyear;
  
    }

	public function sku_lastyears(){
		
	$year   = date("Y"); 
	$cur_year = date("Y-m-d", strtotime($year."-01-01"));
	$end_year = date("Y-m-d",strtotime( "-12 months",strtotime($cur_year)));
	$last_year = date("Y-m-d",strtotime( "+12 months",strtotime($end_year)));
	$last_day = date("Y-m-d",strtotime( "-1 day",strtotime($last_year)));
	      


      $conditions = array('ProcessedListing.order_date <= ' => $last_day,
      'ProcessedListing.order_date >= ' => $end_year,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

		$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.cat_name');
        
        $catlastyear =  $this->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','sum(ProcessedListing.quantity) as orderid'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','sum(ProcessedListing.quantity) desc')));
        return $catlastyear;  
    }
	
		public function yes_plateform($last_sku){
			
					$lastdate = date("Y-m-d");					
					$yes_date = date('Y-m-d', strtotime("-1 days", strtotime($lastdate)));//2018-04-02
					
					$last_sku = urldecode($last_sku);
					
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');
		 
					$yes_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $yes_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  	$yes_Reports = $this->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$yes_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
						
					return $yes_Reports;
		}
		
		public function yessevendays_plateform($last_sku){
			
					$lastdate = date("Y-m-d");					
					$lastseven_date = date('Y-m-d', strtotime("-7 days", strtotime($lastdate)));//2018-03-27
					$last_sku = urldecode($last_sku);
					
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');
		 
					$lastseven_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lastseven_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                   					
					$lastseven_Reports = $this->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastseven_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					return $lastseven_Reports;
		}
		
		public function yesthertydays_plateform($last_sku){		
		
					$lastdate = date("Y-m-d");
					$lasttherty_date = date('Y-m-d', strtotime("-30 days", strtotime($lastdate)));//2018-03-04
					$last_sku = urldecode($last_sku);
					
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');
		 
					$lasttherty_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lasttherty_date,'ProcessedListing.product_sku' => $last_sku, 'ProcessedListing.product_sku !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                   				
					$lasttherty_Reports = $this->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lasttherty_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					//print_r($lasttherty_Reports);die();
					return $lasttherty_Reports;
		}
		
			public function yesnintydays_plateform($last_sku){		
		
					$lastdate = date("Y-m-d");
					$lastninty_date = date('Y-m-d', strtotime("-90 days", strtotime($lastdate)));//2018-01-03
					$last_sku = urldecode($last_sku);
					
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');
		 
					$lastninty_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $lastninty_date,'ProcessedListing.product_sku' => $last_sku,'ProcessedListing.product_sku !='=>'','ProcessedListing.product_sku !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  
				  
					$lastninty_Reports = $this->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$lastninty_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					return $lastninty_Reports;
		}
		
		
			public function yes365days_plateform($last_sku){		
		
					$lastdate = date("Y-m-d");					
					$last365_date = date('Y-m-d', strtotime("-365 days", strtotime($lastdate)));//2017-08-06
					$last_sku = urldecode($last_sku);
					
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');
		 
					$last365_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $last365_date,'ProcessedListing.product_sku' => $last_sku, 'ProcessedListing.product_sku !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                  			
					$last365_Reports = $this->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.plateform', 'ProcessedListing.product_name', 'ProcessedListing.subsource','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$last365_condition, 'group' => $groupby, 'order' => array('sum(ProcessedListing.quantity) desc')));
					return $last365_Reports;
		}
		
		public function stockvalues(){		

					
		$currentdate = '2018-06-27';		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.category_name');
		
		$Cuurentstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'sum(StockLevel.stock_lev) as stock_lev', 'StockLevel.category_name', 'sum(StockLevel.due_level) as due_level'), 'conditions' => array('StockLevel.location_name !='=>'Due','StockLevel.change_date' => $currentdate), 'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
		return $Cuurentstocks;				
		}
	
	
	 var $hasMany = array(
        'StockLevel' => array(
            'className' => 'StockLevel',
            'foreignKey' => false,
            'conditions' => 'ProcessedListing.product_sku = StockLevel.item_number'
        )   

    );
	
	
}
