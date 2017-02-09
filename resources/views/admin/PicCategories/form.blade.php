@extends('layouts.admin.base')

@section('content')

	<div class="box box-primary">
		<div class="box-header with-border">
			@if (isset($item))
				<h3 class="box-title">Editar la categoria: {{ $item->description }}</h3>
			@else
				<h3 class="box-title">Nueva categoria</h3>
			@endif
		</div>
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
				{{-- {!! Form::checkboxes('premiun', [true => 'Es premiun']) !!} --}}
				<br>
				{!! Form::hidden('premiun', false) !!}
				{!! Form::checkbox('premiun', true) !!} Es premiun
			</div>
			{{-- <div class="box-body">
				{!! Field::file('image'); !!}
				@if (isset($item))
					<img src="{{ $tattoo->url_thumbnail_image }}" alt="">
				@endif
			</div> --}}
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<a href="{{	URL::previous() }}" class="btn btn-primary">Cancelar</a>
			</div>
	 	{!! Form::close() !!}
	</div>
@endsection