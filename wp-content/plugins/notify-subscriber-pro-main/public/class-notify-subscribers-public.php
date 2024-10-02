<?php
if ( ! class_exists( 'Notify_Subscribers_Public' ) ) {

	class Notify_Subscribers_Public {

		/**
		 * Add public script & style
		 */
		public static function enqueue_script_public() {
			$config = apply_filters( 'ns_options', 'ns-config' );
			if ( ( isset( $config['thank_you_page'] ) ) && ( ! empty( $config['thank_you_page'] ) ) ) {
				$thank_you_page = esc_url( home_url( '/' . $config['thank_you_page'] ) );
			} else {
				$thank_you_page = esc_url( get_permalink( get_page_by_title( 'subscriber' ) ) );
			}
			// Enqueue scripts.
			wp_enqueue_script( 'notify-subscribers-js', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'public/js/notify-subscribers-public.js', array('jquery') , '', true );
			wp_enqueue_style( 'notify-subscribers', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'public/css/notify-subscribers-public.css');
			
			// Get error message.
			$firstname_error = get_option( 'firstname_error' ) != '' ? get_option( 'firstname_error' ) : __( 'The field is required', 'notify-subscribers' );
			$email_error = get_option( 'email_error' ) != '' ? get_option( 'email_error' ) : __( 'The field is required', 'notify-subscribers' );
			$invalid_email = get_option( 'invalid_email_error' ) != '' ? get_option( 'invalid_email_error' ) : __( 'The e-mail address entered is invalid', 'notify-subscribers' );
			wp_localize_script( 'notify-subscribers-js', 'ajax', 
				array( 
					'url' => admin_url( 'admin-ajax.php' ), 
					'nonce' => wp_create_nonce( 'notify-subscribers', 'notify-subscribers' ), 
					'subscriberPage' => $thank_you_page,
					'firstname_error' => $firstname_error,
					'email' => $email_error,
					'invalid_email' => $invalid_email
				) 
			);
		}
	}
}
