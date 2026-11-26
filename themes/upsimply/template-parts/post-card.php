<?php

/**
 * One post in a listing: its picture, title, date and excerpt. Used inside
 * the loop.
 */

defined('ABSPATH') || exit;
?>
<article <?php post_class('group flex flex-col'); ?>>
	<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-md" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail('medium_large', ['class' => 'aspect-[3/2] w-full object-cover transition duration-300 group-hover:scale-105']); ?>
		</a>
	<?php } ?>

	<p class="mt-4 text-sm text-muted"><?php upsimply_post_meta(); ?></p>

	<h2 class="mt-1 font-heading text-xl font-semibold tracking-tight">
		<a href="<?php the_permalink(); ?>" class="hover:text-primary"><?php the_title(); ?></a>
	</h2>

	<div class="mt-2 text-muted"><?php the_excerpt(); ?></div>
</article>
