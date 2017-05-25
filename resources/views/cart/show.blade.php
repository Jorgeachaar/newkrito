@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    <link href="{{ asset('/css/shop.css') }}" rel="stylesheet">
@stop

@section('container')
	<section class="content-section text-center">

	<div class="container text-center">

		<div class="table-cart">

			<div class="row">
				<div class="page-hader">
					<h1>Shopping Cart</h1>
				</div>
				
			</div>

			<div class="row">
				@if (Cart::count() > 0)
					<hr>			
					<p><a href="{{route('cart.trash')}}" class="btn btn-danger">Clear cart <i class="fa fa-trash"></i></a></p>
					<br>
					<div class="table-responsive">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th>Imagen</th>
									<th>Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>SubTotal</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach (Cart::content() as $item)
									<tr>
										@if (count($item->Images)>0)
											<th><img src="{{ asset('img/products/'.$item->Images->first()->url) }}"></th>
										@else
											<th>No data</th>
										@endif
										<th>{{$item->name}}</th>
										<th>{{number_format($item->price, 2)}}</th>
										<th>
						                    {!! Form::open(array('route' => array('cart.update', $item->rowId), 'method' => 'POST', 'id'=>'destroy-form-'. $item->rowId)) !!}
						                    	<input 
						                    		name='qty'
													type="number"
													min="1"
													max="100"
													value= "{{$item->qty}}"
													id="product_{{$item->rowId}}"
												>
											<a 
						                      	href="{{ route('cart.delete', $item->id) }}" 
						                      	class="btn btn-warning btn-update-item"
						                      	onclick="event.preventDefault();
						                            document.getElementById('destroy-form-{{ $item->rowId }}').submit();"
						                    >
						                      <i class="fa fa-refresh"></i>
						                      
						                    </a>
						                    {{ Form::close() }}
										</th>
										<th>$ {{ $item->total }}</th>
										<th>
											<a href="{{ route('cart.delete', $item->rowId) }}" class="btn btn-danger"><i class="fa fa-remove"></i></a>
										</th>
									</tr>
								@endforeach
							</tbody>
						</table>
						<h3>
							<span class="label label-success">
								TOTAL: $ {{ Cart::total() }}
							</span>
						</h3>
					</div>
					<hr>
					<p>
						<a href="{{ route('cart.detail') }}" class="btn btn-warning">CHECK OUT</a>
					</p>
				@else
					<hr>
					<h3><span class="label label-warning">No data </span></h3>
				@endif
				
			</div>

			
		</div>

	</div>
	</section>
@stop

{{-- @section('script')
<script>
        $(document).ready(function(){


            
            $('.btn-update-item').on('click', function(event) {
            	event.preventDefault();

            	var id = $(this).data('id');
            	var href = $(this).data('href');
            	var quantity = $("#product_" + id).val();

            	window.location.href = href + "/" + quantity;
            });

        });
    </script>
@stop --}}