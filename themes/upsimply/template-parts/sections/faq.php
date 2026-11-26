<?php

/**
 * Common questions, each opening its answer when clicked.
 *
 * Arguments: `title`, `items` (a list of ['question' => ..., 'answer' => ...]).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'title' => __('Questions people ask', 'upsimply'),
    'items' => [
        ['question' => __('A question customers ask before buying?', 'upsimply'), 'answer' => __('A short, direct answer.', 'upsimply')],
        ['question' => __('Another question customers ask?', 'upsimply'), 'answer' => __('A short, direct answer.', 'upsimply')],
        ['question' => __('A third question customers ask?', 'upsimply'), 'answer' => __('A short, direct answer.', 'upsimply')],
    ],
]);
?>
<section class="mx-auto max-w-3xl px-6 py-24">
	<h2 class="text-center font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>

	<div class="mt-12 divide-y divide-line border-y border-line">
		<?php foreach ($section['items'] as $item) { ?>
			<details class="group py-5">
				<summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold [&::-webkit-details-marker]:hidden">
					<?php echo esc_html($item['question']); ?>
					<span class="text-muted transition group-open:rotate-45" aria-hidden="true">+</span>
				</summary>
				<p class="mt-3 text-muted"><?php echo esc_html($item['answer']); ?></p>
			</details>
		<?php } ?>
	</div>
</section>
