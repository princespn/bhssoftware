<?php
class SupplierMultipliersController extends AppController
{

    var $name = 'SupplierMultipliers';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');


    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add','delete'));
    }


        public function add() {
            
        if (!empty($this->data)) {   
            
            $categ = urldecode($this->data['SupplierMultiplier']['category']);
            $supply = urldecode($this->data['SupplierMultiplier']['supplier']);
            $curren = urldecode($this->data['SupplierMultiplier']['invoice_currency']);
            
            
        if ((!empty($categ)) && (!empty($supply)) && (!empty($curren))){ $categoryname = $this->SupplierMultiplier->find('all', array('conditions' => array('SupplierMultiplier.category' => $categ,'SupplierMultiplier.supplier' => $supply,'SupplierMultiplier.invoice_currency' => $curren)));} //print_r($categoryname);die();
               
                  $this->loadModel('Multiplier');                  
                  $Mulprices	=	$this->Multiplier->find('all', array('conditions' => array('Multiplier.category' => $categ,'Multiplier.supplier' => $supply)));
                 /// print_r($Mulprices[0]['Multiplier']['multiplier']);die();
                  
           if (!empty($Mulprices[0]['Multiplier']['multiplier'])) {
        
                                                           if (!empty($categoryname[0]['SupplierMultiplier']['id'])) { 
                                                               
                                                               $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.sp1_multiplier' => $this->data['SupplierMultiplier']['sp1_multiplier'], 'SupplierMultiplier.sp2_multiplier' => $this->data['SupplierMultiplier']['sp2_multiplier'], 'SupplierMultiplier.sp3_multiplier' => $this->data['SupplierMultiplier']['sp3_multiplier']), array('SupplierMultiplier.invoice_currency' => $categoryname['0']['SupplierMultiplier']['invoice_currency'],'SupplierMultiplier.category' => $categoryname['0']['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $categoryname['0']['SupplierMultiplier']['supplier']));
                                                               $this->Session->setFlash(__('Update Supplier Multiplier data successfully', true));
                                                               $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                                                               
                                                           }else {  
                                                               
                                                               $this->request->data['SupplierMultiplier']['category'] = $categ;
                                                               $this->request->data['SupplierMultiplier']['supplier'] = $supply;
                                                               $this->request->data['SupplierMultiplier']['invoice_currency'] = $curren;
                                                               
                                                               $this->request->data['SupplierMultiplier']['sp1_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp1_multiplier']);
                                                               $this->request->data['SupplierMultiplier']['sp2_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp2_multiplier']);
                                                               $this->request->data['SupplierMultiplier']['sp3_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp3_multiplier']);
                                                               
                                                               
                                                               $this->SupplierMultiplier->create();
                                                               if ($this->SupplierMultiplier->save($this->request->data)) {
                                                                   $this->Session->setFlash(__('Supplier Multiplier data created successfully.', true));
                                                                   $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                                                               }  
                                                               
                                                               
                                                 
                                                       
                                                        }
                                                        
           }else{
               
               
               $this->Session->setFlash(__('Error !! , Please Insert Multiplier value First.', true));
               $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));          
               
               
           }
                           

    }
    
    
 }
    
    
    
    
    /*public function addsffdf()
    {
        if (!empty($this->data)) {
            $cat = urldecode($this->data['SupplierMultiplier']['category']);
            $supp = urldecode($this->data['SupplierMultiplier']['supplier']);
            $newuser = $this->data['SupplierMultiplier']['invoice_currency'];
            //print_r($newuser);die();

            if ((!empty($newuser)) && (!empty($cat)) && (!empty($supp)))  { $catname = $this->SupplierMultiplier->find('all', array('conditions' => array('SupplierMultiplier.category' => $cat,'SupplierMultiplier.supplier' => $supp,'SupplierMultiplier.invoice_currency' => $newuser)));} //print_r($catname);die();

            if ((!empty($cat)) && (!empty($supp)))  { $invoice = $this->SupplierMultiplier->find('all', array('conditions' => array('SupplierMultiplier.category' => $cat,'SupplierMultiplier.supplier' => $supp)));} //print_r($invoice);die();
            
                    //print_r($catname['0']['SupplierMultiplier']['supplier']);die();---THREEANG 

            if ((($catname['0']['SupplierMultiplier']['invoice_currency'] === $newuser) && (!empty($catname['0']['SupplierMultiplier']['category'])) && ((!empty($catname['0']['SupplierMultiplier']['supplier']))) && ((!empty($catname['0']['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['sp1_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp2_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp3_multiplier'])))) {
                //if ((!empty($catname)) && ((!empty($this->data['SupplierMultiplier']['invoice_currency']))) && ((!empty($this->data['SupplierMultiplier']['sp1_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp2_multiplier'])))) {

          // $this->request->data['SupplierMultiplier']['invoice_currency'] = urldecode($this->data['SupplierMultiplier']['invoice_currency']);
            // print_r($this->data['SupplierMultiplier']['invoice_currency']); die();
            //$this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
            //$this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
            //$newuser = $this->data['SupplierMultiplier']['invoice_currency'];
                    $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.sp1_multiplier' => $this->data['SupplierMultiplier']['sp1_multiplier'], 'SupplierMultiplier.sp2_multiplier' => $this->data['SupplierMultiplier']['sp2_multiplier'], 'SupplierMultiplier.sp3_multiplier' => $this->data['SupplierMultiplier']['sp3_multiplier']), array('SupplierMultiplier.invoice_currency' => $catname['0']['SupplierMultiplier']['invoice_currency'],'SupplierMultiplier.category' => $catname['0']['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['0']['SupplierMultiplier']['supplier']));
                    $this->Session->setFlash(__('Update Sales Price Multiplier value successfully', true));
                    $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                } else  if (((!empty($invoice['0']['SupplierMultiplier']['category'])) && ((!empty($invoice['0']['SupplierMultiplier']['supplier']))) && (!(empty($invoice['0']['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['multiplier'])))) {

                       // $suppid = $this->SupplierMultiplier->find('All',);
                $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
                //$this->request->data['SupplierMultiplier']['multiplier'] = urldecode($this->data['SupplierMultiplier']['multiplier']);
                        $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.multiplier' => $this->data['SupplierMultiplier']['multiplier']), array('SupplierMultiplier.category' => $invoice['0']['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $invoice['0']['SupplierMultiplier']['supplier']));
                        $this->Session->setFlash(__('Update Supplier Multiplier value successfully', true));
                        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
              
                    } else if((!empty($this->data['SupplierMultiplier']['invoice_currency'])) && (!empty($this->data['SupplierMultiplier']['supplier'])) && (!empty($this->data['SupplierMultiplier']['category']))) {
                        
                            $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                            $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);                            
                            $this->request->data['SupplierMultiplier']['invoice_currency'] = urldecode($this->data['SupplierMultiplier']['invoice_currency']);
                            $this->request->data['SupplierMultiplier']['sp1_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp1_multiplier']);
                            $this->request->data['SupplierMultiplier']['sp2_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp2_multiplier']);
                            $this->request->data['SupplierMultiplier']['sp3_multiplier'] = urldecode($this->data['SupplierMultiplier']['sp3_multiplier']);
                            $this->SupplierMultiplier->create();
                            if ($this->SupplierMultiplier->save($this->request->data)) {
                                $this->Session->setFlash(__('Sales Price Multiplier data created successfully.', true));
                                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                            }
                    } else {
                    $this->Session->setFlash(__('Error !!. Please check all the fields and try again.', true));
                  $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                    }

        }

    }*/

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
        } else {

            if ($this->SupplierMultiplier->delete($id)) {

                $this->Session->setFlash(__('The Supplier Multiplier deleted successfully.', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Supplier Multiplier could not be deleted!', true));
        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
    }
}
?>