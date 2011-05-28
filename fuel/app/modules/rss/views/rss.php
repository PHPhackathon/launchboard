<!-- STYLE -->
<style>
    #module_rss { position:relative; display: block; font-size:100%; overflow: hidden; }
    #module_rss .rss {padding: 5px; position: absolute; top:40px; left:0; display: none; height: 100px;}
    #module_rss .title { font-size: 24px; line-height: 28px; font-weight: bold;  }
    #module_rss .title a {color:#fff; text-decoration: none;}
    #module_rss .title a:hover{color:#ff0000;}
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_rss' class='h_one w_two'>
    <span class="heading">RSS <?php echo $rssTitel; ?></span>
    <?php
    $i=0;
    foreach($rss as $item){
        echo "<div class='rss clearfix' id='rss_".$i."'>";
            echo "<strong class='title'><a href='".$item['link']."'>".$item['title']."</a></strong><br /><i>" . $item['date'] . '</i>';
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
    var totalRss = $('.rss').size();
    gotoRss(0, 1);
    sliderIntervalRss = setInterval(function(){
        var nextRss = curRss == totalRss ? 0 : curRss+1;
        
        console.log(curRss,nextRss);
        
        gotoRss(curRss, nextRss);
        curRss = nextRss;
    }, 5000);
});
function gotoRss(cur, next){
    $('#rss_'+cur).fadeOut();
    $('#rss_'+next).fadeIn();
}
</script>
<!-- /JS -->
