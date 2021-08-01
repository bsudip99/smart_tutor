<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Tutor</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- Font awesome -->
    <link href="{{ asset('storage/assets/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('storage/assets/css/bootstrap.css') }}" rel="stylesheet">
    {{-- <link href="{{  asset('storage/assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/slick.css') }}">
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/jquery.fancybox.css') }}" type="text/css"
        media="screen" />
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('storage/assets/css/theme-color/default-theme.css') }}" rel="stylesheet">

    <!-- Main style sheet -->
    <link href="{{ asset('storage/assets/css/style.css') }}" rel="stylesheet">


    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet'
        type='text/css'>

    <!-- jQuery library -->
    <script src="{{ asset('storage/assets/js/jquery.min.js') }}"></script>


</head>

<body>

    <!--START SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- END SCROLL TOP BUTTON -->
    <!-- Start header  -->
    <header id="mu-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mu-header-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="mu-header-top-left">
                                    <div class="mu-top-email">
                                        <i class="fa fa-envelope"></i>
                                        <span>99smart.tutor99@gmail.com</span>
                                    </div>
                                    <div class="mu-top-phone">
                                        <i class="fa fa-phone"></i>
                                        <span>+9779880583039</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                <div class="mu-header-top-right">
                                    <nav>
                                        <ul class="mu-top-social-nav">
                                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                            <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                                            <li><a href="#"><span class="fa fa-youtube"></span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- End header  -->
    @if (Session::get('success'))
        <div class="alert alert-success text-center">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('fail'))
        <div class="alert alert-danger text-center">
            {{ Session::get('fail') }}
        </div>
    @endif
    <!-- Start menu -->
    <section id="mu-menu">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- LOGO -->
                    <!-- TEXT BASED LOGO -->
                    <a class="navbar-brand" href="/"><i class="fa fa-university"></i><span>Smart Tutor</span></a>
                    <!-- IMG BASED LOGO  -->
                    <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                        {{-- <li class="dropdown {{ request()->is('/subject')? 'active': '' }}">
                  <a href="#" class="dropdown-toggle " data-toggle="dropdown">Subject <span class="fa fa-angle-down"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Course 1</a></li>                
                  </ul>
                </li> --}}

                        <li class="{{ request()->is('/tutor') ? 'active' : '' }}"><a href="/tutor/all">Tutors <i
                                    class="fa fa-search"></i> </a></li>
                        @if (!session()->has('name'))
                            <li class="dropdown {{ request()->is('user*') ? 'active' : '' }}">
                                <a href="#" class=" dropdown-toggle " data-toggle="dropdown">Login <span
                                        class="fa fa-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" onclick=" openForm()"> Login</a></li>
                                    <li><a class="{{ request()->is('user/register_page') ? 'active' : '' }}"
                                            href="/user/register_page">New User ? Register</a></li>
                                </ul>
                            </li>


                            {{-- <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li> --}}
                        @endif
                        @if (session()->has('name'))

                            <li class="{{ request()->is('/requests') ? 'active' : '' }}"><a href="/requests">See
                                    Requests <i class="fa fa-check-circle"></i> </a></li>

                                    <li class="{{ request()->is('/allMessage') ? 'active' : '' }}"><a href="/allMessage">
                                        Messages <i class="fa fa-envelope"></i> </a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Welcome, @php
                                        echo Str::upper(Session::all()['table'] . ' ' . Session::all()['name']);
                                    @endphp
                                    <span class="fa fa-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/myProfile" id="profile-link"><i class="fa fa-user"></i>Profile</a>
                                    </li>
                                    <li><a href="/logout"><i class="fa fa-sign-out"></i>LogOut</a></li>

                                </ul>
                            </li>


                        @endif






                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
    </section>
    <!-- End menu -->
    <!-- Start search box -->
    <div id="mu-search">
        <div class="mu-search-area">
            <button class="mu-search-close"><span class="fa fa-close"></span></button>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="mu-search-form">
                            <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End search box -->
    <!-- Login Popup -->
    <div class="form-popup" id="myForm">
        <form action="/user/login" class="form-container" method="POST">
            <h1 class="text-center">Login</h1>
            @csrf
            <label for="email"><b>Login As?</b></label>

            <select class="" name="user" id="select_user">
                <option value-"0">Tutor </option>
                <option value-"1">Student</option>
            </select>


            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email_id" required>


            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br>
            <label><a href="#" onclick="forgot_password();" style="color:blue;">Forgot Your Passord? Click here
                </a></label>
            <br>

            <button type="submit" class="btn">Login</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
    <!-- Login Popup -->

    <style>
        {
            box-sizing: border-box;
        }

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: absolute;
            bottom: 0;
            right: 0;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 400px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=email],
        .form-container input[type=password],
        .form-container select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=email],
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

    </style>

    <script>
      
        function openForm() {

            document.getElementById("myForm").style.display = "block";
            closeRegisterForm();
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function openRegForm() {
            document.getElementById("registerForm").style.display = "block";
            closeForm();
        }

        function closeRegisterForm() {
            document.getElementById("registerForm").style.display = "none";
        }

        function forgot_password(){
            var _token = $("input[name='_token']").val();
            var email_id = $("input[name='email_id']").val();
            var user = $("select[name='user']").val();
            if(!email_id)
            {
              alert("Please Enter Email Address");
            }
            else
            {
              var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              if(!emailReg.test(email_id)){
                alert("Please Enter Valid Email Address");
              }
            }

            
            $.ajax({
                url: "/forgotPass",
                type: 'POST',
                data: {
                    _token: _token,
                    email_id: email_id,
                    user:user,
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                    }
                    else{
                      alert("No Email Sent! Try Again")
                    }
                }
            });

        }

    </script>
