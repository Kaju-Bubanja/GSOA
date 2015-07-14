<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExportFixture
 *
 */
class ExportFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'export';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Code' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Art' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'System' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Kategorie' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Year' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Betrag' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Code' => ['type' => 'index', 'columns' => ['Code'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Id'], 'length' => []],
            'export_ibfk_1' => ['type' => 'foreign', 'columns' => ['Code'], 'references' => ['laender', 'Code'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'Id' => 1,
            'Code' => '',
            'Art' => 'Lorem ipsum dolor sit amet',
            'System' => 'Lorem ip',
            'Kategorie' => 'Lorem ipsum d',
            'Year' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'Betrag' => 1
        ],
    ];
}
