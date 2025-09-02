<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Email implements CastableInterface {
    public function get($value) {
        // Use sanitize_email to normalize and validate the email
        return sanitize_email($value);
    }

    public function set($value) {
        // Use sanitize_email to ensure the value is a valid email
        return sanitize_email($value);
    }
}
