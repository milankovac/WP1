<?php

/**
 * Class Variation
 * Used to add class variations is instantiated in functions.php in line 89
 */
class Variation {

	/**
	 * Variation constructor.
	 * When an object is created, actions are added
	 */

	function Variation() {
		add_action( 'woocommerce_product_after_variable_attributes', array(
			$this,
			'variation_settings_fields_rgb'
		), 10, 3 );

		add_action( 'woocommerce_save_product_variation', array( $this, 'save_variation_settings_fields_rgb' ), 10, 2 );
	}

	/**
	 * Adds two variations for RGB and text on the product
	 *
	 * @param $loop int
	 * @param $variation_data array
	 * @param $variation object variation
	 */

	public function variation_settings_fields_rgb( $loop, $variation_data, $variation ) {
		woocommerce_wp_text_input(
			array(
				'id'          => '_text_field_rgb[' . $variation->ID . ']',
				'label'       => __( 'Hoodie RGB', 'woocommerce' ),
				'placeholder' => '',
				'desc_tip'    => 'true',
				'value'       => get_post_meta( $variation->ID, '_text_field_rgb', true ),
				'wrapper_class'       => 'form-field  form-row form-row-first'
			)
		);
		woocommerce_wp_text_input(
			array(
				'id'          => '_text_on_hoodie[' . $variation->ID . ']',
				'label'       => __( 'Hoodie text', 'woocommerce' ),
				'placeholder' => '',
				'desc_tip'    => 'true',
				'value'       => get_post_meta( $variation->ID, '_text_on_hoodie', true ),
				'wrapper_class'      => 'form-field  form-row form-row-last'
			)
		);
	}

	/**Saves variation values if it is not an empty field
	 *
	 * @param $post_id int
	 */

	public function save_variation_settings_fields_rgb( $post_id ) {
		$text_field_rgb = $_POST['_text_field_rgb'][ $post_id ];
		if ( ! empty( $text_field_rgb ) ) {
			update_post_meta( $post_id, '_text_field_rgb', esc_attr( $text_field_rgb ) );
		}
		$text_field_on_hoodie = $_POST['_text_on_hoodie'][ $post_id ];
		if ( ! empty( $text_field_on_hoodie ) ) {
			update_post_meta( $post_id, '_text_on_hoodie', esc_attr( $text_field_on_hoodie ) );
		}
	}
}



