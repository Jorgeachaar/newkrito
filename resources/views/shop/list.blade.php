@extends('layouts.base')

@section('head')
    <title>Krito - Shop</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    <link href="{{ asset('krito/css/shop.css') }}" rel="stylesheet">

@stop

@section('container')
	<section id="albumregister" class="content-section text-center">
		<div class="container">
			<h1 class="page-header">Shop - {{ $category->title }}</h1>
	        <div class="row text-center">
	        	<section id="product">
		        	@foreach ($category->products as $product)
		                <article class="white-panel"> 
		                	@if (count($product->Images)>0)
			                	<img src="{{ asset($product->Images->first()->url_image) }}" alt="">
		                	@endif
							<h1><a href="#">{{$product->title}}</a></h1>
			                <p>${{$product->price}}</p>
			                <p>
			                	<a href="{{route('cart.add', $product->id)}}" class="btn btn-primary">ADD TO CART</a>
			                	<a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-primary">SHOW</a>
			                </p>
						</article>

			        @endforeach
		        </section>
	        </div>
		</div>
		
	</section>
@stop

@section('script')
	<script src="{{ asset('krito/js/pinterest_grid.js') }}"></script>

	<script>

		$(document).ready(function() {
			$('#product').pinterest_grid({
				no_columns: 4,
				padding_x: 10,
				padding_y: 10,
				margin_bottom: 50,
				single_column_breakpoint: 700
			});
		});
		
	</script>	

@stop