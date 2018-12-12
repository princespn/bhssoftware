<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockLevel Entity
 *
 * @property int $id
 * @property string $change_date
 * @property string $item_number
 * @property string $item_title
 * @property string $barcode_number
 * @property string $category_name
 * @property string $location_name
 * @property string $stock_lev
 * @property string $stock_val
 * @property string $minimum_level
 * @property string $due_level
 * @property string $unit_costs
 * @property string $stock_itemid
 * @property string $stock_location_id
 *
 * @property \App\Model\Entity\StockLocation $stock_location
 */
class StockLevel extends Entity
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
        'change_date' => true,
        'item_number' => true,
        'item_title' => true,
        'barcode_number' => true,
        'category_name' => true,
        'location_name' => true,
        'stock_lev' => true,
        'stock_val' => true,
        'minimum_level' => true,
        'due_level' => true,
        'unit_costs' => true,
        'stock_itemid' => true,
        'stock_location_id' => true,
        'stock_location' => true
    ];
}
