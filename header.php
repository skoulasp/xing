<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xing
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php 
    if (function_exists( 'wp_body_open' )) {
        wp_body_open();
    } ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'xing' ); ?></a>
        <header class="site-header">
            <div class="site-branding">
                <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} else { ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                        rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
                }
			$base_description = get_bloginfo( 'description', 'display' );

			if ( $base_description || is_customize_preview() ) :
				?>
                <p class="site-description">
                    <?php echo $base_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </p>
                <?php endif;
    		get_search_form(); ?>
            </div>
            <?php get_template_part( 'template-parts/site-nav' ); ?>
        </header>
        <main id="main" class="site-main">