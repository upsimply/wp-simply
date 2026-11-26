<?php

/**
 * Plans side by side, one of them marked as the one most people pick.
 *
 * Arguments: `title`, `text`, `plans` (a list of ['name' => ..., 'price' =>
 * ..., 'period' => ..., 'features' => [...], 'cta' => ['label' => ...,
 * 'url' => ...], 'featured' => bool]).
 */

defined('ABSPATH') || exit;

$section = upsimply_section($args ?? [], [
    'title' => __('Simple pricing', 'upsimply'),
    'text' => __('Pick the plan that fits. Change it whenever you need to.', 'upsimply'),
    'plans' => [
        [
            'name' => __('Starter', 'upsimply'),
            'price' => '—',
            'period' => __('per month', 'upsimply'),
            'features' => [__('What is included', 'upsimply'), __('What is included', 'upsimply')],
            'cta' => ['label' => __('Choose Starter', 'upsimply'), 'url' => '#'],
            'featured' => false,
        ],
        [
            'name' => __('Standard', 'upsimply'),
            'price' => '—',
            'period' => __('per month', 'upsimply'),
            'features' => [__('Everything in Starter', 'upsimply'), __('What is added', 'upsimply'), __('What is added', 'upsimply')],
            'cta' => ['label' => __('Choose Standard', 'upsimply'), 'url' => '#'],
            'featured' => true,
        ],
        [
            'name' => __('Premium', 'upsimply'),
            'price' => '—',
            'period' => __('per month', 'upsimply'),
            'features' => [__('Everything in Standard', 'upsimply'), __('What is added', 'upsimply')],
            'cta' => ['label' => __('Choose Premium', 'upsimply'), 'url' => '#'],
            'featured' => false,
        ],
    ],
]);
?>
<section class="mx-auto max-w-7xl px-6 py-24">
	<div class="mx-auto max-w-2xl text-center">
		<h2 class="font-heading text-2xl font-bold tracking-tight"><?php echo esc_html($section['title']); ?></h2>
		<p class="mt-4 text-lg text-muted"><?php echo esc_html($section['text']); ?></p>
	</div>

	<div class="mt-14 grid gap-8 lg:grid-cols-3">
		<?php foreach ($section['plans'] as $plan) { ?>
			<div class="flex flex-col rounded-lg border p-8 <?php echo ! empty($plan['featured']) ? 'border-primary ring-2 ring-primary' : 'border-line'; ?>">
				<h3 class="font-heading text-lg font-semibold"><?php echo esc_html($plan['name']); ?></h3>
				<p class="mt-4">
					<span class="font-heading text-3xl font-bold"><?php echo esc_html($plan['price']); ?></span>
					<span class="text-sm text-muted"><?php echo esc_html($plan['period']); ?></span>
				</p>
				<ul class="mt-6 flex-1 space-y-2 text-sm">
					<?php foreach ($plan['features'] as $feature) { ?>
						<li class="flex gap-2"><span class="text-primary" aria-hidden="true">&check;</span><?php echo esc_html($feature); ?></li>
					<?php } ?>
				</ul>
				<a href="<?php echo esc_url($plan['cta']['url']); ?>" class="mt-8 rounded-md px-5 py-3 text-center text-sm font-semibold <?php echo ! empty($plan['featured']) ? 'bg-primary text-primary-contrast hover:bg-contrast' : 'border border-contrast text-contrast hover:bg-contrast hover:text-(color:--wp--preset--color--base)'; ?>"><?php echo esc_html($plan['cta']['label']); ?></a>
			</div>
		<?php } ?>
	</div>
</section>
