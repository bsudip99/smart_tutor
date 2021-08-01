@extends('layout.app')



@section('content')



    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2>
                             Sent Request List
                        </h2>

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
                                                <div class="col-md-12 ">
                                                    <div class="mu-blog-description">
                                                        <table class="table table-dark table-bordered table-responsive" id="table">

                                                            <thead>
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Tutor Name</td>
                                                                    <td>Request Text</td>
                                                                    <td>Status</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach ($requests as $request)
                                                                    <tr>
                                                                        <td>{{ $i }}</td>
                                                                        <td>
                                                                            @csrf
                                                                            <a href="/tutor/profile/{{ $request->tutors_id }}" style="color:red;" target="_blank">
                                                                                {{ $request->tutor_name }} 
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $request->request_text }}</td>
                                                                        <td>
                                                                        @if ($request->status) Approved <button class="btn btn-danger contact_detail" name="contact_detail" value="{{ $request->tutors_id }}"   >See Contact Detail </button> @else
                                                                                Unapproved @endif
                                                                        </td>
                                                                    </tr>

                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endforeach

                                                            </tbody>




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
   <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel"> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
                <label> Email Id </label>
                <input type="text" id="response_email" class="form-control" readonly>
                
                <label> Phone No </label>
                <input type="text" id="response_phone" class="form-control" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <script>
        $('.contact_detail').click(function(){
            var tutor = $(this).val();
            var _token = $("input[name='_token']").val();
            $('#contactModalLabel').empty();
            $.ajax({
                url: "/getTutorContact",
                type:'post',
                data: { _token:_token, tutor_id:tutor},
                success: function(data) {
                    var name = data[0].name;
                    var email = data[0].email_id;
                    var phone_no = data[0].phone_no;
                    
                    $('#contactModalLabel').append("Contact Detail of "+ name);
                    $('#response_email').val(email);
                    $('#response_phone').val(phone_no);
                    $('#contactModal').modal('show');
                }
            });

            
  
        });
        </script>
@endsection
