<?php
/**
 * Main template file.
 *
 * @package xing
 */
?>
<?php get_header(); ?>
<div id="primary" class="post-type-page">
    <?php if ( have_posts() ) : ?>
    <?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		else:
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
</div>
<?php get_footer() ?>