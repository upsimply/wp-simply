<?php

/**
 * The home page, designed as code.
 *
 * It is made of the sections under template-parts/sections, each given its
 * copy here. Change the words in the arguments, reorder or remove the calls,
 * or add a section of the site's own beside them. Used whether the home page
 * is set to a page or to the latest posts: the posts have their own page.
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/sections/hero', null, [
    'eyebrow' => get_bloginfo('name'),
    'title' => get_bloginfo('description') !== '' ? get_bloginfo('description') : __('A headline that says what you do and for whom', 'upsimply'),
]);

get_template_part('template-parts/sections/features');

get_template_part('template-parts/sections/featured-products');

get_template_part('template-parts/sections/testimonials');

get_template_part('template-parts/sections/faq');

get_template_part('template-parts/sections/call-to-action');

get_footer();
