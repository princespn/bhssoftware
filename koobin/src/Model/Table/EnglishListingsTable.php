<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnglishListings Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ExternalProductsTable|\Cake\ORM\Association\BelongsTo $ExternalProducts
 * @property \App\Model\Table\FulfillmentCentersTable|\Cake\ORM\Association\BelongsTo $FulfillmentCenters
 *
 * @method \App\Model\Entity\EnglishListing get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnglishListing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnglishListing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnglishListing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnglishListing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnglishListing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnglishListing findOrCreate($search, callable $callback = null, $options = [])
 */
class EnglishListingsTable extends Table
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

        $this->setTable('english_listings');
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('item_sku')
            ->maxLength('item_sku', 600)
            ->requirePresence('item_sku', 'create')
            ->notEmpty('item_sku')
            ->add('item_sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('external_product_id_type')
            ->maxLength('external_product_id_type', 100)
            ->allowEmpty('external_product_id_type');

        $validator
            ->scalar('item_name')
            ->maxLength('item_name', 900)
            ->allowEmpty('item_name');

        $validator
            ->scalar('brand_name')
            ->maxLength('brand_name', 700)
            ->allowEmpty('brand_name');

        $validator
            ->scalar('manufacturer')
            ->maxLength('manufacturer', 200)
            ->allowEmpty('manufacturer');

        $validator
            ->scalar('feed_product_type')
            ->maxLength('feed_product_type', 400)
            ->allowEmpty('feed_product_type');

        $validator
            ->scalar('part_number')
            ->maxLength('part_number', 500)
            ->allowEmpty('part_number');

        $validator
            ->scalar('product_description')
            ->allowEmpty('product_description');

        $validator
            ->scalar('update_delete')
            ->maxLength('update_delete', 100)
            ->allowEmpty('update_delete');

        $validator
            ->scalar('product_site_launch_date')
            ->maxLength('product_site_launch_date', 100)
            ->allowEmpty('product_site_launch_date');

        $validator
            ->scalar('standard_price')
            ->maxLength('standard_price', 100)
            ->allowEmpty('standard_price');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 100)
            ->allowEmpty('currency');

        $validator
            ->scalar('quantity')
            ->maxLength('quantity', 100)
            ->allowEmpty('quantity');

        $validator
            ->scalar('item_package_quantity')
            ->maxLength('item_package_quantity', 100)
            ->allowEmpty('item_package_quantity');

        $validator
            ->scalar('product_tax_code')
            ->maxLength('product_tax_code', 400)
            ->allowEmpty('product_tax_code');

        $validator
            ->scalar('merchant_release_date')
            ->maxLength('merchant_release_date', 100)
            ->allowEmpty('merchant_release_date');

        $validator
            ->scalar('sale_price')
            ->maxLength('sale_price', 200)
            ->allowEmpty('sale_price');

        $validator
            ->scalar('sale_from_date')
            ->maxLength('sale_from_date', 100)
            ->allowEmpty('sale_from_date');

        $validator
            ->scalar('sale_end_date')
            ->maxLength('sale_end_date', 100)
            ->allowEmpty('sale_end_date');

        $validator
            ->scalar('condition_type')
            ->maxLength('condition_type', 100)
            ->allowEmpty('condition_type');

        $validator
            ->scalar('condition_note')
            ->maxLength('condition_note', 900)
            ->allowEmpty('condition_note');

        $validator
            ->scalar('fulfillment_latency')
            ->maxLength('fulfillment_latency', 900)
            ->allowEmpty('fulfillment_latency');

        $validator
            ->scalar('restock_date')
            ->maxLength('restock_date', 100)
            ->allowEmpty('restock_date');

        $validator
            ->scalar('max_aggregate_ship_quantity')
            ->maxLength('max_aggregate_ship_quantity', 400)
            ->allowEmpty('max_aggregate_ship_quantity');

        $validator
            ->scalar('offering_can_be_gift_messaged')
            ->maxLength('offering_can_be_gift_messaged', 400)
            ->allowEmpty('offering_can_be_gift_messaged');

        $validator
            ->scalar('offering_can_be_giftwrapped')
            ->maxLength('offering_can_be_giftwrapped', 2000)
            ->allowEmpty('offering_can_be_giftwrapped');

        $validator
            ->scalar('is_discontinued_by_manufacturer')
            ->maxLength('is_discontinued_by_manufacturer', 100)
            ->allowEmpty('is_discontinued_by_manufacturer');

        $validator
            ->scalar('missing_keyset_reason')
            ->maxLength('missing_keyset_reason', 2000)
            ->allowEmpty('missing_keyset_reason');

        $validator
            ->scalar('website_shipping_weight')
            ->maxLength('website_shipping_weight', 2000)
            ->allowEmpty('website_shipping_weight');

        $validator
            ->scalar('website_shipping_weight_unit_of_measure')
            ->maxLength('website_shipping_weight_unit_of_measure', 2000)
            ->allowEmpty('website_shipping_weight_unit_of_measure');

        $validator
            ->scalar('item_display_length')
            ->maxLength('item_display_length', 2000)
            ->allowEmpty('item_display_length');

        $validator
            ->scalar('item_display_length_unit_of_measure')
            ->maxLength('item_display_length_unit_of_measure', 2000)
            ->allowEmpty('item_display_length_unit_of_measure');

        $validator
            ->scalar('item_display_width')
            ->maxLength('item_display_width', 400)
            ->allowEmpty('item_display_width');

        $validator
            ->scalar('item_display_width_unit_of_measure')
            ->maxLength('item_display_width_unit_of_measure', 400)
            ->allowEmpty('item_display_width_unit_of_measure');

        $validator
            ->scalar('item_display_height')
            ->maxLength('item_display_height', 200)
            ->allowEmpty('item_display_height');

        $validator
            ->scalar('item_display_height_unit_of_measure')
            ->maxLength('item_display_height_unit_of_measure', 200)
            ->allowEmpty('item_display_height_unit_of_measure');

        $validator
            ->scalar('item_display_depth')
            ->maxLength('item_display_depth', 300)
            ->allowEmpty('item_display_depth');

        $validator
            ->scalar('item_display_depth_unit_of_measure')
            ->maxLength('item_display_depth_unit_of_measure', 300)
            ->allowEmpty('item_display_depth_unit_of_measure');

        $validator
            ->scalar('item_display_diameter')
            ->maxLength('item_display_diameter', 900)
            ->allowEmpty('item_display_diameter');

        $validator
            ->scalar('item_display_diameter_unit_of_measure')
            ->maxLength('item_display_diameter_unit_of_measure', 900)
            ->allowEmpty('item_display_diameter_unit_of_measure');

        $validator
            ->scalar('item_display_weight')
            ->maxLength('item_display_weight', 900)
            ->allowEmpty('item_display_weight');

        $validator
            ->scalar('item_display_weight_unit_of_measure')
            ->maxLength('item_display_weight_unit_of_measure', 900)
            ->allowEmpty('item_display_weight_unit_of_measure');

        $validator
            ->scalar('volume_capacity_name')
            ->maxLength('volume_capacity_name', 900)
            ->allowEmpty('volume_capacity_name');

        $validator
            ->scalar('volume_capacity_name_unit_of_measure')
            ->maxLength('volume_capacity_name_unit_of_measure', 900)
            ->allowEmpty('volume_capacity_name_unit_of_measure');

        $validator
            ->scalar('item_display_volume')
            ->maxLength('item_display_volume', 900)
            ->allowEmpty('item_display_volume');

        $validator
            ->scalar('item_display_volume_unit_of_measure')
            ->maxLength('item_display_volume_unit_of_measure', 900)
            ->allowEmpty('item_display_volume_unit_of_measure');

        $validator
            ->scalar('recommended_browse_nodes1')
            ->maxLength('recommended_browse_nodes1', 900)
            ->allowEmpty('recommended_browse_nodes1');

        $validator
            ->scalar('recommended_browse_nodes2')
            ->maxLength('recommended_browse_nodes2', 900)
            ->allowEmpty('recommended_browse_nodes2');

        $validator
            ->scalar('catalog_number')
            ->maxLength('catalog_number', 900)
            ->allowEmpty('catalog_number');

        $validator
            ->scalar('bullet_point1')
            ->allowEmpty('bullet_point1');

        $validator
            ->scalar('bullet_point2')
            ->allowEmpty('bullet_point2');

        $validator
            ->scalar('bullet_point3')
            ->allowEmpty('bullet_point3');

        $validator
            ->scalar('bullet_point4')
            ->allowEmpty('bullet_point4');

        $validator
            ->scalar('bullet_point5')
            ->allowEmpty('bullet_point5');

        $validator
            ->scalar('generic_keywords1')
            ->allowEmpty('generic_keywords1');

        $validator
            ->scalar('generic_keywords2')
            ->allowEmpty('generic_keywords2');

        $validator
            ->scalar('generic_keywords3')
            ->allowEmpty('generic_keywords3');

        $validator
            ->scalar('generic_keywords4')
            ->allowEmpty('generic_keywords4');

        $validator
            ->scalar('generic_keywords5')
            ->allowEmpty('generic_keywords5');

        $validator
            ->scalar('platinum_keywords1')
            ->allowEmpty('platinum_keywords1');

        $validator
            ->scalar('platinum_keywords2')
            ->allowEmpty('platinum_keywords2');

        $validator
            ->scalar('platinum_keywords3')
            ->allowEmpty('platinum_keywords3');

        $validator
            ->scalar('platinum_keywords4')
            ->allowEmpty('platinum_keywords4');

        $validator
            ->scalar('platinum_keywords5')
            ->allowEmpty('platinum_keywords5');

        $validator
            ->scalar('target_audience_keywords1')
            ->allowEmpty('target_audience_keywords1');

        $validator
            ->scalar('target_audience_keywords2')
            ->allowEmpty('target_audience_keywords2');

        $validator
            ->scalar('target_audience_keywords3')
            ->allowEmpty('target_audience_keywords3');

        $validator
            ->scalar('target_audience_keywords4')
            ->allowEmpty('target_audience_keywords4');

        $validator
            ->scalar('target_audience_keywords5')
            ->allowEmpty('target_audience_keywords5');

        $validator
            ->scalar('main_image_url')
            ->maxLength('main_image_url', 200)
            ->allowEmpty('main_image_url');

        $validator
            ->scalar('swatch_image_url')
            ->maxLength('swatch_image_url', 200)
            ->allowEmpty('swatch_image_url');

        $validator
            ->scalar('other_image_url1')
            ->maxLength('other_image_url1', 200)
            ->allowEmpty('other_image_url1');

        $validator
            ->scalar('other_image_url2')
            ->maxLength('other_image_url2', 200)
            ->allowEmpty('other_image_url2');

        $validator
            ->scalar('other_image_url3')
            ->maxLength('other_image_url3', 100)
            ->allowEmpty('other_image_url3');

        $validator
            ->scalar('other_image_url4')
            ->maxLength('other_image_url4', 100)
            ->allowEmpty('other_image_url4');

        $validator
            ->scalar('other_image_url5')
            ->maxLength('other_image_url5', 100)
            ->allowEmpty('other_image_url5');

        $validator
            ->scalar('other_image_url6')
            ->maxLength('other_image_url6', 100)
            ->allowEmpty('other_image_url6');

        $validator
            ->scalar('other_image_url7')
            ->maxLength('other_image_url7', 100)
            ->allowEmpty('other_image_url7');

        $validator
            ->scalar('other_image_url8')
            ->maxLength('other_image_url8', 100)
            ->allowEmpty('other_image_url8');

        $validator
            ->scalar('package_length')
            ->maxLength('package_length', 100)
            ->allowEmpty('package_length');

        $validator
            ->scalar('package_width')
            ->maxLength('package_width', 100)
            ->allowEmpty('package_width');

        $validator
            ->scalar('package_height')
            ->maxLength('package_height', 100)
            ->allowEmpty('package_height');

        $validator
            ->scalar('package_length_unit_of_measure')
            ->maxLength('package_length_unit_of_measure', 100)
            ->allowEmpty('package_length_unit_of_measure');

        $validator
            ->scalar('parent_child')
            ->maxLength('parent_child', 300)
            ->allowEmpty('parent_child');

        $validator
            ->scalar('parent_sku')
            ->maxLength('parent_sku', 200)
            ->allowEmpty('parent_sku');

        $validator
            ->scalar('relationship_type')
            ->maxLength('relationship_type', 300)
            ->allowEmpty('relationship_type');

        $validator
            ->scalar('variation_theme')
            ->maxLength('variation_theme', 400)
            ->allowEmpty('variation_theme');

        $validator
            ->scalar('eu_toys_safety_directive_age_warning')
            ->allowEmpty('eu_toys_safety_directive_age_warning');

        $validator
            ->scalar('eu_toys_safety_directive_warning1')
            ->maxLength('eu_toys_safety_directive_warning1', 400)
            ->allowEmpty('eu_toys_safety_directive_warning1');

        $validator
            ->scalar('eu_toys_safety_directive_warning2')
            ->maxLength('eu_toys_safety_directive_warning2', 400)
            ->allowEmpty('eu_toys_safety_directive_warning2');

        $validator
            ->scalar('eu_toys_safety_directive_warning3')
            ->maxLength('eu_toys_safety_directive_warning3', 400)
            ->allowEmpty('eu_toys_safety_directive_warning3');

        $validator
            ->scalar('eu_toys_safety_directive_warning4')
            ->maxLength('eu_toys_safety_directive_warning4', 400)
            ->allowEmpty('eu_toys_safety_directive_warning4');

        $validator
            ->scalar('eu_toys_safety_directive_warning5')
            ->maxLength('eu_toys_safety_directive_warning5', 400)
            ->allowEmpty('eu_toys_safety_directive_warning5');

        $validator
            ->scalar('eu_toys_safety_directive_warning6')
            ->maxLength('eu_toys_safety_directive_warning6', 400)
            ->allowEmpty('eu_toys_safety_directive_warning6');

        $validator
            ->scalar('eu_toys_safety_directive_warning7')
            ->maxLength('eu_toys_safety_directive_warning7', 400)
            ->allowEmpty('eu_toys_safety_directive_warning7');

        $validator
            ->scalar('eu_toys_safety_directive_warning8')
            ->maxLength('eu_toys_safety_directive_warning8', 400)
            ->allowEmpty('eu_toys_safety_directive_warning8');

        $validator
            ->scalar('color_name')
            ->maxLength('color_name', 400)
            ->allowEmpty('color_name');

        $validator
            ->scalar('color_map')
            ->maxLength('color_map', 500)
            ->allowEmpty('color_map');

        $validator
            ->scalar('size_name')
            ->maxLength('size_name', 400)
            ->allowEmpty('size_name');

        $validator
            ->scalar('warranty_description')
            ->allowEmpty('warranty_description');

        $validator
            ->scalar('number_of_pieces')
            ->maxLength('number_of_pieces', 100)
            ->allowEmpty('number_of_pieces');

        $validator
            ->scalar('material_type1')
            ->maxLength('material_type1', 300)
            ->allowEmpty('material_type1');

        $validator
            ->scalar('material_type2')
            ->maxLength('material_type2', 300)
            ->allowEmpty('material_type2');

        $validator
            ->scalar('material_type3')
            ->maxLength('material_type3', 200)
            ->allowEmpty('material_type3');

        $validator
            ->scalar('material_type4')
            ->maxLength('material_type4', 200)
            ->allowEmpty('material_type4');

        $validator
            ->scalar('material_type5')
            ->maxLength('material_type5', 100)
            ->allowEmpty('material_type5');

        $validator
            ->scalar('material_type6')
            ->maxLength('material_type6', 100)
            ->allowEmpty('material_type6');

        $validator
            ->scalar('material_type7')
            ->maxLength('material_type7', 100)
            ->allowEmpty('material_type7');

        $validator
            ->scalar('material_type8')
            ->maxLength('material_type8', 100)
            ->allowEmpty('material_type8');

        $validator
            ->scalar('special_features1')
            ->maxLength('special_features1', 300)
            ->allowEmpty('special_features1');

        $validator
            ->scalar('special_features2')
            ->maxLength('special_features2', 300)
            ->allowEmpty('special_features2');

        $validator
            ->scalar('special_features3')
            ->maxLength('special_features3', 300)
            ->allowEmpty('special_features3');

        $validator
            ->scalar('special_features4')
            ->maxLength('special_features4', 300)
            ->allowEmpty('special_features4');

        $validator
            ->scalar('special_features5')
            ->maxLength('special_features5', 300)
            ->allowEmpty('special_features5');

        $validator
            ->scalar('error')
            ->maxLength('error', 4000)
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
        $rules->add($rules->isUnique(['item_sku']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['external_product_id'], 'ExternalProducts'));
        $rules->add($rules->existsIn(['fulfillment_center_id'], 'FulfillmentCenters'));

        return $rules;
    }
}
