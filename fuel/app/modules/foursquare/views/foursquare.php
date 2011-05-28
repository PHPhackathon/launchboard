<!-- STYLE -->
<style>
    #module_foursquare { position:relative; display: block; font-size:100%; overflow: hidden; height: 200px; width: 200px; background: red; text-align: center; }
    #module_foursquare .mayor { font-size:20px;  }
    #module_foursquare .checkins { margin-bottom: 10px;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_foursquare' class='h_one w_one'>
    <div class='header'>Mayor at <?php echo $title; ?></div>
    <img src="<?php echo $avatar; ?>" alt="<?php echo $name; ?>" />
    <div class='mayor'><?php echo $name; ?></div>
    <div class='checkins'>with <?php echo $checkins; ?></div>
</div>
<!-- /CODE -->
