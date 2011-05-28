<!-- STYLE -->
<style>
    #module_flickr { position:relative; display: block; font-size:100%; overflow: hidden; }
    #module_flickr img { position: absolute; top:0; left:0; display: none; height: 200px;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_flickr' class='h_one w_one'>
    <?php
    $counter = 1;
    foreach($photos as $photo){
        echo "<img class='flickr' src='".$photo['url']."' alt='' id='photo".$counter++."' />\n";
    }
    ?>
</div>
<!-- /CODE -->

<!-- JS -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script>
$(document).ready(function() {
    var curPhoto = 1;
    var totalPhotos = $('img.flickr').size();
    gotoPhoto(0, 1);
    sliderInterval = setInterval(function(){
        var nextPhoto = curPhoto == totalPhotos ? 1 : curPhoto+1;
        gotoPhoto(curPhoto, nextPhoto);
        curPhoto = nextPhoto;
    }, 5000);
});
function gotoPhoto(cur, next){
    $('#photo'+cur).fadeOut();
    $('#photo'+next).fadeIn();
}
</script>
<!-- /JS -->