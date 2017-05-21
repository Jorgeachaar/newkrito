@extends('layouts.admin.base')

@if (isset($item))
	@section('title_page_header', 'Editar la categoria: ' .$item->description)
@else
	@section('title_page_header', 'Nueva categoria');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['productCategory.update', $item->id], 'enctype'=>'multipart/form-data']) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'productCategory.store', 'enctype'=>'multipart/form-data']) !!}
		@endif
			<div class="box-body">
	 			{!! Field::text('title') !!}
	 			{!! Form::select('product_category_id', $categories, null, ['class' => 'form-control'])!!}	
				@if (isset($item))
					{!! Field::number('position') !!}
				@endif
				@if (isset($item))
					<img src="{{ $item->url_thumbnail_image }}" alt="">
				@endif
				{!! Field::file('image'); !!}
				@if (isset($item))
					<img src="{{ $item->url_thumbnail_image2 }}" alt="">
				@endif
				{!! Field::file('image2'); !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a>
			</div>
	 	{!! Form::close() !!}
	</div>
@endsection