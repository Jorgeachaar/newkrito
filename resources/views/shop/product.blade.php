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
	<section id="" class="content-section text-center">
		<div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if ($product->Images->count() > 0)
                        <img src="{{ asset('img/products/'.$product->Images->first()->url) }}" class="img-responsive fleximg" alt="" id="imgport">
                        <br>
                        @if (count($product->Images)> 1)
                            @foreach ($product->Images as $img)
                                <div class="col-md-3">
                                    <a href="#" class="thumbimg" data-url="{{ asset('img/products/'.$img->url) }}">
                                        <img src="{{ asset('img/products/thumb_'.$img->url) }}" class="img-responsive fleximg" alt="" >
                                    </a>
                                </div>
                            @endforeach                        
                        @endif
                    @endif
                </div>
                <div class="col-md-6 text-left">
                    <h1 class="page-header">{{$product->title}}</h1>
                    <h1>${{$product->price}}</h1>
                    <br>
                    <a class="btn btn-default" href="{{route('cart.add', $product->id)}}"><i class="icon-shopping-cart icon-white"></i>ADD TO CART</a>
                    <hr>
                    <p>{!! $product->description !!}</p>
                </div>
            </div>

		</div>		
	</section>
@stop


@section('script')
    <script src="{{ asset('krito/js/pinterest_grid.js') }}"></script>
    
    <script>

        $(document).ready(function() {

             $('.thumbimg').on('click', function(event) {
                event.preventDefault();

                var url = $(this).data('url');
                $('#imgport').attr('src', url);

            });

        });

    </script>   

@stop