<?php

class FranceListing extends AppModel {

    var $name = 'FranceListing';
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
                    $data['FranceListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            $listid = split("\_", $id);
            $listp = split("\-", $id);

            if (!empty($id)) {
                $projects = $this->find('all', array('conditions' => array('FranceListing.item_sku' => $id)));

                if (!empty($projects)) {
                    $apiConfig = (isset($projects[0]['FranceProductListing']) && is_array($projects[0]['FranceProductListing'])) ? ($projects[0]['FranceProductListing']) : array();
                    $data['FranceProductListing'] = array_merge($apiConfig, $data['FranceProductListing']);
                    $wordlist = split("\_", $apiConfig['item_sku']);
                    $wordp = split("\-", $apiConfig['item_sku']);
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['item_name'])) && (!empty($data['FranceProductListing']['item_name'])) && (($apiConfig['item_name']) !== ($data['FranceProductListing']['item_name']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['item_name'], $data['FranceProductListing']['item_name']);
                        $limit = 'Item name did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['brand_name'])) && (!empty($data['FranceProductListing']['brand_name'])) && (($apiConfig['brand_name']) !== ($data['FranceProductListing']['brand_name']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['brand_name'], $data['FranceProductListing']['brand_name']);
                        $limit = 'Brand Name did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['manufacturer'])) && (!empty($data['FranceProductListing']['manufacturer'])) && (($apiConfig['manufacturer']) !== ($data['FranceProductListing']['manufacturer']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['manufacturer'], $data['FranceProductListing']['manufacturer']);
                        $limit = 'Manufacturer did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['feed_product_type'])) && (!empty($data['FranceProductListing']['feed_product_type'])) && (($apiConfig['feed_product_type']) !== ($data['FranceProductListing']['feed_product_type']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['feed_product_type'], $data['FranceProductListing']['feed_product_type']);
                        $limit = 'Product feed type did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['product_description'])) && (!empty($data['FranceProductListing']['product_description'])) && (($apiConfig['product_description']) !== ($data['FranceProductListing']['product_description']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['product_description'], $data['FranceProductListing']['product_description']);
                        $limit = 'Product description did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($wordp[1])) && (!empty($apiConfig['standard_price'])) && (!empty($data['FranceProductListing']['standard_price'])) && (($apiConfig['standard_price']) !== ($data['FranceProductListing']['standard_price']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['standard_price'], $data['FranceProductListing']['standard_price']);
                        $limit = 'Standard Price did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($wordp[1])) && (!empty($apiConfig['sale_price'])) && (!empty($data['FranceProductListing']['sale_price'])) && (($apiConfig['sale_price']) !== ($data['FranceProductListing']['sale_price']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['sale_price'], $data['FranceProductListing']['sale_price']);
                        $limit = 'Sale price did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['condition_type'])) && (!empty($data['FranceProductListing']['condition_type'])) && (($apiConfig['condition_type']) !== ($data['FranceProductListing']['condition_type']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['condition_type'], $data['FranceProductListing']['condition_type']);
                        $limit = 'Condition type did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['recommended_browse_nodes1'])) && (!empty($data['FranceProductListing']['recommended_browse_nodes1'])) && (($apiConfig['recommended_browse_nodes1']) !== ($data['FranceProductListing']['recommended_browse_nodes1']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['recommended_browse_nodes1'], $data['FranceProductListing']['recommended_browse_nodes1']);
                        $limit = 'Browse nodes did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['bullet_point1'])) && (!empty($data['FranceProductListing']['bullet_point1'])) && (($apiConfig['bullet_point1']) !== ($data['FranceProductListing']['bullet_point1']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['bullet_point1'], $data['FranceProductListing']['bullet_point1']);
                        $limit = 'Bullet Point1 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['bullet_point2'])) && (!empty($data['FranceProductListing']['bullet_point2'])) && (($apiConfig['bullet_point2']) !== ($data['FranceProductListing']['bullet_point2']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['bullet_point2'], $data['FranceProductListing']['bullet_point2']);
                        $limit = 'Bullet Point2 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['bullet_point3'])) && (!empty($data['FranceProductListing']['bullet_point3'])) && (($apiConfig['bullet_point3']) !== ($data['FranceProductListing']['bullet_point3']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['bullet_point3'], $data['FranceProductListing']['bullet_point3']);
                        $limit = 'Bullet Point3 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['bullet_point4'])) && (!empty($data['FranceProductListing']['bullet_point4'])) && (($apiConfig['bullet_point4']) !== ($data['FranceProductListing']['bullet_point4']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['bullet_point4'], $data['FranceProductListing']['bullet_point4']);
                        $limit = 'Bullet Point4 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['bullet_point5'])) && (!empty($data['FranceProductListing']['bullet_point5'])) && (($apiConfig['bullet_point5']) !== ($data['FranceProductListing']['bullet_point5']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['bullet_point5'], $data['FranceProductListing']['bullet_point5']);
                        $limit = 'Bullet Point5 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['generic_keywords1'])) && (!empty($data['FranceProductListing']['generic_keywords1'])) && (($apiConfig['generic_keywords1']) !== ($data['FranceProductListing']['generic_keywords1']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['generic_keywords1'], $data['FranceProductListing']['generic_keywords1']);
                        $limit = 'Generic keywords1 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['generic_keywords2'])) && (!empty($data['FranceProductListing']['generic_keywords2'])) && (($apiConfig['generic_keywords2']) !== ($data['FranceProductListing']['generic_keywords2']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['generic_keywords2'], $data['FranceProductListing']['generic_keywords2']);
                        $limit = 'Generic keywords2 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['generic_keywords3'])) && (!empty($data['FranceProductListing']['generic_keywords3'])) && (($apiConfig['generic_keywords3']) !== ($data['FranceProductListing']['generic_keywords3']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['generic_keywords3'], $data['FranceProductListing']['generic_keywords3']);
                        $limit = 'Generic keywords3 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['generic_keywords4'])) && (!empty($data['FranceProductListing']['generic_keywords4'])) && (($apiConfig['generic_keywords4']) !== ($data['FranceProductListing']['generic_keywords4']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['generic_keywords4'], $data['FranceProductListing']['generic_keywords4']);
                        $limit = 'Generic keywords4 did not match.';
                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                        $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((($wordlist[1]) !== 'FBA') && (!empty($apiConfig['generic_keywords5'])) && (!empty($data['FranceProductListing']['generic_keywords5'])) && (($apiConfig['generic_keywords5']) !== ($data['FranceProductListing']['generic_keywords5']))) {
                        $data['FranceProductListing'] = array_merge($apiConfig['generic_keywords5'], $data['FranceProductListing']['generic_keywords5']);
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

                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['item_name']))) {
                    $limit = $this->validationErrors['item_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['brand_name']))) {
                    $limit = $this->validationErrors['brand_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['manufacturer']))) {
                    $limit = $this->validationErrors['manufacturer'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['feed_product_type']))) {
                    $limit = $this->validationErrors['feed_product_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['product_description']))) {
                    $limit = $this->validationErrors['product_description'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['standard_price']))) {
                    $limit = $this->validationErrors['standard_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['quantity']))) {
                    $limit = $this->validationErrors['quantity'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['sale_price']))) {
                    $limit = $this->validationErrors['sale_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['condition_type']))) {
                    $limit = $this->validationErrors['condition_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['recommended_browse_nodes1']))) {
                    $limit = $this->validationErrors['recommended_browse_nodes1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point1']))) {
                    $limit = $this->validationErrors['bullet_point1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point2']))) {
                    $limit = $this->validationErrors['bullet_point2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point3']))) {
                    $limit = $this->validationErrors['bullet_point3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point4']))) {
                    $limit = $this->validationErrors['bullet_point4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point5']))) {
                    $limit = $this->validationErrors['bullet_point5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords1']))) {
                    $limit = $this->validationErrors['generic_keywords1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords2']))) {
                    $limit = $this->validationErrors['generic_keywords2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords3']))) {
                    $limit = $this->validationErrors['generic_keywords3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords4']))) {
                    $limit = $this->validationErrors['generic_keywords4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords5']))) {
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
                    $data['FranceListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            $listid = split("\_", $id);
            $listp = split("\-", $id);
            if (!empty($id)) {
                $projects = $this->find('all', array('conditions' => array('FranceListing.item_sku' => $id)));

                if (!empty($projects)) {
                    $apiConfig = (isset($projects[0]['FranceListing']) && is_array($projects[0]['FranceListing'])) ? ($projects[0]['FranceListing']) : array();
                    $data['FranceListing'] = array_merge($apiConfig, $data['FranceListing']);

                    if ((!empty($apiConfig['standard_price'])) && (!empty($data['FranceListing']['standard_price'])) && (($apiConfig['standard_price']) !== ($data['FranceListing']['standard_price']))) {
                        $err = "";
                        $this->saveField('error', $err, array($this->id = $i));
                    }
                    if ((!empty($apiConfig['sale_price'])) && (!empty($data['FranceListing']['sale_price'])) && (($apiConfig['sale_price']) !== ($data['FranceListing']['sale_price']))) {
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
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['item_name']))) {
                    $limit = $this->validationErrors['item_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['brand_name']))) {
                    $limit = $this->validationErrors['brand_name'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['manufacturer']))) {
                    $limit = $this->validationErrors['manufacturer'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['feed_product_type']))) {
                    $limit = $this->validationErrors['feed_product_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['product_description']))) {
                    $limit = $this->validationErrors['product_description'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['standard_price']))) {
                    $limit = $this->validationErrors['standard_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['quantity']))) {
                    $limit = $this->validationErrors['quantity'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((!empty($listp[1])) && (!empty($this->validationErrors['sale_price']))) {
                    $limit = $this->validationErrors['sale_price'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['condition_type']))) {
                    $limit = $this->validationErrors['condition_type'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['recommended_browse_nodes1']))) {
                    $limit = $this->validationErrors['recommended_browse_nodes1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point1']))) {
                    $limit = $this->validationErrors['bullet_point1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point2']))) {
                    $limit = $this->validationErrors['bullet_point2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point3']))) {
                    $limit = $this->validationErrors['bullet_point3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point4']))) {
                    $limit = $this->validationErrors['bullet_point4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['bullet_point5']))) {
                    $limit = $this->validationErrors['bullet_point5'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords1']))) {
                    $limit = $this->validationErrors['generic_keywords1'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords2']))) {
                    $limit = $this->validationErrors['generic_keywords2'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords3']))) {
                    $limit = $this->validationErrors['generic_keywords3'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords4']))) {
                    $limit = $this->validationErrors['generic_keywords4'];
                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d and Item sku $id :$limit.", $i), true);
                }
                if ((($listid[1]) !== 'FBA') && (!empty($this->validationErrors['generic_keywords5']))) {
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
            'conditions' => 'FranceListing.item_sku = FranceProductListing.product_sku'
        ),
    );

}
