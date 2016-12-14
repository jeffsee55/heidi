jQuery(document).ready(function ($) {
	$(document).on( 'click', '.nav-tab-wrapper a', function() {

		$('.nav-tab-wrapper a').removeClass('nav-tab-active');

		$(this).addClass('nav-tab-active');

		var id = $(this).attr('href');

		$('section').hide();

		$(id).show();

		return false;
        
	})
});
