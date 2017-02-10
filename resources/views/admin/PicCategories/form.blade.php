@extends('layouts.admin.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/iCheck/all.css') }}">
@endsection

@if (isset($item))
	@section('title_page_header', 'Editar la categoria: ' .$item->description)
@else
	@section('title_page_header', 'Nueva categoria');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['picCategories.update', $item->id], 'enctype'=>'multipart/form-data']) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'picCategories.store', 'enctype'=>'multipart/form-data']) !!}
		@endif
			<div class="box-body">
	 			{!! Field::text('title') !!}				
	 			{!! Field::text('description') !!}				
				{!! Form::label('Categorias:') !!}
				{!! Form::select('pic_category_id', $categories, null, ['class' => 'form-control'])!!}
				<br>
				{!! Form::hidden('premium', false) !!}
				{!! Form::checkbox('premium', true) !!} Es premium
				@if (isset($item))
					{!! Field::number('position') !!}
				@endif
				<br><br>
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

@section('js')
	<script src="{{ asset('plugins/adminlte/plugins/iCheck/icheck.min.js') }}"></script>

	<script type="text/javascript">
		
		$(document).ready(function() {
			$('input[type="checkbox"], input[type="radio"].minimal').iCheck({
		      checkboxClass: 'icheckbox_minimal-blue',
		      radioClass: 'iradio_minimal-blue'
		    });
		});	
	</script>
@endsection