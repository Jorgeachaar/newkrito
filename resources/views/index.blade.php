@extends('layouts.base')

@section('head')
    <title>Krito</title>
    <meta name='title' content='Krito'>
    <meta name='description' content='Kontrol'>
    <meta name='keywords' content='palabras, clave'>
    <meta name='robots' content='noindex,nofollow'>
@stop

@section('container')

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  
    <div class="text-center col-md-8 col-md-offset-2">  
        <img src="{{ asset('img/publicity/exxxotica.jpg') }}" class="img-responsive" style="margin-top:100px">
    </div>
</div> --}}
 <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p class="intro-text">Welcome to my official site.
                        <br>
                        <a href="#pics" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="pics" class="content-section text-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="section-heading">Pics</h1>
                    <h2 class="section-subheading text-muted">You`ll find here previews of my newst sets.</h2>
                </div>

                <div class="col-lg-4 col-sm-6 text-center ">
                    <a href="{{ url('/pics/4') }}">
                        <div id="f1_container">
                        <div id="f1_card" class="shadow">
                          <div class="front face">
                            <img src="img/book/exxxo2.png">
                          </div>
                          <div class="back face">
                            <img src="img/book/exxxo1.png">
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <h3>Bs Aires eXXXotica
                            {{-- <small>More...</small> --}}
                        </h3>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6 text-center ">
                    <a href="{{ url('/pics/2') }}">
                        <div id="f1_container">
                        <div id="f1_card" class="shadow">
                          <div class="front face">
                            <img src="img/book/Sets1.png">
                          </div>
                          <div class="back face">
                            <img src="img/book/Sets2.png">
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <h3>Sets
                            {{-- <small>More...</small> --}}
                        </h3>
                    </a>
                </div>
                
                <div class="col-lg-4 col-sm-6 text-center ">
                        <a href="{{ url('/pics/1') }}">
                                <div id="f1_container">
                                <div id="f1_card" class="shadow">
                                  <div class="front face">
                                    <img src="img/book/books1.png">
                                    {{-- <img class="img-circle img-center prueba" src="img/book/1.jpg"/> --}}
                                  </div>
                                  <div class="back face">
                                    <img src="img/book/books2.png">
                                    {{-- <img class="img-circle img-center prueba" src="img/book/1.jpg"/> --}}
                                  </div>
                                </div>
                                </div>
                        </a>
                                        <h3>Book
                        {{-- <small>More...</small> --}}
                    </h3>
                </div>

                <div class="col-lg-4 col-sm-6 text-center ">
                    <a href="{{ url('/pics/3') }}">
                        <div id="f1_container">
                        <div id="f1_card" class="shadow">
                          <div class="front face">
                            <img src="img/book/tattoos1.png">
                          </div>
                          <div class="back face">
                            <img src="img/book/tattoos2.png">
                          </div>
                        </div>
                        </div>
                    </a>
                    <h3>Tatto
                        {{-- <small>More...</small> --}}
                    </h3>
                </div>

            </div>
        </div>
    </section>

    <section id="nonesection" class="content-section text-center">
    </section>

    <!-- About Section -->
    <section id="about" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2 class="section-heading">About Me</h2>
                    <br><br>
                    <div class="col-lg-5">
                        <p class="text-center"><img id="imgabout" class="img-center" src="img/logo.png" alt=""></p>
                    </div>
                    <div id="abouttext" class="col-lg-7">
                        <p>{{ $settings->about }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="content content-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Krito</h2>
                <p>{{ $settings->contact }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            {{-- {!! Form::open(array('action' => 'HomeController@sendMail', 'method' => 'POST', 'id'=>'FormContacto'))!!} --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <div id="success"></div>
                        <button type="submit" class="btn btn-xl">Send Message</button>
                    </div>
                </div>
            {{-- {!! Form::close() !!} --}}
            </div>
        </div>
    </div>
    </section>
@stop

@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            $('#exampleModal').modal({show:true});
        }

    </script>
@stop

