<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Time implements CastableInterface {
	public function get( $value ) {
		if( is_numeric( $value ) ) {
			$value = Utils::convert_chars( date_i18n( "H:i:s", $value ) );
		} else if( is_string( $value ) && preg_match( '/^\d{2}:\d{2}:\d{2}$/', $value ) ) {
			// Ensure the value is in the correct time format
			$value = Utils::convert_chars( date_i18n( "H:i:s", strtotime( $value ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{2}:\d{2}$/', $value ) ) {
			// If the value is in "H:i" format, convert it to "H:i:s"
			$value = Utils::convert_chars( date_i18n( "H:i:s", strtotime( $value . ':00' ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{1,2}:\d{2}:\d{2}$/', $value ) ) {
			// If the value is in "H:i:s" format but with a single digit hour, convert it to "H:i:s"
			$value = Utils::convert_chars( date_i18n( "H:i:s", strtotime( $value ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{1,2}:\d{2}$/', $value ) ) {
			// If the value is in "H:i" format but with a single digit hour, convert it to "H:i:s"
			$value = Utils::convert_chars( date_i18n( "H:i:s", strtotime( $value . ':00' ) ) );
		} else if( is_a( $value, 'DateTime' ) ) {
			$value = $value->format( 'H:i:s' );
		}
		if( empty( $value ) ) {
			// If the value is empty, return an empty string
			$value = '';
		}
		return $value;
	}

	public function set( $value ) {
		return $this->get( $value );
	}
}