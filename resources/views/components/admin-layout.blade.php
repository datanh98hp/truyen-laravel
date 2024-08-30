<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        {{-- <meta name="author" content="Hau Nguyen"> --}}
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>Dashboard</title>
        {{-- <x-title title="{{}}"></x-title> --}}
        <!-- Fontfaces CSS-->
        {{-- <script src="assets/ckeditor/ckeditor.js"></script> --}}
        <link href="{{ URL::asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

        <!-- Bootstrap CSS-->
        <link href="{{URL::asset('assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="{{URL::asset('assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet"
            media="all">
        <link href="{{URL::asset('assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
        <link href="{{URL::asset('assets/vendor/vector-map/jqvmap.min.css')}}" rel="stylesheet" media="all">


        <link href="{{URL::asset('assets/css/theme.css')}}" rel="stylesheet" media="all">


        <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
        <style>
            .container_for_img {
                position: relative;
                width: 20%;
            }

            .image {
                display: block;
                width: 100%;
                height: auto;
            }

            .overlay {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                height: 100%;
                width: 100%;
                opacity: 0;
                transition: .5s ease;
                background-color: #34373879;
            }

            .container_for_img:hover .overlay {
                opacity: 1;
            }

            .text {
                color: white;
                font-size: 14px;
                position: absolute;
                top: 35%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                text-align: center;
            }

            .text-for-add {
                color: white;
                font-size: 14px;
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                text-align: center;
            }
        </style>

    </head>

    <body class="animsition">
        <div class="page-wrapper">
            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar2">
                <div class="logo">
                    <a href="{{url('dashboard')}}">
                        <img src="{{URL::asset('assets/images/icon/logo-blue.png')}}" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar1">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="{{URL::asset('assets/images/icon/avatar-big-01.jpg')}}" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="{{ url('signout') }}">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fa fa-briefcase"></i>Danh mục
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{ url('categories') }}">
                                            <i class="fas fa-bars-alt"></i>Danh muc</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('products') }}">
                                            <i class="fas fa-bars-alt"></i>Product List</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('stories') }}">
                                            <i class="fas fa-bars-alt"></i>Truyen</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="request">
                                    <i class="fas fa-chart-bar"></i>Y kien phan hoi</a>
                                {{-- <span class="inbox-num">3</span> --}}
                            </li>
                            <!-- <li>
                                <a href="{{url('order-list')}}">
                                    <i class="fas fa-shopping-basket"></i>Order</a>
                            </li> -->
                            <!-- <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-trophy"></i>Features
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="table.html">
                                            <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                    </li>
                                    <li>
                                        <a href="calendar.html">
                                            <i class="fas fa-calendar-alt"></i>Calendar</a>
                                    </li>
                                    <li>
                                        <a href="map.html">
                                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Pages
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="login.html">
                                            <i class="fas fa-sign-in-alt"></i>Login</a>
                                    </li>
                                    <li>
                                        <a href="register.html">
                                            <i class="fas fa-user"></i>Register</a>
                                    </li>
                                    <li>
                                        <a href="forget-pass.html">
                                            <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-desktop"></i>UI Elements
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="button.html">
                                            <i class="fab fa-flickr"></i>Button</a>
                                    </li>
                                    <li>
                                        <a href="badge.html">
                                            <i class="fas fa-comment-alt"></i>Badges</a>
                                    </li>
                                    <li>
                                        <a href="tab.html">
                                            <i class="far fa-window-maximize"></i>Tabs</a>
                                    </li>
                                    <li>
                                        <a href="card.html">
                                            <i class="far fa-id-card"></i>Cards</a>
                                    </li>
                                    <li>
                                        <a href="alert.html">
                                            <i class="far fa-bell"></i>Alerts</a>
                                    </li>
                                    <li>
                                        <a href="progress-bar.html">
                                            <i class="fas fa-tasks"></i>Progress Bars</a>
                                    </li>
                                    <li>
                                        <a href="modal.html">
                                            <i class="far fa-window-restore"></i>Modals</a>
                                    </li>
                                    <li>
                                        <a href="switch.html">
                                            <i class="fas fa-toggle-on"></i>Switchs</a>
                                    </li>
                                    <li>
                                        <a href="grid.html">
                                            <i class="fas fa-th-large"></i>Grids</a>
                                    </li>
                                    <li>
                                        <a href="fontawesome.html">
                                            <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                    </li>
                                    <li>
                                        <a href="typo.html">
                                            <i class="fas fa-font"></i>Typography</a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fa fa-gear"></i>Setting Page
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="settings-banner">
                                            <i class="fa fa-picture-o"></i>Banner & Picture</a>
                                    </li>
                                    <li>
                                        <a href="settings-inf">
                                            <i class="fa fa-info-circle"></i>Information & Contact</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container2">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop2">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap2">
                                <div class="logo d-block d-lg-none">
                                    <a href="#">
                                        <img src="{{URL::asset('assets/images/icon/logo-blue.png')}}" alt="CoolAdmin" />
                                    </a>
                                </div>
                                <div class="header-button2">

                                    <div class="header-button-item mr-0 js-sidebar-btn">
                                        <i class="zmdi zmdi-menu"></i>
                                    </div>
                                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                                            </div>
                                        </div>

                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ url('signout') }}">
                                                    <i class="zmdi zmdi-logout"></i>Logout</a>
                                            </div>
                                            {{-- <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-pin"></i>Location</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-email"></i>Email</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                {{-- <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                    <div class="logo">
                        <a href="#">
                            <img src="{{URL::asset('assets/images/icon/logo-white.png')}}" alt="Cool Admin" />
                        </a>
                    </div>
                    <div class="menu-sidebar2__content js-scrollbar2">
                        <div class="account2">
                            <div class="image img-cir img-120">
                                <img src="assets/images/icon/avatar-big-01.jpg" alt="John Doe" />
                            </div>
                            <h4 class="name">john doe</h4>
                            <a href="#">Sign out</a>
                        </div>
                        <nav class="navbar-sidebar2">
                            <ul class="list-unstyled navbar__list">
                                <li class="active has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard
                                        <span class="arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="index.html">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                        </li>
                                        <li>
                                            <a href="index2.html">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                        </li>
                                        <li>
                                            <a href="index3.html">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                        </li>
                                        <li>
                                            <a href="index4.html">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="inbox.html">
                                        <i class="fas fa-chart-bar"></i>Inbox</a>
                                    <span class="inbox-num">3</span>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-shopping-basket"></i>eCommerce</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-trophy"></i>Features
                                        <span class="arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="table.html">
                                                <i class="fas fa-table"></i>Tables</a>
                                        </li>
                                        <li>
                                            <a href="form.html">
                                                <i class="far fa-check-square"></i>Forms</a>
                                        </li>
                                        <li>
                                            <a href="calendar.html">
                                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                                        </li>
                                        <li>
                                            <a href="map.html">
                                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-copy"></i>Pages
                                        <span class="arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="login.html">
                                                <i class="fas fa-sign-in-alt"></i>Login</a>
                                        </li>
                                        <li>
                                            <a href="register.html">
                                                <i class="fas fa-user"></i>Register</a>
                                        </li>
                                        <li>
                                            <a href="forget-pass.html">
                                                <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-desktop"></i>UI Elements
                                        <span class="arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="button.html">
                                                <i class="fab fa-flickr"></i>Button</a>
                                        </li>
                                        <li>
                                            <a href="badge.html">
                                                <i class="fas fa-comment-alt"></i>Badges</a>
                                        </li>
                                        <li>
                                            <a href="tab.html">
                                                <i class="far fa-window-maximize"></i>Tabs</a>
                                        </li>
                                        <li>
                                            <a href="card.html">
                                                <i class="far fa-id-card"></i>Cards</a>
                                        </li>
                                        <li>
                                            <a href="alert.html">
                                                <i class="far fa-bell"></i>Alerts</a>
                                        </li>
                                        <li>
                                            <a href="progress-bar.html">
                                                <i class="fas fa-tasks"></i>Progress Bars</a>
                                        </li>
                                        <li>
                                            <a href="modal.html">
                                                <i class="far fa-window-restore"></i>Modals</a>
                                        </li>
                                        <li>
                                            <a href="switch.html">
                                                <i class="fas fa-toggle-on"></i>Switchs</a>
                                        </li>
                                        <li>
                                            <a href="grid.html">
                                                <i class="fas fa-th-large"></i>Grids</a>
                                        </li>
                                        <li>
                                            <a href="fontawesome.html">
                                                <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                        </li>
                                        <li>
                                            <a href="typo.html">
                                                <i class="fas fa-font"></i>Typography</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside> --}}
                <!-- END HEADER DESKTOP-->

                <!-- BREADCRUMB-->
                {{-- <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
                <!-- END BREADCRUMB-->


                {{ $slot }}

                <!-- END PAGE CONTAINER-->

                <section>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    {{-- <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>



        <script></script>

        <!-- Jquery JS-->
        <script src="{{URL::asset('assets/vendor/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap JS-->
        <script src="{{URL::asset('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

        <!-- Vendor JS       -->
        <script src="{{URL::asset('assets/vendor/slick/slick.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/wow/wow.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/animsition/animsition.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/counter-up/jquery.counterup.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/select2/select2.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/vector-map/jquery.vmap.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/vector-map/jquery.vmap.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/vector-map/jquery.vmap.sampledata.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/vector-map/jquery.vmap.world.js')}}"></script>


        <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
        <!-- Main JS-->
        <script src="{{URL::asset('assets/js/main.js')}}"></script>

    </body>

    </html>
    <!-- end document-->

</div>
