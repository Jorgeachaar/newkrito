@extends('layouts.admin.base')

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/adminlte/plugins/iCheck/all.css') }}">
@endsection

@if (isset($item))
	@section('title_page_header', 'Editar video: ' .$item->title)
@else
	@section('title_page_header', 'Nuevo video');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['videos.update', $item->id]]) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'videos.store']) !!}
		@endif
			<div class="box-body">
	 			{!! Field::text('title') !!}				
	 			{!! Field::text('url') !!}				
				<br>
				{!! Form::hidden('premium', false) !!}
				@if (isset($item))
					{!! Field::number('position') !!}
				@endif
				{!! Form::checkbox('premium', true) !!} Es premium
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