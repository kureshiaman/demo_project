<?php
/**
 * Template Name: Contact
 */

get_header();
?>

<!-- inner banner -->
<?php get_template_part( 'template-parts/content', 'banner' ); ?>
<!-- er banner -->
<?php
	$paul_winterowd  = get_field( 'paul_winterowd' );
	$contact_content = get_field( 'contact_content' );
	$contact_right_image = get_field( 'contact_right_image' );
	$get_in_touch = get_field( 'get_in_touch' );
?>
<div class="contact">
	<div class="container">
		<div class="contact-wrap">
			<div class="contact-left">
				<?php if ( $paul_winterowd ) : ?>
				<div class="title">
				<h2><?php echo esc_html( $paul_winterowd ); ?></h2>
					<?php if ( $contact_content ) : ?>
				<div class="sub-text">
				<p><?php echo esc_html( $contact_content ); ?></p>
				</div>
				<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php
				$call_icon    = get_field( 'call_icon', 'option' );
				$phone_number = get_field( 'phone_number', 'option' );
				$email_icon   = get_field( 'email_icon', 'option' );
				$email_id     = get_field( 'email_id', 'option' );
				$map_icon     = get_field( 'map_icon', 'option' );
				$address      = get_field( 'address', 'option' );
				$map_url      = get_field( 'map_url', 'option' );
					?>
				<div class="contact-info">
					<?php
					$clean_phone_number = preg_replace( '/[^0-9]()/', '', $phone_number );
					?>
					<ul>
					<li><a href="tel:<?php echo esc_attr( $clean_phone_number ); ?>"><div class="icon"><img src="<?php echo esc_url( $call_icon ); ?>" alt="icon"></div> <?php echo esc_html( $phone_number ); ?></a></li>

					<li><a href="mailto:<?php echo esc_html( $email_id ); ?>"><div class="icon"><img src="<?php echo esc_url( $email_icon ); ?>" alt="icon"></div> <?php echo esc_html( $email_id ); ?></a></li>
					
					<li><a target="_blank" href="<?php echo esc_url( $map_url ); ?>"><div class="icon"><img src="<?php echo esc_url( $map_icon ); ?>" alt="icon"></div> <?php echo esc_html( $address ); ?></a></li>
					</ul>
				</div>
			</div>
			<div class="contact-right">
            <div class="img-box">
            <img src="<?php echo esc_url( $contact_right_image ); ?>" alt="contact info">
            </div>
			</div>
		</div>
	</div>
</div>
<div class="get-in-touch">
	<div class="container">
	<div class="title title-line text-center m-auto">
		<h2 class="h2"><strong><?php echo esc_html( $get_in_touch ); ?></strong></h2>
	</div>
	<div class="get-in-touch-form">
    <?php echo do_shortcode( '[contact-form-7 id="3fd1ea7" title="Contact Form"]' );?>
	</div>
	</div>
</div>

<!-- home blog -->
<?php
// elseif ( get_row_layout() == 'newsletter_section' ) :
	$home_blog             = get_field( 'home_blog', 'option' );
	$blog_title            = get_field( 'blog_title', 'option' );
	$view_the_archives_cta = get_field( 'view_the_archives_cta', 'option' );
?>
<div class="home-blog" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home-blog-bg.png);">
	<div class="container">
	<?php if ( $home_blog ) : ?>
		<div class="title">
			<h2 class="h2"><?php echo esc_html( $home_blog ); ?></h2>
		</div>
		<?php endif; ?>
		<?php if ( $blog_title ) : ?>
		<div class="blog-list">
		<ul>
			<?php
					$counter = 0;
			foreach ( $blog_title as $blogs ) :
					++$counter;
					$permalink        = get_permalink( $blogs );
					$title            = get_the_title( $blogs );
					$excerpt          = get_the_excerpt( $blogs );
					$featured_img_url = get_the_post_thumbnail_url( $blogs, 'full' );
				?>
				<li>
				<a href="<?php echo esc_url( $permalink ); ?>" class="home-blog-box">
					<?php if ( $featured_img_url ) : ?>
					<div class="blog-img">
						<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="blog">
					</div>
					<?php endif; ?>
					<?php if ( $excerpt ) : ?>
					<div class="blog-info">
						<p><?php echo $excerpt; ?></p>
					</div>
					<?php endif; ?>
				</a>
			</li>
				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php endif; ?>
	<?php if ( $view_the_archives_cta ) : ?>
	<div class="btn-wrap text-center text-md-end m-auto">
		<a href="<?php echo esc_url( $view_the_archives_cta ['url'] ); ?>" class="cta-link"><?php echo esc_html( $view_the_archives_cta ['title'] ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cta-arrow.svg" class="svg"></a>
	</div>
	<?php endif; ?>
	</div>
</div>
<!-- home blog -->
<?php
get_footer();