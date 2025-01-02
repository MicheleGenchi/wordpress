
         <tr valign="top" class="owm_heading">
          <th scope="row" style="font-size: 1.6em;">OpenWeatherMap Configure </th>
          <td></td>
         </tr>

         <tr valign="top">
	        <th scope="row">OpenWeatherMap API Key: </th>
	        <td><input type="text" name="cspdy_owm_api_key" class="form-control" value="<?php echo get_option('cspdy_owm_api_key'); ?>"></td>
         </tr>


         <tr valign="top" class="shadbg">
          <th scope="row">Display Map: (Radar map enable for North America) </th>
          <td><input type="checkbox" name="cspdy_map_enabled" id="map_enabled" class="form-control" value="map_enabled" <?php if(get_option('cspdy_map_enabled')=="map_enabled") {echo "checked";} ?>>
          </td>
         </tr>

	     
         <tr valign="top" id="bing_credential_tbl">
	        <th scope="row">Bing Map Credential: </th>
	        <td><input type="text" name="cspdy_bing_credential" class="form-control" value="<?php echo get_option('cspdy_bing_credential'); ?>"></td>
         </tr>



       <tr valign="top" class="shadbg">
          <th scope="row">Detect Location to show users weather data:<br/>
             <span style="color: red;">Detect location is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
          </th>
          <td>
              <input style="cursor: not-allowed;" type="checkbox" name="cspdy_detect_location" id="detect_location" value="checked" disabled>
          </td>
       </tr>

         <tr valign="top" id="ipinfodb_api">
          <th scope="row">IPInfoDB API Key (Need it to detect user location): </th>
          <td><input type="text" name="cspdy_ipinfodb_api" class="form-control" value="<?php echo get_option('cspdy_ipinfodb_api'); ?>"></td>
         </tr>

         <tr valign="top" id="default_city">
          <th scope="row">Default City (If city not provided, it will be used): </th>
          <td><input id="city" type="text" name="cspdy_default_city" class="form-control" value="<?php echo get_option('cspdy_default_city'); ?>"></td>
         </tr>

         <?php 
            //include '../place_autocomplete.php'; 
            //include( plugin_dir_path( __FILE__ ) . '../place_autocomplete.php');
         ?>



         <tr valign="top" id="default_unit" class="shadbg">
          <th scope="row">Default unit: </th>
          <td>
             <select name="cspdy_default_unit" class="form-control">
               <option value="metric" <?php if(get_option('cspdy_default_unit','metric')=="metric") {echo "selected";} ?>>Metric</option>
               <option value="imperial" <?php if(get_option('cspdy_default_unit','metric')=="imperial") {echo "selected";} ?>>Imperial</option>
             </select>
             <?php echo get_option('cspdy_default_unit','metric'); ?>
          </td>
         </tr>


         <tr valign="top">
          <th scope="row">Let users change unit<br/>
           <small>(The chosen unit will be saved in user browser's cookie and it will replace the default of your options panel. Below is the image to give you idea.)</small>
           <br/>
           <span style="color: red;">Unit change option is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
           <br/>
           <img  src="<?php echo plugin_dir_url( __FILE__ ) . '../imgs/choose_unit.JPG'; ?>">
           </th>

          <td><input style="cursor: not-allowed;" type="checkbox" name="cspdy_choose_unit" id="choose_unit" class="form-control" value="checked" disabled>

          </td>
         </tr>



         <tr valign="top" class="shadbg">
          <th scope="row">Enable Google autocomplete place for search city field <br/>
             <span style="color: red;">Google place autocomplete is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
          <img  src="<?php echo plugin_dir_url( __FILE__ ) . '../imgs/location_autocomplete.JPG'; ?>">

          </th>
          <td>Check to enable Google Autocomplete<br/>
             <input style="cursor: not-allowed;" type="checkbox" name="cspdy_place_autocomplete" id="place_autocomplete" class="form-control" value="checked" disabled>
          </td>
         </tr>


         <tr valign="top">
          <th scope="row">Give users ability to save searched location<br/>
             <span style="color: red;">This feature is available for <a href="https://gum.co/wordpress-weather-forecast-openweathermap-plugin">pro version</a>.</span>
             </th><br>
          <td>
             <input style="cursor: not-allowed;" type="checkbox" name="cspdy_enable_save_city" id="enable_save_city" class="form-control" value="checked" disabled>
          </td>
         </tr>
