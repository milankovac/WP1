<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

//function register_script() {
//
//	wp_enqueue_script( 'task-ajax', get_template_directory_uri() . '/ajax.js', array( 'jquery' ) );
//	wp_localize_script( 'task-ajax', 'tasksLocalized', array( 'Ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
//}
//
//add_action( 'wp_enqueue_scripts', 'register_script' );
function register_script() {

	wp_enqueue_script( 'task-ajax', get_template_directory_uri() . '/ajax2.js', array( 'jquery' ) );
	wp_localize_script( 'task-ajax', 'tasksLocalized', array( 'Ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'register_script' );

/**
 * Task 1
 */
//include 'task1.php';
//$task = new Task1();
/**
 * Task 2
 */
//include "Variation.php";
//$task2=new Variation();
/**
 * Task3
 */
//include "Registration.php";
//$task3=new Registration();
/**
 * Task 4
 */
//include "CSV.php";
//$task4=new CSV();
/**
 * Task5
 */
//include "GlobalCSV.php";
//$task5=new GlobalCSV();
/**
 * Task6
 */
//include "CustomApi.php";
//$task6=new CustomApi();

/**
 * Task 7
 */
//include "OptionURL.php";
//$task7=new  OptionURL();
/**
 * Task8
 */


include "TextOnProduct.php";
$task8 = new TextOnProduct();



