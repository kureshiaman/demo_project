<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Paul_Winterowd
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Basic Page Info -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Theme Color -->
	<meta name="theme-color" content="#FFF">

	<!-- Title -->
	<title>Paul Winterowd</title>

	<!-- Site favicon -->
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->

	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$header_logo_image = get_field( 'header_logo_image', 'option' );
$loding_image      = get_field( 'loding_image', 'option' );
$cta_button        = get_field( 'cta_button', 'option' );
	$cta_url       = $cta_button['url'];
	$cta_title     = $cta_button['title'];
	$cta_target    = $cta_button['target'] ? $cta_button['target'] : '_self';

if ( $header_logo_image || $loding_image ) :
	?>
<!-- <div class="loader" id="loader">
	<div class="logo">
		<img src="<?php echo esc_url( $loding_image ); ?>" alt="logo">
	</div>
	<div class="spinner-grow spinner-grow-sm" role="status">
		<span class="visually-hidden">Loading...</span>
	</div>
</div> -->
<div class="header-wrap">
	<header>
		<div class="container">
			<div class="header-logo">
				<a href="<?php echo esc_url( home_url() ); ?>">
					<img src="<?php echo esc_url( $header_logo_image ); ?>" alt="header logo">
				</a>
			</div>
			<div class="menu-bar">
				<button type="button">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/menu-bar.svg" alt="menu bar">
				</button>
			</div>
			<div class="sidemenu">
				<div class="menu-bar close">
					<button type="button">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/close-icon.svg" alt="menu close">
					</button>
				</div>
				<div class="menu-wrap">
						<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'menu-1',
										'container_class' => 'menu',
										'container'       => 'div',
										'items_wrap'      => '<ul id="%1$s" class="%2$s ">%3$s</ul>',
									)
								)
						?>
						<?php if ( $cta_button ) : ?>
					<div class="btn-wrap">
						<a href="<?php echo esc_url( $cta_url ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" class="btn btn-primary btn-sm"><?php echo esc_html( $cta_title ); ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>
</div>
<?php endif; ?>