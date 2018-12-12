<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesChannels Model
 *
 * @method \App\Model\Entity\SalesChannel get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesChannel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesChannel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesChannel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesChannel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesChannel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesChannel findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesChannelsTable extends Table
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

        $this->setTable('sales_channels');
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
            ->scalar('channel_code')
            ->maxLength('channel_code', 500)
            ->requirePresence('channel_code', 'create')
            ->notEmpty('channel_code')
            ->add('channel_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('channel_name')
            ->maxLength('channel_name', 900)
            ->requirePresence('channel_name', 'create')
            ->notEmpty('channel_name');

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
        $rules->add($rules->isUnique(['channel_code']));

        return $rules;
    }
}
