<?php

/**
 * Class OptionURL
 */
class OptionURL {
	/**
	 * OptionURL constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'on_woocommerce_after_add_to_cart_button' ) );

	}

	/**
	 *A link to a page is generated
	 */
	public function on_woocommerce_after_add_to_cart_button() {

		if ( have_rows( 'url_option' ) ) {

			while ( have_rows( 'url_option' ) ):the_row();

				$url      = get_sub_field( 'url' );
				$text_url = get_sub_field( 'text_url' );

				echo "<br><br><a  class='button' href='{$url}'>{$text_url}</a>";
			endwhile;
		}

	}
}