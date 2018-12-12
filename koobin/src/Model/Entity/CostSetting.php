<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CostSetting Entity
 *
 * @property int $id
 * @property string $sale_base_currency
 * @property string $invoice_currency
 * @property string $exchange_rate
 * @property int $variation
 */
class CostSetting extends Entity
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
