<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AdminListing Entity
 *
 * @property int $id
 * @property string $web_sku
 * @property string $linnworks_code
 * @property string $web_price_uk
 * @property string $web_sale_price_uk
 * @property string $web_price_fr
 * @property string $web_sale_price_fr
 * @property string $web_price_de
 * @property string $web_sale_price_de
 * @property string $web_price_dm
 * @property string $web_sale_price_dm
 * @property string $web_price_tesco
 * @property string $web_sale_price_tesco
 */
class AdminListing extends Entity
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
