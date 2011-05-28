<!-- STYLE -->
<style>
    #module_weather { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_weather' class='h_one w_one'>
    <span class="heading"><? echo $location ?></span>
     
    <table>
        <tr>
            <td valign="middle">
                <img src='<?=$weather['icon']?>' alt='' />
            </td>
            <td valign="top">
                <strong><?=$weather['temp']?>&deg;C - <?=$weather['condition']?></strong><br />
                <?=$weather['humidity']?><br />
                <?=$weather['wind']?>
            </td>
        </tr>
    </table>
</div>
<!-- /CODE -->
