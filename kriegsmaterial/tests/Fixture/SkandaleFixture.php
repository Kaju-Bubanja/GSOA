<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SkandaleFixture
 *
 */
class SkandaleFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'skandale';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Code' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'Firma' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'DatumAnfang' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'DatumEnde' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Betrag' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Link' => ['type' => 'string', 'length' => 40, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'Code' => ['type' => 'index', 'columns' => ['Code'], 'length' => []],
            'Firma' => ['type' => 'index', 'columns' => ['Firma'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Id'], 'length' => []],
            'skandale_ibfk_1' => ['type' => 'foreign', 'columns' => ['Code'], 'references' => ['laender', 'Code'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'skandale_ibfk_2' => ['type' => 'foreign', 'columns' => ['Firma'], 'references' => ['firmen', 'Firma'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
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
            'Id' => 1,
            'Code' => '',
            'Firma' => 'Lorem ipsum dolor sit amet',
            'DatumAnfang' => '2015-09-09',
            'DatumEnde' => '2015-09-09',
            'Betrag' => '',
            'Link' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
