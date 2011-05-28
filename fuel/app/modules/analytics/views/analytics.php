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

function reload() {
    window.location.reload();
}

setTimeout(reload, 120000);

$(document).ready(function() {
    analyticsChart = new Highcharts.Chart({
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
<div id="module_analytics" class="box h_one w_four">
    <select id="select_analytics">
    <?php
    var_dump($aUrls);
        foreach($aUrls as $sUrl => $sTableId) {
    ?>
            <option value="<?php echo $sUrl; ?>"><?php echo $sUrl; ?></option>
    <?php
        } // end foreach
    ?>
    </select>
    <a href="/?reset=true">Reset</a>
    <div id="analytics_chart">
        
    </div>
</div>
<!-- /CODE -->