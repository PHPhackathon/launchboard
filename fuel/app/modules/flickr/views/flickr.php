<!-- STYLE -->
<style>
    #module_flickr { position:relative; display: block;  font-size:100%; background: red; height: 200px; width: 200px; overflow: hidden; }
    #module_flickr img { position: absolute; top:0; left:0;  }
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_flickr' class='h.one w_one'>
    <?php
    $counter = 0;
    foreach($photos as $photo){
        echo "<img src='".$photo['url']."' alt='' id='photo".$counter++."' />\n";
    }
    ?>
</div>
<!-- /CODE -->

<!-- JS -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script>
$(document).ready(function() {
    var curPhoto = 1;
    var totalPhotos = $('img').size();
    
    
    
    console.log($('img').size());

    
});
</script>
<!-- /JS -->