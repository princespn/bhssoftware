<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MainListings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InventoryCodes
 *
 * @method \App\Model\Entity\MainListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\MainListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MainListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MainListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MainListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MainListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MainListing findOrCreate($search, callable $callback = null, $options = [])
 */
class MainListingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('main_listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('InventoryCodes', [
            'foreignKey' => false,
			'conditions' => 'MainListings.linnworks_code = InventoryCodes.linnworks_code',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('amazon_sku', 'create')
            ->notEmpty('amazon_sku');

        $validator
            ->requirePresence('linnworks_code', 'create')
            ->notEmpty('linnworks_code');

        $validator
            ->requirePresence('price_uk', 'create')
            ->notEmpty('price_uk');

        $validator
            ->requirePresence('sale_price_uk', 'create')
            ->notEmpty('sale_price_uk');

        $validator
            ->requirePresence('price_fr', 'create')
            ->notEmpty('price_fr');

        $validator
            ->requirePresence('sale_price_fr', 'create')
            ->notEmpty('sale_price_fr');

        $validator
            ->requirePresence('price_de', 'create')
            ->notEmpty('price_de');

        $validator
            ->requirePresence('sale_price_de', 'create')
            ->notEmpty('sale_price_de');

        $validator
            ->requirePresence('price_es', 'create')
            ->notEmpty('price_es');

        $validator
            ->requirePresence('sale_price_es', 'create')
            ->notEmpty('sale_price_es');

        $validator
            ->requirePresence('price_ebay', 'create')
            ->notEmpty('price_ebay');

        $validator
            ->requirePresence('sale_price_ebay', 'create')
            ->notEmpty('sale_price_ebay');

        $validator
            ->requirePresence('price_cdiscount', 'create')
            ->notEmpty('price_cdiscount');

        $validator
            ->requirePresence('sale_price_cdiscount', 'create')
            ->notEmpty('sale_price_cdiscount');

        $validator
            ->allowEmpty('prime_date');

        $validator
            ->requirePresence('error', 'create')
            ->notEmpty('error');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['linnworks_code'], 'InventoryCodes'));

        return $rules;
    }
	
	public function importcode($filename) {
		$i = null;
        $error = null;
        $filename = WWW_ROOT . '/files/' . $filename;
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
                    $data['MainListing'][$head] = (isset($row[$k])) ? $row[$k] : '';
                }
            }

            $id = isset($row[0]) ? $row[0] : 0;
            $cid = isset($row[1]) ? $row[1] : 1;   
		//print_r($id);die();			
            if ((!empty($id)) && (!empty($cid))) {

                $pcodes = $this->find('all', array('conditions' => array('MainListing.amazon_sku' => $id,'MainListing.channel_id' => $cid)));
                $lincode = $pcodes[0]['MainListing']['linnworks_code'];                
                $Webcodes = $this->AdminListing->find('all', array('conditions' => array('AdminListing.linnworks_code' => $lincode)));
                $WebList = $this->Listing->find('all', array('conditions' => array('Listing.linnworks_code' => $lincode)));

                if ((!empty($pcodes))) {
                    
                                $apiConfig = (isset($pcodes[0]['MainListing']) && is_array($pcodes[0]['MainListing'])) ? ($pcodes[0]['MainListing']) : array();
                                $data['MainListing'] = array_merge($apiConfig, $data['MainListing']);


                                $WebConfig = (isset($Webcodes[0]['AdminListing']) && is_array($Webcodes[0]['AdminListing'])) ? ($Webcodes[0]['AdminListing']) : array();
                                $WebListConfig = (isset($WebList[0]['Listing']) && is_array($WebList[0]['Listing'])) ? ($WebList[0]['Listing']) : array();




                                  if((empty($apiConfig['linnworks_code'])) && (empty($data['MainListing']['linnworks_code']))) {
                                    //$data['MainListing'] = array_merge($apiConfig['price_uk'], $data['MainListing']['price_uk']);
                                    $limit = 'Linnworks code not Exist in Database.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                    }

                                else if(((!empty($WebListConfig['web_sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($WebListConfig['web_sale_price_uk']))) {
                                    $limit = 'Master Web UK and Web UK Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                               else if(((!empty($WebListConfig['web_sale_price_tesco'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($WebListConfig['web_sale_price_tesco']))) {
                                    $limit = 'Master Web UK and Tesco Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }


                               else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebConfig['web_sale_price_uk']))) && (($WebConfig['web_sale_price_uk'])!==($data['MainListing']['sale_price_uk']))) {
                                    $limit = 'Master Web UK and Amazon UK Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') !== false) && (!empty($data['MainListing']['sale_price_uk'])) && (!empty($WebListConfig['web_sale_price_dm']))) && (($WebListConfig['web_sale_price_dm'])!==($data['MainListing']['sale_price_uk']))) {
                                    $limit = 'Amazon Prime UK and DM Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }

                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_de'])) && (!empty($WebConfig['web_sale_price_de']))) && (($WebConfig['web_sale_price_de'])!==($data['MainListing']['sale_price_de']))) {
                                    $limit = 'Master Web DE and Amazon DE Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                    //$db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                }
                                else if(((strpos($apiConfig['amazon_sku'], 'FBA') === false) && (!empty($data['MainListing']['sale_price_fr'])) && (!empty($WebConfig['web_sale_price_fr']))) && (($WebConfig['web_sale_price_fr'])!==($data['MainListing']['sale_price_fr']))) {
                                    $limit = 'Master Web FR and Amazon FR Price Mismatch.';
                                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                                    $err = implode("\n", $erritem);
                                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                 }else {      /* echo "Welcome";       */ }                               
                                                           
                    
                    
                    
                                } else {    $this->id = $id; }
            
                        } else {  $this->create();   }
            //debug($data);

            $this->set($data);
            if (!$this->validates()) {
                if (!empty($this->validationErrors['amazon_sku'])) {
                    $limit = $this->validationErrors['amazon_sku'];
                    $return['errors'][] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                    $erritem[] = __(sprintf("Listing  error on line %d and Amazon sku $id :$limit.", $i), true);
                    $err = implode("\n", $erritem);
                    $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                   // $db = $this->getDataSource(); $value = $db->value($err, 'string'); $this->updateAll(array('MainListing.error' => $value),array('MainListing.amazon_sku' => $id ));
                                
                }
            }
            
            
            if (($this->saveAll($data, $validate = false)) && (!empty($id))) {
                
                    $err = implode("\n", $erritem);
                        $this->saveField('error', $err, array($this->id = $apiConfig['id']));
                     if (!empty($err)) {    $this->saveField('error', $err, array($this->id = $apiConfig['id']));}
                     
              }
        }
        return $return;	
		
	}

}
