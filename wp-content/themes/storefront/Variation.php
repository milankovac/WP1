<?php


class Variation {

	function Variation() {
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_settings_fields_rgb' ), 10, 3 );

		add_action( 'woocommerce_save_product_variation', array( $this, 'save_variation_settings_fields_rgb' ), 10, 2 );

		add_filter( 'woocommerce_available_variation', array( $this, 'load_variation_settings_fields_rgb' ) );

		add_action('woocommerce_before_add_to_cart_button',array($this,'display'));



	}

	public function variation_settings_fields_rgb( $loop, $variation_data, $variation ) {
		global $post;
		woocommerce_wp_text_input(
			array(
				'id'          => $variation->ID ,
				'label'       => __( 'RGB', 'woocommerce' ),
				'placeholder' => '',
				'desc_tip'    => 'true',
				'value'       => get_post_meta( $variation->ID, '_text_field', true )
			)
		);

	}

	public function save_variation_settings_fields_rgb( $post_id ) {
		$text_field = $_POST['_text_field'][ $post_id ];
		if ( ! empty( $text_field ) ) {
			update_post_meta( $post_id, '_text_field', esc_attr( $text_field ));
		}
	}

	public function load_variation_settings_fields_rgb( $variations ) {
		$variations['text_field'] = get_post_meta( $variations['variation_id'], '_text_field', true );
		return $variations;
	}

public function display() {
	$args       = array(
		'post_type'   => 'product_variation',
	);

	$variations = get_posts( $args );

	foreach ( $variations as $variation ) {

		$variation_ID = $variation->ID;

		$product_variation = new WC_Product_Variation( $variation_ID );

		get_post_meta( $variation_ID, '_text_field', true );
		var_dump(get_post_meta( $variation_ID, '_text_field', true ));

	}
}




}



