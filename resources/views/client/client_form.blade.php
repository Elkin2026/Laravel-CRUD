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
				<a href="/" class="btn btn-outline-primary">Inicio</a>
			</div>
		</div>
	</div>
	<div class="container">
		<p class="text-center font-weight-bold h1">
			@if (isset($model))
				{{'Editar'}}
			@else
				{{'Crear'}}
			@endif
			cliente
		</p>

		<form id="clientForm">
			@csrf
			@if (isset($model))
				@method('PUT')
			@endif

			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['identification_type']}}</span>
					<span class="text-danger">*</span>
				</label>
				<select class="custom-select"
				        name="{{ array_search($labelsColumnName['identification_type'], $labelsColumnName)}}"
				        value="{{isset($model) ? $model->identification_type : null}}">
					@foreach ($optionsForSelector as $key => $option)
						@if (isset($model) && $model->identification_type == $key)
							<option value="{{$key}}" selected>{{$option}}</option>
						@else
							<option value="{{$key}}">{{$option}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['identification_number']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="number" min="0" class="form-control"
				       name="{{ array_search($labelsColumnName['identification_number'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->identification_number : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['name']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" class="form-control"
				       name="{{ array_search($labelsColumnName['name'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->name : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['email']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="email" class="form-control"
				       name="{{ array_search($labelsColumnName['email'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->email : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['address']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" class="form-control"
				       name="{{ array_search($labelsColumnName['address'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->address : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['phone_number']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="number" class="form-control"
				       name="{{ array_search($labelsColumnName['phone_number'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->phone_number : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['contact_name']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" class="form-control"
				       name="{{ array_search($labelsColumnName['contact_name'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->contact_name : null}}">
			</div>
			<div class="d-flex justify-content-end">
				<button type="submit" class="btn btn-primary">
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
		$('#clientForm').on("submit", function(event) {
			event.preventDefault();
			let columnsName = <?= json_encode($labelsColumnName) ?>;
			validateFormAndSave(this, columnsName, 'client', '{{csrf_token()}}', '{{isset($model) ? $model->id : null }}');
		});
	});
</script>
@include('templates_base.footer')