@if(!is_null($message->file))
<div class="clearfix"></div>
<div class="speech-bubble speach-image speech-right bg-highlight message-item" data-id="{{ $message->id }}">
    @if($message->getFile('ext') == 'image')
    <a href="{{$message->getFile()}}" download >
        <img class="img-fluid preload-img" src="{{$message->getFile()}}" data-src="{{$message->getFile()}}">
    </a>
    @else
    <a href="{{$message->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">
        <i class="fa fa-arrow-down"></i> تحميل الملف المرفق
    </a>
    @endif
    </a>
</div>
@else
<div class="clearfix"></div>
<div class="speech-bubble speech-right bg-msg-r message-item" data-id="{{ $message->id }}">
    <p style="font-size: 13px">{{$message->name}}</p>
    {!!$message->message!!}
</div>
@endif
