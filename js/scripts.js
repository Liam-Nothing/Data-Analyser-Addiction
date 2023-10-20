// Function to show a success notification
function showSuccessNotification(message) {
	Swal.fire({
		title: 'Succès !',
		text: message,
		icon: 'success',
		timer: 1500, // Disparaît après 2 secondes
		showConfirmButton: false,
		customClass: {
			popup: 'custom-alert',
			title: 'custom-title',
			content: 'custom-content'
		}
	});
}

// Function to show an error notification
function showErrorNotification(message) {
	Swal.fire({
		title: 'Erreur !',
		text: message,
		icon: 'error',
		timer: 2000, // Disparaît après 2 secondes
		showConfirmButton: false,
		customClass: {
			popup: 'custom-alert',
			title: 'custom-title',
			content: 'custom-content'
		}
	});
}

// Function to log a function click
function logFunction(functionNumber) {
	// Make an AJAX request to log.php
	fetch('log.php?function=' + functionNumber)
		.then(response => response.json())
		.then(data => {
			if (data.status === 'success') {
				showSuccessNotification('Données sauvegardées avec succès !');
			} else {
				showErrorNotification('Les données n\'ont pas pu être sauvegardées.');
			}
		})
		.catch(error => {
			showErrorNotification('Une erreur s\'est produite lors de la sauvegarde des données.');
		});
}