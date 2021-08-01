@extends('layout.app')



@section('content')



    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2>
                            Request List
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
                                                                    <td>Student Name</td>
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
                                               
                                                                          <input type="hidden" class="req_id" value="{{ $request->id }}">
                                                                                {{ $request->student_name }} 
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $request->request_text }}</td>
                                                                        <td>
                                                                        @if ($request->status) Approved <button class="btn btn-danger approveBtn"  value="{{ $request->id }}" name="0" >Unapprove </button>  @else
                                                                                Unapproved <button class="btn btn-danger approveBtn" value="{{ $request->id }}" name="1" >Approve </button> @endif
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


    <script>
        $('.approveBtn').click(function(){
            var req_id = $(this).val();
            var status = $(this).attr('name');
            
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/requestStatus",
                type:'post',
                data: { _token:_token, status:status,req_id:req_id},
                success: function(data) {
                    if(data.success)
                    {
                    alert(data.success);
                    location.reload();
                    }
                    else{
                        alert(data.fail);
                    }
                }
            });

            
  
        });
     
        </script>
@endsection
