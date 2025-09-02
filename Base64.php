<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Base64 implements CastableInterface {
	public function get( $value ) {
		$value = base64_decode( $value, true );
		if( $value === false ) {
			return '';
		}
		return $value;
	}

	public function set( $value ) {
		// Check if the value is already a base64 encoded string
		if( !is_string( $value ) || !preg_match( '/^[a-zA-Z0-9\/+]+=*$/', $value ) ) {
			if( !Utils::is_base64( $value ) ) {
				// If not, encode it to base64
				if( is_array( $value ) || is_object( $value ) ) {
					$value = serialize( $value );
				} elseif( !is_scalar( $value ) ) {
					$value = json_encode( $value );
				}
				$value = base64_encode( $value );
			}
		}


		// Ensure the value is a valid base64 string
		if( !Utils::is_base64( $value ) ) {
			$value = '';
		}

		return $value;
	}
}