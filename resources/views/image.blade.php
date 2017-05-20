{!! Form::open(['route' => 'image', 'files' => true]) !!}
	<p>Color de marco: {!! Form::select('border_type', ['1' => 'Amarillo', '2' => 'Negro']) !!}</p>
    <p>{!! Form::file('image') !!}</p>
    <p>{!! Form::submit('Crear imagen con recuadro') !!}</p>
{!! Form::close() !!}