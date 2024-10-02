<?php
if ( ! class_exists( 'Notify_Subscribers_Form' ) ) {

	class Notify_Subscribers_Form {

		/**
		 * @var $error
		 */
		private $error;
		/**
		 * Calling class __construct.
		 */
		public function __construct() {
			$this->notify_subscribers_admin_setting_option();
		}

		/**
		 * Save or update setting option.
		 * @return true or false
		 */
		private function notify_subscribers_update_option() {

			// Save setting form.
			if ( isset( $_POST['notify_setting_save'] ) ) {
				$_POST['first_name'] = ! empty( $_POST['first_name'] ) ? 1 : 0;
				$_POST['last_name'] = ! empty( $_POST['last_name'] ) ? 1 : 0;
				foreach ( $_POST as $key => $value ) {
					if ( $key == 'nonce' ) {
						$nonce =  $value;
					}
					if ( ( wp_verify_nonce( $nonce , 'notify-subscribers-setting' ) ) && ( $key != "nonce" ) ) {
						update_option( $key, sanitize_text_field( $value ) );
					}
				}
				$this->error = true;
			}

			// save error message.
			if ( isset( $_POST['notify_error_message'] ) ) {
				foreach ( $_POST as $key => $value ) {
					if ( $key == 'nonce' ) {
						$nonce =  $value;
					}
					if ( ( wp_verify_nonce( $nonce , 'notify-subscribers-error-message' ) ) && ( $key != "nonce" ) ) {
						update_option( $key, stripslashes( wp_filter_post_kses( $value ) ) );
					}
				}
				$this->error = true;
			}

			// Save mail template.
			if ( isset( $_POST['notify_mail_setting'] ) ) {
				foreach ( $_POST as $key => $value ) {
					if ( $key == 'nonce' ) {
						$nonce =  $value;
					}
					if ( ( wp_verify_nonce( $nonce , 'notify-subscribers-mailform' ) ) && ( $key != "nonce" ) ) {
						update_option( $key, stripslashes( wp_filter_post_kses( $value ) ) );
					}
				}
				$this->error = true;
			}
			return $this->error;
		}

		/**
		 * Create admin setting form
		 */
		public function notify_subscribers_form_field( $array ) {
			echo '<form action="" method="post" id="' . $array['form']['id'] . '" class="' . $array['form']['class'] . '">';

			if ( isset( $array['form']['nonce'] ) ) {
				echo '<input type="hidden" name="nonce" value="' . $array['form']['nonce'] . '" />';
			}
			$first_in = 0;
			foreach ( $array as $key => $field_array ) {
				if( ( isset( $key ) ) && ( $key != "form" ) && ( $key != "submit_button" ) ) {
					$div_class = isset( $field_array['div_class'] ) ? 'class="' . $field_array['div_class'] . '"'  : '';
					echo '<div '. $div_class .' >';
				}
				foreach ( $field_array as $fieldgroup ) {
					if ( isset( $fieldgroup['title'] ) ) {
						if ( $array['form']['class'] == 'notify-subscribers' || $array['form']['class'] == 'mail-setting' ) {
							$collapseid = '#collapse_' . strtolower( str_replace( ' ', '', $fieldgroup['title'] ) );
							$collapsin = '';
							// Frist collapse open.
							$first_in_class = $first_in == 0 ? 'in' : ''; 
							$first_in_collapsed = $first_in == 0 ? '' : 'collapsed'; 
						} else {
							$collapseid = '';
							$collapsin = 'in';
							// Frist collapse open.
							$first_in_class = '';
							$first_in_collapsed = 'collapsed';
						}
						$fieldgroup['class'] = isset( $fieldgroup['class'] ) ? 'class="' . $fieldgroup['class'] . '"' : '';
						echo '<div class="ns-admin-panel" ' . $fieldgroup['class'] . '><div class="ns-admin-panel-heading"><div class="ns-admin-panel-title ' . $first_in_collapsed . '" data-toggle="collapse" data-parent="#accordion" data-target="' . $collapseid . '">
							<div class="ns-admin-panel-title-icon">
								<div class="ns-icon ns-icon-circle">
									<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									    <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/>
									    <path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								</div>
								<div class="ns-icon ns-icon-down-arrow">
									<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/>
									    <path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								</div>
								<div class="ns-icon ns-icon-up-arrow">
									<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									    <path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"/>
									    <path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								</div>
								<div class="ns-icon ns-icon-plus">
									<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
									    <path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								</div>
								<div class="ns-icon ns-icon-minus">
									<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									    <path d="M19 13H5v-2h14v2z"/>
									    <path d="M0 0h24v24H0z" fill="none"/>
									</svg>
								</div>
							</div>
							<h2>' . $fieldgroup['title'] . '</h2></div></div>';
						echo '<div class="ns-admin-panel-collapse ' . $first_in_class . ' collapse ' . $collapsin . '" id="' . str_replace( '#', '', $collapseid ) . '">';
						echo '<div class="ns-admin-panel-body clearfix">';
						echo '<div class="row">';
						foreach ( $fieldgroup as $get_field ) {
							if ( isset( $get_field['type'] ) ) {
								if ( $get_field['type'] == "checkbox" ) {
									echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
									echo '<div class="ns-admin-checkbox">';
									echo '<div class="ns-admin-checkbox-inner">';
									$checked = get_option( $get_field['field_name'] ) ? 'checked' : '';
									echo '<input type="' . $get_field['type'] . '" name="' . $get_field['field_name'] . '" id="' . $get_field['field_name'] . '" value="1" ' . $checked . ' />';
									echo '<label for="' . $get_field['field_name'] . '"></label>';
									echo '</div">';
									echo'</div>';
									echo '<div class="ns-admin-checkbox-text">';
									echo $get_field['label'];
									echo '</div>';
									echo'</div>';
									echo'</div>';
								}
								if ( $get_field['type'] == "text" ) {
									$cols_class = isset( $get_field['is_full_width'] ) && $get_field['is_full_width'] ? 'col-lg-12 col-md-12 col-sm-12 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
									echo '<div class="' . $cols_class . '"><div class="ns-form-group">';
									echo '<label for="' . $get_field['field_name'] . '">' . $get_field['label'] . '</label>';
									$value = get_option( $get_field['field_name'] ) ? get_option( $get_field['field_name'] ) : '';
									echo '<input type="' .  $get_field['type'] . '" name="' . $get_field['field_name'] . '" id="' . $get_field['field_name'] . '" value="' . esc_html( $value ) . '" class="' . $get_field['class'] . '" />';
									echo '</div></div>';
								}
								if ( $get_field['type'] == "textarea" ) {
									echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="ns-form-group">';
									echo '<label for="' . $get_field['field_name'] . '">' . $get_field['label'] . '</label>';
									$value = get_option( $get_field['field_name'] ) ? get_option( $get_field['field_name'] ) : '';
									$rows = isset( $get_field['rows'] ) ? 'rows="' . $get_field['rows'] . '"' : '';
									$cols = isset( $get_field['cols'] ) ? 'cols="' . $get_field['cols'] . '"' : '';
									echo '<textarea name="' . $get_field['field_name'] . '" id="' . $get_field['field_name'] . '" class="' . $get_field['class'] . '" ' . $rows . ' ' . $cols . ' >' . esc_html( $value ) . '</textarea>';
									if ( isset( $get_field['help_text'] ) && ! empty( $get_field['help_text'] ) ) {
										echo '<div class="ns-help-text"><strong>' . wp_sprintf( __( 'Shortcode: %1$s', 'notify-subscribers' ), $get_field['help_text'] ). '</strong></div>';
									}
									echo '</div></div>';
								}
							}
						}
						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						$first_in ++;
					}
				}
				if( ( isset( $key ) ) && ( $key != "form" ) && ( $key != "submit_button" ) ) {
					echo '</div>';
				}
			}
			echo '<div class="ns-submit">';
			echo submit_button( __( 'save', 'notify-subscribers' ), 'primary', $array['submit_button']['name'], false );
			echo '</div>';
			echo '</form>';
		}

		/**
		 * Notify subscribe setting option.
		 */

		public function notify_subscribers_admin_setting_option() {
			if ( ! current_user_can( 'manage_options' ) ) :
				echo '<h2 class="ns-note">' . __( 'You do not have admin privileges!', 'notify-subscribers' ) . '</h2>';
				exit();
			endif; ?>
		<div id="wrapper">
			<?php // WARN ADMIN IF WP
			global $wp_version;
			if ( version_compare( $wp_version, NOTIFY_SUBSCRIBERS_IN_REQUIRED_WP_VERSION, '<' ) ) {
				echo '<div class="update-nag">';
				echo 'You are using older WordPress (' . $wp_version . '). <strong>' . PLUGIN_NAME . '</strong> requires minimum ' . NOTIFY_SUBSCRIBERS_IN_REQUIRED_WP_VERSION . ' (newest better!). <a href="' . site_url('/wp-admin/update-core.php') . '">Update WordPress</a>';
				echo '</div>';
			} ?>
			<?php if ( $this->notify_subscribers_update_option() ) : ?>
				<div id="message" class="updated notice notice-success is-dismissible ns-notice-success">
					<p><?php _e( 'Settings saved.', 'notify-subscribers' )?></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'notify-subscribers' ); ?></span></button>
				</div>
			<?php endif; ?>
			<div id="page">
				<div class="ns-admin-container">
					<div class="ns-admin-wrapper">
						<div class="ns-admin-wrap">
							<div class="ns-head-name" id="plugin_title">
								<div class="thumb">
									<div class="wrap"><img src="<?php echo NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL;?>admin/images/logo.png"></div>
								</div>
							</div>
							<div id="notify-subscribertab" class="ns-admin-tab">
								<a href="#notify_subscribers_settings" class="active"><?php _e( 'Settings', 'notify-subscribers' );?></a>
								<a href="#notify_subscribers_email_template"><?php _e( 'Email Templates', 'notify-subscribers' );?></a>
								<a href="#notify_subscribers_error_message"><?php _e( 'Error Message', 'notify-subscribers' );?></a>
								<a href="#notify_subscribers_shortcode"><?php _e( 'Short Codes', 'notify-subscribers' );?></a>
								<a href="#notify_subscribers_users"><?php _e( 'User Details', 'notify-subscribers' );?></a>
							</div>
							<div id="notify-subscribers-block" class="ns-admin-tab-content notify_subscribers_settings">
								<div class="ns-tab-pane" id="notify_subscribers_settings">
									<?php
									self::notify_subscribers_form_field( apply_filters( 'notify_subscribers_admin_setting_field', array() ) );
									?>
								</div><!-- #notify-subscribers_subscribe_settings -->
								<div class="ns-tab-pane" id="notify_subscribers_email_template">
									<div id="notify_mailtemplate_block">
										<?php
										self::notify_subscribers_form_field( apply_filters( 'notify_subscribers_mail_template', array() ) );
										?>
									</div>
								</div><!-- #notify-subscribers_subscribe_email_template -->
								<div class="ns-tab-pane" id="notify_subscribers_error_message">
									<?php
									self::notify_subscribers_form_field( apply_filters( 'notify_subscribers_error_message', array() ) );
									?>
								</div>
								<div class="ns-tab-pane" id="notify_subscribers_shortcode">
									<div class="ns-admin-checkbox-message notice notice-info">
										<p class="message">
											<?php _e( 'Following are the keywords, you can you use in email template.', 'notify-subscribers' );?><br/>
											<?php _e( 'Copy the keyword with bracket & curly braces and paste it into email template.', 'notify-subscribers' );?>
										</p>
									</div>
									<div class="ns-admin-panel">
										<div class="ns-admin-panel-heading">
											<div class="ns-admin-panel-title">
												<div class="ns-admin-panel-title-icon">
													<div class="ns-icon ns-icon-circle">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-down-arrow">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-up-arrow">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-plus">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-minus">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M19 13H5v-2h14v2z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
												</div>
												<h2><?php _e( 'Global ShortCode', 'notify-subscribers' ); ?></h2>
											</div>
										</div>
										<div class="ns-admin-panel-collapse collapse in">
											<div class="ns-admin-panel-body clearfix">
												<ul class="short-code-list">
													<li><strong><?php _e( '[{SITE_NAME}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'site name', 'notify-subscribers' ); ?></li>
													<li><strong><?php _e( '[{SITE_URL}]', 'notify-subscribers' ); ?></strong> - <?php echo site_url();?></li>
													<li><strong><?php _e( '[{SITE_LINK}]', 'notify-subscribers' ); ?></strong> - <a href="<?php echo site_url();?>" target="_blank"><?php _e( 'siteurl', 'notify-subscribers' );?></a></li>
													<li><strong><?php _e( '[{SITE_DESCRIPTION}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'site description', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{ADMIN_EMAIL}]', 'notify-subscribers' ); ?></strong> - <?php echo get_option( 'admin_email' ); ?></li>
													<li><strong><?php _e( '[{UNSUBSCRIBE}]', 'notify-subscribers' ); ?></strong> - <?php echo notify_subscribers_run()->notify_subscribers_unsubscribe_url( 'abc@gmail.com', 'random str' ); ?>&nbsp;<?php _e( 'Unsubscriber ', 'notify-subscribers' ) ?>&nbsp;<?php _e( 'page. (Use ONLY for Post Notification email)', 'notify-subscribers' );?></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="ns-admin-panel">
										<div class="ns-admin-panel-heading">
											<div class="ns-admin-panel-title">
												<div class="ns-admin-panel-title-icon">
													<div class="ns-icon ns-icon-circle">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-down-arrow">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-up-arrow">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-plus">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
													<div class="ns-icon ns-icon-minus">
														<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														    <path d="M19 13H5v-2h14v2z"/>
														    <path d="M0 0h24v24H0z" fill="none"/>
														</svg>
													</div>
												</div>
												<h2><?php _e( 'Post/Page Notification ShortCode', 'notify-subscribers' ); ?></h2>
											</div>
										</div>
										<div class="ns-admin-panel-collapse collapse in">
											<div class="ns-admin-panel-body clearfix">
												<ul class="short-code-list">
													<li><strong><?php _e( '[{POST_NAME}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Title of the published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{POST_CONTENT}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Content of published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{POST_EXCERPT}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Excerpt of published post. Note: Excerpt field must not empty!', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{POST_CATEGORIES}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Category of published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{POST_TAGS}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Tags of published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{POST_FEATURED_IMAGE}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Featured image (thumbnail) of published post. (Use ONLY with Post Notification)', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{PERMALINK}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'URL of published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{AUTHOR}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Author Name of published post', 'notify-subscribers' );?></li>
													<li><strong><?php _e( '[{AUTHOR_EMAIL}]', 'notify-subscribers' ); ?></strong> - <?php _e( 'Email of author of published post', 'notify-subscribers' );?></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="ns-tab-pane" id="notify_subscribers_users">
									<div class="notify_subscribers_users_action">
										<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'options-general.php?page=notify-subscribers' ), 'ns-csv', 'ns-csv' ) ); ?>" class="button button-primary"><?php _e( 'Export To CSV', 'notify-subscribers' ); ?></a>
										<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'options-general.php?page=notify-subscribers' ), 'ns-pdf', 'ns-pdf' ) ); ?>" class="button button-primary"><?php _e( 'Export To PDF', 'notify-subscribers' ); ?></a>
									</div>
									<div class="table-responsive">
										<table cellspacing="0" class="table table-hover" id="user-list">
											<thead>
												<tr>
													<th><?php _e( 'No.', 'notify-subscribers' );?></th>
													<th><?php _e( 'First Name', 'notify-subscribers' );?></th>
													<th><?php _e( 'Last Name', 'notify-subscribers' );?></th>
													<th><?php _e( 'Username', 'notify-subscribers' );?></th>
													<th><?php _e( 'Email', 'notify-subscribers' );?></th>
													<th><?php _e( 'Role', 'notify-subscribers' );?></th>
													<th><?php _e( 'Member Since', 'notify-subscribers' );?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$users_details = apply_filters( 'notify_subscribers_user_details', array() );
												$count = 1;
												foreach ( $users_details as $user ) {
													if ( ( in_array( 'subscriber', $user->roles ) ) || ( empty( $user->roles ) ) ) {
														$user_role = ! empty( $user->roles ) ? 'Subscriber' : '-';
														$first_name = get_user_meta( $user->ID, 'first_name', true ) != '' ? get_user_meta( $user->ID, 'first_name', true ) : '-';
														$last_name = get_user_meta( $user->ID, 'last_name', true ) !='' ? get_user_meta( $user->ID, 'last_name', true ) : '-';
														echo '<tr>';
														echo '<td>' . $count . '</td>';
														echo '<td>' . $first_name . '</td>';
														echo '<td>' . $last_name. '</td>';
														echo '<td>' . $user->user_login . '</td>';
														echo '<td>' . $user->user_email . '</td>';
														echo '<td>' . $user_role . '</td>';
														echo '<td>' . date( 'd-M-Y',strtotime( $user->user_registered ) ) . '</td>';
														echo '</tr>';
														$count++;
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div><!-- #notify-subscribers_subscribe_users -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
}
}
