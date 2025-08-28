<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

	<div id="primary" class="content-area custom-product-page">
		<main id="main" class="site-main page-width" role="main">
			<?php
				while ( have_posts() ) :
					the_post();
					wc_get_template_part( 'content', 'single-product' );
				endwhile; // End of the loop.
			?>
		</main></div><?php get_footer( 'shop' ); ?>