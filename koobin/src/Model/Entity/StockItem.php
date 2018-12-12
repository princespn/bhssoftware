<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockItem Entity
 *
 * @property int $id
 * @property string $item_number
 * @property string $item_title
 * @property string $barcode_number
 * @property string $category_name
 * @property string $supp_name
 * @property string $supp_id
 * @property string $heights
 * @property string $widths
 * @property string $depths
 * @property string $weights
 *
 * @property \App\Model\Entity\Supp $supp
 */
class StockItem extends Entity
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
        'item_number' => true,
        'item_title' => true,
        'barcode_number' => true,
        'category_name' => true,
        'supp_name' => true,
        'supp_id' => true,
        'heights' => true,
        'widths' => true,
        'depths' => true,
        'weights' => true,
        'supp' => true
    ];
}
