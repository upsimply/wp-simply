<?php

/**
 * Any listing no other template claims: the blog, a category, a tag, an
 * author, a date. Search has search.php, a single post single.php.
 */

defined('ABSPATH') || exit;

get_header();

if (is_home() && ! is_front_page()) {
    $title = get_the_title((int) get_option('page_for_posts'));
    $description = '';
} elseif (is_archive()) {
    $title = wp_strip_all_tags(get_the_archive_title());
    $description = get_the_archive_description();
} else {
    $title = __('Latest posts', 'upsimply');
    $description = '';
}

get_template_part('template-parts/page-header', null, ['title' => $title, 'description' => $description]);
?>
<div class="mx-auto max-w-7xl px-6 py-16">
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
