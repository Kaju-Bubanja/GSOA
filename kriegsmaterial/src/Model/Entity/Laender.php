<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Laender Entity.
 */
class Laender extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'Kontinent' => true,
        'Land' => true,
        'LandFranz' => true,
        'latitude' => true,
        'longitude' => true,
    ];
}
