@include('templates_base.head')

<div class="container-fluid mt-4">
	<div class="col-12 d-sm-flex">
		<div class="d-flex justify-content-start col-4">
			<img src="https://www.coytex.com.co/wp-content/uploads/2020/07/Logo_pagina_web_fondo_blanco_transparente.png"
			     class="d-inline-block align-top w-50"
			     alt="">
		</div>
	</div>
	<div class="container">
		<p class="text-center font-weight-bold h1">
			@if (isset($model))
				{{'Editar'}}
			@else
				{{'Crear'}}
			@endif
			Pedido
		</p>

		<form id="orderForm">
			@csrf
			@if (isset($model))
				@method('PUT')
			@endif
			@if (isset($model))
				<div class="form-group">
					<label>
						<span class="font-weight-bold">{{$labelsColumnName['code_transaction']}}</span>
						<span class="text-danger">*</span>
					</label>
					<input type="text" class="form-control"
					       name="{{ array_search($labelsColumnName['code_transaction'], $labelsColumnName)}}"
					       value="{{isset($model) ? $model->code_transaction : null}}"
					       disabled>
				</div>
			@endif
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['state']}}</span>
					<span class="text-danger">*</span>
				</label>
				<select class="custom-select"
				        name="{{ array_search($labelsColumnName['state'], $labelsColumnName)}}">
					<option value="">Elige un estado de pedido</option>
					@foreach ($optionsForSelector as $key => $option)
						@if (isset($model) && $model->state == $option)
							<option value="{{$key}}" selected="true">{{$model->state}}</option>
						@else
							<option value="{{$key}}">{{$option}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['date_of_request']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="date" class="form-control"
				       name="{{ array_search($labelsColumnName['date_of_request'], $labelsColumnName)}}"
				       value="{{isset($model) ? date('Y-m-d', strtotime($model->date_of_request)) : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['date_of_delivery']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="date" class="form-control"
				       name="{{ array_search($labelsColumnName['date_of_delivery'], $labelsColumnName)}}"
				       value="{{isset($model) ? date('Y-m-d', strtotime($model->date_of_delivery)) : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['client_name']}}</span>
					<span class="text-danger">*</span>
				</label>
				<select class="custom-select"
				        name="client">
					<option value="null">Elige un cliente</option>
					@foreach ($clients as $option)
						@if (isset($model) && $model->client_id == $option['id'])
							<option value="{{$option['id']}}" selected="true">
								{{$option['name']}}
							</option>
						@else
							<option value="{{$option['id']}}">{{$option['name']}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['product_name']}}</span>
					<span class="text-danger">*</span>
				</label>
				<select class="custom-select"
				        name="product">
					<option value="null">Elige un producto</option>
					@foreach ($products as $product)
						@if (isset($model) && $model->product_id == $product['id'])
							<option value="{{$product['id']}}" selected="true">
								{{$product['name']}}
							</option>
						@else
							<option value="{{$product['id']}}">{{$product['name']}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['quantity_request_by_client']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="number" min="0" class="form-control"
				       name="{{ array_search($labelsColumnName['quantity_request_by_client'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->quantity_request_by_client : null}}">
			</div>
			<div class="d-flex justify-content-end">
				<a href="/order/list" class="btn btn-primary mr-2">
					Cancelar
				</a>
				<button type="submit" class="btn btn-success">
					@if (isset($model))
						{{'Actualizar'}}
					@else
						{{'Guardar'}}
					@endif
				</button>
			</div>
		</form>
	</div>
</div>
@include('templates_base.sectionScripts')
<script>
	$(document).ready(function() {
		$('#orderForm').on("submit", function(event) {
			event.preventDefault();
			let optionsClient = JSON.parse('<?= json_encode($clients) ?>');
			let optionsProduct = JSON.parse('<?= json_encode($products) ?>');
			let selectedClient = optionsClient.filter(client => client.id == $(this).find('[name="client"]').val());
			let selectedProduct = optionsProduct.filter(product => product.id == $(this).find('[name="product"]').val());
			let attributes = [
				{column: "date_of_request", valueAttribute: $(this).find(`[name="date_of_request"]`).val(), title: "{{$labelsColumnName['date_of_request']}}"},
				{column: "date_of_delivery", valueAttribute: $(this).find(`[name="date_of_delivery"]`).val(), title: "{{$labelsColumnName['date_of_delivery']}}"},
				{column: "client", valueAttribute: selectedClient[0], title: "Nombre del cliente"},
				{column: "quantity_request_by_client", valueAttribute: $(this).find(`[name="quantity_request_by_client"]`).val(), title: "{{$labelsColumnName['quantity_request_by_client']}}"},
				{column: "state", valueAttribute: $(this).find(`[name="state"]`).val(), title: "{{$labelsColumnName['state']}}"},
				{column: "product", valueAttribute: selectedProduct[0], title: "Nombre del producto"},
			];

			let attributesWithoutValue = attributes.filter(attribute => !attribute.valueAttribute);
			if (attributesWithoutValue.length) {
				Swal.fire({
					title: 'Error!',
					html: `<strong>Por favor completa los siguientes campos:</strong>
						<ul class="text-left mt-3">${attributesWithoutValue.map(item => `<li>${item.title}</li>`).join('')
					}</ul>`,
					icon: 'error',
					confirmButtonText: 'Entendido'
				});
			} else {
				let dataToSave = {};
				attributes.forEach(element => {
					dataToSave[element.column] = element.valueAttribute;
				});
				$.ajax({
					url: `/order/{{isset($model) ? $model->id : ''}}`,
					headers: {
						'X-CSRF-TOKEN': "{{csrf_token()}}"
					},
					type: "{{isset($model) ? 'PUT' : 'POST'}}",
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
							window.location.href = `/order/list`;
						}
					}
				})
			}
		});
	});
</script>
@include('templates_base.footer')