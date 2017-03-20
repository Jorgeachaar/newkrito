@extends('layouts.admin.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@if (isset($item))
	@section('title_page_header', 'Editar post: ' .$item->title)
@else
	@section('title_page_header', 'Nuevo post');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['posts.update', $item->id]]) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'posts.store', 'enctype'=>'multipart/form-data']) !!}
		@endif
			<div class="box-body">
	 			{!! Field::text('title') !!}				
	 			{!! Field::textarea('content', ['class'=>'textarea']) !!}			
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
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5();
		});
	</script>
@endsection