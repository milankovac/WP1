<?php

/**
 * Class TextOnProduct
 */
class TextOnProduct {
	
	/**
	 * TextOnProduct constructor.
	 */
	public function __construct() {

		//Add button
		add_action( 'woocommerce_before_add_to_cart_quantity', array(
			$this,
			'on_woocommerce_before_add_to_cart_quantity'
		) );

		//Add item in cart
		add_filter( 'woocommerce_add_cart_item_data', array( $this, 'on_woocommerce_add_cart_item_data' ), 10, 3 );

		//Add order item

		add_action( 'woocommerce_add_order_item_meta',array($this,'on_woocommerce_add_order_item_meta') , 10, 3 );

		//Cart item data
		add_filter( 'woocommerce_get_item_data', array( $this, 'on_woocommerce_get_item_data' ), 10, 2 );


		//Create meta
		add_action( 'woocommerce_add_order_item_meta', array( $this, 'wdm_add_values_to_order_item_meta' ), 10, 2 );


		//Order total
		add_filter( 'woocommerce_get_order_item_totals', array(
			$this,
			'on_woocommerce_get_order_item_totals'
		), 10, 3 );



	}

	/**
	 *Add input field
	 */
	public function on_woocommerce_before_add_to_cart_quantity() {

		echo "<label for='text_product'>Text On Product</label>";
		echo "<br><input type='text' id='text_on_product' name='text_on_product'  placeholder='Enter a caption'><br><br>";

	}

	/**
	 * Add cart item
	 * @param $cart_item_data
	 * @param $product_id
	 * @param $variation_id
	 *
	 * @return mixed
	 */
	public function on_woocommerce_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		if ( isset( $_POST['text_on_product'] ) ) {

			$cart_item_data['text_on_product'] = sanitize_text_field( $_POST['text_on_product'] );

		}

		return $cart_item_data;

	}

	/**
	 * Add order item
	 * @param $item_id
	 * @param $cart_item
	 * @param $cart_item_key
	 *
	 * @throws Exception
	 */
	function on_woocommerce_add_order_item_meta ( $item_id, $cart_item, $cart_item_key ) {
		if ( isset( $cart_item[ 'text_on_product' ] ) ) {
			wc_add_order_item_meta( $item_id, 'text_on_product_order', $cart_item[ 'text_on_product' ] );
		}
	}

	/**
	 * Display text on product in cart page
	 * @param $item_data
	 * @param $cart_item_data
	 *
	 * @return mixed
	 */
	public function on_woocommerce_get_item_data( $item_data, $cart_item_data ) {

		$item_data[] = array(
			'key'   => __( 'Text on Product', 'storefront' ),
			'value' => wc_clean( $cart_item_data['text_on_product'] )
		);

		return $item_data;

	}

	/**
	 * Order total and My account/Order
	 * @param $total_rows
	 * @param $order
	 * @param $tax_display
	 *
	 * @return array|mixed
	 */
	public function on_woocommerce_get_order_item_totals( $total_rows, $order, $tax_display ) {
		$text_on_product       = 'Text on Product';
		$text_on_product_value = $order->get_meta( 'text_on_product' );
		if ( empty( $text_on_product_value ) ) {
			return $total_rows;
		}
		$new_total_rows = array();

		foreach ( $total_rows as $key => $value ) {
			if ( 'payment_method' == $key && ! empty( $text_on_product_value ) ) {
				$new_total_rows['tracking_parcel'] = array(
					'label' => $text_on_product,
					'value' => $text_on_product_value,
				);
			}
			$new_total_rows[ $key ] = $total_rows[ $key ];
		}

		return sizeof( $new_total_rows ) > 0 ? $new_total_rows : $total_rows;
	}

	/**
	 * Update meta field  'text_on_product'
	 * @param $order
	 * @param $data
	 */
	public function wdm_add_values_to_order_item_meta( $item_id ) {

		$value=wc_get_order_item_meta($item_id,'text_on_product_order',false);
		wc_add_order_item_meta( $item_id, 'text_on_product', $value );

	}

}