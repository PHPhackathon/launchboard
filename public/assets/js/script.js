var config = {
	container: false,
	delay: 250
}

$(function() {
	config.container = $('#sortable');
	
	// add a class for a better ui
	$('#sortable .box').addClass('ui-widget-content');
	
	$('#widgets').change(function() {
		// add the widget
		load_widget($(this).val());

		// reset the select
		$(this).val('');
	});
	
	// autoload widgets
	//load_widget('activecollab', 60 * 60 * 1000);
	//load_widget('analytics', 60 * 60 * 1000);
	load_widget('time', 60 * 1000);
	load_widget('flickr', 60 * 1000);
	load_widget('twitterhash', 60 * 1000);
});

var load_widget = function(selectedWidget, refreshRate) {
	if (!refreshRate) refreshRate = 1000;
	
	// setup basic element
	var el = $(document.createElement('div')).addClass('box ui-widget-content');
	
	// widget specific data
	switch (selectedWidget) {
		// widget: whitespace
		case "whitespace":
			el.addClass('whitespace h_one w_one');
			break;
			
		default:
			el.load('/'+selectedWidget, function() {
				el.fadeOut(0).delay(config.delay * config.container.children('.box').length).fadeIn('slow').fadeIn();
			});
			setInterval(function() {
				el.load('/'+selectedWidget);
			}, refreshRate);
			break;
	}
	
	// add the element
	el.appendTo(config.container);
}

$(document).bind('touchmove', function(e) {
   e.preventDefault();
}, false);