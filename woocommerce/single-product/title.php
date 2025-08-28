<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_title( '<h1 class="product_title entry-title">', '</h1>' );
the_content();
?>
<div  class="selector color-selector">
	<label>Color</label>
	<div>
		<div class="radio">
			<div class="color"></div>
		</div>
		<div class="radio">
			<div class="color"></div>
		</div>
		<div class="radio">
			<div class="color"></div>
		</div>
	</div>
</div>
<div  class="selector size-selector">
	<label>Color</label>
	<div>
		<div class="radio">
			<span >S</span>
		</div>
		<div class="radio">
			<span >M</span>
		</div>
		<div class="radio">
			<span >L</span>
		</div>
		<div class="radio">
			<span >XL</span>
		</div>

	</div>
</div>