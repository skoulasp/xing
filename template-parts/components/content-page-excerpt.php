<?php
/**
 * Template part for displaying page content in page.php
 * @package xing
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="excerpt-header">
        <?php printf(
			'<h2 class="excerpt-title post-card-title"><a class="text-dark" href="%1$s">%2$s</a></h2>',
			esc_url( get_the_permalink() ),
			wp_kses_post( get_the_title() )
		);
		?>
    </header><!-- .excerpt-header -->
    <div class="excerpt-content">
        <?php
			xing_the_excerpt( 400 );

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'xing' ),
					'after'  => '</div>',
				)
			);?>

        <?php

			?>
    </div><!-- .excerpt-content -->
    <div class="excerpt-footer">
        <div class="footer-items">
            <a href="<?php the_permalink(); ?>">Visit Page</a>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->