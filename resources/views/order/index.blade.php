@include('templates_base.head')

<div class="container-fluid mt-4">
	<div class="col-12 d-sm-flex">
		<div class="d-flex justify-content-start col-4">
			<img src="https://www.coytex.com.co/wp-content/uploads/2020/07/Logo_pagina_web_fondo_blanco_transparente.png"
			     class="d-inline-block align-top w-50"
			     alt="">
		</div>
		<div class="col row justify-content-end">
			<div class="mx-2">
				<a class="btn btn-outline-primary" href="{{route('order.create')}}">Crear pedido</a>
			</div>
			<div class="mx-2">
				<a class="btn btn-outline-primary" href="/">Inicio</a>
			</div>
		</div>
	</div>

	<div class="my-3">
		<h1 class="text-center">Pedidos registrados</h1>
		<div class="shadow rounded table-responsive">
			<table class="table" id="ordersTable"></table>
		</div>
	</div>
</div>

@include('templates_base.sectionScripts')

<script>
	$(document).ready( function () {
		$.ajax({
			url: '/order',
			type: 'GET',
			success: function(response) {
				let columns = Object.keys(response.columns).map((key) => {
					return {data: key, title: response.columns[key]}
				})
				columns.push({
					title: 'Acciones',
					render: function(data, type, row) {
						let buttonToEdit = `<button onclick="updateClient(${row.id}, 'order')"
							                        class="btn btn-success btn-sm mr-3">
							                    Actualizar
							                </button>`;
						let buttonToDeleteClient = `<button onclick="deleteClient(${row.id}, 'order', '{{ csrf_token() }}')"
							                                class="btn btn-danger btn-sm mr-3">
							                            Eliminar
							                        </button>`
						return `<div class="d-flex justify-content-around">${buttonToEdit} ${buttonToDeleteClient}</div>`;
					}
				});
				$('#ordersTable').DataTable({
					data: response.data,
					searching: false,
					paging: false,
					info: false,
					columns: columns
				});
			},
			error: function(xhr, status, error) {
				Swal.fire({
					title: '',
					html: `Error al obtener datos de clientes`,
					icon: 'error',
					confirmButtonText: 'Entendido'
				})
			}
		});
	});
</script>

@include('templates_base.footer')