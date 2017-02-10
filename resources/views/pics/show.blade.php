@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    <link href="{{ asset('/css/prueba.css') }}" rel="stylesheet">
@stop

@section('container')
<section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="section-heading">{{$picCategory->title}}</h1>
                    </div>

                    {{-- @foreach ($picCategory->albums()->orderBy('position', 'ASC')->get() as $item)
						<div class="col-lg-4 col-sm-6 text-center ">
	                            <a href="{{url('/images/'. $item->id)}}">
	                                    <div id="f1_container">
	                                    <div id="f1_card" class="shadow">
	                                      <div class="front face">
                                            <img src="{{ asset( $item->imgurl) }}"/>
                                          </div>
                                          <div class="back face">
	                                        <img src="{{ asset( $item->imgurl2) }}"/>
	                                      </div>
	                                    </div>
	                                    </div>
	                            </a>
								<h3>{{ $item->desc }}  <small>More...</small></h3>
	                    </div>
                    @endforeach
                    @if (count($picCategory->albums()->get()) < 1)
                        <h1>Coming soon!!!</h1>
                    @endif --}}
  

                    
                </div>
            </div>
        </div>
    </section>
@stop