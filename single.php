<?php
/**
 * Single post template file.
 *
 * @package xing
 */
?>

<?php get_header(); ?>
<?php
        if ( have_posts() ) :
            ?>
<div class="post-wrap">
    <?php
            if ( is_home() && ! is_front_page() ) {
                ?>
    <header class="post-header">
        <h1 class="page-title screen-reader-text">
            <?php single_post_title(); ?>
        </h1>
    </header>
    <?php
            }

            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content' );

            endwhile;
            ?>

    <?php

        else :

            get_template_part( 'template-parts/content-none' );

            ?>

</div>
<?php
        endif;

        // For Single Post loadmore button, uncomment this code and comment next and prev link code below.
//						 echo do_shortcode( '[single_post_listings]' )
        ?>

<hr class="single-separator">
<?php
    // Next and previous link for page navigation.
                // If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
comments_template();
endif;
    ?>

<nav class="single-pagination">
    <div class="prev-link"><?php previous_post_link('%link', "Previous Post"); ?></div>
    <div class="next-link"><?php next_post_link('%link', "Next Post"); ?></div>
</nav>
</div>

<?php get_footer();