<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Paul_Winterowd
 */

get_header();
?>

<?php get_template_part( 'template-parts/content', 'banner' ); ?>
<div class="blog">
<div class="container">
<div class="blog-filter d-flex">
	<div class="category">
		<ul class="d-flex">
			<li class="active">
			<?php
			$categories    = get_the_category();
				$separator = ' ';
				$output    = '';
			if ( ! empty( $categories ) ) {
				foreach ( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo trim( $output, $separator );
			}
			?>
			</li>
		</ul>
	</div>
	<div class="blog-search">
		<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
			<div class="input-group">
				<input type="text" class="form-control" name="s" placeholder="Search...">
				<button type="submit">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icons/search-icon.svg" alt="search icon">
				</button>
			</div>
		</form>
	</div>
</div>

	<!-- <main id="primary" class="site-main blog"> -->
	<div class="blog-list">
		<ul>
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			?>
		<div class="next-prev">
			<?php previous_posts_link( 'prev. page' ); ?>
			<?php next_posts_link( 'next page', $query->max_num_pages ); ?>
		</div>
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</ul>
		</div>
	</div>
</div>
	<!-- </main> -->
	<!-- #main -->
	
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
get_sidebar();
get_footer();
