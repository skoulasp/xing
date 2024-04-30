<?php
/**
 * Header Navigation template.
 *
 * @package xing
 */
?>

<nav id="site-navigation" class="main-navigation">
    <div class="nav__layout">
        <div class="logo-n-hamburger-wrap">
            <div class="brand-or-logo-alt width-0">
                <div class="site-branding">
                    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                        the_custom_logo();
                    } else { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                            rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php } ?>
                </div>
            </div>
            <div class="hamburger" id="hamburger-btn">
                <a class="hamburger__link" href="#"></a>
            </div>
        </div>
        <?php
            if ( has_nav_menu( 'header-menu' ) ) :
                $args = array(
                    'theme_location' => 'header-menu',        
                    'menu_class' => 'main-nav',
                    'menu_id' => 'nav-menu',
                );
                wp_nav_menu( $args );
            endif;
        ?>
        <div class="search-alt">
            <?php get_search_form( array( 'search_dashicon_class' => 'search-dashicon-hidden' ) ); ?></div>
    </div>
</nav>