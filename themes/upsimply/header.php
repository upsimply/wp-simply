<?php

/**
 * The top of every page: the document head, then the site header with the
 * logo, the main menu and, on a shop, the account and cart links. The menu
 * folds behind a button on small screens.
 */

defined('ABSPATH') || exit;

$has_shop = class_exists('WooCommerce');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('bg-base font-sans text-contrast antialiased'); ?>>
<?php wp_body_open(); ?>
<a class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-sm focus:bg-base focus:px-4 focus:py-2 focus:shadow" href="#content"><?php esc_html_e('Skip to content', 'upsimply'); ?></a>

<header class="border-b border-line bg-base" x-data="{ open: false }" @keydown.escape.window="open = false">
	<div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-4">
		<?php upsimply_brand('text-lg font-bold tracking-tight text-contrast'); ?>

		<nav class="hidden md:block" aria-label="<?php esc_attr_e('Main', 'upsimply'); ?>">
			<?php upsimply_menu('primary', [
			    'menu_class' => 'flex items-center gap-8',
			    'link_class' => 'text-sm font-medium text-contrast hover:text-primary [&[aria-current]]:text-primary',
			]); ?>
		</nav>

		<div class="flex items-center gap-2">
			<?php if ($has_shop) { ?>
				<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="hidden rounded-sm p-2 text-contrast hover:text-primary sm:block" aria-label="<?php esc_attr_e('Account', 'upsimply'); ?>">
					<svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75c-2.68 0-5.22-.58-7.5-1.65Z"/></svg>
				</a>
				<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative rounded-sm p-2 text-contrast hover:text-primary" x-data="cartCount(<?php echo (int) upsimply_cart_count(); ?>)" :aria-label="label" aria-label="<?php esc_attr_e('Cart', 'upsimply'); ?>">
					<svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.36-1.99 1.26 12A1.13 1.13 0 0 1 19.75 21.75H4.25a1.13 1.13 0 0 1-1.12-1.24l1.26-12A1.13 1.13 0 0 1 5.51 7.5h12.98c.58 0 1.06.43 1.12 1.01Z"/></svg>
					<span x-show="count > 0" x-text="count" x-cloak class="absolute -right-0.5 -top-0.5 flex min-w-5 items-center justify-center rounded-full bg-primary px-1 text-[0.7rem] font-semibold leading-5 text-primary-contrast"></span>
				</a>
			<?php } ?>

			<button type="button" class="rounded-sm p-2 text-contrast hover:text-primary md:hidden" @click="open = !open" :aria-expanded="open.toString()" aria-expanded="false" aria-controls="mobile-menu" aria-label="<?php esc_attr_e('Menu', 'upsimply'); ?>">
				<svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
			</button>
		</div>
	</div>

	<nav id="mobile-menu" class="border-t border-line md:hidden" x-show="open" x-cloak x-transition aria-label="<?php esc_attr_e('Main', 'upsimply'); ?>">
		<?php upsimply_menu('primary', [
		    'menu_class' => 'mx-auto flex max-w-7xl flex-col px-6 py-3',
		    'link_class' => 'block py-2 font-medium text-contrast hover:text-primary [&[aria-current]]:text-primary',
		]); ?>
	</nav>
</header>

<main id="content">
