<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MasterListing Entity
 *
 * @property int $id
 * @property string $amazon_sku
 * @property string $channel_id
 * @property string $linnworks_code
 * @property string $price_uk
 * @property string $sale_price_uk
 * @property string $price_fr
 * @property string $sale_price_fr
 * @property string $price_de
 * @property string $sale_price_de
 * @property string $price_es
 * @property string $sale_price_es
 * @property string $price_ebay
 * @property string $sale_price_ebay
 * @property string $price_cdiscount
 * @property string $sale_price_cdiscount
 * @property string $prime_date
 * @property string $error
 *
 * @property \App\Model\Entity\Channel $channel
 */
class MasterListing extends Entity
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
        '*' => true,
        'id' => false
    ];
}
