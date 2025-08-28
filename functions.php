<?php




function storefront_child_enqueue_styles()
{
    wp_enqueue_style('storefront-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'storefront-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('storefront-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'storefront_child_enqueue_styles');


/**
 * Desenganchar elementos del header de Storefront para reconstruirlos
 */
function custom_storefront_remove_header_elements()
{

    remove_action('storefront_header', 'storefront_header_container', 0);
    remove_action('storefront_header', 'storefront_skip_links', 5);
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_header', 'storefront_header_container_close', 41);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper', 42);
    remove_action('storefront_header', 'storefront_primary_navigation', 50);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper_close', 68);

    remove_action('storefront_header', 'storefront_product_search', 40); // Prioridad común para búsqueda
    remove_action('woocommerce_after_shop_loop', 'storefront_sorting_wrapper', 9); // Solo si la búsqueda es ahí

    remove_action('storefront_header', 'storefront_header_cart', 60); // Prioridad común para carrito
    remove_action('storefront_header', 'storefront_cart_link', 10); // Otra posible función de carrito
}

add_action('init', 'custom_storefront_remove_header_elements', 999); // Prioridad alta para que se ejecute al final


if (! function_exists('storefront_product_search')) {
    function storefront_product_search()
    {
        if (storefront_is_woocommerce_activated()) {
?>
            <div class="site-search custom-search-wrapper">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <input
                        type="search"
                        class="search-field"
                        placeholder="<?php echo esc_attr_x('Buscar productos', 'placeholder', 'storefront'); ?>"
                        value="<?php echo get_search_query(); ?>"
                        name="s" />
                    <button type="submit" class="search-icon">
                        <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#fce3e8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <input type="hidden" name="post_type" value="product" />
                </form>
            </div>
        <?php
        }
    }
}

if (! function_exists('storefront_header_cart')) {
    function storefront_header_cart()
    {
        if (storefront_is_woocommerce_activated()) {
        ?>
            <ul id="site-header-cart" class="site-header-cart menu">
                <?php storefront_cart_link(); ?>
            </ul>
        <?php
        }
    }
}


if (! function_exists('storefront_cart_link')) {
    function storefront_cart_link()
    {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <li class="<?php echo esc_attr($class); ?>">
            <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
                <?php /* translators: %d: number of items in cart */ ?>
                <?php echo wp_kses_post(WC()->cart->get_cart_contents_count()); ?>
            </a>
        </li>
        <?php
    }
}

if (! function_exists('storefront_handheld_footer_bar_my_account_link')) {
    function storefront_handheld_footer_bar_my_account_link()
    {
        if (storefront_is_woocommerce_activated()) {
        ?>
            <li class="my-account">
                <?php if (has_nav_menu('handheld')) : ?>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>"><?php echo esc_html__('My Account', 'storefront'); ?></a>
                <?php endif; ?>
            </li>
        <?php
        }
    }
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_button_text');
function woocommerce_custom_add_to_cart_button_text()
{
    return __('Añadir a la cesta', 'woocommerce');
}

add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_add_to_cart_button_text_archive');
function woocommerce_custom_add_to_cart_button_text_archive()
{
    return __('Añadir a la cesta', 'woocommerce');
}

function custom_enqueue_swiper()
{
    // Carga el CSS de Swiper.js desde un CDN
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@11/swiper-bundle.min.css');

    // Carga el JavaScript de Swiper.js desde un CDN
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@11/swiper-bundle.min.js', array(), null, true);

    // Carga tu propio JavaScript para inicializar el carrusel
    wp_enqueue_script('custom-swiper-init', get_stylesheet_directory_uri() . '/assets/js/custom-swiper-init.js', array('swiper-js'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_swiper');



function custom_product_carousel_shortcode()
{
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $products = new WP_Query($args);
    if ($products->have_posts()) :
        ob_start();
        ?>
        <div class="swiper custom-product-carousel-swiper">
            <div class="swiper-wrapper">
                <?php while ($products->have_posts()) : $products->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="custom-product-carousel-item">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('woocommerce_thumbnail');
                            } else {
                                echo wc_placeholder_img('woocommerce_thumbnail');
                            }
                            ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            // ...
                            $product_obj = wc_get_product(get_the_ID());
                            // Muestra solo el precio regular
                            echo '<span class="price">' . wc_price($product_obj->get_regular_price()) . '</span>';
                            // ...
                            ?>
                            <a href="<?php echo esc_url($product_obj->add_to_cart_url()); ?>"
                                class="button add_to_cart_button product_type_<?php echo esc_attr($product_obj->get_type()); ?>"
                                data-product_id="<?php echo esc_attr($product_obj->get_id()); ?>"
                                data-product_sku="<?php echo esc_attr($product_obj->get_sku()); ?>"
                                data-product_type="<?php echo esc_attr($product_obj->get_type()); ?>"
                                aria-label="Añadir &ldquo;<?php echo esc_attr($product_obj->get_name()); ?>&rdquo; a la cesta"
                                rel="nofollow">
                                <?php echo esc_html($product_obj->add_to_cart_text()); ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-scrollbar"></div>
        </div>
    <?php
        wp_reset_postdata();
        return ob_get_clean();
    endif;
}
add_shortcode('custom_product_carousel', 'custom_product_carousel_shortcode');

function custom_carrusel_sub_categories_shortcode()
{
    // Argumentos para obtener todas las categorías de productos.
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false, // false para obtener todas, incluso las vacías.
    );
    $product_categories = get_terms($args);

    // Comprobar si se encontraron categorías.
    if (!empty($product_categories) && !is_wp_error($product_categories)) :
        ob_start();
    ?>
    <div class="swiper custom-product-carousel-swiper categories-swiper">
        <ul class="swiper-wrapper">
            <?php
            // Bucle para repetir las categorías 3 veces, como en tu código original.
            for ($i = 0; $i < 3; $i++) :
                foreach ($product_categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            ?>
                    <li class="wc-block-product-categories-list-item swiper-slide">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                            <span class="wc-block-product-categories-list-item__image">
                                    <?php
                                    if ($thumbnail_id) {
                                        echo wp_get_attachment_image($thumbnail_id, 'woocommerce_thumbnail');
                                    } else {
                                        echo wc_placeholder_img('woocommerce_thumbnail');
                                    }
                                    ?>
                                </span>
                            <span class="wc-block-product-categories-list-item__name"><?php echo esc_html($category->name); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endfor; ?>
        </ul>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-scrollbar"></div>
        </div>
    <?php
        return ob_get_clean();
    else :
        return '<p>No se encontraron categorías.</p>';
    endif;
}
add_shortcode('custom_carrusel_sub_categories', 'custom_carrusel_sub_categories_shortcode');


/**
 * Shortcode para mostrar una cuadrícula de subcategorías con un botón.
 */
function custom_subcategories_grid_shortcode()
{
    // Definir los argumentos para obtener las categorías
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => 0, // Si quieres solo categorías de nivel superior
        'orderby'    => 'name',
    );

    $product_categories = get_terms($args);
    $counter = 0;
    if (! empty($product_categories) && ! is_wp_error($product_categories)) :
        ob_start();
    ?>
        <div class="custom-subcategories-grid">
            <?php foreach ($product_categories as $category) : ?>
                <?php if ($counter >= 6) break; // Break the loop after 6 items 
                ?>
                <div class="subcategory-grid-item">
                    <a href="<?php echo esc_url(get_term_link($category)); ?>">
                        <?php
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = wp_get_attachment_url($thumbnail_id);

                        if ($image_url) {
                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                        } else {
                            echo '<img src="' . wc_placeholder_img_src() . '" alt="' . esc_attr($category->name) . '">';
                        }
                        ?>
                        <div class="item-overlay">
                            <span class="category-name"><?php echo esc_html($category->name); ?></span>
                            <span class="category-button">Lorem ipsum</span>
                        </div>
                    </a>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
        </div>
<?php
        return ob_get_clean();
    endif;
}
add_shortcode('subcategories_grid', 'custom_subcategories_grid_shortcode');


function add_custom_body_classes($classes)
{
    // Clase para las páginas legales
    if (is_page(array('politica-de-privacidad', 'aviso-legal', 'condiciones-generales-compras', 'politica-de-cookies'))) {
        $classes[] = 'paginas-legales';
    }

    // Ejemplo para añadir otra clase a otra página por su slug.
    // Simplemente reemplaza 'slug-de-tu-pagina' con el slug real.
    if (is_page('categoria')) {
        $classes[] = 'categories-page';
    }

    // También puedes usar otras funciones condicionales de WordPress.
    // Por ejemplo, para la página principal de la tienda de WooCommerce:
    if (function_exists('is_shop') && is_shop()) {
        $classes[] = 'clase-para-la-tienda';
    }

    return $classes;
}
add_filter('body_class', 'add_custom_body_classes');
?>