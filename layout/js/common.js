$(document).ready(function() {

	/* -- TOP SLIDE BUTTON -- */
	$().UItoTop({ easingType: 'easeOutQuart' });
	
	/* -- MAIN GALLERY SETTING -- */
	$('#slider1').bxSlider({
		pause: 7000,
		/* mode: 'fade', */
		auto: true,
		autoHover: true,
		autoControls: false,
		autoControlsCombine: true,
		controls: false
	});
	
});/* document.ready end */