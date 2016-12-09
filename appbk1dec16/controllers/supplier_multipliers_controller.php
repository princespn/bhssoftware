<?php
class SupplierMultipliersController extends AppController
{

    var $name = 'SupplierMultipliers';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');


    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add'));
    }

    public function add()
    {
        if (!empty($this->data)) {
            $id = urldecode($this->data['SupplierMultiplier']['category']);
            if (!empty($id)) { $catname = $this->SupplierMultiplier->findByCategory($id);}

        if (((!empty($catname['SupplierMultiplier']['category'])) && ((!empty($catname['SupplierMultiplier']['supplier'])))&& ((!empty($catname['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['sale_base_curr']))) && ((!empty($this->data['SupplierMultiplier']['sp1_multiplier']))) && ((!empty($this->data['SupplierMultiplier']['sp2_multiplier'])))) {

           $this->request->data['SupplierMultiplier']['sale_base_curr'] = urldecode($this->data['SupplierMultiplier']['sale_base_curr']);
            // print_r($this->data['SupplierMultiplier']['sale_base_curr']); die();
            //$this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
            //$this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
            $newuser = $this->data['SupplierMultiplier']['sale_base_curr'];
                    $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.sp1_multiplier' => $this->data['SupplierMultiplier']['sp1_multiplier'], 'SupplierMultiplier.sp2_multiplier' => $this->data['SupplierMultiplier']['sp2_multiplier'], 'SupplierMultiplier.sp3_multiplier' => $this->data['SupplierMultiplier']['sp3_multiplier'], 'SupplierMultiplier.sale_base_curr' => "'$newuser'"), array('SupplierMultiplier.category' => $catname['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['SupplierMultiplier']['supplier']));
                    $this->Session->setFlash(__('Update Sales Price Multiplier value successfully', true));
                    $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                } else  if (((!empty($catname['SupplierMultiplier']['category'])) && ((!empty($catname['SupplierMultiplier']['supplier']))) && ((empty($catname['SupplierMultiplier']['multiplier'])))) && ((!empty($this->data['SupplierMultiplier']['multiplier'])))) {

                $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
                //$this->request->data['SupplierMultiplier']['multiplier'] = urldecode($this->data['SupplierMultiplier']['multiplier']);
                        $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.multiplier' => $this->data['SupplierMultiplier']['multiplier']), array('SupplierMultiplier.category' => $catname['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['SupplierMultiplier']['supplier']));
                        $this->Session->setFlash(__('Update Supplier Multiplier value successfully', true));
                        $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                    }  else {

                $this->request->data['SupplierMultiplier']['category'] = urldecode($this->data['SupplierMultiplier']['category']);
                $this->request->data['SupplierMultiplier']['supplier'] = urldecode($this->data['SupplierMultiplier']['supplier']);
                $this->request->data['SupplierMultiplier']['multiplier'] = urldecode($this->data['SupplierMultiplier']['multiplier']);

                $this->SupplierMultiplier->create();
                if ($this->SupplierMultiplier->save($this->request->data)) {
                    $this->Session->setFlash(__('Supplier data created successfully.', true));
                    $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
                } else {
                    $this->Session->setFlash(__('Data was not created. Please check all the fields and try again.', true));
                }
            }
        }

    }
}
?>