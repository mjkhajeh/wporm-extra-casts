<?php
namespace MJ\WPROM\ExtraCasts;

use DrPlus\Utils\Sanitizers;
use MJ\WPORM\Casts\CastableInterface;

class Mobile implements CastableInterface {
	public function get( $value ) {
		return $value;
	}

	public function set( $value ) {
		if( Utils::is_phone( $value ) ) {
			$value = Utils::convert_chars( $value );
			$value = str_replace( [" ", "(", ")", "+", "-"], "", $value );
			$value = substr( $value, 0, 2 ) == "98" ? substr( $value, 2 ) : $value;
			$value = substr( $value, 0, 1 ) === '0' ? $value : "0{$value}";
		}
		return $value;
	}
}