$(document).ready(function () {
	// ajax delete
	$(document).on('click', '.btn-destroy', function(e){

		var data = $(this).data('link');
		data = data.split('|');

		e.preventDefault();

		// Get token
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});



	});
});