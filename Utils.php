<?php
namespace MJ\WPROM\ExtraCasts;

class Utils {
	public static function is_base64( $string ) {
		if( !is_string( $string ) || empty( $string ) ) {
			return false;
		}
		// Check if it's a valid base64 encoded string
		if (base64_encode(base64_decode($string, true)) === $string) {
			// Also check if it only contains valid base64 characters
			return preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string);
		}
		return false;
	}

	public static function convert_chars( $string, $sanitize = 'sanitize_text_field', $sanitize_after = '', $reverse = false ) {
		if( !empty( $sanitize ) ) {
			if( is_callable( $sanitize ) ) {
				$string = call_user_func( $sanitize, $string );
			} else {
				$functions = $sanitize;
				if( is_string( $functions ) ) {
					$functions = explode( '&&', $functions );
				} else if( is_bool( $functions ) ) {
					$functions = ['sanitize_text_field'];
				}
				foreach( $functions as $function ) {
					// Sanitize the function name
					if( is_string( $function ) ) {
						$function = sanitize_text_field( $function );
						$function = remove_accents( $function );
						$function = wp_strip_all_tags( $function );
						$function = str_replace( [' ', '&'], '', $function );
						$function = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $function );
						// Remove HTML entities.
						$function = preg_replace( '/&.+?;/', '', $function );
						$function = str_replace( ['Utils::'], 'self::', $function );
					}
					if( is_callable( $function ) ) {
						$string = call_user_func( $function, $string );
					}
				}
			}
		}

		if( is_string( $string ) ) {
			$chars = [
				'۰'	=> '0',
				'۱'	=> '1',
				'۲'	=> '2',
				'۳'	=> '3',
				'۴'	=> '4',
				'۵'	=> '5',
				'۶'	=> '6',
				'۷'	=> '7',
				'۸'	=> '8',
				'۹'	=> '9',
				'٪'	=> '%',
				'÷'	=> '/',
				'×'	=> '*',
				'-'	=> '-',
				'ـ'	=> '_',
				'ي'	=> 'ی',
				'ك'	=> 'ک',
			];

			$string = !$reverse ? str_replace( array_keys( $chars ), array_values( $chars ), $string ) : str_replace( array_values( $chars ), array_keys( $chars ), $string );
		}
		return $sanitize_after ? self::convert_chars( $string, $sanitize_after, [], false ) : $string;
	}

	/**
	 * Convert value to boolean
	 *
	 * @param mixed $value
	 * @return boolean
	 */
	public static function to_bool( $value ) {
		if( is_wp_error( $value ) || is_null( $value ) ) return false;
		$value = strtolower( $value );
		if( in_array( $value, ["false", 'no', 'off', '0'] ) ) return false;
		if( in_array( $value, ["true", 'yes', 'on', '1'] ) ) return true;

		return wp_validate_boolean( $value );
	}

	/**
	 * Check if a string is a valid phone number or not
	 *
	 * @param integer|string $string
	 * @return boolean
	 */
	public static function is_phone( $string ) {
		return self::to_bool( preg_match( '/^(09[0-9]{9})$/', Sanitizers::phone( $string ) ) );
	}
}