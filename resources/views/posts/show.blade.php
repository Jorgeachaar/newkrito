@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <title>{{ config('blog.title') }}</title>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
    
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
          rel="stylesheet"> --}}
@stop

@section('container')
<section id="view-post" class="content-section text-center">
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="container">
                    <h1>{{ $post->title }}</h1>
                    <h5>{{ $post->created_at->format('M jS Y') }}</h5>
                    @if (count($post->images)> 0)
                        <div id="carousel-example-generic" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators hidden-xs">                                
                                @for ($i = 0; $i < count($post->images) ; $i++)
                                    @if ($i == 0)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i+1 }}" class="active"></li>
                                    @else
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i+1 }}"></li>
                                    @endif
                                @endfor
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach ($post->images as $image)
                                    @if ($loop->first)
                                        <div class="item active">
                                            <img class="img-responsive img-full" src="{{asset($image->url_image)}}" alt="">
                                        </div>
                                    @else
                                        <div class="item">
                                            <img class="img-responsive img-full" src="{{asset($image->url_image)}}" alt="">
                                        </div>
                                    @endif

                                @endforeach
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                    @endif
                    {{-- <hr>{!! nl2br(e($post->content)) !!}<hr> --}}
                    <hr>{!! $post->content !!}<hr>
                    <button class="btn btn-primary" onclick="history.go(-1)">« Back</button>
                </div>
            </div>
        </div>
    </div>
    
</section>
@stop  

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 3000 //changes the speed
            })
        }); 
    </script>
@stop
