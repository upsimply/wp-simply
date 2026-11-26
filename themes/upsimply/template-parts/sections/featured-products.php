<?php

/**
 * A row of products from the shop, linking on to the rest of it. Draws
 * nothing on a site without WooCommerce, or with no products to show.
 *
 * Arguments: `title`, `text`, `limit`, `featured` (only the products marked
 * as featured in WooCommerce; otherwise the newest), `category` (a product
 * category slug, or '').
 */

defined('ABSPATH') || exit;

if (! function_exists('wc_get_products')) {
    return;
}

$section = upsimply_section($args ?? [], [
    'title' => __('Featured products', 'upsimply'),
    'text' => '',
    'limit' => 4,
    'featured' => true,
    'category' => '',
]);

$query = [
    'status' => 'publish',
    'visibility' => 'catalog',
    'limit' => (int) $section['limit'],
    'orderby' => 'date',
    'order' => 'DESC',
];

if ($section['featured']) {
    $query['featured'] = true;
}

if ($section['category'] !== '') {
    $query['category'] = [$section['category']];
}

$products = wc_get_products($query);

if ($products === []) {
    return;
}
?>
<section class="mx-auto max-w-7xl px-6 py-24">
	<div class="flex flex-wrap items-end justify-between gap-4">
		<div>
			<h2 class="font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>
			<?php if ($section['text'] !== '') { ?>
				<p class="mt-3 text-muted"><?php echo esc_html($section['text']); ?></p>
			<?php } ?>
		</div>
		<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="text-sm font-semibold text-primary hover:underline"><?php esc_html_e('See all products', 'upsimply'); ?> &rarr;</a>
	</div>

	<div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-10 lg:grid-cols-4">
		<?php foreach ($products as $product) {
		    get_template_part('template-parts/product-card', null, ['product' => $product]);
		} ?>
	</div>
</section>
