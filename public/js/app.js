function updateClient(client_id, controller) {
	window.location.href = `/${controller}/${client_id}/edit`;
}

async function deleteClient(client_id, controller, token) {
	let responseToAlert = await Swal.fire({
		title: '¿Está seguro de eliminar este registro?',
		html: ``,
		icon: 'warning',
		confirmButtonText: 'Entendido',
		showCancelButton: true,
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		reverseButtons: true,
		buttonsStyling: false,
		customClass: {
			confirmButton: "btn btn-success ml-2",
			cancelButton: "btn btn-danger"
		},
	})

	if (!responseToAlert.isConfirmed) {
		return;
	}

	$.ajax({
		url: `/${controller}/${client_id}`,
		headers: {
			'X-CSRF-TOKEN': token
		},
		type: 'DELETE',
		success: async function(response) {
		   await Swal.fire({
				title: 'registro eliminado correctamente',
				html: ``,
				icon: 'success',
				confirmButtonText: 'Entendido'
			})

			window.location.reload();
		},
		error: function(xhr, status, error) {
			Swal.fire({
				title: 'Error al eliminar el registro',
				html: `No se pudo eliminar el registro. Por favor intenta más tarde`,
				icon: 'error',
				confirmButtonText: 'Entendido',
			})
		}
	})
}

function validateFormAndSave(context, columnsName, controller, token, register_id = null) {
	let inputsWithoutValues = [];
	let dataToSave = {};
	Object.keys(columnsName).forEach(element => {
		let inputValue = $($(context)).find(`[name="${element}"]`).val();
		dataToSave[element] = inputValue;
		if (!inputValue) {					
			inputsWithoutValues.push(columnsName[element]);
		}
	});

	if (!inputsWithoutValues.length) {
		$.ajax({
			url: `/${controller}/${register_id || ''}`,
			headers: {
				'X-CSRF-TOKEN': token
			},
			type: register_id ? 'PUT' : 'POST',
			data: dataToSave,
			success: async function(response) {
				if (response.code == 500) {
					Swal.fire({
						title: 'Error',
						html: `error al guadar el producto`,
						icon: 'error',
						confirmButtonText: 'Entendido',
					})
				} else if (response.code == 200) {
					await Swal.fire({
						title: 'Datos Guardados exitosamente',
						html: ``,
						icon: 'success',
						confirmButtonText: 'Entendido'
					})

					if (controller == 'client') {
						window.location.href = '/'
					} else {
						window.location.href = `/${controller}/list`;
					}
				}
			}
		})
	} else {
		Swal.fire({
			title: 'Error!',
			html: `<strong>Por favor completa los siguientes campos:</strong>
				<ul class="text-left mt-3">${inputsWithoutValues.map(item => `<li>${item}</li>`).join('')
			}</ul>`,
			icon: 'error',
			confirmButtonText: 'Entendido'
		})
	}
}