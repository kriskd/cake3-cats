<?php
namespace App\View\Helper;

use Cake\View\Helper;

class CatnipHelper extends Helper {

    protected $genders = [
        'M' => 'Male',
        'F' => 'Female',
    ];

    public function genders() {
        return $this->genders;
    }

    public function gender($option = null) {
        if (in_array($option, array_flip($this->genders))) {
            return $this->genders[$option];
        }

        return '';
    }
}
