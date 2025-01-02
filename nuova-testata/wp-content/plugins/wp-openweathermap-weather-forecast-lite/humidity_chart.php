
     <div class="humidityChart" style="text-align: center;">

          <h3>Humidity Chart (in %)</h3>
      
     <canvas id="humidityChart" style="width:100%; height:350px;"></canvas>

     
     <script>

document.addEventListener('DOMContentLoaded', function() {

var ctx = document.getElementById("humidityChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php
                for ($i=0; $i <= 6 ; $i++) { 
                    if ($fcObj->fcHumidity($i) != 0) {
                        echo '"';
                         echo gmdate("F d", $fcObj->fcdt($i));
                         echo '", ';
                       
                    }
                }
            ?>],
        datasets: [




        {
            label: 'Humidity',
            data: [<?php
            for ($i=0; $i <= 6 ; $i++) { 
                if ($fcObj->fcHumidity($i) != 0) {
                  echo $fcObj->fcHumidity($i).', ';
                }
              }
            ?>],
            backgroundColor: [
                '<?php echo get_option('cspdy_humidity_chart_bg'); ?>'
            ],
            borderColor: [
                '<?php echo get_option('cspdy_humidity_chart_border'); ?>'
            ],

            borderWidth: 1
        }

        ]
    },
    options: {
        

       scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Humidity(%)'
                        }
                    }]
                },

                tooltips: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: "<?php echo get_option('cspdy_humidity_chart_tooltip_bg','#685fad'); ?>",
                    displayColors: false,

                },

        elements: {
            line: {
                //tension: 0, // disables bezier curves
            }
        }
    }
});

}, false);
</script>
</div>
