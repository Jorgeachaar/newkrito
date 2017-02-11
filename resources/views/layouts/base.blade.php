
<?php 
    $cart = \Session::get('cart');
    $cartCount = count($cart);
 ?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
        <link href='{{ asset("krito/img/favicon.png") }}' rel='shortcut icon' type='image/png'>
        <!-- FONTS -->
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>

        <title>Krito</title>
        <link href="{{ asset('krito/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('krito/css/grayscale.css') }}" rel="stylesheet">
		<link href="{{ asset('krito/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		@yield('head')

	</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php
$classcheck ="classcheck";
if (Auth::check()) $classcheck ="";
?>

    @if(Session::has('message'))
        <div class="box-alert">
            <div id="myAlert" class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Note!</strong> {{Session::get('message')}} <br>
            </div>
        </div>
    @endif

    @if(Session::has('messageModal'))
        <div id="messageModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="mySmallModalLabel">Krito</h4>
                </div>
                <div class="modal-body">
                  <strong>Note!</strong> {{Session::get('messageModal')}} <br>
                </div>
              </div>
            </div>
          </div>
    @endif

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    Krito
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="dropdown">
                        <a class="page-scroll" href="#pics">Pics</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Videos<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/videos/free') }}">Free videos</a></li>
                            @if (Auth::check())
                                <li><a href="{{ url('/videos/private') }}">Private videos</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a class="" href="{{ url('blog')}}">Blog</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="" href="{{ url('shopp') }}">Shop</a>
                    </li>
                    <li>
                        <a class="" href="{{ $settings->wishlist }}" target="_blank">Wishlist</a>
                    </li>
                    <?php if (!Auth::check()){ ?>
                    <li>
                        <a href="{{ route('login') }}" id="verbtnLogin" ><span class="fa fa-user fa-1x"></span> Members</a><!-- data-toggle="modal" data-target="#exampleModal" -->
                    </li>
                    <?php } else {?>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-user fa-1x"></span>  {{Auth::user()->name}} <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('password.change') }}"><span class="fa fa-refresh">Change password</span></a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="fa fa-user-times"></span>
                                            Logout
                                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <?php if (Auth::user()->isAdmin()){ ?>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('admin') }}">administracion</a></li>
                                <?php } ?>
                              </ul>
                        </li>


                    <?php } ?>
                    {{-- <li role="presentation"><a href="{{ route('cart-show')}}"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">{{$cartCount}}</span></a></li> --}}
                    <li role="presentation"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge">{{$cartCount}}</span></a></li>
                </ul>
            </div>
        </div>
    </nav>

@yield('container')
{{-- <img src="{{ asset('img/publicity/exxxotica.jpg') }}" style="width:100%"> --}}
<footer class="footer-2 bg-dark">
            <div class="container">
                <hr>
                <div class="row">
                    <div class="col-md-7">

                        <h2 class="script">Thank's for visiting!</h2>
                        <p class="small">Copyright &copy; 2015 Krito. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-5">
                        <h3 class="script">Find me!</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="{{ $settings->facebook }}" class="btn btn-social-light btn-facebook" target="_blank"><i class="fa fa-fw fa-facebook fa-2x"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings->twitter }}" class="btn btn-social-light btn-twitter" target="_blank"><i class="fa fa-fw fa-twitter fa-2x"></i></a>
                            </li>
                            <li>
                                <a href="{{ $settings->instagram }}" class="btn btn-social-light btn-dribbble" target="_blank"><i class="fa fa-fw fa-instagram fa-2x"></i></a>
                            </li>
                        </ul>
                        <br>
                    </div>
                </div>
            </div>
        </footer>

    <!-- jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('krito/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('krito/js/grayscale.js') }}"></script>


    @yield('script')
    <script>
        $(document).ready(function(){

            function ViewLogin (argument) {
                $.ajax(
                    {
                        url: "login",
                        type: "GET",
                        data: { name: "John", location: 'argument' },
                        success: function(result){
                            $("#exampleModal").html(result);
                            $("#exampleModal").modal('show');
                        }
                    });
            }

            $("#btnLogin").click(function(){
                ViewLogin();
                return false;
            });

            $(".classcheck").click(function(){
                ViewLogin();
                return false;
            });

        });
    </script>

    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=252088144995608&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>


</body>

</html>
