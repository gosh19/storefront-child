<?php
/**
 * Template override: product price filter widget (Spanish labels)
 *
 * Copy of WooCommerce templates/content-widget-price-filter.php with text adjusted to Spanish.
 *
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>">
	<div class="price_slider_wrapper">
		<div class="price_slider" style="display:none; margin-bottom:30px;"></div>
		<div class="price_slider_amount" style="display:flex; justify-content:space-between;align-items:center;" data-step="<?php echo esc_attr( $step ); ?>">
			<label class="screen-reader-text" for="min_price"><?php echo esc_html__( 'Precio mínimo', 'storefront' ); ?></label>
			<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Precio mínimo', 'storefront' ); ?>" />
			<label class="screen-reader-text" for="max_price"><?php echo esc_html__( 'Precio máximo', 'storefront' ); ?></label>
			<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Precio máximo', 'storefront' ); ?>" />
			<div class="price_label" style="display:none;">
                <?php echo esc_html__( 'Precio:', 'storefront' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
			</div>
            <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html__( 'Filtrar', 'storefront' ); ?></button>
			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>


