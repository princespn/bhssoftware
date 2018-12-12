<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchasePrice Entity
 *
 * @property int $id
 * @property string $purchase_id
 * @property string $supplier_id
 * @property string $stock_itemid
 * @property string $item_sku
 * @property string $item_title
 * @property string $invoice_currency
 * @property string $quantity
 * @property string $tax
 * @property string $cost
 * @property string $purchase_price
 * @property \Cake\I18n\FrozenDate $purchase_date
 *
 * @property \App\Model\Entity\Purchase $purchase
 * @property \App\Model\Entity\Supplier $supplier
 */
class PurchasePrice extends Entity
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
        'purchase_id' => true,
        'supplier_id' => true,
        'stock_itemid' => true,
        'item_sku' => true,
        'item_title' => true,
        'invoice_currency' => true,
        'quantity' => true,
        'tax' => true,
        'cost' => true,
        'purchase_price' => true,
        'purchase_date' => true,
        'purchase' => true,
        'supplier' => true
    ];
}
