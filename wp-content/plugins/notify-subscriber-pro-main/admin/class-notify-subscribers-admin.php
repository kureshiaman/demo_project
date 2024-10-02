<?php
if ( ! class_exists( 'Notify_Subscribers_Admin' ) ) {

	class Notify_Subscribers_Admin {
		
		var $valid;
		var $empty = true;

		/**
		 * Calling function __contructor.
		 */
		public function __construct() {
			add_filter( 'notify_subscribers_user_details', array( $this, 'notify_subscribers_user_details' ) );
			add_action( 'admin_init', array( $this, 'notify_subscribers_process_forms' ) );
		}

		/**
		 *  Admin panel settings option
		 *  Register admin menu.
		 */
		public function notify_subscribers_setting_option() {
			$ns_menu_hooks = add_menu_page( __( 'Notify Subscribers', 'notify-subscribers' ), __( 'Notify Subscribers', 'notify-subscribers' ), 'manage_options', 'notify-subscribers', array( 'Notify_Subscribers', 'notify_subscribers_load_admin_form' ), NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/images/menu-icon.png' );

			$ns_mailchimp_hooks = add_submenu_page( 'notify-subscribers', __( 'MailChimp', 'notify-subscribers' ), __( 'MailChimp', 'notify-subscribers' ), 'manage_options', 'ns-mailchimp', array( $this, 'notify_subscribers_mailchimp' ) );

			$ns_submenu_hooks = add_submenu_page( 'notify-subscribers', __( 'Options', 'notify-subscribers' ), __( 'Options', 'notify-subscribers' ), 'manage_options', 'ns-options', array( $this, 'notify_subscribers_post_type' ) );
		}

		/**
		 * Add scripts & styles for an admin panel.
		 */
		public function notify_subscribers_enqueue_script_admin() {
			if ( ( isset( $_GET['page'] ) ) && ( $_GET['page'] == 'notify-subscribers' || $_GET['page'] == 'ns-options' || $_GET['page'] == 'ns-mailchimp' ) ) {
				// CSS
				wp_enqueue_style( 'bootstrap-min', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/css/bootstrap.min.css' );
				wp_enqueue_style( 'datatables-min',  NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/css/dataTables.bootstrap.min.css' );
				wp_enqueue_style( 'notify-subscribers-theme', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/css/notify-subscribers-theme.css' );
				// JS
				wp_enqueue_script( 'bootstrap-js', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/js/bootstrap.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'datatables-js', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/js/jquery.dataTables.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'datatables-bootstrap-js', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/js/dataTables.bootstrap.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'notify-subscribers-js', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/js/notify-subscribers-admin.js', array('jquery'), '', true );
			}
			wp_enqueue_style( 'notify-subscribers', NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'admin/css/notify-subscribers-admin.css' );
		}

		/**
		 * Get user details.
		 */
		public function notify_subscribers_user_details() {
			$user_details = get_users( array( 'role' => 'Subscriber', 'order' => 'desc', 'orderby' => 'first_name', 'number' => -1 ) );
			return $user_details;
		}

		/**
		 * Get subscriber user's email ID.
		 */
		public function notify_subscribers_get_email( $role ) {
			$user_query = new WP_User_Query( array ( 'role' => $role ) );
			$email_addresses = array();
			foreach ( $user_query->results as $user ) {
				$email_addresses[] = $user->user_email;
			}
			return $email_addresses;
		}

		/**
		 * Add Notification Checkbok To 'Publish' in a metabox.
		 */
		public function notify_subscribers_box() {
			global $post;
			$get_settings = $this->notify_subscribers_all_post_types();
			// If check allow post types.
			if ( ( count( $get_settings ) == 1 ) || ( $post && array_key_exists( $post->post_type, $get_settings ) ) ) :
				echo '<div class="subscribebox"><label>';
				$checked = ! empty( $this->notify_subscribers_notification_send( $post->ID )[0] ) ? 'checked disabled' : '';
				echo '<input type="checkbox" value="1" name="notification_send" ' . $checked . ' />&nbsp; ';
				echo sprintf( __( '%s', 'notify-subscribers' ), 'Notify Subscribers' );
				echo '</div>';
			endif;
		}

		/**
		 * Schedule post notification.
		 *
		 * @param int $post_id Post ID.
		 */
		public function notify_subscribers_publish_future_post( $post_id ) {
			$post = get_post( $post_id );
			$set_post_types = $this->notify_subscribers_all_post_types();
			// If check post exists OR not.
			if ( empty( $post ) ) {
				return;
			}
			// Check post status is `publish` OR not.
			if ( 'publish' != $post->post_status ) {
				return;
			}
			// If check post type allow OR not.
			if ( ! array_key_exists( $post->post_type, $set_post_types ) ) {
				return;
			}
			// Send schedule post notification to users.
			$notify_send =  ! empty( $this->notify_subscribers_notification_send( $post->ID )[0] ) ? 1 : 0;
			if ( empty( $notify_send ) ) {
				update_post_meta( $post->ID, 'notification_send', 1 );
				notify_subscribers_run()->notify_subscribers_user_notification( '', '', '', $post );
			}
		}

		/**
		 * Save/update post.
		 */
		public function notify_subscribers_update( $post_id, $post, $update ) {
			global $post;
			$set_post_types = $this->notify_subscribers_all_post_types();
			// If check post status and allow post type OR not.
			if ( ! $post || $post->post_status != 'publish' || ! array_key_exists( $post->post_type, $set_post_types ) ) return;
			// Send notification.
			$notify_send =  ! empty( $this->notify_subscribers_notification_send( $post->ID )[0] ) ? 1 : 0;
			$notify_checked = isset( $_POST['notification_send'] ) == 1 ? 1 : 0;
			// notification mail send
			if ( empty( $notify_send ) && $notify_checked ) {
				update_post_meta( $post->ID, 'notification_send', sanitize_text_field( $notify_checked ) );
				notify_subscribers_run()->notify_subscribers_user_notification( '', '', '', $post );
			}
		}

		/**
		 * Check Whether Email Is Sent For post notification.
		 */
		public function notify_subscribers_notification_send( $id ) {
			return get_post_meta( $id, 'notification_send' );
		}

		/**
		 * Notify subscribers all post types.
		 *
		 * @return array ( return all post types array )
		 */
		public function notify_subscribers_all_post_types() {
			$data = unserialize( get_option( 'ns-post-types' ) );
			return ! empty( $data ) ? $data : array();
		}

		/**
		 * Notify subscribers get all post types.
		 */
		public function notify_subscribers_get_post_types() {
			// Get all register post type.
			$post_types = get_post_types( array( 'public'	=> true, '_builtin' => false ) , OBJECT, 'and' );
			$postdata = array();
			foreach ( $post_types as $key => $val ) {
				$postdata[$key] = $val->labels->name;
			}
			$postdata['post']	= 'Standard Posts';
			return $postdata;
		}

		/**
		 * Notify subscribers process forms.
		 */
		public function notify_subscribers_process_forms() {
			$post_types = array();

			if ( isset( $_POST['post-type-save'] ) ) {
				// Unset post data.
				unset( $_POST['post-type-save'] );
				// Add new value.
				$_POST['ns_exclude_post'][] = 'page';
				foreach ( $_POST['ns_exclude_post'] as $post_value ) {
					$post_types[$post_value] = '1';
				}
				// Save post types settings.
				update_option( 'ns-post-types', serialize( $post_types ) );
				// Save options.
				update_option( 'ns-config', serialize( $_POST['config'] ) );
				// Admin notice.
				add_action( 'admin_notices', array( $this , 'notify_subscribers_admin_notice' ) );
			}
			// MailChimp
			if ( isset( $_POST['mailchimp-save'] ) ) {
				$apikey = $_POST['mailchimp']['mailchimp_api'];
				// If check API Key empty or not.
				if ( ! empty( $apikey ) ) {
					// If check API Key validate or not.
					if ( preg_match( '/^[0-9a-z]{32}(-us.*)?$/', $apikey, $matches ) ) {
						$mailchimp = new Mailchimp( $apikey );
						$this->valid = $mailchimp->lists( $_POST['mailchimp']['mailchimp_list'] )->GET();
						// If check API status.
						if ( ( isset( $this->valid->status ) ) && ( $this->valid->status == 401 || $this->valid->status == 404 ) ) {
							unset( $_POST['mailchimp']['on_off'] );
							add_action( 'admin_notices', function() {
								echo '<div class="notice notice-error is-dismissible"><p><strong>' . $this->valid->detail . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'notify-subscribers' ) . '</span></button></div>';
							} );
							$this->empty = false;
						}
					} else {
						add_action( 'admin_notices', function() {
							echo '<div class="notice notice-error is-dismissible"><p><strong>' . __( 'You must provide a valid API key.', 'notify-subscribers' ) . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'notify-subscribers' ) . '</span></button></div>';
						} );
						$this->empty = false;
					}
				} else {
					unset( $_POST['mailchimp']['on_off'] );
					add_action( 'admin_notices', function() {
						echo '<div class="notice notice-error is-dismissible"><p><strong>' . __( 'Please fill in all required fields', 'notify-subscribers' ) . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'notify-subscribers' ) . '</span></button></div>';
					} );
					$this->empty = false;
				}
				// Save options.
				if ( $this->empty ) {
					update_option( 'ns-mailchimp', serialize( $_POST['mailchimp'] ) );
					// Admin notice.
					add_action( 'admin_notices', array( $this , 'notify_subscribers_admin_notice' ) );
				}
			}
		}

		/**
		 * Notify subscribers post type.
		 */
		public function notify_subscribers_post_type() {
			$get_all_post_types = $this->notify_subscribers_get_post_types();
			$set_post_types = $this->notify_subscribers_all_post_types();
			require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . '/admin/pages/options.php';
		}

		/**
		 * Notify subscribers mailchimp.
		 */
		public function notify_subscribers_mailchimp() {
			require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . '/admin/pages/mailchimp.php';
		}

		/**
		 * Notify a subscribers admin notice.
		 */
		public function notify_subscribers_admin_notice() {
			echo '<div class="notice notice-success is-dismissible"><p><strong>' . __( 'Settings saved.', 'notify-subscribers' ). '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'notify-subscribers' ) . '</span></button></div>';
		}
	}
}