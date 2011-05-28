<!-- STYLE -->
<style>
    #module_activecollab_box {margin:10px; position:relative; overflow: hidden; width: auto;}
    #columns {position:relative; width:100%; height:320px; z-index:10; margin-top: 20px;}
    #legend {position:relative; width:100%; height:60px;}
    .column {min-width:40px; bottom:0; position:absolute;}
    .legend {height:40px; bottom:5px; position:absolute; text-align:center;}
    .legend img {display: block; margin: 0 auto; }
    .line {border-bottom:1px solid #d0d0d0; width:810px; position:absolute; left:5px; color:#303030; height:15px; font-size:12px; z-index: 8; overflow: hidden; line-height: 15px;}
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_activecollab' class='w_four h_two'>
    
    <div id="module_activecollab_box">

    	<div id="columns" >
    	<?php
    		$width = ceil(780 / count($projects)) - 10;
    		
    		$left = 30;
    		foreach($projects as $proj)
    		{
    			echo "<div title='".$proj->name."' class='column' style='width: ". $width ."px; height: ".$proj->progress."%; background:".$proj->color."; left:".$left."px'></div>";	
    			$left+= $width + 10;
    		}	
    	?>
    	</div>
    	<div id="legend">
    	<?php
    		$left = 30;
    		foreach($projects as $proj)
    		{
    			echo "<div class='legend' style='width:". $width ."px; left:".$left."px; '><img src='".$proj->icon."' alt='".$proj->name."' title='".$proj->name."' /></div>";	
    			$left+= $width + 10;
    		}	
    	?>	
    	</div>
	</div>
</div>
<!-- /CODE -->

<!-- JS -->
<script>
$(document).ready(function() {
	$('#module_activecollab_box .column').each(function(i, el){
		var height = $(el).height();
		$(el).height(0);
		$(el).delay(2000).animate({
			height: [height, 'swing']
		}, 1500, 'linear', function() {});
	});
	
	var lineSpacing = ($('#module_activecollab_box #columns').height()/10);
	var px = 60;
	for(var i=0; i<11; i++)
	{
		$('#module_activecollab_box').append('<div class="line" style="bottom:'+px+'px;">'+(i*10)+'</div>');
    	px += lineSpacing;
	}
});
</script>
<!-- /JS -->