<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrders Model
 *
 * @method \App\Model\Entity\PurchaseOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseOrdersTable extends Table
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

        $this->setTable('purchase_orders');
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('linnworks_code', 'create')
            ->notEmpty('linnworks_code')
            ->add('linnworks_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->requirePresence('invoice_value', 'create')
            ->notEmpty('invoice_value');

        $validator
            ->requirePresence('latest_invoice', 'create')
            ->notEmpty('latest_invoice');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->requirePresence('supplier', 'create')
            ->notEmpty('supplier');

        $validator
            ->requirePresence('invoice_currency', 'create')
            ->notEmpty('invoice_currency');

        $validator
            ->requirePresence('landed_price_gbp', 'create')
            ->notEmpty('landed_price_gbp');

        $validator
            ->requirePresence('sp1_value_gbp', 'create')
            ->notEmpty('sp1_value_gbp');

        $validator
            ->requirePresence('sp2_value_gbp', 'create')
            ->notEmpty('sp2_value_gbp');

        $validator
            ->requirePresence('sp3_value_gbp', 'create')
            ->notEmpty('sp3_value_gbp');

        $validator
            ->requirePresence('sale_price_gbp', 'create')
            ->notEmpty('sale_price_gbp');

        $validator
            ->requirePresence('landed_price_eur', 'create')
            ->notEmpty('landed_price_eur');

        $validator
            ->requirePresence('sp1_value_eur', 'create')
            ->notEmpty('sp1_value_eur');

        $validator
            ->requirePresence('sp2_value_eur', 'create')
            ->notEmpty('sp2_value_eur');

        $validator
            ->requirePresence('sp3_value_eur', 'create')
            ->notEmpty('sp3_value_eur');

        $validator
            ->requirePresence('sale_price_euro', 'create')
            ->notEmpty('sale_price_euro');

        $validator
            ->requirePresence('import_dates', 'create')
            ->notEmpty('import_dates');

        $validator
            ->requirePresence('error', 'create')
            ->notEmpty('error');

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
