
     <div class="pressureChart" style="text-align: center;">

          <h3>7 Days Pressure Chart</h3>
      

     <canvas id="pressureChart" style="width:100%; height:350px;"></canvas>
     <script>

document.addEventListener('DOMContentLoaded', function() {
    
var ctx = document.getElementById("pressureChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            <?php
             for ($i=0; $i <= 6 ; $i++) { ?>
                   '<?php echo gmdate("F d", $fcObj->fcdt($i)); ?>',
              <?php }
            ?>
            ],
        datasets: [



        {
            label: 'Pressure (in hPa)',
            data: [
            <?php
            for ($i=0; $i <= 6 ; $i++) { 
                  echo $fcObj->fcPressure($i).', ';
              }
            ?>
            ],
            backgroundColor: [
                '<?php echo get_option('cspdy_pressure_chart_bg'); ?>'
            ],
            borderColor: [
                '<?php echo get_option('cspdy_pressure_chart_border'); ?>'
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
                            labelString: 'Pressure (hPa)'
                        }
                    }]
                },

                tooltips: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: "<?php echo get_option('cspdy_pressure_chart_tooltip_bg','#685fad'); ?>",
                    displayColors: false
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
