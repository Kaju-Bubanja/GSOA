<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Skandale Entity.
 */
class Skandale extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'Code' => true,
        'Firma' => true,
        'DatumAnfang' => true,
        'DatumEnde' => true,
        'Betrag' => true,
        'Link' => true,
        'laender' => true,
    ];
}
