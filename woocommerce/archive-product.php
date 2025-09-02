<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );


echo '<div class="page-width">'. do_shortcode('[custom_carrusel_sub_categories class="orange"]'). '</div>';
?>

<section class="shop-content page-width">

<?php



?>


<div class="side-bar">
	<?php do_action( 'storefront_child_filters' ); ?>
	<div class="party-club-cta">
		<p class="party-club-title">PARTY CLUB</p>
		<p class="party-club-description">Unete al club para recibir recomendaciones y consejos personalizados.</p>
		<a href="<?php echo home_url('/party-club'); ?>" class="btn-green-blue">¡Quiero formar parte!</a>
	</div>
</div>

<?php 

echo '<div class="shop-listing-wrapper">';

if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	// do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

echo '</div>';




/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
// do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' );

?>
</section>
<section class="shop-featured-products-section">
	<div class="page-width">
		<h2>Productos estrella</h2>
		<?php echo do_shortcode('[custom_product_carousel]'); ?>
	</div>
</section>
<?php
echo do_blocks( '<!-- wp:block {"ref":261} /-->' );
echo do_blocks( '<!-- wp:block {"ref":281} /-->' );
echo do_blocks( '<!-- wp:block {"ref":278} /-->' );
echo do_blocks( '<!-- wp:block {"ref":285} /-->' );
// Los scripts ahora se cargarán automáticamente desde functions.php

get_footer( 'shop' );
