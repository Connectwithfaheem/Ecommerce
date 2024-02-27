<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('dist/assets/modules/summernote/summernote-bs4.css ') }}">


    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#short_desc',


        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>
    <script>
      tinymce.init({
        selector: '#desc',


        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a class="js-arrow" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="@yield('category_select')">
                            <a class="js-arrow" href="{{ route('category') }}">
                                <i class="fas fa-list"></i>Category</a>

                        </li>
                        <li class="@yield('coupons_select')">
                            <a class="js-arrow" href="{{ route('coupons') }}">
                                <i class="fas fa-tag"></i>Coupons</a>

                        </li>
                        <li class="@yield('size_select')">
                            <a class="js-arrow" href="{{ route('size') }}">
                                <i class="fas fa-window-maximize"></i>Size Master</a>

                        </li>
                        <li class="@yield('brand_select')">
                            <a class="js-arrow" href="{{ route('brand') }}">
                                <i class="fas fa-window-maximize"></i>Brand</a>

                        </li>
                        <li class="@yield('color_select')">
                            <a class="js-arrow" href="{{ route('color') }}">
                                <i class="fas fa-paint-brush"></i>Color</a>

                        </li>
                        <li class="@yield('product_select')">
                            <a class="js-arrow" href="{{ route('product') }}">
                                <i class="fa fa-product-hunt"></i></i>Product</a>
                        </li>
                        <li class="@yield('customer_select')">
                            <a class="js-arrow" href="{{ route('customer') }}">
                                <i class="fa fa-user"></i></i>Customer</a>
                        </li>
                        <li class="@yield('HomeBanner_select')">
                            <a class="js-arrow" href="{{ route('HomeBanner') }}">
                                <i class="fas fa-images"></i></i>Home Banner</a>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">

                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a class="js-arrow" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="@yield('category_select')">
                            <a class="js-arrow" href="{{ route('category') }}">
                                <i class="fas fa-list"></i>Category</a>

                        </li>
                        <li class="@yield('category_order')">
                            <a class="js-arrow" href="{{ route('Order') }}">
                                <i class="fas fa-shopping-basket"></i>Oders</a>

                        </li>
                        <li class="@yield('coupons_select')">
                            <a class="js-arrow" href="{{ route('coupons') }}">
                                <i class="fas fa-tag"></i>Coupons</a>

                        </li>
                        <li class="@yield('size_select')">
                            <a class="js-arrow" href="{{ route('size') }}">
                                <i class="fas fa-window-maximize"></i>Size Master</a>

                        </li>
                        <li class="@yield('brand_select')">
                            <a class="js-arrow" href="{{ route('brand') }}">
                                <i class="fas fa-bold"></i>Brand</a>

                        </li>
                        <li class="@yield('color_select')">
                            <a class="js-arrow" href="{{ route('color') }}">
                                <i class="fas fa-paint-brush"></i>Color</a>

                        </li>
                        <li class="@yield('product_select')">
                            <a class="js-arrow" href="{{ route('product') }}">
                                <i class="fa fa-product-hunt"></i></i>Product</a>

                        </li>
                        <li class="@yield('tax_select')">
                            <a class="js-arrow" href="{{ route('tax') }}">
                                <i class="fa fa-percentage"></i></i>Tax</a>
                        </li>
                        <li class="@yield('customer_select')">
                            <a class="js-arrow" href="{{ route('customer') }}">
                                <i class="fa fa-user"></i></i>Customer</a>
                        </li>
                        <li class="@yield('HomeBanner_select')">
                            <a class="js-arrow" href="{{ route('HomeBanner') }}">
                                <i class="fas fa-images"></i></i>Home Banner</a>
                        </li>
                        <li class="@yield('productReview_select')">
                            <a class="js-arrow" href="{{ route('productReview') }}">
                                <i class="fas fa-images"></i>Product Review</a>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin Faheem Ali</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>

                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{ url('admin/logout') }}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @section('container')
                        @show

                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>




   <!-- Jquery JS-->
<script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('dist/assets/modules/summernote/summernote-bs4.js ') }}"></script>
<script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
<!-- end document-->
