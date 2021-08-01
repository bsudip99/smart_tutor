@php 
$dateTime = \Carbon\Carbon::parse($message['created_at']);
$userName = $message[$message['sender']."s_name"];
@endphp


@if($message['sender'] == \session()->all()['table'])
       <div class="row msg_container base_sent" data-message-id="{{ $message['id'] }}">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent text-right" style="float:right">
                <p>{!! $message['chat_text'] !!}</p>
                <time style="float:left" datetime="{{ date("Y-m-dTH:i", strtotime($dateTime)) }}">{{ $userName }} • {{ date("jS F Y h:i:s A", strtotime($dateTime)) }}</time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar">
            <img src="{{ asset('storage/assets/img/student/User.png') }}"  width="50" height="50" class="img-responsive">
        </div>
    </div>

@else

    <div class="row msg_container base_receive" data-message-id="{{ $message['id'] }}">
        <div class="col-md-2 col-xs-2 avatar">
            <img src="{{ asset('storage/assets/img/student/User.png') }}"  width="50" height="50" class=" img-responsive ">
        </div>
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_receive text-left">
                <p>{!! $message['chat_text'] !!}</p>
                <time style="float:left" datetime="{{ date("Y-m-dTH:i", strtotime($dateTime)) }}">{{ $userName }} • {{ date("jS F Y h:i:s A", strtotime($dateTime)) }}</time>
            </div>
        </div>
    </div>

@endif