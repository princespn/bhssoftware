<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CostCalculators Model
 *
 * @method \App\Model\Entity\CostCalculator get($primaryKey, $options = [])
 * @method \App\Model\Entity\CostCalculator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CostCalculator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CostCalculator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CostCalculator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CostCalculator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CostCalculator findOrCreate($search, callable $callback = null, $options = [])
 */
class CostCalculatorsTable extends Table
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

        $this->setTable('cost_calculators');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
		$this->hasOne('PurchasePrices', [
            'foreignKey' => false,
			'conditions' => 'CostCalculators.linnworks_code = PurchasePrices.item_sku'
        ]);
        $this->hasOne('AdminListings', [
            'foreignKey' => false,
			'conditions' => 'CostCalculators.linnworks_code = AdminListings.linnworks_code'
        ]);
        $this->hasOne('Multipliers', [
            'foreignKey' => false,
			'conditions' =>array('CostCalculators.category = Multipliers.category','CostCalculators.supplier = Multipliers.supplier')
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('linnworks_code')
            ->maxLength('linnworks_code', 600)
            ->requirePresence('linnworks_code', 'create')
            ->notEmpty('linnworks_code')
            ->add('linnworks_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('product_name')
            ->maxLength('product_name', 600)
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->scalar('category')
            ->maxLength('category', 600)
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->scalar('supplier')
            ->maxLength('supplier', 600)
            ->requirePresence('supplier', 'create')
            ->notEmpty('supplier');

        $validator
            ->scalar('invoice_currency')
            ->maxLength('invoice_currency', 600)
            ->requirePresence('invoice_currency', 'create')
            ->notEmpty('invoice_currency');

        $validator
            ->scalar('landed_price_gbp')
            ->maxLength('landed_price_gbp', 300)
            ->requirePresence('landed_price_gbp', 'create')
            ->notEmpty('landed_price_gbp');

        $validator
            ->scalar('sp1_value_gbp')
            ->maxLength('sp1_value_gbp', 300)
            ->requirePresence('sp1_value_gbp', 'create')
            ->notEmpty('sp1_value_gbp');

        $validator
            ->scalar('sp2_value_gbp')
            ->maxLength('sp2_value_gbp', 300)
            ->requirePresence('sp2_value_gbp', 'create')
            ->notEmpty('sp2_value_gbp');

        $validator
            ->scalar('sp3_value_gbp')
            ->maxLength('sp3_value_gbp', 300)
            ->requirePresence('sp3_value_gbp', 'create')
            ->notEmpty('sp3_value_gbp');

        $validator
            ->scalar('sale_price_gbp')
            ->maxLength('sale_price_gbp', 600)
            ->requirePresence('sale_price_gbp', 'create')
            ->notEmpty('sale_price_gbp');

        $validator
            ->scalar('landed_price_eur')
            ->maxLength('landed_price_eur', 300)
            ->requirePresence('landed_price_eur', 'create')
            ->notEmpty('landed_price_eur');

        $validator
            ->scalar('sp1_value_eur')
            ->maxLength('sp1_value_eur', 300)
            ->requirePresence('sp1_value_eur', 'create')
            ->notEmpty('sp1_value_eur');

        $validator
            ->scalar('sp2_value_eur')
            ->maxLength('sp2_value_eur', 300)
            ->requirePresence('sp2_value_eur', 'create')
            ->notEmpty('sp2_value_eur');

        $validator
            ->scalar('sp3_value_eur')
            ->maxLength('sp3_value_eur', 300)
            ->requirePresence('sp3_value_eur', 'create')
            ->notEmpty('sp3_value_eur');

        $validator
            ->scalar('sale_price_euro')
            ->maxLength('sale_price_euro', 600)
            ->requirePresence('sale_price_euro', 'create')
            ->notEmpty('sale_price_euro');

        $validator
            ->scalar('import_dates')
            ->maxLength('import_dates', 400)
            ->requirePresence('import_dates', 'create')
            ->notEmpty('import_dates');

        $validator
            ->scalar('error')
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
