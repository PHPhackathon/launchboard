<!-- STYLE -->
<style>
    #module_twittermentions { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
    #module_twittermentions .tweet { display: block; overflow: hidden; height: 64px; padding: 4px 10px; }
    #module_twittermentions img { float: left; margin: 3px 10px 0 0; border: 1px solid #000; }
    #module_twittermentions .title { font-size: 18px; line-height: 18px; font-weight: bold; }
    #module_twittermentions .txt { margin-top: 5px; width: 85%; text-align: left; line-height: 18px; }
    #module_twittermentions .date { display: bloxk; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_twittermentions' class='h_two w_two'>
    <span class="heading">@<?php echo $mentions ?> mentions</span>
    <?php
    foreach($twittermentions as $tweet){
        echo "<div class='tweet clearfix'>";
            echo "<img src='".$tweet->profile_image_url."' alt='".$tweet->from_user."' />";
            echo "<span class='title'>@".$tweet->from_user.":</span>";
            echo " <span class='txt'>".$tweet->text."</span>";
        echo "</div>";
    }
    ?>
</div>
<!-- /CODE -->
