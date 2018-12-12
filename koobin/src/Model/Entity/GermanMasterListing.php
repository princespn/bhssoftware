<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GermanMasterListing Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $item_sku
 * @property string $item_name
 * @property string $external_product_id
 * @property string $external_product_id_type
 * @property string $feed_product_type
 * @property string $brand_name
 * @property string $manufacturer
 * @property string $part_number
 * @property string $product_description
 * @property string $update_delete
 * @property string $quantity
 * @property string $standard_price
 * @property string $currency
 * @property string $condition_type
 * @property string $condition_note
 * @property string $product_site_launch_date
 * @property string $fulfillment_latency
 * @property string $merchant_release_date
 * @property string $restock_date
 * @property string $sale_price
 * @property string $sale_from_date
 * @property string $sale_end_date
 * @property string $max_aggregate_ship_quantity
 * @property string $max_order_quantity
 * @property string $offering_can_be_gift_messaged
 * @property string $offering_can_be_giftwrapped
 * @property string $missing_keyset_reason
 * @property string $is_discontinued_by_manufacturer
 * @property string $item_package_quantity
 * @property string $product_tax_code
 * @property string $delivery_schedule_group_id
 * @property string $merchant_shipping_group_name
 * @property string $website_shipping_weight
 * @property string $website_shipping_weight_unit_of_measure
 * @property string $item_weight
 * @property string $item_weight_unit_of_measure
 * @property string $item_length
 * @property string $item_length_unit_of_measure
 * @property string $item_width
 * @property string $item_width_unit_of_measure
 * @property string $item_height
 * @property string $item_height_unit_of_measure
 * @property string $item_display_depth
 * @property string $item_display_depth_unit_of_measure
 * @property string $item_display_diameter
 * @property string $item_display_diameter_unit_of_measure
 * @property string $bullet_point1
 * @property string $bullet_point2
 * @property string $bullet_point3
 * @property string $bullet_point4
 * @property string $bullet_point5
 * @property string $recommended_browse_nodes1
 * @property string $recommended_browse_nodes2
 * @property string $generic_keywords1
 * @property string $generic_keywords2
 * @property string $generic_keywords3
 * @property string $generic_keywords4
 * @property string $generic_keywords5
 * @property string $catalog_number
 * @property string $platinum_keywords1
 * @property string $platinum_keywords2
 * @property string $platinum_keywords3
 * @property string $platinum_keywords4
 * @property string $platinum_keywords5
 * @property string $target_audience_keywords
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
 * @property string $fulfillment_center_id
 * @property string $package_length
 * @property string $package_width
 * @property string $package_height
 * @property string $package_length_unit_of_measure
 * @property string $package_weight
 * @property string $package_weight_unit_of_measure
 * @property string $relationship_type
 * @property string $parent_child
 * @property string $parent_sku
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
 * @property string $legal_disclaimer_description
 * @property string $fedas_id
 * @property string $country_string
 * @property string $energy_efficiency_image_url
 * @property string $product_efficiency_image_url
 * @property string $number_of_pieces
 * @property string $warranty_description
 * @property string $scent_name
 * @property string $is_stain_resistant
 * @property string $color_name
 * @property string $size_name
 * @property string $thread_count
 * @property string $material_type
 * @property string $number_of_sets
 * @property string $wattage
 * @property string $unit_count
 * @property string $unit_count_type
 * @property string $thermal_performance_description
 * @property string $special_features
 * @property string $seasons1
 * @property string $seasons2
 * @property string $seasons3
 * @property string $seasons4
 * @property string $outer_material_type1
 * @property string $outer_material_type2
 * @property string $outer_material_type3
 * @property string $outer_material_type4
 * @property string $outer_material_type5
 * @property string $occupancy
 * @property string $mfg_minimum
 * @property string $material_composition
 * @property string $item_type_name
 * @property string $item_thickness_derived
 * @property string $item_thickness_unit_of_measure
 * @property string $item_shape
 * @property string $inner_material_type
 * @property string $capacity
 * @property string $capacity_unit_of_measure
 * @property string $are_batteries_included
 * @property string $batteries_required
 * @property string $battery_type1
 * @property string $battery_type2
 * @property string $battery_type3
 * @property string $number_of_batteries1
 * @property string $number_of_batteries2
 * @property string $number_of_batteries3
 * @property string $efficiency
 * @property string $theme
 * @property string $style_name
 * @property string $specific_uses_for_product
 * @property string $seating_capacity
 * @property string $pattern_name
 * @property string $paper_size
 * @property string $paint_type
 * @property string $occasion_type
 * @property string $number_of_doors
 * @property string $line_weight
 * @property string $item_styling
 * @property string $item_hardness
 * @property string $adjustment_type
 * @property string $installation_type
 * @property string $included_components
 * @property string $frame_type
 * @property string $form_factor
 * @property string $error
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ExternalProduct $external_product
 * @property \App\Model\Entity\DeliveryScheduleGroup $delivery_schedule_group
 * @property \App\Model\Entity\FulfillmentCenter $fulfillment_center
 * @property \App\Model\Entity\Feda $feda
 */
class GermanMasterListing extends Entity
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
        'item_name' => true,
        'external_product_id' => true,
        'external_product_id_type' => true,
        'feed_product_type' => true,
        'brand_name' => true,
        'manufacturer' => true,
        'part_number' => true,
        'product_description' => true,
        'update_delete' => true,
        'quantity' => true,
        'standard_price' => true,
        'currency' => true,
        'condition_type' => true,
        'condition_note' => true,
        'product_site_launch_date' => true,
        'fulfillment_latency' => true,
        'merchant_release_date' => true,
        'restock_date' => true,
        'sale_price' => true,
        'sale_from_date' => true,
        'sale_end_date' => true,
        'max_aggregate_ship_quantity' => true,
        'max_order_quantity' => true,
        'offering_can_be_gift_messaged' => true,
        'offering_can_be_giftwrapped' => true,
        'missing_keyset_reason' => true,
        'is_discontinued_by_manufacturer' => true,
        'item_package_quantity' => true,
        'product_tax_code' => true,
        'delivery_schedule_group_id' => true,
        'merchant_shipping_group_name' => true,
        'website_shipping_weight' => true,
        'website_shipping_weight_unit_of_measure' => true,
        'item_weight' => true,
        'item_weight_unit_of_measure' => true,
        'item_length' => true,
        'item_length_unit_of_measure' => true,
        'item_width' => true,
        'item_width_unit_of_measure' => true,
        'item_height' => true,
        'item_height_unit_of_measure' => true,
        'item_display_depth' => true,
        'item_display_depth_unit_of_measure' => true,
        'item_display_diameter' => true,
        'item_display_diameter_unit_of_measure' => true,
        'bullet_point1' => true,
        'bullet_point2' => true,
        'bullet_point3' => true,
        'bullet_point4' => true,
        'bullet_point5' => true,
        'recommended_browse_nodes1' => true,
        'recommended_browse_nodes2' => true,
        'generic_keywords1' => true,
        'generic_keywords2' => true,
        'generic_keywords3' => true,
        'generic_keywords4' => true,
        'generic_keywords5' => true,
        'catalog_number' => true,
        'platinum_keywords1' => true,
        'platinum_keywords2' => true,
        'platinum_keywords3' => true,
        'platinum_keywords4' => true,
        'platinum_keywords5' => true,
        'target_audience_keywords' => true,
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
        'fulfillment_center_id' => true,
        'package_length' => true,
        'package_width' => true,
        'package_height' => true,
        'package_length_unit_of_measure' => true,
        'package_weight' => true,
        'package_weight_unit_of_measure' => true,
        'relationship_type' => true,
        'parent_child' => true,
        'parent_sku' => true,
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
        'legal_disclaimer_description' => true,
        'fedas_id' => true,
        'country_string' => true,
        'energy_efficiency_image_url' => true,
        'product_efficiency_image_url' => true,
        'number_of_pieces' => true,
        'warranty_description' => true,
        'scent_name' => true,
        'is_stain_resistant' => true,
        'color_name' => true,
        'size_name' => true,
        'thread_count' => true,
        'material_type' => true,
        'number_of_sets' => true,
        'wattage' => true,
        'unit_count' => true,
        'unit_count_type' => true,
        'thermal_performance_description' => true,
        'special_features' => true,
        'seasons1' => true,
        'seasons2' => true,
        'seasons3' => true,
        'seasons4' => true,
        'outer_material_type1' => true,
        'outer_material_type2' => true,
        'outer_material_type3' => true,
        'outer_material_type4' => true,
        'outer_material_type5' => true,
        'occupancy' => true,
        'mfg_minimum' => true,
        'material_composition' => true,
        'item_type_name' => true,
        'item_thickness_derived' => true,
        'item_thickness_unit_of_measure' => true,
        'item_shape' => true,
        'inner_material_type' => true,
        'capacity' => true,
        'capacity_unit_of_measure' => true,
        'are_batteries_included' => true,
        'batteries_required' => true,
        'battery_type1' => true,
        'battery_type2' => true,
        'battery_type3' => true,
        'number_of_batteries1' => true,
        'number_of_batteries2' => true,
        'number_of_batteries3' => true,
        'efficiency' => true,
        'theme' => true,
        'style_name' => true,
        'specific_uses_for_product' => true,
        'seating_capacity' => true,
        'pattern_name' => true,
        'paper_size' => true,
        'paint_type' => true,
        'occasion_type' => true,
        'number_of_doors' => true,
        'line_weight' => true,
        'item_styling' => true,
        'item_hardness' => true,
        'adjustment_type' => true,
        'installation_type' => true,
        'included_components' => true,
        'frame_type' => true,
        'form_factor' => true,
        'error' => true,
        'user' => true,
        'external_product' => true,
        'delivery_schedule_group' => true,
        'fulfillment_center' => true,
        'feda' => true
    ];
}
