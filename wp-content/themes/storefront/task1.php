<?php

class Task1 {

	protected $log_file;

	function __construct() {

		//Time zone setting
		date_default_timezone_set( 'Europe/Belgrade' );

		add_action( 'woocommerce_before_single_product_summary', array( $this, 'if_the_product_is_of_stock' ) );
		add_action( 'rest_api_init', array( $this, 'add_custom_fields' ) );
		add_action( 'wp_ajax_meta_ajax_request', array( $this, 'update_meta_fields' ) );
		add_action( 'wp_ajax_nopriv_meta_ajax_request', array( $this, 'update_meta_fields' ) );


		//CRON
		add_filter( 'cron_schedules', array( $this, 'schedule_for_cron' ) );

		//If there is no scheduled event to schedule a new one
		if ( ! wp_next_scheduled( 'send_mail_cron_hook' ) )
		{
			wp_schedule_event( time(), 'every-1-minutes', 'send_mail_cron_hook' );
		}

		add_action( 'send_mail_cron_hook', array( $this, 'get_all_in_stock_products' ) );
		$this->log_file = $_SERVER['DOCUMENT_ROOT'] . '/wp1/wp-content/themes/storefront/cron-info/info.txt';
	}

	//Function of adding a custom meta field of interested users for products

	function add_custom_fields() {
		register_rest_field(
			'product',
			'interested',
			array(
				'get_callback'    => null,
				'update_callback' => null,
				'schema'          => null,
			)
		);
	}

	//Function if the product is out of stock

	public function if_the_product_is_of_stock() {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product->stock_status == 'outofstock' && is_user_logged_in() ) {
			echo "<button class='button product_type_simple ajaxPhp' value='{$post->ID}'>Interested</button>";
		}
	}


	//Update meta fields 'interested'

	public function update_meta_fields() {
		if ( get_current_user_id() === 0 )
		{
			return;
		}
		$email     = get_userdata( get_current_user_id() )->user_email;
		$email_api = get_post_meta( $_POST['product'], 'interested', true );

		if ( ! is_array( $email_api ) ) {
			$email_api = [];
		}
		$email_api[] = $email;
		$all_emails  = array_unique( $email_api );
		update_post_meta( $_POST['product'], 'interested', $all_emails );

		file_put_contents( $this->log_file, "\n".' User with ID ' . get_current_user_id() . " intrested for product ID " . $_POST['product'], FILE_APPEND );
	}

	//Creating a schedule for CRON

	function schedule_for_cron( $schedules ) {
		$schedules['every-1-minutes'] = array( 'interval' => 1, 'display' => 'Every 1 minutes' );
		return $schedules;
	}

	//Get all products that are in stock

	public function get_all_in_stock_products() {
		$person = "\n" . date( "  Y-m-d H:i:s" );
		file_put_contents( $this->log_file, $person, FILE_APPEND );
		$args        = array(
			'post_type'  => 'product',
			'meta_query' => array(
				array(
					'key'     => '_stock_status',
					'value'   => 'instock',
					'compare' => '=',
				)
			)

		);
		$resluts_all = new WP_Query( $args );
		$results     = $resluts_all->get_posts();

		foreach ( $results as $reslut ) {
			$this->send_mail_cron( intval( $reslut->ID ) );
		}
	}

	//Sending an email with Cron.If there is an interested buyer for the product

	public function send_mail_cron( $id ) {
		$product = wc_get_product( (int) $id );

		if ( get_post_meta( $id, 'interested' ) ) {
			$email_api = get_post_meta( $id, 'interested' );

			foreach ( $email_api[0] as $email ) {

				$to      = $email;
				$subject = 'Product Availability Notice';
				$message = "Dear users, we inform you that the product {$product->name} is available.";
				$headers = 'From: webmaster@example.com' . "\r\n" .
				           'Reply-To: webmaster@example.com' . "\r\n" .
				           'X-Mailer: PHP/' . phpversion();
				mail( $to, $subject, $message, $headers );
				$person = "\n Mail Send to: " . "{$email}" . " " . date( "  Y-m-d H:i:s" ) . "\n";
				file_put_contents( $this->log_file, $person, FILE_APPEND );

			}
			delete_post_meta( $id, 'interested' );
		}

	}
}






