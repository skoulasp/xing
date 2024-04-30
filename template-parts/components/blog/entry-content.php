<?php
/**
 * Template for entry content.
 *
 * To be used inside WordPress The Loop.
 *
 * @package xing
 */

?>

<div id="blog-content" class="entry-content">
    <?php
if ( is_single() ) {
	the_content(
		sprintf(
			wp_kses(
			/* translators: %s: Name of current post. */
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'xing' ),
				[
					'span' => [
						'class' => [],
					],
				]
			),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		)
	);

	wp_link_pages(
		[
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xing' ),
			'after'  => '</div>',
		]
	); ?>
</div>
<?php
} else {
	?>
<?php xing_the_excerpt( 400 ); ?>
</div>
<?php

}

$the_post_id   = get_the_ID();
$article_terms = wp_get_post_terms( $the_post_id, [ 'category', 'post_tag' ] );

if ( empty( $article_terms ) || ! is_array( $article_terms ) ) {
	return;
}

?>