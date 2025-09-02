<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Slug implements CastableInterface {
    public function get($value) {
        // Use sanitize_title to normalize the slug
        return sanitize_title($value);
    }

    public function set($value) {
        // Use sanitize_title to ensure the value is a valid slug
        return sanitize_title($value);
    }
}
