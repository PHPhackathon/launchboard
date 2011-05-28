var config = {
	container: false,
	startDelay: 1000,
	delay: 250
}

$(function() {
	config.container = $('#sortable');
	
	// add a class for a better ui
	$('#sortable .box').addClass('ui-widget-content');
	//$('#sortable').sortable();
	
	// autoload widgets
	load_widget('activecollab', 60 * 60 * 1000);
	//load_widget('analytics', 60 * 60 * 1000);
	//load_widget('foursquare', 60 * 60 * 1000);
	//load_widget('gowalla', 60 * 60 * 1000);
	load_widget('time', 60 * 1000);
	load_widget('calendar', 60 * 1000);
	load_widget('birthdays', 60 * 1000);
	
	load_widget('twitterhash', 60 * 1000);
	load_widget('rainer', 60 * 1000);
	load_widget('weather', 60 * 1000);
	load_widget('daydone', 60 * 1000);
	
	load_widget('flickr', 20 * 1000);
	load_widget('dilbert', 60 * 1000);
	load_widget('facebooklikes', 60 * 1000);
	load_widget('rss', 20 * 1000);
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
			el.load('/'+selectedWidget);
			setInterval(function() {
				el.load('/'+selectedWidget);
			}, refreshRate);
			break;
	}
	
	// add the element
	el.appendTo(config.container);
	
	if (selectedWidget == 'activecollab') {
		el.slideDown(0);
	} else {
		el.delay(config.startDelay + (config.delay * config.container.children('.box').length)).slideUp(0).slideDown('slow');
	}
}

$(document).bind('touchmove', function(e) {
   e.preventDefault();
}, false);