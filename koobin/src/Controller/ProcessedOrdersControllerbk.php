<?php
namespace App\Controller;

use App\Controller\AppController;

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
  // $this->ProcessedOrder->create();
	
	if(($order->GeneralInfo->Source === 'MAGENTO') && ($order->GeneralInfo->SubSource === 'https://www.smartparcelbox.com')){
	
	$smart_orderid = "SPB100000999".$order->GeneralInfo->ExternalReferenceNum;
	
   // $this->ProcessedOrder->saveAll(array('order_id' => $smart_orderid, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue));
	}else{
   
  // $this->ProcessedOrder->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue));
	}   
     

}

 }
        $this->set(compact('orders','pagination'));
            
    }
	  

    /**
     * View method
     *
     * @param string|null $id Processed Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $processedOrder = $this->ProcessedOrders->get($id, [
            'contain' => ['Orders']
        ]);

        $this->set('processedOrder', $processedOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $processedOrder = $this->ProcessedOrders->newEntity();
        if ($this->request->is('post')) {
            $processedOrder = $this->ProcessedOrders->patchEntity($processedOrder, $this->request->getData());
            if ($this->ProcessedOrders->save($processedOrder)) {
                $this->Flash->success(__('The processed order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The processed order could not be saved. Please, try again.'));
        }
        $orders = $this->ProcessedOrders->Orders->find('list', ['limit' => 200]);
        $this->set(compact('processedOrder', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Processed Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $processedOrder = $this->ProcessedOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $processedOrder = $this->ProcessedOrders->patchEntity($processedOrder, $this->request->getData());
            if ($this->ProcessedOrders->save($processedOrder)) {
                $this->Flash->success(__('The processed order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The processed order could not be saved. Please, try again.'));
        }
        $orders = $this->ProcessedOrders->Orders->find('list', ['limit' => 200]);
        $this->set(compact('processedOrder', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Processed Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $processedOrder = $this->ProcessedOrders->get($id);
        if ($this->ProcessedOrders->delete($processedOrder)) {
            $this->Flash->success(__('The processed order has been deleted.'));
        } else {
            $this->Flash->error(__('The processed order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
