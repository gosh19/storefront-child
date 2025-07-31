<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'storefront' ); ?></a>

    <div class="top-bar">
        <div class="col-full">
            <span>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING</span>
        </div>
    </div>

	<header id="masthead" class="site-header" role="banner">
        <div class=" custom-header-main-bar" style="display:flex">
            <div class="site-branding">
                <?php
                /**
                 * Modificamos storefront_site_branding para que el logo sea un enlace a la home
                 * y podamos estilizarlo
                 */
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . str_replace(' ','<span style="font-size:20px">★</span>',get_bloginfo( 'name' ))  . '</a></h1>';
                    // Si tienes un tagline y quieres mostrarlo
                    // echo '<p class="site-description">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
                }
				
                ?>
				
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    => 'primary', // Este es el nombre de la ubicación del menú que usa Storefront
                        'container_class'   => 'primary-navigation',
                        // 'walker'            => new Storefront_Primary_Nav_Walker(), // Walker de Storefront si lo necesitas
                    )
                );
                ?>
            </nav>
			<div class="search-bar">

				<?php if ( function_exists( 'storefront_product_search' ) ) : ?>
				<?php storefront_product_search(); // Reutilizamos la función de búsqueda de Storefront ?>
				<?php endif; ?>
				<div class="search-icon" style="width: fit-content;">

					<svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#fce3e8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
			</div>

			<div class="iconos-menu">
				<svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>

            <!-- <div class="header-utilities">
                <div class="header-search-form">
                    <?php if ( function_exists( 'storefront_product_search' ) ) : ?>
                        <?php storefront_product_search(); // Reutilizamos la función de búsqueda de Storefront ?>
                    <?php endif; ?>
                </div>

                <div class="header-account-icon">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="account-link">
                        <i class="dashicons dashicons-admin-users"></i> <span class="screen-reader-text"><?php esc_html_e( 'My account', 'storefront' ); ?></span>
                    </a>
                </div>

                <div class="header-cart-icon">
                    <?php if ( function_exists( 'storefront_header_cart' ) ) : ?>
                        <?php storefront_header_cart(); // Reutilizamos la función del carrito de Storefront ?>
                    <?php endif; ?>
                </div>
            </div> -->
        </div>
    </header>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="">

		<?php
		do_action( 'storefront_content_top' );
