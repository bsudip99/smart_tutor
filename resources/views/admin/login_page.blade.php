<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Smart Tutor Admin</title>

    <link rel="stylesheet" href="{{ asset('storage/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('storage/bootstrap/js/bootstrap.min.js') }}bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('storage/admin/login/css/loginAdmin.css')}}" type="text/css">

</head>
<body>
    {{-- <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">
                                <div class="group"> <label for="user" class="label">Username</label> <input id="user" type="text" class="input" placeholder="Enter your username"> </div>
                                <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Enter your password"> </div>
                                <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                                <div class="group"> <input type="submit" class="button" value="Sign In"> </div>
                                <div class="hr"></div>
                                <div class="foot"> <a href="#">Forgot Password?</a> </div>
                            </div>
                            <div class="sign-up-form">
                                <div class="group"> <label for="user" class="label">Username</label> <input id="user" type="text" class="input" placeholder="Create your Username"> </div>
                                <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Create your password"> </div>
                                <div class="group"> <label for="pass" class="label">Repeat Password</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Repeat your password"> </div>
                                <div class="group"> <label for="pass" class="label">Email Address</label> <input id="pass" type="text" class="input" placeholder="Enter your email address"> </div>
                                <div class="group"> <input type="submit" class="button" value="Sign Up"> </div>
                                <div class="hr"></div>
                                <div class="foot"> <label for="tab-1">Already Member?</label> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="/admin/login" class="box" method="POST">
                       
                        <h1 style="color:#1565c0">Smart Tutor Admin Login</h1>
                        @if (Session::get('success'))
  <div class="alert alert-success text-center">
      {{Session::get('success')}}
  </div>
@endif

@if (Session::get('fail'))
<div class="alert alert-danger text-center">
  {{Session::get('fail')}}
</div>
@endif
                        @csrf
                        {{-- <p class="text-muted" style="color: #27b93a"> Please enter your username and password!</p> --}}
                         <input type="text" name="email_id" placeholder="Email" value={{ old('email_id') }}>
                         <span class="text-danger">@error('email_id'){{  $message }} @enderror </span> 
                          <input type="password" name="password" placeholder="Password">
                          <span class="text-danger">@error('password'){{  $message }} @enderror </span> 
                          {{-- <a class="forgot text-muted" href="#">Forgot password?</a> --}}
                           <input type="submit" name="" value="Login">
                        {{-- <div class="col-md-12">
                            <ul class="social-network social-circle">
                                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                            </ul>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


<script src ="{{  asset('storage/admin/login/js/login_admin.js')}}"></script>
</html>