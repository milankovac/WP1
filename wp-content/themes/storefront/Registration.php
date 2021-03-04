<?php

/**
 * Class Registration
 * Used to add class registration is instantiated in functions.php in line 95
 */

class Registration {

	/**
	 * Registration constructor.
	 * When an object is created, actions are added
	 */

	public function __construct() {

		add_filter( 'acf/validate_value/name=phone_number', array( $this, 'validate_phone_number' ), 10, 4 );
		add_filter( 'acf/validate_value/name=birth_year', array( $this, 'validate_birth_year' ), 10, 4 );

	}

	/**
	 * If the condition is not met in the method condition_for_phone_number  an error message will be generated
	 *
	 * @param $valid
	 * @param $value value from the field
	 * @param $field
	 * @param $input_name
	 *
	 * @return bool|string|void
	 */

	public function validate_phone_number( $valid, $value, $field, $input_name ) {
		if ( $valid !== true ) {
			return $valid;
		}
		if ( $this->condition_for_phone_number( $value ) ) {
			return __( 'The phone must have at least 4 numbers' );
		}

		return $valid;

	}

	/**
	 * If the condition is not met in the method condition_for_birth_year  an error message will be generated
	 *
	 * @param $valid
	 * @param $value value from the field
	 * @param $field
	 * @param $input_name
	 *
	 * @return bool|string|void
	 */

	public function validate_birth_year( $valid, $value, $field, $input_name ) {
		if ( $valid !== true ) {
			return $valid;
		}
		if ( $this->condition_for_birth_year( $value ) ) {
			return __( 'You must be over 18 and over 100 years old' );
		}

		return $valid;

	}

	/**
	 * Certain phone number requests are checked if they are not met by the return true
	 *
	 * @param $number input parameter of the method validate_phone_number ($value)
	 *
	 * @return bool
	 */

	public function condition_for_phone_number( $number ) {

		if ( $number === '' || ! is_numeric( $number ) || strlen( (string) $number ) < 4 || ! preg_match( "/^[0-9\-]|[\+0-9]|[0-9\s]|[0-9()]*$/", $number ) ) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Certain birth_year requests are checked if they are not met by the return
	 *
	 * @param $birth_year input parameter of the method validate_birth_year ($value)
	 *
	 * @return bool
	 */

	public function condition_for_birth_year( $birth_year ) {

		if ( $birth_year === '' || ! is_numeric( $birth_year ) || ( 2021 - $birth_year ) > 100 || ( 2021 - $birth_year ) < 18 ) {
			return true;
		} else {
			return false;
		}
	}


}