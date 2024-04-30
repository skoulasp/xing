<?php
/**
 * Main template file.
 *
 * @package xing 
 */
?>

<?php get_header(); ?>

<div id="primary">
    <section class="title-area">
        <h1 class="blog-home-title"><span class="title-name"><?php bloginfo('name'); ?></span><br>The Blog</h1>
        <div class="title-stats">
            <?php
    // Total Number of Blog Posts
    $post_count = wp_count_posts()->publish;
    ?>
            <div class="stat-subgroup">
                <span><?php echo $post_count; ?></span>
                <span>Posts</span>
            </div>

            <?php
    // Total Number of Authors
    $authors = count_users();
    $total_authors = $authors['total_users'];
    ?>
            <div class="stat-subgroup">
                <span><?php echo $total_authors; ?></span>
                <span>Authors</span>
            </div>

            <?php
    $total_categories = wp_count_terms('category');
    ?>
            <div class="stat-subgroup">
                <span><?php echo $total_categories ?></span>
                <span>Post Categories</span>
            </div>
            <?php
    // Days Since the Last Post
    $args = array(
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
    $latest_post = get_posts($args)[0];
    $days_since_last_post = floor((time() - strtotime($latest_post->post_date)) / (60 * 60 * 24));
    ?>
            <div class="stat-subgroup">
                <span><?php echo $days_since_last_post;; ?></span>
                <span>Days Since Last Post</span>
            </div>


        </div>
    </section>

    <?php
		if ( have_posts() ) :
			?>
    <div class="container-home">
        <?php
				if ( is_home() && ! is_front_page() ) {
					?>
        <!-- <header class="single-post-title">
            <h1 class="page-title screen-reader-text">
                <?php single_post_title(); ?>
            </h1>
        </header> -->
        <?php
				}
				?>
        <div class="widget-area-left">
            <div class="custom-widget-area">
                <?php dynamic_sidebar( 'sidebar-main-left' ); ?>
            </div>
        </div>
        <div class="post-grid-wrapper">
            <?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content' );
			endwhile;
		else :
			get_template_part( 'template-parts/content-none' );
		endif;
		?>
        </div>
        <div class="widget-area-right">
            <div class="custom-widget-area">
                <?php dynamic_sidebar( 'sidebar-main-right' ); ?>
            </div>
        </div>
        <?php xing_pagination(); get_footer(); ?>
    </div>
</div>