
             <span style="font-size: 12px;padding: 6px;">Updated: <span style="float: right;padding-right: 6px;"><?php echo $currentObjowm->dt(); ?> (UTC)</span></span>
             <p class="bgenable" style="padding: 6px;">
               <i style="font-size: 20px; vertical-align: middle;" class="wi wi-thermometer"></i> <span style="font-size: 22px;"> <?php echo round($temperature,1).$currentObjowm->temp_unit(); ?></span>
                <span style="float: right;font-size: 14px;">
                    <?php echo $conditionDes; ?>
                    <i style="font-size: 1em; vertical-align: middle;" class="wi <?php echo $icon_obj->icon($currentObjowm->icon()); ?>"></i>
                </span>
               <span style="font-size: 12px;display: block;">== Feels Like: <?php echo $currentObjowm->feels_like_temp().$currentObjowm->temp_unit(); ?></span>
             </p>
             <p>
                 

                 <span class="current_item bgenable"><i style="vertical-align: middle;" class="wi wi-humidity"></i> Humidity: <span class="current_itm_value"><?php echo $humidity; ?>%</span></span>

                 <span class="current_item"><i style="vertical-align: middle;" class="wi wi-barometer"></i> Pressure: <span class="current_itm_value"><?php echo $pressure; ?> hPa</span></span>

                 <span class="current_item bgenable"><i style="vertical-align: middle;" class="wi wi-strong-wind"></i> Wind Speed: <span class="current_itm_value"><?php echo $windSpeed." ".$currentObjowm->wind_speed_unit(); ?></span></span>

                 <span class="current_item"><i style="vertical-align: middle;" class="wi wi-direction-up"></i> Wind Direction: <span class="current_itm_value"><?php echo $windDeg; ?> °</span></span>

                 <span class="current_item bgenable"><i style="vertical-align: middle;" class="wi wi-alien"></i> Visibility: <span class="current_itm_value"><?php echo $visibility; ?></span></span>

                 <span class="current_item"><i style="vertical-align: middle;" class="wi wi-sunrise"></i> Sunrise: <span class="current_itm_value"><?php echo $sunriseLocal; ?> (UTC)</span></span>

                 <span class="current_item bgenable"><i style="vertical-align: middle;" class="wi wi-sunset"></i> Sunset: <span class="current_itm_value"><?php echo $sunsetLocal; ?> (UTC)</span></span>
                 
                 <span class="current_item">Lattitude: <?php echo $currentObjowm->getLat(); ?>"" <span class="current_itm_value">Longitude: <?php echo $currentObjowm->getLon(); ?>""</span></span>

             </p>
          
