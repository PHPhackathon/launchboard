<!-- STYLE -->
<style>
    #module_calendar { font-size:100%; line-height: 100%; text-align: left; line-height: 18px; }
    #module_calendar .title { font-weight: bold; display: block; margin: 10px 0 0 10px; }
    #module_calendar .summary { padding-left: 10px; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_calendar' class='h_one w_one'>
    <span class="heading">Calendar</span>
    <?php
    foreach($events as $event){ 
        echo "<div class='event'>";
        echo "<div class='title'>".$event['title']."</div>";
        echo "<div class='summary'>".str_replace('2011 ', '2011<br />', $event['summary'])."</div>";
        echo "</div>";
    }
    ?>
</div>
<!-- /CODE -->
