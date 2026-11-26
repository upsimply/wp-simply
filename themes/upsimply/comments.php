<?php

/**
 * The comments under a post, and the form to add one.
 */

defined('ABSPATH') || exit;

if (post_password_required()) {
    return;
}
?>
<section id="comments" class="mx-auto mt-16 max-w-3xl px-6">
	<?php if (have_comments()) { ?>
		<h2 class="font-heading text-xl font-semibold">
			<?php printf(
			    /* translators: %s: the number of comments. */
			    esc_html(_n('%s comment', '%s comments', get_comments_number(), 'upsimply')),
			    esc_html(number_format_i18n(get_comments_number())),
			); ?>
		</h2>

		<ol class="mt-6 space-y-6 [&_.children]:mt-6 [&_.children]:space-y-6 [&_.children]:pl-6 [&_.comment-meta]:text-sm [&_.comment-meta]:text-muted [&_.avatar]:mr-2 [&_.avatar]:inline [&_.avatar]:rounded-full">
			<?php wp_list_comments(['style' => 'ol', 'short_ping' => true, 'avatar_size' => 32]); ?>
		</ol>

		<?php the_comments_pagination(); ?>
	<?php } ?>

	<?php if (comments_open()) { ?>
		<div class="mt-10 [&_input:not([type=submit]):not([type=checkbox])]:w-full [&_input:not([type=submit]):not([type=checkbox])]:rounded-sm [&_input:not([type=submit]):not([type=checkbox])]:border [&_input:not([type=submit]):not([type=checkbox])]:border-line [&_input:not([type=submit]):not([type=checkbox])]:px-3 [&_input:not([type=submit]):not([type=checkbox])]:py-2 [&_textarea]:w-full [&_textarea]:rounded-sm [&_textarea]:border [&_textarea]:border-line [&_textarea]:px-3 [&_textarea]:py-2 [&_p]:mt-4 [&_label]:block [&_label]:text-sm [&_label]:font-medium">
			<?php comment_form([
			    'class_submit' => 'mt-4 rounded-sm bg-primary px-5 py-2.5 text-sm font-semibold text-primary-contrast hover:bg-contrast',
			    'title_reply_before' => '<h2 id="reply-title" class="font-heading text-xl font-semibold">',
			    'title_reply_after' => '</h2>',
			]); ?>
		</div>
	<?php } ?>
</section>
