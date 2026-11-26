<?php

/**
 * The bottom of every page: the site footer, then WordPress's own scripts.
 */

defined('ABSPATH') || exit;
?>
</main>

<footer class="mt-24 border-t border-line bg-surface">
	<div class="mx-auto flex max-w-7xl flex-col gap-8 px-6 py-12 md:flex-row md:items-start md:justify-between">
		<div class="max-w-sm">
			<?php upsimply_brand('text-lg font-bold tracking-tight text-contrast'); ?>
			<p class="mt-3 text-sm text-muted"><?php echo esc_html(get_bloginfo('description')); ?></p>
		</div>

		<nav aria-label="<?php esc_attr_e('Footer', 'upsimply'); ?>">
			<?php upsimply_menu('footer', [
			    'menu_class' => 'flex flex-wrap gap-x-8 gap-y-2',
			    'link_class' => 'text-sm text-muted hover:text-contrast',
			]); ?>
		</nav>
	</div>

	<div class="border-t border-line">
		<p class="mx-auto max-w-7xl px-6 py-6 text-sm text-muted">
			&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
