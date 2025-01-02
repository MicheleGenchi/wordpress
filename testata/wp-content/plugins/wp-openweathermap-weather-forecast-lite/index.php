<?php
/**
 * @package wp_openweathermap_weather_forecast_lite
 * @version 1.0
 */
/*
Plugin Name: WP OpenWeatherMap Weather Forecast Lite
Plugin URI: http://wordpress.org/plugins/wp-openweathermap-weather-forecast-lite/
Description: This plugin will show weather data and weather forecast on your WordPress site via short code. It also provides widget area to show the current weather stats of a city. The plugin uses OpenWeatherMap API key to show weather data.
Author: CodeSpeedy
Version: 1.0
Author URI: https://www.codespeedy.com/
*/
add_action("admin_menu", "cspdy_owm_options");
function cspdy_owm_options() {
	add_menu_page(
            //'settings',
            'OpenWeatherMap Weather Forecast',
            'Weather',
            'administrator',
            'cspdy-weather-settings-page',
            'cspdy_weather_settings_page',
            plugin_dir_url( __FILE__ ) . 'imgs/icon26.png'
         );
	
}
add_action('admin_init', 'cspdy_owm_settings_options');
function cspdy_owm_settings_options() {
	register_setting('cspdy_option_group', 'cspdy_owm_api_key');
	register_setting('cspdy_option_group', 'cspdy_bing_credential');
	register_setting('cspdy_option_group', 'cspdy_map_enabled');
	register_setting('cspdy_option_group', 'cspdy_detect_location');
	register_setting('cspdy_option_group', 'cspdy_ipinfodb_api');
	register_setting('cspdy_option_group', 'cspdy_default_city');

	register_setting('cspdy_option_group', 'cspdy_default_unit');
	register_setting('cspdy_option_group', 'cspdy_choose_unit');
	register_setting('cspdy_option_group', 'cspdy_place_autocomplete');
	
	register_setting('cspdy_option_group', 'cspdy_owm_widget_bg');
	register_setting('cspdy_option_group', 'cspdy_owm_widget_clr');

	register_setting('cspdy_option_group', 'cspdy_theme_color');
	register_setting('cspdy_option_group', 'cspdy_font_color');
	register_setting('cspdy_option_group', 'cspdy_sc_theme_color');
	register_setting('cspdy_option_group', 'cspdy_sc_font_color');
	
	register_setting('cspdy_option_group', 'cspdy_current_weather_layout');
	register_setting('cspdy_option_group', 'cspdy_enable_save_city');

	register_setting('cspdy_option_group', 'cspdy_max_temp_chart_bg');
	register_setting('cspdy_option_group', 'cspdy_max_temp_chart_border');
	register_setting('cspdy_option_group', 'cspdy_min_temp_chart_bg');
	register_setting('cspdy_option_group', 'cspdy_min_temp_chart_border');
	register_setting('cspdy_option_group', 'cspdy_temp_chart_tooltip_bg');

	register_setting('cspdy_option_group', 'cspdy_humidity_chart_bg');
	register_setting('cspdy_option_group', 'cspdy_humidity_chart_border');
	register_setting('cspdy_option_group', 'cspdy_humidity_chart_tooltip_bg');

	register_setting('cspdy_option_group', 'cspdy_pressure_chart_bg');
	register_setting('cspdy_option_group', 'cspdy_pressure_chart_border');
	register_setting('cspdy_option_group', 'cspdy_pressure_chart_tooltip_bg');

	register_setting('cspdy_option_group', 'cspdy_fc_icon_color');
	register_setting('cspdy_option_group', 'cspdy_fc_icon_size');

	register_setting('cspdy_option_group', 'cspdy_display_temp_chart');
	register_setting('cspdy_option_group', 'cspdy_display_humidity_chart');
	register_setting('cspdy_option_group', 'cspdy_display_pressure_chart');
	
}


function cspdy_owm_custome_js()
{ ?>


	        (function( $ ) {
  
               var bing_map_enabled = "<?php echo get_option('cspdy_map_enabled'); ?>";
               if (bing_map_enabled != "map_enabled") {
               	  $('#bing_credential_tbl').css('display','none');
               }
               //alert(bing_map_enabled);

               $('#map_enabled').change(function () {
                   if (!this.checked) 
                //  ^
                      $('#bing_credential_tbl').fadeOut('slow');
                   else 
                       $('#bing_credential_tbl').fadeIn('slow');
               });
     
          })( jQuery );



          


          (function( $ ) {

               var detect_location = "<?php echo get_option('cspdy_detect_location'); ?>";
               if (detect_location != "checked") {
                  $('#ipinfodb_api').css('display','none');
               } else {
                  $('#default_city').css('display','none');
               }
               //alert(bing_map_enabled);

               $('#detect_location').change(function () {
                   if (!this.checked) {
                //  ^
                      $('#default_city').fadeIn('slow');
                      $('#ipinfodb_api').fadeOut('slow');
                    }
                   else {
                       $('#default_city').fadeOut('slow');
                      $('#ipinfodb_api').fadeIn('slow');
                    }
               });
               
          })( jQuery );
     


<?php }


function cspdy_owm_option_script($hook) {
    wp_register_script( 'cspdy_owm_admin_script', plugin_dir_url( __FILE__ ) . 'js/admin_main.js', array(), false, true );
    wp_register_style(
        'cdspdy-owm-admin-style',
        plugin_dir_url( __FILE__ ) . 'css/admin.css'
    );

    $custom_map_check_js = "


         document.addEventListener('DOMContentLoaded', function() {

	        (function( $ ) {
  
               var bing_map_enabled = '".get_option('cspdy_map_enabled')."';
               if (bing_map_enabled != 'map_enabled') {
               	  $('#bing_credential_tbl').css('display','none');
               }
               //alert(bing_map_enabled);

               $('#map_enabled').change(function () {
                   if (!this.checked) 
                //  ^
                      $('#bing_credential_tbl').fadeOut('slow');
                   else 
                       $('#bing_credential_tbl').fadeIn('slow');
               });
     
          })( jQuery );



          


          (function( $ ) {

               var detect_location = '".get_option('cspdy_detect_location')."';
               if (detect_location != 'checked') {
                  $('#ipinfodb_api').css('display','none');
               } else {
                  $('#default_city').css('display','none');
               }
               //alert(bing_map_enabled);

               $('#detect_location').change(function () {
                   if (!this.checked) {
                //  ^
                      $('#default_city').fadeIn('slow');
                      $('#ipinfodb_api').fadeOut('slow');
                    }
                   else {
                       $('#default_city').fadeOut('slow');
                      $('#ipinfodb_api').fadeIn('slow');
                    }
               });
               
          })( jQuery );


       }, false);
     
    ";


        wp_add_inline_script( 'cspdy_owm_admin_script', $custom_map_check_js );


}
add_action( 'admin_enqueue_scripts', 'cspdy_owm_option_script' );


function cspdy_weather_settings_page() { 
    wp_enqueue_script( 'cspdy_owm_admin_script' );
    wp_enqueue_style( 'cdspdy-owm-admin-style' );
	?>

<div class="wrap" style="background-color: #fff;padding: 6px;">
  
	<form class="save_owm_form" action="options.php" method="post">

	     <div class="seven columns">
	     <?php settings_fields('cspdy_option_group');
	     do_settings_sections('cspdy_option_group'); ?>
	
	     <div class="option-item1">
	     
	     <table class="form-table">
         <?php include 'settings/config_settings.php'; ?>

         <tr valign="top" class="owm_heading">
          <th scope="row" style="font-size: 1.6em;">General Settings </th>
          <td></td>
         </tr>


            <?php
               wp_enqueue_style( 'wp-color-picker' );
               //wp_enqueue_script( 'custom_js', plugins_url( 'js/custom.js', __FILE__ ), array(), $my_js_ver );
               wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( 'js/wp-alpha.js', __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );
            
          include 'settings/general_settings.php'; 
          include 'settings/chart_settings.php'; 
          include 'settings/widget_settings.php';
          ?>

</table>
	
	     <?php submit_button('Save Settings'); ?>
	
	     </div>
	
	     </div> <!-- end col-sm-8-->
	
	</form>


</div>
	
<?php
}

	include "class/CurrentClass.php";
	include "class/Weather_icon.php";
	include "class/Forecast.php";

include 'owm_shortcode.php';
include 'widget.php';