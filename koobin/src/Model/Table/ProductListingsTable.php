<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductListings Model
 *
 * @method \App\Model\Entity\ProductListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductListing findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductListingsTable extends Table
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

        $this->setTable('product_listings');
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
            ->requirePresence('product_sku', 'create')
            ->notEmpty('product_sku')
            ->add('product_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('product_code', 'create')
            ->notEmpty('product_code');

        $validator
            ->requirePresence('product_asin', 'create')
            ->notEmpty('product_asin');

        $validator
            ->requirePresence('fulfillmentchannel', 'create')
            ->notEmpty('fulfillmentchannel');

        $validator
            ->requirePresence('web_sku', 'create')
            ->notEmpty('web_sku');

        $validator
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
