<?php

/**
 * Small pieces the templates share.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Draw the site's logo, or its name where no logo is set.
 */
function upsimply_brand(string $class = ''): void
{
    if (has_custom_logo()) {
        $logo_id = (int) get_theme_mod('custom_logo');

        printf(
            '<a href="%s" class="%s" rel="home">%s</a>',
            esc_url(home_url('/')),
            esc_attr($class),
            wp_get_attachment_image($logo_id, 'full', false, ['class' => 'h-9 w-auto', 'alt' => get_bloginfo('name')]),
        );

        return;
    }

    printf(
        '<a href="%s" class="%s" rel="home">%s</a>',
        esc_url(home_url('/')),
        esc_attr($class),
        esc_html(get_bloginfo('name')),
    );
}

/**
 * Draw when a post was published, and by whom.
 */
function upsimply_post_meta(): void
{
    printf(
        '<time datetime="%s">%s</time> &middot; %s',
        esc_attr((string) get_the_date('c')),
        esc_html((string) get_the_date()),
        esc_html(get_the_author()),
    );
}

/**
 * Draw the links between pages of a listing.
 */
function upsimply_pagination(): void
{
    $links = paginate_links([
        'type' => 'array',
        'prev_text' => __('Previous', 'upsimply'),
        'next_text' => __('Next', 'upsimply'),
    ]);

    if (! is_array($links) || $links === []) {
        return;
    }

    echo '<nav class="mt-12 flex flex-wrap items-center justify-center gap-2" aria-label="'.esc_attr__('Pages', 'upsimply').'">';

    foreach ($links as $link) {
        // paginate_links() marks the current page with a span and the rest
        // with links; both get the same box.
        echo str_replace(
            ['class="page-numbers', 'class="prev page-numbers', 'class="next page-numbers'],
            [
                'class="rounded-sm border border-line px-3 py-1.5 text-sm hover:border-primary [&[aria-current]]:border-primary [&[aria-current]]:bg-primary [&[aria-current]]:text-primary-contrast page-numbers',
                'class="rounded-sm border border-line px-3 py-1.5 text-sm hover:border-primary prev page-numbers',
                'class="rounded-sm border border-line px-3 py-1.5 text-sm hover:border-primary next page-numbers',
            ],
            $link,
        );
    }

    echo '</nav>';
}

/**
 * Get the template-part arguments a section was given, over its defaults.
 *
 * Sections take their copy as arguments, so the same section can be used on
 * two pages with different words, and keep a default for every argument, so
 * one called with nothing still shows something sensible.
 *
 * @param  array<string, mixed>  $args
 * @param  array<string, mixed>  $defaults
 * @return array<string, mixed>
 */
function upsimply_section(array $args, array $defaults): array
{
    return array_merge($defaults, array_intersect_key($args, $defaults));
}
