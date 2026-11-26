<?php

/**
 * The search form, wherever get_search_form() draws it.
 */

defined('ABSPATH') || exit;

$field_id = wp_unique_id('search-');
?>
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex gap-2">
	<label for="<?php echo esc_attr($field_id); ?>" class="sr-only"><?php esc_html_e('Search', 'upsimply'); ?></label>
	<input
		id="<?php echo esc_attr($field_id); ?>"
		type="search"
		name="s"
		value="<?php echo esc_attr(get_search_query()); ?>"
		placeholder="<?php esc_attr_e('Search…', 'upsimply'); ?>"
		class="min-w-0 flex-1 rounded-sm border border-line bg-base px-3 py-2 focus:border-primary focus:outline-none"
	>
	<button type="submit" class="rounded-sm bg-primary px-4 py-2 text-sm font-semibold text-primary-contrast hover:bg-contrast"><?php esc_html_e('Search', 'upsimply'); ?></button>
</form>
