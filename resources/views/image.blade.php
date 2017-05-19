{!! Form::open(['route' => 'image', 'files' => true]) !!}
    <p>{!! Form::file('image') !!}</p>
    <p>{!! Form::submit('Crear imagen con recuadro') !!}</p>
{!! Form::close() !!}