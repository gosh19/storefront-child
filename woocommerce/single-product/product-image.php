<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$product_images    = $product->get_gallery_image_ids();
?>

<div class="custom-galery">
    <div class="woocommerce-product-gallery__wrapper">
        <?php
        // Check if there is a main image or any gallery images.
        if ( $post_thumbnail_id || $product_images ) {
            // Include the main product image if it exists.
            if ( $post_thumbnail_id ) {
                $main_image_url = wp_get_attachment_url( $post_thumbnail_id );
                ?>
                <div class="main-image-container">
                    <a href="<?php echo esc_url( $main_image_url ); ?>">
                        <img width="637" height="auto" src="<?php echo esc_url( $main_image_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ); ?>" class="mi-imagen-principal">
                    </a>
                </div>
                <?php
            }

            // Loop through the product gallery images.
            if ( $product_images ) {
                ?>
                <div class="product-thumbnails-container">
                    <?php
                    foreach ( $product_images as $image_id ) {
                        $image_url = wp_get_attachment_url( $image_id );
                        $alt_text  = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="thumbnail-item-wrapper">
                            <a href="<?php echo esc_url( $image_url ); ?>">
                                <img  src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="mi-miniatura-galeria">
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        } else {
            // Show a placeholder image if no images are set.
            ?>
            <div class="woocommerce-product-gallery__image--placeholder">
                <img src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?>" alt="<?php esc_attr_e( 'Awaiting product image', 'woocommerce' ); ?>" class="wp-post-image" />
            </div>
            <?php
        }
        ?>
    </div>
</div>