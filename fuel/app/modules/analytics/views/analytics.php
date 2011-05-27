<!-- STYLE -->
<style>
</style>
<!-- /STYLE -->

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<!-- Highcharts --> 
<script src="/assets/js/highcharts.js"></script>

<script>

$(document).ready(function() {
    var analyticsChart = new Highcharts.Chart({
        chart: {
            renderTo: 'analytics_chart',
            defaultSeriesType: 'line'
        },
        legend: {
           enabled: false
        },
        title: {
           text: ''
        },
        xAxis: {
            categories: [],
                labels: {
                rotation: 280,
                align: 'right'
            }
        },
        yAxis: {
             allowDecimals: false,
             title: {
                text: ''
            }
        },
        series: [{
             data: []
        }]
    });
      
    $.getJSON( location.protocol + '//' + location.host + '/analytics/?site=martijnc.be', function(response) {

    });
      
});
</script>
<!-- /JS -->

<!-- CODE -->
<div id="module_analtyics" class="box h_one w_four">
    <select>
    <?php
        foreach($aUrls as $sUrl => $sTableId) {
    ?>
            <option id="<?=$sUrl?>"><?=$sUrl?></option>
    <?php
        } // end foreach
    ?>
    </select>
    <div id="analytics_chart">
        
    </div>
</div>
<!-- /CODE -->