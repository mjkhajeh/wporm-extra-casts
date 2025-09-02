<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class FilePath implements CastableInterface {
    public function get($value) {
        // Use sanitize_file_name to normalize the file path
        return sanitize_file_name($value);
    }

    public function set($value) {
        // Use sanitize_file_name to ensure the value is a valid file name
        return sanitize_file_name($value);
    }
}
