<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminListings Model
 *
 * @method \App\Model\Entity\AdminListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdminListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdminListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdminListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminListing findOrCreate($search, callable $callback = null, $options = [])
 */
class AdminListingsTable extends Table
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

        $this->setTable('admin_listings');
        //$this->setDisplayField('id');
        $this->setPrimaryKey('id');
		
					
			$this->belongsTo('InventoryCodes', [
            'foreignKey' => false,
			'conditions' => 'AdminListings.linnworks_code = InventoryCodes.linnworks_code',
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
            ->requirePresence('web_sku', 'create')
            ->notEmpty('web_sku')
            ->add('web_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('linnworks_code', 'create')
            ->notEmpty('linnworks_code');

        $validator
            ->requirePresence('web_price_uk', 'create')
            ->notEmpty('web_price_uk');

        $validator
            ->requirePresence('web_sale_price_uk', 'create')
            ->notEmpty('web_sale_price_uk');

        $validator
            ->requirePresence('web_price_fr', 'create')
            ->notEmpty('web_price_fr');

        $validator
            ->requirePresence('web_sale_price_fr', 'create')
            ->notEmpty('web_sale_price_fr');

        $validator
            ->requirePresence('web_price_de', 'create')
            ->notEmpty('web_price_de');

        $validator
            ->requirePresence('web_sale_price_de', 'create')
            ->notEmpty('web_sale_price_de');

        $validator
            ->requirePresence('web_price_dm', 'create')
            ->notEmpty('web_price_dm');

        $validator
            ->requirePresence('web_sale_price_dm', 'create')
            ->notEmpty('web_sale_price_dm');

        $validator
            ->requirePresence('web_price_tesco', 'create')
            ->notEmpty('web_price_tesco');

        $validator
            ->requirePresence('web_sale_price_tesco', 'create')
            ->notEmpty('web_sale_price_tesco');

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
        $rules->add($rules->isUnique(['web_sku']));

        return $rules;
    }
}
