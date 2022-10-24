@foreach($messages as $message)
<div class="card card-style message-item" data-id="{{ $message->id }}" >
    <div class="content">
        <a href="{{route('messages.chat', ['message_id' => $message->id])}}">
            <h4>{{$message->subject}}</h4>
            <p>
                {{ $message->message }}
            </p>
        </a>
    </div>
</div>
@endforeach