@extends('layouts.admin.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@if (isset($item))
	@section('title_page_header', 'Editar producto: ' .$item->title)
@else
	@section('title_page_header', 'Nuevo producto');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['products.update', $item->id], 'enctype'=>'multipart/form-data']) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'products.store', 'enctype'=>'multipart/form-data']) !!}
		@endif
			<div class="box-body">
				{!! Form::hidden('product_category_id', $category->id) !!}
	 			{!! Field::text('title') !!}
	 			{!! Field::textarea('description', ['class'=>'textarea']) !!}
				{!! Field::number('price', ['step' =>'0.01']) !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a>
			</div>
	 	{!! Form::close() !!}
	</div>

@endsection

@section('js')

	<script src="{{ asset('plugins/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	
	<script type="text/javascript">
		$(function () {
			$(".textarea").wysihtml5();
		});
	</script>

@endsection