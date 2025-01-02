<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'cosmoswp-style','cosmoswp-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 9999 );

// END ENQUEUE PARENT ACTION

function wpb_date_today( $atts, $content = null ) {
	$fmt = new \IntlDateFormatter('it_IT', NULL, NULL);
	
    $atts = shortcode_atts( array(
        'format' => '',
    ), $atts );
 
    $date_time = '';
 
	
   if ( $atts['format'] == '' ) {
        $date_time .= date( get_option( 'date_format' ) );
    } else {
	    $fmt->setPattern($atts['format']); 
        $date_time .= $date=wp_date( __( 'l, j F Y', 'textdomain' ) );
			//$fmt->format(new \DateTime()); 
	    $date_time=ucwords($date_time);
    }
 
    return $date_time;
}
 
add_shortcode( 'date-today', 'wpb_date_today' );


// To enable the use, add this in your *functions.php* file:
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_body_open', 'shortcode_before_entry' );
function shortcode_before_entry() {
	$metaslider_sx=do_shortcode('[metaslider id="3024"]');
	// Making your custom string parses shortcode
	$metaslider_dx=do_shortcode('[metaslider id="3055"]');
	// Making your custom string parses shortcode
	echo $metaslider_sx;
	echo $metaslider_dx;
}

