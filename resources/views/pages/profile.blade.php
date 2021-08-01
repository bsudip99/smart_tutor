@extends('layout.app')



@section('content')



    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2>User Profile</h2>
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
                                                <div class="col-md-4 ">
                                                    <figure class="mu-blog-single-img">
                                                        <a href="#">
                                                            @if ($tutor->pic)
                                                                <img alt="img"
                                                                    src="{{ asset('storage/assets/img/tutors/') . '/' . $tutor->pic }}">
                                                            @else
                                                                <img alt="img"
                                                                    src="{{ asset('storage/assets/img/tutors/User.png') }}">
                                                            @endif
                                                        </a>
                                                    </figure>
                                                    &nbsp;
                                                    <div class="col-md-12">
                                                        @if (session()->has('name'))
                                                            @if (Str::lower(Session::all()['table']) == 'student')

                                                                @php  $stu_ver= Utilities::student_email_ver(Session::all()['id'])  @endphp
                                                                @if ($stu_ver)
                                                                   <button type="button" class="btn btn-primary"
                                                                        data-toggle="modal" data-target="#requestModal">
                                                                        Send Hire request &nbsp;<span
                                                                            class="fa fa-paper-plane"></span>
                                                                    </button>
                                                                @else
                                                                    <a href="/student/myprofile"> Please <a href="/student/myprofile" style="color:red;">VERIFY </a> your mail to Send Request to
                                                                        this tutor </a>
                                                                @endif
                                                            @endif




                                                        @else
                                                            <a href="#"> Please <a href="#" onclick=" openForm()"
                                                                    style="color:red;">login </a> to Send Request to this
                                                                tutor </a>
                                                        @endif


                                                    </div>

                                                    <div class="col-md-12">
                                                        <blockquote>
                                                            <p>Biography: &nbsp; {{ $tutor->biography }}</p>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-1">

                                                    <div class="mu-blog-description">

                                                        <ul>
                                                            <li>
                                                                <h3>Name: &nbsp; {{ $tutor->name }} </h3>
                                                            </li>
                                                            <li>
                                                                <h3>Date of Birth: &nbsp; {{ $tutor->dob }} </h3>
                                                            </li>
                                                            <li>
                                                                <h3>Gender: &nbsp; {{ $tutor->gender }}</h3>
                                                            </li>

                                                            <li>
                                                                <h3>Address: &nbsp; {{ $tutor->address }} </h3>
                                                            </li>
                                                            <li>
                                                                <h3>Fee: &nbsp; {{ $tutor->fee }} per hour</h3>
                                                            </li>
                                                        </ul>


                                                        <table name="subtblclass"
                                                            class="table table-dark table-bordered table-responsive"
                                                            id="tabledata">
                                                            <tr>
                                                                <td></td>
                                                                <td>Class</td>
                                                                <td>Subject</td>
                                                            </tr>
                                                            {{ Utilities::break_class_subject($tutor->subject_ids) }}
                                                        </table>
                                                    </div>
                                                </div>

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




    <!-- request Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Send Hire Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="post-request" method="POST" action="javascript:void(0)">
                        @csrf
                        <input value="{{ request()->segment(count(request()->segments())) }}" type="hidden"
                            name="tutor_id">
                        <label> Type your request text</label>
                        <textarea type="text" class="form-control" name="request_text" placeholder="Request Text"
                            rows="10"></textarea>
                        <span class="text-danger p-1" id="error_message"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="send_form">Send Request</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#send_form").click(function(e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var request_text = $("textarea[name='request_text']").val();
                var tutor_id = $("input[name='tutor_id']").val();

                $.ajax({
                    url: "/sendRequest",
                    type: 'POST',
                    data: {
                        _token: _token,
                        tutor_id: tutor_id,
                        request_text: request_text
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#requestModal').modal('hide');
                            alert(data.success);
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });

            });

            function printErrorMsg(msg) {
                $("#error_message").html('');
                $("#error_message").css('display', 'block');
                $.each(msg, function(key, value) {
                    $("#error_message").append('<p>' + value + '</p>');
                });
            }
        });
    </script>
@endsection
