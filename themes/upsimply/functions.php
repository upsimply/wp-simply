<?php

/**
 * The theme's bootstrap.
 *
 * The theme is plain PHP templates: header.php and footer.php around every
 * page, a template per kind of page, and the sections a page is made of under
 * template-parts/. Every page is built and changed as code, by the AI site
 * builder or by hand, and reviewed in the site's version history. There is no
 * Site Editor and no block template: the one place blocks still render is a
 * post's or a page's own content, through the_content().
 *
 * Presentation belongs to the theme. Behaviour that has to keep working
 * whatever theme the site runs belongs in the site's snippets/ instead, which
 * load before this. Theme code too large for this file goes in inc/, one file
 * per concern.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Get the URL and version of a file the theme serves, or null while it is not
 * there. The version is the file's modification time, so a changed file is
 * fetched straight away rather than served from a browser's cache.
 *
 * @return array{url: string, version: string}|null
 */
function upsimply_asset(string $path): ?array
{
    $file = get_theme_file_path($path);

    if (! is_file($file)) {
        return null;
    }

    return ['url' => get_theme_file_uri($path), 'version' => (string) filemtime($file)];
}

add_action('after_setup_theme', static function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', ['height' => 64, 'width' => 240, 'flex-height' => true, 'flex-width' => true]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets']);

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'primary' => __('Main menu', 'upsimply'),
        'footer' => __('Footer menu', 'upsimply'),
    ]);

    // Content edited in the block editor -- a post, a page's own text -- is
    // shown there with the site's stylesheet, so it looks the way it will.
    add_theme_support('editor-styles');

    if (upsimply_asset('build/app.css') !== null) {
        add_editor_style('build/app.css');
    }
});

// Late, so the utilities come after WordPress's and WooCommerce's own styles.
add_action('wp_enqueue_scripts', static function (): void {
    $stylesheet = upsimply_asset('build/app.css');

    if ($stylesheet !== null) {
        wp_enqueue_style('upsimply', $stylesheet['url'], [], $stylesheet['version']);
    }

    // app.js registers the theme's Alpine components, so it runs first; both
    // are deferred, which keeps that order and keeps them off the critical path.
    $app = upsimply_asset('assets/js/app.js');
    $alpine = upsimply_asset('assets/js/alpine.min.js');

    if ($app !== null) {
        wp_enqueue_script('upsimply', $app['url'], [], $app['version'], ['strategy' => 'defer', 'in_footer' => false]);
        wp_add_inline_script('upsimply', 'window.upsimply = '.wp_json_encode([
            'storeApi' => class_exists('WooCommerce') ? esc_url_raw(rest_url('wc/store/v1/')) : null,
            'i18n' => [
                'cart' => __('Cart', 'upsimply'),
                /* translators: %d: the number of items in the cart. */
                'cartWithCount' => __('Cart (%d)', 'upsimply'),
            ],
        ]).';', 'before');
    }

    if ($alpine !== null) {
        wp_enqueue_script('alpinejs', $alpine['url'], $app !== null ? ['upsimply'] : [], '3.17.5', ['strategy' => 'defer', 'in_footer' => false]);
    }
}, 20);

require_once __DIR__.'/inc/updater.php';

foreach (glob(__DIR__.'/inc/*.php') ?: [] as $file) {
    require_once $file;
}
