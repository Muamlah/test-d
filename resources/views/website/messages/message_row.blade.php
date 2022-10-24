@foreach($messages as $message)
<div class="card card-style">
    <div class="content">
        <a href="{{route('chat.start', ['message_id' => $message->id])}}">
            <h4>{{$message->subject}}</h4>
            <p>
                {!! $message->message !!}
            </p>
        </a>
    </div>
</div>
@endforeach