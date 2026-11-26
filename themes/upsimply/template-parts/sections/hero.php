<?php

/**
 * The opening section of a page: a tagline, the headline, one supporting
 * sentence and up to two buttons.
 *
 * Arguments: `eyebrow`, `title`, `text`, `primary` and `secondary` (each
 * ['label' => ..., 'url' => ...], or [] for no button).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'eyebrow' => __('Tagline', 'upsimply'),
    'title' => __('A headline that says what you do and for whom', 'upsimply'),
    'text' => __('One or two sentences on the result a visitor gets, in their words rather than yours.', 'upsimply'),
    'primary' => ['label' => __('Get started', 'upsimply'), 'url' => '#'],
    'secondary' => ['label' => __('Learn more', 'upsimply'), 'url' => '#'],
]);
?>
<section class="bg-surface">
	<div class="mx-auto max-w-4xl px-6 py-24 text-center md:py-32">
		<?php if ($section['eyebrow'] !== '') { ?>
			<p class="text-sm font-semibold uppercase tracking-widest text-primary"><?php echo esc_html($section['eyebrow']); ?></p>
		<?php } ?>

		<h1 class="mt-4 font-heading text-3xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h1>

		<p class="mx-auto mt-6 max-w-2xl text-lg text-muted"><?php echo esc_html($section['text']); ?></p>

		<?php if ($section['primary'] !== [] || $section['secondary'] !== []) { ?>
			<div class="mt-10 flex flex-wrap items-center justify-center gap-4">
				<?php if ($section['primary'] !== []) { ?>
					<a href="<?php echo esc_url($section['primary']['url']); ?>" class="rounded-md bg-primary px-6 py-3 text-sm font-semibold text-primary-contrast hover:bg-contrast"><?php echo esc_html($section['primary']['label']); ?></a>
				<?php } ?>
				<?php if ($section['secondary'] !== []) { ?>
					<a href="<?php echo esc_url($section['secondary']['url']); ?>" class="rounded-md border border-contrast px-6 py-3 text-sm font-semibold text-contrast hover:bg-contrast hover:text-(color:--wp--preset--color--base)"><?php echo esc_html($section['secondary']['label']); ?></a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>
