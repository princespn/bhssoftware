<?php

class SalesChannelsController extends AppController {

    var $name = 'SalesChannels';
    var $components = array('Acl', 'Auth', 'Session', 'RequestHandler');
    var $helpers = array('Session', 'Html', 'Form', 'Ajax', 'Javascript', 'Js', 'Csv');

    function beforeFilter() {
        parent::beforeFilter();
         
        $this->Auth->allow(array('index','channelcode'));
    }

    function index() {

    }



    public function channelcode() {

        $this->set('title', 'Import Linnworks Channel code information');

        if (!empty($this->data)) {
            $filename = $this->data['SalesChannel']['file']['name'];
            $fileExt = explode(".", $filename);
            $fileExt2 = end($fileExt);
            if ($fileExt2 == 'csv') {
                if (move_uploaded_file($this->data['SalesChannel']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['SalesChannel']['file']['name']))
                    $messages = $this->SalesChannel->channelcode($filename);
                $this->Session->setFlash(__('Linnworks Channel Code Imports successfully.', true));

                if (!empty($messages)) {
                    $this->set('anything', $messages);
                    Configure::write('debug', '2');
                }
            } else {

                $this->Session->setFlash(__('Linnworks Channel Code File format not supported.</br>Please upload .CSV file format only.', true));
            }
        } else {
            //$filename = 'Product Code.csv';
            //$messages = Product Code($filename);
        }
    }


}