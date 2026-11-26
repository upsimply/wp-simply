<?php

/**
 * A page that is not there.
 */

defined('ABSPATH') || exit;

get_header();
?>
<section class="mx-auto max-w-2xl px-6 py-24 text-center md:py-32">
	<p class="text-sm font-semibold uppercase tracking-widest text-primary">404</p>
	<h1 class="mt-3 font-heading text-3xl font-bold tracking-tight"><?php esc_html_e('This page is not here', 'upsimply'); ?></h1>
	<p class="mt-4 text-lg text-muted"><?php esc_html_e('It may have moved, or the address may be mistyped. Try a search, or start from the home page.', 'upsimply'); ?></p>
	<div class="mx-auto mt-8 max-w-md"><?php get_search_form(); ?></div>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="mt-6 inline-block text-sm font-semibold text-primary hover:underline"><?php esc_html_e('Go to the home page', 'upsimply'); ?></a>
</section>
<?php

get_footer();
