

         <style type="text/css">
                   #map_left_img,#map_right_img {
         	    		cursor: pointer; max-width: 100%;height: auto;
         	    	}

         	 <?php
         	    if (get_option('cspdy_current_weather_layout','map_left')=="map_left") { ?>
         	    	
         	    	#map_left_img {
         	    		border: solid 1px blue;
         	    	}

         	    	#map_right_img {
         	    		border: none;
         	    	}
         	    <?php } else { ?>

         	    	#map_right_img {
         	    		border: solid 1px blue;
         	    	}

         	    	#map_left_img {
         	    		border: none;
         	    	}
         	    	.shadbg {
         	    		background-color: #ccc;
         	    		border: solid 4px #ccc;
         	    	}


         	 <?php  } ?>

         </style>


         <tr valign="top" class="shadbg">
	        <th scope="row">Theme Color:</th>
	        <td><input type="" name="cspdy_theme_color" class="theme-color" value="<?php echo get_option('cspdy_theme_color','#ccc'); ?>"></td>
	     </tr>


         <tr valign="top">
	        <th scope="row">Font Color:</th>
	        <td><input type="" name="cspdy_font_color" class="font-color" value="<?php echo get_option('cspdy_font_color','#000'); ?>"></td>
	     </tr>


         <tr valign="top" class="shadbg">
	        <th scope="row">Secondary Color:</th>
	        <td><input type="" name="cspdy_sc_theme_color" class="sc-theme-color" value="<?php echo get_option('cspdy_sc_theme_color','none'); ?>"></td>
	     </tr>


         <tr valign="top">
	        <th scope="row">Secondary Font Color:</th>
	        <td><input type="" name="cspdy_sc_font_color" class="sc-font-color" value="<?php echo get_option('cspdy_sc_font_color','#000'); ?>"></td>
	     </tr>

         <tr valign="top" class="shadbg">
	        <th scope="row">Forecast Icon Color:</th>
	        <td><input type="" name="cspdy_fc_icon_color" class="fc_icon_color" value="<?php echo get_option('cspdy_fc_icon_color','#fff'); ?>"></td>
	     </tr>

         <tr valign="top">
	        <th scope="row">Forecast Icon Size:</th>
	        <td><input type="number" style="width: 65px" name="cspdy_fc_icon_size" class="fc_icon_size" value="<?php echo get_option('cspdy_fc_icon_size','18'); ?>"> px</td>
	     </tr>



         <tr valign="top" class="shadbg">
	        <th scope="row">Current weather data layout:</th>

	        <td>
	        	
	           <input style="display: none;" type="radio" name="cspdy_current_weather_layout" class="current_weather_layout" value="map_left" <?php if(get_option('cspdy_current_weather_layout','map_left') == 'map_left') {echo "checked";} ?>>

	           <img id="map_left_img" width="150px;" src="<?php echo plugin_dir_url( __FILE__ ) . '../imgs/map_left.png'; ?>">
	           <input style="display: none;" type="radio" name="cspdy_current_weather_layout" class="current_weather_layout" value="map_right" <?php if(get_option('cspdy_current_weather_layout','map_left') == 'map_right') {echo "checked";} ?>>

	           <img id="map_right_img" width="150px;" src="<?php echo plugin_dir_url( __FILE__ ) . '../imgs/map_right.png'; ?>">


	        
	        </td>
	     </tr>


<script type="text/javascript">

  (function( $ ) {

	   $("#map_right_img").click(function() {
           $(this).prev().prop("checked", true);
           $("#map_right_img").css('border','solid 1px blue');
           $("#map_left_img").css('border','none');
       });
       
	   $("#map_left_img").click(function() {
           $(this).prev().prop("checked", true);
           $("#map_left_img").css('border','solid 1px blue');
           $("#map_right_img").css('border','none');
       });


  })( jQuery );
</script>