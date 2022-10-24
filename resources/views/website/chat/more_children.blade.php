@foreach($messages as $message)
    @if($message->user_id == auth()->id())
        @include('website.chat.from')

    @else
        @include('website.chat.me')

    @endif
@endforeach
