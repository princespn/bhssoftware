<?php
class MultipliersController extends AppController {

	var $name = 'Multipliers';
	var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
	var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');
	
	
	function beforeFilter()
	{
	    parent::beforeFilter();
	    $this->Auth->allow(array('add','delete'));
	}
        
     public function add() {
        if (!empty($this->data)) { 
          $cat = urldecode($this->data['Multiplier']['category']);
          $supp = urldecode($this->data['Multiplier']['supplier']);
            
        if ((!empty($cat)) && (!empty($supp))){$catname = $this->Multiplier->find('all', array('conditions' => array('Multiplier.category' => $cat,'Multiplier.supplier' => $supp)));} //print_r($catname[0]['Multiplier']['id']);die();
        if (!empty($catname[0]['Multiplier']['id'])) {            
        $this->Multiplier->updateAll(array('Multiplier.multiplier' => $this->data['Multiplier']['multiplier']), array('Multiplier.category' => $cat, 'Multiplier.supplier' => $supp));
        $this->Session->setFlash(__('Update Multiplier data successfully', true));
        $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));                    
        }else {            
        $this->request->data['Multiplier']['category'] = $cat;
        $this->request->data['Multiplier']['supplier'] = $supp;                            
        $this->request->data['Multiplier']['multiplier'] = urldecode($this->data['Multiplier']['multiplier']);
        
                             $this->Multiplier->create();
                             if ($this->Multiplier->save($this->request->data)) {
                                $this->Session->setFlash(__('Multiplier data created successfully.', true));
                                $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
                                 }  

         
           
            }
            

    }
    
     }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
        } else {

            if ($this->Multiplier->delete($id)) {

                $this->Session->setFlash(__('Multiplier  deleted successfully.', true));
                $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
            }
        }
        $this->Session->setFlash(__('ERROR!! Multiplier could not be deleted!', true));
        $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
    }
	
}
?>