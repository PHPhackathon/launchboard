<!-- STYLE -->
<style>
    #module_weather { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
    #module_weather .tweet { display: block; overflow: hidden; height: 64px; padding: 4px 10px; }
    #module_weather img { float: left; margin: 3px 10px 0 0; border: 1px solid #000; }
    #module_weather .title { font-size: 18px; line-height: 18px; font-weight: bold; }
    #module_weather .txt { margin-top: 5px; width: 85%; text-align: left; line-height: 18px; }
    #module_weather .date { display: bloxk; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_weather' class='h_two w_two'>
    <span class="heading">#<? echo $location ?></span>
     
    <table>
        <tr>
            <td>
                <img src='<?=$weather['icon']?>' alt='' />
            </td>
            <td>
                <strong><?=$weather['temp']?>&deg;C - <?=$weather['condition']?></strong><br />
                <?=$weather['humidity']?><br />
                <?=$weather['wind']?>
            </td>
        </tr>
</div>
<!-- /CODE -->
