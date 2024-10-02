<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Paul_Winterowd
 */

?>
<?php
$footer_logo_image = get_field( 'footer_logo_image', 'option' );
$privacy_policy    = get_field( 'privacy_policy', 'option' );
$terms_of_use      = get_field( 'terms_of_use', 'option' );
$web_development   = get_field( 'web_development', 'option' );
$copyright         = get_field( 'copyright', 'option' );
if ( $footer_logo_image || $privacy_policy || $terms_of_use || $web_development || $copyright ) :
	?>
<div class="footer-wrap">
	<footer>
		<div class="container">
			<div class="footer-top">
				<div class="left">
					<div class="footer-logo">
						<a href="#">
						<img src="<?php echo esc_url( $footer_logo_image ); ?>" alt="footer logo">
						</a>
					</div>
				</div>
				<div class="center">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '<ul id="%1$s" class="%2$s footer-link ">%3$s</ul>',
						)
					)
					?>
				</div>
				<div class="right">
						<?php if ( have_rows( 'social_icons', 'option' ) ) : ?>
						<ul class="social">
							<?php
							while ( have_rows( 'social_icons', 'option' ) ) :
								the_row();
								$social_images = get_sub_field( 'social_images', 'option' );
								$icons_url     = get_sub_field( 'icons_url', 'option' );
								if ( $social_images || $icons_url ) :
									?>
							<li><a href="<?php echo esc_url( $icons_url ); ?>"><img src="<?php echo esc_url($social_images['url']); ?>" class="svg" alt="<?php echo esc_attr($social_images['alt']); ?>"></a></li>
							<?php endif; ?>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="left">
					<?php echo $copyright; ?>
				</div>
				<div class="center">
					<ul class="link">
							<li><a href="<?php echo esc_url( $privacy_policy['url'] ); ?>"><?php echo esc_html( $privacy_policy['title'] ); ?></a></li>
							<li><a href="<?php echo esc_url( $terms_of_use['url'] ); ?>"><?php echo esc_html( $terms_of_use['title'] ); ?></a></li>
					</ul>
				</div>
				<?php if ( $web_development ) : ?>
				<div class = 'right' >
					<ul class = 'link' >
						<li> <a href = "<?php echo esc_url( $web_development['url'] ); ?>" > 
						<?php echo esc_html( $web_development['title'] ); ?>
						</a></li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</footer>
</div>
		<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
