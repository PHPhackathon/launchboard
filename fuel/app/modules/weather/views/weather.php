<!-- STYLE -->
<style>
    #module_weather { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
    #module_weather .heading { margin-bottom: 20px; }
    #module_weather strong { padding: 10px; font-size: 60px; text-align: center; display: block; line-height: 45px; }
    #module_weather strong span { font-size: 20px; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_weather' class='h_one w_one'>
    <span class="heading"><?php echo $location ?></span>
    <!-- <img src='<?php echo $weather['icon']?>' alt='' /><br /> -->
    <strong><?php echo $weather['temp']?>&deg;C<br /> <span><?php echo $weather['condition']?></span></strong>
    <!-- <?php echo $weather['humidity']?><br />
    <?php echo $weather['wind']?> -->
</div>
<!-- /CODE -->
