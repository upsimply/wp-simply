<?php

/**
 * The theme's bootstrap.
 *
 * Presentation belongs to the theme: templates, parts, patterns, block styles
 * and the stylesheet. Behaviour that has to keep working whatever theme the
 * site runs belongs in the site's snippets/ instead, which load before this.
 * Theme code too large for this file goes in inc/, one file per concern.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Get the URL and version of the compiled stylesheet, or null before the
 * first build. The version is the file's modification time, so a rebuild is
 * fetched straight away rather than served from a browser's cache.
 *
 * @return array{url: string, version: string}|null
 */
function upsimply_stylesheet(): ?array
{
    $path = get_theme_file_path('build/app.css');

    if (! is_file($path)) {
        return null;
    }

    return ['url' => get_theme_file_uri('build/app.css'), 'version' => (string) filemtime($path)];
}

add_action('after_setup_theme', static function (): void {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // The same utilities in the editor, so a pattern looks there the way it
    // looks on the site.
    if (upsimply_stylesheet() !== null) {
        add_editor_style('build/app.css');
    }
});

// Late, so the utilities come after WordPress's own block and global styles
// and win a tie with them, while an inline style set in the editor still wins.
add_action('wp_enqueue_scripts', static function (): void {
    $stylesheet = upsimply_stylesheet();

    if ($stylesheet !== null) {
        wp_enqueue_style('upsimply', $stylesheet['url'], [], $stylesheet['version']);
    }
}, 20);

add_action('init', static function (): void {
    register_block_pattern_category('upsimply', ['label' => __('This site', 'upsimply')]);
});

// A pattern made of WooCommerce blocks is offered only while WooCommerce is
// there to render it.
add_action('init', static function (): void {
    if (class_exists('WooCommerce')) {
        return;
    }

    foreach (WP_Block_Patterns_Registry::get_instance()->get_all_registered() as $pattern) {
        if (in_array('woocommerce', $pattern['categories'] ?? [], true) && str_starts_with($pattern['name'], 'upsimply/')) {
            unregister_block_pattern($pattern['name']);
        }
    }
}, 20);

foreach (glob(__DIR__.'/inc/*.php') ?: [] as $file) {
    require_once $file;
}
