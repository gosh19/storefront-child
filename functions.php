<?php

// Tema hijo Storefront configurado correctamente

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

function custom_enqueue_scripts()
{
    // Debug temporal
    error_log('=== CUSTOM_ENQUEUE_SCRIPTS EJECUTÁNDOSE ===');
    error_log('Tema activo: ' . get_stylesheet());
    error_log('Tema padre: ' . get_template());
    error_log('URL del tema hijo: ' . get_stylesheet_directory_uri());
    
    // Verificar que estemos en el tema hijo
    if (get_template() !== 'storefront') {
        error_log('❌ Tema padre no es storefront, saliendo...');
        return;
    }
    
    error_log('✅ Tema padre es storefront, continuando...');
    
    // Carga el CSS de Swiper.js desde un CDN
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@11/swiper-bundle.min.css');
    error_log('✅ Estilo swiper-css registrado');

    // Carga el JavaScript de Swiper.js desde un CDN
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@11/swiper-bundle.min.js', array(), null, true);
    error_log('✅ Script swiper-js registrado');

    // Carga tu propio JavaScript para inicializar el carrusel
    $swiper_init_url = get_stylesheet_directory_uri() . '/assets/js/custom-swiper-init.js';
    wp_enqueue_script('custom-swiper-init', $swiper_init_url, array('swiper-js'), '1.0', true);
    error_log('✅ Script custom-swiper-init registrado: ' . $swiper_init_url);

    // Carga el JavaScript de filtros en todo el sitio
    $filters_url = get_stylesheet_directory_uri() . '/assets/js/filters.js';
    wp_enqueue_script('custom-filters', $filters_url, array(), '1.0', true);
    error_log('✅ Script custom-filters registrado: ' . $filters_url);
    
    error_log('✅ Todos los scripts registrados correctamente');
}
// Usar múltiples hooks para asegurar que se cargue
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');
add_action('wp_head', 'custom_enqueue_scripts');
add_action('wp_footer', 'custom_enqueue_scripts');

// Debug: verificar que la función se ejecute
add_action('init', function() {
    error_log('=== INIT HOOK EJECUTÁNDOSE ===');
    error_log('Tema activo: ' . get_stylesheet());
    error_log('Tema padre: ' . get_template());
    error_log('Tema hijo directorio: ' . get_stylesheet_directory());
    error_log('Tema hijo URI: ' . get_stylesheet_directory_uri());
    
    // Verificar que el tema hijo esté activo
    if (get_stylesheet() === 'storefront-child') {
        error_log('✅ Tema hijo storefront-child está activo');
    } else {
        error_log('❌ Tema hijo storefront-child NO está activo. Tema activo: ' . get_stylesheet());
    }
});



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

function custom_carrusel_sub_categories_shortcode($atts = array())
{
    // Atributos opcionales
    $atts = shortcode_atts(array(
        'hide_empty'  => 'false', // 'true'|'false'
        'top_level'   => 'false', // 'true' para solo nivel superior
        'parent'      => '',      // id de parent específico
        'max'         => '',      // número máximo a mostrar
        'class'       => '',      // clase extra para el contenedor
        'scrollbar'   => '',      // nombre/color para clase de scrollbar, ej: 'pink'
        'show_parent' => 'false', // 'true' para mostrar padre si tiene
        'orderby'     => 'name',
        'order'       => 'ASC',
    ), $atts, 'custom_carrusel_sub_categories');

    $hide_empty  = filter_var($atts['hide_empty'], FILTER_VALIDATE_BOOLEAN);
    $only_top    = filter_var($atts['top_level'], FILTER_VALIDATE_BOOLEAN);
    // parent puede ser un ID o la palabra 'current'
    $parent_id   = null;
    if ($atts['parent'] !== '') {
        if ($atts['parent'] === 'current' && function_exists('is_product_category') && is_product_category()) {
            $current_cat = get_queried_object();
            if ($current_cat && isset($current_cat->term_id)) {
                $parent_id = intval($current_cat->term_id);
            }
        } else {
            $parent_id = intval($atts['parent']);
        }
    }
    $max_items   = $atts['max'] !== '' ? max(0, intval($atts['max'])) : 0;
    $extra_class = sanitize_html_class($atts['class']);
    $scrollbar   = $atts['scrollbar'] !== '' ? 'scrollbar-' . sanitize_html_class($atts['scrollbar']) : '';
    $show_parent = filter_var($atts['show_parent'], FILTER_VALIDATE_BOOLEAN);

    // Construir argumentos dinámicos
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => $hide_empty,
        'orderby'    => sanitize_key($atts['orderby']),
        'order'      => $atts['order'] === 'DESC' ? 'DESC' : 'ASC',
    );

    if ($only_top) {
        $args['parent'] = 0;
    } elseif (!is_null($parent_id)) {
        $args['parent'] = $parent_id;
    } elseif (function_exists('is_product_category') && is_product_category()) {
        // Si no se especificó top_level ni parent y estamos en una categoría de producto,
        // por defecto mostrar las hijas de la categoría actual
        $current_cat = get_queried_object();
        if ($current_cat && isset($current_cat->term_id)) {
            $args['parent'] = intval($current_cat->term_id);
        }
    }

    $product_categories = get_terms($args);

    if (!empty($product_categories) && !is_wp_error($product_categories)) :
        ob_start();
    ?>
    <div class="swiper custom-product-carousel-swiper categories-swiper <?php echo esc_attr(trim($extra_class . ' ' . $scrollbar)); ?>">
        <ul class="swiper-wrapper">
            <?php
            $rendered = 0;
            foreach ($product_categories as $category) :
                if ($max_items > 0 && $rendered >= $max_items) {
                    break;
                }
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $parent_label = '';
                if ($show_parent && !empty($category->parent)) {
                    $parent_term = get_term($category->parent, 'product_cat');
                    if ($parent_term && !is_wp_error($parent_term)) {
                        $parent_label = ' (' . esc_html($parent_term->name) . ')';
                    }
                }
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
                        <span class="wc-block-product-categories-list-item__name"><?php echo esc_html($category->name); ?><?php echo $parent_label; ?></span>
                    </a>
                </li>
            <?php
                $rendered++;
            endforeach; ?>
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
 * Forzar step=1 en el widget de filtro de precio
 */
function storefront_child_price_filter_step_one( $step )
{
    return 1;
}
add_filter( 'woocommerce_price_filter_widget_step', 'storefront_child_price_filter_step_one', 999 );


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

/**
 * Override Storefront content wrappers from child theme
 */
function storefront_child_override_wrappers()
{
    // Remove parent theme wrappers
    remove_action('woocommerce_before_main_content', 'storefront_before_content', 10);
    remove_action('woocommerce_after_main_content', 'storefront_after_content', 10);

    // Add child theme wrappers
    add_action('woocommerce_before_main_content', 'storefront_child_before_content', 10);
    add_action('woocommerce_after_main_content', 'storefront_child_after_content', 10);
}
add_action('init', 'storefront_child_override_wrappers', 20);

if (! function_exists('storefront_child_before_content')) {
    function storefront_child_before_content()
    {
        ?>
        <div id="primary" class="content-area" style="width: 100%;">
            <main id="main" class="site-main " role="main">
        <?php
    }
}

if (! function_exists('storefront_child_after_content')) {
    function storefront_child_after_content()
    {
        ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        do_action('storefront_sidebar');
    }
}

/**
 * Filtros de la categoría: barra superior con widgets
 */
function storefront_child_filter_bar()
{
    if (function_exists('error_log')) {
        error_log('[SF Child] storefront_child_filter_bar INICIO');
    }
    if (! (function_exists('is_shop') && (is_shop() || is_product_taxonomy()))) {
        if (function_exists('error_log')) {
            error_log('[SF Child] storefront_child_filter_bar ABORT: no es shop ni product_taxonomy');
        }
        return;
    }
    ?>
    <div class="shop-filters">
        <?php
        // Filtro por precio
        the_widget('WC_Widget_Price_Filter', array(
            'title' => __('Filtrar por precio', 'storefront')
        ));
        echo "<hr>";
        // Construir filtros dinámicos por atributos que estén presentes en los productos listados
        $attributes = function_exists('wc_get_attribute_taxonomies') ? wc_get_attribute_taxonomies() : array();
        // Logs de diagnóstico
        if (function_exists('error_log')) {
            error_log('[SF Child] wc_get_attribute_taxonomies count: ' . (is_array($attributes) ? count($attributes) : 0));
        }

        if (!empty($attributes)) {
            global $wp_query;
            $current_product_ids = array();
            if (isset($wp_query->posts) && is_array($wp_query->posts)) {
                foreach ($wp_query->posts as $post_obj) {
                    $current_product_ids[] = (int) $post_obj->ID;
                }
            }
            if (function_exists('error_log')) {
                error_log('[SF Child] Productos en vista: ' . count($current_product_ids));
            }

            foreach ($attributes as $attribute) {
                $taxonomy = wc_attribute_taxonomy_name($attribute->attribute_name); // e.g. pa_color
                $taxonomy_exists = taxonomy_exists($taxonomy);
                if (function_exists('error_log')) {
                    error_log('[SF Child] Revisando atributo: label=' . $attribute->attribute_label . ' slug=' . $attribute->attribute_name . ' taxonomy=' . $taxonomy . ' existe=' . ($taxonomy_exists ? 'si' : 'no'));
                }
                if (!$taxonomy_exists) {
                    continue;
                }

                // Verificar si el atributo tiene términos asociados a los productos actuales
                $has_terms_in_view = false;
                $terms_checked = 0;
                if (!empty($current_product_ids)) {
                    $terms_in_view = get_terms(array(
                        'taxonomy'   => $taxonomy,
                        'hide_empty' => true,
                        'object_ids' => $current_product_ids,
                        'number'     => 1,
                        'fields'     => 'ids',
                    ));
                    $has_terms_in_view = !is_wp_error($terms_in_view) && !empty($terms_in_view);
                    $terms_checked = is_wp_error($terms_in_view) ? 0 : count($terms_in_view);
                } else {
                    // Si no tenemos IDs (por algún motivo), fallback: mostrar si hay términos globales no vacíos
                    $terms_global = get_terms(array(
                        'taxonomy'   => $taxonomy,
                        'hide_empty' => true,
                        'number'     => 1,
                        'fields'     => 'ids',
                    ));
                    $has_terms_in_view = !is_wp_error($terms_global) && !empty($terms_global);
                    $terms_checked = is_wp_error($terms_global) ? 0 : count($terms_global);
                }
                if (function_exists('error_log')) {
                    error_log('[SF Child] ' . $taxonomy . ' terms_en_vista=' . ($has_terms_in_view ? 'si' : 'no') . ' terms_checked=' . $terms_checked);
                }

                if (!$has_terms_in_view) {
                    continue;
                }

                // Estructura unificada: render manual para todos los atributos
                echo '<div class="filter-group">';
                echo '<h3 class="filter-title">' . sprintf(__('%s', 'storefront'), esc_html($attribute->attribute_label)) . '</h3>';
                $taxonomy_for_query = wc_attribute_taxonomy_name($attribute->attribute_name); // pa_color
                $terms_for_list = get_terms(array(
                    'taxonomy'   => $taxonomy_for_query,
                    'hide_empty' => true,
                    'object_ids' => $current_product_ids,
                ));
                if (!is_wp_error($terms_for_list) && !empty($terms_for_list)) {
                    echo '<ul class="woocommerce-widget-layered-nav-list" data-attribute="' . esc_attr($attribute->attribute_name) . '">';
                    // Valores seleccionados actualmente para este atributo (pueden venir separados por comas)
                    $active_values = array();
                    $filter_param = 'filter_' . $attribute->attribute_name; // e.g. filter_color
                    if (isset($_GET[$filter_param])) {
                        $raw = wp_unslash($_GET[$filter_param]);
                        $active_values = array_filter(array_map('sanitize_title', explode(',', (string) $raw)));
                    }
                    foreach ($terms_for_list as $term) {
                        $is_active = in_array($term->slug, $active_values, true);
                        $url = add_query_arg(array($filter_param => $term->slug));
                        
                        // Contar productos que tienen este término del atributo
                        $term_count = 0;
                        if (!empty($current_product_ids)) {
                            $products_with_term = get_objects_in_term($term->term_id, $taxonomy_for_query);
                            if (!is_wp_error($products_with_term)) {
                                $term_count = count(array_intersect($current_product_ids, $products_with_term));
                            }
                        }
                        
                        echo '<li class="woocommerce-widget-layered-nav-list__item">';
                        echo '<input type="checkbox" class="woocommerce-widget-layered-nav-list__checkbox" data-term="' . esc_attr($term->slug) . '" ' . checked(true, $is_active, false) . ' /> ';
                        echo '<a rel="nofollow" href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
                        if ($term_count > 0) {
                            echo '<span class="term-count">' . $term_count . '</span>';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                echo '</div>';
                echo "<hr>";
            }
        }

        // Filtros activos
        the_widget('WC_Widget_Layered_Nav_Filters');
        ?>
    </div>
    <?php
}
add_action('storefront_child_filters', 'storefront_child_filter_bar');

// Se elimina el debug de atributos disponibles

?>
<?php
/**
 * Reorder WooCommerce result count and catalog ordering
 * Ensure the select (catalog ordering) appears after the count
 */
function storefront_child_reorder_result_and_ordering()
{
    // Remove Storefront defaults (both before and after the loop)
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);

    // Add in desired order: count first, then ordering
    add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 10);
    add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20);
    add_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 10);
    add_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20);
}
add_action('init', 'storefront_child_reorder_result_and_ordering', 999);

// AJAX handler for blog pagination
function load_blog_posts() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'blog_pagination_nonce')) {
        wp_die('Security check failed');
    }
    
    $page = intval($_POST['page']);
    $posts_per_page = 1;
    
    // Get all posts
    $all_posts = get_posts(array(
        'post_type' => 'post',
        'numberposts' => -1,
        'post_status' => 'publish'
    ));
    
    $total_posts = count($all_posts);
    $total_pages = ceil($total_posts / $posts_per_page);
    
    // Get posts for current page
    $offset = ($page - 1) * $posts_per_page;
    $current_page_posts = array_slice($all_posts, $offset, $posts_per_page);
    
    if (!empty($current_page_posts)) {
        echo '<div class="blog-grid">';
        foreach ($current_page_posts as $post) {
            // Set up post data properly
            global $post;
            $post = $current_page_posts[0];
            setup_postdata($post);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="post-content">
                    <header class="entry-header">
                        <?php
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                        ?>
                        
                        <div class="entry-meta">
                            <span class="posted-on">
                                <i class="fas fa-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <i class="fas fa-user"></i>
                                <?php echo get_the_author(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="cat-links">
                                    <i class="fas fa-folder"></i>
                                    <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="entry-footer">
                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                            Leer más <i class="fas fa-arrow-right"></i>
                        </a>
                    </footer>
                </div>
            </article>
            <?php
        }
        echo '</div>';
    } else {
        echo '<div class="no-posts">';
        echo '<h2>No hay posts en esta página</h2>';
        echo '</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_load_blog_posts', 'load_blog_posts');
add_action('wp_ajax_nopriv_load_blog_posts', 'load_blog_posts');
