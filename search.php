<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package xing
 */

get_header(); ?>

<div class="search-results">
    <?php
if ( have_posts() ) :
	?>
    <header class="page-header alignwide">
        <h1 class="page-title">
            <?php
			printf(
				/* translators: %s: Search term. */
				esc_html__( 'Search Results for "%s"', 'xing' ),
				'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
			);
			?>
        </h1>
        <div class="search-result-count default-max-width">
            <?php
		printf(
			esc_html(
				/* translators: %d: The number of search results. */
				_n(
					'We found %d result for your search.',
					'We found %d results for your search.',
					(int) $wp_query->found_posts,
					'xing'
				)
			),
			(int) $wp_query->found_posts
		);
		?>
        </div><!-- .search-result-count -->
    </header><!-- .page-header -->
    <div class="container-home">
        <?php if ( is_home() && ! is_front_page() ) { ?>
        <header class="single-post-title">
            <h1 class="page-title screen-reader-text">
                <?php single_post_title(); ?>
            </h1>
        </header>
        <?php } ?>
        <div class="widget-area-left">
            <div class="custom-widget-area">
                <?php dynamic_sidebar( 'sidebar-main-left' ); ?>
            </div>
        </div>
        <div class="post-grid-wrapper">
            <?php
			while ( have_posts() ) : the_post();
			if ( get_post_type() === 'page' ) :
				get_template_part( 'template-parts/content-page-excerpt' );
			elseif ( get_post_type() === 'post' ):
				get_template_part( 'template-parts/content' );
			endif;
			endwhile;
		else :
			get_template_part( 'template-parts/content-none' );
		endif; ?>

        </div>
        <div class="widget-area-right">
            <div class="custom-widget-area">
                <?php dynamic_sidebar( 'sidebar-main-right' ); ?>
            </div>
        </div>
    </div>
    <?php get_footer();