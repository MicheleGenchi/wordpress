<?php

// register My_Widget
add_action( 'widgets_init', function(){
	register_widget( 'cspdy_owm_widget' );
});

class cspdy_owm_widget extends WP_Widget {
	// class constructor
	public function __construct() {
		$widget_ops = array( 
		'classname' => 'cspdy_owm_widget',
		'description' => 'OpenWeatherMap Current Weather Widget',
	);
	parent::__construct( 'cspdy_owm_widget', 'Weather Widget', $widget_ops );
	}
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {

        $owm_unit = $instance[ 'cspdy_owm_unit' ];

        if ($instance[ 'cspdy_owm_city' ] == "") {

            if (get_option('cspdy_detect_location') == "checked") {
               include 'detect_location.php';
               $currentObj = new CurrentClass(get_option('cspdy_owm_api_key'), $owm_city, $owm_unit);
            } else {
               $owm_city = get_option('cspdy_default_city');
               $currentObj = new CurrentClass(get_option('cspdy_owm_api_key'), $owm_city, $owm_unit);
            }

        } else {
            $currentObj = new CurrentClass(get_option('cspdy_owm_api_key'), $instance[ 'cspdy_owm_city' ], $owm_unit);
        }


        $city = $currentObj->getCity();
        $country = $currentObj->getCountry();
        $temperature = $currentObj->temp();
        $conditionDes = $currentObj->conditionDes();
        $conditionMain = $currentObj->conditionDes();
        $pressure = $currentObj->pressure();
        $visibility = $currentObj->visibility();
        $humidity = $currentObj->humidity();

        $windSpeed = $currentObj->windSpeed();
        $windDeg = $currentObj->windDeg();
        $clouds = $currentObj->clouds();
        $dt = $currentObj->dt();
        $sunrise = $currentObj->sunrise();
        $sunriseLocal = $currentObj->sunriseLocal();
        $sunset = $currentObj->sunset();
        $sunsetLocal = $currentObj->sunsetLocal();
        $lattitude = $currentObj->getLat();
        $longitude = $currentObj->getLon();
        ?>

        <div style="background-color: <?php echo get_option('cspdy_owm_widget_bg'); ?>; color: <?php echo get_option('cspdy_owm_widget_clr'); ?>; padding: 8px;display: block;">
        <?php

        if ($city=="Location not found") {
            echo "Location not found"; exit();
        }

        echo $city."<br/>";
        echo "<i style='font-size: 1em; vertical-align: middle;' class='wi wi-thermometer'></i> Temperature: ".$temperature.$currentObj->temp_unit();
        echo "<br/>";
        echo "== Feels like: ".$currentObj->feels_like_temp().$currentObj->temp_unit();
        ?>
        </div>
        <?php
	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
         

    $defaults = array(
        'cspdy_owm_city' => '-1',
        'cspdy_owm_unit' => '-1'
        //'owm_background' => '-1'
    );
    $cspdy_owm_city = $instance[ 'cspdy_owm_city' ];
    $cspdy_owm_unit = $instance[ 'cspdy_owm_unit' ];
    //$owm_background = $instance[ 'owm_background' ];
     
    // markup for form ?>

    <p>

<br/>

        <label for="<?php echo $this->get_field_id( 'cspdy_owm_city' ); ?>">City Name:</label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'cspdy_owm_city' ); ?>" name="<?php echo $this->get_field_name( 'cspdy_owm_city' ); ?>" value="<?php echo esc_attr( $cspdy_owm_city ); ?>">


        <label for="<?php echo $this->get_field_id( 'cspdy_owm_unit' ); ?>">Unit:</label>

        <select class="widefat"  id="<?php echo $this->get_field_id( 'cspdy_owm_unit' ); ?>" name="<?php echo $this->get_field_name( 'cspdy_owm_unit' ); ?>">
        	<option value="metric" <?php if(esc_attr( $cspdy_owm_unit )=='metric') { echo "selected"; } ?>>Metric</option>
        	<option value="imperial" <?php if(esc_attr( $cspdy_owm_unit )=='imperial') { echo "selected"; } ?>>Imperial</option>
        </select>

    </p>
       
    <?php
// echo esc_attr( $owm_unit )."TEST";
	}

	// save options
	public function update( $new_instance, $old_instance ) {
		    $instance = $old_instance;
            $instance[ 'cspdy_owm_city' ] = strip_tags( $new_instance[ 'cspdy_owm_city' ] );
            $instance[ 'cspdy_owm_unit' ] = strip_tags( $new_instance[ 'cspdy_owm_unit' ] );
            //$instance[ 'owm_background' ] = strip_tags( $new_instance[ 'owm_background' ] );
            return $instance;
	}
}


add_action( 'admin_enqueue_scripts', 'cspdy_color_picker' );
function cspdy_color_picker( $hook ) {
 
    if( is_admin() ) { 
     
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}