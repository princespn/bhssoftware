<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockItems Model
 *
 * @property \App\Model\Table\SuppsTable|\Cake\ORM\Association\BelongsTo $Supps
 *
 * @method \App\Model\Entity\StockItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockItem findOrCreate($search, callable $callback = null, $options = [])
 */
class StockItemsTable extends Table
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

        $this->setTable('stock_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Supps', [
            'foreignKey' => 'supp_id',
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
            ->scalar('item_number')
            ->maxLength('item_number', 200)
            ->requirePresence('item_number', 'create')
            ->notEmpty('item_number')
            ->add('item_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('item_title')
            ->maxLength('item_title', 900)
            ->requirePresence('item_title', 'create')
            ->notEmpty('item_title');

        $validator
            ->scalar('barcode_number')
            ->maxLength('barcode_number', 200)
            ->requirePresence('barcode_number', 'create')
            ->notEmpty('barcode_number');

        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 900)
            ->requirePresence('category_name', 'create')
            ->notEmpty('category_name');

        $validator
            ->scalar('supp_name')
            ->maxLength('supp_name', 500)
            ->requirePresence('supp_name', 'create')
            ->notEmpty('supp_name');

        $validator
            ->scalar('heights')
            ->maxLength('heights', 200)
            ->requirePresence('heights', 'create')
            ->notEmpty('heights');

        $validator
            ->scalar('widths')
            ->maxLength('widths', 200)
            ->requirePresence('widths', 'create')
            ->notEmpty('widths');

        $validator
            ->scalar('depths')
            ->maxLength('depths', 200)
            ->requirePresence('depths', 'create')
            ->notEmpty('depths');

        $validator
            ->scalar('weights')
            ->maxLength('weights', 100)
            ->requirePresence('weights', 'create')
            ->notEmpty('weights');

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
        $rules->add($rules->isUnique(['item_number']));
        $rules->add($rules->existsIn(['supp_id'], 'Supps'));

        return $rules;
    }
}
