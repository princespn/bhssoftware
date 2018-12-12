<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CostCalculator Entity
 *
 * @property int $id
 * @property string $linnworks_code
 * @property string $product_name
 * @property string $category
 * @property string $supplier
 * @property string $invoice_currency
 * @property string $landed_price_gbp
 * @property string $sp1_value_gbp
 * @property string $sp2_value_gbp
 * @property string $sp3_value_gbp
 * @property string $sale_price_gbp
 * @property string $landed_price_eur
 * @property string $sp1_value_eur
 * @property string $sp2_value_eur
 * @property string $sp3_value_eur
 * @property string $sale_price_euro
 * @property string $import_dates
 * @property string $error
 */
class CostCalculator extends Entity
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
        'linnworks_code' => true,
        'product_name' => true,
        'category' => true,
        'supplier' => true,
        'invoice_currency' => true,
        'landed_price_gbp' => true,
        'sp1_value_gbp' => true,
        'sp2_value_gbp' => true,
        'sp3_value_gbp' => true,
        'sale_price_gbp' => true,
        'landed_price_eur' => true,
        'sp1_value_eur' => true,
        'sp2_value_eur' => true,
        'sp3_value_eur' => true,
        'sale_price_euro' => true,
        'import_dates' => true,
        'error' => true
    ];
}
