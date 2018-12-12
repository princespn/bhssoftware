<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryCodes Model
 *
 * @method \App\Model\Entity\InventoryCode get($primaryKey, $options = [])
 * @method \App\Model\Entity\InventoryCode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InventoryCode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryCode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryCode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryCode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryCode findOrCreate($search, callable $callback = null, $options = [])
 */
class InventoryCodesTable extends Table
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

        $this->setTable('inventory_codes');
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
            ->requirePresence('linnworks_code', 'create')
            ->notEmpty('linnworks_code')
            ->add('linnworks_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

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
        $rules->add($rules->isUnique(['linnworks_code']));

        return $rules;
    }
}
