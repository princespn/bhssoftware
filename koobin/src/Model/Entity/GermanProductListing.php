<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GermanProductListing Entity
 *
 * @property int $id
 * @property string $product_sku
 * @property string $product_code
 * @property string $product_asin
 * @property string $fulfillmentchannel
 * @property string $web_sku
 * @property string $category
 */
class GermanProductListing extends Entity
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
        'product_sku' => true,
        'product_code' => true,
        'product_asin' => true,
        'fulfillmentchannel' => true,
        'web_sku' => true,
        'category' => true
    ];
}
