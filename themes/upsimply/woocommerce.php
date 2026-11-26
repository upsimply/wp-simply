<?php

/**
 * The shop, a product category or tag, and a single product.
 *
 * WooCommerce draws the content with its own templates; this file only puts
 * them inside the theme's header and footer, so no WooCommerce template is
 * copied into the theme to go stale (see inc/woocommerce.php). The cart,
 * checkout and account are pages, drawn by page.php.
 */

defined('ABSPATH') || exit;

get_header();

if (! is_product()) {
    get_template_part('template-parts/page-header', null, [
        'title' => wp_strip_all_tags(woocommerce_page_title(false)),
        'description' => is_product_taxonomy() ? (string) term_description() : '',
    ]);
}
?>
<div class="mx-auto max-w-7xl px-6 py-12">
	<?php woocommerce_breadcrumb(); ?>
	<?php woocommerce_content(); ?>
</div>
<?php

get_footer();
