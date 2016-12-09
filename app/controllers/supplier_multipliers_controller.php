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

    public function add()
    {
        if (!empty($this->data)) {
            $cat = urldecode($this->data['SupplierMultiplier']['category']);
            $supp = urldecode($this->data['SupplierMultiplier']['supplier']);

            if ((!empty($cat)) && (!empty($supp)))  { $catname = $this->SupplierMultiplier->find('all', array('conditions' => array('SupplierMultiplier.category' => $cat,'SupplierMultiplier.supplier' => $supp)));} //print_r($catname['0']['SupplierMultiplier']['supplier']);die();---THREEANG

            if (((!empty($catname['0']['SupplierMultiplier']['category'])) && ((!empty($catname['0']['SupplierMultiplier']['supplier'])))&& ((!empty($catname['0']['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['sale_base_curr']))) && ((!empty($this->data['SupplierMultiplier']['sp1_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp2_multiplier'])))) {
                //if ((!empty($catname)) && ((!empty($this->data['SupplierMultiplier']['sale_base_curr']))) && ((!empty($this->data['SupplierMultiplier']['sp1_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp2_multiplier'])))) {

           $this->request->data['SupplierMultiplier']['sale_base_curr'] = urldecode($this->data['SupplierMultiplier']['sale_base_curr']);
            // print_r($this->data['SupplierMultiplier']['sale_base_curr']); die();
            //$this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
            //$this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
            $newuser = $this->data['SupplierMultiplier']['sale_base_curr'];
                    $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.sp1_multiplier' => $this->data['SupplierMultiplier']['sp1_multiplier'], 'SupplierMultiplier.sp2_multiplier' => $this->data['SupplierMultiplier']['sp2_multiplier'], 'SupplierMultiplier.sp3_multiplier' => $this->data['SupplierMultiplier']['sp3_multiplier'], 'SupplierMultiplier.sale_base_curr' => "'$newuser'"), array('SupplierMultiplier.category' => $catname['0']['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['0']['SupplierMultiplier']['supplier']));
                    $this->Session->setFlash(__('Update Sales Price Multiplier value successfully', true));
                    $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                } else  if (((!empty($catname['0']['SupplierMultiplier']['category'])) && ((!empty($catname['0']['SupplierMultiplier']['supplier']))) && (!(empty($catname['0']['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['multiplier'])))) {

                       // $suppid = $this->SupplierMultiplier->find('All',);
                $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
                //$this->request->data['SupplierMultiplier']['multiplier'] = urldecode($this->data['SupplierMultiplier']['multiplier']);
                        $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.multiplier' => $this->data['SupplierMultiplier']['multiplier']), array('SupplierMultiplier.category' => $catname['0']['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['0']['SupplierMultiplier']['supplier']));
                        $this->Session->setFlash(__('Update Supplier Multiplier value successfully', true));
                        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                     } else if((!empty($this->data['SupplierMultiplier']['multiplier'])) && (!empty($this->data['SupplierMultiplier']['category'])) && (!empty($this->data['SupplierMultiplier']['multiplier']))) {

                        $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                        $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
                        $this->request->data['SupplierMultiplier']['multiplier'] = urldecode($this->data['SupplierMultiplier']['multiplier']);
                        $this->SupplierMultiplier->create();
                        if ($this->SupplierMultiplier->save($this->request->data)) {
                            $this->Session->setFlash(__('Sales Price Multiplier data created successfully.', true));
                            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                        }
                    } else {
                    $this->Session->setFlash(__('Data was not created. Please check all the fields and try again.', true));
                  $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                    }

        }

    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid ID in database.', true));
            $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
        } else {

            if ($this->SupplierMultiplier->delete($id)) {

                $this->Session->setFlash(__('The Supplier Multiplier List was deleted successfully.', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
            }
        }
        $this->Session->setFlash(__('ERROR!! The Supplier Multiplier List could not be deleted!', true));
        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
    }
}
?>