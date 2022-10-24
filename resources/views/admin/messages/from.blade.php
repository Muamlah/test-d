{{--@if(!is_null($message->file))--}}
{{--<div class="clearfix"></div>--}}
{{--<div class="speech-bubble speach-image speech-left bg-highlight">--}}
{{--    @if($message->getFile('ext') == 'image')--}}
{{--    <a href="{{$message->getFile()}}" download >--}}
{{--        <img class="img-fluid preload-img" src="{{$message->getFile()}}" data-src="{{$message->getFile()}}">--}}
{{--    </a>--}}
{{--    @else--}}
{{--    <a href="{{$message->getFile()}}" download class="bg-highlight color-white mr-2 button-message m-3">--}}
{{--        <i class="fa fa-arrow-down"></i> تحميل الملف المرفق--}}
{{--    </a>--}}
{{--    @endif--}}
{{--    </a>--}}
{{--</div>--}}
{{--@else--}}
{{--<div class="clearfix"></div>--}}
{{--<div class="speech-bubble speech-left bg-highlight">--}}
{{--    {!!$message->message!!}--}}
{{--</div>--}}
{{--@endif--<div class="d-flex flex-column mb-5 align-items-end">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="text-muted font-size-sm">3 minutes</span>
                                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-12">@if ($child->user_id !='')
                                                        {{$child->user->getName()}}
                                                    @else
                                                        {{$child->admin->name}}
                                                    @endif</a>
                                            </div>
{{--                                            <div class="symbol symbol-circle symbol-35 ml-3">--}}
{{--                                                <img alt="Pic" src="assets/media/users/300_21.jpg" />--}}
{{--                                            </div>--}}
@foreach($messages as $message)

<div class="d-flex flex-column mb-5 align-items-start message-item"  data-id="{{ $message->id }}">
    <div class="d-flex align-items-center">
        <div>
            <span class="text-muted font-size-sm">{{$message->created_at->diffForHumans()}}</span>
            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-12">{{$message->name}}</a>
        </div>
    </div>
    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">{!!$message->message!!}</div>
</div>
@endforeach
