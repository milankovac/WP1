<?php

/**
 * It is used to generate a CSV file for all products
 * Class GlobalCSV
 */
class GlobalCSV {

	/**
	 * Actions are added
	 * GlobalCSV constructor.
	 */
	public function __construct() {
		//add_action( 'all_product_csv', array( $this, 'on_all_product_csv' ) );
		add_action( 'admin_init', array( $this, 'on_admin_init' ) );
		add_action( 'admin_enqueue_scripts',array($this,'register_script') );

	}

	/**
	 * A button is generated in the admin area edit product
	 */
	public function on_all_product_csv() {

		echo "<form method='post'><button name='download' href='#' class='page-title-action' type='submit'>Download All Products </button></form>";
	}

	/**
	 *A csv file will be generated
	 */
	public function on_admin_init() {

		$row   = array();
		$row[] = "ID,NAME,SKU,CATEGORIES";
		global $wpdb;
		//$results = $wpdb->get_results( "SELECT ID,post_title FROM wp_posts WHERE post_type LIKE 'product'" );
		$results=get_posts(array('numberposts'      => -1,
		                         'post_type'        => 'product',
		));

		foreach ( $results as $result ) {

			$row_value  = '';
			$categories = array();

            //Get product by ID
			$products = wc_get_product( $result->ID );

			$sku                   = $products->get_sku();
			$post_title            = $result->post_title;
			$post_title_sanitation = str_replace( '"', '""', $post_title );
			$post_title_sanitation = "\"$post_title_sanitation\"";

            //get category name from ID
			foreach ( $products->get_category_ids() as $id ) {
				array_push( $categories, get_the_category_by_ID( $id ) );
			}
			$categories_implode = implode( ',', $categories );
			$categories_implode = "\"$categories_implode\"";
			$row_value          .= $result->ID . "," . $post_title_sanitation . "," . $sku . "," . $categories_implode;

			array_push( $row, $row_value );
		}
		$csv = implode( "\n", $row );

		//If someone clicks the button, the download will start
		if ( isset( $_POST['download'] ) ) {

			header( "Content-Type: text/csv" );
			header( "Content-Disposition: attachment; filename=AllProducts.csv" );
			header( "Cache-Control: no-cache, no-store, must-revalidate" );
			header( "Pragma: no-cache" );
			header( "Expires: 0" );
			header( "Content-Transfer-Encoding: UTF-8" );
			echo $csv;
			exit;
		}
	}
	function register_script() {

		wp_enqueue_script( 'all-products', get_template_directory_uri() . '/allProducts.js', array( 'jquery' ) );

	}




}

