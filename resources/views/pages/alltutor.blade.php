@extends('layout.app')



@section('content')



    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2>All Tutors</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">All Tutors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb -->
    <section id="mu-course-content">
       
           
        <div class="container"> 
            <form>
                @csrf
            <div id="wrapper">
           
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <label> Search by Name</label>
                    <input type="text" id="searchbyName" name="searchbyName" class="form-control"
                        placeholder="Search By Name">
                </div>

                <div class="col-md-5 col-sm-5 col-md-offset-1 col-sm-offset-1">
                    <label> Search by Address</label>
                    <input type="text" name="searchbyAddress" id="searchbyAddress" class="form-control"
                        placeholder="Search By Address">
                </div>
            </div>
            &nbsp;
            <div class="row">
                <div class="col-md-5 col-sm-5 ">
                    <label> Search by Class</label>
                    <select name="searchbyclass" id="searchbyclass" class="form-select form-control">
                        <option selected value=""> Search by Class</option>
                        @foreach ($class as $key)
                            <option value="{{ $key->id }}">{{ $key->comment }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5 col-sm-5 col-md-offset-1 col-sm-offset-1">
                    <label> Search by Subject</label>
                    <select name="searchbysubject" id="searchbysubject" class="form-select form-control">
                        <option value="" selected> Search by Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
        </div>
    </form>

     
        <hr>



        <div class="row">
            <div class="col-md-12">
                <div class="mu-course-content-area">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="search_new">
                            <!-- start course content container -->
                            <div class="mu-course-container mu-blog-archive">
                                <div class="row">
                                    @if (!$tutors)
                                        <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4"
                                            class="text-align:center;">
                                            <article class="mu-blog-single-item">
                                                <figure class="mu-blog-single-img">

                                                    <figcaption class="mu-blog-caption">
                                                        <h3>No Tutor Added till now</h3>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @else
                                        @php $i=1; @endphp
                                        @foreach ($tutors as $tutor)
                                            <div class="col-md-4 col-sm-4">
                                                <article class="mu-blog-single-item">
                                                    <figure class="mu-blog-single-img">
                                                        <a href="/tutor/profile/{{ $tutor->id }}">
                                                            @if ($tutor->pic && file_exists('storage/assets/img/tutors' . '/' . $tutor->pic))
                                                                <img alt="img"
                                                                    src="{{ asset('storage/assets/img/tutors/') . '/' . $tutor->pic }}"
                                                                    style="height:400px;">
                                                            @else
                                                                <img alt="img"
                                                                    src="{{ asset('storage/assets/img/tutors/User.png') }}"
                                                                    style="height:400px;">


                                                            @endif

                                                        </a>
                                                        <figcaption class="mu-blog-caption">
                                                            <h3><a href="/tutor/profile/{{ $tutor->id }}">{{ $tutor->name }} </a></h3>
                                                        </figcaption>
                                                    </figure>

                                                    <div class="mu-blog-meta">
                                                       <b> Gender: </b> {{ $tutor->gender }} <br>
                                                       <b> Address: </b> {{ $tutor->address }}

                                                    </div>

                                                    <div class="mu-blog-description">
                                                        <p></p>
                                                        <a class="mu-read-more-btn" href="/tutor/profile/{{ $tutor->id }}">See More</a>
                                                    </div>
                                                </article>
                                            </div>

                                            @if ($i % 3 == 0)
                                </div>
                                <div class="row">
                                    @endif
                                    @php $i++; @endphp
                                    @endforeach
                                </div>

                                <div id="more_load">
                                </div>

                                <div class="row" id="load_more_button_div" style="text-align:center;">
                                    <input type="button" class="btn btn-primary" name="loadmore" id="loadmore"
                                        onclick="load_more();" value="Load More">

                                    <div class="ajax-load text-center" style="display:none">
                                        <p><img src="{{ asset('storage/assets/img/loader.gif') }}">Loading More Tutor </p>
                                    </div>

                                </div>
                                <!-- end course pagination -->
                                @endif
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        var page = 1;

        function load_more() {
            page++;
            loadMoreData(page);
        }

        function loadMoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data) {
                    if (data.html == "") {
                        $('.ajax-load').html("No more records found");
                        $('#loadmore').hide();
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#more_load").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

        document.getElementById('wrapper').addEventListener('change', function(event) {
            var byname = document.getElementById('searchbyName').value;
            var byaddress = document.getElementById('searchbyAddress').value;
            var byclass = document.getElementById('searchbyclass').value;
            var bysubject = document.getElementById('searchbysubject').value;
            ajaxsearch( byname,  byaddress, byclass, bysubject );
           
        });

        function ajaxsearch( byname,  byaddress, byclass, bysubject ){

            var _token =  '{{ csrf_token() }}';
            $.ajax({
                beforeSend: function() {
                        $('.search-load').show();
                    },
                    url: '/ajaxTutorSearch',
                    type: "POST",
                    data: {
                        _token:_token,
                        name: byname,
                        address: byaddress,
                        class: byclass,
                        subject: bysubject,
                    },
                })
                .done(function(data) {
                    if (data.html == "") {
                        $('#search_new').html("No search records found");
                        $('.search-load').hide();
                        return;
                    }
                    $('#search_new').empty();
                    $('.search-load').hide();
                    $("#search_new").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

    

        // $(document).ready(function() {
        //     $("#loadmore").click(function(e) {
        //         alert('here');
        //         e.preventDefault();
        //         page++;
        //         var _token = $("input[name='_token']").val();
        //         var email = $("#email").val();
        //         var pswd = $("#pwd").val();
        //         var address = $("#address").val();

        //         $.ajax({
        //             beforeSend: function() {
        //                 $('.ajax-load').show();
        //             }
        //             type: 'POST',
        //             data: {
        //                 _token: _token,
        //                 email: email,
        //                 pswd: pswd,
        //                 address: address
        //             },
        //             success: function(data) {
        //                 printMsg(data);
        //             }
        //         });
        //     });

        // });
    </script>
@endsection
