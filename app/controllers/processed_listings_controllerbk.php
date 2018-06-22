<?php
class ProcessedListingsController extends AppController {

	var $name = 'ProcessedListings';
        var $components = array('Email','Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();   
      
        $this->Auth->allow(array('productsku_notifications','notifications','selection_productsku','selection_categories','index', 'tokenkey','category_weekly','productsku_monthly','category_monthly','productsku_weekly','categname','importcategory','category_prevmonths','category_currentmonths','category_currentweeks','category_prevweeks'));
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
        if(!empty($Token)){return $Token ;}else{throw new MissingWidgetHelperException('Token not authorized to view this page.', 401);}
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

	/*
     * Start category by Reports
     * 
     */
    
    public function category_currentweeks(){
        
 $previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);
 


      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

     //$conditions = array('ProcessedListing.price_per_product !='=>'0','ProcessedListing.cat_name !='=>'');
     
$groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

        
        $catcurrentweek =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
       //print_r($catcurrentweek); die();
        return $catcurrentweek;
       
        
    }
    
    public function count_currentweeks(){
        
 $previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);
 


      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

     //$conditions = array('ProcessedListing.price_per_product !='=>'0','ProcessedListing.cat_name !='=>'');
     
$groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');

        
        $countcurrentweek =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
       //print_r($countcurrentweek); die();
        return $countcurrentweek;
       
        
    }
    
    public function category_prevweeks(){
        
        
      $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       

$conditions = array('ProcessedListing.order_date <= ' => $end_week,
      'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

  $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');
        
        $categoryprevweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        return $categoryprevweeks;       
        
    }
    

    public function count_prevweeks(){
        
        
      $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       

$conditions = array('ProcessedListing.order_date <= ' => $end_week,
      'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'');

  $groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');
        
        $countprevweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        //print_r($countprevweeks);die();
        return $countprevweeks;       
        
    }
    
    
    public function count_lastweeks() {  
        
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);




 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');
 
  $groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');

       
        
        $Countlastweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        //print_r($Countlastweeks);die();
        return $Countlastweeks;
        
    }
    
    
    public function category_lastweekly() {

   
        
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);




 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');
  $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

       
        
        $Catdatalastweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        // print_r($Catdatalastweeks);die();
        return $Catdatalastweeks;
    
    }

    public function category_weekly() {

        $this->set('title', 'Sales Per-Category Weekly Orders Reports Inventory Database.'); 
        
        $Catcurrents = $this->category_currentweeks();
        $Catpreviousweeks = $this->category_prevweeks();
        $Catlastweeks = $this->category_lastweekly();
        $Countcurrenpweeks =  $this->count_currentweeks();
        $Countprevweeks = $this->count_prevweeks();
        $Countlastweeks = $this->count_lastweeks();
         






        $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
 
    $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

       
        
        $CatSaveallweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        // print_r($Catdatalastweeks);die();
        $this->set(compact('CatSaveallweeks','Catlastweeks','Catpreviousweeks','Catcurrents','Countcurrenpweeks','Countprevweeks','Countlastweeks'));
       
    }

    
    /* Add monthly Reports */
    
    
    
     public function category_currentmonths(){

      $this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
        $this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));


      /*$start_week = strtotime("first day of last month");
        //$end_week = strtotime("next month",$start_week);
        $end_week = strtotime("last day of last month");




        $this_week_sd = date("Y-m-d",$start_week);
        $this_week_ed = date("Y-m-d",$end_week);*/



            $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
                  'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

                  $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

                   $Catcurrentdata =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    //print_r($Catcurrentdata);die(); 
                   return $Catcurrentdata;

    }
    
    
    
    public function count_currentmonths(){

      

     $this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
        $this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));



            $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
                  'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

                 $groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');

                   $Countdatacurrent =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    //print_r($Catcurrentdata);die(); 
                   return $Countdatacurrent;

    }

    
    
    
    public function category_prevmonths(){

      
      /* $start_week = strtotime("first day of last month");
       $present_week = strtotime("-1 month",$start_week);
        $send_week = strtotime("next month",$present_week);
        $day_week = strtotime("-1 day",$send_week);

        $start_week = date("Y-m-d",$present_week);
        $end_week = date("Y-m-d",$day_week);*/


$start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
$end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));

$conditions = array('ProcessedListing.order_date <= ' => $end_week,
      'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

 $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

 $Catdataprevous =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
      //print_r($dataprevweeks);die();     
        return $Catdataprevous;

    }

    
     public function count_prevmonths(){

      
 $start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
$end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));




$conditions = array('ProcessedListing.order_date <= ' => $end_week,
      'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');

  $groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');


 $Countdataprev =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
      //print_r($dataprevweeks);die();     
        return $Countdataprev;

    }
    

    public function count_lastmonthly() {

        $this->set('title', 'Sales Per-Category Monthly Orders Reports Inventory Database.');        
      

           
       /*$present_year_week = strtotime("first day of last Year last month");
        //$end_year_week = strtotime("next month",$present_year_week);
        $end_year_week = strtotime("last day of last Year last month");

        $main_last_week = date("Y-m-d",$present_year_week);
        $main_end_week = date("Y-m-d",$end_year_week);*/

        
        $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
        $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));


        $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
             'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');
        
        $groupby = array(('ProcessedListing.cat_name'),
         'AND'=> 'ProcessedListing.currency');

        $Countdatalast =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
        return $Countdatalast;

    
}


    
            public function category_lastmonths() {

                    $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
                    $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));



                    $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
                         'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'');
                     $groupby = array(('ProcessedListing.plateform'),
                            'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

                    $Catmonthlasts =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                   //print_r($Catdataprevous);die();
                    
                    return $Catmonthlasts;
                


            }
            
             public function category_monthly() {

                    $this->set('title', 'Sales Per-Category Monthly Orders Reports Inventory Database.');        
                    $Catmonthcurrents = $this->category_currentmonths();
                    $Catmonthprevous = $this->category_prevmonths();
                    $Catlastmonths = $this->category_lastmonths();
                    $Countmonthcurrent = $this->count_currentmonths();
                    $Countmonthprevous = $this->count_prevmonths();
                    $Countmonthlast = $this->count_lastmonthly();



        $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.cat_name !='=>'');
                     $groupby = array(('ProcessedListing.plateform'),
                            'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

                    $Catsaveallmonth =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                   //print_r($Catdataprevous);die();   
                    $this->set(compact('Catsaveallmonth','Catmonthprevous','Catmonthcurrents','Catlastmonths','Countmonthcurrent','Countmonthprevous','Countmonthlast'));
                    


            }



/*
 * 
 * 
 * Product sku weekly Process orders Reports
 * 
 * 
 *  
 */
    

 
        public function countsku_prevweeks($catgoryname,$productname){
        
        
      $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       
            if(!empty($catgoryname)){
            $conditions = array('ProcessedListing.order_date <= ' => $end_week,
                  'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name  '=> $catgoryname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');
            }else if(!empty($productname)){
            $conditions = array('ProcessedListing.order_date <= ' => $end_week,
                  'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=> $productname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');
            } else{
                $conditions = array('ProcessedListing.order_date <= ' => $end_week,
                  'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');


            }
              $groupby = array(('ProcessedListing.product_sku'),
                     'AND'=> 'ProcessedListing.currency');

                    $countskuprevweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
                    //print_r($countskuprevweeks);die();
                    return $countskuprevweeks;       

                }
    
    
    public function productsku_prevweeks($catgoryname,$productname){
        
        
      $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       
        if(!empty($catgoryname)){

        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name  '=> $catgoryname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }else if(!empty($productname)){

        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=> $productname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }else {

                $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');


            }

        
          $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      //$groupby = array('ProcessedListing.product_sku');

        
        $skuprevweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
      // print_r($skuprevweeks); die();
         return $skuprevweeks; 
        
    }
    


    
    
    public function countsku_lastweeks($catgoryname,$productname) {  
        
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);


if(!empty($catgoryname)){

 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name  '=> $catgoryname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
}else if(!empty($productname)){

 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=> $productname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
}else {
    
   $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
 
}
  $groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.currency');

       
         $Countskulastweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
              //print_r($Countskulastweeks);die();
        return $Countskulastweeks;
        
    }
    

        
    public function productsku_lastweekly($catgoryname,$productname) {   
         

     
        
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);



if(!empty($catgoryname)){
    
 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name  '=> $catgoryname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
 
}else if(!empty($productname)){
    
 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=> $productname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
 
}else{
    
    
 $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
      'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
 

}

       
              
          $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      //$groupby = array('ProcessedListing.product_sku');

        
        $productskulastweek =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
       //print_r($productskulastweek); die();
      return $productskulastweek;
        
      
    }

    
    public function countsku_currweeks($catgoryname,$productname){
        
 $previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);
 

    if(!empty($catgoryname)){
        
      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name  '=> $catgoryname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
    }  else if(!empty($productname)){
        
      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.product_sku '=> $productname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
    } else {
        
        $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
    
        
    }
     //$conditions = array('ProcessedListing.price_per_product !='=>'0','ProcessedListing.cat_name !='=>'');
     
$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.currency');

         $countskucurrentweek =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
      //print_r($countskucurrentweek); die();
        return $countskucurrentweek;     
        
        
    }
    

     public function productsku_presentweeks($catgoryname,$productname){
         
        
    $previous_week = strtotime("-1 week +1 day");

       $start_week = strtotime("last monday midnight",$previous_week);
       $end_week = strtotime("next sunday",$start_week);

       $this_week_sd = date("Y-m-d",$start_week);
       $this_week_ed = date("Y-m-d",$end_week);
 
       if(!empty($catgoryname)){ 
      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name '=> $catgoryname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
            } else if(!empty($productname)){ 
       $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.product_sku'=> $productname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else {
       $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }
 ;
     
    $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
     
       
        $productskupresentweeks =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
        return $productskupresentweeks;
              
    }
    
    
     public function productsku_weekly($catgoryname){
         
         
        $this->set('title', 'Sales Product SKU Weekly Process Orders Reports.');  
        
        $categories = $this->categname();
        
       if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['productname'])))
           {                      
         $productname = $this->data['ProcessedListing']['productname'];         
             }else{           
           $catgoryname = urldecode($catgoryname);           
             }  
       
        $productskupreviousweeks = $this->productsku_prevweeks($catgoryname,$productname);
        $productskulastsweeks = $this->productsku_lastweekly($catgoryname,$productname);
        $productskucurrents = $this->productsku_presentweeks($catgoryname,$productname);
        $Countskucurrweeks =  $this->countsku_currweeks($catgoryname,$productname);
        $Countskuprevweeks = $this->countsku_prevweeks($catgoryname,$productname);
        $Countskulastweeks = $this->countsku_lastweeks($catgoryname,$productname);
    
        
        
      
 
       if(!empty($catgoryname)){ 
      $conditions = array('ProcessedListing.cat_name '=> $catgoryname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
            } else if(!empty($productname)){ 
       $conditions = array('ProcessedListing.product_sku'=> $productname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else {
       $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }
          
  
     
    $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      
    
     $this->paginate = array(
        'fields' => array('ProcessedListing.product_sku','ProcessedListing.product_name','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 
        'limit' => 50,
        'group' => $groupby,
        'conditions' => $conditions,
        'order' => array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')
        );
     $this->set('saveallproductskus', $this->paginate());     
     $this->set(compact('productskucurrents','categories','productskupreviousweeks','productskulastsweeks','Countskucurrweeks','Countskuprevweeks','Countskulastweeks'));
       
    }
    

    /*
 * 
 * 
 * Product sku Monthly Process orders Reports
 * 
 * 
 *  
 */
    

 
        public function countsku_prevmonths($catgoryskuname,$productskuname){
        
        
    $start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
    $end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));

       
        if(!empty($catgoryskuname)){
        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name '=>$catgoryskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');
        }else if(!empty($productskuname)){
        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=>$productskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');
        } else {
    
        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
          'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.currency !='=>'','ProcessedListing.product_sku !='=>'');
        }
 
        $groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.currency');
        
  
        $countskuprevmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
        //print_r($countskuprevweeks);die();
        return $countskuprevmonths;       
        
    }
    
    
    public function productsku_prevmonths($catgoryskuname,$productskuname){
        
        
     $start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
    $end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));

       
        if(!empty($catgoryskuname)){
        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name '=>$catgoryskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
         } else if(!empty($productskuname)){
        $conditions = array('ProcessedListing.order_date <= ' => $end_week,
              'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=>$productskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
         } else {
         $conditions = array('ProcessedListing.order_date <= ' => $end_week,
         'ProcessedListing.order_date >= ' => $start_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
         }
        
          $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      //$groupby = array('ProcessedListing.product_sku');

        
        $skuprevmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
      // print_r($skuprevweeks); die();
         return $skuprevmonths; 
        
    }
    


    
    
    public function countsku_lastmonths($catgoryskuname,$productskuname) {  
        
    $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
    $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));

        if(!empty($catgoryskuname)){
         $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name '=>$catgoryskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }else if(!empty($productskuname)){
         $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=>$productskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else {

             $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }

  $groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.currency');

       
        $Countskulastmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
        //print_r($Countskulastweeks);die();
        return $Countskulastmonths;
        
    }
    

        
    public function productsku_lastmonths($catgoryskuname,$productskuname) {   
         

        $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
        $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));



        if(!empty($catgoryskuname)){
         $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product !='=>'0','ProcessedListing.cat_name '=>$catgoryskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else if(!empty($productskuname)){
         $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product !='=>'0','ProcessedListing.product_sku '=>$productskuname,'ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else {

             $conditions = array('ProcessedListing.order_date <= ' => $main_end_week,
              'ProcessedListing.order_date >= ' => $main_last_week,'ProcessedListing.price_per_product !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }


       
              
          $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      //$groupby = array('ProcessedListing.product_sku');

        
        $productskulastmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform !='=>'','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
       //print_r($productskulastweek); die();
      return $productskulastmonths;
        
      
    }

    
    public function countsku_currmonths($catgoryskuname,$productskuname){
        
        $this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
        $this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));


           if(!empty($catgoryskuname)){
      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name '=>$catgoryskuname,'ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
           } else if(!empty($productskuname)){
      $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.product_sku '=>$productskuname,'ProcessedListing.product_sku !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
           } else {
               
         $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
      'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
          
           }
    
     
$groupby = array(('ProcessedListing.product_sku'),
         'AND'=> 'ProcessedListing.currency');

        
        $countskucurrentmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'),'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
      
        //print_r($countskucurrentweek); die();
        return $countskucurrentmonths;
       
        
    }
    

    public function productsku_presmonths($catgoryskuname,$productskuname) {   
         

         $this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
        $this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));



            if(!empty($catgoryskuname)){ 
            $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
              'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.cat_name'=> $catgoryskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            } else if(!empty($productskuname)){                 
            $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
          'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.product_sku'=> $productskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            } else {
                    $conditions = array('ProcessedListing.order_date <= ' => $this_week_ed,
                'ProcessedListing.order_date >= ' => $this_week_sd,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            }

       
              
          $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
      //$groupby = array('ProcessedListing.product_sku');

        
        $productskupresmonths =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.plateform !='=>'','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')));
       //print_r($productskulastweek); die();
      return $productskupresmonths;
        
      
    }

     public function productsku_monthly($catgoryskuname){   
          
                $this->set('title', 'Sales Product SKU Monthly Process Orders Reports.'); 
                
                 $categories = $this->categname();      

                  $catgoryskuname = urldecode($catgoryskuname);

                if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['productname']))) {    
                $productskuname = $this->data['ProcessedListing']['productname'];
                      }
                    else
                     {
                            $catgoryskuname = urldecode($catgoryskuname);
                     }  
                
                
                    $productskupreviousmonths = $this->productsku_prevmonths($catgoryskuname,$productskuname);
                    $productskulastsmonths = $this->productsku_lastmonths($catgoryskuname,$productskuname);
                    $productskucurrmonths = $this->productsku_presmonths($catgoryskuname,$productskuname);
                    $Countskucurrmonths =  $this->countsku_currmonths($catgoryskuname,$productskuname);
                    $Countskuprevmonths = $this->countsku_prevmonths($catgoryskuname,$productskuname);
                    $Countskulastmonths = $this->countsku_lastmonths($catgoryskuname,$productskuname);

                 
        
        
          if(!empty($catgoryskuname)){ 
            $conditions = array('ProcessedListing.cat_name'=> $catgoryskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            } else if(!empty($productskuname)){                 
            $conditions = array('ProcessedListing.product_sku'=> $productskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            } else {
                    $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
            }
     
    $groupby = array(('ProcessedListing.plateform'),
         'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
   
     $this->paginate = array(
        'fields' => array('ProcessedListing.product_sku','ProcessedListing.product_name','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 
        'limit' => 50,
        'group' => $groupby,
        'conditions' => $conditions,
        'order' => array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')
        );
     $this->set('saveallskudatamanths', $this->paginate());     
     $this->set(compact('productskucurrmonths','categories','productskupreviousmonths','productskulastsmonths','Countskucurrmonths','Countskuprevmonths','Countskulastmonths'));
       
        
    }
    


/*
 * Import CSV Processed Orders
 * 
 * 
 * 
 */

public function importcategory(){    
    
    
    $this->set('title', 'Processed Orders Category Import CSV in Database system.');

        if (!empty($this->data)) {
            $filename = $this->data['ProcessedListing']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            //print_r($this->data['ProcessedListing']['file']['tmp_name']); die();

            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['ProcessedListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['ProcessedListing']['file']['name']))
                    // $messages = $this->ProcessedListing->importprocessed($filename);
                    $messages = $this->ProcessedListing->importcategory($filename);
                $this->Session->setFlash(__('Processed Orders Catgory data Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('File format not supported,Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }  
    
    
}

     public function get_months($date1, $date2) { 
						$time1  = strtotime($date1); 
						$time2  = strtotime($date2); 
						$my     = date('Y-m-d', $time2); 

						$months = array(date('Y-m-d', $time1)); 

						while($time1 < $time2) { 
						$time1 = strtotime(date('Y-m-d', $time1).' +1 month'); 
						if(date('Y-m-d', $time1) != $my && ($time1 < $time2)) 
						$months[] = date('Y-m-d', $time1); 
						} 

						$months[] = date('Y-m-d', $time2); 
						return $months; 
                } 
				
				

           

          public function selection_categories(){

                $this->set('title', 'Number of Processed Orders in Selected Periods.');
               
                         
                 
                
                if ((!empty($this->data['ProcessedListing']['date_from'])) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['date_to']))) {
                 $first_date =  $this->data['ProcessedListing']['date_from'];
                  $next_date =  $this->data['ProcessedListing']['date_to']; 
                  } else{
                      
                            
                    $first_date = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
                    $next_date = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
                      
                  }
				 
               
			     
                  
                //$month_interval =  (int)abs((strtotime($first_date) - strtotime($next_date))/(60*60*24*29)); 
                
 
                $month_interval = 1 + (date('Y',strtotime($next_date)) - date('Y',strtotime($first_date))) * 12   +   (date('m',strtotime($next_date)) - date('m',strtotime($first_date))); 
                				
                $query_date = $this->get_months($first_date, $next_date);
                   
                $firstdate = array();  $lastdate = array();
              
                foreach($query_date as $firstandlast){  
				
                $firstdate[] =  date('Y-m-01', strtotime($firstandlast));                
                $lastdate[] =  date('Y-m-t', strtotime($firstandlast)); 
				
                }
                
					$group = array(('ProcessedListing.cat_name'),
						'AND'=> 'ProcessedListing.currency');
						
						
					$groupby = array(('ProcessedListing.plateform'),
						'AND'=> 'ProcessedListing.subsource','ProcessedListing.cat_name');

					if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$cond1 = array('ProcessedListing.order_date <= ' => $lastdate[1],
                    'ProcessedListing.order_date >= ' => $firstdate[1],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall1 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond1,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $conditions1 = array('ProcessedListing.order_date <= ' => $lastdate[1],
                    'ProcessedListing.order_date >= ' => $firstdate[1],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates1 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates1','Catsaveall1'));
					}
					if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$cond2 = array('ProcessedListing.order_date <= ' => $lastdate[2],
                    'ProcessedListing.order_date >= ' => $firstdate[2],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall2 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond2,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $conditions2 = array('ProcessedListing.order_date <= ' => $lastdate[2],
                    'ProcessedListing.order_date >= ' => $firstdate[2],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates2 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions2,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates2','Catsaveall2'));
					}
					if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$cond3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond3,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions3,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates3','Catsaveall3'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$cond4 = array('ProcessedListing.order_date <= ' => $lastdate[4],
                    'ProcessedListing.order_date >= ' => $firstdate[4],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall4 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond4,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions4 = array('ProcessedListing.order_date <= ' => $lastdate[4],
                    'ProcessedListing.order_date >= ' => $firstdate[4],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates4 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions4,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates4','Catsaveall4'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
  					$cond5 = array('ProcessedListing.order_date <= ' => $lastdate[5],
                    'ProcessedListing.order_date >= ' => $firstdate[5],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall5 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond5,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions5 = array('ProcessedListing.order_date <= ' => $lastdate[5],
                    'ProcessedListing.order_date >= ' => $firstdate[5],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates5 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions5,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates5','Catsaveall5'));
					}
					if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond6 = array('ProcessedListing.order_date <= ' => $lastdate[6],
                    'ProcessedListing.order_date >= ' => $firstdate[6],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall6 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond6,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions6 = array('ProcessedListing.order_date <= ' => $lastdate[6],
                    'ProcessedListing.order_date >= ' => $firstdate[6],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates6 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions6,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates6','Catsaveall6'));
					}
					if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond7 = array('ProcessedListing.order_date <= ' => $lastdate[7],
                    'ProcessedListing.order_date >= ' => $firstdate[7],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall7 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond7,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions7 = array('ProcessedListing.order_date <= ' => $lastdate[7],
                    'ProcessedListing.order_date >= ' => $firstdate[7],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates7 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions7,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates7','Catsaveall7'));
					}
					if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond8 = array('ProcessedListing.order_date <= ' => $lastdate[8],
                    'ProcessedListing.order_date >= ' => $firstdate[8],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall8 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond8,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions8 = array('ProcessedListing.order_date <= ' => $lastdate[8],
                    'ProcessedListing.order_date >= ' => $firstdate[8],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates8 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions8,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates8','Catsaveall8'));
					}
					if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
				           
					$cond9 = array('ProcessedListing.order_date <= ' => $lastdate[9],
                    'ProcessedListing.order_date >= ' => $firstdate[9],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall9 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond9,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions9 = array('ProcessedListing.order_date <= ' => $lastdate[9],
                    'ProcessedListing.order_date >= ' => $firstdate[9],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates9 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions9,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates9','Catsaveall9'));
					}
					if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond12 = array('ProcessedListing.order_date <= ' => $lastdate[10],
                    'ProcessedListing.order_date >= ' => $firstdate[10],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall12 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond12,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions12 = array('ProcessedListing.order_date <= ' => $lastdate[10],
                    'ProcessedListing.order_date >= ' => $firstdate[10],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates12 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions12,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   //print_r($Catsaveall12); 
                    $this->set(compact('countselectdates12','Catsaveall12'));
					}
					if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond13 = array('ProcessedListing.order_date <= ' => $lastdate[11],
                    'ProcessedListing.order_date >= ' => $firstdate[11],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall13 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond13,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions13 = array('ProcessedListing.order_date <= ' => $lastdate[11],
                    'ProcessedListing.order_date >= ' => $firstdate[11],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates13 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions13,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates13','Catsaveall13'));
					}
					
					//start 13 month 
					
					if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condone = array('ProcessedListing.order_date <= ' => $lastdate[12],
                    'ProcessedListing.order_date >= ' => $firstdate[12],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveaone =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condone,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionone = array('ProcessedListing.order_date <= ' => $lastdate[12],
                    'ProcessedListing.order_date >= ' => $firstdate[12],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatesone =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionone,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdatesone','Catsaveaone'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condtwo = array('ProcessedListing.order_date <= ' => $lastdate[13],
                    'ProcessedListing.order_date >= ' => $firstdate[13],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveatwo =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condtwo,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditiontwo = array('ProcessedListing.order_date <= ' => $lastdate[13],
                    'ProcessedListing.order_date >= ' => $firstdate[13],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatestwo =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditiontwo,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdatestwo','Catsaveatwo'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condfive = array('ProcessedListing.order_date <= ' => $lastdate[14],
                    'ProcessedListing.order_date >= ' => $firstdate[14],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveafives  =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condfive,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionfive  = array('ProcessedListing.order_date <= ' => $lastdate[14],
                    'ProcessedListing.order_date >= ' => $firstdate[14],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatesfive =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionfive,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdatesfive','Catsaveafives'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condsix = array('ProcessedListing.order_date <= ' => $lastdate[15],
                    'ProcessedListing.order_date >= ' => $firstdate[15],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveasixes =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condsix,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionsix = array('ProcessedListing.order_date <= ' => $lastdate[15],
                    'ProcessedListing.order_date >= ' => $firstdate[15],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatessix =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionsix,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdatessix','Catsaveasixes'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condsev = array('ProcessedListing.order_date <= ' => $lastdate[16],
                    'ProcessedListing.order_date >= ' => $firstdate[16],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveaseves =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condsev,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionsev = array('ProcessedListing.order_date <= ' => $lastdate[16],
                    'ProcessedListing.order_date >= ' => $firstdate[16],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatessev =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionsev,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdatessev','Catsaveaseves'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condeight = array('ProcessedListing.order_date <= ' => $lastdate[17],
                    'ProcessedListing.order_date >= ' => $firstdate[17],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveaeights =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condeight,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditioneight = array('ProcessedListing.order_date <= ' => $lastdate[17],
                    'ProcessedListing.order_date >= ' => $firstdate[17],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdateseight =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditioneight,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdateseight','Catsaveaeights'));
					
					}
					if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condnine = array('ProcessedListing.order_date <= ' => $lastdate[18],
                    'ProcessedListing.order_date >= ' => $firstdate[18],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsavnines =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condnine,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionnine = array('ProcessedListing.order_date <= ' => $lastdate[18],
                    'ProcessedListing.order_date >= ' => $firstdate[18],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatenines =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionnine,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdatenines','Catsavnines'));
					
					}
					if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condeten = array('ProcessedListing.order_date <= ' => $lastdate[19],
                    'ProcessedListing.order_date >= ' => $firstdate[19],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsavetens =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condeten,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditiontens = array('ProcessedListing.order_date <= ' => $lastdate[19],
                    'ProcessedListing.order_date >= ' => $firstdate[19],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatetens =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditiontens,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdatetens','Catsavetens'));
					
					}
					if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condelev = array('ProcessedListing.order_date <= ' => $lastdate[20],
                    'ProcessedListing.order_date >= ' => $firstdate[20],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveaelevs =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condelev,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditionelev = array('ProcessedListing.order_date <= ' => $lastdate[20],
                    'ProcessedListing.order_date >= ' => $firstdate[20],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdateleves =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditionelev,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdateleves','Catsaveaelevs'));
					
					}
					if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condtwel = array('ProcessedListing.order_date <= ' => $lastdate[21],
                    'ProcessedListing.order_date >= ' => $firstdate[21],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveatweles =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $condtwel,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditiontwel = array('ProcessedListing.order_date <= ' => $lastdate[21],
                    'ProcessedListing.order_date >= ' => $firstdate[21],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatetwels =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditiontwel,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdatetwels','Catsaveatweles'));
					
					}
					if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$cond23 = array('ProcessedListing.order_date <= ' => $lastdate[22],
                    'ProcessedListing.order_date >= ' => $firstdate[22],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveathretyes =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond23,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $condition23 = array('ProcessedListing.order_date <= ' => $lastdate[22],
                    'ProcessedListing.order_date >= ' => $firstdate[22],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdatethretyes =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $condition23,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdatethretyes','Catsaveathretyes'));
					
					}
					if((!empty($month_interval)) && ($month_interval=='24')){ 
                  
					$cond24 = array('ProcessedListing.order_date <= ' => $lastdate[23],
                    'ProcessedListing.order_date >= ' => $firstdate[23],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveaforthyes =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond24,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $condition24 = array('ProcessedListing.order_date <= ' => $lastdate[23],
                    'ProcessedListing.order_date >= ' => $firstdate[23],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdateforthyes =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $condition24,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
                    $this->set(compact('countselectdateforthyes','Catsaveaforthyes'));
					
					}
					
					//End  24 month 
					
                    $cond = array('ProcessedListing.order_date <= ' => $lastdate[0],
                    'ProcessedListing.order_date >= ' => $firstdate[0],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $condited = array('ProcessedListing.order_date <= ' => $lastdate[0],
                    'ProcessedListing.order_date >= ' => $firstdate[0],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdated =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $condited,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
					
					$conditions = array('ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.plateform ASC')));
   
   
	 //print_r($Catsaveall1);die();
                    $this->set(compact('query_date','Catsaveall','countselectdated','countselectdates','month_interval'));  
                            

		  }
		
		public function selection_productsku(){

            $this->set('title', 'Number of Processed Orders in Products SKU Dates or Periods Selection.');
               
            $categories = $this->categname();      

            $catgoryskuname = urldecode($catgoryskuname);

            if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['productname']))) {    
                $productskuname = $this->data['ProcessedListing']['productname'];
                      }
                    else
                     {
                            $catgoryskuname = urldecode($catgoryskuname);
                     }
					 
			   if(!empty($catgoryskuname)){ 
				$conditions = array('ProcessedListing.cat_name'=> $catgoryskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
				} else if(!empty($productskuname)){                 
				$conditions = array('ProcessedListing.product_sku'=> $productskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
				} else {
						$conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
				}
     
   
                 
				 
                
                if ((!empty($this->data['ProcessedListing']['date_from'])) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['date_to']))) {
                 $first_date =  $this->data['ProcessedListing']['date_from'];
                  $next_date =  $this->data['ProcessedListing']['date_to']; 
                  } else{                   
                            
                    $first_date = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
                    $next_date = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
                      
                  }
				 
               
			     
                  
                $month_interval =  (int)abs((strtotime($first_date) - strtotime($next_date))/(60*60*24*29)); 
                  
                $query_date = $this->get_months($first_date, $next_date);
                   
                $firstdate = array();  $lastdate = array();
              
                foreach($query_date as $firstandlast){  
				
                $firstdate[] =  date('Y-m-01', strtotime($firstandlast));                
                $lastdate[] =  date('Y-m-t', strtotime($firstandlast)); 
				
                }
                
					$group = array(('ProcessedListing.cat_name'),
						'AND'=> 'ProcessedListing.currency','ProcessedListing.product_sku');
						
					 $groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
   
        
						
						
					
					if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                
					$cond1 = array('ProcessedListing.order_date <= ' => $lastdate[1],
                    'ProcessedListing.order_date >= ' => $firstdate[1],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall1 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond1,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $conditions1 = array('ProcessedListing.order_date <= ' => $lastdate[1],
                    'ProcessedListing.order_date >= ' => $firstdate[1],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates1 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates1','Catsaveall1'));
					}
					if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                
					$cond2 = array('ProcessedListing.order_date <= ' => $lastdate[2],
                    'ProcessedListing.order_date >= ' => $firstdate[2],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall2 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond2,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $conditions2 = array('ProcessedListing.order_date <= ' => $lastdate[2],
                    'ProcessedListing.order_date >= ' => $firstdate[2],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates2 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions2,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates2','Catsaveall2'));
					}
					if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                
					$cond3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond3,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions3,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates3','Catsaveall3'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                
					$cond4 = array('ProcessedListing.order_date <= ' => $lastdate[4],
                    'ProcessedListing.order_date >= ' => $firstdate[4],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall4 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond4,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions4 = array('ProcessedListing.order_date <= ' => $lastdate[4],
                    'ProcessedListing.order_date >= ' => $firstdate[4],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates4 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions4,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates4','Catsaveall4'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
  					$cond5 = array('ProcessedListing.order_date <= ' => $lastdate[5],
                    'ProcessedListing.order_date >= ' => $firstdate[5],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall5 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond5,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions5 = array('ProcessedListing.order_date <= ' => $lastdate[5],
                    'ProcessedListing.order_date >= ' => $firstdate[5],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates5 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions5,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates5','Catsaveall5'));
					}
					if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                  
					$cond6 = array('ProcessedListing.order_date <= ' => $lastdate[6],
                    'ProcessedListing.order_date >= ' => $firstdate[6],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall6 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond6,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions6 = array('ProcessedListing.order_date <= ' => $lastdate[6],
                    'ProcessedListing.order_date >= ' => $firstdate[6],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates6 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions6,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates6','Catsaveall6'));
					}
					if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                  
					$cond7 = array('ProcessedListing.order_date <= ' => $lastdate[7],
                    'ProcessedListing.order_date >= ' => $firstdate[7],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall7 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond7,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions7 = array('ProcessedListing.order_date <= ' => $lastdate[7],
                    'ProcessedListing.order_date >= ' => $firstdate[7],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates7 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions7,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates7','Catsaveall7'));
					}
					if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
                  
					$cond8 = array('ProcessedListing.order_date <= ' => $lastdate[8],
                    'ProcessedListing.order_date >= ' => $firstdate[8],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall8 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond8,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions8 = array('ProcessedListing.order_date <= ' => $lastdate[8],
                    'ProcessedListing.order_date >= ' => $firstdate[8],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates8 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions8,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates8','Catsaveall8'));
					}
					if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12'))){ 
				           
					$cond9 = array('ProcessedListing.order_date <= ' => $lastdate[9],
                    'ProcessedListing.order_date >= ' => $firstdate[9],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall9 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond9,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions9 = array('ProcessedListing.order_date <= ' => $lastdate[9],
                    'ProcessedListing.order_date >= ' => $firstdate[9],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates9 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions9,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates9','Catsaveall9'));
					}
					if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12'))){ 
                  
					$cond10 = array('ProcessedListing.order_date <= ' => $lastdate[10],
                    'ProcessedListing.order_date >= ' => $firstdate[10],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall10 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond10,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions10 = array('ProcessedListing.order_date <= ' => $lastdate[10],
                    'ProcessedListing.order_date >= ' => $firstdate[10],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates10 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions10,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates10','Catsaveall10'));
					}
					if((!empty($month_interval)) && ($month_interval=='12')){ 
                  
					$cond3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond3,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));
					                     
                    $conditions3 = array('ProcessedListing.order_date <= ' => $lastdate[3],
                    'ProcessedListing.order_date >= ' => $firstdate[3],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates3 =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions3,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
   
                    $this->set(compact('countselectdates3','Catsaveall3'));
					}
										                   
                    $cond = array('ProcessedListing.order_date <= ' => $lastdate[0],
                    'ProcessedListing.order_date >= ' => $firstdate[0],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $Catsaveall =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $group,'conditions' => $cond,'order' =>array('ProcessedListing.cat_name  ASC','ProcessedListing.currency DESC')));

					                     
                    $condited = array('ProcessedListing.order_date <= ' => $lastdate[0],
                    'ProcessedListing.order_date >= ' => $firstdate[0],'ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdated =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name','ProcessedListing.currency','ProcessedListing.plateform','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $condited,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.subsource ASC')));
					
					$conditions = array('ProcessedListing.cat_name !='=>'','ProcessedListing.price_per_product !='=>'0','ProcessedListing.currency !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.subsource !='=>'http://bhsindia.com','ProcessedListing.subsource !='=>'','ProcessedListing.subsource !='=>'http://dev.homescapesonline.com');
                   
					$this->paginate = array(
					'fields' => array('ProcessedListing.product_sku','ProcessedListing.product_name','ProcessedListing.plateform','ProcessedListing.cat_name','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','ProcessedListing.currency','sum(ProcessedListing.price_per_product) AS ordervalues'), 
					'limit' => 50,
					'group' => $groupby,
					'conditions' => $conditions,
					'order' => array('ProcessedListing.product_sku ASC','ProcessedListing.currency  DESC','ProcessedListing.subsource ASC','ProcessedListing.plateform ASC')
					); 
             
					$this->set('countselectdates', $this->paginate());   
                    $this->set(compact('categories','Catsaveall','countselectdated','month_interval'));  
                            

		  }
		  
		  public function notifications(){

                $this->set('title', 'E-mail Notification of Open Orders.');

				$Date = date("Y-m-d");
				$today = date('Y-m-d', strtotime($Date. ' - 3 days'));;
				$sameday = date("Y-m-d", strtotime($today .' - 3 days'));
				//echo $today;
				
					$groupby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource');

				$conditions1 = array('ProcessedListing.order_date' => $today);

				$conditions2 = array('ProcessedListing.order_date' => $sameday);

				$savetodays =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.plateform ASC')));
              // print_r( $savetodays);
			   //print_r("<br></br>");
				$savesamedays =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions2,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.plateform ASC')));
				//print_r($savesamedays);
				
				    
					/*Add E-mail sending code*/
					
					$this->Email->to = '';
					$this->Email->bcc = array('amit@homescapesonline.com');
					$this->Email->subject = 'Notification Alerts.';
					$this->Email->replyTo = 'amit@homescapesonline.com';
					$this->Email->from = 'Homescapesonline<test@Homescapesonline.com>';
					$this->Email->template = 'default'; 
					$this->Email->sendAs = 'html';					
					$this->set(compact('savetodays','savesamedays'));  
                 	$this->Email->send();       

            } 
			
			
			
		public function productsku_notifications($catgoryname){

                $this->set('title', 'List-High variation in Sales.');
				 
				$categories = $this->categname();
				
				if ((!empty($this->data)) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedListing']['productskuname'])))
				   {                      
				 $productskuname = $this->data['ProcessedListing']['productskuname'];         
					 }else{           
				   $catgoryname = urldecode($catgoryname);           
					 }  
			 
				
				$Date = date("Y-m-d");
				$today = date('Y-m-d', strtotime($Date. ' - 3 days'));;
				$sameday = date("Y-m-d", strtotime($today .' - 7 days'));
						//print_r($sameday);die();	
				
				 $productskuby = array(('ProcessedListing.plateform'),
					'AND'=> 'ProcessedListing.subsource','ProcessedListing.product_sku','ProcessedListing.cat_name');
      
	  
	      
 
       if(!empty($catgoryname)){ 
		$productsku1 = array('ProcessedListing.order_date' => $today,'ProcessedListing.cat_name'=> $catgoryname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
		$productsku2 = array('ProcessedListing.order_date' => $sameday,'ProcessedListing.cat_name'=> $catgoryname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
          
		   } else if(!empty($productskuname)){ 
       $productsku1 = array('ProcessedListing.order_date' => $today,'ProcessedListing.product_sku'=> $productskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
       $productsku2 = array('ProcessedListing.order_date' => $sameday,'ProcessedListing.product_sku'=> $productskuname,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'', 'ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        } else {
		$productsku1 = array('ProcessedListing.order_date' => $today,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        $productsku2 = array('ProcessedListing.order_date' => $sameday,'ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.subsource  !='=>'http://dev.homescapesonline.com','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
        }
          
	
  			
			
				//$saveproductskutodays =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name', 'ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $productskuby,'conditions' => $productsku1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.product_sku ASC','ProcessedListing.plateform ASC')));
             
				$saveproductskutodays =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.product_sku','ProcessedListing.cat_name','ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $productskuby,'conditions' => $productsku1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.product_sku ASC','ProcessedListing.plateform ASC')));
			
				 $this->paginate = array(
					'fields' => array('ProcessedListing.product_name','ProcessedListing.cat_name','ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 
					'limit' => 1000,
					'group' => $productskuby,
					'conditions' => $productsku2,
					'order' => array('ProcessedListing.currency  DESC','ProcessedListing.product_sku ASC','ProcessedListing.plateform ASC')
					);
				 $this->set('saveproductskusamedays', $this->paginate());     
				   
					
					/* Add E-mail sending code */					
					$this->Email->to = '';
					$this->Email->bcc = array('amit@homescapesonline.com');
					$this->Email->subject = 'Notification product skus Alerts.';
					$this->Email->replyTo = 'amit@homescapesonline.com';
					$this->Email->from = 'Homescapesonline.com<test@Homescapesonline.com>';
					$this->Email->template = 'defaultsku'; 
					$this->Email->sendAs = 'html';						
					$this->set(compact('sameday','today','categories','saveproductskutodays','saveproductskusamedays'));  
					$this->Email->send();

			$exports = $this->params['url']['exports'];
				
					
			if (!empty($_POST['exports'])) {
            App::import("Vendor", "parsecsv");
            $csv = new parseCSV();
            $filepath = "C:\Users\Administrator\Downloads" . "saveproductskusamedays.csv";
            $csv->auto($filepath); 
			$saveproductskutodays =  $this->ProcessedListing->find('all', array('fields' => array('ProcessedListing.cat_name', 'ProcessedListing.product_sku','ProcessedListing.plateform','ProcessedListing.currency','ProcessedListing.subsource','count(ProcessedListing.order_id) as orderid','sum(ProcessedListing.price_per_product) AS ordervalues'), 'group' => $productskuby,'conditions' => $productsku1,'order' =>array('ProcessedListing.currency  DESC','ProcessedListing.product_sku ASC','ProcessedListing.plateform ASC')));
             
			 $this->set('saveproductskutodays');            
            $this->layout = null;
            $this->autoLayout = false;
            Configure::write('debug', '2');
            } 

				
		}
    
}

/* 
SELECT * FROM `processed_orders` WHERE `order_date` >= '2016-02-15' AND `order_date` <= '2016-02-21'
 */