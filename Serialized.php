<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Serialized implements CastableInterface {
    public function get($value) {
        // Use WordPress maybe_unserialize for safe unserialization
        return maybe_unserialize($value);
    }

    public function set($value) {
        // Use WordPress maybe_serialize for safe serialization
        return maybe_serialize($value);
    }
}
