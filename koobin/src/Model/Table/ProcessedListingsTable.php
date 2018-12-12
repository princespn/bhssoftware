<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessedListings Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\ProcessedListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessedListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProcessedListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessedListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedListing findOrCreate($search, callable $callback = null, $options = [])
 */
class ProcessedListingsTable extends Table
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

        $this->setTable('processed_listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->date('order_date')
            ->requirePresence('order_date', 'create')
            ->notEmpty('order_date');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 300)
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->scalar('plateform')
            ->maxLength('plateform', 900)
            ->requirePresence('plateform', 'create')
            ->notEmpty('plateform');

        $validator
            ->scalar('subsource')
            ->maxLength('subsource', 900)
            ->requirePresence('subsource', 'create')
            ->notEmpty('subsource');

        $validator
            ->scalar('cat_name')
            ->maxLength('cat_name', 900)
            ->requirePresence('cat_name', 'create')
            ->notEmpty('cat_name');

        $validator
            ->scalar('product_sku')
            ->maxLength('product_sku', 900)
            ->requirePresence('product_sku', 'create')
            ->notEmpty('product_sku');

        $validator
            ->scalar('product_name')
            ->maxLength('product_name', 900)
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->scalar('price_per_product')
            ->maxLength('price_per_product', 400)
            ->requirePresence('price_per_product', 'create')
            ->notEmpty('price_per_product');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));

        return $rules;
    }
}
