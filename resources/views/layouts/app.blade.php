<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Yashadmin:Sales Management System Admin Bootstrap 5 Template">
    <meta property="og:title" content="Yashadmin:Sales Management System Admin Bootstrap 5 Template">
    <meta property="og:description" content="Yashadmin:Sales Management System Admin Bootstrap 5 Template">
    <meta property="og:image" content="https:/yashadmin.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- PAGE TITLE HERE -->
    <title>Dashboard</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/select2/css/select2.min.css">
    <link href="{{ asset('') }}assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- tagify-css -->

    <!-- Style css -->
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet">

</head>


<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="light"
    data-headerbg="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div>
            <img src="images/pre.gif" alt="">
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img src="{{asset('assets/images/logo/iconsinta.png')}}" class="brand-title">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.7468 5.58925C11.0722 5.26381 11.0722 4.73617 10.7468 4.41073C10.4213 4.0853 9.89369 4.0853 9.56826 4.41073L4.56826 9.41073C4.25277 9.72622 4.24174 10.2342 4.54322 10.5631L9.12655 15.5631C9.43754 15.9024 9.96468 15.9253 10.3039 15.6143C10.6432 15.3033 10.6661 14.7762 10.3551 14.4369L6.31096 10.0251L10.7468 5.58925Z"
                                fill="#452B90" />
                            <path opacity="0.3"
                                d="M16.5801 5.58924C16.9056 5.26381 16.9056 4.73617 16.5801 4.41073C16.2547 4.0853 15.727 4.0853 15.4016 4.41073L10.4016 9.41073C10.0861 9.72622 10.0751 10.2342 10.3766 10.5631L14.9599 15.5631C15.2709 15.9024 15.798 15.9253 16.1373 15.6143C16.4766 15.3033 16.4995 14.7762 16.1885 14.4369L12.1443 10.0251L16.5801 5.58924Z"
                                fill="#452B90" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>


        <div class="header bg-white">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>
                        <div class="header-right d-flex align-items-center">
                            <div class="input-group search-area">
                            </div>
                            <div class="ml-auto">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="menu-title">Dashboard</li>
                    <li>
                        <a class="" href="{{route('data-inventaris.index')}}" aria-expanded="false">
                            <div class="menu-icon">
                                <!-- Icon: Box (Bootstrap Icons) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8.21 1.094a1 1 0 0 0-.42 0l-6 1.5A1 1 0 0 0 1 3.53v7.94a1 1 0 0 0 .79.976l6 1.5a1 1 0 0 0 .42 0l6-1.5A1 1 0 0 0 15 11.47V3.53a1 1 0 0 0-.79-.976l-6-1.5zM8 2.197 13.5 3.53 8 4.863 2.5 3.53 8 2.197zm6 9.273-6 1.5V5.863l6-1.5v7.107zm-13-7.107 6 1.5v7.107l-6-1.5V4.363z"
                                        fill="#90959F" />
                                </svg>
                            </div>
                            <span class="nav-text">Data Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{route('work-order.index')}}" aria-expanded="false">
                            <div class="menu-icon">
                                <!-- Icon: Clipboard Check (Bootstrap Icons) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M10.854 8.146a.5.5 0 0 0-.708.708L11.293 10l-2.147 2.146a.5.5 0 0 0 .708.708l2.5-2.5a.5.5 0 0 0 0-.708l-2.5-2.5z"
                                        fill="#90959F" />
                                    <path
                                        d="M4 1.5A1.5 1.5 0 0 1 5.5 0h5A1.5 1.5 0 0 1 12 1.5V2h1.5A1.5 1.5 0 0 1 15 3.5v10A1.5 1.5 0 0 1 13.5 15h-11A1.5 1.5 0 0 1 1 13.5v-10A1.5 1.5 0 0 1 2.5 2H4v-.5zm1.5-.5a.5.5 0 0 0-.5.5V2h7v-.5a.5.5 0 0 0-.5-.5h-5zM2.5 3A.5.5 0 0 0 2 3.5v10a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5h-11z"
                                        fill="#90959F" />
                                </svg>
                            </div>
                            <span class="nav-text">Work Order</span>
                        </a>
                    </li>
                    <li class="menu-title">Data Master</li>
                    <li>
                        <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <div class="menu-icon">
                                <!-- Icon: Database (Bootstrap Icons) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 16 16">
                                    <ellipse cx="8" cy="4" rx="6" ry="2" fill="#90959F" />
                                    <path d="M2 4v8c0 1.104 2.686 2 6 2s6-.896 6-2V4" fill="none" stroke="#90959F"
                                        stroke-width="1" />
                                    <ellipse cx="8" cy="12" rx="6" ry="2" fill="none" stroke="#90959F"
                                        stroke-width="1" />
                                </svg>
                            </div>
                            <span class="nav-text">Data Master</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('master-item.index')}}">Item</a></li>
                            <li><a href="{{route('master-merk.index')}}">Merk</a></li>
                            <li><a href="{{route('master-dept.index')}}">Dept / Unit</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Manajemen User</li>
                    <li>
                        <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <div class="menu-icon">
                                <!-- Icon: People (Bootstrap Icons) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 7A2.5 2.5 0 1 0 5.5 2a2.5 2.5 0 0 0 0 5zm5 0A2.5 2.5 0 1 0 10.5 2a2.5 2.5 0 0 0 0 5zM5.5 8C3.567 8 0 8.933 0 10.5V13h11v-2.5C11 8.933 7.433 8 5.5 8zm5 0c-.168 0-.335.006-.5.017V13h5v-2.5C15 8.933 11.433 8 10.5 8z"
                                        fill="#90959F" />
                                </svg>
                            </div>
                            <span class="nav-text">Manajemen User</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('users.index')}}">Data Pengguna</a></li>
                            <li><a href="{{route('master-rs.index')}}">Master Rumah Sakit</a></li>
                            <li><a href="{{route('roles.index')}}">Role</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="copyright">
            <p>Copyright © Developed by <a href="" target="_blank">DexignZone</a> 2023</p>
        </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('') }}assets/vendor/global/global.min.js"></script>
    <script src="{{ asset('') }}assets/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('') }}assets/vendor/apexchart/apexchart.js"></script>

    <script src="{{ asset('') }}assets/vendor/peity/jquery.peity.min.js"></script>
    <!-- Dashboard 1 -->
    <script src="{{ asset('') }}assets/js/dashboard/dashboard-2.js"></script>



    <script src="{{ asset('') }}assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/js/plugins-init/datatables.init.js"></script>

    <script src="{{ asset('') }}assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/vendor/datatables/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}assets/vendor/datatables/js/jszip.min.js"></script>

    <script src="{{ asset('') }}assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('') }}assets/js/plugins-init/select2-init.js"></script>

    <!-- Apex Chart -->




    <!-- Vectormap -->

    <script src="{{ asset('') }}assets/js/custom.js"></script>
    <script src="{{ asset('') }}assets/js/deznav-init.js"></script>
    <script src="{{ asset('') }}assets/js/demo.js"></script>
    <script src="{{ asset('') }}assets/js/styleSwitcher.js"></script>
    <script>
        feather.replace(); // aktifkan ikon feather
    </script>


</body>

</html>
@stack('scripts')