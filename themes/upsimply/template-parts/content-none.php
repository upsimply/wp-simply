<?php

/**
 * What a listing shows when it has nothing in it.
 */

defined('ABSPATH') || exit;
?>
<div class="rounded-lg border border-dashed border-line px-6 py-16 text-center">
	<p class="font-heading text-xl font-semibold"><?php esc_html_e('Nothing here yet', 'upsimply'); ?></p>
	<p class="mt-2 text-muted">
		<?php if (is_search()) {
		    esc_html_e('Nothing matched your search. Try other words.', 'upsimply');
		} else {
		    esc_html_e('There is nothing to show on this page yet.', 'upsimply');
		} ?>
	</p>
	<div class="mx-auto mt-6 max-w-md"><?php get_search_form(); ?></div>
</div>
