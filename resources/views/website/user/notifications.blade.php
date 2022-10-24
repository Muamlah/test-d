@foreach ($notifications as $notification)
    <a href="{{  route ('notifications.show',$notification->id)}}">
        <p class="pt-2">
            {{$notification->data['message']}}
        </p>
    </a>
    <div class="w-100 divider mb-2 bg-divider"></div>
@endforeach
