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
        'latitude' => ['type' => 'float', 'length' => 10, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'longitude' => ['type' => 'float', 'length' => 10, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
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
            'Code' => '341a1fb1-8061-4066-b0b1-7b21ad7fbdcf',
            'Kontinent' => 'Lorem ipsu',
            'Land' => 'Lorem ipsum dolor sit amet',
            'LandFranz' => 'Lorem ipsum dolor sit amet',
            'latitude' => 1,
            'longitude' => 1
        ],
    ];
}
