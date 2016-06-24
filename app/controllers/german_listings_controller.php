<?php
class GermanListingsController extends AppController {

            var $name = 'GermanListings';
            var $components = array('Acl', 'Auth', 'Session','RequestHandler');
            var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');

            function beforeFilter()
            {
                parent::beforeFilter();
                $this->layout = 'defaultGR';
                $this->Auth->allow(array('login','logout','index','edit','delete','update','import','categoriesPro','category'));
            }

            function index () 
            {
                    if((!empty($this->data)) &&(!empty($_POST['submit']))){
                            $string = explode(",",trim($this->data['GermanListing']['all_item']));
                            $prsku = $string[0];
                             if(!empty($string[1])){$prname = $string[1];}
                                if((!empty($prsku)) && (!empty($prname))){            
                                $conditions = array('GermanListing.product_code LIKE' => '%'.$prname.'%','GermanListing.item_sku LIKE' => '%'.$prsku.'%');
                                $this->paginate = array('limit' => 1000,'order'=>'GermanListing.id  ASC','conditions' => $conditions);
                                }
                                if((!empty($prsku))){
                                $conditions = array(
                                'OR'=> array('GermanListing.product_code LIKE' => "%$prsku%",'GermanListing.item_sku LIKE' => "%$prsku%"));
                                $this->paginate = array('limit' => 200,'order'=>'GermanListing.id  ASC','conditions' => $conditions);
                                }
                            $this->set('german_listings', $this->paginate());
                    }
                    else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
                            $checkboxid = $_POST['checkid'];
                            App::import("Vendor","parsecsv");
                            $csv = new parseCSV();
                            $filepath = "C:\Users\Administrator\Downloads"."german_listings.csv";	
                            $csv->auto($filepath);			
                            $this->set('german_listings',$this->GermanListing->find('all',array('conditions'=>array('GermanListing.id' => $checkboxid))));
                            $this->layout = null;
                            $this->autoLayout = false;
                            Configure::write('debug', '2');
                    }
                    else
                    {
                            $this->GermanListing->recursive = 1;
                            $this->paginate = array('limit' => 200,'order'=>'GermanListing.id  ASC');
                            $this->set('german_listings', $this->paginate());
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
                    $conditions = array('GermanListing.item_sku'=>$procategory);
                    $this->paginate = array('limit' => 200,'order'=>'GermanListing.id  ASC','conditions' => $conditions);
                    $this->set('foo',$id);
					}
                $this->GermanListing->recursive = 1;
                $this->set('german_listings', $this->paginate());
            }


            function import()
            {
                    if (!empty($this->data))
                    { 
                            $filename = $this->data['GermanListing']['file']['name'];	
                            $fileExt = explode(".", $filename);
                            $fileExt2 = end($fileExt);
                            if($fileExt2 == 'csv') {
                            if(move_uploaded_file($this->data['GermanListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanListing']['file']['name'])) 
                            $messages = $this->GermanListing->import($filename);
                            $this->Session->setFlash(__('The Amazon Germany Listing was Imports successfully.', true));
                            //$this->redirect(array('action' => 'index'));
                            $this->set('anything', $messages);
                            Configure::write('debug', '2');
                            }
                            else
                            {
                            $this->Session->setFlash(__('The Amazon Germany Listing File format not supported.</br>Please upload .CSV file format only.', true));
                            }
                    }			
                    else 
                    {
                    //$filename = 'Amazon_UK_Inventory-old.csv';
                    //$messages = $this->Listing->import($filename);
                    }
            }
            

            function update()
            {
                if (!empty($this->data))
                { 
                        $filename = $this->data['GermanListing']['file']['name'];	
                        $fileExt = explode(".", $filename);
                        $fileExt2 = end($fileExt);
                        if($fileExt2 == 'csv')
                        {
                            if(move_uploaded_file($this->data['GermanListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['GermanListing']['file']['name'])) 
                            $messages = $this->GermanListing->update($filename);
                            $this->Session->setFlash(__('The Amazon Germany Listing was update successfully.', true));
                            //$this->redirect(array('action' => 'index'));
                            $this->set('anything', $messages);
                            Configure::write('debug', '2');
                        }
                        else
                        {
                        $this->Session->setFlash(__('The Amazon Germany Listing File format not supported.</br>Please upload .CSV file format only.', true));
                        }

                }			
                else 
                {
                //$filename = 'Amazon_UK_Inventory-old.csv';
                //$messages = $this->Listing->import($filename);
                }
            }


            function download(){
                App::import("Vendor","parsecsv");
                $csv = new parseCSV();
                $filepath = "C:\Users\Administrator\Downloads"."german_listings.csv";

                $csv->auto($filepath);
                $this->set('german_listings',$this->GermanListing->find('all'));
                $this->layout = null;
                $this->autoLayout = false;
                Configure::write('debug', '0');
            }

            function edit($id = null) {
                if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Invalid The Amazon Germany Listing Id', true));
                $this->redirect(array('action' => 'index'));
                }
                if (!empty($this->data)) {
                        if ($this->GermanListing->save($this->data['GermanListing'])) {
                        $this->Session->setFlash(__('The The Amazon Germany Listing was saved successfully', true));
                        $this->redirect(array('action' => 'index'));
                        } 
                        else
                        {
                        $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
                        }
                }
                if (empty($this->data)) {
                $this->data = $this->GermanListing->read(null, $id);
                }
            $users = $this->GermanListing->User->find('list');
            $this->set(compact('users'));
            }


            function delete($id = null) {
                    if (!$id) {
                    $this->Session->setFlash(__('Invalid The Amazon Germany Listing ID in database.', true));
                    $this->redirect(array('action'=>'index'));
                    }
                    else 
                    {
                        if($this->GermanListing->delete($id))
                        {
                        $this->Session->setFlash(__('The The Amazon Germany Listing were deleted successfully.', true));
                        $this->redirect(array('action'=>'index'));
                        }
                    }
                $this->Session->setFlash(__('ERROR!! The Amazon Germany Listing could not be deleted!', true));
                $this->redirect(array('action' => 'index'));
            }
}