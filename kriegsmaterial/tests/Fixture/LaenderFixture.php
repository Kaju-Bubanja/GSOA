<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LaenderFixture
 *
 */
class LaenderFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'laender';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Code' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'Kontinent' => ['type' => 'string', 'length' => 12, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Land' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'LandFranz' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Code'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'Code' => 'b5942886-3e56-49e7-8ea5-1b0a7a04fbb7',
            'Kontinent' => 'Lorem ipsu',
            'Land' => 'Lorem ipsum dolor sit amet',
            'LandFranz' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
