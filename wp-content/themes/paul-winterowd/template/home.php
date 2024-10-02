<?php
/**
 * Template Name: Home
 */

get_header();
?>

<!-- hero banner -->
<?php
if ( have_rows( 'home_page' ) ) :
	while ( have_rows( 'home_page' ) ) :
		the_row();
		if ( get_row_layout() == 'hero_section' ) :
			?>
			<?php
			$banner_title       = get_sub_field( 'banner_title' );
			$banner_description = get_sub_field( 'banner_description' );
			$banner_cta         = get_sub_field( 'banner_cta' );
			$banner_image       = get_sub_field( 'banner_image' );
			if ( $banner_title || $banner_description ) :
				?>
	<div class="hero-banner">
		<div class="container">
			<div class="banner-info-wrap">
				<div class="banner-info">
					<h1 class="banner-title"><?php echo esc_html( $banner_title ); ?></h1>
					<p><?php echo esc_html( $banner_description ); ?></p>
					<?php if ( $banner_cta ) : ?>
					<div class="btn-wrap">
						<a href="<?php echo esc_url( $banner_cta ['url'] ); ?>" class="btn btn-orange btn-lg"><?php echo esc_html( $banner_cta['title'] ); ?></a>
					</div>
					<?php endif; ?>
				</div>
				<?php if ( $banner_image ) : ?>
				<div class="banner-img">
					<img src="<?php echo esc_html( $banner_image ); ?>">
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- hero banner -->

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

<!-- video intro -->
	<?php
elseif ( get_row_layout() == 'video_intro' ) :
		$video_intro_title       = get_sub_field( 'video_intro_title' );
		$video_intro_description = get_sub_field( 'video_intro_description' );
		$youtube_video_url       = get_sub_field( 'youtube_video_url' );
	if ( $video_intro_title ) :
		?>
<div class="section video-intro">
	<div class="container">
		<div class="title title-line text-center m-auto">
			<h2 class="h2"><?php echo esc_html( $video_intro_title ); ?></h2>
		<?php if ( $video_intro_description ) : ?>
			<div class="sub-text text-start">
				<p><?php echo $video_intro_description; ?></p>
			</div>
			<?php endif; ?>
		</div>
		<?php if ( $youtube_video_url ) : ?>
		<div class="video ratio ratio-16x9">
			<iframe src="<?php echo esc_url( $youtube_video_url ); ?>" title="YouTube video" allowfullscreen></iframe>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<!-- video intro -->

<!-- success system -->
	<?php
elseif ( get_row_layout() == 'success_system' ) :
		$success_system_title       = get_sub_field( 'success_system_title' );
		$success_system_description = get_sub_field( 'success_system_description' );
		$success_system_image       = get_sub_field( 'success_system_image' );
		$success_system_cta         = get_sub_field( 'success_system_cta' );
	if ( $success_system_title ) :
		?>
<div class="success-system">
	<div class="container">
		<div class="title title-line text-center m-auto">
			<h2 class="h2"><strong><?php echo esc_html( $success_system_title ); ?></strong></h2>
			<?php if ( $success_system_description ) : ?>
			<div class="sub-text text-start">
				<p><?php echo esc_html( $success_system_description ); ?></p>
			</div>
		<?php endif; ?>
		</div>
			<?php if ( $success_system_image ) : ?>
		<div class="chart-box">
			<img src="<?php echo esc_url( $success_system_image['url'] ); ?>" alt="<?php echo esc_attr( $success_system_image['alt'] ); ?>">
		</div>
		<?php endif; ?>
		<?php if ( $success_system_cta ) : ?>
		<div class="btn-wrap text-center">
			<a href="<?php echo esc_url( $success_system_cta ['url'] ); ?>" class="btn btn-secondary"><?php echo esc_html( $success_system_cta ['title'] ); ?></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<!-- success system -->

<!-- testimonial -->
	<?php
elseif ( get_row_layout() == 'testimonial_section' ) :
		$testimonials_title       = get_sub_field( 'testimonials_title' );
		$testimonials_description = get_sub_field( 'testimonials_description' );
	if ( $testimonials_title ) :
		?>
<div class="testimonial">
	<div class="container">
		<div class="title text-center m-auto">
			<h2 class="h2"><?php echo esc_html( $testimonials_title ); ?></h2>
			<div class="sub-text text-center">
				<p><?php echo esc_html( $testimonials_description ); ?></p>
			</div>
		</div>
		<div class="testimonial-wrap">
			<div class="testimonial-slider swiper">
				<div class="swiper-wrapper">
						<?php
						while ( have_rows( 'testimonials_client_name' ) ) :
							the_row();
							$testimonials_image  = get_sub_field( 'testimonials_image' );
							$testimonial_content = get_sub_field( 'testimonial_content' );
							$client_name         = get_sub_field( 'client_name' );
							?>
					<div class="swiper-slide">
						<div class="testimonial-box">
							<?php if ( $testimonials_image ) : ?>
							<div class="testimonial-img">
								<img src="<?php echo esc_url( $testimonials_image['url'] ); ?>" alt="<?php echo esc_html( $testimonials_image['alt'] ); ?>">
							</div>
							<?php endif; ?>
								<?php if ( $testimonial_content || $client_name ) : ?>
							<div class="testimonial-info">
								<p><?php echo esc_html( $testimonial_content ); ?></p>
								<div class="name"><?php echo esc_html( $client_name ); ?></div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="testimonial-slider-pagination swiper-pagination"></div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- testimonial -->

<!-- success-story -->
	<?php
elseif ( get_row_layout() == 'success_story' ) :
		$success_story_title        = get_sub_field( 'success_story_title' );
		$success_story_description  = get_sub_field( 'success_story_description' );
		$success_story              = get_sub_field( 'success_story' );
		$more_recently_closed_deals = get_sub_field( 'more_recently_closed_deals' );
	if ( $success_story_title ) :
		?>
<div class="success-story">
	<div class="container">
		<div class="title text-center m-auto">
			<h2 class="h2"><?php echo esc_html( $success_story_title ); ?></h2>
			<?php if ( $success_story_description ) : ?>
			<div class="sub-text text-center">
				<p><?php echo esc_html( $success_story_description ); ?></p>
			</div>
			<?php endif; ?>
		</div>
		<div class="story-list">
			<ul>
				<?php
					$counter = 0;
				foreach ( $success_story as $storys ) :
					++$counter;
					$permalink        = get_permalink( $storys );
					$title            = get_the_title( $storys );
					$excerpt          = get_the_excerpt( $storys );
					$featured_img_url = get_the_post_thumbnail_url( $storys, 'full' );
					?>
				<li>
					<div class="story-box">
						<a href="<?php echo esc_url( $permalink ); ?>" class="story-img-<?php echo esc_html( $counter ); ?>">
							<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_html( $title ); ?>">
						</a>
						<div class="story-info">
							<h3><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
							<p><?php echo esc_html( $excerpt ); ?></p>
						</div>
					</div>
				</li>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul>
		</div>
		<?php if ( $more_recently_closed_deals ) : ?>
		<div class="btn-wrap text-center">
			<a href="<?php echo esc_url( $more_recently_closed_deals ['url'] ); ?>" class="btn btn-orange"><?php echo esc_html( $more_recently_closed_deals['title'] ); ?></a>
		</div>
		<?php endif; ?>
	</div>
</div>
		<?php
		wp_reset_postdata();
		endif;
	?>
<!-- success-story -->
	
<!-- recent appearance -->
	<?php
elseif ( get_row_layout() == 'recent_appearance' ) :
		$recent_appearance_title    = get_sub_field( 'recent_appearance_title' );
		$appearance_description     = get_sub_field( 'appearance_description' );
		$appearance_image           = get_sub_field( 'appearance_image' );
		$more_recently_closed_deals = get_sub_field( 'more_recently_closed_deals' );
	if ( $recent_appearance_title ) :
		?>
<div class="recent-appearance">
	<div class="container">
		<div class="title-wrap">
			<div class="title">
				<h2 class="h2"><?php echo esc_html( $recent_appearance_title ); ?></h2>
					<?php if ( $recent_appearance_title ) : ?>
				<div class="sub-text">
					<p><?php echo esc_html( $appearance_description ); ?></p>
				</div>
				<?php endif; ?>
			</div>
			<?php if ( $appearance_image ) : ?>
			<div class="title-img">
				<img src="<?php echo esc_url( $appearance_image['url'] ); ?>" alt="<?php echo esc_html( $appearance_image['alt'] ); ?>">
			</div>
			<?php endif ?>
		</div>
		<div class="audio-list">
			<ul>
				<?php
				while ( have_rows( 'recent_appearance_list' ) ) :
						the_row();
						$appearance_list_name        = get_sub_field( 'appearance_list_name' );
						$appearance_list_description = get_sub_field( 'appearance_list_description' );
						$listen_now                  = get_sub_field( 'listen_now' );
						$audio_links                 = get_sub_field( 'audio_links' );
					?>
				<li>
					<div class="audio-box">
						<div class="audio-info">
							<h3><?php echo esc_html( $appearance_list_name ); ?></h3>
							<p><?php echo esc_html( $appearance_list_description ); ?></p>
						</div>
						<div class="audio-btn">
							<audio src="<?php echo esc_url( $audio_links ); ?>" controls></audio>
							<button><?php echo esc_html( $listen_now ); ?>
								<span class="icon">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/play-icon.svg" alt="icon" class="svg">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/pause-icon.svg" alt="icon" class="svg">
								</span>
							</button>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- recent appearance -->

<!-- home blog -->
	<?php
		$home_blog             = get_field( 'home_blog', 'option' );
		$blog_title            = get_field( 'blog_title', 'option' );
		$view_the_archives_cta = get_field( 'view_the_archives_cta', 'option' );
	if ( $recent_appearance_title ) :
		?>
<div class="home-blog" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/home-blog-bg.png);">
	<div class="container">
		<div class="title">
			<h2 class="h2"><?php echo esc_html( $home_blog ); ?></h2>
		</div>
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
		<?php if ( $view_the_archives_cta ) : ?>
		<div class="btn-wrap text-center text-md-end m-auto">
			<a href="<?php echo esc_url( $view_the_archives_cta ['url'] ); ?>" class="cta-link"><?php echo esc_html( $view_the_archives_cta ['title'] ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cta-arrow.svg" class="svg"></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<!-- home blog -->
	<?php endif; ?>
			<?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();