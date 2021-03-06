<!-- STYLE -->
<style>
    #module_twitterlist { display: table-cell; font-size:100%; line-height: 100%; text-align: left; }
    #module_twitterlist .tweet { display: block; overflow: hidden; height: 64px; padding: 4px 10px; }
    #module_twitterlist img { float: left; margin: 3px 10px 0 0; border: 1px solid #000; }
    #module_twitterlist .title { font-size: 18px; line-height: 18px; font-weight: bold; }
    #module_twitterlist .txt { margin-top: 5px; width: 85%; text-align: left; line-height: 18px; }
    #module_twitterlist .date { display: bloxk; }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_twitterlist' class='h_two w_two'>
    <span class="heading">list <?php echo $list ?></span>
    <?php
    $i=0;
    foreach($twitterlist as $tweet){
        if($i > 4) continue;
        $i++;
        echo "<div class='tweet clearfix'>";
            echo "<img src='".$tweet->user->profile_image_url."' alt='".$tweet->user->screen_name."' />";
            echo "<span class='title'>@".$tweet->user->screen_name.":</span>";
            echo " <span class='txt'>".$tweet->text."</span>";
        echo "</div>";
    }
    ?>
</div>
<!-- /CODE -->
