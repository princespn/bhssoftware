<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FranceListings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ExternalProducts
 * @property \Cake\ORM\Association\BelongsTo $FulfillmentCenters
 *
 * @method \App\Model\Entity\FranceListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\FranceListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FranceListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FranceListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FranceListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FranceListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FranceListing findOrCreate($search, callable $callback = null, $options = [])
 */
class FranceListingsTable extends Table
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

        $this->setTable('france_listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('ExternalProducts', [
            'foreignKey' => 'external_product_id'
        ]);
        $this->belongsTo('FulfillmentCenters', [
            'foreignKey' => 'fulfillment_center_id'
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
            ->requirePresence('item_sku', 'create')
            ->notEmpty('item_sku')
            ->add('item_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('external_product_id_type');

        $validator
            ->allowEmpty('item_name');

        $validator
            ->allowEmpty('brand_name');

        $validator
            ->allowEmpty('manufacturer');

        $validator
            ->allowEmpty('feed_product_type');

        $validator
            ->allowEmpty('part_number');

        $validator
            ->allowEmpty('product_description');

        $validator
            ->allowEmpty('update_delete');

        $validator
            ->allowEmpty('product_site_launch_date');

        $validator
            ->allowEmpty('standard_price');

        $validator
            ->allowEmpty('currency');

        $validator
            ->allowEmpty('quantity');

        $validator
            ->allowEmpty('item_package_quantity');

        $validator
            ->allowEmpty('product_tax_code');

        $validator
            ->allowEmpty('merchant_release_date');

        $validator
            ->allowEmpty('sale_price');

        $validator
            ->allowEmpty('sale_from_date');

        $validator
            ->allowEmpty('sale_end_date');

        $validator
            ->allowEmpty('condition_type');

        $validator
            ->allowEmpty('condition_note');

        $validator
            ->allowEmpty('fulfillment_latency');

        $validator
            ->allowEmpty('restock_date');

        $validator
            ->allowEmpty('max_aggregate_ship_quantity');

        $validator
            ->allowEmpty('offering_can_be_gift_messaged');

        $validator
            ->allowEmpty('offering_can_be_giftwrapped');

        $validator
            ->allowEmpty('is_discontinued_by_manufacturer');

        $validator
            ->allowEmpty('missing_keyset_reason');

        $validator
            ->allowEmpty('weee_tax_value');

        $validator
            ->allowEmpty('weee_tax_value_unit_of_measure');

        $validator
            ->allowEmpty('merchant_shipping_group_name');

        $validator
            ->allowEmpty('website_shipping_weight');

        $validator
            ->allowEmpty('website_shipping_weight_unit_of_measure');

        $validator
            ->allowEmpty('item_display_length');

        $validator
            ->allowEmpty('item_display_length_unit_of_measure');

        $validator
            ->allowEmpty('item_display_width');

        $validator
            ->allowEmpty('item_display_width_unit_of_measure');

        $validator
            ->allowEmpty('item_display_height');

        $validator
            ->allowEmpty('item_display_height_unit_of_measure');

        $validator
            ->allowEmpty('item_display_depth');

        $validator
            ->allowEmpty('item_display_depth_unit_of_measure');

        $validator
            ->allowEmpty('item_display_diameter');

        $validator
            ->allowEmpty('item_display_diameter_unit_of_measure');

        $validator
            ->allowEmpty('item_display_weight');

        $validator
            ->allowEmpty('item_display_weight_unit_of_measure');

        $validator
            ->allowEmpty('volume_capacity_name');

        $validator
            ->allowEmpty('volume_capacity_name_unit_of_measure');

        $validator
            ->allowEmpty('item_display_volume');

        $validator
            ->allowEmpty('item_display_volume_unit_of_measure');

        $validator
            ->allowEmpty('recommended_browse_nodes1');

        $validator
            ->allowEmpty('recommended_browse_nodes2');

        $validator
            ->allowEmpty('catalog_number');

        $validator
            ->allowEmpty('bullet_point1');

        $validator
            ->allowEmpty('bullet_point2');

        $validator
            ->allowEmpty('bullet_point3');

        $validator
            ->allowEmpty('bullet_point4');

        $validator
            ->allowEmpty('bullet_point5');

        $validator
            ->allowEmpty('generic_keywords1');

        $validator
            ->allowEmpty('generic_keywords2');

        $validator
            ->allowEmpty('generic_keywords3');

        $validator
            ->allowEmpty('generic_keywords4');

        $validator
            ->allowEmpty('generic_keywords5');

        $validator
            ->allowEmpty('platinum_keywords1');

        $validator
            ->allowEmpty('platinum_keywords2');

        $validator
            ->allowEmpty('platinum_keywords3');

        $validator
            ->allowEmpty('platinum_keywords4');

        $validator
            ->allowEmpty('platinum_keywords5');

        $validator
            ->allowEmpty('target_audience_keywords1');

        $validator
            ->allowEmpty('target_audience_keywords2');

        $validator
            ->allowEmpty('target_audience_keywords3');

        $validator
            ->allowEmpty('target_audience_keywords4');

        $validator
            ->allowEmpty('target_audience_keywords5');

        $validator
            ->allowEmpty('main_image_url');

        $validator
            ->allowEmpty('swatch_image_url');

        $validator
            ->allowEmpty('other_image_url1');

        $validator
            ->allowEmpty('other_image_url2');

        $validator
            ->allowEmpty('other_image_url3');

        $validator
            ->allowEmpty('other_image_url4');

        $validator
            ->allowEmpty('other_image_url5');

        $validator
            ->allowEmpty('other_image_url6');

        $validator
            ->allowEmpty('other_image_url7');

        $validator
            ->allowEmpty('other_image_url8');

        $validator
            ->allowEmpty('package_length');

        $validator
            ->allowEmpty('package_width');

        $validator
            ->allowEmpty('package_height');

        $validator
            ->allowEmpty('package_length_unit_of_measure');

        $validator
            ->allowEmpty('parent_child');

        $validator
            ->allowEmpty('parent_sku');

        $validator
            ->allowEmpty('relationship_type');

        $validator
            ->allowEmpty('variation_theme');

        $validator
            ->allowEmpty('eu_toys_safety_directive_age_warning');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning1');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning2');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning3');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning4');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning5');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning6');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning7');

        $validator
            ->allowEmpty('eu_toys_safety_directive_warning8');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language1');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language2');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language3');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language4');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language5');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language6');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language7');

        $validator
            ->allowEmpty('eu_toys_safety_directive_language8');

        $validator
            ->allowEmpty('country_string');

        $validator
            ->allowEmpty('safety_warning');

        $validator
            ->allowEmpty('energy_efficiency_image_url');

        $validator
            ->allowEmpty('product_efficiency_image_url');

        $validator
            ->allowEmpty('is_stain_resistant');

        $validator
            ->allowEmpty('color_name');

        $validator
            ->allowEmpty('color_map');

        $validator
            ->allowEmpty('size_name');

        $validator
            ->allowEmpty('warranty_description');

        $validator
            ->allowEmpty('number_of_sets');

        $validator
            ->allowEmpty('wattage');

        $validator
            ->allowEmpty('material_type1');

        $validator
            ->allowEmpty('material_type2');

        $validator
            ->allowEmpty('material_type3');

        $validator
            ->allowEmpty('material_type4');

        $validator
            ->allowEmpty('material_type5');

        $validator
            ->allowEmpty('material_type6');

        $validator
            ->allowEmpty('material_type7');

        $validator
            ->allowEmpty('material_type8');

        $validator
            ->allowEmpty('special_features1');

        $validator
            ->allowEmpty('special_features2');

        $validator
            ->allowEmpty('special_features3');

        $validator
            ->allowEmpty('special_features4');

        $validator
            ->allowEmpty('special_features5');

        $validator
            ->allowEmpty('seating_capacity');

        $validator
            ->allowEmpty('pattern_name');

        $validator
            ->allowEmpty('paper_size');

        $validator
            ->allowEmpty('paint_type');

        $validator
            ->allowEmpty('occasion_type1');

        $validator
            ->allowEmpty('occasion_type2');

        $validator
            ->allowEmpty('occasion_type3');

        $validator
            ->allowEmpty('occasion_type4');

        $validator
            ->allowEmpty('occasion_type5');

        $validator
            ->allowEmpty('number_of_doors');

        $validator
            ->allowEmpty('material_composition');

        $validator
            ->allowEmpty('line_weight');

        $validator
            ->allowEmpty('item_type_name');

        $validator
            ->allowEmpty('item_styling');

        $validator
            ->allowEmpty('item_shape');

        $validator
            ->allowEmpty('item_hardness');

        $validator
            ->allowEmpty('installation_type');

        $validator
            ->allowEmpty('included_components1');

        $validator
            ->allowEmpty('included_components2');

        $validator
            ->allowEmpty('included_components3');

        $validator
            ->allowEmpty('included_components4');

        $validator
            ->allowEmpty('included_components5');

        $validator
            ->allowEmpty('included_components6');

        $validator
            ->allowEmpty('included_components7');

        $validator
            ->allowEmpty('included_components8');

        $validator
            ->allowEmpty('included_components9');

        $validator
            ->allowEmpty('included_components10');

        $validator
            ->allowEmpty('frame_type');

        $validator
            ->allowEmpty('form_factor');

        $validator
            ->allowEmpty('finish_type1');

        $validator
            ->allowEmpty('finish_type2');

        $validator
            ->allowEmpty('finish_type3');

        $validator
            ->allowEmpty('finish_type4');

        $validator
            ->allowEmpty('finish_type5');

        $validator
            ->allowEmpty('adjustment_type');

        $validator
            ->allowEmpty('are_batteries_included');

        $validator
            ->allowEmpty('batteries_required');

        $validator
            ->allowEmpty('battery_type');

        $validator
            ->allowEmpty('number_of_batteries');

        $validator
            ->allowEmpty('efficiency');

        $validator
            ->allowEmpty('thermal_performance_description');

        $validator
            ->allowEmpty('error');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->isUnique(['item_sku']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['external_product_id'], 'ExternalProducts'));
        $rules->add($rules->existsIn(['fulfillment_center_id'], 'FulfillmentCenters'));

        return $rules;
    }
}
