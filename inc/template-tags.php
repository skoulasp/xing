<?php

function get_the_post_custom_thumbnail( $post_id, $size = 'featured-large', $additional_attributes = [] ) {
    $custom_thumbnail = '';
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_post_thumbnail( $post_id ) ) {
        $default_attributes = [
            'loading' => 'lazy'
        ];
        $attributes = array_merge( $additional_attributes, $default_attributes );
        $custom_thumbnail = wp_get_attachment_image(
			get_post_thumbnail_id( $post_id ),
			$size,
			false,
			$attributes
		);
    }
    return $custom_thumbnail;
}

function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}

function xing_posted_on() {
    $year = get_the_date( 'Y' );
    $month = get_the_date( 'n' );
    $day = get_the_date( 'j' );
    $post_date_archive_permalink = get_day_link( $year, $month, $day );
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    $time_string_single = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    $update_icon = '<span class="dashicons dashicons-update" title="Date updated"></span>';
    // Post is modified ( when post published time is not equal to post modified time )
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_attr( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_attr( get_the_modified_date() )
        );
    } else {
        $time_string = sprintf(
            $time_string_single,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_attr( get_the_date() )
        );
    }
    $posted_on = sprintf(
        /* translators: %s: post date. */
        __( '<span class="dashicons dashicons-clock" title="Date published"></span> %s', 'post date', 'xing' ),
        '<a href="' . esc_url( $post_date_archive_permalink ) . '" rel="bookmark">' . $time_string . '</a>'
    );
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $updated_on = sprintf(
            /* translators: %s: updated date. */
            __( $update_icon . '%s', 'updated date', 'xing' ),
            '<a href="' . esc_url( $post_date_archive_permalink ) . '" rel="bookmark">' . $time_string . '</a>'
        );
        echo '<span class="posted-on text-secondary">' . $posted_on . '<span class="separator-line"></span>' . $updated_on . '</span>';
    } else {
        echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
    }
}

function xing_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		__( '<span class="dashicons dashicons-admin-users" title="Post author"></span> %s', 'post author', 'xing' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' , 'xing' );
	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

function xing_comment_count() {
    $count = get_comments_number();
    $post_id = get_the_ID();
    if ( comments_open() ) {
        $permalink = get_permalink( $post_id ) . '#comments';
        $comment_count = sprintf(
            /* translators: %s: post author. */
            __( '<span class="dashicons dashicons-admin-comments" title="Number of comments"></span> <a href="%s">%s</a>', 'comment count', 'xing' ),
            esc_url( $permalink ),
            '<span class="comments vcard">' . $count . '</span>'
        );

        echo '<span class="comment-count"> ' . $comment_count . '</span>';
    } else {
        // Display an empty div with the class .comments-empty
        echo '<div class="comments-empty"></div>';
    }
}

function xing_the_excerpt( $trim_character_count = 0 ) {
	$post_ID = get_the_ID();

	if ( empty( $post_ID ) ) {
		return null;
	}
	if ( has_excerpt() || 0 === $trim_character_count ) {
		the_excerpt();
		return;
	}
	$the_excerpt = get_the_excerpt( $post_ID );
	$the_excerpt_length = strlen($the_excerpt);
	$the_content_length = strlen(get_the_content( $post_ID ));
	$is_trimmed = ( $the_content_length > $the_excerpt_length );
	$excerpt = wp_html_excerpt( $the_excerpt, $trim_character_count, true);
	echo $excerpt;
}

function xing_excerpt_more( $more = '' ) {

	if ( ! is_single() ) {
		$more = sprintf( '<a class="read-more text-white btn btn-info" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read more', 'xing' )
		);
	}
	return $more;
}

function xing_pagination() {
	$allowed_tags = [
		'span' => [
			'class' => []
		],
		'a' => [
			'class' => [],
			'href' => [],
		]
	];
	$args = [
		'before_page_number' => '<span class="btn border border-secondary">',
		'after_page_number' => '</span>',
	];
	printf( '<nav class="pagination">%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ) );
}