<?php
class StockItem extends AppModel {

    var $name = 'StockItem';
    var $validate = array(
    'id' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Order id is required'
            ),
        ),       
  
    ); 
	
		public function ukstockvalue($date){
		
		$ukstocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Default','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
		return $ukstocks;
		
		}
		
		
		public function waterstockvalue($date){
		
		$waterstock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'WATERFALL LANE','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
		return $waterstock;
		
		}
		
		public function ukfbastockvalue($date){
		
		$ukfbastock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'United Kingdom FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
		return $ukfbastock;
		
		}
		
		public function frfbastockvalue($date){
		
		$frfbastock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'France FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
		return $frfbastock;
		
		}
		
		public function gerfbastockvalue($date){
		
		$gerfbastocks = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Germany FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
		return $gerfbastock;
		
		}
		
		public function esfbastockvalue($date){
		
		$esfbastock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'StockLevel.barcode_number', 'StockLevel.change_date', 'StockLevel.location_name', 'StockLevel.stock_lev'), 'conditions' => array('StockLevel.location_name' =>'Spain FBA','StockLevel.category_name !='=> 'Swatches','StockLevel.change_date' => $date)));
						
		return $esfbastock;
		
		}
		
		
		

	 /*public function last12monthsale(){
		 
		$lastdate = date("Y-m-d"); //2018-02-06
		$ts = strtotime("last year", strtotime($lastdate));
		$firstdate = date('Y-m-d', $ts); //2017-02-01
			 
			 
		$condition = array('ProcessedListing.order_date <= ' => $lastdate,
							'ProcessedListing.order_date >= ' => $firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');

		$groupby = array(('ProcessedListing.product_sku'));			                  
						 
		 
		$salesReports = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
						
		return $salesReports; 
	 }	
 
 
	  public function maxandminsale(){
		 
		$lastdate = date("Y-m-d"); //2018-02-06
		$ts = strtotime("last year", strtotime($lastdate));
		$firstdate = date('Y-m-d', $ts); //2017-02-01
			 
			 
		$condition = array('ProcessedListing.order_date <= ' => $lastdate,
							'ProcessedListing.order_date >= ' => $firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');

		$groupmax = array(('ProcessedListing.product_sku'),
								'AND'=> 'month_name');
						
		$MaxReport = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'MONTHNAME(ProcessedListing.order_date) as month_name','sum(ProcessedListing.quantity) as total_qty'), 'conditions' =>$condition, 'group' => $groupmax, 'order' => array('ProcessedListing.product_sku ASC')));
					
		return $MaxReport; 
	 }	
 
	 public function lastmonthsale(){
		 
		$lastmonthfirst = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1)); //2017-12-01
		$lastmonthend =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0)); //2017-12-31
						
						
		$condlastmonth = array('ProcessedListing.order_date <= ' => $lastmonthend,
						'ProcessedListing.order_date >= ' => $lastmonthfirst,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
						
		$groupby = array(('ProcessedListing.product_sku'));			                  
						 
				
		 $salesLastMonthReport = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$condlastmonth, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
		 return $salesLastMonthReport;
		 
	 }
	 
	 
	 public function currentstocks(){
		 
		$currentdate = '2018-07-02';
		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.barcode_number','StockLevel.category_name');

		
		$Cuurentstock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'sum(StockLevel.stock_lev) as stock_lev', 'StockLevel.category_name', 'sum(StockLevel.due_level) as due_level'), 'conditions' => array('StockLevel.location_name !='=>'Due','StockLevel.change_date' => $currentdate), 'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
		return $Cuurentstock;		 
	 }
	 
	 public function minimumlevel(){
		 
		 $currentdate = '2018-07-02';
		 
		 $minimum_cond =  array ( array('StockLevel.change_date' => $currentdate),
							'OR' => array(
							array('StockLevel.location_name' => 'WATERFALL LANE'),
							array('StockLevel.location_name' => 'Default')));
		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.barcode_number','StockLevel.category_name');

		
		$Minimum_stock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'sum(StockLevel.minimum_level) as minimum_level'),'group' => $grouplast, 'conditions' => $minimum_cond, 'order' => array('StockLevel.item_number ASC')));
		return $Minimum_stock;	
		}
		
		public function last12monthstock(){
			
		$lastdate = date("Y-m-d"); //2018-02-06
		$ts = strtotime("last year", strtotime($lastdate));
		$firstdate = date('Y-m-d', $ts); //2017-02-01
			 	
		 $stock_condition = array('StockLevel.change_date <= ' => $lastdate,
							'StockLevel.change_date >= ' => $firstdate,'StockLevel.stock_lev !='=>'0','StockLevel.location_name' => 'Default');
	
		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.barcode_number','StockLevel.category_name');

		$Last_12_month_stock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days','StockLevel.location_name'), 'conditions' => $stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
		return $Last_12_month_stock;
					
			
		}
		
		public function lastsixmonthstock(){
			
		$lastdate = date("Y-m-d"); //2018-02-06
		$six_firstdate = date('Y-m-d', strtotime("-6 months", strtotime($lastdate)));//2017-08-06
						 	
		 $six_stock_condition = array('StockLevel.change_date <= ' => $lastdate,
							'StockLevel.change_date >= ' => $six_firstdate,'StockLevel.stock_lev !='=>'0','StockLevel.location_name' => 'Default');

		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.barcode_number','StockLevel.category_name');

		$Last_6_month_stock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days'), 'conditions' => $six_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
		return $Last_6_month_stock;					
			
		}
		
		public function lastsixmonthsales(){
			
		$lastdate = date("Y-m-d"); //2018-02-06
		$six_firstdate = date('Y-m-d', strtotime("-6 months", strtotime($lastdate)));//2017-08-06
					
		$six_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $six_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    
		$groupby = array(('ProcessedListing.product_sku'));			                  
						 
		$sixmonth_Report = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$six_condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
		return $sixmonth_Report;
					
			
		}
		public function lastthreemonthstock(){
			
		$lastdate = date("Y-m-d"); //2018-02-06
		$three_firstdate = date('Y-m-d', strtotime("-3 months", strtotime($lastdate)));//2017-08-06
		
		$three_stock_condition = array('StockLevel.change_date <= ' => $lastdate,
							'StockLevel.change_date >= ' => $three_firstdate,'StockLevel.stock_lev !='=>'0','StockLevel.location_name' => 'Default');
		
		$grouplast = array(('StockLevel.item_number'),
					'AND'=> 'StockLevel.barcode_number','StockLevel.category_name');

		$Last_3_month_stock = $this->StockLevel->find('all',array('fields' => array('StockLevel.item_number', 'Count(StockLevel.id) as No_of_days'), 'conditions' => $three_stock_condition,'group' => $grouplast, 'order' => array('StockLevel.item_number ASC')));
		return $Last_3_month_stock;					
			
		}
		
		public function lastthreemonthsales(){
			
		$lastdate = date("Y-m-d"); //2018-02-06
		$three_firstdate = date('Y-m-d', strtotime("-3 months", strtotime($lastdate)));//2017-08-06
					
		$three_condition = array('ProcessedListing.order_date <= ' => $lastdate,
                    'ProcessedListing.order_date >= ' => $three_firstdate,'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                              
		$groupby = array(('ProcessedListing.product_sku'));			                  
						 
		$three_month_Report = $this->ProcessedListing->find('all',array('fields' => array('ProcessedListing.product_sku', 'ProcessedListing.cat_name','sum(ProcessedListing.quantity) as sales_qty'), 'conditions' =>$three_condition, 'group' => $groupby, 'order' => array('ProcessedListing.product_sku ASC')));
		return $three_month_Report;					
			
		}*/ 
		
		
		
		
		
    
/*
  var $hasOne = array(
        'CostCalculator' => array(
            'className' => 'CostCalculator',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = CostCalculator.linnworks_code'
        ),

		'PurchasePrice' => array(
            'className' => 'PurchasePrice',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = PurchasePrice.item_sku'
        ),
		
		'StockLevel' => array(
            'className' => 'StockLevel',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = StockLevel.item_number'
        )
		/*
		'ProcessedListing' => array(
            'className' => 'ProcessedListing',
            'foreignKey' => false,
            'conditions' => 'StockItem.item_number = ProcessedListing.product_sku'
        )  
       
    );*/	
  

}
