<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class URL implements CastableInterface {
    public function get($value) {
        // Use esc_url_raw to sanitize and normalize the URL
        return esc_url_raw($value);
    }

    public function set($value) {
        // Use esc_url_raw to ensure the value is a valid URL
        return esc_url_raw($value);
    }
}
