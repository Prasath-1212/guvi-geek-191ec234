$(document).ready(function() {
	$('#registerForm').submit(function(event) {
		event.preventDefault();

		var email = $('#email').val();
		var password = $('#password').val();
		
		$.ajax({
			url: 'php/register.php',
			type: 'POST',
			data: {
				email: email,
				password: password
			},
			success: function(data) {
				alert(data);
				window.location.href = 'login.html';
			},
			error: function() {
				alert('An error occurred');
			}
		});
	});
});
