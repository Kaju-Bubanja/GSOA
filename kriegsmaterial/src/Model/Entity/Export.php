<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Export Entity.
 */
class Export extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'Code' => true,
        'Art' => true,
        'System' => true,
        'Kategorie' => true,
        'Year' => true,
        'Betrag' => true,
    ];
}
