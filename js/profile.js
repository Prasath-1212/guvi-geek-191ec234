$(document).ready(function() {
	// Get the user's profile data
	$.ajax({
		url: 'php/profile.php',
		type: 'GET',
		dataType: 'json',
		success: function(data) {
			// Fill in the form with the user's profile data
			$('#age').val(data.age);
			$('#dob').val(data.dob);
			$('#contact').val(data.contact);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			// Log the error to the console
			console.log(textStatus + ': ' + errorThrown);
		}
	});

	// Submit the form to update the user's profile data
	$('#profile-form').submit(function(event) {
		// Prevent the default form submission
		event.preventDefault();

		// Get the form data
		var age = $('#age').val();
		var dob = $('#dob').val();
		var contact = $('#contact').val();

		// Update the user's profile data
		$.ajax({
			url: 'update_profile.php',
			type: 'POST',
			dataType: 'json',
			data: { age: age, dob: dob, contact: contact },
			success: function(data) {
				// Display a success message
				alert('Profile updated successfully');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// Log the error to the console
				console.log(textStatus + ': ' + errorThrown);
			}
		});
	});
});
