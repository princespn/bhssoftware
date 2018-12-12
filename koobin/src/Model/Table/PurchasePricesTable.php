<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchasePrices Model
 *
 * @property \App\Model\Table\PurchasesTable|\Cake\ORM\Association\BelongsTo $Purchases
 * @property \App\Model\Table\SuppliersTable|\Cake\ORM\Association\BelongsTo $Suppliers
 *
 * @method \App\Model\Entity\PurchasePrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchasePrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchasePrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchasePrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchasePrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchasePrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchasePrice findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchasePricesTable extends Table
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

        $this->setTable('purchase_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Purchases', [
            'foreignKey' => 'purchase_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
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
            ->scalar('stock_itemid')
            ->maxLength('stock_itemid', 200)
            ->requirePresence('stock_itemid', 'create')
            ->notEmpty('stock_itemid');

        $validator
            ->scalar('item_sku')
            ->maxLength('item_sku', 200)
            ->requirePresence('item_sku', 'create')
            ->notEmpty('item_sku')
            ->add('item_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('item_title')
            ->maxLength('item_title', 200)
            ->requirePresence('item_title', 'create')
            ->notEmpty('item_title');

        $validator
            ->scalar('invoice_currency')
            ->maxLength('invoice_currency', 100)
            ->requirePresence('invoice_currency', 'create')
            ->notEmpty('invoice_currency');

        $validator
            ->scalar('quantity')
            ->maxLength('quantity', 100)
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->scalar('tax')
            ->maxLength('tax', 100)
            ->requirePresence('tax', 'create')
            ->notEmpty('tax');

        $validator
            ->scalar('cost')
            ->maxLength('cost', 100)
            ->requirePresence('cost', 'create')
            ->notEmpty('cost');

        $validator
            ->scalar('purchase_price')
            ->maxLength('purchase_price', 100)
            ->requirePresence('purchase_price', 'create')
            ->notEmpty('purchase_price');

        $validator
            ->date('purchase_date')
            ->requirePresence('purchase_date', 'create')
            ->notEmpty('purchase_date');

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
        $rules->add($rules->isUnique(['item_sku']));
        $rules->add($rules->existsIn(['purchase_id'], 'Purchases'));
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }
}
