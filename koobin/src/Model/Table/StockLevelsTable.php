<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockLevels Model
 *
 * @property \App\Model\Table\StockLocationsTable|\Cake\ORM\Association\BelongsTo $StockLocations
 *
 * @method \App\Model\Entity\StockLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockLevel findOrCreate($search, callable $callback = null, $options = [])
 */
class StockLevelsTable extends Table
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

        $this->setTable('stock_levels');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('StockLocations', [
            'foreignKey' => 'stock_location_id',
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
            ->scalar('change_date')
            ->maxLength('change_date', 100)
            ->requirePresence('change_date', 'create')
            ->notEmpty('change_date');

        $validator
            ->scalar('item_number')
            ->maxLength('item_number', 100)
            ->requirePresence('item_number', 'create')
            ->notEmpty('item_number');

        $validator
            ->scalar('item_title')
            ->maxLength('item_title', 200)
            ->requirePresence('item_title', 'create')
            ->notEmpty('item_title');

        $validator
            ->scalar('barcode_number')
            ->maxLength('barcode_number', 100)
            ->requirePresence('barcode_number', 'create')
            ->notEmpty('barcode_number');

        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 200)
            ->requirePresence('category_name', 'create')
            ->notEmpty('category_name');

        $validator
            ->scalar('location_name')
            ->maxLength('location_name', 100)
            ->requirePresence('location_name', 'create')
            ->notEmpty('location_name');

        $validator
            ->scalar('stock_lev')
            ->maxLength('stock_lev', 100)
            ->requirePresence('stock_lev', 'create')
            ->notEmpty('stock_lev');

        $validator
            ->scalar('stock_val')
            ->maxLength('stock_val', 100)
            ->requirePresence('stock_val', 'create')
            ->notEmpty('stock_val');

        $validator
            ->scalar('minimum_level')
            ->maxLength('minimum_level', 100)
            ->allowEmpty('minimum_level');

        $validator
            ->scalar('due_level')
            ->maxLength('due_level', 100)
            ->allowEmpty('due_level');

        $validator
            ->scalar('unit_costs')
            ->maxLength('unit_costs', 200)
            ->requirePresence('unit_costs', 'create')
            ->notEmpty('unit_costs');

        $validator
            ->scalar('stock_itemid')
            ->maxLength('stock_itemid', 100)
            ->requirePresence('stock_itemid', 'create')
            ->notEmpty('stock_itemid');

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
        $rules->add($rules->existsIn(['stock_location_id'], 'StockLocations'));

        return $rules;
    }
}
