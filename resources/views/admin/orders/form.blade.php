@extends('layouts.admin.base')

@if (isset($order))
	@section('title_page_header', 'Editar pedido: ' . $order->title)
@else
	@section('title_page_header', 'Nuevo producto');
@endif

{{-- @section('description_page_header', 'panel de administración') --}}

@section('content')

	<div class="box box-primary">
		@if (isset($order))
			{!! Form::model($order, ['method' => 'PUT', 'route' => ['orders.update', $order->id], 'enctype'=>'multipart/form-data']) !!}
		@else
			{!! Form::open(['method' => 'POST', 'route' => 'orders.store', 'enctype'=>'multipart/form-data']) !!}
		@endif
			<div class="box-body">
	 			<p><label>{{ $order->id }}</label></p>
	 			<p><label>{{ $order->name }}</label></p>
	 			<p><label>{{ $order->email }}</label></p>
	 			<p><label>{{ $order->subtotal }}</label></p>
	 			{!! Form::select('status', ['new' => 'Nuevo', 'old' => 'finallizado'], $order->status) !!}
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<a href="{{	URL::previous() }}" class="btn btn-warning  ">Cancelar</a>
			</div>
	 	{!! Form::close() !!}
	</div>

@endsection

@section('js')

@endsection