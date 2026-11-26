<?php

/**
 * A page whose content is written in the block editor: About, Contact, the
 * legal pages, and WooCommerce's cart, checkout and account pages, whose
 * content is WooCommerce's own blocks or shortcodes.
 *
 * A page designed as code instead uses a template of its own: front-page.php
 * for the home page, page-templates/ for any other.
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) {
    the_post();

    get_template_part('template-parts/page-header', null, [
        'title' => get_the_title(),
        'description' => has_excerpt() ? get_the_excerpt() : '',
    ]);
    ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('mx-auto max-w-7xl px-6 py-16'); ?>>
		<div class="entry-content<?php echo function_exists('is_woocommerce') && (is_cart() || is_checkout() || is_account_page()) ? '' : ' mx-auto max-w-3xl'; ?>">
			<?php the_content(); ?>
		</div>
		<?php wp_link_pages(); ?>
	</article>
	<?php

    if (comments_open() || get_comments_number() > 0) {
        comments_template();
    }
}

get_footer();
