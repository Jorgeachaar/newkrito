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
			
		<div class="row">
				<div class="text-center">
					<h1>Cart</h1>
				</div>
			
			@if (!Auth::check())
				<div class="col-md-7">
				@include('partials.errors')
					{!!Form::open(['route'=>'payment', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
						<div class="page">
							<div class="form-group">
								{!!Form::label('Name','Name:', array('class'=>'col-sm-2 control-label'))!!}
								<div class="col-sm-10">
								{!!	Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
								</div>
							</div>
							<div class="form-group">
								{!!Form::label('Email','Email:', array('class'=>'col-sm-2 control-label'))!!}
								<div class="col-sm-10">
								{!!	Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
								</div>
							</div>
							<div class="form-group">
								{!!Form::label('Adress','Adress:', array('class'=>'col-sm-2 control-label'))!!}
								<div class="col-sm-10">
								{!!	Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
								</div>
							</div>
							<div class="form-group">
								{!!Form::label('Phone','Phone:', array('class'=>'col-sm-2 control-label'))!!}
								<div class="col-sm-10">
								{!!	Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
								</div>
							</div>
						</div>
				</div>
				<div class="col-md-5 text-center">
					<h1>Login to account</h1>
				</div>
			@endif


		<div class="row">
			<div class="col-md-12">

							<div class="table-responsive">
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
	</div>
	</div>
</section>
@stop