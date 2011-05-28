<!-- STYLE -->
<style>
    #module_twitterhash { display: table-cell; vertical-align: middle; font-size:100%; background: red; height: 410px; width: 410px; line-height: 100%;}
    #module_twitterhash .tweet { display: block; overflow: hidden; height: 84px;}
    #module_twitterhash img { float: left; margin-bottom: 5px; margin-right: 5px; }
    #module_twitterhash .title { display: block; float:left; font-size: 18px;  font-weight: bold; }
    #module_twitterhash .txt { display: block; float:left;  margin-top: 5px; width: 85%;}
    #module_twitterhash .date { display: bloxk;}
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_twitterhash' class='h.two w_one'>
    <?php
    foreach($twitterhash as $tweet){
        echo "<div class='tweet'>";
            echo "<img src='".$tweet->profile_image_url."' alt='".$tweet->from_user."' />";
            echo "<span class='title'>@".$tweet->from_user."</span>";
            echo "<span class='txt'>".$tweet->text."</span>";
        echo "</div>";
    }
    ?>
</div>
<!-- /CODE -->
