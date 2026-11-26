<?php

/**
 * What customers say, as a heading and a row of quotes.
 *
 * Arguments: `title`, `items` (a list of ['quote' => ..., 'name' => ...,
 * 'role' => ...]).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'title' => __('What customers say', 'upsimply'),
    'items' => [
        ['quote' => __('A short quote from a real customer about the result they got.', 'upsimply'), 'name' => __('Customer name', 'upsimply'), 'role' => __('Role, company', 'upsimply')],
        ['quote' => __('A short quote from a real customer about the result they got.', 'upsimply'), 'name' => __('Customer name', 'upsimply'), 'role' => __('Role, company', 'upsimply')],
        ['quote' => __('A short quote from a real customer about the result they got.', 'upsimply'), 'name' => __('Customer name', 'upsimply'), 'role' => __('Role, company', 'upsimply')],
    ],
]);
?>
<section class="bg-surface">
	<div class="mx-auto max-w-7xl px-6 py-24">
		<h2 class="text-center font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>

		<div class="mt-14 grid gap-8 md:grid-cols-3">
			<?php foreach ($section['items'] as $item) { ?>
				<figure class="flex flex-col rounded-lg border border-line bg-base p-8">
					<blockquote class="flex-1 text-lg">&ldquo;<?php echo esc_html($item['quote']); ?>&rdquo;</blockquote>
					<figcaption class="mt-6 text-sm">
						<span class="block font-semibold"><?php echo esc_html($item['name']); ?></span>
						<span class="block text-muted"><?php echo esc_html($item['role']); ?></span>
					</figcaption>
				</figure>
			<?php } ?>
		</div>
	</div>
</section>
