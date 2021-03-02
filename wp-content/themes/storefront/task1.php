<?php

class Task1 {

	protected $log_file;

	function __construct() {
		add_action( 'woocommerce_before_single_product_summary', array( $this, 'if_not_in_stock' ) );
		add_action( 'rest_api_init', array( $this, 'add_custom_fields' ) );
//		add_action( 'woocommerce_before_single_product_summary', array( $this, 'send_mail' ) );
		add_action( 'wp_ajax_meta_ajax_request', array( $this, 'update' ) );
		add_action( 'wp_ajax_nopriv_meta_ajax_request', array( $this, 'update' ) );


		//Cron
		add_filter( 'cron_schedules', array( $this, 'custom_cron' ) );
		if(!!wp_next_scheduled('send_mail_cron_hook'))
		{
			wp_schedule_event( time(), 'every-1-minutes', 'send_mail_cron_hook' );
		}

		add_action( 'send_mail_cron_hook', array( $this, 'data_for_cron' ) );


		add_action( 'woocommerce_before_single_product_summary', array( $this, 'data_for_cron' ) );

		$this->log_file=$_SERVER['DOCUMENT_ROOT'] . '/wp1/wp-content/themes/storefront/cron-info/info.txt';
	}

	//Function add custom meta field interested on products

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

	//Function if not in stock

	public function if_not_in_stock() {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product->stock_status == 'outofstock' && is_user_logged_in() ) {
			echo "<button class='button product_type_simple ajaxPhp' value='{$post->ID}'>Interested</button>";
		}

	}

	//Sending emails to interested customers

//	public function send_mail() {
//		global $post;
//		$product = wc_get_product( $post->ID );
//		if ( $product->stock_status == 'instock' && get_post_meta( $post->ID, 'interested' ) ) {
//			$email_api = get_post_meta( $post->ID, 'interested' );
//
//			foreach ( $email_api[0] as $email ) {
//
//				$to      = $email;
//				$subject = 'Product Availability Notice';
//				$message = "Dear users, we inform you that the product {$product->name} is available.";
//				$headers = 'From: webmaster@example.com' . "\r\n" .
//				           'Reply-To: webmaster@example.com' . "\r\n" .
//				           'X-Mailer: PHP/' . phpversion();
//
//				mail( $to, $subject, $message, $headers );
//
//			}
//			delete_post_meta( $post->ID, 'interested' );
//		}
//
//	}

	//Update post meta field

	public function update() {

		if ( get_current_user_id() === 0 ) {
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

		file_put_contents( $this->log_file, 'User with ID '.get_current_user_id()." intrested for product ID ".$_POST['product'], FILE_APPEND );

	}


	//Cron

	function custom_cron( $schedules ) {
		$schedules['every-1-minutes'] = array( 'interval' => 1 * MINUTE_IN_SECONDS, 'display' => 'Every 1 minutes' );

		return $schedules;
	}


	public function data_for_cron() {

		$person = date( "  Y-m-d H:i:s" ) . "\n";
		file_put_contents( $this->log_file, $person, FILE_APPEND );
//		global $wpdb;
//		$resluts = $wpdb->get_results( "SELECT product_id FROM  wp_wc_product_meta_lookup WHERE stock_status LIKE 'instock'" );
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
				$person = "Mail Send to: " . "{$email}" . " " . date( "  Y-m-d H:i:s" ) . "\n";
				file_put_contents( $this->log_file, $person, FILE_APPEND );

			}
			delete_post_meta( $id, 'interested' );
		}


	}


}






