<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Number;

/**
 * Cat Entity.
 */
class Cat extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'is_alive' => true,
        'weight' => true,
        'gender' => true,
        'ssn' => true,
        'birth_year' => true,
    ];

    protected function _getBirthYear($birth_year) {
        return Number::format($birth_year, [
            'pattern' => '####',
        ]);
    }

    protected function _getReadableWeight() {
        if ($this->weight < 16) {
            return $this->weight . ' ounces';
        }
        return floor($this->weight/16) . ' pounds ' . $this->weight%16 . ' ounces';
    }

    protected function _getAge() {
        return date('Y') - $this->birth_year;
    }
}
