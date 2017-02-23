<?php
class ProcessedOrdersController extends AppController {
    var $name = 'ProcessedOrders';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'tokenkey','getallprocess','runurl','categname','prevweeks','currentweeks'));
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


    public function getallprocess ($pagenum){

        //This function return only order id identifiers -pkOrderID

        $this->set('title', 'Linnworks Process Orders get for pkOrderID.');
        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);

        //$from = '2017-12-30T00:01:03';
       $from = '';
       // $to =  '2017-02-01T60:60:60';
         $to = '';
        $datetype = '1';
        $sfield  = '';
        $sterm  = '';
        $limit = '50';
        //$pagenum = isset($_GET['page']);
       //$pagenum =  '5'; //1482,74070
        // for process orders

        $header = array("POST:https://eu1.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged?from=' . $from . '&to=' . $to . '&dateType=' . $datetype . '&searchField=' . $sfield . '&exactMatch=true&searchTerm=' . $sterm . '&pageNum=' . $pagenum . '&numEntriesPerPage='.$limit;


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
        $page = $this->params['url']['page'];



        $userkey = $this->tokenkey();
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
       $header = array("POST:https://eu1.linnworks.net//api/Orders/GetOrdersById HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
       //$url = "https://eu1.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=['a37893d2-d7cd-4355-85a2-15d2a6b37b6b','468fd6ab-2702-4887-86ba-15d2c3313d37','b75db8cd-7402-4296-a6fe-15d2c682e4de','e2d35a52-4ba8-400f-a142-15cf39e7121b','271aad0b-cf8f-4cac-9218-15cf4ae15134','105e7d07-df43-4884-bdf1-15ce5910ce32','6fe4e55d-18a5-4157-9682-15d08056d052','d99cdd07-305e-4623-aeac-15d09ef2d96d']";
       $url = "https://eu1.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=[".$Processedkid."]";
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
      // print_r($result); die();
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
    $sku[$i] = $order->Items[$i]->SKU;
    $catname[$i] = $order->Items[$i]->CategoryName;
    $pname[$i] = $order->Items[$i]->Title;
    $quanty[$i] = $order->Items[$i]->Quantity;
    $stock[$i] = $order->Items[$i]->AvailableStock;
    $priceunit[$i] = $order->Items[$i]->CostIncTax;
}
    $skuname = implode("  ",$sku);
    $catname = implode("  ",$catname);
    $pname = implode("  ",$pname);
    $quanty = implode("  ",$quanty);
    $stock = implode("  ",$stock);
    $priceunit = implode("  ",$priceunit);

                    $days = strtotime($order->GeneralInfo->ReceivedDate);

        $this_week_sd = date("Y-m-d",$days);
        $this->ProcessedOrder->create();
        $this->ProcessedOrder->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'product_sku' => $skuname,'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'category' => $catname, 'product_name' => $pname, 'quantity' => $quanty, 'stocks' => $stock, 'price_per_unit' => $priceunit, 'order_date' => $this_week_sd,'order_value' => $order->TotalsInfo->TotalCharge));
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
 
//echo "Current week range from $this_week_sd to $this_week_ed ";



    $conditions = array('ProcessedOrder.order_date' =>array('Between',$this_week_sd,$this_week_ed),'ProcessedOrder.subsource  !='=>'','ProcessedOrder.order_value  !='=>'0');
      

        //$conditions = array('ProcessedOrder.order_date' =>array('Between',$this_week_sd,$this_week_ed));
        $dataweek1 =  $this->ProcessedOrder->find('all', array('fields' => array('ProcessedOrder.subsource','count(ProcessedOrder.order_id) as orderid','ProcessedOrder.currency','sum(ProcessedOrder.order_value) AS ordervalues'), 'group' => 'subsource','conditions' => $conditions,'order' =>array('ProcessedOrder.currency  DESC','ProcessedOrder.subsource')));
        // print_r($dataweek1);die();
       return $dataweek1;

    }

    public function prevweeks(){

       $present_week = strtotime("-2 week +1 day");

        $second_week = strtotime("last monday midnight",$present_week);
        $send_week = strtotime("next sunday",$second_week);

        $start_week = date("Y-m-d",$second_week);
        $end_week = date("Y-m-d",$send_week);

       // echo $start_week.' '.$end_week ;




$conditions = array('ProcessedOrder.order_date' =>array('Between',$start_week,$end_week),'ProcessedOrder.subsource  !='=>'','ProcessedOrder.order_value  !='=>'0');
       
        //$conditions = array('ProcessedOrder.order_date' =>array('Between',$start_week,$end_week));
        $dataprevweeks =  $this->ProcessedOrder->find('all', array('fields' => array('ProcessedOrder.subsource','count(ProcessedOrder.order_id) as orderid','ProcessedOrder.currency','sum(ProcessedOrder.order_value) AS ordervalues'), 'group' => 'subsource','conditions' => $conditions,'order' =>array('ProcessedOrder.currency  DESC','ProcessedOrder.subsource')));
      // print_r($dataprevweeks);die();     
        return $dataprevweeks;

    }




    public function runurl() {

        $this->set('title', 'Progress Report weekly Inventory Database.');        
        $currents = $this->currentweeks();
        $previousweeks = $this->prevweeks();

                   $this->set('title', 'Progress Repots weekly Inventory Database.');        
        $currents = $this->currentweeks();
        $previousweeks = $this->prevweeks();
        
 $present_year_week = strtotime("-53 week +1 day");
$last_year_week = strtotime("last monday midnight",$present_year_week);
$end_year_week = strtotime("next sunday",$last_year_week);

$main_last_week = date("Y-m-d",$last_year_week);
$main_end_week = date("Y-m-d",$end_year_week);


        $conditions = array('ProcessedOrder.order_date' =>array('Between',$main_last_week,$main_end_week),'ProcessedOrder.subsource  !='=>'','ProcessedOrder.order_value  !='=>'0');
        $datalastweeks =  $this->ProcessedOrder->find('all', array('fields' => array('ProcessedOrder.subsource','count(ProcessedOrder.order_id) as orderid','ProcessedOrder.currency','sum(ProcessedOrder.order_value) AS ordervalues'), 'group' => 'subsource','conditions' => $conditions,'order' =>array('ProcessedOrder.currency  DESC','ProcessedOrder.subsource')));
       //print_r($dataprevweeks);die();   
        $this->set(compact('datalastweeks','currents','previousweeks'));

    }

}

