@extends('layouts.admin.base')

@section('css')
	
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
	 			{!! Field::text('about') !!}
	 			{!! Field::text('contact') !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Actualizar</button>
				{{-- <a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a> --}}
			</div>
	 	{!! Form::close() !!}
	</div>

@endsection

@section('js')
	
	<script type="text/javascript">
		
	</script>

@endsection