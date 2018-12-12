<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GermanProductListings Model
 *
 * @method \App\Model\Entity\GermanProductListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\GermanProductListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GermanProductListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GermanProductListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GermanProductListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GermanProductListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GermanProductListing findOrCreate($search, callable $callback = null, $options = [])
 */
class GermanProductListingsTable extends Table
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

        $this->setTable('german_product_listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('product_sku')
            ->maxLength('product_sku', 500)
            ->requirePresence('product_sku', 'create')
            ->notEmpty('product_sku')
            ->add('product_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('product_code')
            ->maxLength('product_code', 500)
            ->requirePresence('product_code', 'create')
            ->notEmpty('product_code');

        $validator
            ->scalar('product_asin')
            ->maxLength('product_asin', 500)
            ->requirePresence('product_asin', 'create')
            ->notEmpty('product_asin');

        $validator
            ->scalar('fulfillmentchannel')
            ->maxLength('fulfillmentchannel', 500)
            ->requirePresence('fulfillmentchannel', 'create')
            ->notEmpty('fulfillmentchannel');

        $validator
            ->scalar('web_sku')
            ->maxLength('web_sku', 600)
            ->requirePresence('web_sku', 'create')
            ->notEmpty('web_sku');

        $validator
            ->scalar('category')
            ->maxLength('category', 400)
            ->requirePresence('category', 'create')
            ->notEmpty('category');

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
        $rules->add($rules->isUnique(['product_sku']));

        return $rules;
    }
}
