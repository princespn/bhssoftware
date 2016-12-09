<?php
class CostSettingsController extends AppController {

    var $name = 'CostSettings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');



    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('add'));
    }

    public function add() {
        if (!empty($this->data)) {

            $this->CostSetting->updateAll(array('CostSetting.exchange_rate' => $this->data['CostSetting']['exchange_rate']), array('CostSetting.sale_base_currency' => $this->data['CostSetting']['sale_base_currency'], 'CostSetting.invoice_currency' => $this->data['CostSetting']['invoice_currency']));

            $this->Session->setFlash(__('Update Exchange Rate successfully.', true));
                $this->redirect(array('controller' => 'purchase_orders', 'action' => 'settings'));
            }
            else
                {
                $this->Session->setFlash(__('Data was not created. Please check all the fields and try again.', true));
            }

    }

}
?>