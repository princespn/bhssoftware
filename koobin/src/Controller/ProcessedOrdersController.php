<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\SUM;

/**
 * ProcessedOrders Controller
 *
 * @property \App\Model\Table\ProcessedOrdersTable $ProcessedOrders
 *
 * @method \App\Model\Entity\ProcessedOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProcessedOrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	
	public function getallprocess($pagenum){

        //This function return only order id identifiers -pkOrderID

        $this->set('title', 'Linnworks Process Orders get for pkOrderID.');
        $userkey = $this->token_value();
        $some_data = array('token' => $userkey);

    
		//$from = '2018-05-03T00:00:00'; //min
		$from = '';   // 2017-04-03 - TO - 2017-04-09
		//$to =  '2018-05-16:60:60'; //max
		$to = '';
        
        //$to = '';
        $datetype = '1';
        $sfield  = '';
        $sterm  = '';
        $limit = '50';
		
        //$pagenum = isset($_GET['page']);
		//$pagenum =  '5'; //1482,74070
        // for process orders

        $header = array("POST:https://eu-ext.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu-ext.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged?from=' . $from . '&to=' . $to . '&dateType=' . $datetype . '&searchField=' . $sfield . '&exactMatch=true&searchTerm=' . $sterm . '&pageNum=' . $pagenum . '&numEntriesPerPage='.$limit;


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
       // print_r($porders); die();
          curl_close($ch);
       if(!empty($porders)){return $porders ;}else{throw new MissingWidgetHelperException('Processed orders not authorized to view this page.', 401);}

        $this->set(compact('porders'));

    }


    

    public function index(){

        $this->set('title', 'Linnworks Processed Orders.');
        $page = '3';



        $userkey = $this->token_value();
        $some_data = array('token' => $userkey);
        $process_orders = $this->getallprocess($page); //int_r($process_orders->Data);die();
        $pkid = array();
        foreach ($process_orders->Data  as $process_order) { // If you need the pointer (but I don't think) you have to add '$i => ' before $username
        $pkid[] = "'". $process_order->pkOrderID. "'";
        }
       $Processedkid = implode(",",$pkid);
       // for pagination

        $adjacents = 12088;
        $total = 604373;
        $targetpage = ""; //your file name
        $limit = 200; //how many items to show per page
        //$page = isset($_GET['page']);
        $counter = 0;

        if ($page) {
            $start = ($page - 1) * $limit; //first item to display on this page
        } else {
            $start = 0;
        }
        if ($page == 0){$page = 1; }//if no page var is given, default to 1.


        $prev = $page - 1; //previous page is current page - 1
        $next = $page + 1; //next page is current page + 1
        $lastpage = ceil($total / $limit); //lastpage.
        $lpm1 = $lastpage - 1; //last page minus 1

        /* CREATE THE PAGINATION */

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination pagination-sm margin-0'>";
            if ($page > $counter + 1) {
                $pagination.= "<li><a href=\"$targetpage?page=$prev\">prev</a> </li>";
            }

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li>	<a href='#' class='active'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                    $pagination.= "<li>...</li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    $pagination.= "<li>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                    $pagination.= "<li>...</li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                }
                //close to end; only hide early pages
                else {
                    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    $pagination.= "<li>...</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                }
            }

            //next button
            if ($page < $counter - 1)
                $pagination.= "<li><a href=\"$targetpage?page=$next\">next</a></li>";
            else
                $pagination.= "";
            $pagination.= "</ul>";
        }

        //end
       $header = array("POST:https://eu-ext.linnworks.net//api/Orders/GetOrdersById HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
       $url = "https://eu-ext.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=[".$Processedkid."]";
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
        ///print_r($result); die();
        curl_close($ch);
       
            if (!empty($orders)) {
                foreach ($orders as $order){
                   $sku = array();
                   $catname = array();
                   $pname = array();
                   $quanty = array();
                   $stock = array();
                   $priceunit = array();
for ($i = 0;$i<=count($order->Items); $i++) {
   /*$sku[$i] = $order->Items[$i]->SKU;
   $catname[$i] = $order->Items[$i]->CategoryName;
    $pname[$i] = $order->Items[$i]->Title;
   $quanty[$i] = $order->Items[$i]->Quantity;
   $stock[$i] = $order->Items[$i]->AvailableStock;
   $priceunit[$i] = $order->Items[$i]->CostIncTax;

    $skuname = implode("  ",$sku);
    $catname = implode("  ",$catname);
    $pname = implode("  ",$pname);
    $quanty = implode("  ",$quanty);
    $stock = implode("  ",$stock);
    $priceunit = implode("  ",$priceunit);*/
    $days = strtotime($order->GeneralInfo->ReceivedDate);

    $this_week_sd = date("Y-m-d",$days);
    
    if((isset($order->Items[$i]->Title))){
    
if((count($order->Items)) >= '1'){
	
	$ordertitle = $order->Items[$i]->Title."Name-".$i;}else {$ordertitle = $order->Items[$i]->Title;}
    }
     
     $this->loadModel('ProcessedListing');
      
  //  $this->ProcessedListing->create();
   
  //  $this->ProcessedListing->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum,'order_date' => $this_week_sd,  'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'product_sku' => $order->Items[$i]->SKU, 'cat_name' => $order->Items[$i]->CategoryName, 'product_name' => $ordertitle, 'quantity' =>  $order->Items[$i]->Quantity, 'price_per_product' => $order->Items[$i]->CostIncTax));
         
        
} 

    $days = strtotime($order->GeneralInfo->ReceivedDate);

    $this_week_sd = date("Y-m-d",$days);
	
	   //$ordervalue = (($order->TotalsInfo->TotalCharge)-($order->TotalsInfo->Tax));
   $ordervalue = $order->TotalsInfo->TotalCharge;
  // $this->ProcessedOrders->create();
	
	if(($order->GeneralInfo->Source === 'MAGENTO') && ($order->GeneralInfo->SubSource === 'https://www.smartparcelbox.com')){
	
	$smart_orderid = "SPB100000999".$order->GeneralInfo->ExternalReferenceNum;
	
   // $this->ProcessedOrders->saveAll(array('order_id' => $smart_orderid, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue));
	}else{
   
  // $this->ProcessedOrders->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue));
	}   
     

}

 }
        $this->set(compact('orders','pagination'));
            
    }
	  

    public function currentweeks(){

$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday midnight",$previous_week);
$end_week = strtotime("next sunday",$start_week);

$this_week_sd = date("Y-m-d",$start_week);
$this_week_ed = date("Y-m-d",$end_week);
 


 $conditions = array('ProcessedOrders.order_date <=' => $this_week_ed,
     'ProcessedOrders.order_date >=' => $this_week_sd,'ProcessedOrders.order_value  !='=>'0','ProcessedOrders.subsource  !='=>'http://dev.homescapesonline.com','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'');

	$groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');
	
        $dataweek1 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource',count(array('ProcessedOrders.order_id')),'ProcessedOrders.currency'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
        print_r($dataweek1);die();
       return $dataweek1;

    }
    
    

    public function prevweeks(){

       $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

    

$conditions = array('ProcessedOrders.order_date <=' => $end_week,
     'ProcessedOrders.order_date >=' => $start_week,'ProcessedOrders.order_value  !='=>'0','ProcessedOrders.subsource  !='=>'http://dev.homescapesonline.com','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'');

 $groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');

		$dataprevweeks =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.currency','ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
      //print_r($dataprevweeks);die();     
        return $dataprevweeks;

    }


    


    public function last_weekly() {   
        
$present_year_week = strtotime("-53 week +1 day");

$last_year_week = strtotime("last sunday midnight",$present_year_week);
$end_year_week = strtotime("next saturday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);


 $conditions = array('ProcessedOrders.order_date <= ' => $main_end_week,
      'ProcessedOrders.order_date >= ' => $main_last_week,'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
  
 
 $groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');

     $lastweeks =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
       //print_r($datalastweeks);die(); 
     return $lastweeks;
      

    }

    
    
    
    public function channelWeekly() {

        $this->set('title', 'Progress Report weekly Inventory Database.');        
        $currents = $this->currentweeks();
        $previousweeks = $this->prevweeks();
        $datalastweeks = $this->last_weekly();

     
        
 $conditions = array('ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
   
 $groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');


        $savealldataweeks =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
       //print_r($savealldataweeks);die();   
        $this->set(compact('savealldataweeks','datalastweeks','currents','previousweeks'));

    }
    
    
    /* Add monthly  */    
    
    
    public function currentmonths(){
        
        
 $this_week_sd = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
$this_week_ed = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
        
    





$conditions = array('ProcessedOrders.order_date <= ' => $this_week_ed,
      'ProcessedOrders.order_date >= ' => $this_week_sd,'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
  
	$groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');

        $dataweek1 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
        //print_r($dataweek1);die();
       return $dataweek1;

    }
    

    public function prevmonths(){
        
        
        $start_week = date("Y-m-d", mktime(0, 0, 0, date("m")-2, 1));
        $end_week =  date("Y-m-d", mktime(0, 0, 0, date("m")-1,0));
        
          


$conditions = array('ProcessedOrders.order_date <= ' => $end_week,
      'ProcessedOrders.order_date >= ' => $start_week,'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
  

$groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');

$dataprevweeks =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
      //print_r($dataprevweeks);die();     
        return $dataprevweeks;

    }
    
    
     public function last_monthly() {

              
        $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
        $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));
        
         
        

 $conditions = array('ProcessedOrders.order_date <= ' => $main_end_week,
      'ProcessedOrders.order_date >= ' => $main_last_week,'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
 
 $groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');


        $lastmonths =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
       //print_r($dataprevweeks);die();   
        return $lastmonths;

    }
    
    
        public function channel_monthly() {

        $this->set('title', 'Progress Report monthly Inventory Database.'); 
        
        $currentmonths = $this->currentmonths();
        $previousmonths = $this->prevmonths();
        $datalastmonths = $this->last_monthly();
        
        $main_last_week = date("Y-m-d", mktime(0, 0, 0, date("m")-13, 1));
        $main_end_week = date("Y-m-d", mktime(0, 0, 0, date("m")-12, 0));
        
 

        

 $conditions = array('ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
 
 $groupby = array(('ProcessedOrders.plateform'),
         'AND'=> 'ProcessedOrders.subsource');

        $savealldatas =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
       //print_r($dataprevweeks);die();   
        $this->set(compact('savealldatas','datalastmonths','currentmonths','previousmonths'));

    }
    

    /* Import CSV Processed Orders */

            public function importprocessed(){    


            $this->set('title', 'Processed Orders Import CSV in Database system.');

                if (!empty($this->data)) {
                $filename = $this->data['ProcessedOrder']['file']['name'];
                $fileExt = explode(".", $filename);
                $fileExt2 = end($fileExt);
                //print_r($this->data['MasterListing']['file']['tmp_name']); die();

                if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['ProcessedOrder']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['ProcessedOrder']['file']['name']))
                // $messages = $this->ProcessedOrders->importprocessed($filename);
                $messages = $this->ProcessedOrders->importprocessed($filename);
                $this->Session->setFlash(__('Processed Orders data Imports successfully.', true));

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



            public function counselection_periods(){
                 
           
                $conditions = array('ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                $groupby = array(('ProcessedOrders.plateform'),
                'AND'=> 'ProcessedOrders.subsource');

                $countselectdates =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.currency','ProcessedOrders.plateform','ProcessedOrders.subsource'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
               
              return $countselectdates;

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


              public function selection_periods(){

                $this->set('title', 'Number of Processed Orders in Selected Periods.');
               
                $saveplatformdatas = $this->counselection_periods();                 
                
                if ((!empty($this->data['ProcessedOrder']['date_from'])) && (!empty($_POST['submit'])) && (!empty($this->data['ProcessedOrder']['date_to']))) {
                 $first_date =  $this->data['ProcessedOrder']['date_from'];
                  $next_date =  $this->data['ProcessedOrder']['date_to']; 
                } else{      
                            
                $first_date = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
                $next_date = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));                      
                  }
               
                  
                  
                   $query_date = $this->get_months($first_date, $next_date);
				   
				  $month_interval = 1 + (date('Y',strtotime($next_date)) - date('Y',strtotime($first_date))) * 12   +   (date('m',strtotime($next_date)) - date('m',strtotime($first_date))); 
                  
				  //print_r($query_date);die();
				  $firstdate = array();  $lastdate = array();
              
                foreach($query_date as $firstandlast){
              
                $firstdate[] =  date('Y-m-01', strtotime($firstandlast));
                
                $lastdate[] =  date('Y-m-t', strtotime($firstandlast));           
                
                }
                
				
                           
                  $groupby = array(('ProcessedOrders.plateform'),'AND'=> 'ProcessedOrders.subsource');
				  
                  if((!empty($month_interval)) && (($month_interval=='2') || ($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
                    $conditions = array('ProcessedOrders.order_date <= ' => $lastdate[0],
                    'ProcessedOrders.order_date >= ' => $firstdate[0],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));

                    $conditions1 = array('ProcessedOrders.order_date <= ' => $lastdate[1],
                    'ProcessedOrders.order_date >= ' => $firstdate[1],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');

                    $countselectdates1 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions1,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));

                    $this->set(compact('query_date','saveplatformdatas','countselectdates','countselectdates1','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='3') || ($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$conditions2 = array('ProcessedOrders.order_date <= ' => $lastdate[2],
                    'ProcessedOrders.order_date >= ' => $firstdate[2],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates2 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions2,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countselectdates2','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='4') || ($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$conditions3 = array('ProcessedOrders.order_date <= ' => $lastdate[3],
                    'ProcessedOrders.order_date >= ' => $firstdate[3],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates3 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions3,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
					$this->set(compact('query_date','saveplatformdatas','countselectdates3','month_interval'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='5') || ($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                
					$conditions4 = array('ProcessedOrders.order_date <= ' => $lastdate[4],
                    'ProcessedOrders.order_date >= ' => $firstdate[4],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates4 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions4,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countselectdates4','month_interval'));
					}
				
				if((!empty($month_interval)) && (($month_interval=='6') || ($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
  					$conditions5 = array('ProcessedOrders.order_date <= ' => $lastdate[5],
                    'ProcessedOrders.order_date >= ' => $firstdate[5],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates5 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions5,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
					$this->set(compact('query_date','saveplatformdatas','countselectdates5','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='7') || ($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$conditions6 = array('ProcessedOrders.order_date <= ' => $lastdate[6],
                    'ProcessedOrders.order_date >= ' => $firstdate[6],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates6 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions6,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
					$this->set(compact('query_date','saveplatformdatas','countselectdates6','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='8') || ($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$conditions7 = array('ProcessedOrders.order_date <= ' => $lastdate[7],
                    'ProcessedOrders.order_date >= ' => $firstdate[7],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates7 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions7,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countselectdates7','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='9') || ($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$conditions8 = array('ProcessedOrders.order_date <= ' => $lastdate[8],
                    'ProcessedOrders.order_date >= ' => $firstdate[8],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates8 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions8,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countselectdates8','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='10') || ($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
				           
					$conditions9 = array('ProcessedOrders.order_date <= ' => $lastdate[9],
                    'ProcessedOrders.order_date >= ' => $firstdate[9],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates9 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions9,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
					$this->set(compact('query_date','saveplatformdatas','countselectdates9','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='11') || ($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$conditions10 = array('ProcessedOrders.order_date <= ' => $lastdate[10],
                    'ProcessedOrders.order_date >= ' => $firstdate[10],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates10 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions10,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countselectdates10','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='12') || ($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$conditions13 = array('ProcessedOrders.order_date <= ' => $lastdate[11],
                    'ProcessedOrders.order_date >= ' => $firstdate[11],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates13 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions13,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                	$this->set(compact('query_date','saveplatformdatas','countselectdates13','month_interval'));
					 }
					
					
					// Start condition After 12 Month 
					if((!empty($month_interval)) && (($month_interval=='13') || ($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
				         
					$condsecondyear1 = array('ProcessedOrders.order_date <= ' => $lastdate[12],
                    'ProcessedOrders.order_date >= ' => $firstdate[12],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear1 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear1,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
               		$this->set(compact('query_date','saveplatformdatas','countsecondyear1','month_interval'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='14') || ($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condsecondyear2 = array('ProcessedOrders.order_date <= ' => $lastdate[13],
                    'ProcessedOrders.order_date >= ' => $firstdate[13],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear2 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear2,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear2','month_interval'));
					
                    }					
					
					if((!empty($month_interval)) && (($month_interval=='15') || ($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
                  
					$condsecondyear3 = array('ProcessedOrders.order_date <= ' => $lastdate[14],
                    'ProcessedOrders.order_date >= ' => $firstdate[14],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear3 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear3,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear3','month_interval'));
					}
					if((!empty($month_interval)) && (($month_interval=='16') || ($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear4 = array('ProcessedOrders.order_date <= ' => $lastdate[15],
                    'ProcessedOrders.order_date >= ' => $firstdate[15],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear4 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear4,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                 	$this->set(compact('query_date','saveplatformdatas','countsecondyear4','month_interval'));
					               
                    }
					
					if((!empty($month_interval)) && (($month_interval=='17') || ($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear5 = array('ProcessedOrders.order_date <= ' => $lastdate[16],
                    'ProcessedOrders.order_date >= ' => $firstdate[16],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear5 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear5,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
               		$this->set(compact('query_date','saveplatformdatas','countsecondyear5','month_interval'));
					}
					
					if((!empty($month_interval)) && (($month_interval=='18') || ($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear6 = array('ProcessedOrders.order_date <= ' => $lastdate[17],
                    'ProcessedOrders.order_date >= ' => $firstdate[17],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear6 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear6,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear6','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='19') || ($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear7 = array('ProcessedOrders.order_date <= ' => $lastdate[18],
                    'ProcessedOrders.order_date >= ' => $firstdate[18],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear7 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear7,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                   $this->set(compact('query_date','saveplatformdatas','countsecondyear7','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='20') || ($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear8 = array('ProcessedOrders.order_date <= ' => $lastdate[19],
                    'ProcessedOrders.order_date >= ' => $firstdate[19],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear8 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear8,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                   $this->set(compact('query_date','saveplatformdatas','countsecondyear8','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='21') || ($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear9 = array('ProcessedOrders.order_date <= ' => $lastdate[20],
                    'ProcessedOrders.order_date >= ' => $firstdate[20],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear9 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear9,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear9','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='22') || ($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear10 = array('ProcessedOrders.order_date <= ' => $lastdate[21],
                    'ProcessedOrders.order_date >= ' => $firstdate[21],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear10 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear10,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear10','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='23') || ($month_interval=='24'))){ 
					
					$condsecondyear11= array('ProcessedOrders.order_date <= ' => $lastdate[22],
                    'ProcessedOrders.order_date >= ' => $firstdate[22],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear11 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear11,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear11','month_interval'));
					  
                    
                    }
					if((!empty($month_interval)) && (($month_interval=='24'))){ 
					
					$condsecondyear12 = array('ProcessedOrders.order_date <= ' => $lastdate[23],
                    'ProcessedOrders.order_date >= ' => $firstdate[23],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countsecondyear12 =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $condsecondyear12,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
                    $this->set(compact('query_date','saveplatformdatas','countsecondyear12','month_interval'));
					  
                    
                    }					
					
					//End condition After 12 Month
					
					else{ 					
					
                    $conditions = array('ProcessedOrders.order_date <= ' => $lastdate[0],
                    'ProcessedOrders.order_date >= ' => $firstdate[0],'ProcessedOrders.order_value !='=>'0','ProcessedOrders.currency !='=>'','ProcessedOrders.plateform !='=>'','ProcessedOrders.subsource !='=>'http://bhsindia.com','ProcessedOrders.subsource !='=>'','ProcessedOrders.subsource !='=>'http://dev.homescapesonline.com');
                    $countselectdates =  $this->ProcessedOrders->find('all', array('fields' => array('ProcessedOrders.plateform','ProcessedOrders.subsource','count(ProcessedOrders.order_id) as orderid','ProcessedOrders.currency','sum(ProcessedOrders.order_value) AS ordervalues'), 'group' => $groupby,'conditions' => $conditions,'order' =>array('ProcessedOrders.currency  DESC','ProcessedOrders.subsource ASC')));
   
                    $this->set(compact('query_date','saveplatformdatas','countselectdates','month_interval'));  
                    }                

            } 
	
 
             
/* SELECT * FROM `processed_listings` WHERE `order_date` >= '2017-07-10' AND `order_date` <= '2017-07-16' AND `subsource`='http://www.smartparcelbox.com'
 * 
 * SELECT sum(order_value) AS ordervalues FROM `processed_orders` WHERE `order_date` >= '2017-04-01' AND `order_date` <= '2017-04-30' GROUP BY `subsource` ='http://www.smartparcelbox.com';
 * 
 * SELECT SUM( order_value ) AS ordervalues
FROM  `processed_orders` 
WHERE  `order_date` >=  '2017-04-01'
AND  `order_date` <=  '2017-04-30'
GROUP BY  `subsource` =  'http://www.homescapesonline.com'
AND  `plateform` =  'MAGENTO'
AND  `currency` =  'GBP'
LIMIT 0 , 30
 */

}
