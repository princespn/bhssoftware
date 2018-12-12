<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Multipliers Model
 *
 * @method \App\Model\Entity\Multiplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Multiplier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Multiplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Multiplier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Multiplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Multiplier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Multiplier findOrCreate($search, callable $callback = null, $options = [])
 */
class MultipliersTable extends Table
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

        $this->setTable('multipliers');
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
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->requirePresence('supplier', 'create')
            ->notEmpty('supplier');

        $validator
            ->requirePresence('multiplier', 'create')
            ->notEmpty('multiplier');

        return $validator;
    }
}
