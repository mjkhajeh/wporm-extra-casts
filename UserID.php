<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class UserID implements CastableInterface {
    public function get($value) {
        // Ensure the value is a valid post ID (positive integer)
        $id = absint($value);
        return $id > 0 ? $id : 0;
    }

    public function set($value) {
        // Ensure the value is a valid post ID (positive integer)
        $id = absint($value);
        return $id > 0 ? $id : 0;
    }
}
