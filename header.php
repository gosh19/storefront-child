<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@500;600&display=swap" rel="stylesheet">

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
            <span>CONSIGUE UN <strong>5% DE DESCUENTO</strong> EN TU PRIMERA COMPRA</span>
        </div>
    </div>

	<header id="masthead" class="site-header " role="banner">
        <div class=" custom-header-main-bar page-width" >
            <div class="top-header-bar">
                <div class="site-branding">
                    <a href="/">
    
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" width="214" height="36" alt="Logo Party Fiesta">
                    </a>
                </div>
                <div class="header-container">
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
                    
                </div>
                <div style="display: flex; gap:18px;">

                    <div class="search-bar">
            
                            <?php if ( function_exists( 'storefront_product_search' ) ) : ?>
                            <?php storefront_product_search(); // Reutilizamos la función de búsqueda de Storefront ?>
                            <?php endif; ?>
                            
                    </div>
                    <div class="iconos-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.395" height="24.166" viewBox="0 0 21.395 24.166">
                            <path id="Trazado_195" data-name="Trazado 195" d="M5,26.166V24.781a9.7,9.7,0,0,1,9.7-9.7h0a9.7,9.7,0,0,1,9.7,9.7v1.385M14.7,15.083A5.542,5.542,0,1,0,9.156,9.542,5.542,5.542,0,0,0,14.7,15.083" transform="translate(-4 -3)" fill="none" stroke="#0e0e1d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
    
                        <svg xmlns="http://www.w3.org/2000/svg" width="26.864" height="24" viewBox="0 0 26.864 24">
                            <path id="Trazado_258" data-name="Trazado 258" d="M14.583,26.455a.974.974,0,0,1-.649-.247c-.333-.3-8.189-7.293-10.911-10.923A8.429,8.429,0,0,1,1.609,8.007,7.462,7.462,0,0,1,6.137,3.014a7.379,7.379,0,0,1,2.739-.559A6.5,6.5,0,0,1,13.257,4.2a9.282,9.282,0,0,1,1.369,1.518A8.7,8.7,0,0,1,21.1,2.455a7.585,7.585,0,0,1,2.825.559A6.435,6.435,0,0,1,27.9,7.356a9.394,9.394,0,0,1-1.759,7.93c-2.722,3.63-10.578,10.627-10.911,10.923A.974.974,0,0,1,14.583,26.455ZM8.876,4.408a5.442,5.442,0,0,0-2.014.42A5.549,5.549,0,0,0,3.489,8.534a6.465,6.465,0,0,0,1.1,5.58c2.166,2.888,8.035,8.277,10,10.052,1.963-1.775,7.832-7.164,10-10.052a7.414,7.414,0,0,0,1.441-6.231A4.547,4.547,0,0,0,23.2,4.827a5.643,5.643,0,0,0-2.1-.42,6.193,6.193,0,0,0-3.643,1.3,7.047,7.047,0,0,0-2,2.24.976.976,0,0,1-1.746,0C13.414,7.359,11.791,4.408,8.876,4.408Z" transform="translate(-1.313 -2.455)" fill="#0e0e1d"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="carro-vacio" transform="translate(85 -1.718)">
                                <rect id="Rectángulo_59" data-name="Rectángulo 59" width="24" height="24" transform="translate(-85 1.718)" fill="none"/>
                                <path id="Trazado_233" data-name="Trazado 233" d="M39.791,20.763a.889.889,0,0,0-.682-.319H21.186l-.675-3.714a.889.889,0,0,0-.874-.73H16.889a.889.889,0,0,0,0,1.778h2l2.84,15.586a2.666,2.666,0,0,0,.592,1.252,3.111,3.111,0,1,0,4.933.938H32.3a3.11,3.11,0,1,0,2.81-1.778H24.351a.889.889,0,0,1-.874-.73l-.352-1.937H36.012a2.666,2.666,0,0,0,2.623-2.189l1.351-7.428a.889.889,0,0,0-.2-.729M25.777,36.887a1.333,1.333,0,1,1-1.333-1.333,1.333,1.333,0,0,1,1.333,1.333m10.665,0a1.333,1.333,0,1,1-1.333-1.333,1.333,1.333,0,0,1,1.333,1.333m.444-8.285a.889.889,0,0,1-.878.73H22.8l-1.292-7.11H38.043Z" transform="translate(-101 -14.282)" fill="#0e0e1d"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

           

			

            <!-- <div class="header-utilities">


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
