<?php
class FranceListingsController extends AppController {

    var $name = 'FranceListings';
    var $components = array('Acl', 'Auth', 'Session','RequestHandler');
    var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');

            function beforeFilter()
            {
                parent::beforeFilter();
                //$this->Auth->allow('*');
                $this->Auth->allow(array('login','logout','index','edit','delete','import','update','categoriesPro','category'));
                $this->layout = 'defaultFR';
                Configure::write('Config.language', "fr");
                $this->Session->write('Config.language', 'fr');
                setlocale(LC_ALL, 'fr_CA.utf-8');

            }


                function index () {

                        if((!empty($this->data)) &&(!empty($_POST['submit']))){

                            $string = explode(",",trim($this->data['FranceListing']['all_item']));

                            $prsku = 	$string[0];
                            if(!empty($string[1])){$prname = $string[1];}
                                if((!empty($prsku)) && (!empty($prname))){
                                $conditions = array('FranceListing.product_code LIKE' => '%'.$prname.'%','FranceListing.item_sku LIKE' => '%'.$prsku.'%');
                                $this->paginate = array('limit' => 200,'order'=>'FranceListing.id  ASC','conditions' => $conditions);
                                }
                                if((!empty($prsku))){
                                $conditions = array(
                                'OR'=> array('FranceListing.product_code LIKE' => "%$prsku%",'FranceListing.item_sku LIKE' => "%$prsku%"));
                                $this->paginate = array('limit' => 200,'order'=>'FranceListing.id  ASC','conditions' => $conditions);
                                }
                            $this->set('france_listings', $this->paginate());
                        }
                        else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
                            $checkboxid = $_POST['checkid'];
                            App::import("Vendor","parsecsv");
                            $csv = new parseCSV();
                            $filepath = "C:\Users\Administrator\Downloads"."france_listings.csv";	
                            $csv->auto($filepath);			
                            $this->set('france_listings',$this->FranceListing->find('all',array('conditions'=>array('FranceListing.id' => $checkboxid))));
                            $this->layout = null;
                            $this->autoLayout = false;
                            Configure::write('debug', '2');
                        }
                        else
                        {
                            $this->FranceListing->recursive = 1;
                            $this->paginate = array('limit' => 200,'order'=>'FranceListing.id  ASC');
                            $this->set('france_listings', $this->paginate());
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
                                    $conditions = array('FranceListing.item_sku'=>$procategory);
                                    $this->paginate = array('limit' => 200,'order'=>'FranceListing.id  ASC','conditions' => $conditions);
									 $this->set('foo',$id);
									 }
                        $this->FranceListing->recursive = 1;
                        $this->set('france_listings', $this->paginate());

                }


                function import() {
                        if (!empty($this->data))
                        { 
                            $filename = $this->data['FranceListing']['file']['name'];	
                            $fileExt = explode(".", $filename);
                            $fileExt2 = end($fileExt);
                            if($fileExt2 == 'csv') {
                                if(move_uploaded_file($this->data['FranceListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceListing']['file']['name'])) 
                                $messages = $this->FranceListing->import($filename);
                                $this->Session->setFlash(__('The Amazon France FranceListing was Imports successfully.', true));
                                $this->set('anything', $messages);
                                Configure::write('debug', '2');
                            }
                            else
                            {
                            $this->Session->setFlash(__('The Amazon France FranceListing File format not supported.</br>Please upload .CSV file format only.', true));
                            }

                        }			
                        else 
                        {
                        //$filename = 'Amazon_UK_Inventory-old.csv';
                        //$messages = $this->FranceListing->import($filename);
                        }
                }

                function update() {
                        if (!empty($this->data))
                        { 
                            $filename = $this->data['FranceListing']['file']['name'];	
                            $fileExt = explode(".", $filename);
                            $fileExt2 = end($fileExt);
                                if($fileExt2 == 'csv') {
                                if(move_uploaded_file($this->data['FranceListing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['FranceListing']['file']['name'])) 
                                $messages = $this->FranceListing->update($filename);
                                $this->Session->setFlash(__('The Amazon France FranceListing was Update successfully.', true));
                                $this->set('anything', $messages);
                                Configure::write('debug', '2');
                                }
                                else
                                {
                                $this->Session->setFlash(__('The Amazon France FranceListing File format not supported.</br>Please upload .CSV file format only.', true));
                                }
                        }			
                        else 
                        {
                        //$filename = 'Amazon_UK_Inventory-old.csv';
                        //$messages = $this->FranceListing->import($filename);
                        }
                }

                function download(){
                        App::import("Vendor","parsecsv");
                        $csv = new parseCSV();
                        $filepath = "C:\Users\Administrator\Downloads"."projects.csv";

                        $csv->auto($filepath);
                        $this->set('projects',$this->FranceListing->find('all'));
                        $this->layout = null;
                        $this->autoLayout = false;
                        Configure::write('App.encoding', 'utf8_unicode_ci');  
                        Configure::write('debug', '0');
                }

                function edit($id = null) {

                            if (!$id && empty($this->data)) {
                            $this->Session->setFlash(__('Invalid The Amazon France FranceListing Id', true));
                            $this->redirect(array('action' => 'index'));
                            }
                            if (!empty($this->data)) {
                                    if ($this->FranceListing->save($this->data['FranceListing'])) {
                                    $this->Session->setFlash(__('The The Amazon France FranceListing was saved successfully', true));
                                    $this->redirect(array('action' => 'index'));
                                    } 
                                    else 
                                    {
                                    $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
                                    }
                            }
                            if (empty($this->data)) {
                            $this->data = $this->FranceListing->read(null, $id);
                            }
                        $users = $this->FranceListing->User->find('list');
                        $this->set(compact('users'));
                }


                function delete($id = null) {
                            if (!$id) {
                            $this->Session->setFlash(__('Invalid The Amazon France FranceListing ID in database.', true));
                            $this->redirect(array('action'=>'index'));
                            }
                            else
                            {
                                    if($this->FranceListing->delete($id))
                                    {
                                    $this->Session->setFlash(__('The The Amazon France FranceListing were deleted successfully.', true));
                                    $this->redirect(array('action'=>'index'));
                                    }
                            }
                        $this->Session->setFlash(__('ERROR!! The Amazon France FranceListing could not be deleted!', true));
                        $this->redirect(array('action' => 'index'));
                }
}
