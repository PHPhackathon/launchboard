<!-- STYLE -->
<style>
    #module_gowalla { position:relative; display: block; font-size:100%; overflow: hidden; }
    #module_gowalla .checkin { margin-bottom: 10px;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_gowalla' class='h_one w_one'>
    <div class='header'><?php echo $title; ?></div>
    <?php
    foreach($checkins as $checkin){
        echo "<div class='checkin'>";
            echo "<div class='title'>".$checkin['user']."</div>";
            echo "<div class='time'>".date('d/m/Y H:i:s',$checkin['time'])."</div>";
        echo "</div>";
    }
    ?>
</div>
<!-- /CODE -->
