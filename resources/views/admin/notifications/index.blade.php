@extends('layouts.admin.base')

@section('title_page_header', 'Notificaciones')

@section('description_page_header', 'panel de administración')


@section('content')

	<p><a href="{{ route('notifications.markReadAll') }}" title="">Marcar todas como leidas</a></p>
	
	<ul class="list-group">
		@foreach ($notifications as $notification)
			<li class="list-group-item">
				<a href="{{ route('notifications.show', $notification->id) }}" title="">
					@if ($notification->read_at == null)
						<p>No esta leida</p>
					@endif
					{{ snake_case(class_basename($notification->type)) }}
					<br>
					Numero de orden: {{ $notification->data['order_id'] }}
					<br>
					{{ $notification->created_at->format('d/m/Y H:ia') }}
				</a>
			</li>
		@endforeach
	</ul>
	
@endsection