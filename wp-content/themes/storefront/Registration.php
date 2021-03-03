<?php


class Registration {
	public function __construct() {

		add_filter( 'acf/validate_value/name=phone_number', array( $this, 'validate_phone_number' ), 10, 4 );
		add_filter( 'acf/validate_value/name=birth_year', array( $this, 'validate_birth_year' ), 10, 4 );

	}

	public function validate_phone_number( $valid, $value, $field, $input_name ) {
		if ( $valid !== true ) {
			return $valid;
		}
		if ( $this->condition_for_phone_number( $value ) ) {
			return __( 'The phone must have at least 4 numbers' );
		}

		return $valid;

	}

	public function validate_birth_year( $valid, $value, $field, $input_name ) {
		if ( $valid !== true ) {
			return $valid;
		}
		if ( $this->condition_for_birth_year( $value ) ) {
			return __( 'You must be over 18 and over 100 years old' );
		}

		return $valid;

	}

	//Condition 1
	public function condition_for_phone_number( $number ) {

		if ( $number === '' || ! is_numeric( $number ) || strlen( (string) $number ) < 4 || ! preg_match( "/^[0-9\-]|[\+0-9]|[0-9\s]|[0-9()]*$/", $number ) ) {
			return true;
		} else {
			return false;
		}

	}
	
	//Condition 2
	public function condition_for_birth_year( $birth_year ) {

		if ( $birth_year === '' || ! is_numeric( $birth_year ) || ( 2021 - $birth_year ) > 100 || ( 2021 - $birth_year ) < 18 ) {
			return true;
		} else {
			return false;
		}

	}


}