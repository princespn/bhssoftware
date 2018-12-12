<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property string $linnworks_code
 * @property string $product_name
 * @property string $invoice_value
 * @property string $latest_invoice
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
class PurchaseOrder extends Entity
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
