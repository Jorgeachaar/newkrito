@extends('layouts.base')

@section('head')
    <title>Krito - videos</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Krito'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
    {{-- <link href="{{ asset('/css/fotorama.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('/css/prueba.css') }}" rel="stylesheet">
@stop


@section('container')
<section id="download" class="content-section">
        <div class="download-section">

            <div class="container">
                <div class="fotorama"
                     data-width="100%"
                     data-height="100%"
                     data-keyboard="true"
                     data-ratio="16/9"
                     data-transition="crossfade"
                     data-allowfullscreen="native"
                     data-nav="thumbs">

                       
                        @foreach ($videos as $video)
                            <a href="{{ $video->url }}">{{ $video->title }}</a>
                        @endforeach

                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
@stop