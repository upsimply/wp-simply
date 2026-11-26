<?php

/**
 * Search results.
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'eyebrow' => __('Search', 'upsimply'),
    /* translators: %s: what the visitor searched for. */
    'title' => sprintf(__('Results for "%s"', 'upsimply'), get_search_query(false)),
]);
?>
<div class="mx-auto max-w-7xl px-6 py-16">
	<div class="mb-12 max-w-md"><?php get_search_form(); ?></div>

	<?php if (have_posts()) { ?>
		<div class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
			<?php while (have_posts()) {
			    the_post();
			    get_template_part('template-parts/post-card');
			} ?>
		</div>

		<?php upsimply_pagination(); ?>
	<?php } else { ?>
		<?php get_template_part('template-parts/content-none'); ?>
	<?php } ?>
</div>
<?php

get_footer();
