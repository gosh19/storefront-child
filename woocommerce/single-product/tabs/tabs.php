<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) & false) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>

<div class="product-info-accordion-wrapper">
    <div class="accordion-column">
        <div class="accordion-item">
            <button class="accordion-header">
                Descripción
                <span class="icon-plus">+</span>
            </button>
            <div class="accordion-content">
                <p>Aquí va la descripción del producto. Puedes agregar texto, listas o cualquier otro contenido.</p>
            </div>
        </div>
        <div class="accordion-item">
            <button class="accordion-header">
                Material
                <span class="icon-plus">+</span>
            </button>
            <div class="accordion-content">
                <p>Información detallada sobre el material utilizado en el producto, como "100% algodón" o "Acero inoxidable".</p>
            </div>
        </div>
    </div>

    <div class="accordion-column">
        <div class="accordion-item">
            <button class="accordion-header">
                Tallas y dimensiones
                <span class="icon-plus">+</span>
            </button>
            <div class="accordion-content">
                <p>Aquí se detallan las tallas disponibles y las dimensiones del producto, como "Talla única, 15cm x 10cm".</p>
            </div>
        </div>
        <div class="accordion-item">
            <button class="accordion-header">
                Envíos y devoluciones
                <span class="icon-plus">+</span>
            </button>
            <div class="accordion-content">
                <p>Este panel contiene la información sobre la política de envíos, costos y el proceso de devolución de artículos.</p>
            </div>
        </div>
    </div>
</div>
<!-- wp:group {"metadata":{"categories":["woo-commerce","featured-selling"],"patternName":"woocommerce-blocks/product-collection-4-columns","name":"Product Collection 4 Columns"},"className":"product-section page-width","style":{"spacing":{"padding":{"top":"calc( 0.5 * var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal)))","bottom":"calc( 0.5 * var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal)))","left":"var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-left, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal))","right":"var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal))"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group sub-categories" style="margin-top:0;margin-bottom:0;padding-top:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-right:var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal));padding-bottom:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-left:var(--wp--style--root--padding-left, var(--wp--custom--gap--horizontal))"><!-- wp:spacer {"height":"calc( 0.25 * var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal)))"} -->


	<h2 class="wp-block-heading">COMPLETA TU LOOK</h2>


	<!-- wp:shortcode -->
	<?php echo  do_shortcode('[custom_product_carousel]'); ?>
	<!-- /wp:shortcode -->

	<div style="height:7px" aria-hidden="true" class="wp-block-spacer"></div>

</div>
<div class="wp-block-group product-section" style="margin-top:0;margin-bottom:0;padding-top:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-right:var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal));padding-bottom:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-left:var(--wp--style--root--padding-left, var(--wp--custom--gap--horizontal))"><!-- wp:spacer {"height":"calc( 0.25 * var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal)))"} -->


	<h2 class="wp-block-heading">TE PUEDE INTERESAR</h2>


	<!-- wp:shortcode -->
	<?php echo  do_shortcode('[custom_product_carousel]'); ?>
	<!-- /wp:shortcode -->

	<div style="height:7px" aria-hidden="true" class="wp-block-spacer"></div>

</div>
<div class="wp-block-group featured-product-section " style="margin-top:0;margin-bottom:0;padding-top:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-right:var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal));padding-bottom:calc( 0.5 * var(--wp--style--root--padding-right, var(--wp--custom--gap--horizontal)));padding-left:var(--wp--style--root--padding-left, var(--wp--custom--gap--horizontal))"><!-- wp:spacer {"height":"calc( 0.25 * var(\u002d\u002dwp\u002d\u002dstyle\u002d\u002droot\u002d\u002dpadding-right, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dgap\u002d\u002dhorizontal)))"} -->


	<h2 class="wp-block-heading">ÚLTIMAS RESEÑAS</h2>


	<div class="review-section">
		<div class="review-box">
			<p class="name">Ema Norton</p>
			<div class="stars">
				<?php 
				for ($i=0; $i < 5; $i++) :
					echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.5" height="13.5" viewBox="0 0 26.808 24.94">
  <defs>
    <clipPath id="clip-path">
      <rect id="Rectángulo_26" data-name="Rectángulo 26" width="26.808" height="24.94" fill="#ffd62c"/>
    </clipPath>
  </defs>
  <g id="Grupo_476" data-name="Grupo 476" clip-path="url(#clip-path)">
    <path id="Trazado_174" data-name="Trazado 174" d="M14.606.646c.175-.318.4-.639.7-.645a.779.779,0,0,1,.843.428,2.385,2.385,0,0,1,.287.692,2.726,2.726,0,0,1,.08.4l.959,7.612c.1.458.365.638.911.641L24.987,9q.158-.019.318-.023c.165,0,.328-.006.5-.006,1.188,0,1.368,1.025.3,1.938l-5.811,5.178a.856.856,0,0,0-.331,1.061l2.274,5.5a2.762,2.762,0,0,1,.192.7c.177,1.362-.791,2.2-2.612,1.055L14.19,21.195h0a1.105,1.105,0,0,0-1.115.015h0l-7.18,3.523c-.836.419-1.706.019-1.461-1.078h0l2.593-7.229c.192-.5-.046-.741-.358-1.052h0L.637,9.6c-1.021-.9-.8-1.922.557-1.773l8.521.847h0a.852.852,0,0,0,.823-.511,1.1,1.1,0,0,0,.06-.1Z" transform="translate(0 0)" fill="#ffd62c"/>
  </g>
</svg>';
				endfor;
				?>
			</div>
			<p class="comment">
				Usually, we prefer the real thing, wine without sulfur based preservatives, real butter, not margarine, and so we’d like our layouts and designs to be filled with real words, with thoughts that count, information that has value.
			</p>
		</div>
		<div class="review-box">
			<p class="name">Oliwia Whitley</p>
			<div class="stars">
				<?php 
				for ($i=0; $i < 5; $i++) :
					echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.5" height="13.5" viewBox="0 0 26.808 24.94">
  <defs>
    <clipPath id="clip-path">
      <rect id="Rectángulo_26" data-name="Rectángulo 26" width="26.808" height="24.94" fill="#ffd62c"/>
    </clipPath>
  </defs>
  <g id="Grupo_476" data-name="Grupo 476" clip-path="url(#clip-path)">
    <path id="Trazado_174" data-name="Trazado 174" d="M14.606.646c.175-.318.4-.639.7-.645a.779.779,0,0,1,.843.428,2.385,2.385,0,0,1,.287.692,2.726,2.726,0,0,1,.08.4l.959,7.612c.1.458.365.638.911.641L24.987,9q.158-.019.318-.023c.165,0,.328-.006.5-.006,1.188,0,1.368,1.025.3,1.938l-5.811,5.178a.856.856,0,0,0-.331,1.061l2.274,5.5a2.762,2.762,0,0,1,.192.7c.177,1.362-.791,2.2-2.612,1.055L14.19,21.195h0a1.105,1.105,0,0,0-1.115.015h0l-7.18,3.523c-.836.419-1.706.019-1.461-1.078h0l2.593-7.229c.192-.5-.046-.741-.358-1.052h0L.637,9.6c-1.021-.9-.8-1.922.557-1.773l8.521.847h0a.852.852,0,0,0,.823-.511,1.1,1.1,0,0,0,.06-.1Z" transform="translate(0 0)" fill="#ffd62c"/>
  </g>
</svg>';
				endfor;
				?>
			</div>
			<p class="comment">
If that’s what you think how bout the other way around? How can you evaluate content without design? No typography, no colors, no layout, no styles, all those things that convey the important signals that go beyond the mere textual, hierarchies of information, weight, emphasis, oblique stresses, priorities, all those subtle cues that also have visual and emotional appeal to the reader.
			</p>
		</div>
		<div class="review-box">
			<p class="name">Mr. Mackay</p>
			<div class="stars">
				<?php 
				for ($i=0; $i < 5; $i++) :
					echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.5" height="13.5" viewBox="0 0 26.808 24.94">
  <defs>
    <clipPath id="clip-path">
      <rect id="Rectángulo_26" data-name="Rectángulo 26" width="26.808" height="24.94" fill="#ffd62c"/>
    </clipPath>
  </defs>
  <g id="Grupo_476" data-name="Grupo 476" clip-path="url(#clip-path)">
    <path id="Trazado_174" data-name="Trazado 174" d="M14.606.646c.175-.318.4-.639.7-.645a.779.779,0,0,1,.843.428,2.385,2.385,0,0,1,.287.692,2.726,2.726,0,0,1,.08.4l.959,7.612c.1.458.365.638.911.641L24.987,9q.158-.019.318-.023c.165,0,.328-.006.5-.006,1.188,0,1.368,1.025.3,1.938l-5.811,5.178a.856.856,0,0,0-.331,1.061l2.274,5.5a2.762,2.762,0,0,1,.192.7c.177,1.362-.791,2.2-2.612,1.055L14.19,21.195h0a1.105,1.105,0,0,0-1.115.015h0l-7.18,3.523c-.836.419-1.706.019-1.461-1.078h0l2.593-7.229c.192-.5-.046-.741-.358-1.052h0L.637,9.6c-1.021-.9-.8-1.922.557-1.773l8.521.847h0a.852.852,0,0,0,.823-.511,1.1,1.1,0,0,0,.06-.1Z" transform="translate(0 0)" fill="#ffd62c"/>
  </g>
</svg>';
				endfor;
				?>
			</div>
			<p class="comment">
Or else, an alternative route: set checkpoints, networks, processes, junctions between content and layout. Depending on the state of affairs it may be fine to concentrate either on design or content, reversing gears when needed.
			</p>
		</div>
	</div>

</div>

