<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">   

		<main id="main" class="site-main page-404" role="main">

			<div class="error-404 not-found">

				<div class="page-content"> 

					<header class="page-header">
						<div class="page-width">

							<div class="img-container">
								
							</div>
							<div class="page-title-container">
								<h1 class="page-title">404: ESTA FIESTA NO ESTÁ AQUÍ</h1>
								<p>Parece que te has colado en la pista equivocada. Vamos a llevarte de vuelta al lugar donde la música suena.</p>
							</div>
						</div>
					</header><!-- .page-header -->
					<section class="shop-featured-products-section" style="margin-top: 0px !important;">
						<div class="page-width">
							<h2>Productos estrella</h2>
							<p>Sea cual sea la ocasión, en Party Fiesta tenemos todo lo que necesitas para que tus celebraciones sean un éxito rotundo: disfraces, globos, piñatas, velas y mucho más. ¡Explora nuestra selección y prepárate para una fiesta inolvidable!</p>
							<?php echo do_shortcode('[custom_product_carousel]'); ?>
						</div>
					</section>

					<?php
					// echo '<section aria-label="' . esc_html__( 'Search', 'storefront' ) . '">';

					// if ( storefront_is_woocommerce_activated() ) {
					// 	the_widget( 'WC_Widget_Product_Search' );
					// } else {
					// 	get_search_form();
					// }

					// echo '</section>';

					// if ( storefront_is_woocommerce_activated() ) {

					// 	echo '<div class="fourohfour-columns-2">';

					// 		echo '<section class="col-1" aria-label="' . esc_html__( 'Promoted Products', 'storefront' ) . '">';

					// 			storefront_promoted_products();

					// 		echo '</section>';

					// 		echo '<nav class="col-2" aria-label="' . esc_html__( 'Product Categories', 'storefront' ) . '">';

					// 			echo '<h2>' . esc_html__( 'Product Categories', 'storefront' ) . '</h2>';

					// 			the_widget(
					// 				'WC_Widget_Product_Categories',
					// 				array(
					// 					'count' => 1,
					// 				)
					// 			);

					// 		echo '</nav>';

					// 	echo '</div>';

					// 	echo '<section aria-label="' . esc_html__( 'Popular Products', 'storefront' ) . '">';

					// 		echo '<h2>' . esc_html__( 'Popular Products', 'storefront' ) . '</h2>';

					// 		$shortcode_content = storefront_do_shortcode(
					// 			'best_selling_products',
					// 			array(
					// 				'per_page' => 4,
					// 				'columns'  => 4,
					// 			)
					// 		);

					// 		echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					// 	echo '</section>';
					// }
					?>

				</div><!-- .page-content -->
			</div><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
