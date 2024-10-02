<?php
if ( ! class_exists( 'Notify_Subscribers_Field' ) ) {

	class Notify_Subscribers_Field {

		/**
		 * Plugin setting form fields which show in admin side.
		 * @return array
		 */
		public static function notify_subscribers_setting_field() {
			$subscribe_setting = array(
				'form' => array(
					'id' => 'notify-subscribers',
					'class' => 'notify-subscribers',
					'nonce' => wp_create_nonce( 'notify-subscribers-setting' ),
				),
				'div_form' => array(
					'div_class' => 'ns-admin-fieldset-group',
					'form' => array(
						'title'=> __( 'Form', 'notify-subscribers' ),
						array(
							'type' => 'text',
							'label' => __( 'Class', 'notify-subscribers' ),
							'field_name' => 'form_class',
							'class' => 'ns-input'
						)
					),
					'firstname' => array(
						'title'=> __( 'First Name', 'notify-subscribers' ),
						array(
							'type' => 'checkbox',
							'label' => __( 'Enable / Disable', 'notify-subscribers' ),
							'field_name' => 'first_name',
						),
						array(
							'type' => 'text',
							'label' => __( 'Label', 'notify-subscribers' ),
							'field_name' => 'firstname_label',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Wrapper', 'notify-subscribers' ),
							'field_name' => 'firstname_wrapper',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Class', 'notify-subscribers' ),
							'field_name' => 'firstname_class',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Placeholder', 'notify-subscribers' ),
							'field_name' => 'firstname_placeholder',
							'class' => 'ns-input'
						),
					),
					'lastname' => array(
						'title'=> __( 'Last Name', 'notify-subscribers' ),
						array(
							'type' => 'checkbox',
							'label' => __( 'Enable / Disable', 'notify-subscribers' ),
							'field_name' => 'last_name',
						),
						array(
							'type' => 'text',
							'label' => __( 'Label', 'notify-subscribers' ),
							'field_name' => 'lastname_label',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Wrapper', 'notify-subscribers' ),
							'field_name' => 'lastname_wrapper',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Class', 'notify-subscribers' ),
							'field_name' => 'lastname_class',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Placeholder', 'notify-subscribers' ),
							'field_name' => 'lastname_placeholder',
							'class' => 'ns-input'
						),
					),
					'email' => array(
						'title'=> __( 'Email', 'notify-subscribers' ),
						array(
							'type' => 'text',
							'label' => __( 'Label', 'notify-subscribers' ),
							'field_name' => 'email_label',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Wrapper', 'notify-subscribers' ),
							'field_name' => 'email_wrapper',
							'class' => 'ns-input'
						),
						array(
							'type' =>'text',
							'label' => __( 'Class', 'notify-subscribers' ),
							'field_name' => 'email_class',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Placeholder', 'notify-subscribers' ),
							'field_name' => 'email_placeholder',
							'class' => 'ns-input'
						),
					),
					'submit' => array(
						'title'=> __( 'submit button', 'notify-subscribers' ),
						array(
							'type' => 'text',
							'label' => __( 'Name', 'notify-subscribers' ),
							'field_name' => 'submin_btn_name',
							'class' => 'ns-input'
						),
						array(
							'type' => 'text',
							'label' => __( 'Class', 'notify-subscribers' ),
							'field_name' => 'submin_btn_class',
							'class' => 'ns-input'
						)
					),
				),
				'submit_button' => array(
					'name' => 'notify_setting_save'
				),
			);
			return $subscribe_setting;
		}

		/**
		 * Plugin setting mail form fields.
		 * @return array
		 */
		public static function notify_subscribers_mail_template() {
			$mailform_field = array(
				'form' => array(
					'id' => 'notify-subscribers',
					'class' => 'mail-setting',
					'nonce' => wp_create_nonce( 'notify-subscribers-mailform' ),
				),
				'div_mail' => array(
					'notify_mail' => array(
						'title' => __( 'Notification Template', 'notify-subscribers' ),
						'class' => 'notify_mail',
						array(
							'type' => 'text',
							'label' => __( 'From Email', 'notify-subscribers' ),
							'field_name' => 'notify_mail_from_email',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'From Name', 'notify-subscribers' ),
							'field_name' => 'notify_mail_from_name',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'Subject', 'notify-subscribers' ),
							'field_name' => 'notify_mail_subject',
							'class' => 'ns-input',
							'is_full_width' => true,
						),
						array(
							'type' => 'textarea',
							'label' => __( 'Body', 'notify-subscribers' ),
							'field_name' => 'notify_mail_body',
							'class' => 'ns-input',
							'rows' => 15,
							'cols' => 15
						),
					),
					'subscriber_confirmation' => array(
						'title' => __( 'Subscriber Template', 'notify-subscribers' ),
						'class' => 'subscriber_confirmation',
						array(
							'type' => 'text',
							'label' => __( 'From Email', 'notify-subscribers' ),
							'field_name' => 'subscribe_mail_from_email',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'From Name', 'notify-subscribers' ),
							'field_name' => 'subscribe_mail_from_name',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'Subject', 'notify-subscribers' ),
							'field_name' => 'subscribe_mail_subject',
							'class' => 'ns-input',
							'is_full_width' => true,
						),
						array(
							'type' => 'textarea',
							'label' => __( 'Body', 'notify-subscribers' ),
							'field_name' => 'subscribe_mail_body',
							'class' => 'ns-input',
							'rows' => 15,
							'cols' => 15
						),
					),
					'unsubscriber' => array(
						'title' => __( 'Unsubscriber Template', 'notify-subscribers' ),
						'class' => 'unsubscriber',
						array(
							'type' => 'text',
							'label' => __( 'From Email', 'notify-subscribers' ),
							'field_name' => 'unsubscribe_mail_from_email',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'From Name', 'notify-subscribers' ),
							'field_name' => 'unsubscribe_mail_from_name',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'Subject', 'notify-subscribers' ),
							'field_name' => 'unsubscribe_mail_subject',
							'class' => 'ns-input',
							'is_full_width' => true,
						),
						array(
							'type' => 'textarea',
							'label' => __( 'Body', 'notify-subscribers' ),
							'field_name' => 'unsubscribe_mail_body',
							'class' => 'ns-input',
							'rows' => 15,
							'cols' => 15
						),
					),
					'admin' => array(
						'title' => __( 'Admin Notification', 'notify-subscribers' ),
						'class' => 'admin_notification',
						array(
							'type' => 'text',
							'label' => __( 'Admin Email', 'notify-subscribers' ),
							'field_name' => 'admin_mail_to',
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'label' => __( 'Subject', 'notify-subscribers' ),
							'field_name' => 'admin_mail_subject',
							'class' => 'ns-input'
						),
						array(
							'type' => 'textarea',
							'label' => __( 'Body', 'notify-subscribers' ),
							'field_name' => 'admin_mail_body',
							'class' => 'ns-input',
							'rows' => 15,
							'cols' => 15,
							'help_text' => '[{USER_NAME}], [{USER_EMAIL}], [{SITE_NAME}]',
						),
					),
				),
				'submit_button' => array(
					'name' => 'notify_mail_setting'
				),
			);
			return $mailform_field;
		}

		/**
		 * Error message setting option.
		 * @return array
		 */
		public static function notify_subscribers_error_message() {
			$errormessage = array(
				'form' => array(
					'id' => 'notify-subscribers',
					'class' => 'error_message',
					'nonce' => wp_create_nonce( 'notify-subscribers-error-message' ),
				),
				'div_error' => array(
					'firstname' => array(
						'title' => __( 'First Name', 'notify-subscribers' ),
						array(
							'type' => 'text',
							'field_name' => 'firstname_error',
							'label' => __( 'There is a field that the sender must fill in', 'notify-subscribers' ),
							'class' => 'ns-input',
						),
					),
					'email' => array(
						'title' => __( 'Email', 'notify-subscribers' ),
						array(
							'type' => 'text',
							'field_name' => 'email_error',
							'label' => __( 'There is a field that the sender must fill in', 'notify-subscribers' ),
							'class' => 'ns-input',
						),
						array(
							'type' => 'text',
							'field_name' => 'invalid_email_error',
							'label' => __( 'Email address that the sender entered is invalid', 'notify-subscribers' ),
							'class' => 'ns-input',
						),
					),
				),
				'submit_button' => array(
					'name' => 'notify_error_message'
				),
			);
			return $errormessage;
		}

		/**
		 * Fronted subscriber form.
		 * @return array
		 */
		public static function notify_subscribers_frontsite_form() {
			$frontsite_form = array(
				'form' => array(
					'id' => 'form',
					'class' => get_option( 'form_class', 'notify-subscribers' ),
					'name' => 'form',
					'firstname' => array(
						'type' => 'text',
						'name' => 'firstname',
						'id' => 'firstname',
						'class' => get_option( 'firstname_class', '' ),
						'placeholder' => get_option( 'firstname_placeholder') ? get_option( 'firstname_placeholder') : 'First Name',
						'wrapper' => get_option( 'firstname_wrapper' ),
						'label' => get_option( 'firstname_label' )
					),
					'lastname' => array(
						'type' => 'text',
						'name' => 'lastname',
						'id' => 'lastname',
						'class' => get_option( 'lastname_class', '' ),
						'placeholder' => get_option( 'lastname_placeholder') ? get_option( 'lastname_placeholder') : 'Last Name',
						'wrapper' => get_option( 'lastname_wrapper' ),
						'label' => get_option( 'lastname_label' )
					),
					'email' => array(
						'type' => 'email',
						'name' => 'email',
						'id' => 'email',
						'class' => get_option( 'email_class', '' ),
						'placeholder' => get_option( 'email_placeholder') ? get_option( 'email_placeholder') : 'Email',
						'wrapper' => get_option( 'email_wrapper' ),
						'label' => get_option( 'email_label' )
					),
					'submit' => array(
						'type' => 'submit',
						'name' => 'submit',
						'id' => get_option( 'submin_btn_class', 'submit' ),
						'class' => get_option( 'submin_btn_class', 'submit' ),
						'value' => get_option( 'submin_btn_name') ? get_option( 'submin_btn_name') : __( 'Subscribe', 'notify-subscribers' ),
					),
				),
			);
			if ( ! get_option( 'first_name' ) ) {
				unset( $frontsite_form['form']['firstname'] );
			}
			if ( ! get_option( 'last_name' ) ) {
				unset( $frontsite_form['form']['lastname'] );
			}
			return $frontsite_form;
		}
	}
}
