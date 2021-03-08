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
		add_action( 'woocommerce_after_add_to_cart_button', array($this, 'on_woocommerce_before_add_to_cart_button' ));
		add_action( 'init', array( $this, 'on_init' ) );
	}

	/**
	 * If the product is variable, a button will appear on that side
	 */

	public function on_woocommerce_before_add_to_cart_button() {
		global $product;

		$product_id = $product->id;
		if ( $product->is_type( 'variable' ) ) {
			$url = get_permalink() . "?download={$product_id}&&name={$product->name}";

			echo "<br><br><a  class='button alt' style='text-decoration: none;color: white' href='{$url}' ;>Download</a>";
		} else {
			echo '';
		}
	}

	/**
	 * Generation  CSV file
	 * Returns table values
	 * @return string
	 */

	public function generate_csv() {

		$product = wc_get_product( $_GET['download']);
		$attribute_label_name='id,';
		$all=array();
		$all_value='';
		foreach ($product->get_variation_attributes() as $taxonomy => $term_names ) {
			$attribute_label_name .= wc_attribute_label($taxonomy).',';

		}
		$attribute_label_name.='price';
		$all[]=$attribute_label_name;

		foreach ($product->get_available_variations() as $key=>$variation)
		{

			foreach ($variation['attributes'] as $value)
			{
				$all_value.=$value.',';
			}
			array_push($all,"{$variation['variation_id']},".$all_value."{$variation['display_price']}");
			$all_value='';
		}

		$string_data=implode("\n",$all);
		return $string_data;
	}

	/**
	 *If someone clicks the download button, the file download will start
	 */

	public function on_init() {

		if ( isset( $_GET['download'] ) ) {

			$csv = $this->generate_csv();
			header( "Content-Type: text/csv" );
			header( "Content-Disposition: attachment; filename={$_GET['name']}.csv" );
			header( "Cache-Control: no-cache, no-store, must-revalidate" );
			header( "Pragma: no-cache" );
			header( "Expires: 0" );
			header( "Content-Transfer-Encoding: UTF-8" );
			echo $csv;
			exit;
		}
	}
}