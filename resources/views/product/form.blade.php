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
			producto
		</p>

		<form id="productForm">
			@csrf
			@if (isset($model))
				@method('PUT')
			@endif
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['code']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" min="0" class="form-control"
				       name="{{ array_search($labelsColumnName['code'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->code : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['size']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" class="form-control"
				       name="{{ array_search($labelsColumnName['size'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->size : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['color']}}</span>
					<span class="text-danger">*</span>
				</label>
				<input type="text" class="form-control"
				       name="{{ array_search($labelsColumnName['color'], $labelsColumnName)}}"
				       value="{{isset($model) ? $model->color : null}}">
			</div>
			<div class="form-group">
				<label>
					<span class="font-weight-bold">{{$labelsColumnName['description']}}</span>
					<span class="text-danger">*</span>
				</label>
				<textarea rows="3" class="form-control" name="{{ array_search($labelsColumnName['description'], $labelsColumnName)}}">{{isset($model) ? $model->description : ''}}</textarea>
			</div>
			<div class="d-flex justify-content-end">
				<a href="/product/list" class="btn btn-primary mr-2">
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
		$('#productForm').on("submit", function(event) {
			event.preventDefault();
			let columnsName = <?= json_encode($labelsColumnName) ?>;
			validateFormAndSave(this, columnsName, 'product', '{{csrf_token()}}', '{{isset($model) ? $model->id : null }}');
		});
	});
</script>
@include('templates_base.footer')