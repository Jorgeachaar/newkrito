@extends('layouts.admin.base')

@if (isset($item))
	@section('title_page_header', 'Editar producto: ' .$item->description)
@else
	@section('title_page_header', 'Nueva producto');
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
	 			{!! Field::text('description') !!}				
				{!! Field::number('price') !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a>
			</div>
	 	{!! Form::close() !!}
	</div>
@endsection