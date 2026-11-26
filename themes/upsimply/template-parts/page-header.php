<?php

/**
 * The title band at the top of an inner page or a listing.
 *
 * Arguments: `title` (plain text), `description` (HTML allowed in a post's
 * excerpt or a term's description), `eyebrow` (a short line above the title).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'eyebrow' => '',
    'title' => '',
    'description' => '',
]);
?>
<header class="border-b border-line bg-surface">
	<div class="mx-auto max-w-7xl px-6 py-14 md:py-20">
		<?php if ($section['eyebrow'] !== '') { ?>
			<p class="text-sm font-semibold uppercase tracking-widest text-primary"><?php echo esc_html($section['eyebrow']); ?></p>
		<?php } ?>
		<h1 class="mt-2 font-heading text-3xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h1>
		<?php if ($section['description'] !== '') { ?>
			<div class="mt-4 max-w-2xl text-lg text-muted"><?php echo wp_kses_post($section['description']); ?></div>
		<?php } ?>
	</div>
</header>
