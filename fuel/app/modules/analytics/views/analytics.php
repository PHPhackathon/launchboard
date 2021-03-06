<!-- STYLE -->
<style>
</style>
<!-- /STYLE -->

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<!-- Highcharts --> 
<script src="/assets/js/highcharts.js"></script>

<script>
var analyticsChart;

function updateAnalytics() {

    sUrl = $('#select_analytics').val();

    $.getJSON( location.protocol + '//' + location.host + '/analytics/?site=' + sUrl, function(response) {
         analyticsChart.series[0].setData(response.data, false);
         analyticsChart.xAxis[0].setCategories(response.cats);
    });
}


$(document).ready(function() {
    analyticsChart = new Highcharts.Chart({
        chart: {
            renderTo: 'analytics_chart',
            defaultSeriesType: 'line',
            backgroundColor: 'transparant',
            height: 175,
            width: 405
        },
        colors: [
            '#DB843D'
        ],
        legend: {
           enabled: false
        },
        title: {
           text: ''
        },
        xAxis: {
            categories: [],
            labels: {
                style: {
                    display: 'none'
                }
            }
        },
        yAxis: {
             allowDecimals: false,
             title: {
                text: ''
            },
            labels: {
                style: {
                    display: 'none'
                }
            }
        },
        series: [{
            name: 'Analytics',
            data: []
        }]
    });
    
    updateAnalytics();
    
    $('#select_analytics').change(updateAnalytics);
});
</script>
<!-- /JS -->

<!-- CODE -->
<div id="module_analytics" class="box h_one w_two">
    <select id="select_analytics">
    <?php
    //var_dump($aUrls);
        foreach($aUrls as $sUrl => $sTableId) {
    ?>
            <option value="<?php echo $sUrl; ?>"><?php echo $sUrl; ?></option>
    <?php
        } // end foreach
    ?>
    </select>
    <a href="/analytics?reset=true">Reset</a>
    <div id="analytics_chart">
        
    </div>
</div>
<!-- /CODE -->