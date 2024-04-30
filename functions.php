<?php
/**
 * Theme Functions and definitions.
 * 
 * @package xing
 */

 function xing_setup() {
    load_theme_textdomain( 'XING', get_template_directory() . '/languages' );
    
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-line-height' );
    add_theme_support( 'experimental-link-color' );
    add_theme_support( 'link-color' );
    add_theme_support( 'custom-spacing' );
    add_theme_support( 'custom-units' );
    add_theme_support( 'block-templates' );
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        )
    );

 }

 $logo_height = 100;
 add_theme_support(
     'custom-logo',
     array(
         'height'               => $logo_height,
         // 'width'                => $logo_width,
         'flex-width'           => true,
         'flex-height'          => true,
         'unlink-homepage-logo' => true,
     )
 );

 add_action( 'after_setup_theme', 'xing_setup' );

 function xing_register_menus() {
    register_nav_menus([
     'header-menu' => esc_html__( 'Header Menu', 'xing' ),
     'footer-menu' => esc_html__( 'Footer Menu', 'xing' ),
     'social' => esc_html__( 'Social Links', 'xing' )
    ]);
 }

add_action( 'init', 'xing_register_menus' );

define( 'XING_DEV_MODE', true );

 if ( ! defined( 'XING_DIR_PATH' ) ) {
	define( 'XING_DIR_PATH', untrailingslashit( get_template_directory() ) );
}
 if ( ! defined( 'XING_DIR_URI' ) ) {
	define( 'XING_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}
if ( ! defined( 'XING_BUILD_PATH' ) ) {
	define( 'XING_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/assets/build' );
}
if ( ! defined( 'XING_BUILD_URI' ) ) {
	define( 'XING_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}


 function xing_scripts() {
    $ver = XING_DEV_MODE ? time() : false;
	wp_enqueue_style( 'xing-style', XING_DIR_URI . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'main-css', XING_DIR_URI . '/assets/build/css/main.css', [], $ver );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_script( 'main-js',  XING_DIR_URI . '/assets/build/js/main.js', [], $ver );
}

add_action( 'wp_enqueue_scripts', 'xing_scripts' );

$editor_stylesheet_path = './assets/build/css/editor-styles.css';
add_editor_style( $editor_stylesheet_path );

function xing_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar Footer',
        'id'            => 'sidebar-footer',
        'description'   => 'Add widgets here to appear in your sidebar.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => 'Sidebar Left',
        'id'            => 'sidebar-main-left',
        'description'   => 'Add widgets here to appear in your sidebar.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => 'Sidebar Right',
        'id'            => 'sidebar-main-right',
        'description'   => 'Add widgets here to appear in your sidebar.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'xing_widgets_init' );

require XING_DIR_PATH . '/inc/template-tags.php';
require XING_DIR_PATH . '/inc/icon-functions.php';

function xing_load_dashicons(){
	wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'xing_load_dashicons');

function defer_parsing_of_js($url) {
    if (is_admin()) return $url; //don't break WP Admin
    if (false === strpos($url, '.js')) return $url;
    if (strpos($url, 'jquery.js')) return $url;
    return str_replace(' src', ' defer src', $url);
  }
  
  add_filter('script_loader_tag', 'defer_parsing_of_js', 10);

  function xing_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}