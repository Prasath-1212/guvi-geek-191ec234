$(document).ready(function() {
	$('#login-form').submit(function(event) {
		event.preventDefault();

		// Get the form data
		var formData = {
			'email': $('#email').val(),
			'password': $('#password').val()
		};
		
		// Send the form data to the server using AJAX
		$.ajax({
			type: 'POST',
			url: 'php/login.php',
			data: formData,
			dataType: 'json',
			encode: true
		})
		.done(function(data) {
			// If the login is successful, redirect to the profile page
			if (data.success) {
				window.location.href = 'profile.html';
			}
			else {
				// If the login is not successful, show an error message
				alert(data.message);
			}
		})
		.fail(function(data) {
			// If there is an error, show an error message
			//console.log(data);
			alert('An Error Occured: ' + data.responseText);
		});
	});
});
