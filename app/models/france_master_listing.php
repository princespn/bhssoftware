<?php

class FranceMasterListing extends AppModel {

    var $name = 'FranceMasterListing';
    var $validate = array(
        'item_sku' => array(
            'Unique-1' => array(
                'rule' => 'notempty',
                'message' => 'Item SKU is required.'
            ),
        ),
        'item_name' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Item Name is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Item Name must be no long 500 characters .'
            ),
        ),
        'brand_name' => array(
            'rule-b' => array(
                'rule' => 'notempty',
                'message' => 'Brand Name is required.'
            ),
        ),
        'manufacturer' => array(
            'rule-m' => array(
                'rule' => 'notempty',
                'message' => 'Manufacture Name is required.'
            ),
        ),
        'feed_product_type' => array(
            'rule-f' => array(
                'rule' => 'notempty',
                'message' => 'Feed product type is required.'
            ),
        ),
        'product_description' => array(
            'description-1' => array(
                'rule' => 'notempty',
                'message' => 'Product description is required.'
            ),
            'description-2' => array(
                'rule' => array('maxLength', 2000),
                'message' => 'Product description must be no long 2000 characters .'
            ),
        ),
        'standard_price' => array(
            'rule-p' => array(
                'rule' => 'notempty',
                'message' => 'Standard Price is Required.'
            ),
        ),
        'quantity' => array(
            'rule-q' => array(
                'rule' => 'notempty',
                'message' => 'Quantity is required.'
            ),
        ),
        'sale_price' => array(
            'rule-i' => array(
                'rule' => 'notempty',
                'message' => 'Sale price is required.'
            ),
        ),
        'condition_type' => array(
            'rule_c' => array(
                'rule' => 'notempty',
                'message' => 'Condition type is Required.'
            ),
        ),
        'recommended_browse_nodes1' => array(
            'rule-re' => array(
                'rule' => 'notempty',
                'message' => 'Browse nodes is required.'
            ),
        ),
        'bullet_point1' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Bullet point1 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Bullet point1 must be no long 500 characters .'
            ),
        ),
        'bullet_point2' => array(
            'point-1' => array(
                'rule' => 'notempty',
                'message' => 'Bullet point2 is required.'
            ),
            'point-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Bullet point2 must be no long 500 characters .'
            ),
        ),
        'bullet_point3' => array(
            'bullet-1' => array(
                'rule' => 'notempty',
                'message' => 'Bullet point3 is required.'
            ),
            'bullet-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Bullet point3 must be no long 500 characters .'
            ),
        ),
        'bullet_point4' => array(
            'maxlength-1' => array(
                'rule' => 'notempty',
                'message' => 'Bullet point4 is required.'
            ),
            'maxlength-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Bullet point4 must be no long 500 characters .'
            ),
        ),
        'bullet_point5' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Bullet point5 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 500),
                'message' => 'Bullet point5 must be no long 500 characters .'
            ),
        ),
        'generic_keywords1' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Generic keywords1 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Generic keywords1 must be no long 50 characters .'
            ),
        ),
        'generic_keywords2' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Generic keywords2 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Generic keywords2 must be no long 50 characters .'
            ),
        ),
        'generic_keywords3' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Generic keywords3 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Generic keywords3 must be no long 50 characters .'
            ),
        ),
        'generic_keywords4' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Generic keywords4 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Generic keywords4 must be no long 50 characters .'
            ),
        ),
        'generic_keywords5' => array(
            'rule-1' => array(
                'rule' => 'notempty',
                'message' => 'Generic keywords5 is required.'
            ),
            'rule-2' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Generic keywords5 must be no long 50 characters .'
            ),
        ),
    );

    public function import($filename) {
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
                    $data['FranceMasterListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            $listid = split("\-", $id);
              if($listid[1]==='FBA'){$listfinal=$listid[1];}
              if($listid[2]==='FBA'){$listfinal=$listid[2];}
            $listp = split("\-", $id);
            if($listp[1]==='FBA'){$pfinal=$listid[1];}
            if($listp[2]==='FBA'){$pfinal=$listid[2];}
            
            if (!empty($id)) {
                $projects = $this->find('all', array('conditions' => array('FranceMasterListing.item_sku' => $id)));

                if (!empty($projects)) {
                    $apiConfig = (isset($projects[0]['FranceMasterListing']) && is_array($projects[0]['FranceMasterListing'])) ? ($projects[0]['FranceMasterListing']) : array();
                    $data['FranceMasterListing'] = array_merge($apiConfig, $data['FranceMasterListing']);
                    $wordlist = split("\-", $apiConfig['item_sku']);
                    if($wordlist[1]==='FBA'){$wordfinal=$wordlist[1];}
                    if($wordlist[2]==='FBA'){$wordfinal=$wordlist[2];}
                    $wordp = split("\-", $apiConfig['item_sku']);
                    if($wordp[1]==='FBA'){$wordf=$wordp[1];}
                    if($wordp[2]==='FBA'){$wordf=$wordp[2];}
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['item_name'])) && (!empty($data['FranceMasterListing']['item_name'])) && (($apiConfig['item_name']) !== ($data['FranceMasterListing']['item_name']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['item_name'], $data['FranceMasterListing']['item_name']);
                        $limit = 'Item name did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['brand_name'])) && (!empty($data['FranceMasterListing']['brand_name'])) && (($apiConfig['brand_name']) !== ($data['FranceMasterListing']['brand_name']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['brand_name'], $data['FranceMasterListing']['brand_name']);
                        $limit = 'Brand Name did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['manufacturer'])) && (!empty($data['FranceMasterListing']['manufacturer'])) && (($apiConfig['manufacturer']) !== ($data['FranceMasterListing']['manufacturer']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['manufacturer'], $data['FranceMasterListing']['manufacturer']);
                        $limit = 'Manufacturer did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['feed_product_type'])) && (!empty($data['FranceMasterListing']['feed_product_type'])) && (($apiConfig['feed_product_type']) !== ($data['FranceMasterListing']['feed_product_type']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['feed_product_type'], $data['FranceMasterListing']['feed_product_type']);
                        $limit = 'Product feed type did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['product_description'])) && (!empty($data['FranceMasterListing']['product_description'])) && (($apiConfig['product_description']) !== ($data['FranceMasterListing']['product_description']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['product_description'], $data['FranceMasterListing']['product_description']);
                        $limit = 'Product description did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($wordf)) && (!empty($apiConfig['standard_price'])) && (!empty($data['FranceMasterListing']['standard_price'])) && (($apiConfig['standard_price']) !== ($data['FranceMasterListing']['standard_price']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['standard_price'], $data['FranceMasterListing']['standard_price']);
                        $limit = 'Standard Price did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($wordf)) && (!empty($apiConfig['sale_price'])) && (!empty($data['FranceMasterListing']['sale_price'])) && (($apiConfig['sale_price']) !== ($data['FranceMasterListing']['sale_price']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['sale_price'], $data['FranceMasterListing']['sale_price']);
                        $limit = 'Sale price did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['condition_type'])) && (!empty($data['FranceMasterListing']['condition_type'])) && (($apiConfig['condition_type']) !== ($data['FranceMasterListing']['condition_type']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['condition_type'], $data['FranceMasterListing']['condition_type']);
                        $limit = 'Condition type did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['recommended_browse_nodes1'])) && (!empty($data['FranceMasterListing']['recommended_browse_nodes1'])) && (($apiConfig['recommended_browse_nodes1']) !== ($data['FranceMasterListing']['recommended_browse_nodes1']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['recommended_browse_nodes1'], $data['FranceMasterListing']['recommended_browse_nodes1']);
                        $limit = 'Browse nodes did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['bullet_point1'])) && (!empty($data['FranceMasterListing']['bullet_point1'])) && (($apiConfig['bullet_point1']) !== ($data['FranceMasterListing']['bullet_point1']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['bullet_point1'], $data['FranceMasterListing']['bullet_point1']);
                        $limit = 'Bullet Point1 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['bullet_point2'])) && (!empty($data['FranceMasterListing']['bullet_point2'])) && (($apiConfig['bullet_point2']) !== ($data['FranceMasterListing']['bullet_point2']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['bullet_point2'], $data['FranceMasterListing']['bullet_point2']);
                        $limit = 'Bullet Point2 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['bullet_point3'])) && (!empty($data['FranceMasterListing']['bullet_point3'])) && (($apiConfig['bullet_point3']) !== ($data['FranceMasterListing']['bullet_point3']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['bullet_point3'], $data['FranceMasterListing']['bullet_point3']);
                        $limit = 'Bullet Point3 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['bullet_point4'])) && (!empty($data['FranceMasterListing']['bullet_point4'])) && (($apiConfig['bullet_point4']) !== ($data['FranceMasterListing']['bullet_point4']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['bullet_point4'], $data['FranceMasterListing']['bullet_point4']);
                        $limit = 'Bullet Point4 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['bullet_point5'])) && (!empty($data['FranceMasterListing']['bullet_point5'])) && (($apiConfig['bullet_point5']) !== ($data['FranceMasterListing']['bullet_point5']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['bullet_point5'], $data['FranceMasterListing']['bullet_point5']);
                        $limit = 'Bullet Point5 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['generic_keywords1'])) && (!empty($data['FranceMasterListing']['generic_keywords1'])) && (($apiConfig['generic_keywords1']) !== ($data['FranceMasterListing']['generic_keywords1']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['generic_keywords1'], $data['FranceMasterListing']['generic_keywords1']);
                        $limit = 'Generic keywords1 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['generic_keywords2'])) && (!empty($data['FranceMasterListing']['generic_keywords2'])) && (($apiConfig['generic_keywords2']) !== ($data['FranceMasterListing']['generic_keywords2']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['generic_keywords2'], $data['FranceMasterListing']['generic_keywords2']);
                        $limit = 'Generic keywords2 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['generic_keywords3'])) && (!empty($data['FranceMasterListing']['generic_keywords3'])) && (($apiConfig['generic_keywords3']) !== ($data['FranceMasterListing']['generic_keywords3']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['generic_keywords3'], $data['FranceMasterListing']['generic_keywords3']);
                        $limit = 'Generic keywords3 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['generic_keywords4'])) && (!empty($data['FranceMasterListing']['generic_keywords4'])) && (($apiConfig['generic_keywords4']) !== ($data['FranceMasterListing']['generic_keywords4']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['generic_keywords4'], $data['FranceMasterListing']['generic_keywords4']);
                        $limit = 'Generic keywords4 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordfinal) !== 'FBA') && (!empty($apiConfig['generic_keywords5'])) && (!empty($data['FranceMasterListing']['generic_keywords5'])) && (($apiConfig['generic_keywords5']) !== ($data['FranceMasterListing']['generic_keywords5']))) {
                        $data['FranceMasterListing'] = array_merge($apiConfig['generic_keywords5'], $data['FranceMasterListing']['generic_keywords5']);
                        $limit = 'Generic keywords5 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['item_sku'])) {
                    $limit = $this->validationErrors['item_sku'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }

                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['item_name']))) {
                    $limit = $this->validationErrors['item_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['brand_name']))) {
                    $limit = $this->validationErrors['brand_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['manufacturer']))) {
                    $limit = $this->validationErrors['manufacturer'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['feed_product_type']))) {
                    $limit = $this->validationErrors['feed_product_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['product_description']))) {
                    $limit = $this->validationErrors['product_description'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($pfinal)) && (!empty($this->validationErrors['standard_price']))) {
                    $limit = $this->validationErrors['standard_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['quantity']))) {
                    $limit = $this->validationErrors['quantity'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($pfinal)) && (!empty($this->validationErrors['sale_price']))) {
                    $limit = $this->validationErrors['sale_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['condition_type']))) {
                    $limit = $this->validationErrors['condition_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['recommended_browse_nodes1']))) {
                    $limit = $this->validationErrors['recommended_browse_nodes1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point1']))) {
                    $limit = $this->validationErrors['bullet_point1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point2']))) {
                    $limit = $this->validationErrors['bullet_point2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point3']))) {
                    $limit = $this->validationErrors['bullet_point3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point4']))) {
                    $limit = $this->validationErrors['bullet_point4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point5']))) {
                    $limit = $this->validationErrors['bullet_point5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords1']))) {
                    $limit = $this->validationErrors['generic_keywords1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords2']))) {
                    $limit = $this->validationErrors['generic_keywords2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords3']))) {
                    $limit = $this->validationErrors['generic_keywords3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords4']))) {
                    $limit = $this->validationErrors['generic_keywords4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords5']))) {
                    $limit = $this->validationErrors['generic_keywords5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->item_sku = $id));
                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        fclose($handle);
    }

    public function update($filename) {
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
                    $data['FranceMasterListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            $listid = split("\_", $id);
            $listp = split("\-", $id);
            if (!empty($id)) {
                $projects = $this->find('all', array('conditions' => array('FranceMasterListing.item_sku' => $id)));

                if (!empty($projects)) {
                    $apiConfig = (isset($projects[0]['FranceMasterListing']) && is_array($projects[0]['FranceMasterListing'])) ? ($projects[0]['FranceMasterListing']) : array();
                    $data['FranceMasterListing'] = array_merge($apiConfig, $data['FranceMasterListing']);

                    if ((!empty($apiConfig['standard_price'])) && (!empty($data['FranceMasterListing']['standard_price'])) && (($apiConfig['standard_price']) !== ($data['FranceMasterListing']['standard_price']))) {
                        $err = "";
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($apiConfig['sale_price'])) && (!empty($data['FranceMasterListing']['sale_price'])) && (($apiConfig['sale_price']) !== ($data['FranceMasterListing']['sale_price']))) {
                        $err = "";
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                } else {
                    $this->id = $id;
                }
            } else {
                $this->create();
            }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['item_sku'])) {
                    $limit = $this->validationErrors['item_sku'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['item_name']))) {
                    $limit = $this->validationErrors['item_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['brand_name']))) {
                    $limit = $this->validationErrors['brand_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['manufacturer']))) {
                    $limit = $this->validationErrors['manufacturer'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['feed_product_type']))) {
                    $limit = $this->validationErrors['feed_product_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['product_description']))) {
                    $limit = $this->validationErrors['product_description'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['standard_price']))) {
                    $limit = $this->validationErrors['standard_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['quantity']))) {
                    $limit = $this->validationErrors['quantity'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['sale_price']))) {
                    $limit = $this->validationErrors['sale_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['condition_type']))) {
                    $limit = $this->validationErrors['condition_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['recommended_browse_nodes1']))) {
                    $limit = $this->validationErrors['recommended_browse_nodes1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point1']))) {
                    $limit = $this->validationErrors['bullet_point1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point2']))) {
                    $limit = $this->validationErrors['bullet_point2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point3']))) {
                    $limit = $this->validationErrors['bullet_point3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point4']))) {
                    $limit = $this->validationErrors['bullet_point4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['bullet_point5']))) {
                    $limit = $this->validationErrors['bullet_point5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords1']))) {
                    $limit = $this->validationErrors['generic_keywords1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords2']))) {
                    $limit = $this->validationErrors['generic_keywords2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords3']))) {
                    $limit = $this->validationErrors['generic_keywords3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords4']))) {
                    $limit = $this->validationErrors['generic_keywords4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listfinal) !== 'FBA') && (!empty($this->validationErrors['generic_keywords5']))) {
                    $limit = $this->validationErrors['generic_keywords5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
            }
            if ($this->saveAll($data, $validate = false)) {
                if (!empty($id)) {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->item_sku = $id));
                } else {
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $i));
                }
            }
        }
        return $return;
        fclose($handle);
    }

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    var $hasOne = array(
        'FranceProductListing' => array(
            'className' => 'FranceProductListing',
            'foreignKey' => false,
            'conditions' => 'FranceMasterListing.item_sku = FranceProductListing.product_sku'
        ),
    );

}
