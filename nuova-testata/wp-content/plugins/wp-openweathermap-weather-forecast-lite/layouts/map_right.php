



<div class="owm-left-30" style="margin-bottom: 22px;">
             <!-- <span class="bgenable" style="font-size: 18px;padding: 6px;text-align: center;display: block;">Current weather stats</span> -->

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
          </div>







          <div class="owm-right-70" style="margin-bottom: 22px;">
             


<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
<script type='text/javascript'>
    var map, animatedLayer;

    //Weather tile url from Iowa Environmental Mesonet (IEM): http://mesonet.agron.iastate.edu/ogc/
    var urlTemplate = 'https://mesonet.agron.iastate.edu/cache/tile.py/1.0.0/nexrad-n0q-{timestamp}/{zoom}/{x}/{y}.png';

    //The time stamps values for the IEM service for the last 50 minutes broken up into 5 minute increments.
    var timestamps = ['900913-m50m', '900913-m45m', '900913-m40m', '900913-m35m', '900913-m30m', '900913-m25m', '900913-m20m', '900913-m15m', '900913-m10m', '900913-m05m', '900913'];

    function GetMap()
    {
        map = new Microsoft.Maps.Map('#myMap', {
            credentials: 'AkIKyiomsfKf-PJpajdHADHpU-qxZKTDis8_l233Puzf8mZr4_MPf4VgSTGB9IGC',
            center: new Microsoft.Maps.Location(<?php echo $lattitude; ?>, <?php echo $longitude; ?>),
            mapTypeId: Microsoft.Maps.MapTypeId.aerial,         
            zoom: 6
        });
        
        var tileSources = [];

        //Create a tile source for each time stamp.
        for (var i = 0; i < timestamps.length; i++) {
            var tileSource = new Microsoft.Maps.TileSource({
                uriConstructor: urlTemplate.replace('{timestamp}', timestamps[i])
            });
            tileSources.push(tileSource);
        }

        //Create the animated tile layer and add it to the map.
        animatedLayer = new Microsoft.Maps.AnimatedTileLayer({
            mercator: tileSources,
            frameRate: 500
        });
           map.layers.insert(animatedLayer);


        var pushpin = new Microsoft.Maps.Pushpin(map.getCenter(), { color: '#6de3ef', title: '<?php echo $city; ?>' });
map.entities.push(pushpin);

         }
     </script>
<div id="myMap"></div>





          </div>


