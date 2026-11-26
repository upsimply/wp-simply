<?php

/**
 * A closing band asking the visitor to take the next step.
 *
 * Arguments: `title`, `text`, `button` (['label' => ..., 'url' => ...]).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'title' => __('Ready when you are', 'upsimply'),
    'text' => __('One sentence on what happens when the visitor takes the next step.', 'upsimply'),
    'button' => ['label' => __('Get in touch', 'upsimply'), 'url' => '#'],
]);
?>
<section class="mx-auto max-w-7xl px-6 py-12">
	<div class="rounded-lg bg-primary px-8 py-16 text-center text-primary-contrast md:px-16">
		<h2 class="font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>
		<p class="mx-auto mt-4 max-w-xl text-lg opacity-90"><?php echo esc_html($section['text']); ?></p>
		<a href="<?php echo esc_url($section['button']['url']); ?>" class="mt-8 inline-block rounded-md bg-base px-6 py-3 text-sm font-semibold text-contrast hover:bg-surface"><?php echo esc_html($section['button']['label']); ?></a>
	</div>
</section>
