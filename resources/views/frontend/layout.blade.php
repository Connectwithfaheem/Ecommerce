<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Font awesome -->
    <link href="{{ asset('frontend_asset/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('frontend_asset/css/bootstrap.css') }}" rel="stylesheet">

    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ asset('frontend_asset/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_asset/css/jquery.simpleLens.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_asset/css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_asset/css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('frontend_asset/css/theme-color/default-theme.css') }}" rel="stylesheet">
    <!-- <link id="switcher" href="{{ asset('frontend_asset/css/theme-color/bridge-theme.css') }}" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ asset('frontend_asset/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="{{ asset('frontend_asset/css/style.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="{{ asset('frontend_asset/js/html5shiv.min.js') }}"></script>
      <script src="{{ asset('frontend_asset/js/respond.min.js') }}"></script>
    <![endif]-->
    <script>
        var PRODUCT_IMAGE="{{asset('ProductImage/')}}";
        </script>

</head>
  <body>
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div>
    <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <img src="{{ asset('frontend_asset/img/flag/english.jpg') }}" alt="english flag">ENGLISH
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><img src="{{ asset('frontend_asset/img/flag/french.jpg')}}" alt="">FRENCH</a></li>
                      <li><a href="#"><img src="{{ asset('frontend_asset/img/flag/english.jpg') }}" alt="">ENGLISH</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-usd"></i>USD
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                      <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>00-62-658-658</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li class="hidden-xs"><a href="{{ route('checkout') }}">Checkout</a></li>
                  @if (session()->has('FRONT_USER_LOGIN')!=null)
                  <li><a href="{{ route('my_order') }}">My Orders</a></li>
                  <li class="hidden-xs"><a href="{{ route('cart') }}">My Cart</a></li>
                  <li><a href="{{ url('logout') }}" data-toggle="modal" >Logout</a></li>
                  @else
                  <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>

                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{ url('/') }}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="i#"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
               @php
              $getAddToCartTotalItem=getAddToCartTotalItem();
              $totalCartItem=count($getAddToCartTotalItem);
              $totalPrice=0;
              @endphp
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#" id="cartBox">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">{{$totalCartItem}}</span>
                </a>
                <div class="aa-cartbox-summary">
               @if($totalCartItem>0)

                  <ul>
                    @foreach($getAddToCartTotalItem as $cartItem)

                    @php
                    $totalPrice=$totalPrice+($cartItem->qty*$cartItem->price)
                    @endphp
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{asset('ProductImage/'.$cartItem->image)}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">{{$cartItem->name}}</a></h4>
                        <p>{{$cartItem->qty}} * Rs {{$cartItem->price}}</p>
                      </div>
                    </li>
                    @endforeach
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Rs {{$totalPrice}}
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{ route('cart') }}">Cart</a>

                @endif
                </div>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="">
                  <input type="text" name="search" id="search"  placeholder="Search here ex. 'man' ">
                  <button type="button" onclick="funSearch()"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->

            {!! getTopNav() !!}
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  </section>
  <!-- / menu -->
  @section('container');
  @show
     <!-- Subscribe section -->
     <section id="aa-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-subscribe-area">
                        <h3>Subscribe our newsletter </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                        <form action="" class="aa-subscribe-form">
                            <input type="email" name="" id="" placeholder="Enter your Email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Subscribe section -->
  <!-- footer -->
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Our Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> 25 Astor Pl, NY 10003, USA</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
    @php
        if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
            $login_email=$_COOKIE['login_email'];
            $login_password=$_COOKIE['login_pwd'];
            $is_remmember = "checked='checked'";
        }
        else {
            $login_email= '';
            $login_password= '';
            $is_remmember = "";

        }
    @endphp
  <!-- Login Modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <div id="popup_login">
                        <h4>Login or Register</h4>
                        <form class="aa-login-form" action="" id="frmLogin">
                            @csrf
                            <label for="">Email address<span>*</span></label>
                            <input type="text" placeholder="Email" name="login_email"
                                value="{{ $login_email }}" required>
                            <label for="">Password<span>*</span></label>
                            <input type="password" name="login_password" value="{{ $login_password }}"
                                placeholder="Password" required>
                            <button class="aa-browse-btn" id="btnLogin" type="submit">Login</button>
                            <label for="rememberme" class="rememberme"><input type="checkbox"
                                    value="{{ $is_remmember }}" name="rememberme" id="rememberme"> Remember me
                            </label>

                            <div id="login_error"></div>
                            <p class="aa-lost-password"><a href="javascript:void(0)" onclick="forget_password()">Lost your password?</a></p>
                            <div class="aa-register-now">
                                Don't have an account?<a href="{{ route('registration') }}">Register now!</a>
                            </div>
                        </form>
                    </div>

                    <div id="popup_forget" style="display: none">
                        <h4>Forget Password</h4>
                        <form class="aa-login-form" action="" id="frmForget">
                            @csrf
                            <label for="">Email address<span>*</span></label>
                            <input type="text" placeholder="Email" name="forget_email"
                                 required>
                                 <div style="color: red" id="forget_error"></div><br/>
                            <button class="aa-browse-btn btn-submit" id="btnForget" type="submit">Submit</button><br><br>
                            <div class="aa-register-now">
                                Login Form?<a href="javascript:void(0)" onclick="show_login_popup()">Login now!</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('frontend_asset/js/bootstrap.js') }}"></script>
<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="{{ asset('frontend_asset/js/jquery.smartmenus.js') }}"></script>
<!-- SmartMenus jQuery Bootstrap Addon -->
<script type="text/javascript" src="{{ asset('frontend_asset/js/jquery.smartmenus.bootstrap.js') }}"></script>
<!-- To Slider JS -->
<script src="{{ asset('frontend_asset/js/sequence.js') }}"></script>
<script src="{{ asset('frontend_asset/js/sequence-theme.modern-slide-in.js') }}"></script>
<!-- Product view slider -->
<script type="text/javascript" src="{{ asset('frontend_asset/js/jquery.simpleGallery.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend_asset/js/jquery.simpleLens.js') }}"></script>
<!-- slick slider -->
<script type="text/javascript" src="{{ asset('frontend_asset/js/slick.js') }}"></script>
<!-- Price picker slider -->
<script type="text/javascript" src="{{ asset('frontend_asset/js/nouislider.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('frontend_asset/js/custom.js') }}"></script>

  </body>
</html>
