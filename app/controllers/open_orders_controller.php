<?php
class OpenOrdersController extends AppController {

    var $name = 'OpenOrders';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'tokenkey','getallopenorders'));
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
	
	

        
    
    
    public function getallopenorders($pagenum){

        //This function return only order id identifiers -pkOrderID

        $this->set('title', 'Linnworks all open Orders.');
        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
       
      
         $fillCenter  = '00000000-0000-0000-0000-000000000000';

        $header = array("POST:https://eu1.linnworks.net//api/Orders/GetAllOpenOrders HTTP/1.1", "Host: eu1.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
        $url = 'https://eu1.linnworks.net//api/Orders/GetAllOpenOrders?fulfilmentCenter='.$fillCenter;


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
		print_r($porders); die();
		curl_close($ch);
       if(!empty($porders)){return $porders ;}else{throw new MissingWidgetHelperException('Open orders not authorized to view this page.', 401);}

       // $this->set(compact('porders'));

	   }
    
    
     public function index(){

        $this->set('title', 'Linnworks All Open Orders.');
        //$page = $this->params['url']['page'];



        $userkey = $this->tokenkey();
        $some_data = array('token' => $userkey);
        
        $orders = $this->getallopenorders();      
        $pkid = array();
        
        foreach ($orders  as $order) { 
       // $pkid[] =  $order;
        $pkid[] = "'". $order . "'";
        }
       
      $Processedkid = implode(",",$pkid);
       
      // print_r($Processedkid);die();
	  
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
       //$url = "https://eu1.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=['225a0699-43f6-433d-8887-f6b9139a2cab','198d064c-5114-4b5b-a7f4-3eddbec9b161','bf0dd43e-8bcd-4924-b6d9-fd4322cd623c','d12f61a1-dd0d-4381-a0be-a50dada7dd9f','6de99d6b-3dab-462a-9a19-775331309321','9a09c19c-4d89-4f58-b1e0-8fcae02c57b4','31b14943-6a9d-4b6e-a415-d8ec4d43ff6c','919fbc05-94d0-477b-9e97-cfcad6bcf53c','beda136a-fe91-4678-86f7-1e79d4979107','e15aa737-3a23-4e01-a2ba-3fc7f2fa1e2a','8de20c07-532a-4390-9106-aaaf461afa82','a614e149-d6cf-4a3d-9370-9b55942f25bd','1fc34ac0-5a51-474b-851d-f74ae3b71d14','eb4c4f2a-85cf-44ef-8e73-bbe7e9b15744','90d3988d-f3cc-41ab-9df3-708beab82284','fa9ae872-707d-4ed2-938e-a6fbfb8896cb','538a7744-8d44-4632-8a20-7204a556fd76','e7329e94-0b8a-47ae-bdd7-70ff81590521','ef792e74-f658-4162-9379-08f92043a018','af03e7f4-1c53-42a9-9ca6-62ede7359e1a','6b226a5b-071d-4435-8e36-1e214adb6a7c','61a6bec2-8d7f-4b01-9c2d-838045506d2b','babeb985-102e-4ab0-a5ff-2ae84ff34074','2f7e4a90-8f1f-40c3-a13a-d9c2e5f58cb1','ed34942a-525a-4694-9bfc-3037e63387d7','197c72ef-1883-447e-828e-aeeffe1c042b','e970c88e-4bc1-43ea-a4a7-a2fe1ba72048','341ce44c-ea07-4292-b7c7-56bbaea33ae1','6409b60b-f60a-4a3f-b8ff-762f2eb97de5','f6181a69-addc-4b80-abc4-ef67e8ee4f53','b5e6341d-645b-4c49-bffd-a898c39851db','95fc9d9e-b031-4191-b17d-b44575c7c15e','72475a4b-10a2-45db-b685-07d430e4ed6e','12955696-ba6b-41dc-9935-d64de503e680','5fcdc648-fcc2-4b3f-867b-f34f053579c5','4a350fc1-2460-4271-84f1-a3d49968a159','434f9bd9-fc02-4f8d-907c-a97b284c5192','dd4be9f1-c945-4fd5-8c73-ffcd0422f022','eb0153b6-1486-4fdb-8e24-38b4644e61af','70f7033c-ba5e-49a9-8228-9332d5ed5af6','539f3ea1-80d9-4d72-b7c6-d94726f22450','10e124fd-e657-4471-84b4-ccbeed01538c','2c6999ea-97d4-48af-b5b8-d343e033df53','1b294723-19af-4646-8b65-ae20d3e1a89a','401610fb-bfbb-4f61-8b90-ee6187d83cb6','53da1d6d-09c7-4a91-8cf0-3ebea840960d','899009ee-25ed-499a-b0dd-9bcf3e85bdd7','cd4394b6-7ec9-4431-b84c-ccf3ba0eee1d','f0a4ec90-81c2-4937-a2e0-a3e1b7067711','70b8e5a2-f448-45e3-83f9-98d9319fbcaf','1c7b66fd-bd21-4b41-ba8f-a9a4639a8efe']";
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
       print_r($orders); die();
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
		
								$days = strtotime($order->GeneralInfo->ReceivedDate);

								$this_week_sd = date("Y-m-d",$days);
								
							/* if((count($order->Items)) > '1'){$ordertitle = $order->Items[$i]->Title."Name-".$i;}else {$ordertitle = $order->Items[$i]->Title;}
								 
								 $this->loadModel('ProcessedListing');
								  
								$this->ProcessedListing->create();
							   
								$this->ProcessedListing->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum,'order_date' => $this_week_sd,  'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'product_sku' => $order->Items[$i]->SKU, 'cat_name' => $order->Items[$i]->CategoryName, 'product_name' => $ordertitle, 'quantity' =>  $order->Items[$i]->Quantity, 'price_per_product' => $order->Items[$i]->CostIncTax));
									 
									
							} */

								$days = strtotime($order->GeneralInfo->ReceivedDate);

								$this_week_sd = date("Y-m-d",$days);
								
							   $ordervalue = (($order->TotalsInfo->TotalCharge)-($order->TotalsInfo->Tax));
								
							   $this->OpenOrder->create();
							   
							   $this->OpenOrder->saveAll(array('order_id' => $order->GeneralInfo->ExternalReferenceNum, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue));
										 
								 

							}

						}
        $this->set(compact('orders','pagination'));
            
    }

    
}
}

