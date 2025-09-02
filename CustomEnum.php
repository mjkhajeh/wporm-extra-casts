<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class CustomEnum implements CastableInterface {
    protected $allowed_values = [];

    public function __construct($allowed_values = []) {
        // Accept allowed values as array, sanitize each value
        $this->allowed_values = array_map('sanitize_text_field', (array) $allowed_values);
    }

    public function get($value) {
        // Sanitize and check if value is allowed
        $sanitized = sanitize_text_field($value);
        return in_array($sanitized, $this->allowed_values, true) ? $sanitized : null;
    }

    public function set($value) {
        // Sanitize and check if value is allowed
        $sanitized = sanitize_text_field($value);
        return in_array($sanitized, $this->allowed_values, true) ? $sanitized : null;
    }
}
