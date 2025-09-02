<?php
namespace MJ\WPROM\ExtraCasts;

use MJ\WPORM\Casts\CastableInterface;

class Date implements CastableInterface {
	public function get( $value ) {
		if( is_numeric( $value ) ) {
			// Unix timestamp
			$value = Utils::convert_chars( date_i18n( "Y-m-d", $value ) );
		} else if( is_string( $value ) && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $value ) ) {
			// Already in Y-m-d format
			$value = Utils::convert_chars( date_i18n( "Y-m-d", strtotime( $value ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{2}\/\d{2}\/\d{4}$/', $value ) ) {
			// d/m/Y format
			$value = Utils::convert_chars( date_i18n( "Y-m-d", strtotime( $value ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{2}-\d{2}-\d{4}$/', $value ) ) {
			// d-m-Y format
			$value = Utils::convert_chars( date_i18n( "Y-m-d", strtotime( $value ) ) );
		} else if( is_string( $value ) && preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $value ) ) {
			// Y/m/d format
			$value = Utils::convert_chars( date_i18n( "Y-m-d", strtotime( $value ) ) );
		} else if( is_a( $value, 'DateTime' ) ) {
			$value = $value->format( 'Y-m-d' );
		}
		if( empty( $value ) ) {
			$value = '';
		}
		return $value;
	}

	public function set( $value ) {
		return $this->get( $value );
	}
}
