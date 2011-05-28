<!-- STYLE -->
<style>
    #module_rss { position:relative; display: block; font-size:100%; overflow: hidden; }
    #module_rss .rssBox {padding: 10px; position: absolute; top:40px; left:0; display: block; height: 100px;}
    #module_rss .show {display: block;}
    #module_rss .title { font-size: 24px; line-height: 28px; font-weight: bold;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_rss' class='h_one w_two'>
    <span class="heading">RSS <?php echo $rssTitel; ?></span>
    <?php
    echo "<div class='rssBox clearfix'>";
        echo "<strong class='title'>".$rss['title']."</strong><br /><i>" . $rss['date'] . '</i>';
    echo "</div>";
    ?>
</div>
<!-- /CODE -->
