<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', Config::get('app.name'))</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Great+Vibes%7COpen+Sans:400,700%7CRoboto%7CRoboto+Condensed:400,700&display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('css/kube.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    @yield('additional-css')
</head>

<body>
    <div class="restbeef_site_wrapper fadeOnLoad">

        <!-- Header -->
        <div class="restbeef_header_wrapper restbeef_js_bg_image"
            data-background="{{asset('img/dummy/1920x1280.avif')}}">
            <header class="restbeef_main_header">
                <div class="restbeef_header_inner">
                    <div class="restbeef_header_content restbeef_container_wide">
                        <div class="restbeef_logo_part">
                            <div class="restbeef_logo_cont">
                                <a href="{{ URL::route('user.dashboard') }}"
                                    class="restbeef_image_logo restbeef_retina"></a>
                            </div>
                        </div>

                        <div class="restbeef_mobile_menu_part">
                            <a href="javascript:void(0)" class="restbeef_mobile_menu_toggler">
                                <span></span>
                            </a>
                        </div>

                        <div class="restbeef_menu_part">
                            <nav class="restbeef_nav">
                                <ul id="menu-main-menu" class="restbeef_menu">
                                    <li class="menu-item menu-item-has-children">
                                        <a href="{{ URL::route('user.dashboard') }}">Home</a>
                                    </li>
                                </ul><!-- .restbeef_menu -->
                                @if(Auth::check())
                                <a href="{{ route('logout') }}" class="btn_restbeef btn_book_table"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="btn_restbeef btn_book_table">Login</a>
                                @endif

                            </nav><!-- .restbeef_nav -->
                        </div><!-- .restbeef_menu_part -->

                    </div><!-- .restbeef_header_content -->

                </div><!-- .restbeef_header_inner -->
            </header><!-- .restbeef_header -->

            <div class="restbeef_header_title restbeef_container">
                <h1>
                    Food Order System
                </h1>
            </div><!-- .restbeef_header_title -->
        </div><!-- .restbeef_header_wrapper -->

        <!-- Content -->
        @yield('content')

        <!-- Footer Widgets -->
        <div class="restbeef_footer_widgets">
            <!-- Back to Top Button -->
            <a href="#" class="restbeef_back_to_top"><i class="fa fa-chevron-up"></i></a>
            <div class="restbeef_container">
                <div class="row">

                    <div class="col-4 align_center">
                        <div class="widget widget_text">
                            <h2><span class="restbeef_up_title">About Us</span></h2>
                            <div class="textwidget">
                                <p>The Restbeef Steakhouse was est in 1989 in Chicago City. With more than 30 years of
                                    experience and base on traditional recipes, we understand how to best serve our
                                    customers through tried and true service principles.</p>
                            </div><!-- .textwidget -->
                        </div><!-- .widget_text -->
                    </div><!-- .col-4 -->

                    <div class="col-4 align_center">
                        <div class="widget widget_in_touch">
                            <h3 class="restbeef_up_title">Stay in Touch</h3>
                            <div class="restbeef_in_touch">
                                <form class="restbeef_intouch_form" name="restbeef_intouch">
                                    <input type="email" placeholder="Enter Your Email" />
                                    <input type="submit" value="Subscribe" />
                                </form><!-- .restbeef_intouch_form -->
                                <ul class="restbeef_intouch_socials">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                </ul>
                            </div><!-- .restbeef_in_touch -->
                        </div><!-- .widget_text -->
                    </div><!-- .col-4 -->

                    <div class="col-4 align_center">
                        <div class="widget widget_text">
                            <h2><span class="restbeef_up_title">Contacts</span></h2>
                            <div class="textwidget">
                                <p>817 N California Ave Chicago, IL 60622</p>
                                <p>+1 (234) 555 - 67 - 89</p>
                                <p>Everyday from 10am - 11pm</p>
                            </div><!-- .textwidget -->
                        </div><!-- .widget_text -->
                    </div><!-- .col-4 -->

                </div><!-- .row -->
            </div><!-- .restbeef_container -->
        </div><!-- .restbeef_footer_widgets -->

        <!-- Footer -->
        <div class="restbeef_footer restbeef_container_wide">
            <div class="restbeef_copyright">
                &copy; 2024 Food Order System. All Rights Reserved.
            </div><!-- .restbeef_copyright -->
            <div class="restbeef_footer_links">
                <ul class="restbeef_footer_links_list">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Payment Methods</a></li>
                    <li><a href="#">Delivery Information</a></li>
                </ul>
            </div><!-- .restbeef_footer_links -->
        </div><!-- .restbeef_footer -->

    </div><!-- .restbeef_site_wrapper -->

    <!-- JS Files -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/photoswipe.min.js')}}"></script>
    <script src="{{asset('js/photoswipe-ui-default.min.js')}}"></script>

    <script src="{{asset('js/theme.js')}}"></script>
    @yield('additional-scripts')
</body>

</html>