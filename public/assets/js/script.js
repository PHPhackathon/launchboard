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
	load_widget('w_four h_one');
	load_widget('w_one h_two');
	load_widget('w_two h_one');
	load_widget('w_one h_one');
	load_widget('w_one h_one');
	load_widget('w_two h_one');
});

var load_widget = function(selectedWidget, refreshRate, replaceBy) {
	if (!refreshRate) refreshRate = 1000;
	
	// setup basic element
	var el = $(document.createElement('div')).addClass('box ui-widget-content');
	
	// widget specific data
	switch (selectedWidget) {
		// widget: whitespace
		case "whitespace":
			el.addClass('whitespace h_one w_one');
			break;
		// debug
		default:
			el.addClass(selectedWidget);
	}
	
	// add the element
	if (!replaceBy) {
		el.appendTo(config.container);
	} else {
		replaceBy.fadeTo('slow', 0.5).delay(500).replaceWith(el);
	}
	el.fadeOut(0).delay(config.delay * config.container.children('.box').length).fadeIn();
	
	// refresh
	/*setTimeout(function() {
		load_widget(selectedWidget, refreshRate, el)
	}, refreshRate + config.delay * config.container.children('.box').length);*/
}

$(document).bind('touchmove', function(e) {
   e.preventDefault();
}, false);