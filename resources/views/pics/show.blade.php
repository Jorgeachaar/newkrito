@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>

    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
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
                        
                    @if (count($picCategory->categories()) > 0)
                        <h1>Categorias</h1>
                        <div class="row">
                        @foreach ($picCategory->categories() as $item)
                            <div class="col-lg-4 col-sm-6 text-center ">
                                <a href="{{ route('pic.category', [$item, $item->slug]) }}">
                                        <div id="f1_container">
                                        <div id="f1_card" class="shadow">
                                          <div class="front face">
                                            <img src="{{ asset( $item->url_thumbnail_image) }}"/>
                                          </div>
                                          <div class="back face">
                                            <img src="{{ asset( $item->url_thumbnail_image2) }}"/>
                                          </div>
                                        </div>
                                        </div>
                                </a>
                                <h3>{{ $item->desc }}  <small>More...</small></h3>
                            </div>
                        @endforeach
                        </div>
                    @endif

                    @if (count($picCategory->images) > 0)
                        <h1>Imagenes</h1>
                        <div class="container">
                            <div class="fotorama"
                                 data-width="100%"
                                 data-height="100%"
                                 data-keyboard="true"
                                 data-ratio="16/9"
                                 data-transition="crossfade"
                                 data-allowfullscreen="native"
                                 data-nav="thumbs">
                                @foreach ($picCategory->images as $item)
                                    <div data-img="{{ $item->url_image }}" data-thumb="{{ $item->url_thumbnail_image }}">.</div>
                                @endforeach
                            </div>
                            <p class="text-center"><a href="" class="btn btn-primary btn-fullscreen">Full screen</a></p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> 
    
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            var $fotoramaDiv = $('.fotorama').fotorama();
            var fotorama = $fotoramaDiv.data('fotorama');
            
            $('.btn-fullscreen').on('click', function(event) {
                event.preventDefault();
                fotorama.requestFullScreen();
            }); 

        });
    </script>
@stop