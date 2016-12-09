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
            // print_r($catname['SupplierMultiplier']['category']); die();
            if ((!empty($catname['SupplierMultiplier']['category'])) && ((!empty($catname['SupplierMultiplier']['supplier'])))) {
                $this->SupplierMultiplier->updateAll(array('SupplierMultiplier.sp1_multiplier' => $this->data['SupplierMultiplier']['sp1_multiplier'], 'SupplierMultiplier.sp2_multiplier' => $this->data['SupplierMultiplier']['sp2_multiplier'], 'SupplierMultiplier.sp3_multiplier' => $this->data['SupplierMultiplier']['sp3_multiplier']), array('SupplierMultiplier.category' => $catname['SupplierMultiplier']['category'], 'SupplierMultiplier.supplier' => $catname['SupplierMultiplier']['supplier']));
                $this->Session->setFlash(__('The setting multipliers value save successfully', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));


            } else {

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