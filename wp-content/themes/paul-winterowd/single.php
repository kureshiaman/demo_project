<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Paul_Winterowd
 */

get_header();
?>
<?php get_template_part( 'template-parts/content', 'banner' ); ?>
	<div class="blog-single">

<div class="container">
	<div class="blog-head">
<h2><?php the_title(); ?></h2>
<ul class="meta-info">
	<li><?php echo get_the_date(); ?></li>
	<?php
	$author_id   = get_post_field( 'post_author', get_the_ID() );
	$author_name = get_the_author_meta( 'display_name', $author_id );
	?>
	<li><span>by</span> <?php echo esc_html( $author_name ); ?></li>
	<li><span>category</span> <?php the_category( ', ' ); ?></li>
</ul>
<div class="blog-img">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/blog-dummy-1.jpg" alt="blog image">
</div>
</div>
<div class="blog-content content-box">
<?php the_content(); ?>

</div>
<div class="tag">
<span>tags:</span> 
<?php
		$tags = get_the_tags();
if ( $tags ) {
	foreach ( $tags as $tag ) {
			echo '<span class="tag-item">' . esc_html( $tag->name ) . '</span> ';
	}
}
?>
</div>
</div>
<div class="container">
<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/comment.png" alt="image">
</div>
<div class="container">
<div class="next-prev">
<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();
if ( ! empty( $prev_post ) ) {
	?>
		<button type="button" onclick="location.href='<?php echo get_permalink( $prev_post->ID ); ?>'">Prev. Page</button>
		<?php
}
if ( ! empty( $next_post ) ) {
	?>
		<button type="button" onclick="location.href='<?php echo get_permalink( $next_post->ID ); ?>'">Next Page</button>
		<?php } ?>
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
get_sidebar();
get_footer();
