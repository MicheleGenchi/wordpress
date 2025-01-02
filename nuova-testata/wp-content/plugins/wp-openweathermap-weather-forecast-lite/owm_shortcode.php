<?php


function cspdy_owm_shortcode_style() {
    wp_register_style( 'cspdy-weather-icons',  plugin_dir_url( __FILE__ ) . 'css/weather-icons.min.css', array(), null, 'all' );
    wp_register_script( 'cspdy-owm-chartjs',  plugin_dir_url( __FILE__ ) . 'js/Chart.min.js', array(), null, 'all' );
    //wp_register_style( 'cspdy-owm-main',  plugin_dir_url( __FILE__ ) . 'css/main.css', array(), null, 'all' );
    //wp_enqueue_style( 'cspdy-owm-main' );
}
add_action( 'wp_enqueue_scripts', 'cspdy_owm_shortcode_style' );



function cdspdy_inline_style() {
    wp_register_style(
        'cdspdy-owm-custom-style',
        plugin_dir_url( __FILE__ ) . 'css/main.css'
    );
        //$color = get_theme_mod( 'my-custom-color' ); 
        $custom_css = "
               .bgenable, .fc_item {
                 background-color: ".get_option('cspdy_theme_color','#ccc').";
                 color: ".get_option('cspdy_font_color','#000').";
               }

               .owm-left-30, .owm-right-70, .owm-right-30, .owm-left-70 {
                 background-color: ".get_option('cspdy_sc_theme_color','none').";
                 color: ".get_option('cspdy_sc_font_color','#000').";
               }

               .tempChart, .humidityChart, .pressureChart {
                 border: solid 1px ".get_option('cspdy_sc_theme_color','none').";
               }

               .forecast_container i {
                 font-size: ".get_option('cspdy_fc_icon_size','18')."px; vertical-align: middle; margin-top: 6px;
                 color: ".get_option('cspdy_fc_icon_color').";
               }
                ";
        wp_add_inline_style( 'cdspdy-owm-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'cdspdy_inline_style' );


function cspdy_owm_shortcode( $atts ) {

  wp_enqueue_style( 'cdspdy-owm-custom-style' );
  wp_enqueue_style( 'cspdy-weather-icons' );
  wp_enqueue_script( 'cspdy-owm-chartjs' );

  if (get_option('cspdy_owm_api_key') == "") {
     echo "<h3>OpenWeatherMap API Key is Not Provided</h3>"; exit();
  }

   if (isset($_GET['city'])) {
      $city = $_GET['city'];
   } else {
      $city = get_option('cspdy_default_city');
   }


        if (isset($_GET['unit'])) {
            $unit = $_GET['unit'];
        } else {
            $unit = get_option('cspdy_default_unit','metric');
        }
           
       
    $a = shortcode_atts( array(
        'city' => $city,
        'unit' => $unit,
    ), $atts );


    if (isset($_GET['city'])) {
    	  $currentObjowm = new CurrentClass(get_option('cspdy_owm_api_key'), $_GET['city'], "{$a['unit']}");
        $fcObj = new Forecast(get_option('cspdy_owm_api_key'), $_GET['city'], "{$a['unit']}");
    } else {
        $currentObjowm = new CurrentClass(get_option('cspdy_owm_api_key'), "{$a['city']}", "{$a['unit']}");
        $fcObj = new Forecast(get_option('cspdy_owm_api_key'), "{$a['city']}", "{$a['unit']}");
    }


        $city = $currentObjowm->getCity();
        $country = $currentObjowm->getCountry();
        $temperature = $currentObjowm->temp();
        $conditionDes = $currentObjowm->conditionDes();
        $conditionMain = $currentObjowm->conditionDes();
        $pressure = $currentObjowm->pressure();
        $visibility = $currentObjowm->visibility();
        $humidity = $currentObjowm->humidity();

        $windSpeed = $currentObjowm->windSpeed();
        $windDeg = $currentObjowm->windDeg();
        $clouds = $currentObjowm->clouds();
        $dt = $currentObjowm->dt();
        $sunrise = $currentObjowm->sunrise();
        $sunriseLocal = $currentObjowm->sunriseLocal();
        $sunset = $currentObjowm->sunset();
        $sunsetLocal = $currentObjowm->sunsetLocal();
        $lattitude = $currentObjowm->getLat();
        $longitude = $currentObjowm->getLon();
        $icon_obj = new Weather_icon();
       ?>


<div class="owm_header" style="margin-bottom: 8px;padding: 4px;">
        <form class="search_owm_city">
            <input type="text" id="city" name="city" placeholder="Enter city name...">
            <input type="submit" value="Search">
        </form>


        <?php
          if (get_option('cspdy_choose_unit')=="checked") {
            
                  if ($unit=='imperial') { ?>
            
                       <form class="change_owm_unit">
                          <input type="hidden" name="unit" value="metric">
                          <input type="submit" value="°C">
                       </form>

                 <?php } else { ?>

                        <form class="change_owm_unit">
                           <input type="hidden" name="unit" value="imperial">
                           <input type="submit" value="°F">
                        </form>

                <?php }
          }

        ?>
  

    <?php
    if ($city == "Location not found") {
        echo "<h3>Location not found</h3>";
    } else { 
        include 'country_arr.php';
        // echo "<pre>"; print_r($countryArray['IN']['name']); echo "</pre>";
        ?>
        <strong style="float: right;font-size: 18px;"><?php echo $city.", ".$countryArray[$country]['name']; ?></strong>

</div>

        <div id="loadweather">
        
        <?php 

           if(get_option('cspdy_map_enabled') == 'map_enabled') {

              if(get_option('cspdy_current_weather_layout','map_left') == 'map_left') {
                      include 'layouts/map_left.php';
              }

              else if(get_option('cspdy_current_weather_layout','map_left') == 'map_right') {
                     include 'layouts/map_right.php';
              } else {
                    include 'layouts/map_left.php';
              }
           } else {
                 include 'layouts/map_disabled.php';
           }
        ?>


       <div class="forecast_container" style="text-align: center;">

          <h3>7 Days Weather Forecast</h3>

          <div class="forecast_container group">
          <?php
            for ($i=0; $i <= 6 ; $i++) { ?>
                
              <div class="fc_item span_1_of_7">

              <span class="fc_data" style="font-size: 1.1em;"><?php echo gmdate("l", $fcObj->fcdt($i)); ?></span>
              <span class="fc_data" style="border-bottom: solid 1px #777;margin-bottom: 6px;"><?php echo gmdate("F d", $fcObj->fcdt($i)); ?></span>

                  <i class="wi <?php echo $icon_obj->icon($fcObj->fcIcon($i)); ?>"></i>
                 <div style="border-bottom: solid 1px #777;height: 30px;">
                  <?php
                  //if (strlen($fcObj->fcConditionDes($i)) > 17) { ?>
                     <span class="fc_data" style="font-size: 11px; margin-top: 11px;line-height: 12px;"><?php echo $fcObj->fcConditionDes($i); ?></span>
                 <?php /* } else { ?>
                     <span class="fc_data" style="font-size: 1em;"><?php echo $fcObj->fcConditionDes($i); ?></span>
                 <?php }*/
                   ?>

                   </div>


                  <span class="fc_data">Max Temp <span class="fc_value"><?php echo $fcObj->maxTemp($i); ?> °C</span></span>

                  <span class="fc_data">Min Temp <span class="fc_value"><?php echo $fcObj->minTemp($i); ?> °C</span></span>

                  <span class="fc_data">Humidity <span class="fc_value"><?php echo $fcObj->fcHumiditywithP($i); ?></span></span>

                  <span class="fc_data">Pressure <span class="fc_value" style="font-size: 12px;"><?php echo $fcObj->fcPressure($i); ?> hPa</span></span>

                  <span class="fc_data">Wind speed <span class="fc_value" style="font-size: 12px;"><?php echo $fcObj->fcWindSpeed($i)." ".$fcObj->fcWindSpeedUnit($i); ?></span></span>

                  <span class="fc_data">Pressure <span class="fc_value" style="font-size: 12px;"><?php echo $fcObj->fcPressure($i); ?> hPa</span></span>

              </div>

           <?php }
          ?>
          </div>

       </div>



     <div class="owm_charts">

     <!-- <script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . 'js/Chart.min.js' ?>""></script> -->
     <hr>

      <?php
        
        if (get_option('cspdy_display_humidity_chart','checked') == 'checked') {
           include 'humidity_chart.php';
        }

        if (get_option('cspdy_display_pressure_chart','checked') == 'checked') {
            include 'pressure_chart.php';
        }

        //echo get_option('display_pressure_chart','checked'); echo "TEST";
      ?>

     </div>



        </div>
       <?php
   }

}
add_shortcode( 'cspdy_owm_shortcode_content', 'cspdy_owm_shortcode' );


?>