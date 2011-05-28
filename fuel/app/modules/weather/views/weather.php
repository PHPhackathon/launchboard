<!-- STYLE -->
<style>
    #module_weather { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_weather' class='h_one w_one'>
    <span class="heading"><?php echo $location ?></span>
     
    <table>
        <tr>
            <td valign="middle">
                <img src='<?php echo $weather['icon']?>' alt='' />
            </td>
            <td valign="top">
                <strong><?php echo $weather['temp']?>&deg;C - <?php echo $weather['condition']?></strong><br />
                <?php echo $weather['humidity']?><br />
                <?php echo $weather['wind']?>
            </td>
        </tr>
    </table>
</div>
<!-- /CODE -->
