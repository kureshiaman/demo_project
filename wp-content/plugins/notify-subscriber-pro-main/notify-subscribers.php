<?php
/**
 * Plugin Name: Notify Subscribers
 * Plugin URL:https://codecanyon.net/item/notify-subscribers/20939679
 * Description: Notify Subscribers plugin gives you an option to send post notification to Subscribers. Users by various ways can send an email notification containing post fields.
 * Version: 1.1
 * Author: KrishaWeb PVT LTD
 * Author URL: https://www.krishaweb.com
 * Text Domain: notify-subscribers
 * Domain Path: /languages
 */

define( 'NOTIFY_SUBSCRIBERS_IN_VERSION', '1.1' );
define( 'NOTIFY_SUBSCRIBERS_IN_REQUIRED_WP_VERSION', '4.4' );
define( 'NOTIFY_SUBSCRIBERS_IN', __FILE__ );
define( 'NOTIFY_SUBSCRIBERS_IN_BASENAME', plugin_basename( NOTIFY_SUBSCRIBERS_IN ) );
define( 'NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR', plugin_dir_path( NOTIFY_SUBSCRIBERS_IN ) );
define( 'NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL', plugin_dir_url( NOTIFY_SUBSCRIBERS_IN ) );
define( 'PLUGIN_NAME', 'Notify Subscribers' );

/**
 * Required plugin core file.
 */
if ( file_exists( NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'functions.php' ) ) {
	require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'functions.php';
} else {
	_e( "notify-subscribers plugin's core files are missing! Please re-install the plugin.", 'notify-subscribers' );
	wp_die();
}

/**
 * Register activation hook.
 */
function notify_subscribers_in_active() {
	// Active comment.
}
register_activation_hook( NOTIFY_SUBSCRIBERS_IN, 'notify_subscribers_in_active' );

/**
 * Register de-activation hook.
 */
function notify_subscribers_in_deactive() {
	$unsubscribe_page = get_page_by_path( 'unsubscriber' );
	$subscribe_page = get_page_by_path( 'subscriber' );
	wp_delete_post( $unsubscribe_page->ID, true );
	wp_delete_post( $subscribe_page->ID, true );
}
register_deactivation_hook( NOTIFY_SUBSCRIBERS_IN, 'notify_subscribers_in_deactive' );

/**
 * Load plugin core file and class.
*/
function notify_subscribers_run() {
	$notify = new Notify_Subscribers();
	return $notify;
}
add_action( 'plugins_loaded', 'notify_subscribers_run' );
