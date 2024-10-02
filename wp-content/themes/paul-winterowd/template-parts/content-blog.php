<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Paul_Winterowd
 */

?>

<!-- home blog -->
<?php
if ( get_row_layout() == 'blog' ) :
		$the_blog              = get_sub_field( 'the_blog' );
		$home_blog             = get_sub_field( 'home_blog' );
		$view_the_archives_cta = get_sub_field( 'view_the_archives_cta' );
	if ( $recent_appearance_title ) :
		?>
	<div class="home-blog" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/home-blog-bg.png);">
		<div class="container">
			<div class="title">
				<h2 class="h2"><?php echo esc_html( $the_blog ); ?></h2>
			</div>
			<div class="blog-list">
				<ul>
				<?php
						$counter = 0;
				foreach ( $home_blog as $blogs ) :
						++$counter;
						$permalink        = get_permalink( $blogs );
						$title            = get_the_title( $blogs );
						$excerpt          = get_the_excerpt( $blogs );
						$featured_img_url = get_the_post_thumbnail_url( $blogs, 'full' );
					?>
						<li>
						<a href="<?php echo esc_url( $permalink ); ?>" class="home-blog-box">
							<div class="blog-img">
								<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="blog">
							</div>
							<div class="blog-info">
								<p><?php echo $excerpt; ?></p>
							</div>
						</a>
					</li>
					<?php endforeach; ?>
					<!-- <li>
						<a href="#" class="home-blog-box">
							<div class="blog-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-blog-1.jpg" alt="blog">
							</div>
							<div class="blog-info">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse</p>
							</div>
						</a>
					</li> -->
				</ul>
			</div>
			<div class="btn-wrap text-center text-md-end m-auto">
				<a href="#" class="cta-link">View the Archives <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cta-arrow.svg" class="svg"></a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>
	<!-- home blog -->