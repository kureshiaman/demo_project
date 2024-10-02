<?php
/**
 * Paul Winterowd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Paul_Winterowd
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function paul_winterowd_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Paul Winterowd, use a find and replace
		* to change 'paul-winterowd' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'paul-winterowd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'paul-winterowd' ),
			'footer' => esc_html__( 'Footer', 'paul-winterowd' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'paul_winterowd_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'paul_winterowd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paul_winterowd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paul_winterowd_content_width', 640 );
}
add_action( 'after_setup_theme', 'paul_winterowd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paul_winterowd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'paul-winterowd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'paul-winterowd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'paul_winterowd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function paul_winterowd_scripts() {
	wp_enqueue_style( 'paul-winterowd-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'paul-winterowd-style', 'rtl', 'replace' );
	wp_enqueue_style( 'paul_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_style', get_template_directory_uri() . '/assets/css/style.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_media', get_template_directory_uri() . '/assets/css/media.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_hero-banner', get_template_directory_uri() . '/assets/css/components/hero-banner.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_newsletter', get_template_directory_uri() . '/assets/css/components/newsletter.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_video-intro', get_template_directory_uri() . '/assets/css/components/video-intro.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_success-system', get_template_directory_uri() . '/assets/css/components/success-system.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_testimonial', get_template_directory_uri() . '/assets/css/components/testimonial.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_success-story', get_template_directory_uri() . '/assets/css/components/success-story.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_recent-appearance', get_template_directory_uri() . '/assets/css/components/recent-appearance.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_home-blog', get_template_directory_uri() . '/assets/css/components/home-blog.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_about-inner', get_template_directory_uri() . '/assets/css/components/about-inner.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_about', get_template_directory_uri() . '/assets/css/components/about.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_blog', get_template_directory_uri() . '/assets/css/components/blog.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_blog', get_template_directory_uri() . '/assets/css/components/deals.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_blog-single', get_template_directory_uri() . '/assets/css/components/blog-single.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_deal-single', get_template_directory_uri() . '/assets/css/components/deal-single.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_resource-gallery', get_template_directory_uri() . '/assets/css/components/resource-gallery.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_resource-system', get_template_directory_uri() . '/assets/css/components/resource-system.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_contact', get_template_directory_uri() . '/assets/css/components/contact.css', array(), ' ', 'all' );
	wp_enqueue_style( 'paul_search', get_template_directory_uri() . '/assets/css/components/search.css', array(), ' ', 'all' );

	wp_enqueue_script( 'paul-winterowd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'paul_jquery_min', get_template_directory_uri() . '/assets/js/jquery-3.6.3.min.js', array(), ' ', 'true' );
	wp_enqueue_script( 'paul_bootstrap_bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), ' ', 'true' );
	wp_enqueue_script( 'paul_swiper-bundle_min', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), ' ', 'true' );
	// Custom JS File
	wp_enqueue_script( 'paul_custom_setting', get_template_directory_uri() . '/assets/js/setting.js', array(), ' ', 'true' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paul_winterowd_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Theme Option
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Header Settings',
			'menu_title'  => 'Header',
			'parent_slug' => 'theme-general-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Theme Footer Settings',
			'menu_title'  => 'Footer',
			'parent_slug' => 'theme-general-settings',
		)
	);

}

// Theme Option END

// SVG Support 
function add_file_types_to_uploads( $file_types ) {
	$new_filetypes        = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types           = array_merge( $file_types, $new_filetypes );
	return $file_types;
}
add_filter( 'upload_mimes', 'add_file_types_to_uploads' );
// SVG Support END