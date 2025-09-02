<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Storefront_Child
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'No se encontró nada', 'storefront-child' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) :

            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __( '¿Listo para publicar tu primer post? <a href="%1$s">Empieza aquí</a>.', 'storefront-child' ),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url( admin_url( 'post-new.php' ) )
            );

        elseif ( is_search() ) :
            ?>

            <p><?php esc_html_e( 'Lo sentimos, pero no hay nada que coincida con tus términos de búsqueda. Por favor, intenta de nuevo con diferentes palabras clave.', 'storefront-child' ); ?></p>
            <?php
            get_search_form();

        else :
            ?>

            <p><?php esc_html_e( 'Parece que no podemos encontrar lo que estás buscando. Tal vez la búsqueda pueda ayudar.', 'storefront-child' ); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
