<?php

/**
 * Template Name: Landing page
 *
 * A page designed as code, like the home page: the sections below, with no
 * title band. A page given this template shows this file, not its content, so
 * a landing page of its own is a copy of this file with a template name and
 * sections of its own.
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/sections/hero', null, [
    'title' => get_the_title(),
]);

get_template_part('template-parts/sections/features');

get_template_part('template-parts/sections/pricing');

get_template_part('template-parts/sections/call-to-action');

get_footer();
