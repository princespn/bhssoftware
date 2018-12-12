<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcessedListing Entity
 *
 * @property int $id
 * @property string $order_id
 * @property \Cake\I18n\FrozenDate $order_date
 * @property string $currency
 * @property string $plateform
 * @property string $subsource
 * @property string $cat_name
 * @property string $product_sku
 * @property string $product_name
 * @property int $quantity
 * @property string $price_per_product
 *
 * @property \App\Model\Entity\Order $order
 */
class ProcessedListing extends Entity
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
        'order_id' => true,
        'order_date' => true,
        'currency' => true,
        'plateform' => true,
        'subsource' => true,
        'cat_name' => true,
        'product_sku' => true,
        'product_name' => true,
        'quantity' => true,
        'price_per_product' => true,
        'order' => true
    ];
}
