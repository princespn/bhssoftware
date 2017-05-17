<?php
class ProcessedListingsController extends AppController {

	var $name = 'ProcessedListings';
        var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
        var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();   
      
        $this->Auth->allow(array('index', 'tokenkey','category_weekly','productsku_monthly','category_monthly','productsku_weekly','categname','importcategory','category_prevmonths','category_currentmonths','category_currentweeks','category_prevweeks'));
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
       $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.plateform !='=>'','ProcessedListing.cat_name !='=>'','ProcessedListing.product_sku !='=>'');
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
                    $conditions = array('ProcessedListing.price_per_product  !='=>'0','ProcessedListing.cat_name !='=>'','ProcessedListing.plateform !='=>'','ProcessedListing.product_sku !='=>'');
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
     
    
}

/* SELECT * FROM `processed_orders` WHERE `order_date` >= '2016-02-15' AND `order_date` <= '2016-02-21'
 */