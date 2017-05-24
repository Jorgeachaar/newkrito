@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Krito'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
@stop

@section('container')
<section class="content-section text-center">
	<div class="container">
		<div class="table-cart">
			
			<div class="container text-center">
				<h1><i class="fa fa-shopping-cart"></i>  Order Detail</h1>
			</div>

			<div class="page">
				<div class="table-responsive">
					<h3>User data</h3>
					{{-- <table class="table table-striped table-hover table-bordered">
						<tr><td>Nombre</td><td> Juan Perez </td></tr>
						<tr><td>Email</td><td> Juan Perez </td></tr>
						<tr><td>Address</td><td> Juan Perez </td></tr>
						<tr><td>Phone</td><td> 21312321 </td></tr>
					</table> --}}
				</div>

	@include('partials.errors')

	{!!Form::open(['route'=>'payment', 'method'=>'POST', 'class'=>'form-horizontal'])!!}

		<div class="form-group">
			{!!Form::label('Name','Name:', array('class'=>'col-sm-2 control-label'))!!}
			<div class="col-sm-5">
			{!!	Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
			</div>
		</div>
		<div class="form-group">
			{!!Form::label('Email','Email:', array('class'=>'col-sm-2 control-label'))!!}
			<div class="col-sm-5">
			{!!	Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
			</div>
		</div>
		<div class="form-group">
			{!!Form::label('Adress','Adress:', array('class'=>'col-sm-2 control-label'))!!}
			<div class="col-sm-5">
			{!!	Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
			</div>
		</div>
		<div class="form-group">
			{!!Form::label('Phone','Phone:', array('class'=>'col-sm-2 control-label'))!!}
			<div class="col-sm-5">
			{!!	Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
			</div>
		</div>

				<div class="table-responsive">
					<h3>Order summary</h3>
					<table class="table table-striped table-hover table-bordered">
						<tr>
							<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>SubTotal</th>
						</tr>
						@foreach (Cart::content() as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>$ {{ $item->price  }}</td>
								<td>{{ $item->qty }}</td>
								<td>$ {{ $item->total }}</td>
							</tr>
						@endforeach
					</table>
					<hr>
					<h3><span class="label label-warning">
						TOTAL: $ {{ Cart::total()  }}
					</span></h3>
					<hr>
					<p>
						<a href="{{ route('cart.show') }}" class="btn btn-primary">Return to cart</a>
						{!!Form::submit('CONTINUE',['class'=>'btn btn-success'])!!}
					</p>
				</div>
				
			</div>

	{!!Form::close()!!}
		</div>
	</div>
</section>
@stop