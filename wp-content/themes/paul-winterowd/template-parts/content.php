<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Paul_Winterowd
 */

?>
<li>
<div class="blog-box">
	<div class="blog-img">
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail(); ?>
	<?php else : ?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/blog-dummy-1.jpg" alt="blog">
	<?php endif; ?>
	</div>
	<div class="blog-info">
		<h3 class="h2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<ul class="meta-info">
			<li><?php echo get_the_date(); ?></li>
			<li><span>by</span> <?php the_author(); ?></li>
			<li><span>category</span> <?php the_category( ', ' ); ?></li>
		</ul>
		<p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
		<div class="btn-wrap">
			<a href="<?php the_permalink(); ?>" class="cta-link"><?php echo esc_html( 'Read more' ); ?> <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/cta-arrow.svg" class="svg"></a>
		</div>
	</div>
</div>
</li>

