jQuery(document).ready(function ($) {
	$(document).on( 'click', '.nav-tab-wrapper a', function() {

		$('.nav-tab-wrapper a').removeClass('nav-tab-active');

		$(this).addClass('nav-tab-active');

		var id = $(this).attr('href');

		$('section').hide();

		$(id).show();

		return false;

	})

	$('.checkbox input[type="checkbox"]').change(function() {

		toggleCheckbox(this);

	});

	$('.checkbox input[type="checkbox"]').each(function() {

		toggleCheckbox(this);

	});

	function toggleCheckbox(element) {

		if(element.checked) {

			$(element).parents('.checkbox').find('select').attr('disabled', false);

		} else {

			$(element).parents('.checkbox').find('select')[0].selectedIndex = 0;

			$(element).parents('.checkbox').find('select').attr('disabled', true);

		}
	}



});
