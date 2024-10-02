<?php
/**
 * Template Name: About
 */

get_header();
?>

<?php
if ( have_rows( 'about' ) ) :
	while ( have_rows( 'about' ) ) :
		the_row();
		if ( get_row_layout() == 'about_banner_section' ) :

			$banner_image    = get_sub_field( 'banner_image' );
			$about_title     = get_sub_field( 'about_title' );
			$about_sub_title = get_sub_field( 'about_sub_title' );
			// var_dump($banner_image);
			?>
<div class="about-inner" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/about-inner-bg.png);">
	<div class="container">
		<div class="about-inner-wrap">
			<?php if ( $banner_image ) : ?>
			<div class="about-inner-left">
				<img src="<?php echo esc_url( $banner_image ); ?>" alt="inner about">
			</div>
			<?php endif ?>
			<div class="about-inner-info">
			<?php if ( $about_title || $about_sub_title ) : ?>
				<div class="content-box">
					<h1 class="banner-title"><?php echo esc_html( $about_title ); ?></h1>
					<p><?php echo esc_html( $about_sub_title ); ?></p>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<!-- about inner -->

<!-- about -->
			<?php
elseif ( get_row_layout() == 'about_company' ) :
	$about_image            = get_sub_field( 'about_image' );
	$about_content          = get_sub_field( 'about_content' );
	$second_about_image     = get_sub_field( 'second_about_image' );
	$second_about_content   = get_sub_field( 'second_about_content' );
	$lets_get_started_today = get_sub_field( 'lets_get_started_today' );
	?>
	<div class="about">
		<div class="container">
			<?php if ( $about_image || $about_content ) : ?>
			<div class="inner-section">
				<div class="about-box-wrap">
					<div class="img-box">
						<img src="<?php echo esc_url( $about_image ); ?>" alt="about">
					</div>
					<div class="about-info content-box">
						<?php echo $about_content; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php if ( $second_about_image || $second_about_content ) : ?>
			<div class="inner-section">
				<div class="about-box-wrap">
					<div class="img-box">
						<img src="<?php echo esc_url( $second_about_image ); ?>" alt="about">
					</div>
					<div class="about-info content-box">
						<?php echo $second_about_content; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<div class="container">
	<?php if ( $lets_get_started_today ) : ?>
		<div class="btn-wrap text-center">
			<a href="<?php echo esc_url( $lets_get_started_today ['url'] ); ?>" class="btn btn-blue"><?php echo esc_html( $lets_get_started_today['title'] ); ?></a>
		</div>
		<?php endif; ?>
	</div>
	</div>
	<!-- about -->

<!-- newsletter -->
	<?php
	// elseif ( get_row_layout() == 'newsletter_section' ) :
		$newsletter_image       = get_field( 'newsletter_image', 'option' );
		$newsletter_title       = get_field( 'newsletter_title', 'option' );
		$newsletter_description = get_field( 'newsletter_description', 'option' );
		$newsletter_note        = get_field( 'newsletter_note', 'option' );
	?>
<div class="section-newsletter" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/newsletter-bg.png);">
	<div class="container">
		<div class="newsletter-wrap">
		<?php if ( $newsletter_image ) : ?>
			<div class="news-left">
				<?php if ( $newsletter_image ) : ?>
				<div class="img-box">
					<img src="<?php echo esc_url( $newsletter_image['url'] ); ?>" alt="<?php echo esc_attr( $newsletter_image['alt'] ); ?>">
				</div>
					<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="news-right">
				<div class="newsletter">
				<?php if ( $newsletter_title ) : ?>
					<div class="title">
						<h2><?php echo esc_html( $newsletter_title ); ?></h2>
					</div>
					<?php endif; ?>
					<?php if ( $newsletter_description ) : ?>
					<p><?php echo $newsletter_description; ?></p>
					<?php endif; ?>
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
	<?php endif; ?>
			<?php endwhile; ?>
<?php endif; ?>
<?php
get_footer();