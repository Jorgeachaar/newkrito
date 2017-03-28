@extends('layout.basek')

@section('head')
    <title>Krito - Shop</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    <link href="{{ asset('/css/shop.css') }}" rel="stylesheet">

@stop

@section('container')
	<section id="" class="content-section text-center">
		<div class="container">
			<h1 class="page-header">Shop</h1>

	        <div class="row">
	        	@foreach ($categories as $category)
                    <div class="col-lg-4 col-sm-6 text-center ">
                        <a href="{{ route('viewCategory', $category->id) }}">
                            <div id="f1_container">
                            <div id="f1_card" class="shadow">
                              <div class="front face">
                                <img src="{{ $category->urlimg }}">
                              </div>
                              <div class="back face">
                                <img src="{{ $category->urlimg2 }}">
                              </div>
                            </div>
                            </div>
                        </a>
                        <h3>{{$category->desc}}</h3>                   
                    </div>
                @endforeach
            </div>
	        
		</div>

		
	</section>
@stop