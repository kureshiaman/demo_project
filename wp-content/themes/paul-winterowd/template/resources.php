<?php
/**
 * Template Name: Resources
 */

get_header();
?>

<?php get_template_part( 'template-parts/content', 'banner' ); ?>
<!-- inner banner -->

<!-- resource gallery -->
<?php
	$resource_content = get_field( 'resource_content' );
	$resource_title   = get_field( 'resource_title' );
?>
<div class="resource-gallery">
	<div class="container">
	<?php if ( $resource_title || $resource_content ) : ?>
		<div class="title">
			<h2 class="h2"><?php echo esc_html( $resource_title ); ?></h2>
			<div class="sub-text">
				<p><?php echo esc_html( $resource_content ); ?></p>
			</div>
		</div>
		<?php endif; ?>
		<div class="resource-list">
		<ul>
		<?php
		if ( have_rows( 'resource_list' ) ) :
			while ( have_rows( 'resource_list' ) ) :
				the_row();
				$list_image   = get_sub_field( 'list_image' );
				$list_content = get_sub_field( 'list_content' );
				$list_icon    = get_sub_field( 'list_icon' );
				$url          = $list_icon['url'];
				$title        = $list_icon['title'];
				$alt          = $list_icon['alt'];
				$caption      = $list_icon['caption'];

				// Thumbnail size attributes.
				$size   = 'thumbnail';
				$thumb  = $list_icon['sizes'][ $size ];
				$width  = $list_icon['sizes'][ $size . '-width' ];
				$height = $list_icon['sizes'][ $size . '-height' ];
				?>
			<li>
				<div class="resource-box">
					<?php if ( $list_image ) : ?>
					<div class="resource-img">
						<img src="<?php echo esc_url( $list_image ); ?>" alt="image">
					</div>
					<?php endif; ?>
					<?php if ( $list_content ) : ?>
					<div class="resource-info">
						<?php echo $list_content; ?>
					</div>
					<?php endif; ?>
					<?php if ( $list_icon ) : ?>
					<div class="btn-wrap text-center">
						<a href="<?php echo esc_url( $url ); ?>" class="btn-circle"><img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="svg"></a>
					</div>
					<?php endif; ?>
				</div>
			</li>
			<?php endwhile; ?>
			<?php endif; ?>
		</ul>
		</div>
	</div>
</div>
<!-- resource gallery -->

<!-- resource system -->
<div class="resource-system">
	<?php
	if ( have_rows( 'resource_system_repeater' ) ) :
		?>
	<ul>
		<?php
		while ( have_rows( 'resource_system_repeater' ) ) :
			the_row();
			$system_image   = get_sub_field( 'system_image' );
			$system_title   = get_sub_field( 'system_title' );
			$system_content = get_sub_field( 'system_content' );
			$system_btn     = get_sub_field( 'system_btn' );
			?>
		<li>
			<div class="container">
				<div class="resource-system-box">
					<?php if ( $system_image ) : ?>
					<div class="img-box">
						<img src="<?php echo esc_url( $system_image ); ?>" alt="img">
					</div>
					<?php endif; ?>
					<div class="content-box">
					<?php if ( $system_title ) : ?>
						<div class="title">
							<h2><?php echo esc_html( $system_title ); ?></h2>
						</div>
						<?php endif; ?>
							<?php if ( $system_content ) : ?>
							<?php echo $system_content; ?>
							<?php endif; ?>
							<?php if ( $system_btn ) : ?>
						<div class="btn-wrap text-center">
							<a href="<?php echo esc_url( $system_btn ['url'] ); ?>" class="btn btn-secondary"><?php echo esc_html( $system_btn ['title'] ); ?></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</li>
		<?php endwhile; ?>
	</ul>
	<?php endif; ?>
</div>
<!-- resource system -->

<!-- newsletter -->
<?php
		$newsletter_image       = get_field( 'newsletter_image', 'option' );
		$newsletter_title       = get_field( 'newsletter_title', 'option' );
		$newsletter_description = get_field( 'newsletter_description', 'option' );
		$newsletter_note        = get_field( 'newsletter_note', 'option' );
?>
<div class="section-newsletter" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/newsletter-bg.png);">
	<div class="container">
		<div class="newsletter-wrap">
			<div class="news-left">
				<?php if ( $newsletter_image ) : ?>
				<div class="img-box">
					<img src="<?php echo esc_url( $newsletter_image['url'] ); ?>" alt="<?php echo esc_attr( $newsletter_image['alt'] ); ?>">
				</div>
					<?php endif; ?>
			</div>
			<div class="news-right">
				<div class="newsletter">
					<div class="title">
						<h2><?php echo esc_html( $newsletter_title ); ?></h2>
					</div>
					<p><?php echo $newsletter_description; ?></p>
					<div class="ns-container">
						<div class="ns-wrapper">
						<?php echo do_shortcode( '[notify-subscribers]' ); ?>
						</div>
					</div>
					<?php if ( $newsletter_note ) : ?>
					<p class="note"><?php echo esc_html( $newsletter_note ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- newsletter -->

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