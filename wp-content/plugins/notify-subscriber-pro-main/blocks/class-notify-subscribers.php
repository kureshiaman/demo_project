<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package notify-subscribers
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */

if ( ! class_exists( 'Notify_Subscribers_Gutenberg' ) ) {
	
	class Notify_Subscribers_Gutenberg {

		/**
		 * Class construct
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'notify_subscribers_block_init' ) );
		}

		/**
		 * Notify a subscribers block initialize.
		 */
		public function notify_subscribers_block_init() {
			// Skip block registration if Gutenberg is not enabled/merged.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}
			$dir = dirname( __FILE__ );

			$index_js = 'dist/blocks.build.js';
			wp_register_script(
				'notify-subscribers-block-editor',
				plugins_url( $index_js, __FILE__ ),
				array(
					'wp-blocks',
					'wp-i18n',
					'wp-element',
				),
				filemtime( "$dir/$index_js" ),
				true
			);

			wp_register_style(
				'notify-subscribers-block',
				NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'public/css/notify-subscribers-public.css',
				array(),
				''
			);
			
			wp_register_style(
				'notify-subscribers-block-editor',
				NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL . 'blocks/dist/blocks.editor.build.css',
				array(),
				''
			);

			register_block_type( 'notify-subscribers/notify-subscribers', array(
				'editor_script' 	=> 'notify-subscribers-block-editor',
				'editor_style'  	=> 'notify-subscribers-block-editor',
				'style'         	=> 'notify-subscribers-block',
				'render_callback' => array( $this, 'notify_subscribers_block_reander' ),
				) );

			wp_localize_script( 'notify-subscribers-block-editor', 'NS_FORM',
				array(
					'html' 			=> apply_filters( 'notify_subscribers_create_form', array() ),
					'settings'	=> add_query_arg( 'page', 'notify-subscribers', admin_url( 'admin.php' ) )
				)
			);
		}
		/**
		 * Notify a subscribers gutenberg editor metabox.
		 */
		public function notify_subscribers_gutenberg_editor_metabox() {
			global $post;
			$admin = new notify_subscribers_admin();
			$get_settings = $admin->notify_subscribers_all_post_types();
			if ( ( count( $get_settings ) == 1 ) || ( $post && array_key_exists( $post->post_type, $get_settings ) ) ) :
				// Register metabox
				add_meta_box( 'ns-gutenberg', __( 'Notification', 'notify-subscribers' ), array( $admin, 'notify_subscribers_box' ),
					null, 'side', 'high',
					array(
						'__block_editor_compatible_meta_box' => true,
					)
				);
			endif;
		}

		/**
		 * Notify a subscribers block reander.
		 */
		public function notify_subscribers_block_reander() {
			return do_shortcode( '[notify-subscribers]' );
		}
	}
} 
