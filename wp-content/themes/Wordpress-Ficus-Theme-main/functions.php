<?php

require_once('wp_bootstrap_navwalker.php');
//Theme setup
function ficus_theme_setup()
{
	add_theme_support('post-thumbnails');

    register_nav_menus(array(
		'primary'	=> __('Primary Menu')
	));
}

add_theme_support( 'custom-logo', array(
	'height'      => 50,
	'width'       => 50,
	'flex-height' => true,
) );

add_action('after_setup_theme', 'ficus_theme_setup');

//Search only post
function wpb_search_filter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
	}
add_filter('pre_get_posts','wpb_search_filter');

//Add column in table all users
function add_custom_misha_columns($columns){
    $columns["user-approved"] = "User Approved";
    return $columns;
}
add_filter('manage_users_columns', 'add_custom_misha_columns');

// Populate the column
function add_content_to_mishas_column($value, $column_name, $user_id){
    $value = get_user_meta( $user_id, 'user-approved', true );
    return($value=='approved')? "Yes":"No";

}

add_action('manage_users_custom_column', 'add_content_to_mishas_column', 10, 3);

//Register new action approved or disapproved
function new_action( $actions, $user) {
    $value = get_user_meta( $user->ID, 'user-approved', true );
    $display=($value=='approved')?'disapproved':'approved';
    $actions['new_action'] = "<a class='new_action' href='" . admin_url( "users.php?&action={$display}&amp;user=$user->ID") . "'>" . esc_html__( $display ) . "</a>";
    return $actions;
}

add_filter('user_row_actions', 'new_action', 10, 2);

//Register new field in wp-json/wp/v2/users
function create_api_posts_meta_field() {
    register_rest_field( 'user', 'approved',
        array
        (
            'get_callback'    => 'get_post_meta_for_api',
            'schema'          =>null,
        )
    );
}
add_action( 'rest_api_init', 'create_api_posts_meta_field' );

//Add value to field for users
function get_post_meta_for_api( $object ) {
    $value = get_user_meta( $object['id'], 'user-approved', true );
   return $value;
}

//Get current URL
$current_url=home_url($_SERVER['REQUEST_URI']);

//Update field value
if(is_admin() && current_user_can ('list_users') && strpos($current_url,'users.php'))
{
    if(isset($_GET['action'])&&isset($_GET['user']))
    {
        $user_id=(int)$_GET['user'];
        $action=$_GET['action'];
        $rest=update_user_meta($user_id,'user-approved',$action);
    }
}

