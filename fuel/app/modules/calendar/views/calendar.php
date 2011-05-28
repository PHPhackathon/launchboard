<!-- STYLE -->
<style>
    #module_calendar { display: table-cell; font-size:100%; line-height: 100%; width: 200px; height: 200px; text-align: left; background: red; }
    #module_calendar .title { font-weight: bold;}
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_calendar' class='h_two w_one'>
    <span class="heading">Calendar <?php echo $title; ?></span>
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
