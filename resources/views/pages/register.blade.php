@extends('layout.app')



@section('content')



    <!-- Start our teacher -->
    <section>
        <div class="container_form">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <!-- begain title -->

                    {{-- <h2>Register</h2> --}}


                    <!-- end title -->
                    <form action="/user/register" method="POST" onsubmit="return checkPasswordMatch() ">
                        <div class="container_form">
                            <h1>Register</h1>
                            <hr>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="user"><b>User</b></label>
                                    <select class="" name="user" id="userchange" onchange="tutor_dist()">
                                        <option value="0" name="tutor">Tutor</option>
                                        <option value="1" name="student">Student</option>
                                    </select>

                                    <label for="name"><b>Name</b></label>
                                    <input type="text" placeholder="Enter Name" name="name" id="name" value="{{ old('name') }}" required>
                                    <span class="text-danger">@error('name'){{ $message }} @enderror </span> <br>

                                    <label for="phone_no"><b>Phone No.</b></label>
                                    <input type="text" placeholder="Enter Phone" name="phone_no" id="phone_no" value="{{ old('phone_no') }}" pattern="[1-9]{1}[0-9]{9}" title="Enter Valid phone number of 10 digits" required>
                                    <span class="text-danger">@error('phone_no'){{ $message }} @enderror </span> <br>

                                    <label for="date"><b>Date of Birth</b></label>
                                    <input type="date" placeholder="Enter DOB" name="dob" id="dob" value="{{ old('dob') }}" required>
                                    <span class="text-danger">@error('dob'){{ $message }} @enderror </span> <br>

                                </div>
                                <div class="col-md-6">
                                    <label for="gender"><b>Gender</b></label>
                                    <select class="" name="gender">
                                        <option value="Male" name="male">Male</option>
                                        <option value="Female" name="female">Female</option>
                                        <option value="Other" name="others">Others</option>
                                    </select>

                                    <label for="address"><b>Address</b></label>
                                    <input type="text" placeholder="Enter Address" name="address" id="address" value="{{ old('address') }}" required>
                                    <span class="text-danger">@error('address'){{ $message }} @enderror </span> <br>


                                    <label for="email"><b>Email</b></label>
                                    <input type="email" placeholder="Enter Email" name="email_id" id="email_id" value="{{ old('email_id') }}" required>
                                    <span class="text-danger">@error('email_id'){{ $message }} @enderror </span> <br>

                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="password" id="password" value="{{ old('password') }}"
                                        required>
                                    <span class="text-danger">@error('password'){{ $message }} @enderror </span> <br>

                                    <label for="psw-repeat"><b>Repeat Password</b></label>
                                    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" value="{{ old('psw-repeat') }}"
                                        required>
                                    <span class="text-danger">@error('psw-repeat'){{ $message }} @enderror </span> <br>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="tutor_part">
                                <h2 style="text-align: center;">Optional</h2>
                                <div class="col-md-6">
                                    <label for="experience"><b>Experience</b></label>
                                    <select class="" name="experience">
                                        <option value="none" name="none">None</option>
                                        <option value="1-3 years" name="1-3 years">1-3 years</option>
                                        <option value="3-5 years" name="3-5 years">3-5 years</option>
                                        <option value="5 years above" name="5 years above">5 years above</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="fee"><b>Fee</b></label>
                                    <input type="text" placeholder="Enter fee per hour(in Rupees)" name="fee" id="fee" value="{{ old('fee') }}">
                                    <span class="text-danger">@error('fee'){{ $message }} @enderror </span> <br>

                                </div>

                                <div class="col-md-6">
                                    <label for="class"><b>Class</b></label>
                                    <select class="" name="class[]" id="class1" onchange="class_select();">
                                        <option value="none" name="none">None</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->comment }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6" id="subject_div" style="display:none;">
                                    <label for="class"><b>Subject</b></label>
                                    <select class="" name="subject[]" id="subject1" onchange="subject_select();">
                                        <option value="none" name="none">None</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subject }} </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-12 col-sm-12 " id="cstable" style="display:none;">
                                    <div class="col-md-6 col-sm-6 col-md-offset-4 col-sm-offset-4">
                                        <input type="button" value="Delete Selected Class and subject"
                                            class="btn btn-danger" onclick="deleteRow('tabledata')" />
                                    </div>
                                    &nbsp;
                                    <div class="col-md-12 col-sm-12">
                                        <table name="subtblclass" class="table table-dark table-bordered table-responsive" id="tabledata">
                                            <tr>
                                                <td>Select</td>
                                                <td>Class</td>
                                                <td>Subject</td>
                                            </tr>

                                        </table>
                                    </div>


                                </div>


                            </div>


                            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                            <button type="submit" class="registerbtn">Register</button>
                        </div>

                        <div class="container_form signin">
                            <p>Already have an account? <a href="#" onclick="openForm()">Sign in</a>.</p>
                        </div>
                    </form>




                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
    </section>
    <!-- End our teacher -->
    <style>
        * {
            box-sizing: border-box
        }

        /* Add padding to containers */
        .container_form {
            padding: 0;
        }
        /* Full-width input fields */
        input[type=text],
        input[type=password],
        input[type=email],
        input[type=date],
        input[type=number],
        select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=date]:focus,
        select:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit/register button */
        .registerbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }

    </style>
  <script type="text/javascript" src="{{ asset('storage/assets/js/customfunction.js')}}"> </script>
    

@endsection
