<?php
/**
 * Title: Hero
 * Slug: upsimply/hero
 * Categories: upsimply, banner
 * Keywords: hero, intro, banner, header
 * Description: A centred opening section: a tagline, the headline, one supporting sentence and two buttons.
 * Viewport Width: 1280
 */

defined('ABSPATH') || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained","contentSize":"56rem"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:paragraph {"align":"center","className":"font-semibold uppercase tracking-widest","textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center font-semibold uppercase tracking-widest has-primary-color has-text-color has-small-font-size">Tagline</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"huge"} -->
<h1 class="wp-block-heading has-text-align-center has-huge-font-size">A headline that says what you do and for whom</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"large"} -->
<p class="has-text-align-center has-muted-color has-text-color has-large-font-size">One or two sentences on the result a visitor gets, in their words rather than yours.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">Learn more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
