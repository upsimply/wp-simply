<?php

/**
 * Menus, drawn with the theme's own classes.
 *
 * wp_nav_menu() takes two extra arguments here: `li_class` for every item and
 * `link_class` for every link, so a menu is styled where it is called, with
 * utilities, rather than through WordPress's generated class names. A menu
 * nobody has set up yet falls back to the site's top-level pages, drawn the
 * same way, so a new site has a working menu.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

add_filter('nav_menu_css_class', static function (array $classes, WP_Post $item, stdClass $args): array {
    if (isset($args->li_class) && is_string($args->li_class)) {
        $classes[] = $args->li_class;
    }

    return $classes;
}, 10, 3);

add_filter('nav_menu_link_attributes', static function (array $atts, WP_Post $item, stdClass $args): array {
    if (isset($args->link_class) && is_string($args->link_class)) {
        $atts['class'] = trim(($atts['class'] ?? '').' '.$args->link_class);
    }

    return $atts;
}, 10, 3);

/**
 * Draw a menu location with the given classes.
 *
 * @param  array{menu_class?: string, li_class?: string, link_class?: string, depth?: int}  $classes
 */
function upsimply_menu(string $location, array $classes = []): void
{
    $args = [
        'theme_location' => $location,
        'container' => false,
        'menu_class' => $classes['menu_class'] ?? '',
        'li_class' => $classes['li_class'] ?? '',
        'link_class' => $classes['link_class'] ?? '',
        'depth' => $classes['depth'] ?? 1,
        'fallback_cb' => false,
    ];

    if (has_nav_menu($location)) {
        wp_nav_menu($args);

        return;
    }

    if ($location !== 'primary') {
        return;
    }

    $pages = get_pages(['parent' => 0, 'sort_column' => 'menu_order,post_title', 'number' => 6]);

    echo '<ul class="'.esc_attr($args['menu_class']).'">';

    foreach ($pages as $page) {
        $current = is_page($page->ID);

        printf(
            '<li class="%s"><a class="%s" href="%s"%s>%s</a></li>',
            esc_attr($args['li_class']),
            esc_attr($args['link_class']),
            esc_url((string) get_permalink($page)),
            $current ? ' aria-current="page"' : '',
            esc_html(get_the_title($page)),
        );
    }

    echo '</ul>';
}
