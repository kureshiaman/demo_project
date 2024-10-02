<div class="inner-banner" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/inner-banner-bg.png);">
	<div class="container">
		<h1 class="banner-title">
			<?php

			$page_for_posts = get_option( 'page_for_posts' );
			if ( is_post_type_archive( 'deals' ) ) {
				echo 'Deals';
			} elseif ( is_singular( 'deals' ) ) {
				the_title();
			} elseif ( is_archive() ) {
				echo get_the_archive_title();
			} elseif ( is_single() || is_page() ) {
				the_title();
			}elseif( is_home() ){
				echo get_the_title( $page_for_posts );
			}
			?>
		</h1>
		<ul class="breadcrumbs">
			<li><a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( 'Home' ); ?></a></li>
			<?php
			if ( is_page() ) :
				?>
				<li><?php the_title(); ?></li>
			<?php elseif ( is_post_type_archive( 'deals' ) ) : ?>
				<li><?php echo esc_html( 'Deals' ); ?></li>
			<?php elseif ( is_singular( 'deals' ) ) : ?>
				<li><a href="<?php echo get_post_type_archive_link( 'deals' ); ?>"><?php echo esc_html( 'Deals' ); ?></a></li>
				<li><?php the_title(); ?></li>
			<?php elseif ( is_archive() ) : ?>
				<li><?php echo get_the_archive_title(); ?></li>
			<?php elseif ( is_home() ) : ?>
				<li><?php echo get_the_title( $page_for_posts ); ?></li>
			<?php elseif ( is_single() ) : ?>
				<li><?php the_title(); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
