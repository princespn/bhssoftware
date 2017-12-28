<?php
class CostSettingsController extends AppController {

    var $name = 'CostSettings';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');



    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('add'));
    }

    public function add()
    {

        if (!empty($this->data)) {
            $exchange = urldecode($this->data['CostSetting']['exchange_rate']);
            $basecurr = urldecode($this->data['CostSetting']['sale_base_currency']);
            $invcurr = urldecode($this->data['CostSetting']['invoice_currency']);
            $dynaiccurr = urldecode($this->data['CostSetting']['variation']);

          //  if ((!empty($exchange)) && (!empty($basecurr)) && (!empty($invcurr))) {
                $currname = $this->CostSetting->find('all', array('conditions' => array('CostSetting.sale_base_currency' => $basecurr, 'CostSetting.invoice_currency' => $invcurr)));          //print_r($currname[0]['CostSetting']['exchange_rate']); die();}


                if ((!empty($exchange))&& (empty($dynaiccurr))  && (!empty($currname[0]['CostSetting']['exchange_rate'])) && (!empty($currname[0]['CostSetting']['invoice_currency']))) {
                    $this->CostSetting->updateAll(array('CostSetting.exchange_rate' => $this->data['CostSetting']['exchange_rate']), array('CostSetting.sale_base_currency' => $this->data['CostSetting']['sale_base_currency'], 'CostSetting.invoice_currency' => $this->data['CostSetting']['invoice_currency']));
                    $this->Session->setFlash(__('Update Exchange Rate successfully.', true));
                    $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));

                } else  if ((empty($exchange)) && (!empty($dynaiccurr)) && (!empty($currname[0]['CostSetting']['variation'])) && (!empty($currname[0]['CostSetting']['invoice_currency'])) && (!empty($currname[0]['CostSetting']['sale_base_currency']))) {

                    $this->CostSetting->updateAll(array('CostSetting.variation' => $this->data['CostSetting']['variation']), array('CostSetting.sale_base_currency' => $this->data['CostSetting']['sale_base_currency'], 'CostSetting.invoice_currency' => $this->data['CostSetting']['invoice_currency']));
                    $this->Session->setFlash(__('Update  Variation successfully.', true));
                    $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));

                } else  if ((!empty($exchange)) && (!empty($dynaiccurr)) && (!empty($currname[0]['CostSetting']['variation'])) && (!empty($currname[0]['CostSetting']['invoice_currency'])) && (!empty($currname[0]['CostSetting']['sale_base_currency']))) {

                    $this->CostSetting->updateAll(array('CostSetting.variation' => $this->data['CostSetting']['variation'],'CostSetting.exchange_rate' => $this->data['CostSetting']['exchange_rate']), array('CostSetting.sale_base_currency' => $this->data['CostSetting']['sale_base_currency'], 'CostSetting.invoice_currency' => $this->data['CostSetting']['invoice_currency']));
                    $this->Session->setFlash(__('Update  Both Exchange rate And Variation successfully.', true));
                    $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));

                } else {

                    $this->request->data['CostSetting']['exchange_rate'] = $exchange;
                    $this->request->data['CostSetting']['sale_base_currency'] = $basecurr;
                    $this->request->data['CostSetting']['invoice_currency'] = $invcurr;

                    $this->CostSetting->create();
                            if ($this->CostSetting->save($this->request->data)) {
                                $this->Session->setFlash(__('Exchange Rate  currency created successfully.', true));
                                $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
                    }
                }
            //}else{

               // $this->Session->setFlash(__('Error !!, Exchange Rate currency Already Exist.', true));
               // $this->redirect(array('controller' => 'cost_calculators', 'action' => 'settings'));
            //}

        }


    }
}
?>