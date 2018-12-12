<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Channel Entity
 *
 * @property int $id
 * @property string $channel_code
 * @property string $channel_name
 *
 * @property \App\Model\Entity\MasterListing[] $master_listings
 */
class Channel extends Entity
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
