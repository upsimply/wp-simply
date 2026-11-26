<?php

/**
 * What the business offers, as a heading and a grid of short points.
 *
 * Arguments: `eyebrow`, `title`, `text`, `items` (a list of ['title' => ...,
 * 'text' => ...]).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'eyebrow' => __('What you get', 'upsimply'),
    'title' => __('Three reasons people choose you', 'upsimply'),
    'text' => __('A sentence that sets up the points below.', 'upsimply'),
    'items' => [
        ['title' => __('The first benefit', 'upsimply'), 'text' => __('What it means for the visitor, in a sentence or two.', 'upsimply')],
        ['title' => __('The second benefit', 'upsimply'), 'text' => __('What it means for the visitor, in a sentence or two.', 'upsimply')],
        ['title' => __('The third benefit', 'upsimply'), 'text' => __('What it means for the visitor, in a sentence or two.', 'upsimply')],
    ],
]);
?>
<section class="mx-auto max-w-7xl px-6 py-24">
	<div class="max-w-2xl">
		<p class="text-sm font-semibold uppercase tracking-widest text-primary"><?php echo esc_html($section['eyebrow']); ?></p>
		<h2 class="mt-3 font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>
		<p class="mt-4 text-lg text-muted"><?php echo esc_html($section['text']); ?></p>
	</div>

	<div class="mt-14 grid gap-10 md:grid-cols-3">
		<?php foreach ($section['items'] as $index => $item) { ?>
			<div>
				<span class="flex size-10 items-center justify-center rounded-md bg-primary font-semibold text-primary-contrast"><?php echo (int) $index + 1; ?></span>
				<h3 class="mt-5 font-heading text-lg font-semibold"><?php echo esc_html($item['title']); ?></h3>
				<p class="mt-2 text-muted"><?php echo esc_html($item['text']); ?></p>
			</div>
		<?php } ?>
	</div>
</section>
