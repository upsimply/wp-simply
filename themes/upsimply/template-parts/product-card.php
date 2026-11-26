<?php

/**
 * One product, as a card: its picture, name and price, linking to the
 * product. Used by the theme's own product sections; the shop's listings are
 * WooCommerce's.
 *
 * Arguments: `product` (a WC_Product).
 */

defined('ABSPATH') || exit;

$product = $args['product'] ?? null;

if (! $product instanceof WC_Product) {
    return;
}
?>
<a href="<?php echo esc_url($product->get_permalink()); ?>" class="group block">
	<div class="overflow-hidden rounded-md bg-surface">
		<?php echo wp_kses_post($product->get_image('woocommerce_thumbnail', ['class' => 'aspect-square w-full object-cover transition duration-300 group-hover:scale-105'])); ?>
	</div>
	<h3 class="mt-4 font-medium group-hover:text-primary"><?php echo esc_html($product->get_name()); ?></h3>
	<p class="mt-1 text-sm text-muted"><?php echo wp_kses_post($product->get_price_html()); ?></p>
</a>
