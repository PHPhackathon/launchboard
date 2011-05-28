<!-- STYLE -->
<style>
    #module_rss { position:relative; display: block; font-size:100%; overflow: hidden; }
    #module_rss .rssBox {padding: 5px; position: absolute; top:40px; left:0; display: none; height: 100px;}
    #module_rss .show {display: block;}
    #module_rss .title { font-size: 24px; line-height: 28px; font-weight: bold;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_rss' class='h_one w_two'>
    <span class="heading">RSS <?php echo $rssTitel; ?></span>
    <?php
    $i=1;
    foreach($rss as $item){
        echo "<div class='rssBox clearfix' id='rssBox_".$i."'>";
            echo "<strong class='title'>".$item['title']."</strong><br /><i>" . $item['date'] . '</i>';
        echo "</div>";
        $i++;
    }
    ?>
</div>
<!-- /CODE -->

<!-- JS -->
<script>
$(document).ready(function() {
    var curRss = 0;
    var nextRss = 0;
    var totalRss = $('.rssBox').size();
    var sliderIntervalRss = setInterval(function(){
        console.log(curRss, nextRss);
        $('#rssBox_'+curRss).fadeOut();
        $('#rssBox_'+nextRss).fadeIn();
        curRss = (curRss == totalRss ? 0 : curRss+1);
        nextRss = curRss+1;
    }, 1500);
});
</script>
<!-- /JS -->
