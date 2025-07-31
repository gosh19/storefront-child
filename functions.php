<?php




function storefront_child_enqueue_styles() {
    wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'storefront-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'storefront-style' ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_styles' );


/**
 * Desenganchar elementos del header de Storefront para reconstruirlos
 */
function custom_storefront_remove_header_elements() {

    remove_action( 'storefront_header', 'storefront_header_container', 0 );
    remove_action( 'storefront_header', 'storefront_skip_links', 5 );
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
    remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );

    remove_action( 'storefront_header', 'storefront_product_search', 40 ); // Prioridad común para búsqueda
    remove_action( 'woocommerce_after_shop_loop', 'storefront_sorting_wrapper', 9 ); // Solo si la búsqueda es ahí

    remove_action( 'storefront_header', 'storefront_header_cart', 60 ); // Prioridad común para carrito
    remove_action( 'storefront_header', 'storefront_cart_link', 10 ); // Otra posible función de carrito
}

add_action( 'init', 'custom_storefront_remove_header_elements', 999 ); // Prioridad alta para que se ejecute al final


if ( ! function_exists( 'storefront_product_search' ) ) {
    function storefront_product_search() {
        if ( storefront_is_woocommerce_activated() ) {
            ?>
            <div class="site-search">
                <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'storefront_header_cart' ) ) {
    function storefront_header_cart() {
        if ( storefront_is_woocommerce_activated() ) {
            ?>
            <ul id="site-header-cart" class="site-header-cart menu">
                <?php storefront_cart_link(); ?>
            </ul>
            <?php
        }
    }
}


if ( ! function_exists( 'storefront_cart_link' ) ) {
    function storefront_cart_link() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <li class="<?php echo esc_attr( $class ); ?>">
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
                <?php /* translators: %d: number of items in cart */ ?>
                <?php echo wp_kses_post( WC()->cart->get_cart_contents_count() ); ?>
            </a>
        </li>
        <?php
    }
}

if ( ! function_exists( 'storefront_handheld_footer_bar_my_account_link' ) ) {
    function storefront_handheld_footer_bar_my_account_link() {
        if ( storefront_is_woocommerce_activated() ) {
            ?>
            <li class="my-account">
                <?php if ( has_nav_menu( 'handheld' ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php echo esc_html__( 'My Account', 'storefront' ); ?></a>
                <?php endif; ?>
            </li>
            <?php
        }
    }
}

?>