<?php
/**
 * Template Name: Deals
 */
get_header();
?>

<!-- inner banner -->
	<?php get_template_part( 'template-parts/content', 'banner' ); ?>
<!-- inner banner -->
<?php

$deals_title       = get_field( 'deals_title' );
$deals_description = get_field( 'deals_description' );
?>
<div class="deals">
	<div class="container">
		<div class="title">
			<?php if ( $deals_title ) :?>
			<h2><?php echo  esc_html($deals_title);?></h2>
			<?php endif;?>
			<?php if ( $deals_description ) :?>
			<div class="sub-text">
				<p><?php echo  esc_html($deals_description);?></p>
			</div>
			<?php endif;?>
		</div>
		<div class="deals-list">
		<ul>
			<?php
			// Get the current page number
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			// Define the query
			$args = array(
				'post_type'      => 'deals',
				'posts_per_page' => 3, // Adjust the number of posts as needed
				'paged'          => $paged,
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) :
				$counter = 0;
				while ( $query->have_posts() ) :
					$query->the_post();
					++$counter;
					$permalink        = get_permalink();
					$title            = get_the_title();
					$excerpt          = get_the_excerpt();
					$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					?>
			<li>
				<div class="deals-box-<?php echo esc_html( $counter ); ?>">
					<div class="deals-img">
						<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_html( $title ); ?>">
					</div>
					<div class="deals-info">
						<h3 class="h2"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
						<p><?php echo esc_html( $excerpt ); ?></p>
						<div class="btn-wrap">
							<a href="<?php echo esc_url( $permalink ); ?>" class="cta-link">Read more <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/cta-arrow.svg" class="svg"></a>
						</div>
					</div>
				</div>
			</li>
					<?php
				endwhile;
				wp_reset_postdata();
				endif;
			?>
		</ul>
			<div class="next-prev">
				<?php
				$prev_link = get_previous_posts_page_link();
				$next_link = get_next_posts_page_link( $query->max_num_pages );

				if ( $paged > 1 ) {
					echo '<button type="button" onclick="location.href=\'' . esc_url( $prev_link ) . '\'">prev page</button>';
				}

				if ( $paged < $query->max_num_pages ) {
					echo '<button type="button" onclick="location.href=\'' . esc_url( $next_link ) . '\'">next page</button>';
				}
				?>
			</div>
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