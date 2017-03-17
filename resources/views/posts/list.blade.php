@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <title>{{ config('blog.title') }}</title>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
@stop

@section('container')
    <section id="download" class="content-section text-center">
        <div class="container">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Krito
                        <strong>blog</strong>
                    </h2>
                    <hr>
                </div>

                @foreach ($posts as $post)
                    <div class="col-lg-12 text-center">
                        @if (count($post->images)> 0)
                            <img class="img-responsive img-border img-full" src="{{asset('img/posts/thumb_'.$post->images->first()->url)}}" alt="">
                        @endif
                        <h2>{{ $post->title }}
                            <br>
                            <small>{{ $post->created_at->format('M jS Y') }}</small>
                        </h2>
                        <p>{!! str_limit($post->content, 400) !!}</p>
                        {{-- <a href="{{ route('posts.show', [$post->id, $post->slug]) }}" class="btn btn-default btn-lg">Read More</a> --}}
                        <a href="{{ route('posts.show', [$post->id, $post->slug]) }}" class="btn btn-default btn-lg">Read More</a>
                        <hr>
                    </div>
                @endforeach                
                {!! $posts->render() !!}
                
            </div>
        </div>
    </section> 
@stop