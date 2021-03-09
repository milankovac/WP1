<?php

/**
 * Add a new route
 * Class CustomApi
 */
class CustomApi {
	/**
	 * CustomApi constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'on_rest_api_init' ) );

	}

	/**
	 *Making a route
	 */
	public function on_rest_api_init() {
		register_rest_route( 'wp/v2', '/proizvodi', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'generate_data' )
		) );
	}

	/**
	 * The data is printed
	 * @return array
	 */
	public function generate_data() {
		$product_data     = array();
		$results          = get_posts( array(
			'numberposts' => - 1,
			'post_type'   => 'product',
		) );
		$all_product_api  = array();
		$all_data_product = array();
		foreach ( $results as $result ) {

			$product       = wc_get_product( $result->ID );
			$sku           = $product->get_sku();
			$product_title = $result->post_title;
			$product_id    = $result->ID;
			$categories    = array();
			foreach ( $product->get_category_ids() as $id ) {
				array_push( $categories, get_the_category_by_ID( $id ) );
			}

			array_push( $all_product_api, array(
				'id'         => $product_id,
				'name'       => $product_title,
				'sku'        => $sku,
				'categories' => $categories
			) );
		}

		return $all_product_api;
	}

}