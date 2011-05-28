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
    <a href="/analytics?reset=true">Reset</a>
    <div id="analytics_chart">
        
    </div>
</div>
