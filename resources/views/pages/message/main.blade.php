@extends('layout.app')
@extends('pages.message.message')


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
                                                <div class="col-md-5">
                                                    @if ($users->count() > 0)
                                                        <h3>Pick a user to chat with</h3>
                                                        <ul id="users">
                                                            @foreach ($users as $user)
                                                                <li><span
                                                                        class="label label-info">{{ $user->name }}</span>
                                                                    <a href="javascript:void(0);" class="chat-toggle"
                                                                        data-id="{{ $user->id }}"
                                                                        data-user="{{ $user->name }}">Open chat</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>No messages found! </a></p>
                                                    @endif
                                                </div>

                                                <div class="container-fluid">
                                                    {{-- @yield('content') --}}
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



    <div id="chat-overlay" class="row"></div>
                                              
    @include('pages.message.chat-box')

    <input type="hidden" id="current_user" value="{{ \session()->all()['id'] }}" />
    <input type="hidden" id="pusher_app_key"
        value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster"
        value="{{ env('PUSHER_APP_CLUSTER') }}" />







   

@endsection

@section('script')
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('storage/assets/js/chat.js') }}"></script>

@stop
