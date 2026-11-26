<?php

/**
 * A single post.
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) {
    the_post();
    ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="mx-auto max-w-3xl px-6 pt-16 text-center md:pt-24">
			<p class="text-sm text-muted"><?php upsimply_post_meta(); ?></p>
			<h1 class="mt-3 font-heading text-3xl font-bold tracking-tight"><?php the_title(); ?></h1>
		</header>

		<?php if (has_post_thumbnail()) { ?>
			<div class="mx-auto mt-12 max-w-5xl px-6">
				<?php the_post_thumbnail('large', ['class' => 'aspect-[16/9] w-full rounded-lg object-cover']); ?>
			</div>
		<?php } ?>

		<div class="entry-content mx-auto mt-12 max-w-3xl px-6">
			<?php the_content(); ?>
		</div>

		<div class="mx-auto max-w-3xl px-6">
			<?php wp_link_pages(); ?>

			<?php $tags = get_the_tag_list('', ' ');
    if (is_string($tags) && $tags !== '') { ?>
				<p class="mt-10 flex flex-wrap gap-2 text-sm [&_a]:rounded-full [&_a]:bg-surface [&_a]:px-3 [&_a]:py-1 [&_a]:hover:text-primary"><?php echo wp_kses_post($tags); ?></p>
			<?php } ?>

			<nav class="mt-12 flex justify-between gap-6 border-t border-line pt-8 text-sm" aria-label="<?php esc_attr_e('Posts', 'upsimply'); ?>">
				<div><?php previous_post_link('%link', '&larr; %title'); ?></div>
				<div class="text-right"><?php next_post_link('%link', '%title &rarr;'); ?></div>
			</nav>
		</div>
	</article>
	<?php

    if (comments_open() || get_comments_number() > 0) {
        comments_template();
    }
}

get_footer();
