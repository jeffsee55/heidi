jQuery(document).ready(function ($) {

	function ajaxAddAdminPanel(count) {

		$.ajax({
			url: ajaxurl,
            dataType: 'json',
			data: {
				action: 'add_admin_panel',
				index: count
			},
			success: renderPanel
		});
	}

    $(document).on('click', '#add_table', function(event) {

		event.preventDefault();

        var count = $('.can-add-admin-panel').find('.q4vr-admin-panel').length;

		ajaxAddAdminPanel(count);

	});

    function renderPanel(response)
    {
        $('.can-add-admin-panel').find('.meta-box-sortables').append(response.data);
		addRemoveButtons();
    }


	function addRemoveButtons() {
		$('.can-add-admin-panel').find('.postbox').each(function() {
			$(this).find('h2.hndle').append('<a class="admin-panel-remove" href="#">Remove</a>');
		});

		$('.admin-panel-remove').click(function(e) {
			e.preventDefault();

			console.log('hi');

			$(this).parents('.postbox').remove();
		});
	}

	addRemoveButtons();
});
