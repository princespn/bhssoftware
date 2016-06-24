<?php
class EbayenglishListingsController extends AppController {

var $name = 'EbayenglishListings';
var $components = array('Acl', 'Auth', 'Session','RequestHandler');
var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');

        function beforeFilter()
        {
            parent::beforeFilter();
            $this->Auth->allow(array('login','logout','index','edit','delete','import','categoriesPro','category'));
         }


        function index () {

                if((!empty($this->data)) &&(!empty($_POST['submit']))){

                        $string = explode(",",trim($this->data['EbayenglishListing']['all_item']));
                        $prsku = 	$string[0];
                        if(!empty($string[1])){$prname = $string[1];}
                        if((!empty($prsku)) && (!empty($prname))){
                            $conditions = array('EbayenglishListing.product_code LIKE' => '%'.$prname.'%','EbayenglishListing.item_sku LIKE' => '%'.$prsku.'%');
                            $this->paginate = array('limit' => 200,'order'=>'EbayenglishListing.id ASC','conditions' => $conditions);
                        }
                        if((!empty($prsku))){
                            $conditions = array(
                            'OR'=> array('EbayenglishListing.product_code LIKE' => "%$prsku%",'EbayenglishListing.item_sku LIKE' => "%$prsku%"));
                            $this->paginate = array('limit' => 200,'order'=>'EbayenglishListing.id  ASC','conditions' => $conditions);
                        }
                        $this->set('ebayenglishlistings', $this->paginate());

                }
                else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
                    $checkboxid = $_POST['checkid'];
                    App::import("Vendor","parsecsv");
                    $csv = new parseCSV();
                    $filepath = "C:\Users\Administrator\Downloads"."ebayenglishlistings.csv";	
                    $csv->auto($filepath);			
                    $this->set('ebayenglishlistings',$this->EbayenglishListing->find('all',array('conditions'=>array('EbayenglishListing.id' => $checkboxid))));
                    $this->layout = null;
                    $this->autoLayout = false;
                    Configure::write('debug', '2');
                }
                else
                {
                    $this->EbayenglishListing->recursive = 1;
                    $this->paginate = array('limit' => 200,'order'=>'EbayenglishListing.id  ASC');
                    $this->set('ebayenglishlistings', $this->paginate());
                }
        }


        function categoriesPro() {
                $this->loadModel('InventoryMaster');
                $procategory = $this->InventoryMaster->find('list', array('fields' =>'category','group'=>'category','recursive' => 0));
                return $procategory;
        }

        function category($id) { 
            if((!empty($id)))
            {
                $this->loadModel('InventoryMaster');
                $procategory = $this->InventoryMaster->find('list',array('fields'=>'item_sku','conditions' => array('InventoryMaster.category LIKE' => "%$id%")));
                $conditions = array('EbayenglishListing.item_sku'=>$procategory);
                $this->paginate = array('limit' => 200,'order'=>'EbayenglishListing.id  ASC','conditions' => $conditions);
				$this->set('foo',$id);
            }
            $this->EbayenglishListing->recursive = 1;
            $this->set('ebayenglishlistings', $this->paginate());

        }




        function import() {
                    if (!empty($this->data))
                    { 	
                        $filename = $this->data['EbayenglishListing']['file']['name'];
                        $fileExt = explode(".", $filename);
                        $fileExt2 = end($fileExt);
                        if($fileExt2 == 'csv') {
                            if(move_uploaded_file($this->data['EbayenglishListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['EbayenglishListing']['file']['name'])) 
                            $messages = $this->EbayenglishListing->import($filename);							
                            $this->Session->setFlash(__('The Ebay UK Listing was Imports successfully.', true));

                            if (!empty($messages)){
                            $this->set('anything', $messages);
                            Configure::write('debug', '2');
                            }

                        }
                        else
                        {

                        $this->Session->setFlash(__('The Ebay UK Listing File format not supported.</br>Please upload .CSV file format only.', true));
                        }

                    }			
                    else 
                    {
                    //$filename = 'Amazon_UK_Inventory-old.csv';
                    //$messages = $this->Project->import($filename);
                    }	

        }
        function update() {
            if (!empty($this->data))
            { 	
                $filename = $this->data['EbayenglishListing']['file']['name'];
                $fileExt = explode(".", $filename);
                $fileExt2 = end($fileExt);
                if($fileExt2 == 'csv') {
                    if(move_uploaded_file($this->data['EbayenglishListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['EbayenglishListing']['file']['name'])) 
                    $messages = $this->EbayenglishListing->update($filename);							
                    $this->Session->setFlash(__('The Ebay UK Listing was Update successfully.', true));

                    if (!empty($messages)){
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                    }

                }
                else
                {

                $this->Session->setFlash(__('The Ebay UK Listing File format not supported.</br>Please upload .CSV file format only.', true));
                }

            }			
            else 
            {
            //$filename = 'Amazon_UK_Inventory-old.csv';
            //$messages = $this->Project->import($filename);
            }	

        }


        function edit($id = null) {

            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Invalid The Ebay English Listing Id', true));
                $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {//print_r($id);die();

                if ($this->EbayenglishListing->save($this->data['EbayenglishListing'])) {
                    $this->Session->setFlash(__('The Ebay English Listing was saved successfully', true));
                    $this->redirect(array('action' => 'index'));
                } 
                else 
                {
                  $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));

                }
            }
                if (empty($this->data)) {
                $this->data = $this->EbayenglishListing->read(null, $id);
                }
            $users = $this->EbayenglishListing->User->find('list');
            $this->set(compact('users'));


        }

        function delete($id = null) {
            if (!$id) {
                $this->Session->setFlash(__('Invalid The Ebay English Listing ID in database.', true));
                $this->redirect(array('action'=>'index'));
            }
            else 
            {

                if($this->EbayenglishListing->delete($id))
                {

                $this->Session->setFlash(__('The The Ebay English Listing were deleted successfully.', true));
                $this->redirect(array('action'=>'index'));
                }

            }
            $this->Session->setFlash(__('ERROR!! The Ebay English Listing could not be deleted!', true));
            $this->redirect(array('action' => 'index'));
        }	
}