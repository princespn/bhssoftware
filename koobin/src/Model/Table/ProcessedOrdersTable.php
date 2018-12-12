<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcessedOrders Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\ProcessedOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcessedOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProcessedOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcessedOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcessedOrder findOrCreate($search, callable $callback = null, $options = [])
 */
class ProcessedOrdersTable extends Table
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

        $this->setTable('processed_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        /*$this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);*/
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
            ->maxLength('currency', 200)
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->scalar('plateform')
            ->maxLength('plateform', 400)
            ->requirePresence('plateform', 'create')
            ->notEmpty('plateform');

        $validator
            ->scalar('subsource')
            ->maxLength('subsource', 300)
            ->requirePresence('subsource', 'create')
            ->notEmpty('subsource');

        $validator
            ->scalar('order_value')
            ->maxLength('order_value', 100)
            ->requirePresence('order_value', 'create')
            ->notEmpty('order_value');

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
         $rules->add($rules->isUnique(['order_id']));
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
