@extends('layouts.admin')

@section('content')

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">New tattoos</h3>
		</div>

		{!! Form::open(['method' => 'POST', 'route' => 'tattoos.multi.store', 'enctype'=>'multipart/form-data']) !!}

			<div class="box-body">
				{!! Form::label('Categorias:') !!}				
				{!! Form::select('tattoo_category_id', $categories, null, ['class' => 'form-control'])!!}
			</div>
			<div class="box-body">
				{!! Form::file('image[]', array('multiple'=>true)) !!}
				{{-- {!! Field::file('image[]', ['multiple'=>true]); !!} --}}
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
	 	{!! Form::close() !!}
	</div>
@endsection