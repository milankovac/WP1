<?php

add_action( 'wp_ajax_meta_ajax_request', 'update' );
add_action( 'wp_ajax_nopriv_meta_ajax_request', 'update' );

function update() {
	$email          = get_userdata( get_current_user_id() )->user_email;
	$email_api      = get_post_meta( $_POST['product'], 'interested' );
	$new_list_email = [];
	if ( empty( $email_api ) ) {
		array_push( $new_list_email, $email );
		$all_emails = $new_list_email;
	}

	if ( ! empty( $email_api ) ) {
		foreach ( $email_api as $e ) {
			$new_list_email = $e;
		}
		array_push( $new_list_email, $email );
		$all_emails = array_unique( $new_list_email );
	}
	update_post_meta( $_POST['product'], 'interested', $all_emails );
}