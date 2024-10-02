<?php if ( ! defined( 'ABSPATH' ) ) exit;

require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'blocks/class-notify-subscribers.php';
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'includes/class-notify-subscribers.php';

if ( function_exists( 'register_block_type' ) ) {
	new Notify_Subscribers_Gutenberg;
}

/**
 * Plugin load textdomain for multilingual.
 */
function notify_subscribers_textdomain() {
	load_plugin_textdomain( 'notify-subscribers', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'notify_subscribers_textdomain' );

/**
 * Register or init widget to display on front end.
 */
function notify_subscribers_widget() {
	register_widget( 'Notify_Subscribers_Widget' );
}
add_action( 'widgets_init', 'notify_subscribers_widget' );

/**
 * Create Subscriber and Unsubscriber page when plugin install
 */
function notify_subscribers_create_pages() {
	$new_page_id = wp_insert_post( array(
		'post_title' => __( 'Unsubscriber', 'notify-subscribers' ),
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed',
		'post_content' => __( 'Unsubscribe request are accept.', 'notify-subscribers' ),
		'post_status' => 'publish',
		'post_author' => 1,
		'menu_order' => 0,
	));

	$new_page_id = wp_insert_post( array(
		'post_title' => __( 'Subscriber', 'notify-subscribers' ),
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed',
		'post_content' => __( 'Thank You For Subscriber.', 'notify-subscribers' ),
		'post_status' => 'publish',
		'post_author' => 1,
		'menu_order' => 0,
	));
}
if ( is_admin() ) {
	if ( ( get_page_by_path( 'unsubscriber' ) == null )  && ( get_page_by_path( 'subscriber' ) == null ) && ( class_exists( 'Notify_Subscribers' ) ) ) {
		add_action( 'init', 'notify_subscribers_create_pages' );
	}
}

/**
 * Create notify subscribers form.
 */
function notify_subscribers_form() {
	$ns_html = '';
	if ( ! is_user_logged_in() ) {
		$array = apply_filters( 'notify_subscribers_create_form', array() );
		foreach ( $array as $value ) {
			$ns_html .='<div class="ns-container">';
				$ns_html .='<div class="ns-wrapper">';
					$ns_html .='<form class="' . __( $value['class'], 'notify-subscribers' ) . ' ns-form" id="ns-' . __( $value['id'], 'notify-subscribers' ) . '" method="post" name="ns-' . __( $value['name'], 'notify-subscribers' ) . '" > ';
					foreach ( $value as $key => $get_from ) {
						if ( ( isset( $get_from['type'] ) ) && ( $get_from['type'] != "submit" ) ) {
							$ns_html .='<div class="ns-group ' . __( $get_from['wrapper'], 'notify-subscribers' ) . '">';
							if ( ( isset( $get_from['label'] ) ) && ( $get_from['label'] != '' ) ) {
								$ns_html .='<label class="form-label" for="ns-' . __( $get_from['name'], 'notify-subscribers' ) . '">' . __($get_from['label'], 'notify-subscribers' ) . '</label>';
							}
								$ns_html .='<input type="' . __( $get_from['type'], 'notify-subscribers' ) . '" name="ns-' . __( $get_from['name'], 'notify-subscribers' ) . '" class="ns-input ns-' . __( $get_from['id'], 'notify-subscribers' ) . ' ' . __( $get_from['class'], 'notify-subscribers' ) . '"  id="ns-' . __( $get_from['id'], 'notify-subscribers' ) . '" placeholder="' . __( $get_from['placeholder'], 'notify-subscribers' ) . '" />';
							$ns_html .='</div>';
						} elseif ( ( isset( $get_from['type'] ) ) && ( $get_from['type'] == "submit" ) ) {
							$ns_html .='<div class="ns-action">';
								$ns_html .='<input type="' . __( $get_from['type'], 'notify-subscribers' ) . '" name="ns-' . __( $get_from['name'], 'notify-subscribers' ) . '" class="ns-submit ' . __( $get_from['class'], 'notify-subscribers' ) . '" value="' . __( $get_from['value'], 'notify-subscribers' ) . '" />';
							$ns_html .='</div>';
							$ns_html .='<div class="loader"></div>';
						}
					}
					$ns_html .='</form>';
				$ns_html .='</div>';
			$ns_html .='</div>';
		}
	} else {
		$ns_html .='<p>' . __( 'You are logged in!', 'notify-subscribers' ) . '</p>';
	}
	return $ns_html;
}
add_shortcode( 'notify-subscribers', 'notify_subscribers_form' );
add_shortcode( 'notify_subscribers', 'notify_subscribers_form' );

/**
 * Create subscriber role user when click on ajax_submit function.
 */
function notify_subscribers_ajax_submit() {
	if ( wp_verify_nonce( $_POST['ns_nonce'], 'notify-subscribers' ) ) {
		$check_user = get_user_by( 'email', $_POST['ns_email'] );
		if ( ! $check_user->roles ) {
			$email = sanitize_user( $_POST['ns_email'] );
			// Subscribers before hook.
			do_action( 'ns_subscriber_before', $_POST );
			// If check email already exists OR not.
			if ( ! email_exists( $email ) ) {
				$name = notify_subscribers_create_user_name( $_POST['ns_firstname'], $_POST['ns_lastname'], $email );
				$create_user = wp_create_user( $name, ' ', $email );
				$user = new WP_User( $create_user );
				$user->set_role( 'subscriber' );
				if ( $create_user ) {
					if ( $_POST['ns_firstname'] != '' ) {
						$first_name = sanitize_text_field( $_POST['ns_firstname'] );
						update_user_meta( $user->ID, 'first_name', $first_name );
					} else {
						$first_name = '';
					}
					if ( $_POST['ns_lastname'] != '' ) {
						$last_name = sanitize_text_field( $_POST['ns_lastname'] );
						update_user_meta( $user->ID, 'last_name', $last_name );
					} else {
						$last_name = '';
					}
					// Mailchimp Entiry.
					$ns_mailchimp = apply_filters( 'ns_mailchimp', $email, $first_name, $last_name );
					// admin mail
					notify_subscribers_run()->notify_subscribers_admin_notification( $user->user_login, $user->user_email, 'New User Registration', 'New user registration on your site' );
					// user mail
					notify_subscribers_run()->notify_subscribers_user_notification( $email, get_option( 'subscribe_mail_subject' ), get_option( 'subscribe_mail_body' ), '' );
					// Subscribers before hook.
					do_action( 'ns_subscriber_after', $user );
					// Send response.
					echo json_encode( array( 'result' => 1, 'message' => __( 'To confirm your subscription, please check your email.', 'notify-subscribers' ), 'mailchimp' => $ns_mailchimp ));
				}
			} else {
				$check_user->set_role( 'subscriber' );
				if ( $_POST['ns_firstname'] != '' ) {
					update_user_meta( $check_user->ID, 'first_name', sanitize_text_field( $_POST['ns_firstname'] ) );
				}
				if ( $_POST['ns_lastname'] != '' ) {
					update_user_meta( $check_user->ID, 'last_name', sanitize_text_field( $_POST['ns_lastname'] ) );
				}
				// admin mail
				notify_subscribers_run()->notify_subscribers_admin_notification( $check_user->user_login, $check_user->user_email );
				// user mail
				notify_subscribers_run()->notify_subscribers_user_notification( $check_user->user_email, get_option( 'subscribe_mail_subject' ), get_option( 'subscribe_mail_body' ), '' );
				// Subscribers before hook.
				do_action( 'ns_subscriber_after', $check_user );
				// Send response.
				echo json_encode( array( 'result' => 1, 'message' => __( 'To confirm your subscription, please check your email.', 'notify-subscribers' ) ) );
			}
		} else {
			echo json_encode( array( 'result' => 0, 'message' => __( 'This Email already registered.', 'notify-subscribers' ) ) );
		}
	}
	exit;
}
add_action( 'wp_ajax_notify_subscribers_ajax_submit', 'notify_subscribers_ajax_submit' );
add_action( 'wp_ajax_nopriv_notify_subscribers_ajax_submit', 'notify_subscribers_ajax_submit' );

/**
 * Create user unique username when username is already exist.
 */
function notify_subscribers_create_user_name( $firstname, $lastname, $email ) {
	$username = '';
	if ( ( ! empty( $firstname ) ) && ( ! empty( $lastname ) ) ) {
		$username = $firstname . '_' . $lastname;
	} elseif ( ! empty( $firstname ) ) {
		$username = $firstname;
	} else {
		$username = strstr( $email, '@', true );
	}

	if ( username_exists( $username ) ) {
		$check_username = $username . '_' . substr( md5( microtime() ), 0, rand( 1, 5 ) );
	} else {
		$check_username = $username;
	}
	return sanitize_user( $check_username );
}

/**
 * Unsubscriber user mail send
 */
function notify_subscribers_unsubscriber_notification() {
	if ( ( get_page_by_path( 'unsubscriber' ) ) && ( isset( $_REQUEST['notifyemail'] ) ) && ( isset( $_REQUEST['key'] ) ) ) {
		notify_subscribers_run()->notify_subscribers_unsubscribe( $_REQUEST['notifyemail'], $_REQUEST['key'] );
	}
}
add_action( 'init', 'notify_subscribers_unsubscriber_notification' );
