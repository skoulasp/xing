<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package xing
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$xing_unique_id = wp_unique_id( 'search-form-' );
$xing_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
// Check if an additional argument for the extra class is provided
$search_dashicon_class = isset( $args['search_dashicon_class'] ) ? esc_attr( $args['search_dashicon_class'] ) : '';
?>
<form role="search" <?php echo $xing_aria_label; ?> method="get" class="search-form search-hidden"
    action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo esc_attr( $xing_unique_id ); ?>"></label>
    <input type="search" id="<?php echo esc_attr( $xing_unique_id ); ?>" class="search-field"
        value="<?php echo get_search_query(); ?>" placeholder="Search..." name="s" autocomplete="off" />
    <input type="submit" class="search-submit"
        value="<?php echo esc_attr_x( 'Search', 'submit button', 'xing' ); ?>" />
    <span class="dashicons dashicons-search <?php echo $search_dashicon_class; ?>">&nbsp;</span>
    <span class="dashicons dashicons-no-alt">&nbsp;</span>
</form>