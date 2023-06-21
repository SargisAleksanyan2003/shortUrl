$(document).ready(function () {
	$(document).on("click", '#cut', function (e) {
		e.preventDefault();
		$.post("ajax/cut.php", {
				url: $('#field_1').val()
			})
			.done(function (data) {
				$('#message').html(data);
			});
	});
});