

	     <tr valign="top" class="owm_heading">
	        <th>
              <strong style="font-size: 1.6em;">Chart settings:</strong>
            </th>
            <th></th>
         </tr>


	     <tr valign="top" class="owm_heading">
	        <th>
              <strong style="font-size: 1.3em;">Temperature chart:</strong>
            </th>
            <th></th>
         </tr>



	     <tr valign="top">
	        <th scope="row">Display maximum and minimum tempertature forecast chart:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	      <td>
	          <input style="cursor: not-allowed;" type="checkbox" name="cspdy_display_temp_chart" value="checked" disabled>
	      </td>
	    </tr>


         <tr valign="top" class="shadbg" style="cursor: not-allowed;">
	        <th scope="row">Maximum temp chart background:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	        <td><input class="max-temp-chart-bg" data-alpha="true" data-default-color="rgba(244, 67, 54, 0.1)" type="" name="cspdy_max_temp_chart_bg" value="<?php echo get_option('cspdy_max_temp_chart_bg','rgba(244, 67, 54, 0.1)'); ?>"></td>
	     </tr>

         <tr valign="top" style="cursor: not-allowed;">
	        <th scope="row">Maximum temp chart border:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	        <td><input class="max-temp-chart-border" data-alpha="true" data-default-color="rgba(244, 67, 54, 0.9)" type="" name="cspdy_max_temp_chart_border" value="<?php echo get_option('cspdy_max_temp_chart_border','rgba(244, 67, 54, 0.9)'); ?>"></td>
	     </tr>

         <tr valign="top" class="shadbg" style="cursor: not-allowed;">
	        <th scope="row">Minimum temp chart background:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	        <td><input class="min-temp-chart-bg" data-alpha="true" data-default-color="rgba(60,141,188,0.7)" type="" name="cspdy_min_temp_chart_bg" value="<?php echo get_option('cspdy_min_temp_chart_bg','rgba(60,141,188,0.7)'); ?>"></td>
	     </tr>

         <tr valign="top" style="cursor: not-allowed;">
	        <th scope="row">Minimum temp chart border:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	        <td><input class="min-temp-chart-border" data-alpha="true" data-default-color="rgba(60,141,188,0.9)" type="" name="cspdy_min_temp_chart_border" value="<?php echo get_option('cspdy_min_temp_chart_border','rgba(60,141,188,0.9)'); ?>"></td>
	     </tr>

         <tr valign="top" class="shadbg" style="cursor: not-allowed;">
	        <th scope="row">Temperature chart tooltips background:<br>
	             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
	        </th>
	        <td><input class="temp_chart_tooltip_bg" type="" name="cspdy_temp_chart_tooltip_bg" value="<?php echo get_option('cspdy_temp_chart_tooltip_bg','#685fad'); ?>"></td>
	     </tr>



	     <tr valign="top" class="owm_heading">
	        <th>
              <strong style="font-size: 1.3em;">Humidity chart:</strong>
            </th>
            <th></th>
         </tr>

	     <tr valign="top">
	        <th scope="row">Display humidity forecast chart:</th>
	      <td>
	          <input type="checkbox" name="cspdy_display_humidity_chart" value="checked" <?php echo get_option('cspdy_display_humidity_chart','checked'); ?>>
	      </td>
	    </tr>


         <tr valign="top" class="shadbg">
	        <th scope="row">Humidity chart background:</th>
	        <td><input class="humidity-chart-bg" data-alpha="true" data-default-color="rgba(60,141,188,0.2)" type="" name="cspdy_humidity_chart_bg" value="<?php echo get_option('cspdy_humidity_chart_bg','rgba(60,141,188,0.2)'); ?>"></td>
	     </tr>

         <tr valign="top">
	        <th scope="row">Humidity chart border:</th>
	        <td><input class="humidity-chart-border" data-alpha="true" data-default-color="rgba(60,141,188,0.9)" type="" name="cspdy_humidity_chart_border" value="<?php echo get_option('cspdy_humidity_chart_border','rgba(60,141,188,0.9)'); ?>"></td>
	     </tr>


         <tr valign="top">
	        <th scope="row">Humidity chart tooltips background:</th>
	        <td><input class="humidity_chart_tooltip_bg" type="" name="cspdy_humidity_chart_tooltip_bg" value="<?php echo get_option('cspdy_humidity_chart_tooltip_bg','#685fad'); ?>"></td>
	     </tr>


	     <tr valign="top" class="owm_heading">
	        <th>
              <strong style="font-size: 1.3em;">Pressure chart:</strong>
            </th>
            <th></th>
         </tr>

	     <tr valign="top">
	        <th scope="row">Display pressure forecast chart:</th>
	      <td>
	          <input type="checkbox" name="cspdy_display_pressure_chart" value="checked" <?php echo get_option('cspdy_display_pressure_chart','checked'); ?>>
	      </td>
	    </tr>

         <tr valign="top" class="shadbg">
	        <th scope="row">Pressure chart background:</th>
	        <td><input class="pressure-chart-bg" data-alpha="true" data-default-color="rgba(60,141,188,0.2)" type="" name="cspdy_pressure_chart_bg" value="<?php echo get_option('cspdy_pressure_chart_bg','rgba(60,141,188,0.2)'); ?>"></td>
	     </tr>

         <tr valign="top">
	        <th scope="row">Pressure chart border:</th>
	        <td><input class="pressure-chart-border" data-alpha="true" data-default-color="rgba(60,141,188,0.9)" type="" name="cspdy_pressure_chart_border" value="<?php echo get_option('cspdy_pressure_chart_border','rgba(60,141,188,0.9)'); ?>"></td>
	     </tr>

         <tr valign="top">
	        <th scope="row">Pressure chart tooltips background:</th>
	        <td><input class="pressure_chart_tooltip_bg" type="" name="cspdy_pressure_chart_tooltip_bg" value="<?php echo get_option('cspdy_pressure_chart_tooltip_bg','#685fad'); ?>"></td>
	     </tr>
