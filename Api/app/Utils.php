<?php

namespace App;

class Utils {

    static function removeCaracter($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
