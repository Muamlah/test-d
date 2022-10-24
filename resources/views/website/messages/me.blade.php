@if(!is_null($message->file))
<div class="clearfix"></div>
<div class="speech-bubble speach-image speech-left bg-highlight">
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
<div class="speech-bubble speech-left bg-highlight">
    {!!$message->message!!}
</div>
@endif