<?php
class EnglishListingsController extends AppController {

    var $name = 'EnglishListings';
    var $components = array('Acl', 'Auth', 'Session','RequestHandler');
    var $helpers = array('Session','Html', 'Form','Ajax','Javascript','Js','Csv');

        function beforeFilter()
        {
                parent::beforeFilter();
                $this->Auth->allow(array('login','logout','index','edit','import','update','categoriesPro','category','saleprice'));
        }



    function index () {
			$this->set('title', 'Amazon UK Listing information.');
		
            if((!empty($this->data)) &&(!empty($_POST['submit']))){

                    $string = explode(",",trim($this->data['EnglishListing']['all_item']));
                    $prsku = 	$string[0];
                    if(!empty($string[1])){$prname = $string[1];}
                        if((!empty($prsku)) && (!empty($prname))){

                            $conditions = array('EnglishListing.product_code LIKE' => '%'.$prname.'%','EnglishListing.item_sku LIKE' => '%'.$prsku.'%');
                            $this->paginate = array('limit' => 200,'order'=>'EnglishListing.id  ASC','conditions' => $conditions);
                        }
                        if((!empty($prsku))){

                            $conditions = array(
                            'OR'=> array('EnglishListing.product_code LIKE' => "%$prsku%",'EnglishListing.item_sku LIKE' => "%$prsku%"));
                            $this->paginate = array('limit' => 200,'order'=>'EnglishListing.id  ASC','conditions' => $conditions);
                        }

                    $this->set('english_listings', $this->paginate());

            }
            else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
                    $checkboxid = $_POST['checkid'];
                    App::import("Vendor","parsecsv");
                    $csv = new parseCSV();
                    $filepath = "C:\Users\Administrator\Downloads"."english_listings.csv";	
                    $csv->auto($filepath);			
                    $this->set('english_listings',$this->EnglishListing->find('all',array('EnglishListing.id ASC','conditions'=>array('EnglishListing.id' => $checkboxid))));
                    $this->layout = null;
                    $this->autoLayout = false;
                    Configure::write('debug', '2');
            }
            else
            {
                    $this->EnglishListing->recursive = 1;
                    $this->paginate = array('limit' => 200,'order'=>'EnglishListing.id  ASC');
                    $this->set('english_listings', $this->paginate());
            }
    }

        function categoriesPro() {
                $this->loadModel('InventoryMaster');
                $procategory = $this->InventoryMaster->find('list', array('fields' =>'category','group'=>'category','recursive' => 0));
                return $procategory;
        }
		
		public function saleprice() {			
					$url ='freeopd.com/homescapes/downloadCSV.php?regularprice';
					$ch = curl_init();
					$timeout = 15;
					curl_setopt($ch,CURLOPT_URL,$url);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
					$data = curl_exec($ch);
					curl_close($ch);
					return $data;	
			 
		 }
        
		function category($id) {
			
			$this->set('title', 'Amazon UK Listing information.');
		
                    if((!empty($id)))    {
                    $this->loadModel('InventoryMaster');
                    $procategory = $this->InventoryMaster->find('list',array('fields'=>'item_sku','conditions' => array('InventoryMaster.category LIKE' => "%$id%")));

                    $conditions = array('EnglishListing.item_sku'=>$procategory);
                    $this->paginate = array('limit' => 200,'order'=>'EnglishListing.id  ASC','conditions' => $conditions);
					$this->set('foo',$id);
                }
                    $this->EnglishListing->recursive = 1;
                    $this->set('english_listings', $this->paginate());

        }


        function import() {
			$this->set('title', 'Import Amazon UK Listing information.');
		
             if (!empty($this->data))
                  {
                        $filename = $this->data['EnglishListing']['file']['name'];
                        $fileExt = explode(".", $filename);
                        $fileExt2 = end($fileExt);
                        if($fileExt2 == 'csv') {
                        if(move_uploaded_file($this->data['EnglishListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['EnglishListing']['file']['name'])) 
                        $messages = $this->EnglishListing->import($filename);
                        $this->Session->setFlash(__('The Amazon UK Listing was Imports successfully.', true));

                    if (!empty($messages)){
                        $this->set('anything', $messages);
                        Configure::write('debug', '2');
                    }

                    }
                    else 
                     {

                    $this->Session->setFlash(__('The Amazon UK Listing File format not supported.</br>Please upload .CSV file format only.', true));
                    }

                }			
                else 
                {
                //$filename = 'Amazon_UK_Inventory-old.csv';
                //$messages = $this->EnglishListing->import($filename);
                }


            }


        function update() {
			
			$this->set('title', 'Update Amazon UK Listing information.');
		
                if (!empty($this->data))
                {
                    $filename = $this->data['EnglishListing']['file']['name'];
                    $fileExt = explode(".", $filename);
                    $fileExt2 = end($fileExt);
                    if($fileExt2 == 'csv') {
                        if(move_uploaded_file($this->data['EnglishListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['EnglishListing']['file']['name'])) 
                        $messages = $this->EnglishListing->update($filename);
                        $this->Session->setFlash(__('The Amazon UK Listing was Update successfully.', true));

                        if (!empty($messages)){
                        $this->set('anything', $messages);
                        Configure::write('debug', '2');
                        }

                    }
                    else
                    {

                    $this->Session->setFlash(__('The Amazon UK Listing File format not supported.</br>Please upload .CSV file format only.', true));
                    }

                }			
                else 
                {
                //$filename = 'Amazon_UK_Inventory-old.csv';
                //$messages = $this->EnglishListing->import($filename);
                }


        }




            function view($id = null) {
            if (!$id) {
            $this->Session->setFlash(__('Invalid The Amazon UK Listing Id.', true));
            $this->redirect(array('action' => 'index'));
            }
            $this->set('english_listings', $this->EnglishListing->read(null, $id));
            }



            function add($id = null) {
            if (!empty($this->data)) {


            if ($this->EnglishListing->save($this->data['EnglishListing'])) {
            $this->Session->setFlash(__('The Amazon UK Listing was created successfully.', true));
            $this->redirect(array('action' => 'index'));
            } 
            else {
            $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));

            }
            }

            $users = $this->EnglishListing->User->find('list');
            $this->set(compact('users'));
            }

			public function edit($item_sku = null) {
			$this->set('title', 'Edit UK Amazon Listing.');
				 if (empty(item_sku)) {
			 $this->Session->setFlash(__('Invalid Amazon UK Listing Product sku.', true));
             $this->redirect(array('controller'=>'english_listings','action' => 'index'));
            	}else{
			$itemid = $this->EnglishListing->findAllByItemSku($item_sku);
			$id = $itemid[0]['EnglishListing']['id'];
				}

            if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Invalid Amazon UK Listing Product sku.', true));
                    $this->redirect(array('controller'=>'english_listings','action' => 'index'));
            }
            if (!empty($this->data)) {


                if ($this->EnglishListing->save($this->data['EnglishListing'])) {
                $this->Session->setFlash(__('The Amazon UK Listing was saved successfully', true));
                $this->redirect(array('controller'=>'english_listings','action' => 'index'));
                } 
                else 
                {
                $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));

                }
            }
                if (empty($this->data)) {
                $this->data = $this->EnglishListing->read(null, $id);
                }
            $users = $this->EnglishListing->User->find('list');
            $this->set(compact('users'));
       }			


            function delete($id = null) {
                    if (!$id) {
                    $this->Session->setFlash(__('Invalid Amazon UK Listing ID in database.', true));
                    $this->redirect(array('controller'=>'english_listings','action'=>'index'));
                    }
                    else
                    {

                            if($this->EnglishListing->delete($id))
                            {

                            $this->Session->setFlash(__('The Amazon UK Listing was deleted successfully.', true));
                            $this->redirect(array('controller'=>'english_listings','action'=>'index'));
                            }

                    }
            $this->Session->setFlash(__('ERROR!! The Amazon UK Listing could not be deleted!', true));
            $this->redirect(array('controller'=>'english_listings','action' => 'index'));
            }




}