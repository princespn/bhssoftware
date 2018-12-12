<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterListings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Channels
 *
 * @method \App\Model\Entity\MasterListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterListing findOrCreate($search, callable $callback = null, $options = [])
 */
class MasterListingsTable extends Table
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

        $this->setTable('master_listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('InventoryCodes', [
            'foreignKey' => false,
			'conditions' => 'MasterListings.linnworks_code = InventoryCodes.linnworks_code',
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
            ->allowEmpty('error');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['channel_id'], 'Channels'));

        return $rules;
    }
}
