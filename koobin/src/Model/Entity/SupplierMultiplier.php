<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SupplierMultiplier Entity
 *
 * @property int $id
 * @property string $category
 * @property string $invoice_currency
 * @property string $supplier
 * @property string $sp1_multiplier
 * @property string $sp2_multiplier
 * @property string $sp3_multiplier
 */
class SupplierMultiplier extends Entity
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
