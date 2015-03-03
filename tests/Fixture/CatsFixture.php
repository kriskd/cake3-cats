<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CatsFixture
 *
 */
class CatsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'is_alive' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'weight' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => 'Weight in ounces', 'precision' => null, 'autoIncrement' => null],
        'gender' => ['type' => 'string', 'fixed' => true, 'length' => 1, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ssn' => ['type' => 'string', 'fixed' => true, 'length' => 11, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'birth_year' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
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
            'id' => '',
            'name' => 'Lorem ipsum dolor sit amet',
            'is_alive' => 1,
            'weight' => 1,
            'gender' => 'Lorem ipsum dolor sit ame',
            'ssn' => 'Lorem ips',
            'birth_year' => 1,
            'created' => '2015-03-01 21:28:59',
            'modified' => '2015-03-01 21:28:59'
        ],
    ];
}
