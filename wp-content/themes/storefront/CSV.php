<?php

/**
 * Class CSV
 * It is intended for creating a CSV file
 * instantiates in functions.php line 100
 */
class CSV {
	/**
	 * CSV constructor.
	 */
	public function __construct() {

		add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'on_woocommerce_before_add_to_cart_button' ) );
header();
		add_action( 'wp_ajax_get_data', array( $this, 'get_data_all' ) );
		add_action( 'wp_ajax_nopriv_get_data', array( $this, 'get_data_all' ) );

		var_dump($_POST['color']);
	}

	/**
	 * when someone knocks a button "donwload" the download of the corresponding file will start
	 * since the file does not exist, its creation will start first using the function create_csv() which returns the file name;
	 */
	public function on_woocommerce_before_add_to_cart_button() {
		global $product;
		if($product->is_type('variable'))
		{
			$site_url = get_template_directory_uri().'/'.$this->create_csv().'.csv';
			echo "<br><br><a class='single_add_to_cart_button button alt' style='text-decoration: none;color: white' href='{$site_url}';>Download</a>";
		}
		else
		{
			echo'';
		}


	}

	/**
	 * Used to create and add data to a file
	 * @return mixed
	 */
	public function create_csv() {
		global $product;


//			if ( $product ) {
//
//				$file_name = $product->name;
//				$path      = $_SERVER['DOCUMENT_ROOT'] . '/wp1/wp-content/themes/storefront/' . $file_name . '.csv';
//				$file      = fopen( $path, 'w' );
//				fputcsv( $file, array( 'post_id', 'description', 'price' ) );
//				fputcsv( $file, array( $product->id, $_POST['pa_size'], $product->price ) );
//				return $file_name;
//			}
	}

	public function get_data_all(){
		$color=$_POST['color'];
		if($_GET['donwload']){
			$path      = $_SERVER['DOCUMENT_ROOT'] . '/wp1/wp-content/themes/storefront/app.csv';
			$file      = fopen( $path, 'w' );
			fputcsv( $file, array( 'post_id', $color, 'price' ) );
		}


	}

}