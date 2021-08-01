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
                                @if ($tutor->email_verify == '0')
                                    Your email is not verified yet! <span class="fa fa-paper-plane"></span><a
                                        href="/sendVerificationMail" class="link-light" style="color:red;">Send verification
                                        mail </a> <br>Note: You will not be shown in tutors list until you are verified by
                                    email and by admin with your legal and academic qualification document
                                @else
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
                                                <form name="form" method="POST" action="/savetutorProfile"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @if ($tutor->status == '1')
                                                        <div class="alert alert-success text-center">
                                                            Congratulations . You are Verified by admin!
                                                        </div>
                                                    @elseif($tutor->status == "0")
                                                        <div class="alert alert-danger text-center">
                                                            You are not verified by admin! Please update all info and documents below properly for admin verification
                                                        </div>
                                                    @endif
                                                    <div class="col-md-5 ">
                                                        <figure class="mu-blog-single-img">
                                                            <a href="#">
                                                                @if ($tutor->pic)
                                                                    <img alt="img"
                                                                        src="{{ asset('storage/assets/img/tutors/') . '/' . $tutor->pic }}"
                                                                        style="height:200px; width:200px;">
                                                                @else
                                                                    <img alt="img"
                                                                        src="{{ asset('storage/assets/img/tutors/User.png') }}"
                                                                        style="height:200px; width:200px;">
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
                                                        <hr>&nbsp;
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="col-md-6 col-sm-6">
                                                                <h4> Citizenship or other legal document </h4>
                                                                @if ($tutor->citizenship_doc)
                                                                    <img src="{{ asset('storage/assets/img/document/citizenship') . '/' . $tutor->citizenship_doc }}"
                                                                        style="height:100px; width:100px;">
                                                                @else
                                                                    <img src="{{ asset('storage/assets/img/document/no_image.png') }}"
                                                                        style="height:100px; width:100px;">
                                                                @endif
                                                            </div>

                                                            <div class="col-md-6 col-sm-6">
                                                                <h4> Highest academic certificate(degree) </h4>
                                                                @if ($tutor->qualification_certificate)
                                                                    <img src="{{ asset('storage/assets/img/document/qualification') . '/' . $tutor->qualification_certificate }}"
                                                                        style="height:100px; width:100px;">
                                                                @else
                                                                    <img src="{{ asset('storage/assets/img/document/no_image.png') }}"
                                                                        style="height:100px; width:100px;">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <p>You need to upload both file for verification and
                                                                    approval </p>
                                                                <input type="button" class="btn btn-primary"
                                                                    value="Upload documents" onclick="upload_document();">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-md-offset-1">

                                                        <div class="mu-blog-description">

                                                            <ul>
                                                                <li>
                                                                    <h3>Name: <input type="text" class="form-control"
                                                                            name="name" value="&nbsp; {{ $tutor->name }}"
                                                                            required> </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Date of Birth: &nbsp; <input type="date"
                                                                            class="form-control" name="dob"
                                                                            value="{{ $tutor->dob }}" required> </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Gender &nbsp;
                                                                        <select class="form-control" name="gender" required>
                                                                            <option value="Male" @if ($tutor->gender == 'Male') selected @endif>Male
                                                                            </option>
                                                                            <option value="Female" @if ($tutor->gender == 'Female') selected @endif>
                                                                                Female</option>
                                                                            <option value="Other" @if ($tutor->gender == 'Other') selected @endif>Other
                                                                            </option>
                                                                        </select>


                                                                    </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Email: &nbsp; <br>{{ $tutor->email_id }}</h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Phone no: &nbsp; <input type="text"
                                                                            class="form-control" name="phone_no"
                                                                            value="{{ $tutor->phone_no }} " required>
                                                                    </h3>
                                                                </li>
                                                                <li>
                                                                    <h3>Address: &nbsp; <input type="text"
                                                                            class="form-control" name="address"
                                                                            value="{{ $tutor->address }}" required> </h3>
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
                                                                        name="biography"
                                                                        placeholder="Add Proper Detail about yourself for more requests"
                                                                        rows="5">{{ $tutor->biography }}</textarea>
                                                                </p>
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h2 style="text-align: center;">Optional</h2>
                                                        <div class="col-md-6">
                                                            <label for="experience"><b>Experience</b></label>
                                                            <select class="form-control" name="experience">
                                                                <option value="none" name="none">None</option>
                                                                <option value="1-3 years" name="1-3 years" @if ($tutor->experience == '1-3 years') selected @endif>1-3 years
                                                                </option>
                                                                <option value="3-5 years" name="3-5 years" @if ($tutor->experience == '3-5 years') selected @endif>3-5 years
                                                                </option>
                                                                <option value="5 years above" name="5 years above" @if ($tutor->experience == '5 years above') selected @endif>5 years
                                                                    above</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="fee"><b>Fee</b></label>
                                                            <input type="text" placeholder="Enter fee per hour(in Rupees)"
                                                                name="fee" id="fee" class="form-control"
                                                                value="{{ $tutor->fee }}" required>
                                                            <span class="text-danger">@error('fee'){{ $message }}
                                                                @enderror </span> <br>

                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="class"><b>Class</b></label>
                                                            <select class="form-control" name="class[]" id="class1"
                                                                onchange="class_select();">
                                                                <option value="none" name="none">None</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}">
                                                                        {{ $class->comment }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6" id="subject_div">
                                                            <label for="class"><b>Subject</b></label>
                                                            <select class="form-control" name="subject[]" id="subject1"
                                                                onchange="subject_select();">
                                                                <option value="none" name="none">None</option>
                                                                @foreach ($subjects as $subject)
                                                                    <option value="{{ $subject->id }}">
                                                                        {{ $subject->subject }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 " id="cstable" @if (!$tutor->subject_ids) style="display:none;" @endif>
                                                            <div class="col-md-6 col-sm-6 col-md-offset-4 col-sm-offset-4">
                                                                <input type="button"
                                                                    value="Delete Selected Class and subject"
                                                                    class="btn btn-danger" onclick="deleteRow('tabledata')">
                                                            </div>
                                                            &nbsp;
                                                            <div class="col-md-12 col-sm-12">
                                                                <table name="subtblclass"
                                                                    class="table table-dark table-bordered table-responsive"
                                                                    id="tabledata">
                                                                    <tr>
                                                                        <td>Select </td>
                                                                        <td>Class</td>
                                                                        <td>Subject</td>
                                                                    </tr>
                                                                    {{ Utilities::break_class_subject($tutor->subject_ids) }}
                                                                </table>
                                                            </div>


                                                        </div>


                                                    </div>
                                                    <br>
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

        function upload_document() {
            window.open("/uploadDocument", "Document Upload Page",
                "toolbar=yes,resizable=yes,top=0,left=0,width=500,height=500");
        }
    </script>

    <script type="text/javascript" src="{{ asset('storage/assets/js/customfunction.js') }}"> </script>



@endsection
