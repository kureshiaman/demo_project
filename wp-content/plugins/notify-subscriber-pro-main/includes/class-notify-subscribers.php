<?php
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'admin/widgets/widget.php';
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'public/class-notify-subscribers-public.php';
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'admin/class-notify-subscribers-admin.php';
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'admin/fields.php';
require_once NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'admin/pages/settings.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/pdf/class-notify-subscribers-pdf.php';
require_once plugin_dir_path( __FILE__ ) . 'lib/mailchimp/src/mailchimpRoot.php';

if ( ! class_exists( 'Notify_Subscribers' ) ) {

	class Notify_Subscribers extends Notify_Subscribers_Gutenberg {

		/**
		 * Calling function __contructor.
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( 'Notify_Subscribers_Public', 'enqueue_script_public' ) );
			add_filter( 'notify_subscribers_create_form', array( 'Notify_Subscribers_Field', 'notify_subscribers_frontsite_form' ) );
			add_filter( 'notify_subscribers_admin_setting_field', array( 'Notify_Subscribers_Field', 'notify_subscribers_setting_field' ) );
			add_filter( 'notify_subscribers_mail_template', array( 'Notify_Subscribers_Field', 'notify_subscribers_mail_template' ) );
			add_filter( 'notify_subscribers_error_message', array( 'Notify_Subscribers_Field', 'notify_subscribers_error_message' ) );
			// Export user data.
			add_action( 'admin_init', array( $this, 'notify_subscribers_export_to_csv' ) );
			add_action( 'admin_init', array( $this, 'notify_subscribers_pdf_download' ) );
			add_filter( 'notify_subscribers_exclude_data', array( $this, 'notify_subscribers_exclude_data' ) );
			// Setting option.
			add_action( 'admin_menu', array( $this->notify_subscribers_admin(), 'notify_subscribers_setting_option' ) );
			// Get options filter.
			add_filter( 'ns_options', array( $this, 'notify_subscribers_options' ), 10, 1 );
			// MailChimp subscription filter.
			add_filter( 'ns_mailchimp', array( $this, 'notify_subscribers_mailchimp' ), 10, 3 );
			// Admin actions.
			add_action( 'admin_enqueue_scripts', array( $this->notify_subscribers_admin(), 'notify_subscribers_enqueue_script_admin' ) );
			add_action( 'publish_future_post', array( $this->notify_subscribers_admin(), 'notify_subscribers_publish_future_post' ) );
			add_action( 'save_post', array( $this->notify_subscribers_admin(), 'notify_subscribers_update' ), 10, 3 );
			if ( function_exists( 'register_block_type' ) ) {
				add_action( 'add_meta_boxes', array( $this, 'notify_subscribers_gutenberg_editor_metabox' ) );
			} else {
				add_action( 'post_submitbox_misc_actions', array( $this->notify_subscribers_admin(), 'notify_subscribers_box' ) );
			}
			add_filter( 'safe_style_css', array( $this, 'notify_subscribers_safe_style_css' ) );
		}

		/**
		 * Add safe style css attribute.
		 * 
		 * @param array $styles Styles.
		 * @return array
		 */
		public function notify_subscribers_safe_style_css( $styles ) {
			$styles[] = 'display';
			return $styles;
		}

		/**
		 * Notify subscribers pdf download.
		 */
		public function notify_subscribers_pdf_download() {
			// Instanciation of inherited class
			if ( ( isset( $_GET['ns-pdf'] ) ) && ( wp_verify_nonce( $_GET[ 'ns-pdf' ], 'ns-pdf' ) ) ) {
				$pdf_filename = 'notify-subscribers-users-' . date( 'Y-m-d-H-i-s' ) . '.pdf';
				$pdf = new Notify_Subscribers_PDF();
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont( 'Times', '', 12 );
				// user data
				$pdf_userdata = apply_filters( 'notify_subscribers_user_details', array() );
				// Table header
				$header = array( '#', 'First Name', 'Last Name', 'Username', 'Email', 'Role' );
				// Table data
				$data = array();
				$count = 1;
				foreach( $pdf_userdata as $pdfdata ) {
					if ( ( in_array( 'subscriber', $pdfdata->roles ) ) || ( empty( $pdfdata->roles ) ) ) {
						// User role.
						$pdf_user_role = ! empty( $pdfdata->roles ) ? 'Subscriber' : '-';
						// Get first name.
						$pdf_first_name = get_user_meta( $pdfdata->ID, 'first_name', true ) != '' ? get_user_meta( $pdfdata->ID, 'first_name', true ) : '-';
						// Get last name.
						$pdf_last_name = get_user_meta( $pdfdata->ID, 'last_name', true ) !='' ? get_user_meta( $pdfdata->ID, 'last_name', true ) : '-';
						// array store data.
						$data[] = array( $count, $pdf_first_name, $pdf_last_name, $pdfdata->user_login, $pdfdata->user_email, $pdf_user_role );
						// count row.
						$count++;
					}
				}
				// PDF html table
				$pdf->BasicTable( $header, $data );
				// Download pdf file
				$pdf->Output( $pdf_filename , 'D' );
			}
		}

		/**
		 *  CSV File Export
		 */
		public function notify_subscribers_export_to_csv() {
			global $wpdb;
			// if check csv get action
			if ( ( isset( $_GET[ 'ns-csv' ] ) ) && ( wp_verify_nonce( $_GET[ 'ns-csv' ], 'ns-csv' ) ) ) {
				// User query argument.
				$args = array(
					'fields' => 'all_with_meta',
					'role' => '',
					'order' => 'desc',
					'orderby' => 'first_name',
				);
				$users = get_users( $args );
				// Not found user.
				if ( ! $users ) {
					$referer = add_query_arg( 'error', 'empty', wp_get_referer() );
					wp_redirect( $referer );
					exit;
				}
				// CSV file name and header set.
				$filename = 'notify-subscribers-users.' . date( 'Y-m-d-H-i-s' ) . '.csv';
				header( 'Content-Description: File Transfer' );
				header( 'Content-Disposition: attachment; filename=' . $filename );
				header( 'Content-Type: text/csv; charset=' . get_option( 'blog_charset' ), true );
				// User exclude data filter
				$user_exclude_data = apply_filters( 'notify_subscribers_exclude_data', array() );
				// Array key set
				$user_data_keys = array(
					'user_login',
					'user_pass',
					'user_nicename',
					'user_email',
					'user_url',
					'user_registered',
					'user_activation_key',
					'user_status',
					'display_name'
				);
				// Required field.
				$required_fields = array(
					'user_login',
					'first_name',
					'last_name',
					'display_name',
					'user_nicename',
					'user_email',
					'user_nicename',
					'user_registered',
				);
				// Get user meta.
				$user_meta_keys = $wpdb->get_results( "SELECT distinct(meta_key) FROM $wpdb->usermeta" );
				$user_meta_keys = wp_list_pluck( $user_meta_keys, 'meta_key' );
				// Array merge ( user key and meta key )
				$user_fields = array_merge( $user_data_keys, $user_meta_keys );
				// user_fields loop.
				$headers = array();
				foreach ( $user_fields as $key => $user_field ) {
					if ( in_array( $user_field, $user_exclude_data ) )
						unset( $user_fields[$key] );
					else
						if ( in_array( $user_field, $required_fields ) ) {
							$headers[] = '"' . ucfirst( str_replace( '_', ' ', $user_field ) ) . '"';
						}
				}
				echo implode( ',', $headers ) . "\n";

				// user data loop.
				foreach ( $users as $user ) {
					if ( ( in_array( 'subscriber', $user->roles ) ) || ( empty( $user->roles ) ) ) {
						$data = array();
						foreach ( $user_fields as $user_field ) {
							$user_field->wp_capabilities = ! empty( $user_field->wp_capabilities ) ? 'subscriber' : '-';
							if ( in_array( $user_field, $required_fields ) ) {
								$value = ! empty( $user->$user_field ) ? $user->$user_field : '-';
								$value = is_array( $value ) ? serialize( $value ) : $value;
								$data[] = '"' . str_replace( '"', '""', $value ) . '"';
							}
						}
						echo implode( ',', $data ) . "\n";
					}
				}
				exit;
			}
		}

		/**
		 * Notify subscribers exclude data.
		 *
		 * @return array ( users exclude data )
		 */
		public function notify_subscribers_exclude_data() {
			$exclude = array( 'user_pass', 'user_activation_key', 'user_registered' );
			return $exclude;
		}

		/**
		 * Admin form get object.
		 */
		public static function notify_subscribers_load_admin_form() {
			new Notify_Subscribers_Form;
		}

		/**
		 * Admin page get class object.
		 */
		public function notify_subscribers_admin() {
			$plugin_admin = new Notify_Subscribers_Admin;
			return $plugin_admin;
		}

		/**
		 * Create unsubscriber url.
		 */
		public function notify_subscribers_unsubscribe_url( $email, $str_random ) {
			$unsubscribe = home_url( '/unsubscriber' );
			$unsubscribe_url = strstr( $unsubscribe, '?' ) ? '&' : '?';
			return '<a href="'. $unsubscribe . $unsubscribe_url . 'notifyemail=' . $email . '&key=' . $str_random .'" target="_blank">Unsubscribe</a>';
		}

		/**
		 * Send unsubscribe user email.
		 */
		public function notify_subscribers_unsubscribe( $email, $key ) {
				$user = get_user_by( 'email',$email );
				if ( ( ! empty( $user->roles ) ) && ( ! empty( $key ) ) ) {
					$user_subscriber = $user->set_role( 'unconfirmed' );
					// Unsubscriber mail send
					$subject = get_option( 'unsubscribe_mail_subject' );
					$body = get_option( 'unsubscribe_mail_body' );
					
					if( $user_subscriber == null ) {
						// Admin mail
						$admin_res = $this->notify_subscribers_admin_notification( $user->user_login, $user->user_email, 'Unsubscribe User', 'Unsubscribe User on your site' );
						// User
						$user_res  = $this->notify_subscribers_user_notification( $email, $subject, $body, '', 'unsubscribe' );
						wp_redirect( esc_attr( home_url( '/unsubscriber/' ) ) );
						exit;
					}
				} else {
					wp_redirect( esc_attr( home_url( '/' ) ) );
					exit;
				}
		}

		/**
		 * Send mail( admin notification )
		 */
		public function notify_subscribers_admin_notification( $user_name, $user_email ) {
			$headers   = array( 'MIME-Version: 1.0', 'Content-Type: text/html; charset=UTF-8', 'From: ' . $user_name . ' <' . $user_email . '>' );
			// Subject line.
			$subject = __( 'New User Registration', 'notify-subscribers' );
			if ( get_option( 'admin_mail_subject' ) ) {
				$subject = get_option( 'admin_mail_subject' );
			}
			// Admin email.
			$admin_email = get_option( 'admin_email' );
			if ( get_option( 'admin_mail_to' ) ) {
				$admin_email = get_option( 'admin_mail_to' );
			}
			// Mail body.
			$message = '';
			if ( get_option( 'admin_mail_body' ) ) {
				$message = get_option( 'admin_mail_body' );
			}
			$message = str_replace( array( '[{USER_NAME}]', '[{USER_EMAIL}]', '[{SITE_NAME}]' ), array( $user_name, $user_email, $site_name ), $message );
			$message = $this->notify_subscribers_global_replace( $message );
			if ( ! empty( $message ) && ! empty( $admin_email ) ) {
				$result = wp_mail( $admin_email, $subject, $message, $headers );
			}
		}

		/**
		 * Send wp_mail().
		 */
		public function notify_subscribers_user_notification( $to, $subject, $body, $post, $unsubscribe = '' ) {
			if ( ( isset( $post ) ) && ( $post != null ) ) {
				// get user email
				$subscriber_email = $this->notify_subscribers_admin()->notify_subscribers_get_email( 'Subscriber' );
				// post notification email
				foreach ( $subscriber_email as  $notify_email ) {
					$admin_subject = $this->notify_subscribers_replace( $post->ID, get_option( 'notify_mail_subject' ) );
					$getbody = $this->notify_subscribers_replace( $post->ID, get_option( 'notify_mail_body' ) );
					$cleanbody = str_replace( '[{UNSUBSCRIBE}]', $this->notify_subscribers_unsubscribe_url( $notify_email, md5( microtime() ) ), $getbody );
					ob_start();
					echo '<!DOCTYPE html>
							<html>
								<head>
									<title>' . get_option( 'blogname' ) . '</title>
								</head>
								<body>' . $cleanbody . '</body>
							</html>';
					$body = ob_get_clean();
					// Get fromname & email.
					$from_email = get_option( 'notify_mail_from_email', get_option( 'admin_email' ) );
					$from_email = ! empty( $from_email ) ? $from_email : get_option( 'admin_email' );
					$from_name = get_option( 'notify_mail_from_name', get_bloginfo( 'name' ) );
					$from_name = ! empty( $from_name ) ? $from_name : get_bloginfo( 'name' );
					// End.
					$headers = array( 'MIME-Version: 1.0', 'Content-Type: text/html; charset=UTF-8', 'From: ' . $from_name . ' <' . $from_email . '>' );
					$result = wp_mail( $notify_email, $admin_subject, $body, $headers );
				}
			} else {
				// Subscriber && Unsubscriber user email.
				$subscriber_subject  = $this->notify_subscribers_global_replace( $subject );
				$subscriber_get_body = $this->notify_subscribers_global_replace( $body );
				$cleanbody = str_replace( '[{UNSUBSCRIBE}]', $this->notify_subscribers_unsubscribe_url( $to, md5( microtime() ) ), $subscriber_get_body );
				ob_start();
				echo '<!DOCTYPE html>
						<html>
							<head>
								<title>' . get_option( 'blogname' ) . '</title>
							</head>
							<body>' . $cleanbody . '</body>
						</html>';
				$subscriber_body = ob_get_clean();
				// Get fromname & email.
				$option_prefix = 'subscribe_';
				if ( ! empty( $unsubscribe ) && 'unsubscribe' === $unsubscribe ) {
					$option_prefix = 'unsubscribe_';
				}
				$from_email = get_option( $option_prefix . 'mail_from_email', get_option( 'admin_email' ) );
				$from_email = ! empty( $from_email ) ? $from_email : get_option( 'admin_email' );
				$from_name = get_option( $option_prefix . 'mail_from_name', get_bloginfo( 'name' ) );
				$from_name = ! empty( $from_name ) ? $from_name : get_bloginfo( 'name' );
				// End.
				$subscriber_headers = array( 'MIME-Version: 1.0', 'Content-type: text/html; charset=iso-8859-1', 'From: ' . $from_name . ' <' . $from_email . '>' );
				wp_mail( $to, $subscriber_subject, $subscriber_body, $subscriber_headers );
			}
		}

		/**
		 * Global mail template shortcodes.
		 */
		private function notify_subscribers_global_replace( $replace_str = '' ) {
			$str = array(
				'[{SITE_NAME}]',
				'[{SITE_DESCRIPTION}]',
				'[{SITE_URL}]',
				'[{SITE_LINK}]',
				'[{ADMIN_EMAIL}]'
			);
			$replace_with = array(
				get_bloginfo( 'name' ),
				get_bloginfo( 'description' ),
				get_option( 'home' ),
				'<a href="' . get_option( 'siteurl' ) . '" target="_blank">' . get_bloginfo( 'name' ) . '</a>',
				get_option( 'admin_email' ),
			);
			return str_replace( $str, $replace_with, $replace_str  );
		}

		/**
		 * Post & page email template shortcodes.
		 */
		private function notify_subscribers_replace( $post_id = 0, $replace_str = '' ) {
			$post = get_post( $post_id );
			$excerpt = $post->post_excerpt ? $post->post_excerpt : '-- None --';
			$content = $post->post_content ? $post->post_content : '-- None --';
			$post_tags = get_the_tag_list( '', __( ', ', '', $post->ID ) ) ? get_the_tag_list( '', __( ', ', '', $post->ID ) ) : '-- None --';
			$post_category = get_the_category_list( __( ', ', '', $post->ID ) ) ? get_the_category_list( __( ', ', '', $post->ID ) ) : '-- None --';
			$str = array(
				'[{SITE_NAME}]',
				'[{SITE_DESCRIPTION}]',
				'[{SITE_URL}]',
				'[{SITE_LINK}]',
				'[{POST_NAME}]',
				'[{POST_CONTENT}]',
				'[{POST_EXCERPT}]',
				'[{POST_CATEGORIES}]',
				'[{POST_TAGS}]',
				'[{POST_FEATURED_IMAGE}]',
				'[{PERMALINK}]',
				'[{AUTHOR}]',
				'[{ADMIN_EMAIL}]',
				'[{AUTHOR_EMAIL}]',
				);
			$replacewith = array(
				get_bloginfo( 'name' ),
				get_bloginfo( 'description' ),
				get_option( 'home' ),
				'<a href="' . get_option( 'siteurl' ) . '" target="_blank">' . get_bloginfo( 'name' ) . '</a>',
				stripslashes($post->post_title),
				$content,
				$excerpt,
				$post_category,
				$post_tags,
				$this->notify_subscribers_post_thumbnail( $post->ID ),
				get_permalink( $post->ID ),
				stripslashes( get_the_author_meta( 'display_name', $post->post_author ) ),
				get_option( 'admin_email' ),
				get_the_author_meta( 'user_email', $post->post_author ),
			);
			return str_replace ( $str, $replacewith, $replace_str );
		}

		/**
		 * Get post thumbnail URL.
		 */
		private function notify_subscribers_post_thumbnail( $post_id ) {
			if ( has_post_thumbnail( $post_id ) ) {
				return '<a href="' . get_permalink( $post_id ) . '" target="_blank">' . get_the_post_thumbnail( $post_id ) . '</a>';
			} else {
				return '-';
			}
		}

		/**
		 * Notifies subscribers options.
		 *
		 * @param      string  $key    The key
		 *
		 * @return     string  ( return setting options )
		 */
		public function notify_subscribers_options( $key ) {
			return maybe_unserialize( get_option( $key ) );
		}

		/**
		 * Notifies a subscribers mailchimp.
		 *
		 * @param      string  $email  The email
		 * @param      string  $fname  The filename
		 * @param      string  $lname  The lname
		 */
		public function notify_subscribers_mailchimp( $email = '', $fname = '', $lname = '' ) {
			// Get options.
			$mailchimp_data = apply_filters( 'ns_options', 'ns-mailchimp' );
			// If check mail chimp enabled or not.
			if ( isset( $mailchimp_data['on_off'] ) ) {
				// If check API key and list.
				if ( ( ! empty( $mailchimp_data['mailchimp_api'] ) ) && ( ! empty( $mailchimp_data['mailchimp_list'] ) ) ) {
					$mailchimp = new Mailchimp( $mailchimp_data['mailchimp_api'] );
					$merge_values = array( "FNAME" => $fname, "LNAME" => $lname );
					$post_params = array("email_address" => $email, "status" => "subscribed", "email_type" => "html", "merge_fields" => $merge_values );
					$mailchimp->lists( $mailchimp_data['mailchimp_list'] )->members()->POST( $post_params );
					return true;
				}
			}
			return false;
		}
	}
}