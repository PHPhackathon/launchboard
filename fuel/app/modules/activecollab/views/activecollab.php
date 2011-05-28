<!-- STYLE -->
<style>
    #module_activecollab { height: 380px; width: 790px;  background:#000; padding:20px 20px 10px 20px; position:relative;}
    #columns {position:relative; width:100%; height:340px; z-index:10;}
    #legend {position:relative; width:100%; height:50px;}
    .column {min-width:40px; bottom:0; position:absolute;}
    .legend {height:40px; bottom:5px; position:absolute; text-align:center;}
    .line {border-bottom:1px solid #444; width:810px; position:absolute; left:5px; color:#eee; height:15px; font-size:12px;}
</style>
<!-- /STYLE -->

<!-- CODE -->
<div id='module_activecollab' class='box'>
	<div class="line" style="top:5px;">100</div>
	<div class="line" style="bottom:50px;">0</div>
	<div id="columns" >
	<?php
		$width = ceil(790 / count($projects)) - 10;
		
		$left = 0;
		foreach($projects as $proj)
		{
			echo "<div title='".$proj->name."' class='column' style='width: ". $width ."px; height: ".$proj->progress."%; background:".$proj->color."; left:".$left."px'></div>";	
			$left+= $width + 10;
		}	
	?>
	</div>
	<div id="legend">
	<?php
		$left = 10;
		foreach($projects as $proj)
		{
			echo "<div class='legend' style='width:". $width ."px; left:".$left."px; '><img src='".$proj->icon."' alt='".$proj->name."' title='".$proj->name."' /></div>";	
			$left+= $width + 10;
		}	
	?>	
	</div>
</div>
<!-- /CODE -->

<!-- JS -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script>
$(document).ready(function() {
	$('.column').each(function(i, el){
		var height = $(el).height();
		$(el).height(0);
		$(el).animate({
			height: [height, 'swing']
		}, 1500, 'linear', function() {});
	});
	
	var lineSpacing = ($('#columns').height()/10);
	var px = 50;
	for(var i=1; i<10; i++)
	{
		px += lineSpacing;
		$('#module_activecollab').append('<div class="line" style="bottom:'+px+'px;">'+(i*10)+'</div>');
	}
});
</script>
<!-- /JS -->