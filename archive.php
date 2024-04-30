<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xing
 */

get_header();
$description = get_the_archive_description(); ?>
<?php if ( have_posts() ) : ?>
<header class="page-header">
    <?php the_archive_title( '<h1 class="archive page-title">', '</h1>' ); ?>
    <?php if ( $description ) : ?>
    <div class="archive-description">
        <?php echo wp_kses_post( wpautop( $description ) ); ?>
    </div>
    <?php endif; ?>
</header><!-- .page-header -->
<div class="container-home">
    <div class="post-grid-wrapper">
        <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <?php get_template_part( 'template-parts/content'  ); ?>
        <?php endwhile; ?>
        <?php else : ?>
        <?php get_template_part( 'template-parts/content-none' ); ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>