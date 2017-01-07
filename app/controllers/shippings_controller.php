<?php
class ShippingsController extends AppController {

    var $name = 'Shippings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');



    	function beforeFilter()
	{
	    parent::beforeFilter();
	    $this->Auth->allow(array('add','delete'));
	}
        
        
     public function add() {
        if (!empty($this->data)) { 
          $cat = urldecode($this->data['Shipping']['category']);
          $couname = urldecode($this->data['Shipping']['country']);
            
        if ((!empty($cat)) && (!empty($couname))){$coutryname = $this->Shipping->find('all', array('conditions' => array('Shipping.category' => $cat,'Shipping.country' => $couname)));} //print_r($catname[0]['Multiplier']['id']);die();
        if (!empty($coutryname[0]['Shipping']['id'])) {            
        $this->Shipping->updateAll(array('Shipping.shipping_cost' => $this->data['Shipping']['shipping_cost']), array('Shipping.category' => $cat, 'Shipping.country' => $couname));
        $this->Session->setFlash(__('Update Shipping cost data successfully', true));
        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));                    
        }else {            
        $this->request->data['Shipping']['category'] = $cat;
        $this->request->data['Shipping']['country'] = $couname;                            
        $this->request->data['Shipping']['shipping_cost'] = $this->data['Shipping']['shipping_cost'];
        
                             $this->Shipping->create();
                             if ($this->Shipping->save($this->request->data)) {
                                $this->Session->setFlash(__('Shipping cost data created successfully.', true));
                                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                                 }  

         
           
            }
            

    }
    
     }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
        } else {

            if ($this->Shipping->delete($id)) {

                $this->Session->setFlash(__('Shipping cost  deleted successfully.', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
            }
        }
        $this->Session->setFlash(__('ERROR!! Shipping cost could not be deleted!', true));
        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
    }
}
?>