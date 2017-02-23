<?php

class SalesChannel extends AppModel {

    var $name = 'SalesChannel';
    var $validate = array(
        'channel_code' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Channel code is required.'
            ),
        ),

        'channel_name' => array(
            'rule-b' => array(
                'rule' => 'notempty',
                'message' => 'Channel Name is required.'
            ),
        )


    );


    public function channelcode($filename) {
        $i = null;
        $error = null;
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $filename;
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $return = array(
            //'messages' => array(),
            'errors' => array(),
        );

        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
            $erritem = array();

            foreach ($header as $k => $head) {
                if (strpos($head, '.') !== false) {
                    $h = explode('.', $head);
                    $data[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';
                } else {
                    $data['SalesChannel'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            if (!empty($id)) {

                $pcodes = $this->find('all', array('conditions' => array('SalesChannel.channel_code' => $id)));
                if ((!empty($pcodes))) {
                    $apiConfig = (isset($pcodes[0]['SalesChannel']) && is_array($pcodes[0]['SalesChannel'])) ? ($pcodes[0]['SalesChannel']) : array();
                    $data['SalesChannel'] = (isset($data['SalesChannel']) && is_array($data['SalesChannel'])) ? ($data['SalesChannel']) : array();
                    $data['SalesChannel'] = array_merge($apiConfig, $data['SalesChannel']);
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['channel_code'])) {
                    $limit = $this->validationErrors['channel_code'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->channel_code = $id));

                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        //fclose($handle);
    }




}
