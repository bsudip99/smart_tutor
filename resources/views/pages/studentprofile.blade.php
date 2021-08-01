@extends('layout.app')



@section('content')



    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2>User Profile</h2>
                        <ol class="breadcrumb">
                            <li>
                                @if ($student->email_verify == '0')
                                    Your email is not verified yet! <span class="fa fa-paper-plane"></span><a
                                        href="/sendVerificationMail" class="link-light" style="color:red;">Send verification
                                        mail </a>
                                @elseif ($student->email_verify == "1")
                                    Your Email is verified !
                                @endif

                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb -->
    <section id="mu-course-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-course-content-area">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- start course content container -->
                                <div class="mu-course-container mu-blog-single">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <article class="mu-blog-single-item ">
                                                <form name="form" method="POST" action="/saveStudentProfile"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-md-5 ">
                                                        <figure class="mu-blog-single-img">
                                                            <a href="#">
                                                                @if ($student->pic)
                                                                    <img alt="img"
                                                                        src="{{ asset('storage/assets/img/student/') . '/' . $student->pic }}">
                                                                @else
                                                                    <img alt="img"
                                                                        src="{{ asset('storage/assets/img/student/User.png') }}">
                                                                @endif
                                                            </a>
                                                        </figure>

                                                        <!-- start subject post tags -->
                                                        <div class="mu-blog-tags">
                                                            <ul class="mu-news-single-tagnav">
                                                                <li>Upload New Image <input type="file" class="form-control"
                                                                        name="image"></li> &nbsp;

                                                            </ul>
                                                         
                                                        </div>
                                                        <!-- End subject post tags -->
                                                    </div>

                                                    <div class="col-md-6 col-md-offset-1">

                                                        <div class="mu-blog-description">

                                                            <ul>
                                                                <li>
                                                                    <h3>Name: <input type="text" class="form-control"
                                                                            name="name" value="&nbsp; {{ $student->name }}"
                                                                            required> </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Date of Birth: &nbsp; <input type="date"
                                                                            class="form-control" name="dob"
                                                                            value="{{ $student->dob }}" required> </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Gender &nbsp;
                                                                        <select class="form-control" name="gender" required>
                                                                            <option value="Male" @if ($student->gender == 'Male') selected @endif>Male
                                                                            </option>
                                                                            <option value="Female" @if ($student->gender == 'Female') selected @endif>
                                                                                Female</option>
                                                                            <option value="Other" @if ($student->gender == 'Other') selected @endif>Other
                                                                            </option>
                                                                        </select>


                                                                    </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Email: &nbsp; <br>{{ $student->email_id }}</h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Phone no: &nbsp; <input type="text"
                                                                            class="form-control" name="phone_no"
                                                                            value="{{ $student->phone_no }} " required>
                                                                    </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Address: &nbsp; <input type="text"
                                                                            class="form-control" name="address"
                                                                            value="{{ $student->address }}" required> </h3>
                                                                </li>

                                                                <li>
                                                                    <h3><input type="button" id="changePass"
                                                                            value="Change Password?  Click Here!"
                                                                            onclick="change_password();"></input> </h3>
                                                                    <input type="password" class="form-control"
                                                                        name="password" id="password"
                                                                        placeholder="New password" style="display: none;">
                                                                </li>

                                                            </ul>
                                                            <blockquote>
                                                                <p>Biography: &nbsp; <textarea class="form-control"
                                                                        name="biography"> {{ $student->biography }} </textarea>
                                                                </p>
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-5">
                                                        <input type="submit" class="btn btn-primary" name="save_changes"
                                                        value="Save Profile">
                                                    </div>


                                                </form>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                <!-- end course content container -->





                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function change_password() {
            var element = document.getElementById("password");
            if (element.style.display == "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>



@endsection
