@extends('layouts.admin.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('title_page_header', 'Configuración web:')

@section('content')

	<div class="box box-primary">
		{!! Form::model($item, ['method' => 'PUT', 'route' => ['setting.update', $item->id], 'enctype'=>'multipart/form-data']) !!}
			<div class="box-body">
	 			{!! Field::text('facebook') !!}				
	 			{!! Field::text('twitter') !!}
	 			{!! Field::text('instagram') !!}
	 			{!! Field::text('wishlist') !!}
	 			{!! Field::textarea('about', ['class'=>'textarea']) !!}
	 			{!! Field::textarea('contact', ['class'=>'textarea']) !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Actualizar</button>
				{{-- <a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a> --}}
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