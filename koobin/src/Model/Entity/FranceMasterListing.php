<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FranceMasterListing Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $item_sku
 * @property string $external_product_id
 * @property string $external_product_id_type
 * @property string $item_name
 * @property string $brand_name
 * @property string $manufacturer
 * @property string $feed_product_type
 * @property string $part_number
 * @property string $product_description
 * @property string $update_delete
 * @property string $product_site_launch_date
 * @property string $standard_price
 * @property string $currency
 * @property string $quantity
 * @property string $item_package_quantity
 * @property string $product_tax_code
 * @property string $merchant_release_date
 * @property string $sale_price
 * @property string $sale_from_date
 * @property string $sale_end_date
 * @property string $condition_type
 * @property string $condition_note
 * @property string $fulfillment_latency
 * @property string $restock_date
 * @property string $max_aggregate_ship_quantity
 * @property string $offering_can_be_gift_messaged
 * @property string $offering_can_be_giftwrapped
 * @property string $is_discontinued_by_manufacturer
 * @property string $missing_keyset_reason
 * @property string $weee_tax_value
 * @property string $weee_tax_value_unit_of_measure
 * @property string $merchant_shipping_group_name
 * @property string $website_shipping_weight
 * @property string $website_shipping_weight_unit_of_measure
 * @property string $item_display_length
 * @property string $item_display_length_unit_of_measure
 * @property string $item_display_width
 * @property string $item_display_width_unit_of_measure
 * @property string $item_display_height
 * @property string $item_display_height_unit_of_measure
 * @property string $item_display_depth
 * @property string $item_display_depth_unit_of_measure
 * @property string $item_display_diameter
 * @property string $item_display_diameter_unit_of_measure
 * @property string $item_display_weight
 * @property string $item_display_weight_unit_of_measure
 * @property string $volume_capacity_name
 * @property string $volume_capacity_name_unit_of_measure
 * @property string $item_display_volume
 * @property string $item_display_volume_unit_of_measure
 * @property string $recommended_browse_nodes1
 * @property string $recommended_browse_nodes2
 * @property string $catalog_number
 * @property string $bullet_point1
 * @property string $bullet_point2
 * @property string $bullet_point3
 * @property string $bullet_point4
 * @property string $bullet_point5
 * @property string $generic_keywords1
 * @property string $generic_keywords2
 * @property string $generic_keywords3
 * @property string $generic_keywords4
 * @property string $generic_keywords5
 * @property string $platinum_keywords1
 * @property string $platinum_keywords2
 * @property string $platinum_keywords3
 * @property string $platinum_keywords4
 * @property string $platinum_keywords5
 * @property string $target_audience_keywords1
 * @property string $target_audience_keywords2
 * @property string $target_audience_keywords3
 * @property string $target_audience_keywords4
 * @property string $target_audience_keywords5
 * @property string $main_image_url
 * @property string $swatch_image_url
 * @property string $other_image_url1
 * @property string $other_image_url2
 * @property string $other_image_url3
 * @property string $other_image_url4
 * @property string $other_image_url5
 * @property string $other_image_url6
 * @property string $other_image_url7
 * @property string $other_image_url8
 * @property string $package_length
 * @property string $package_width
 * @property string $package_height
 * @property string $package_length_unit_of_measure
 * @property string $fulfillment_center_id
 * @property string $parent_child
 * @property string $parent_sku
 * @property string $relationship_type
 * @property string $variation_theme
 * @property string $eu_toys_safety_directive_age_warning
 * @property string $eu_toys_safety_directive_warning1
 * @property string $eu_toys_safety_directive_warning2
 * @property string $eu_toys_safety_directive_warning3
 * @property string $eu_toys_safety_directive_warning4
 * @property string $eu_toys_safety_directive_warning5
 * @property string $eu_toys_safety_directive_warning6
 * @property string $eu_toys_safety_directive_warning7
 * @property string $eu_toys_safety_directive_warning8
 * @property string $eu_toys_safety_directive_language1
 * @property string $eu_toys_safety_directive_language2
 * @property string $eu_toys_safety_directive_language3
 * @property string $eu_toys_safety_directive_language4
 * @property string $eu_toys_safety_directive_language5
 * @property string $eu_toys_safety_directive_language6
 * @property string $eu_toys_safety_directive_language7
 * @property string $eu_toys_safety_directive_language8
 * @property string $country_string
 * @property string $safety_warning
 * @property string $energy_efficiency_image_url
 * @property string $product_efficiency_image_url
 * @property string $is_stain_resistant
 * @property string $color_name
 * @property string $color_map
 * @property string $size_name
 * @property string $warranty_description
 * @property string $number_of_sets
 * @property string $wattage
 * @property string $material_type1
 * @property string $material_type2
 * @property string $material_type3
 * @property string $material_type4
 * @property string $material_type5
 * @property string $material_type6
 * @property string $material_type7
 * @property string $material_type8
 * @property string $special_features1
 * @property string $special_features2
 * @property string $special_features3
 * @property string $special_features4
 * @property string $special_features5
 * @property string $seating_capacity
 * @property string $pattern_name
 * @property string $paper_size
 * @property string $paint_type
 * @property string $occasion_type1
 * @property string $occasion_type2
 * @property string $occasion_type3
 * @property string $occasion_type4
 * @property string $occasion_type5
 * @property string $number_of_doors
 * @property string $material_composition
 * @property string $line_weight
 * @property string $item_type_name
 * @property string $item_styling
 * @property string $item_shape
 * @property string $item_hardness
 * @property string $installation_type
 * @property string $included_components1
 * @property string $included_components2
 * @property string $included_components3
 * @property string $included_components4
 * @property string $included_components5
 * @property string $included_components6
 * @property string $included_components7
 * @property string $included_components8
 * @property string $included_components9
 * @property string $included_components10
 * @property string $frame_type
 * @property string $form_factor
 * @property string $finish_type1
 * @property string $finish_type2
 * @property string $finish_type3
 * @property string $finish_type4
 * @property string $finish_type5
 * @property string $adjustment_type
 * @property string $are_batteries_included
 * @property string $batteries_required
 * @property string $battery_type
 * @property string $number_of_batteries
 * @property string $efficiency
 * @property string $thermal_performance_description
 * @property string $error
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ExternalProduct $external_product
 * @property \App\Model\Entity\FulfillmentCenter $fulfillment_center
 */
class FranceMasterListing extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'item_sku' => true,
        'external_product_id' => true,
        'external_product_id_type' => true,
        'item_name' => true,
        'brand_name' => true,
        'manufacturer' => true,
        'feed_product_type' => true,
        'part_number' => true,
        'product_description' => true,
        'update_delete' => true,
        'product_site_launch_date' => true,
        'standard_price' => true,
        'currency' => true,
        'quantity' => true,
        'item_package_quantity' => true,
        'product_tax_code' => true,
        'merchant_release_date' => true,
        'sale_price' => true,
        'sale_from_date' => true,
        'sale_end_date' => true,
        'condition_type' => true,
        'condition_note' => true,
        'fulfillment_latency' => true,
        'restock_date' => true,
        'max_aggregate_ship_quantity' => true,
        'offering_can_be_gift_messaged' => true,
        'offering_can_be_giftwrapped' => true,
        'is_discontinued_by_manufacturer' => true,
        'missing_keyset_reason' => true,
        'weee_tax_value' => true,
        'weee_tax_value_unit_of_measure' => true,
        'merchant_shipping_group_name' => true,
        'website_shipping_weight' => true,
        'website_shipping_weight_unit_of_measure' => true,
        'item_display_length' => true,
        'item_display_length_unit_of_measure' => true,
        'item_display_width' => true,
        'item_display_width_unit_of_measure' => true,
        'item_display_height' => true,
        'item_display_height_unit_of_measure' => true,
        'item_display_depth' => true,
        'item_display_depth_unit_of_measure' => true,
        'item_display_diameter' => true,
        'item_display_diameter_unit_of_measure' => true,
        'item_display_weight' => true,
        'item_display_weight_unit_of_measure' => true,
        'volume_capacity_name' => true,
        'volume_capacity_name_unit_of_measure' => true,
        'item_display_volume' => true,
        'item_display_volume_unit_of_measure' => true,
        'recommended_browse_nodes1' => true,
        'recommended_browse_nodes2' => true,
        'catalog_number' => true,
        'bullet_point1' => true,
        'bullet_point2' => true,
        'bullet_point3' => true,
        'bullet_point4' => true,
        'bullet_point5' => true,
        'generic_keywords1' => true,
        'generic_keywords2' => true,
        'generic_keywords3' => true,
        'generic_keywords4' => true,
        'generic_keywords5' => true,
        'platinum_keywords1' => true,
        'platinum_keywords2' => true,
        'platinum_keywords3' => true,
        'platinum_keywords4' => true,
        'platinum_keywords5' => true,
        'target_audience_keywords1' => true,
        'target_audience_keywords2' => true,
        'target_audience_keywords3' => true,
        'target_audience_keywords4' => true,
        'target_audience_keywords5' => true,
        'main_image_url' => true,
        'swatch_image_url' => true,
        'other_image_url1' => true,
        'other_image_url2' => true,
        'other_image_url3' => true,
        'other_image_url4' => true,
        'other_image_url5' => true,
        'other_image_url6' => true,
        'other_image_url7' => true,
        'other_image_url8' => true,
        'package_length' => true,
        'package_width' => true,
        'package_height' => true,
        'package_length_unit_of_measure' => true,
        'fulfillment_center_id' => true,
        'parent_child' => true,
        'parent_sku' => true,
        'relationship_type' => true,
        'variation_theme' => true,
        'eu_toys_safety_directive_age_warning' => true,
        'eu_toys_safety_directive_warning1' => true,
        'eu_toys_safety_directive_warning2' => true,
        'eu_toys_safety_directive_warning3' => true,
        'eu_toys_safety_directive_warning4' => true,
        'eu_toys_safety_directive_warning5' => true,
        'eu_toys_safety_directive_warning6' => true,
        'eu_toys_safety_directive_warning7' => true,
        'eu_toys_safety_directive_warning8' => true,
        'eu_toys_safety_directive_language1' => true,
        'eu_toys_safety_directive_language2' => true,
        'eu_toys_safety_directive_language3' => true,
        'eu_toys_safety_directive_language4' => true,
        'eu_toys_safety_directive_language5' => true,
        'eu_toys_safety_directive_language6' => true,
        'eu_toys_safety_directive_language7' => true,
        'eu_toys_safety_directive_language8' => true,
        'country_string' => true,
        'safety_warning' => true,
        'energy_efficiency_image_url' => true,
        'product_efficiency_image_url' => true,
        'is_stain_resistant' => true,
        'color_name' => true,
        'color_map' => true,
        'size_name' => true,
        'warranty_description' => true,
        'number_of_sets' => true,
        'wattage' => true,
        'material_type1' => true,
        'material_type2' => true,
        'material_type3' => true,
        'material_type4' => true,
        'material_type5' => true,
        'material_type6' => true,
        'material_type7' => true,
        'material_type8' => true,
        'special_features1' => true,
        'special_features2' => true,
        'special_features3' => true,
        'special_features4' => true,
        'special_features5' => true,
        'seating_capacity' => true,
        'pattern_name' => true,
        'paper_size' => true,
        'paint_type' => true,
        'occasion_type1' => true,
        'occasion_type2' => true,
        'occasion_type3' => true,
        'occasion_type4' => true,
        'occasion_type5' => true,
        'number_of_doors' => true,
        'material_composition' => true,
        'line_weight' => true,
        'item_type_name' => true,
        'item_styling' => true,
        'item_shape' => true,
        'item_hardness' => true,
        'installation_type' => true,
        'included_components1' => true,
        'included_components2' => true,
        'included_components3' => true,
        'included_components4' => true,
        'included_components5' => true,
        'included_components6' => true,
        'included_components7' => true,
        'included_components8' => true,
        'included_components9' => true,
        'included_components10' => true,
        'frame_type' => true,
        'form_factor' => true,
        'finish_type1' => true,
        'finish_type2' => true,
        'finish_type3' => true,
        'finish_type4' => true,
        'finish_type5' => true,
        'adjustment_type' => true,
        'are_batteries_included' => true,
        'batteries_required' => true,
        'battery_type' => true,
        'number_of_batteries' => true,
        'efficiency' => true,
        'thermal_performance_description' => true,
        'error' => true,
        'user' => true,
        'external_product' => true,
        'fulfillment_center' => true
    ];
}
