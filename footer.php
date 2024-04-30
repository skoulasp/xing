<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package xing
 */
?>
</main>
<footer id="site-footer" class="footer">
    <?php
    if ( has_nav_menu( 'footer-menu' ) ) :
        $args = array(
            'theme_location' => 'footer-menu',        
            'menu_class' => 'main-footer',
            'menu_id' => 'footer-menu',
        );
        wp_nav_menu( $args );
    endif;
    ?>
    <div class="site-info">
        <?php
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
                }
        
                if ( is_active_sidebar( 'sidebar-footer' ) ) {
                    dynamic_sidebar( 'sidebar-footer' );
                } 
                ?>
    </div><!-- .site-info -->
    <div class="social-wrap">
        <?php
                    if ( has_nav_menu( 'social' ) ) :
                        ?>
        <nav class="social-navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'xing' ); ?>">
            <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'social',
                                        'menu_class'     => 'social-links-menu',
                                        'depth'          => 1,
                                        'link_before'    => '<span class="screen-reader-text">',
                                        'link_after'     => '</span>' . xing_get_svg( array( 'icon' => 'chain' ) ),
                                    )
                                );
                            ?>
        </nav><!-- .social-navigation -->
        <?php
                    endif;
                    ?>
    </div><!-- .wrap -->
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>