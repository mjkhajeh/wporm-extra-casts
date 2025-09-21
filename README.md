# WPORM Extra Casts

Extra type casts for WPORM models, providing advanced validation and sanitization using WordPress functions.

## Features
- Seamless integration with WPORM
- Uses WordPress native functions for sanitization and validation
- Supports a wide range of data types
- Extensible for custom data types

## Requirements
- PHP 7.4+
- WordPress 5.0+
- [WPORM](https://github.com/mjkhajeh/wporm) library

## Installation

Install via Composer:

```
composer require mjkhajeh/wporm-extra-casts
```

## Supported Cast Types

| Cast Type    | Description                                                                                 | WP Function Used           |
|--------------|---------------------------------------------------------------------------------------------|---------------------------|
| Date         | Normalizes date values to `Y-m-d` format                                                    | `date_i18n`, custom logic |
| Time         | Normalizes time values to `H:i:s` format                                                    | `date_i18n`, custom logic |
| Serialized   | Handles PHP serialized data                                                                 | `maybe_serialize`, `maybe_unserialize` |
| Slug         | Converts strings to URL-friendly slugs                                                       | `sanitize_title`          |
| Email        | Validates and normalizes email addresses                                                    | `sanitize_email`          |
| URL          | Validates and normalizes URLs                                                               | `esc_url_raw`             |
| FilePath     | Sanitizes and normalizes file paths                                                         | `sanitize_file_name`      |
| PostID       | Ensures values are valid WordPress post IDs                                                 | `absint`                  |
| UserID       | Ensures values are valid WordPress user IDs                                                 | `absint`                  |
| CustomEnum   | Restricts values to a defined set, with sanitization                                        | `sanitize_text_field`     |
| Base64       | Handles base64 encoding/decoding                                                            | `base64_encode`, `base64_decode` |
| Mobile       | Validates and normalizes mobile phone numbers                                               | `sanitize_text_field`     |

## Usage

Add the desired cast to your WPORM model’s `$casts` property. Example:

```php
use MJ\WPROM\ExtraCasts\Date;
use MJ\WPROM\ExtraCasts\Slug;

class MyModel extends Model {
    protected $casts = [
        'published_at' => Date::class,
        'post_slug'    => Slug::class,
    ];
}
```

## CustomEnum Example

`CustomEnum` allows you to restrict a field to a set of allowed values, with WordPress sanitization:

```php
use MJ\WPROM\ExtraCasts\CustomEnum;

// Define allowed values
$enum = new CustomEnum(['draft', 'pending', 'published']);

// Getting a value
$value = $enum->get('published'); // returns 'published'
$value = $enum->get('trash');     // returns null

// Setting a value
$set = $enum->set('pending');     // returns 'pending'
$set = $enum->set('unknown');     // returns null
```

You can use `CustomEnum` in your model like this:

```php
class Post extends Model {
    protected $casts = [
        'status' => [CustomEnum::class, ['draft', 'pending', 'published']]
    ];
}
```

## License

MIT License © MohammadJafar Khajeh

## Author

MohammadJafar Khajeh
[mjkhajehg@gmail.com](mailto:mjkhajehg@gmail.com)

## Links
- [WPORM](https://github.com/mjkhajeh/wporm)
- [WordPress Developer Resources](https://developer.wordpress.org/reference/)
