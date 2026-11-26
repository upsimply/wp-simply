<?php

/**
 * WooCommerce in the theme.
 *
 * The shop and product pages render through woocommerce.php, which puts
 * WooCommerce's own templates inside the theme's header and footer. No
 * WooCommerce template is copied into the theme: a copied template goes stale
 * with every WooCommerce release that changes it, and WooCommerce then warns
 * about it in the admin. The look is changed with WooCommerce's hooks below,
 * and with utilities on the markup the theme does own.
 *
 * The cart, checkout and account are pages, drawn by page.php: whatever the
 * page holds -- WooCommerce's Cart and Checkout blocks, the classic
 * shortcodes, or a checkout of the site's own -- is what the visitor gets.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (! class_exists('WooCommerce')) {
    return;
}

// Three products a row, three rows a page.
add_filter('loop_shop_columns', static fn (): int => 3);
add_filter('loop_shop_per_page', static fn (): int => 9);
add_filter('woocommerce_output_related_products_args', static function (array $args): array {
    return array_merge($args, ['posts_per_page' => 3, 'columns' => 3]);
});

// woocommerce.php draws the title and a category's description in the
// theme's page header, so WooCommerce's own would say them twice.
add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

// The theme draws its own breadcrumb trail in woocommerce.php.
add_filter('woocommerce_breadcrumb_defaults', static function (array $defaults): array {
    return array_merge($defaults, [
        'delimiter' => '<span class="mx-2 text-line" aria-hidden="true">/</span>',
        'wrap_before' => '<nav class="mb-6 text-sm text-muted" aria-label="'.esc_attr__('Breadcrumb', 'upsimply').'">',
        'wrap_after' => '</nav>',
    ]);
});

/**
 * Get how many items are in the visitor's cart, as the page is rendered.
 *
 * The header shows it at once, and the theme's script keeps it right
 * afterwards from the Store API: a page served from the page cache was
 * rendered for somebody else's cart.
 */
function upsimply_cart_count(): int
{
    return function_exists('WC') && WC()->cart !== null ? (int) WC()->cart->get_cart_contents_count() : 0;
}
