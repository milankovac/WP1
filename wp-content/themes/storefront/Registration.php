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
		add_action( 'woocommerce_edit_account_form', array( $this, 'acf_add_field_on_edit_account' ) );
		add_action( 'woocommerce_save_account_details_errors', array( $this,'acf_field_edit_account_errors_and_update' ), 10, 1 );
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

	/**
	 *Add fields in the profile details section
	 */

	public function acf_add_field_on_edit_account() {
		?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="password_2"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?></label>
            <input type="tel" class="woocommerce-Input woocommerce-Input--password input-text" name="number" id="number"
                   autocomplete="off" value="<?php echo get_field('phone_number',wp_get_current_user()) ?>"/>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="password_2"><?php esc_html_e( 'Date of Birth', 'woocommerce' ); ?></label>
            <input type="number" class="woocommerce-Input woocommerce-Input--password input-text"
                   name="birthday" id="birthday" autocomplete="off" value="<?php echo get_field('birth_year',wp_get_current_user()) ?>"/>
        </p>
		<?php

	}

	/**
	 * If the entry is not valid, a message will be generated stating that if it is valid, the field will be updated
	 *
	 * @param $args
	 */

	
	public function acf_field_edit_account_errors_and_update( $args ) {

		if ( isset( $_POST['number'] ) ) {
			$number = $_POST['number'];
			if ( $this->condition_for_phone_number($number) ) {
				$args->add( 'error', __( 'The phone must have at least 4 numbers' ), '' );
			} else {
				update_user_meta( wp_get_current_user()->ID, 'phone_number', sanitize_text_field( $_POST['number'] ) );
			}
		}
		if ( isset( $_POST['birthday'] ) ) {
			$birth_year = $_POST['birthday'];
			if ( $this->condition_for_birth_year($birth_year) ) {
				$args->add( 'error', __( 'You must be over 18 and over 100 years old' ), '' );
			} else {
				update_user_meta( wp_get_current_user()->ID, 'birth_year', sanitize_text_field( $_POST['birthday'] ) );
			}
		}
	}
}